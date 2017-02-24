<?php

namespace App\Actions;

use App\CameraStatus;
use App\Lib\CamApis\RecordApi;
use App\Lib\CamApis\StopRecordApi;

class CameraRecordAction
{
    public function __construct($cameras)
    {
        if(class_basename($cameras) !== 'Collection')
        {
            $cameras = collect()->push($cameras);
        }
        new RecordApi($cameras->pluck('ip')->toArray());

        $ra = CameraUpdateStatusAction::run($cameras);
// dd($ra);
        foreach($ra->cameras as $camera)
        {
            if($camera->is_recording === false)
            {
                new StopRecordApi($cameras->pluck('ip')->toArray());
                return abort(500, 'Camera(s) did not successfully start. Stop issued.');
            }
        }
    }

    static public function run($cameras)
    {
        return new self($cameras);
    }
}
