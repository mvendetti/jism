<?php

namespace App\Repositories;

use App\Camera;
use App\CameraSatus;

class CameraRepository
{
    public static function all()
    {
        $cameras = Camera::all();
        self::addStatusRelationships($cameras);
        return $cameras;
    }

    public static function find($serial_number)
    {
        $camera = Camera::findOrFail($serial_number);
        self::addStatusRelationship($camera);
        return $camera;
    }

    protected static function addStatusRelationships(&$cameras)
    {
        foreach($cameras as &$camera)
        {
            self::addStatusRelationship($camera);
        }
    }

    protected static function addStatusRelationship(Camera &$camera)
    {
        $cs = \App\CameraStatus::where('camera_serial_number', $camera->serial_number)
                ->latest()
                ->first();

        $camera->setRelation('status', $cs);
    }
}
