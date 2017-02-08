<?php

namespace App\Console\Commands;

use App\Camera;
use GuzzleHttp\Client;
use App\Lib\ParseData;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;

class CameraUpdateStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cameras = Camera::all();
        $client = new Client();
        $promises = [];
        foreach($cameras as $camera)
        {
            $promises[$camera->serial_number] = $client->getAsync('http://' . $camera->ip . '/gp/gpControl/status');
        }
        $results = Promise\unwrap($promises);
        $results = Promise\settle($promises)->wait();

        foreach($results as $serial_number => $raw)
        {
            $camera = $cameras->where('serial_number', $serial_number)->first();
            $response = $raw['value'];
            $body = $response->getBody()->getContents();
            $parsed = new ParseData($body, $camera->model_number);
            dd($parsed->data()->status);
        }
    }
}
