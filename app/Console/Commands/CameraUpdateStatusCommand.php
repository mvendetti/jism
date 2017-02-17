<?php

namespace App\Console\Commands;

use App\Camera;
use Illuminate\Console\Command;
use App\Actions\Cameras\UpdateStatusAction;

class CameraUpdateStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:status {--camera=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update camera status information';

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
        UpdateStatusAction::run($this->getCameras());
    }

    /**
     * Gets all of the cameras specified in the command options. Gets all
     * cameras if no options are specified.
     *
     * @return Collection
     */
    protected function getCameras()
    {
        $cameras = Camera::whereIn('serial_number', $this->option('camera'))->get();
        if(! $cameras)
        {
            return Camera::all();
        }
        return Camera::all();
    }
}
