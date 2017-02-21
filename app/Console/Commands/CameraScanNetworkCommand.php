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
    protected $signature = 'camera:scan {--ip=*}';

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
        $results = new HttpGroupGet($this->getIps(), '/gp/gpControl/info');
        if($results->hasSuccessful())
        {
            foreach($results->getSuccessful() as $ip => $result)
            {
                $this->createCamera($result, $ip);
            }
        }
        if($results->hasFailed())
        {
            foreach($results->getFailed() as $ip => $result)
            {
                $this->updateOfflineCamera($ip);
            }
        }
    }

    public function getIps()
    {
        $ips = $this->option('ip');
        if(is_array($ips) && count($ips) > 0)
        {
            return $ips;
        }
        return Lease::getGoPros()->pluck('ip')->toArray();
    }

    public function createCamera( $info, $ip )
    {
        $info = json_decode($info, true)['info'];
        $keyOn = ['serial_number' => $info['serial_number']];
        $data = [
            'ip' => $ip,
            'mac' => $info['ap_mac'],
            'ssid' => $info['ap_ssid'],
            'model_number' => $info['model_number'],
            'model_name' => $info['model_name'],
            'firmware_version' => $info['firmware_version'],
            'online' => true
        ];
        $camera = Camera::updateOrCreate($keyOn, $data);
    }

    public function updateOfflineCamera($ip)
    {
        $camera = Camera::where('ip', $ip)->first();
        if($camera)
        {
            $camera->online = false;
            $camera->save();
        }
    }
}
