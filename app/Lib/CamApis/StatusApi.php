<?php

namespace App\Lib\CamApis;

class StatusApi extends Base
{
    /**
     * Returns the endpoint for the call
     *
     * @var string
     */
    public function getUrl()
    {
        return '/gp/gpControl/status';
    }
}
