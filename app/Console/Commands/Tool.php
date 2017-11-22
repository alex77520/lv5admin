<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Tool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tool {fn} {--param=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $function = $this->argument('fn');
        $param = $this->option('param');
        $this->{$function}($param);
    }

    public function test($id){
        //\Log::info('cront--test');
        echo $id;
    }
}
