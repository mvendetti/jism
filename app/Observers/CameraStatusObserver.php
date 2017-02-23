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
        if(! is_array($cs->raw))
        {
            $cs->raw = json_decode($cs->raw);
        }
        $parser = new ParseGoProData($cs->raw, 13);
        $cs->parsed = $parser->getParsed();
        $cs->unparsed = $parser->getUnparsed();
        if(isset($cs->parsed['status']['recording_status']))
        {
            $recordingStatus = $cs->parsed['status']['recording_status']['gopro_subid'];
            $cs->camera->is_recording = $recordingStatus === 1;
            $cs->camera->save();
        }
    }
}
