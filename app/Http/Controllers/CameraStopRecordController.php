<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;
use App\Actions\CameraStopRecordAction;
use App\Repositories\CameraRepository;

class CameraStopRecordController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($camera)
    {
        CameraStopRecordAction::run(Camera::findOrFail($camera));
        return response()->json(Camera::findOrFail($camera));
    }
}
