<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MachineTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('machine_types')->delete();
        
        \DB::table('machine_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => '1be25cb4-273a-4075-b462-89431aa4f3eb',
                'name' => 'Personal Computer',
                'logo_path' => 'machine_types/1be25cb4-273a-4075-b462-89431aa4f3eb.png',
                'created_at' => '2023-09-28 08:18:15',
                'updated_at' => '2024-02-01 08:50:13',
            ),
        ));
        
        
    }
}