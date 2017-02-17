<?php

namespace App\Repositories;

use App\Pod;
use App\Camera;

class PodRepository
{
    /**
     * Creates a new pod
     *
     * @var bool
     */
    public static function create($number)
    {
        if(Pod::where('number', $number)->first())
        {
            throw new \Exception("Pod number $number already exists.");
        }
        return Pod::create(['number' => $number]);
    }

    /**
     * Handles the relationship creation between a pod and camera
     *
     * @param  Pod    $pod
     * @param  Camera $camera
     * @param  string $side
     * @var bool
     */
    public static function assignCamera(Pod $pod, Camera $camera, $side)
    {
        $oCameras = Camera::where('pod_id', $pod_id)
            ->where('serial_number', '!=', $camera->serial_number)
            ->where('pod_side', $side)
            ->get();

        if($oCameras)
        {
            foreach($oCameras as $oCamera)
            {
                $oCamera->pod_side = 'unassigned';
                $oCamera->pod_id = null;
                $oCamera->save();
            }
        }

        $camera->pod_side = $side;
        $camera->pod_id = $pod_id;
        return $camera->save();
    }
}
