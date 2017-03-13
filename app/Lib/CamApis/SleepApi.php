<?php

namespace App\Lib\CamApis;

class SleepApi extends Base
{
    /**
     * Returns the endpoint for the call
     *
     * @var string
     */
    public function getUrl()
    {
        return '/gp/gpControl/command/system/sleep';
    }
}
