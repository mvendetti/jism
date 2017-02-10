<?php

namespace App\Lib;

class BigData
{
    protected $data;

    public function __construct( array $data )
    {
        $this->data = $data;
    }

    public function __get( $key )
    {
        if( ! isset( $this->data[ $key ] ) )
        {
            return null;
        }
        if( is_array( $this->data[ $key ] ) )
        {
            $this->data[ $key ] = new BigData( $this->data[ $key ] );
        }
        return $this->data[ $key ];
    }
}
