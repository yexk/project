<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

        Worker::$stdoutFile = 'stdout.log';

        // echo $this->argument('action');
        $this->_workerObj = new Worker("websocket://0.0.0.0:11104");

        // 4 processes
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
            foreach($this->_workerObj->connections as $conn)
            {
                $conn->send("user[{$connection->uid}] said: $data");
            }
        };

        // Emitted when connection closed
        $this->_workerObj->onClose = function($connection)
        {
            foreach($this->_workerObj->connections as $conn)
            {
                $conn->send("user[{$connection->uid}] logout");
            }
        };

        // Run worker
        Worker::runAll();
    }

}
