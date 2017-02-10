<?php

namespace App\Lib;

use App\Lib\ParseGoProData;

class ParseData
{
    protected $_parsed;

    public function __construct($json, $model_number = null)
    {
        $this->_parsed = (new ParseGoProData($json, $model_number))->toArray();
    }

    public function __get($name)
    {
        return $this->_parsed->{$name};
    }
}
