<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;

class GroupSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($group_id)
    {
        return response()->json(Camera::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $group_id)
    {
        $settings = json_encode($request->except(['errors', 'response', 'busy', 'successful']));
        return response()->json(\DB::table('cameras')->update(['settings' => $settings]));
    }
}
