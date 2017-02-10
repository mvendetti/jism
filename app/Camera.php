<?php

namespace App;

use App\Traits\EnforceMacFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use EnforceMacFormatTrait;

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
}
