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
            1 => 
            array (
                'id' => 2,
                'uuid' => 'fcb0baa3-8a31-4274-982f-335549d53173',
                'name' => 'Notebook',
                'logo_path' => 'machine_types/fcb0baa3-8a31-4274-982f-335549d53173.png',
                'created_at' => '2024-02-02 10:27:57',
                'updated_at' => '2024-02-02 10:58:38',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => 'a9f29048-0233-4e2c-a898-031c4531bede',
                'name' => 'Server',
                'logo_path' => 'machine_types/a9f29048-0233-4e2c-a898-031c4531bede.png',
                'created_at' => '2024-02-02 12:12:57',
                'updated_at' => '2024-02-02 12:12:57',
            ),
            3 => 
            array (
                'id' => 4,
                'uuid' => '0244a114-5f07-4574-8f38-404db1df992d',
                'name' => 'Stampanti',
                'logo_path' => 'machine_types/0244a114-5f07-4574-8f38-404db1df992d.jpg',
                'created_at' => '2024-02-06 17:01:24',
                'updated_at' => '2024-02-06 17:01:25',
            ),
            4 => 
            array (
                'id' => 5,
                'uuid' => 'ae828d31-2218-4499-86ea-8f4006dd5908',
                'name' => 'Strumentazione',
                'logo_path' => 'machine_types/ae828d31-2218-4499-86ea-8f4006dd5908.jpg',
                'created_at' => '2024-02-15 10:03:26',
                'updated_at' => '2024-02-15 10:03:27',
            ),
            5 => 
            array (
                'id' => 6,
                'uuid' => '6445d080-f5cf-4537-ac45-86dcf9e1e127',
                'name' => 'Apparecchiature elettromedicali',
                'logo_path' => 'machine_types/6445d080-f5cf-4537-ac45-86dcf9e1e127.png',
                'created_at' => '2024-02-15 10:58:10',
                'updated_at' => '2024-02-15 11:29:59',
            ),
            6 => 
            array (
                'id' => 7,
                'uuid' => '53a477c0-17cd-47ea-84b9-9f8badfc649a',
                'name' => 'Linea freddo',
                'logo_path' => 'machine_types/53a477c0-17cd-47ea-84b9-9f8badfc649a.png',
                'created_at' => '2024-02-16 10:19:04',
                'updated_at' => '2024-02-16 10:19:04',
            ),
            7 => 
            array (
                'id' => 8,
                'uuid' => '664dd7d5-fc04-4f47-bd8d-3d266e7b040f',
                'name' => 'Tablet',
                'logo_path' => 'machine_types/664dd7d5-fc04-4f47-bd8d-3d266e7b040f.png',
                'created_at' => '2024-02-19 09:54:08',
                'updated_at' => '2024-02-19 09:54:08',
            ),
        ));
        
        
    }
}