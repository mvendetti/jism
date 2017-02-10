<?php

namespace App\Lib;

use App\Key;

class ParseGoProData
{
    protected $_keys;
    protected $_rawJson;
    protected $_rawData;
    protected $_data;
    protected $_parsed;

    public function __construct($json, $model_number = null)
    {
        $this->_keys = $model_number ? Key::where('model_number', $model_number)->get() : collect();
        $this->_rawJson = $json;
        $this->_rawStatus = json_decode($this->_rawJson, true);
        $this->_parse();
    }

    protected function _parse()
    {
        foreach($this->_rawStatus as $subject => $data)
        {
            foreach($data as $k => $v)
            {
                $key = $this->_keys->where('gopro_id', $k)->first();
                if($key)
                {
                    $value = $v;
                    if(count($key->opts))
                    {
                        $value = $key->opts[$v];
                    }
                    $this->_data[$subject][$key->value] = $value;
                }
                else
                {
                    $this->_data[$subject][$k] = $v;
                }
            }
        }
        $this->_parsed = new \App\Lib\BigData($this->_data);
    }

    public function toArray()
    {
        return $this->_parsed;
    }
}
