<?php

namespace App\Lib;

use App\Camera;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\GuzzleException;

class Status
{
    protected $cameras;


    public function __construct()
    {
        $this->cameras = Camera::all();
    }

    public function get()
    {
        // $client = new Client(['base_uri' => 'http://10.5.5.9/gp/gpControl/']);
        // $req =  new Request('GET', 'status');
        // $res = $client->send($req);
        // $this->_rawStatus = json_decode($res->getBody()->getContents(), true);

        $client = new Client();
        $promises = [];
        foreach($this->cameras as $camera)
        {
            $promises[$camera->serial_number] = $client->getAsync('http://' . $camera->ip . '/gp/gpControl/status');
        }
        $results = Promise\unwrap($promises);
        $results = Promise\settle($promises)->wait();

        foreach($results as $serial_number => $raw)
        {
            $camera = $this->cameras->where('serial_number', $serial_number)->first();
            $response = $raw['value'];
            $body = $response->getBody()->getContents();
            $data = new ParseData($body, $camera->model_number);
            dd($data->data()->status);
        }
    }
}
