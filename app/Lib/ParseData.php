<?php

namespace App\Lib;

use App\Key;

class ParseData
{
    protected $_keys;
    protected $_rawJson;
    protected $_rawData;
    public $data;

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
                    $this->data[$subject][$key->value] = $value;
                }
                else
                {
                    $this->data[$subject][$k] = $v;
                }
            }
        }
    }

    public function data()
    {
        $bigD = new \App\Lib\BigData($this->data);
        return $bigD;
    }
}
