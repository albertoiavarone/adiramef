<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Production\Machine;
use App\Jobs\MachineInfoJob;


class infoMachineCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'infoMachine:cron';

     /**
      * The console command description.
      *
      * @var string
      */
     protected $description = 'machine info update';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->debug = true;
        $this->waiting_time = 5; //seconds
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $machines = Machine::all();
      $provider_id = null;

      foreach($machines as $machine){

          if(!$machine->gps || !$machine->sync_diagnostics){
            if($this->debug) echo 'Continue...'."\n\n";
              continue;
          }

          if($this->debug) echo 'infoMachine:cron '.$machine->name." [".$machine->provider->name."]\n\n";

          if($provider_id == $machine->provider->id){
            if($this->debug) echo 'Wait for '.$this->waiting_time.' seconds '  ."\n\n";
            sleep($this->waiting_time);
          }

          $info_machine = new MachineInfoJob($machine);
          dispatch($info_machine);
          $provider_id = $machine->provider->id;

    }
      if($this->debug) echo "\n\n".'Comando infoMachine: eseguito '."\n";
      return 0;
    }
}
