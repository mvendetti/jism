<?php

namespace App;

use App\Pod;
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
        'online',
        'settings'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'online' => 'bool',
        'is_recording' => 'bool',
        'settings' => 'array',
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

    public function setPodSide(array $data)
    {
        $pod_id = array_key_exists('pod_id', $data)
            ? $data['pod_id']
            : abort(400, 'pod_id key not found');
        $side = array_key_exists('pod_side', $data)
            ? studly_case($data['pod_side'])
            : abort(400, 'pod_side key not found');
        return method_exists($this, 'setPod'.$side)
            ? call_user_func([$this, 'setPod'.$side], Pod::findOrFail($pod_id))
            : abort(400, 'Invalid side '.$side);
    }

    public function setPodNull()
    {
        $this->pod_id = null;
        $this->pod_side = null;
        $this->save();
    }

    public function setPodLeft(Pod $pod)
    {
        $this->pod_id = $pod->id;
        $this->pod_side = 'left';
        $this->save();
    }

    public function setPodRight(Pod $pod)
    {
        $this->pod_id = $pod->id;
        $this->pod_side = 'right';
        $this->save();
    }

    public function setOnline()
    {
        $this->online = true;
        $this->save();
    }

    public function setOffline()
    {
        $this->online = false;
        $this->is_recording = false;
        $this->save();
    }
}
