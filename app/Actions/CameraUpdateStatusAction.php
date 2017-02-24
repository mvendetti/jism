<?php

namespace App\Actions;

use App\CameraStatus;
use App\Lib\CamApis\StatusApi;

class CameraUpdateStatusAction
{
    public $cameras;
    public function __construct($cameras)
    {
        $this->cameras = collect();

        $api = new StatusApi($cameras->pluck('ip')->toArray());
        foreach($api->getSuccessful() as $key => $value)
        {
            $camera = $cameras->where('ip', $key)->first();
            $status = CameraStatus::create(['camera_serial_number' => $camera->serial_number, 'raw' => $value]);
            $camera->online = true;
            $camera->save();
        }
        foreach($api->getFailed() as $key => $value)
        {
            $camera = $cameras->where('ip', $key)->first();
            $camera->online = false;
            $camera->is_recording = false;
            $camera->save();
        }
        foreach($cameras as &$camera)
        {
            $this->cameras->push($camera->fresh());
        }
    }

    static public function run($cameras)
    {
        return new self($cameras);
    }
}
