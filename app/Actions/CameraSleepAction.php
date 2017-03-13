<?php

namespace App\Actions;

use App\CameraStatus;
use App\Lib\CamApis\SleepApi;

class CameraSleepAction extends CameraAction
{
    protected $updatesStatus = true;

    public function atStart()
    {
        new SleepApi($this->cameras->pluck('ip')->toArray());
    }

}
