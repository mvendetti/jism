<?php

namespace App\Observers;

use App\Camera;
use App\CameraStatus;
use App\Lib\ParseGoProData;

class CameraObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function loaded(Camera $camera)
    {
        $cs = \App\CameraStatus::where('camera_serial_number', $camera->serial_number)
                ->latest()
                ->first();

        $camera->setRelation('status', $cs);
    }
}
