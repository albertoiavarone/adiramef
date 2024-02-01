<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'superadmin',
                'guard_name' => 'web',
                'rank' => 1,
                'default' => 0,
                'on_register' => 0,
                'created_at' => '2021-05-20 15:01:42',
                'updated_at' => '2023-01-04 13:25:07',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'operator',
                'guard_name' => 'web',
                'rank' => 3,
                'default' => 1,
                'on_register' => 0,
                'created_at' => '2021-05-20 15:01:59',
                'updated_at' => '2021-05-25 16:32:17',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'admin',
                'guard_name' => 'web',
                'rank' => 2,
                'default' => 0,
                'on_register' => 0,
                'created_at' => '2022-12-20 11:42:22',
                'updated_at' => '2023-01-04 13:25:07',
            ),
        ));
        
        
    }
}