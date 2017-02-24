<?php

namespace App\Actions;

use App\CameraStatus;
use App\Lib\CamApis\RecordApi;
use App\Lib\CamApis\StopRecordApi;

class CameraRecordAction extends CameraAction
{
    protected $updatesStatus = true;

    public function atStart()
    {
        new RecordApi($this->cameras->pluck('ip')->toArray());
    }

    public function atEnd()
    {
        foreach($this->cameras as $camera)
        {
            if($camera->is_recording === false)
            {
                CameraStopRecordAction::run($this->cameras);
                return abort(500, 'Camera(s) did not successfully start. Stop issued.');
            }
        }
    }
}
