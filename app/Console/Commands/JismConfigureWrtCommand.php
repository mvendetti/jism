<?php

namespace App\Console\Commands;

use SSH;
use Illuminate\Console\Command;

class JismConfigureWrtCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jism:wrt';

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
        //ssh root@10.0.42.1 -p 2222 'nvram set wol_hosts="D4:D9:19:E6:8E:BC=*=10.0.42.255 D4:D9:19:F5:1F:FE=*=10.0.42.255 E4:CE:8F:54:0A:A3=Seans-iMac=10.0.42.255"; nvram commit'

        SSH::run([
            'rm /tmp/www/leases.html; ln -s /tmp/dnsmasq.leases /tmp/www/leases.html'
        ]);
    }
}
