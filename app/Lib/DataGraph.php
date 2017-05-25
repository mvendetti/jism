<?php

namespace App\Lib;

use App\Pod;
use App\Camera;

class DataGraph
{
    public $pods = null;
    public $other_cameras = null;

    public function __construct()
    {
        $this->setOtherCameras();
        $this->setPods();
    }

    protected function setPods()
    {
        $this->pods = Pod::with('set_cameras')->get();
    }

    protected function setOtherCameras()
    {
        $this->other_cameras = Camera::where('pod_id', null)
            ->orWhere('pod_side', null)
            ->get();
    }
}
