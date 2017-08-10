<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Workerman\Worker;

class Workerman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workerman:work {action} {-d|--daemonize}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'workerman server commands for php-cli';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $_globalUid = 0;
    protected $_workerObj = null;
    protected $_onlineUser = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        global $argv;
        $argv[0]= __FILE__;
        $argv[1]=$this->argument('action');
        $argv[2]=$this->option('daemonize')?'-d':'';

        $this->_workerObj = new Worker("websocket://0.0.0.0:11104");

        // 1 processes
        $this->_workerObj->count = 1;

        // Emitted when new connection come
        $this->_workerObj->onConnect = function($connection)
        {
            // 为这个链接分配一个uid
            $connection->uid = ++$this->_globalUid;
        };

        // Emitted when data received
        $this->_workerObj->onMessage = function($connection, $data)
        {
            $data = json_decode($data,true);
            if (empty($data['userid']))
            {
                $this->_onlineUser[$connection->uid] = $data['id'];
                Redis::sadd('userlists',$this->_onlineUser[$connection->uid]);

                foreach($this->_workerObj->connections as $conn)
                {
                    $conn->send('{"login":1}');
                }
                return false;
            }else{
                $data['date'] = date('Y-m-d H:i:s');
                $data['content'] = str_replace(array( "\r\n" , "\n" , "\r" ), '<br>', $data['content']);
                $data = json_encode($data);
                Redis::rpush('chat_group1',$data);
            }

            foreach($this->_workerObj->connections as $conn)
            {
                $conn->send($data);
            }
        };

        // Emitted when connection closed
        $this->_workerObj->onClose = function($connection)
        {
            foreach($this->_workerObj->connections as $conn)
            {
                Redis::srem('userlists',$this->_onlineUser[$connection->uid]);
                $conn->send('{"login":0}');
            }
        };

        // Run worker
        Worker::runAll();
    }

}
