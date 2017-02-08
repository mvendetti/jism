<?php

namespace App\Console\Commands;

use NetTools;
use App\Camera;
use Illuminate\Console\Command;

class CameraWakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:wake';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wake up the camera';

    protected $nettool;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->nettool = new NetTools;
        $this->nettool::setIP('10.0.42.10');
        $this->nettool::setNetmask('255.255.255.0');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cameras = Camera::all();
        foreach($cameras as $camera)
        {
            $this->wakeup($camera->ip, $camera->mac_colons);
        }
    }

    public function wakeup($ip, $mac)
    {
        for($x = 0; $x < 5; $x++)
        {
            $this->nettool::WakeOnLan($mac, $ip)->WakeUp();
        }
    }
}
