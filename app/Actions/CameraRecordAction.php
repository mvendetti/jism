<?php

namespace App\Actions;

use App\CameraStatus;
use App\Lib\CamApis\RecordApi;

class CameraRecordAction
{
    public function __construct($cameras)
    {
        $api = new RecordApi($cameras->pluck('ip')->toArray());
    }

    static public function run($cameras)
    {
        return new self($cameras);
    }
}
