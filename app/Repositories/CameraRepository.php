<?php

namespace App\Repositories;

use App\Camera;
use App\CameraSatus;

class CameraRepository
{
    public static function all()
    {
        $cameras = Camera::all();
        return $cameras;
    }

    public static function find($serial_number)
    {
        $camera = Camera::where('serial_number', $serial_number)->get();
        return $camera;
    }
}
