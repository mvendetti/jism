<?php

namespace App\Actions;

use App\Lib\CamApis\StopRecordApi;

class CameraStopRecordAction extends CameraAction
{
    protected $updatesStatus = true;

    public function atStart()
    {
        new StopRecordApi($this->cameras->pluck('ip')->toArray());
    }

    public function atEnd()
    {
        new StopRecordApi($this->cameras->pluck('ip')->toArray());
    }
}
