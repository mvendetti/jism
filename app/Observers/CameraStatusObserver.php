<?php

namespace App\Observers;

use Carbon\Carbon;
use App\CameraStatus;
use App\Lib\ParseGoProData;

class CameraStatusObserver
{
    /**
     * Listen to the CameraStatus saving event.
     *
     * @param  CameraStatus  $cs
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

    /**
     * Listen to the CameraStatus saved event.
     *
     * @param  CameraStatus  $cs
     * @return void
     */
    public function saved(CameraStatus $cs)
    {
        $cutoff = Carbon::now()->subMinutes($cs->lifetime);
        $records = CameraStatus::where('created_at', '<', $cutoff->toDateTimeString())->delete();
    }
}
