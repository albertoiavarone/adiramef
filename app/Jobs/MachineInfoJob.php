<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Production\Machine;
use App\Classes\Machines;

class MachineInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public function __construct($data)
     {
         $this->data = $data;
     }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Machine = new Machines();
        $data = $this->data;
        $debug = true;
        if($debug) echo 'Queued info machine: '.$data->builder->name.' - '.$data->name.' - '.$data->serial_number."\n";
        $response = $Machine->infoMachine($data);
        if($debug) echo 'response status: '.$response."\n";
        return 0;
    }
}
