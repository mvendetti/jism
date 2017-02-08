<?php

namespace App\Console\Commands;

use App\Lease;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;

class JismUpdateLeasesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jism:leases';

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
        $client = new Client();
        $req =  new Request('GET', 'http://10.0.42.1/user/leases.html');
        $res = $client->send($req);
        if($res->getStatusCode() >= 200 && $res->getStatusCode() < 300)
        {
            $body = $res->getBody()->getContents();
            $lines = explode("\n", trim($body));
            $parts = [];
            foreach($lines as $line)
            {
                $parts[] = explode(" ", $line);
            }

            Lease::truncate();

            foreach($parts as $part)
            {
                if(isset($part[1]) && isset($part[2]) && isset($part[3]))
                {
                    Lease::create([
                        'mac' => $part[1],
                        'ip' => $part[2],
                        'hostname' => $part[3]
                    ]);
                }
            }
        }
    }
}
