<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;
use App\Actions\CameraRecordAction;
use App\Repositories\CameraRepository;

class CameraRecordController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($camera)
    {
        $cameras = Camera::all();
        CameraRecordAction::run($cameras);
        $cameras = CameraRepository::all();
    }
}
