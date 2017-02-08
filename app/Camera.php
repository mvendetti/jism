<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
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
        'firmware_version'
    ];

    public function getMacColonsAttribute()
    {
        $mac = str_split($this->mac, 2);
        return implode($mac, ':');
    }
}
