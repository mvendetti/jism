<?php

namespace App\Lib;

use ArrayIterator;
use IteratorAggregate;

class BigData implements IteratorAggregate

{
    protected $data;

    public function __construct( array $data )
    {
        $this->data = $this->_preparseData($data);
    }
    public function getIterator()
    {
    	return new ArrayIterator( $this->data );
    }
    public function __get( $key )
    {
        if( ! isset( $this->data[ $key ] ) )
        {
            return null;
        }
        return $this->data[ $key ];
    }
    protected function _preparseData( $data )
    {
        foreach($data as $key => $value)
        {
            if( is_array( $value ) )
            {
                $data[$key] = new BigData($value);
            }
        }
        return $data;
    }
}
