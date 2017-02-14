<?php

namespace App;

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

    /**
     * The roles that belong to the user.
     */
    public function cameras()
    {
        return $this->belongsToMany('App\Camera', 'camera_pod', 'pod_id',  'serial_number');
    }
}
