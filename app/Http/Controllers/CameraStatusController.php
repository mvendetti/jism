<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CameraRepository;

class CameraStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($camera)
    {
        return response()->json(CameraRepository::all());
    }
}
