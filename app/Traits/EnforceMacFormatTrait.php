<?php

namespace App\Traits;

trait EnforceMacFormatTrait
{
    public function setMacAttribute($value)
    {
        $value = str_replace([' ', '-', ':', '_'], '', $value);
        $value = str_split($value, 2);
        $value = implode(":", array_filter($value));
        $this->attributes['mac'] = strtoupper($value);
    }
}
