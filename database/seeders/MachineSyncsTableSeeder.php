<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MachineSyncsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('machine_syncs')->delete();
        
        
        
    }
}