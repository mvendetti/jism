<?php

namespace App\Http\Controllers;

use App\Lib\DataGraph;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new DataGraph);
    }
}
