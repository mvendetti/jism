<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CameraRepository;

class GroupStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($group)
    {
        return response()->json(CameraRepository::all());
    }
}
