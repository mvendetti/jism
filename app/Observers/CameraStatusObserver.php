<?php

namespace App\Observers;

use App\CameraStatus;
use App\Lib\ParseGoProData;

class CameraStatusObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function saving(CameraStatus $cs)
    {
        $cs->parsed = (new ParseGoProData($cs->raw, 13))->get();
    }
}
