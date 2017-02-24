<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;

class GroupStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($group)
    {
        return response()->json(Camera::all());
    }
}
