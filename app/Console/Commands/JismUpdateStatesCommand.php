<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class JismUpdateStatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jism:update';

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
        while (true)
        {
            $this->callSilent('jism:wrt');
            $this->callSilent('jism:leases');
            sleep(5);
        }
    }
}
