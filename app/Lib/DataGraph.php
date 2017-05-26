<?php

namespace App\Lib;

use App\Pod;
use App\Camera;
use App\CameraStatus;

class DataGraph
{
    public $pods = null;
    public $cameras = null;

    public function __construct()
    {
        $this->setPods();
        $this->setCameras();
    }

    protected function getCameraOnPod($pod_id, $side)
    {
        $camera = Camera::select('serial_number')
                        ->where('pod_id', $pod_id)
                        ->where('pod_side', $side)
                        ->first();
        if(!empty($camera))
        {
            return $camera->serial_number;
        }
        return null;
    }

    protected function setPods()
    {
        $this->pods = Pod::all();
        $this->pods = $this->pods->map(function($pod) {
            $camera_left = $this->getCameraOnPod($pod->id, 'left');
            $camera_right = $this->getCameraOnPod($pod->id, 'right');
            $pod->camera_left = $camera_left;
            $pod->camera_right = $camera_right;
            $pod->cameras = array_filter([$camera_left, $camera_right]);
            return $pod;
        });
    }

    protected function setCameras()
    {
        $this->cameras = Camera::all();
        $this->cameras = $this->cameras->map(function($camera) {
            return $this->loaded($camera);
        });
    }

    /**
     * Sets the current status on a camera.
     *
     * @param  Camera  $camera
     * @return void
     */
    public function loaded(Camera $camera)
    {
        $cs = CameraStatus::where('camera_serial_number', $camera->serial_number)
                ->latest()
                ->first();

        $camera->setRelation('status', $cs);

        return $camera;
    }
}
