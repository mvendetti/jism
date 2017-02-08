<?php

namespace App;

use App\Traits\EnforceMacFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    use EnforceMacFormatTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mac', 'ip', 'hostname',
    ];

    static public function getGoPros()
    {
        return self::where('mac', 'like', 'D4:D9:19:%')->get();
    }
}
