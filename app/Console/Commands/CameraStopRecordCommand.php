<?php

namespace App\Console\Commands;

use App\Camera;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;

class CameraStopRecordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:stop';

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
     public function handle()
     {
         $cameras = Camera::all();
         $client = new Client();
         $promises = [];
         foreach($cameras as $camera)
         {
             $promises[$camera->ip] = $client->getAsync('http://' . $camera->ip . '/gp/gpControl/command/shutter?p=0');
         }
         $results = Promise\unwrap($promises);
         $results = Promise\settle($promises)->wait();
     }
}
