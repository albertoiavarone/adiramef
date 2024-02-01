<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('user_details')->delete();

        \DB::table('user_details')->insert(array (
            0 =>
            array (
                'id' => 1,
                'uuid' => '5dca0923-444a-4b5c-970a-ae147f0dbb6b',
                'user_id' => 1,
                'label' => 'Alberto',
                'is_default' => 1,
                'name' => 'Alberto',
                'surname' => 'Iavarone',
                'vat_number' => '12346579801',
                'fiscal_code' => 'VRNLRT72M30I234V',
                'nation_id' => 110,
                'province_id' => 22,
                'city_id' => 5799,
                'address' => 'Via Roma',
                'address_number' => '22',
                'postal_code' => '81031',
                'email' => 'a.iavarone@example.com',
                'pec' => 'a.iavarone@pec.it',
                'phone_number' => '+393495535231',
                'notes' => 'lore ipsum',
                'created_at' => '2021-06-16 14:53:51',
                'updated_at' => '2021-06-16 14:53:54',
            ),

        ));


    }
}
