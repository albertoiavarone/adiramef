<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_statuses')->delete();
        
        \DB::table('order_statuses')->insert(array (
            0 => 
            array (
                'class' => 'secondary',
                'created_at' => '2022-12-28 12:22:05',
                'id' => 1,
                'name' => 'open',
                'position' => 1,
                'updated_at' => '2022-12-28 12:22:06',
            ),
            1 => 
            array (
                'class' => 'success',
                'created_at' => '2022-12-28 12:22:05',
                'id' => 2,
                'name' => 'closed',
                'position' => 2,
                'updated_at' => '2022-12-28 12:22:06',
            ),
            2 => 
            array (
                'class' => 'warning',
                'created_at' => '2022-12-28 12:22:05',
                'id' => 3,
                'name' => 'suspended',
                'position' => 3,
                'updated_at' => '2022-12-28 12:22:06',
            ),
            3 => 
            array (
                'class' => 'danger',
                'created_at' => '2022-12-28 12:22:05',
                'id' => 4,
                'name' => 'canceled',
                'position' => 4,
                'updated_at' => '2022-12-28 12:22:06',
            ),
        ));
        
        
    }
}