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
}
