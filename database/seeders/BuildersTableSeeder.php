<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BuildersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('builders')->delete();
        
        \DB::table('builders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => 'b14cd5c8-cd1c-4145-a3e8-95e8ccdcb1df',
                'name' => 'HP',
                'logo_path' => 'builders/b14cd5c8-cd1c-4145-a3e8-95e8ccdcb1df.png',
                'created_at' => '2023-09-26 09:18:03',
                'updated_at' => '2024-02-01 08:48:50',
            ),
        ));
        
        
    }
}