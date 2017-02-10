<?php

namespace App\Lib;

use App\lib\BigData;
use App\Lib\ParseData;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\GuzzleException;

class HttpGroupGet
{
    protected $ips;
    protected $url;
    protected $protocol = 'http';
    protected $client;
    protected $requests;
    protected $pool;
    protected $results = [];

    public function __construct(array $ips, $url, $protocol = 'http', $timeout = 2.0)
    {
        $this->ips = $ips;
        $this->url = $url;
        $this->protocol = $protocol;
        $this->client = new Client(['timeout' => $timeout]);
        $this->requests = $this->buildRequests($this->client, $ips);
        $this->pool = $this->buildPool($this->client, $this->requests, count($ips));
    }

    public function run()
    {
        $promise = $this->pool->promise();
        $promise->wait();

        return new BigData($this->results);
    }

    protected function buildPool($client, $requests, $concurrency)
    {
        return new Pool($client, $requests(), [
            'concurrency' => $concurrency,
            'fulfilled' => $this->buildFulfilledHandler(),
            'rejected' => $this->buildRejectedHandler()
        ]);
    }

    protected function buildRequests($client, $ips)
    {
        return function () use ($client, $ips)
        {
            foreach($ips as $ip)
            {
               $uri = $this->protocol . '://' . $ip . $this->url;
               yield  $ip => new Request('Get', $uri);
            }
        };
    }

    protected function buildFulfilledHandler()
    {
        return function($response, $index)
        {
            $body = $response->getBody()->getContents();
            $data = new ParseData($body, 13);
            $this->results['succeeded'][$index] = [
                'ip' => $index,
                'data' => $data
            ];
        };
    }

    protected function buildRejectedHandler()
    {
        return function($reason, $index)
        {
            $host = $reason->getRequest()->getUri()->getHost();
            $this->results['failed'][] = [
                'ip' => $host,
                'reason' => $reason
            ];
        };
    }
}
