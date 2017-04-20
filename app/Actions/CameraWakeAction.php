<?php

namespace App\Actions;

use NetTools;
use App\Camera;
use App\CameraStatus;

class CameraWakeAction
{
    protected $updatesStatus = true;
    protected $nettool;
    protected $cameras;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($cameras)
    {
        $this->cameras = $cameras;
        $this->nettool = new NetTools;
        $this->nettool::setIP('10.0.42.5');
        $this->nettool::setNetmask('255.255.255.0');
    }

    static public function run($cameras)
    {
        return new static($cameras);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function wakeCameras()
    {
        foreach($this->cameras as $camera)
        {
            $this->wakeCamera($camera->ip, $camera->mac_colons);
        }
    }

    public function wakeCamera($ip, $mac)
    {
        for($x = 0; $x < 5; $x++)
        {
            $this->nettool::WakeOnLan($mac, $ip)->WakeUp();
        }
    }

}
