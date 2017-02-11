<?php

namespace App\Repositories;

use DB;
use App\Pod;

class PodRepository
{
    public static function createNextPod($podNum = null)
    {
        if(Pod::where('number', $podNum)->first())
        {
            throw new \Exception("Pod number $podNum already exists.");
        }
        if(! $podNum)
        {
            $podNum = DB::table('pods')->max('number');
            $podNum = $podNum
                ? $podNum + 1
                : 1;
        }
        return Pod::create(['number' => $podNum]);
    }
}
