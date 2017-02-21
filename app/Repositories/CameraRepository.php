<?php

namespace App\Repositories;

use App\Camera;
use App\Actions\CameraUpdateStatusAction;

class CameraRepository
{
    /**
     * Creates a new pod
     *
     * @var bool
     */
    public static function all()
    {
        CameraUpdateStatusAction::run(Camera::all());
        return Camera::with(['status'])->get();
    }
}
