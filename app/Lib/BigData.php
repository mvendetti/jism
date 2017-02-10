<?php

namespace App\Lib;

class BigData
{
    protected $data;

    public function __construct( array $data )
    {
        $this->data = $this->_collectifyData($data);
    }

    protected function _collectifyData($data)
    {
        foreach($data as $key => $value)
        {
            if(is_array($value))
            {
                $data[$key] = collect($this->_collectifyData($value));
            }
        }
        return $data;
    }

    public function __get( $key )
    {
        if( ! isset( $this->data[ $key ] ) )
        {
            return null;
        }
        return $this->data[ $key ];
    }
}
