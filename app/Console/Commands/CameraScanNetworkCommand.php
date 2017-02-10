<?php

namespace App\Console\Commands;

use App\Lease;
use App\Camera;

use App\Lib\BigData;
use App\Lib\HttpGroupGet;
use Illuminate\Console\Command;

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

    protected $succeeded = [];
    protected $failed = [];

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
        $ips = $leases->pluck('ip')->toArray();
        $get = new HttpGroupGet($ips, '/gp/gpControl/info');
        $results = $get->run();;
        foreach($results->succeeded as $result)
        {
            $this->createCamera($result->data->info, $result->ip);
        }
        foreach($results->failed as $result)
        {
            $this->updateOfflineCamera($result->ip);
        }
     }

    public function createCamera( BigData $info, $ip )
    {
        $keyOn = ['serial_number' => $info->serial_number];
        $data = [
            'ip' => $ip,
            'mac' => $info->ap_mac,
            'ssid' => $info->ap_ssid,
            'model_number' => $info->model_number,
            'model_name' => $info->model_name,
            'firmware_version' => $info->firmware_version
        ];
        $camera = Camera::updateOrCreate($keyOn, $data);
    }

    public function updateOfflineCamera($ip)
    {
        // needs finishing
    }
}
