<?php

namespace App\Actions;

use App\CameraStatus;
use App\Lib\CamApis\StopRecordApi;

class CameraStopRecordAction
{
    public function __construct($cameras)
    {
        if(class_basename($cameras) !== 'Collection')
        {
            $cameras = collect()->push($cameras);
        }
        $api = new StopRecordApi($cameras->pluck('ip')->toArray());
    }

    static public function run($cameras)
    {
        return new self($cameras);
    }
}
