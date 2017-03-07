<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;
use App\Actions\CameraStopRecordAction;

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
        $action = CameraStopRecordAction::run(Camera::findOrFail($camera));
        return response()->json(collect()->push($action->getResults()));
    }
}
