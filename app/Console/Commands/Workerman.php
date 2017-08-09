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
        $argv[0]='workerman:work';
        $argv[1]=$this->argument('action');
        $argv[2]=$this->option('daemonize')?'-d':'';

        Worker::$stdoutFile = 'stdout.log';

        // echo $this->argument('action');
        $ws_worker = new Worker("websocket://0.0.0.0:11104");

// 4 processes
        $ws_worker->count = 4;

// Emitted when new connection come
        $ws_worker->onConnect = function($connection)
        {
            echo "New connection.121212\n";
        };

// Emitted when data received
        $ws_worker->onMessage = function($connection, $data)
        {
            // Send hello $data
            $connection->send('hello ' . $data);
        };

// Emitted when connection closed
        $ws_worker->onClose = function($connection)
        {
            echo "Connection closed12121212sdafdsaf\n";
        };

// Run worker
        Worker::runAll();
    }
}
