<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MachineInfosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('machine_infos')->delete();
        
        \DB::table('machine_infos')->insert(array (
            0 => 
            array (
                'created_at' => '2023-09-26 09:27:55',
                'id' => 1,
                'info' => NULL,
                'machine_id' => 1,
                'updated_at' => '2023-09-26 09:27:55',
                'uuid' => 'ca830703-05bd-4d28-b089-0554f928d458',
            ),
            
        ));
        
        
    }
}