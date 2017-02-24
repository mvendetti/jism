<?php

namespace App\Lib\CamApis;

use App\Lib\HttpGroupGet;

abstract class Base
{
    /**
     * Returns the endpoint for the call
     *
     * @var string
     */
    abstract public function getUrl();

    protected $ips = [];
    protected $retry_failed = true;
    protected $results = ['successful' => [], 'failed' => []];

    public function __construct(array $ips, $retry_failed = true)
    {
        $this->ips = $ips;
        $this->retry_failed = $retry_failed;
        $this->callApi();
    }

    /**
     * Execute the api call
     *
     * @return mixed
     */

     protected function callApi()
     {
        $results = new HttpGroupGet($this->ips, $this->getUrl());

        $this->results['successful'] = $results->getSuccessful();

        if($this->retry_failed)
        {
            $results = new HttpGroupGet($results->getFailedIps(), $this->getUrl());
        }

        $this->results['failed'] = $results->getFailed();
    }

    public function hasSuccessful($ip = null)
    {
        return $this->has('successful', $ip);
    }

    public function hasFailed($ip = null)
    {
        return $this->has('failed', $ip);
    }

    public function has($key, $ip = null)
    {
        if($ip)
        {
            return array_key_exists($ip, $this->results[$key])
                ? true
                : false;
        }
        return count($this->results[$key]) > 0;
    }

    public function getSuccessful($ip = null)
    {
        return $this->get('successful', $ip);
    }

    public function getFailed($ip = null)
    {
        return $this->get('failed', $ip);
    }

    public function get($key, $ip = null)
    {
        if($ip)
        {
            return array_key_exists($ip, $this->results[$key])
                ? $this->results[$key][$ip]
                : null;
        }
        return $this->results[$key];
    }

    public function getSuccessfulIps()
    {
        return array_keys($this->results['successful']);
    }

    public function getFailedIps()
    {
        return array_keys($this->results['failed']);
    }
}
