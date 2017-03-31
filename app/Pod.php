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
    public function camera_left()
    {
        return $this->belongsTo('App\Camera', 'camera_left_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function camera_right()
    {
        return $this->belongsTo('App\Camera', 'camera_right_id');
    }
}
