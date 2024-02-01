<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Production\Machine;
use App\Jobs\MachineSyncJob;
use App\Jobs\MachineLogsSyncJob;


class syncMachineCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'syncMachine:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'machine synchronization';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->debug = true;
        $this->waiting_time = 2; //seconds
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $machines = Machine::orderBy('gps', 'ASC')->get();
        $provider_id = null;

        foreach($machines as $machine){

            if($machine->sync_production){
                if($this->debug) echo 'syncMachine:cron '.$machine->name."\n".'<br /><br />';

                if( data_get($machine, 'provider.id') > 0 && $provider_id == data_get($machine, 'provider.id')){
                  if($this->debug) echo 'Wait for '.$this->waiting_time.' seconds '  ."\n\n";
                  sleep($this->waiting_time);
                }

                $sync_machine = new MachineSyncJob($machine);
                dispatch($sync_machine);

                $provider_id = data_get($machine, 'provider.id');
            }
        }
        if($this->debug) echo "\n"."\n".'Comando syncMachine: eseguito '."\n";
        return 0;
    }
}
