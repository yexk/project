<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MyCon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:mycon {user=yexk}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new controller and diy extends (unrealized)';

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
        $user = $this->argument('user');
        echo 'hello ' . $user . '!!!';
    }
}
