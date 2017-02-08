<?php

namespace App\Traits;

trait EnforceMacFormatTrait
{
    public function setMacAttribute($value)
    {
        $value = preg_split( "( |\:|\-)", $value );
        $value = implode(":", array_filter($value));
        $this->attributes['mac'] = strtoupper($value);
    }
}
