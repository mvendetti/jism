<?php

namespace App;

use App\Camera;
use Illuminate\Database\Eloquent\Model;

class Pod extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
    ];

    public function setCameraLeftIdAttribute($serialNumber)
    {
        $cam = Camera::where('serial_number', $serialNumber);
        $cam->setPodLeft($this);
    }

    public function setCameraRightIdAttribute($serialNumber)
    {
        $cam = Camera::where('serial_number', $serialNumber);
        $cam->setPodRight($this);
    }

    public function cameras()
    {
        return $this->hasMany('App\Camera');
    }

    public function set_cameras()
    {
        return $this->hasMany('App\Camera')->where('pod_side', '!=', null);
    }

    /**
     * The roles that belong to the user.
     */
    public function camera_left()
    {
        return $this->hasOne('App\Camera')->where('pod_side', 'left');
    }

    /**
     * The roles that belong to the user.
     */
    public function camera_right()
    {
        return $this->hasOne('App\Camera')->where('pod_side', 'right');
    }
}
