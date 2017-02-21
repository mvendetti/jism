<?php

namespace App\Lib\CamApis;

class StopRecordApi extends Base
{
    /**
     * Returns the endpoint for the call
     *
     * @var string
     */
    public function getUrl()
    {
        return '/gp/gpControl/command/shutter?p=0';
    }
}
