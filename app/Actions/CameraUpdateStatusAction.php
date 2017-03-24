<?php

namespace App\Actions;

use App\CameraStatus;
use App\Lib\CamApis\StatusApi;

class CameraUpdateStatusAction extends CameraAction
{
    protected $updatesStatus = true;
}
