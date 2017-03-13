<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;
use App\Actions\CameraSleepAction;

class GroupSleepController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($group)
    {
        $action = CameraSleepAction::run(Camera::all());
        return response()->json($action->getResults());
    }
}
