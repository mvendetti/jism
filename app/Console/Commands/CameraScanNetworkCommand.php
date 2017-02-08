<?php

namespace App\Console\Commands;

use App\Lease;
use App\Camera;
use App\lib\BigData;
use App\Lib\ParseData;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;

class CameraScanNetworkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan the network for gopro cameras';

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
        $leases = Lease::getGoPros();

        $client = new Client();
        $promises = [];
        foreach($leases as $lease)
        {
            $promises[$lease->ip] = $client->getAsync('http://' . $lease->ip . '/gp/gpControl/info');
        }
        $results = Promise\unwrap($promises);
        $results = Promise\settle($promises)->wait();

        Camera::truncate();
        foreach($results as $ip => $raw)
        {
            $response = $raw['value'];
            $body = $response->getBody()->getContents();
            $parsed = new ParseData($body, 13);
            $this->createCamera($parsed->data()->info, $ip);
        }
    }

    public function createCamera( BigData $info, $ip )
    {
        Camera::create( [
            'serial_number' => $info->serial_number,
            'ip' => $ip,
            'mac' => $info->ap_mac,
            'ssid' => $info->ap_ssid,
            'model_number' => $info->model_number,
            'model_name' => $info->model_name,
            'firmware_version' => $info->firmware_version
        ] );
    }
}
