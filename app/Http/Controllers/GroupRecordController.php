<?php

namespace App\Http\Controllers;

use App\Camera;
use App\Lib\DataGraph;
use Illuminate\Http\Request;
use App\Actions\CameraRecordAction;

class GroupRecordController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($group)
    {
        $action = CameraRecordAction::run(Camera::all());
        return response()->json(new DataGraph);
    }
}
