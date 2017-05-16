<?php

namespace App\Observers;

use App\Camera;
use App\CameraStatus;
use App\Lib\ParseGoProData;

class CameraObserver
{
    /**
     * Listen to the Camera loaded event.
     *
     * @param  Camera  $camera
     * @return void
     */
    public function loaded(Camera $camera)
    {
        $cs = \App\CameraStatus::where('camera_serial_number', $camera->serial_number)
                ->latest()
                ->first();

        $camera->setRelation('status', $cs);
    }

    /**
     * Listen to the Camera creating event.
     *
     * @param  Camera  $camera
     * @return void
     */
    public function creating(Camera $camera)
    {
        $camera->settings = '{}';
    }
}
