<?php

namespace App\Http\Controllers;

use App\Key;

class KeysController extends Controller
{

    public function index()
    {
        return response()->json(Key::all());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($key_type)
    {
        $keys = Key::where('keytype', $key_type)->get();
        $keys->each(function($key) use (&$values) {
            $opts = collect($key->opts)->map(function($opt, $idx) {
                return [ 'id' => $idx, 'title' => $opt ];
            });
            $options = is_null($key->opts)
                ? []
                : $key->opts;
            $opts = [];
            foreach($options as $idx => $opt)
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
}
