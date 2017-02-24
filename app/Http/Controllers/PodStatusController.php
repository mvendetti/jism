<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;

class PodStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pod)
    {
        return response()->json(Camera::all());
    }
}
