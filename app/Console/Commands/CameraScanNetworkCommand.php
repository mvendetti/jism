<?php

namespace App\Console\Commands;

use App\Camera;
use App\lib\BigData;
use App\Lib\ParseData;
use GuzzleHttp\Client;
use LaravelNmap\LaravelNmap as Nmap;
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
        Camera::truncate();

        $ips = $this->discoverIps();

        foreach($ips as $ip)
        {
            $this->tryNode($ip);
        }
    }

    public function tryNode($ip)
    {
        $this->info('Trying ' . $ip);
        $client = new Client(['base_uri' => 'http://'.$ip.'/gp/gpControl/', 'connect_timeout' => '1', 'timeout' => '1']);
        $req =  new Request('GET', 'info');
        try {
            $res = $client->send($req);

            if($res->getStatusCode() >= 200 && $res->getStatusCode() < 300)
            {
                $this->info($ip . ' successful');
                $camdata = ( new ParseData( $res->getBody()->getContents() ) )->data();
                $this->createCamera($camdata->info, $ip);
            }
            else
            {
                $this->info($ip . ' failed');
            }
        }
        catch (\GuzzleHttp\Exception\ConnectException $e) {

        }
        catch (\GuzzleHttp\Exception\ClientException $e) {

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

    public function discoverIps()
    {
        return $this->ipsFromNmap( $this->nmapScan() );
    }

    public function ipsFromNmap($nmapResults)
    {
        $ips = [];
        foreach($nmapResults as $ip => $info)
        {
            if($ip !== '10.0.42.1' && $ip !== '10.0.42.5')
            {
                $ips[] = $ip;
            }
        }
        return $ips;
    }

    public function nmapScan()
    {
        $nmap = new Nmap();
        return $nmap->setTarget('10.0.42.0/24')
                    ->disablePortScan()
                    ->setTimeout(60)
                    ->getArray();
    }
}
