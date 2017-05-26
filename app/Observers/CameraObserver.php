<?php

namespace App\Observers;

use App\Camera;
use App\CameraStatus;

class CameraObserver
{
    // /**
    //  * Listen to the Camera loaded event.
    //  *
    //  * @param  Camera  $camera
    //  * @return void
    //  */
    // public function loaded(Camera $camera)
    // {
    //     $cs = CameraStatus::where('camera_serial_number', $camera->serial_number)
    //             ->latest()
    //             ->first();
    //
    //     $camera->setRelation('status', $cs);
    // }

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

    /**
     * Listen to the Camera saving event.
     *
     * @param  Camera  $camera
     * @return void
     */
    public function saving(Camera $camera)
    {
        if($camera->isDirty('pod_id') || $camera->isDirty('pod_side'))
        {
            Camera::where('serial_number', '!=', $camera->serial_number)
                ->where('pod_id', $camera->pod_id)
                ->where('pod_side', $camera->pod_side)
                ->update(['pod_side' => null]);
        }
    }
}
