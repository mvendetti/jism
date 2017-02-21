<?php

namespace App\Actions\Cameras;

use App\CameraStatus;
use App\Lib\CamApis\StopRecordApi;

class CameraRecordAction
{
    public function __construct($cameras)
    {
        $api = new StopRecordApi($cameras->pluck('ip')->toArray());
    }

    static public function run($cameras)
    {
        return new self($cameras);
    }
}
