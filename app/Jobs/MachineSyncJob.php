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

class MachineSyncJob implements ShouldQueue
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
        echo 'Queued machine: '.$data->builder->name.' - '.$data->name.' - '.$data->serial_number."\n";
        $response = $Machine->syncMachine($data);
        echo 'response status: '.$response."\n";
        return 0;
    }
}
