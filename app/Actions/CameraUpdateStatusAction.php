<?php

namespace App\Actions\Cameras;

use App\CameraStatus;
use App\Lib\CamApis\StatusApi;

class UpdateStatusAction
{
    public function __construct($cameras)
    {
        $api = new StatusApi($cameras->pluck('ip')->toArray());
        foreach($api->getSuccessful() as $key => $value)
        {
            $camera = $cameras->where('ip', $key)->first();
            $status = CameraStatus::create(['camera_id' => $camera->serial_number, 'raw' => $value]);
        }
    }

    static public function run($cameras)
    {
        return new self($cameras);
    }
}
