<?php

namespace App\Lib;

use App\Key;

class ParseGoProData
{
    protected $keys;
    protected $rawData;
    protected $data;
    protected $parsed;

    public function __construct($data, $model_number = null)
    {
        $this->keys = $model_number ? Key::where('model_number', $model_number)->get() : collect();
        $this->rawData = $data;
        $this->parse();
    }

    protected function parse()
    {
        foreach($this->rawData as $subject => $data)
        {
            foreach($data as $k => $v)
            {
                $key = $this->keys->where('keytype', $subject)->where('gopro_id', $k)->first();
                if($key)
                {
                    $value = $v;
                    if(count($key->opts))
                    {
                        $value = isset($key->opts[$v])
                            ? $key->opts[$v]
                            : 'error - unknown';
                    }
                    $this->parsed[$subject][$key->value] = $value;
                }
            }
        }
    }

    public function get()
    {
        return $this->parsed;
    }
}
