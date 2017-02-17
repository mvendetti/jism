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
    protected $results = ['successful' => [], 'failed' => []];

    public function __construct(array $ips, $url, $protocol = 'http', $timeout = 2.0)
    {
        $this->ips = $ips;
        $this->url = $url;
        $this->protocol = $protocol;
        $this->client = new Client(['timeout' => $timeout]);
        $this->requests = $this->buildRequests($this->client, $ips);
        $this->pool = $this->buildPool($this->client, $this->requests, count($ips));
        $promise = $this->pool->promise();
        $promise->wait();
    }

    public function hasSuccessful()
    {
        return count($this->results['successful']) > 0;
    }

    public function hasFailed()
    {
        return count($this->results['failed']) > 0;
    }

    public function getSuccessful()
    {
        return $this->results['successful'];
    }

    public function getFailed()
    {
        return $this->results['failed'];
    }

    public function getSuccessfulIps()
    {
        return array_keys($this->results['successful']);
    }

    public function getFailedIps()
    {
        return array_keys($this->results['failed']);
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
            $this->results['successful'][$index] = $response->getBody()->getContents();
        };
    }

    protected function buildRejectedHandler()
    {
        return function($reason, $index)
        {
            $this->results['failed'][$index] = $reason;
        };
    }
}
