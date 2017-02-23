<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Camera;

class CameraStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($camera)
    {
        return response()->json(collect()->push(Camera::findOrFail($camera)));
    }
}
