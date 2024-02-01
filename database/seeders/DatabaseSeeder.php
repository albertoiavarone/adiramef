<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Roles&Permissions
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        //create admin default
        $user = User::create([
            'uuid' => Str::uuid()->toString(),
            'name' => config('values.DEFAULT_ADMIN_NAME'),
            'email' => config('values.DEFAULT_ADMIN_EMAIL'),
            'email_verified_at' => now(),
            'password' => Hash::make( config('values.DEFAULT_ADMIN_PASSWORD')),
            'code' => config('values.DEFAULT_ADMIN_CODE'),
            'phone_number' => config('values.DEFAULT_ADMIN_PHONE'),
            'phone_number_verified' => config('values.DEFAULT_ADMIN_PHONE_VERIFIED'),
            'language' => 'it',
            'timezone' => 'Europe/Rome',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole('superadmin');

        $this->call(RoleHasPermissionsTableSeeder::class);
        //Geo
        $this->call(NationsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(UserDetailsTableSeeder::class);
        $this->call(BuildersTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(MachineTypesTableSeeder::class);
        $this->call(MachinesTableSeeder::class);
        $this->call(WorksTableSeeder::class);
        $this->call(MachineSyncsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(MachineInfosTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(MachineManteinanceTypesTableSeeder::class);
        $this->call(MachineManteinanceStatusesTableSeeder::class);
    }
}
