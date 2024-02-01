<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MachineManteinanceStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('machine_manteinance_statuses')->delete();
        
        \DB::table('machine_manteinance_statuses')->insert(array (
            0 => 
            array (
                'active' => 1,
                'class' => 'warning',
                'created_at' => '2023-02-23 09:35:41',
                'id' => 1,
                'name' => 'Pianificato',
                'position' => 1,
                'updated_at' => '2023-02-23 09:35:42',
            ),
            1 => 
            array (
                'active' => 1,
                'class' => 'success',
                'created_at' => '2023-02-23 09:36:20',
                'id' => 2,
                'name' => 'Eseguito',
                'position' => 2,
                'updated_at' => '2023-02-23 09:36:20',
            ),
            2 => 
            array (
                'active' => 1,
                'class' => 'danger',
                'created_at' => '2023-02-23 09:36:39',
                'id' => 3,
                'name' => 'Annullato',
                'position' => 3,
                'updated_at' => '2023-02-23 09:36:40',
            ),
        ));
        
        
    }
}