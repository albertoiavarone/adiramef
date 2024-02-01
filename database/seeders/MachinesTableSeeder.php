<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MachinesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('machines')->delete();
        
        \DB::table('machines')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => 'cc996498-3ab9-4c6d-986f-9d48efac89e0',
                'builder_id' => 1,
                'machine_type_id' => 1,
                'provider_id' => NULL,
                'name' => 'IMP2528',
                'serial_number' => '2528CON',
                'purchase_date' => '2022-11-16',
                'sync_production' => 0,
                'sync_diagnostics' => 0,
                'gps' => 0,
                'options' => '[]',
                'host' => '192.168.1.1',
                'static_latitude' => '41.15442115559488',
                'static_longitude' => '14.04547159668457',
                'created_at' => '2023-09-26 09:27:55',
                'updated_at' => '2023-09-26 09:29:14',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}