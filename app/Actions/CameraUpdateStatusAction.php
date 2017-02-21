<?php

namespace App\Actions\Cameras;

use App\CameraStatus;
use App\Lib\CamApis\StatusApi;

class CameraUpdateStatusAction
{
    public function __construct($cameras)
    {
        $api = new StatusApi($cameras->pluck('ip')->toArray());
        foreach($api->getSuccessful() as $key => $value)
        {
            $camera = $cameras->where('ip', $key)->first();
            $status = CameraStatus::create(['camera_id' => $camera->serial_number, 'raw' => $value]);
        }
        foreach($api->getFailed() as $key => $value)
        {
            $camera = $cameras->where('ip', $key)->first();
            $camera->online = false;
            $camera->save();
        }
    }

    static public function run($cameras)
    {
        return new self($cameras);
    }
}
