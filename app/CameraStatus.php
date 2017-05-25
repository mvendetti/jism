<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CameraStatus extends Model
{
    /**
     * Autodelete records after N minutes.
     * @var integer
     */
    public $lifetime = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'camera_serial_number',
        'raw',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'raw' => 'array',
        'parsed' => 'array',
        'unparsed' => 'array',
    ];

    /**
     * The users that belong to the role.
     */
    public function camera()
    {
        return $this->belongsTo('App\Camera');
    }
}
