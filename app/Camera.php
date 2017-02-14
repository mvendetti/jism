<?php

namespace App;

use Illuminate\Support\Arr;
use App\Traits\EnforceMacFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use EnforceMacFormatTrait;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'serial_number';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    protected $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_number',
        'ip',
        'mac',
        'ssid',
        'model_number',
        'model_name',
        'firmware_version',
        'online'
    ];

    public function setSerialNumberAttribute($value)
    {
        $this->attributes['serial_number'] = strtoupper($value);
    }

    /**
     * The users that belong to the role.
     */
    public function pods()
    {
        return $this->belongsToMany('App\Pod', 'camera_pod', 'serial_number', 'pod_id');
    }
}
