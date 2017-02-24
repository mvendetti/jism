<?php

namespace App;

use Illuminate\Support\Arr;
use App\Traits\ModelLoadedEventTrait;
use App\Traits\EnforceMacFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use ModelLoadedEventTrait, EnforceMacFormatTrait;

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
    public $incrementing = false;

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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'online' => 'bool',
        'is_recording' => 'bool',
    ];

    public function setSerialNumberAttribute($value)
    {
        $this->attributes['serial_number'] = strtoupper($value);
    }

    /**
     * The users that belong to the role.
     */
    public function pod()
    {
        return $this->belongsTo('App\Pod');
    }

    /**
     * The roles that belong to the user.
     */
    public function statuses()
    {
        return $this->hasMany('App\CameraStatus');
    }
}
