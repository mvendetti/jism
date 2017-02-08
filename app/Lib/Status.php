<?php

namespace App\Lib;

use App\Key;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\GuzzleException;

class Status
{
    protected $_keys;
    protected $_rawStatus;
    protected $status;


    public function __construct()
    {
        $this->keys = Key::where('model_number', 13)->get();
    }

    public function get()
    {
        $client = new Client(['base_uri' => 'http://10.5.5.9/gp/gpControl/']);
        $req =  new Request('GET', 'status');
        $res = $client->send($req);
        $this->_rawStatus = json_decode($res->getBody()->getContents(), true);

        foreach($this->_rawStatus['status'] as $k => $v)
        {
            $key = $this->keys->where('gopro_id', $k)->first();
            if($key)
            {
                $value = $v;
                if(count($key->opts))
                {
                    $value = $key->opts[$v];
                }
                $this->status[$key->value] = $value;
            }
            else
            {
                $this->status[$k] = $v;
            }
        }
        dd($this->status);
    }
}
