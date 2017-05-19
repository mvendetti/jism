<?php

namespace App\Http\Controllers;

use App\Key;
use App\Camera;
use Illuminate\Http\Request;

class GroupSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keys = Key::where('keytype', 'settings')->get();
        $keys->each(function($key) use (&$values) {
            $opts = collect($key->opts)->map(function($opt, $idx) {
                return [ 'id' => $idx, 'title' => $opt ];
            });
            $opts = [];
            foreach($key->opts as $idx => $opt)
            {
                $opts[] = [ 'id' => $idx, 'title' => $opt ];
            }
            $values[$key->slug] = [
                'id' => $key->id,
                'gopro_id' => $key->gopro_id,
                'title' => $key->value,
                'opts' => $opts
            ];
        });
        return response()->json($values);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $group_id)
    {
        /**
         * Groups not yet implemented in data schema
         */
        $settings = $request->except(['errors', 'response', 'busy', 'successful']);
        $txn = \DB::transaction(function () use ($settings) {
            foreach(Camera::all() as $camera)
            {
                $camera->update(['settings' => $settings]);
            }
        });
        return response()->json($txn);
    }
}
