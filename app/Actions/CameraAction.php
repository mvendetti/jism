<?php

namespace App\Actions;

use App\CameraStatus;
use App\Lib\CamApis\StatusApi;

abstract class CameraAction
{
    protected $cameraResults;
    protected $updatesStatus = false;

    public function __construct($cameras)
    {
        if(class_basename($cameras) !== 'Collection')
        {
            $cameras = collect()->push($cameras);
        }

        $this->cameras = $cameras;

        // By atStart, I mean your first task...
        if(method_exists($this, 'atStart'))
        {
            call_user_func([$this, 'atStart']);
        }

        if($this->updatesStatus === true)
        {
            $this->refreshStatus();
        }

        // By atEnd, I mean your last task...
        if(method_exists($this, 'atEnd'))
        {
            call_user_func([$this, 'atEnd']);
        }
    }

    public function getResults()
    {
        $results = collect();

        foreach($this->cameras as $camera)
        {
            $results->push($camera->fresh());
        }

        return $results;
    }

    public function refreshStatus()
    {
        $api = new StatusApi($this->cameras->pluck('ip')->toArray());
        foreach($this->cameras as &$camera)
        {
            if($api->hasSuccessful($camera->ip))
            {
                $status = CameraStatus::create([
                    'camera_serial_number' => $camera->serial_number,
                    'raw' => $api->getSuccessful($camera->ip)
                ]);
                $camera->setOnline();
            }
            else
            {
                $camera->setOffline();
            }
        }
    }

    static public function run($cameras)
    {
        return new static($cameras);
    }
}
