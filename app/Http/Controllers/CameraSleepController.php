<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;
use App\Actions\CameraSleepAction;

class CameraSleepController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($camera)
    {
        $action = CameraSleepAction::run(Camera::findOrFail($camera));
        return response()->json($action->getResults());
    }
}
