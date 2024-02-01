<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'created_at' => '2021-05-27 17:49:41',
                'description' => 'Gestione Ruoli -  create',
                'group' => 'roles',
                'guard_name' => 'web',
                'id' => 1,
                'name' => 'roles_c',
                'updated_at' => '2021-05-27 17:49:41',
            ),
            1 => 
            array (
                'created_at' => '2021-05-27 17:49:41',
                'description' => 'Gestione Ruoli -  read',
                'group' => 'roles',
                'guard_name' => 'web',
                'id' => 2,
                'name' => 'roles_r',
                'updated_at' => '2021-05-27 17:49:41',
            ),
            2 => 
            array (
                'created_at' => '2021-05-27 17:49:41',
                'description' => 'Gestione Ruoli -  update',
                'group' => 'roles',
                'guard_name' => 'web',
                'id' => 3,
                'name' => 'roles_u',
                'updated_at' => '2021-05-27 17:49:41',
            ),
            3 => 
            array (
                'created_at' => '2021-05-27 17:49:41',
                'description' => 'Gestione Ruoli -  delete',
                'group' => 'roles',
                'guard_name' => 'web',
                'id' => 4,
                'name' => 'roles_d',
                'updated_at' => '2021-05-27 17:49:41',
            ),
            4 => 
            array (
                'created_at' => '2021-05-27 17:50:17',
                'description' => 'Gestione Permessi -  create',
                'group' => 'permissions',
                'guard_name' => 'web',
                'id' => 5,
                'name' => 'permissions_c',
                'updated_at' => '2021-05-27 17:50:17',
            ),
            5 => 
            array (
                'created_at' => '2021-05-27 17:50:17',
                'description' => 'Gestione Permessi -  read',
                'group' => 'permissions',
                'guard_name' => 'web',
                'id' => 6,
                'name' => 'permissions_r',
                'updated_at' => '2021-05-27 17:50:17',
            ),
            6 => 
            array (
                'created_at' => '2021-05-27 17:50:17',
                'description' => 'Gestione Permessi -  update',
                'group' => 'permissions',
                'guard_name' => 'web',
                'id' => 7,
                'name' => 'permissions_u',
                'updated_at' => '2021-05-27 17:50:17',
            ),
            7 => 
            array (
                'created_at' => '2021-05-27 17:50:17',
                'description' => 'Gestione Permessi -  delete',
                'group' => 'permissions',
                'guard_name' => 'web',
                'id' => 8,
                'name' => 'permissions_d',
                'updated_at' => '2021-05-27 17:50:17',
            ),
            8 => 
            array (
                'created_at' => '2021-06-22 14:38:08',
                'description' => 'Gestione Nazioni -  create',
                'group' => 'geo_nations',
                'guard_name' => 'web',
                'id' => 9,
                'name' => 'geo_nations_c',
                'updated_at' => '2021-06-22 14:38:08',
            ),
            9 => 
            array (
                'created_at' => '2021-06-22 14:38:08',
                'description' => 'Gestione Nazioni -  read',
                'group' => 'geo_nations',
                'guard_name' => 'web',
                'id' => 10,
                'name' => 'geo_nations_r',
                'updated_at' => '2021-06-22 14:38:08',
            ),
            10 => 
            array (
                'created_at' => '2021-06-22 14:38:08',
                'description' => 'Gestione Nazioni -  update',
                'group' => 'geo_nations',
                'guard_name' => 'web',
                'id' => 11,
                'name' => 'geo_nations_u',
                'updated_at' => '2021-06-22 14:38:08',
            ),
            11 => 
            array (
                'created_at' => '2021-06-22 14:38:08',
                'description' => 'Gestione Nazioni -  delete',
                'group' => 'geo_nations',
                'guard_name' => 'web',
                'id' => 12,
                'name' => 'geo_nations_d',
                'updated_at' => '2021-06-22 14:38:08',
            ),
            12 => 
            array (
                'created_at' => '2021-06-22 14:38:25',
                'description' => 'Gestione Province -  create',
                'group' => 'geo_provinces',
                'guard_name' => 'web',
                'id' => 13,
                'name' => 'geo_provinces_c',
                'updated_at' => '2021-06-22 14:38:25',
            ),
            13 => 
            array (
                'created_at' => '2021-06-22 14:38:25',
                'description' => 'Gestione Province -  read',
                'group' => 'geo_provinces',
                'guard_name' => 'web',
                'id' => 14,
                'name' => 'geo_provinces_r',
                'updated_at' => '2021-06-22 14:38:25',
            ),
            14 => 
            array (
                'created_at' => '2021-06-22 14:38:25',
                'description' => 'Gestione Province -  update',
                'group' => 'geo_provinces',
                'guard_name' => 'web',
                'id' => 15,
                'name' => 'geo_provinces_u',
                'updated_at' => '2021-06-22 14:38:25',
            ),
            15 => 
            array (
                'created_at' => '2021-06-22 14:38:25',
                'description' => 'Gestione Province -  delete',
                'group' => 'geo_provinces',
                'guard_name' => 'web',
                'id' => 16,
                'name' => 'geo_provinces_d',
                'updated_at' => '2021-06-22 14:38:25',
            ),
            16 => 
            array (
                'created_at' => '2021-06-22 14:38:46',
                'description' => 'Gestione Città -  create',
                'group' => 'geo_cities',
                'guard_name' => 'web',
                'id' => 17,
                'name' => 'geo_cities_c',
                'updated_at' => '2021-06-22 14:38:46',
            ),
            17 => 
            array (
                'created_at' => '2021-06-22 14:38:46',
                'description' => 'Gestione Città -  read',
                'group' => 'geo_cities',
                'guard_name' => 'web',
                'id' => 18,
                'name' => 'geo_cities_r',
                'updated_at' => '2021-06-22 14:38:46',
            ),
            18 => 
            array (
                'created_at' => '2021-06-22 14:38:46',
                'description' => 'Gestione Città -  update',
                'group' => 'geo_cities',
                'guard_name' => 'web',
                'id' => 19,
                'name' => 'geo_cities_u',
                'updated_at' => '2021-06-22 14:38:46',
            ),
            19 => 
            array (
                'created_at' => '2021-06-22 14:38:46',
                'description' => 'Gestione Città -  delete',
                'group' => 'geo_cities',
                'guard_name' => 'web',
                'id' => 20,
                'name' => 'geo_cities_d',
                'updated_at' => '2021-06-22 14:38:46',
            ),
            20 => 
            array (
                'created_at' => '2021-06-22 14:39:09',
                'description' => 'Gestione Utenti -  create',
                'group' => 'users',
                'guard_name' => 'web',
                'id' => 21,
                'name' => 'users_c',
                'updated_at' => '2021-06-22 14:39:09',
            ),
            21 => 
            array (
                'created_at' => '2021-06-22 14:39:09',
                'description' => 'Gestione Utenti -  read',
                'group' => 'users',
                'guard_name' => 'web',
                'id' => 22,
                'name' => 'users_r',
                'updated_at' => '2021-06-22 14:39:09',
            ),
            22 => 
            array (
                'created_at' => '2021-06-22 14:39:09',
                'description' => 'Gestione Utenti -  update',
                'group' => 'users',
                'guard_name' => 'web',
                'id' => 23,
                'name' => 'users_u',
                'updated_at' => '2021-06-22 14:39:09',
            ),
            23 => 
            array (
                'created_at' => '2021-06-22 14:39:10',
                'description' => 'Gestione Utenti -  delete',
                'group' => 'users',
                'guard_name' => 'web',
                'id' => 24,
                'name' => 'users_d',
                'updated_at' => '2021-06-22 14:39:10',
            ),
            24 => 
            array (
                'created_at' => '2021-06-22 14:39:31',
                'description' => 'Anagrafiche/Profili Fatturazione Utente -  create',
                'group' => 'user_details',
                'guard_name' => 'web',
                'id' => 25,
                'name' => 'user_details_c',
                'updated_at' => '2021-06-22 14:39:31',
            ),
            25 => 
            array (
                'created_at' => '2021-06-22 14:39:31',
                'description' => 'Anagrafiche/Profili Fatturazione Utente -  read',
                'group' => 'user_details',
                'guard_name' => 'web',
                'id' => 26,
                'name' => 'user_details_r',
                'updated_at' => '2021-06-22 14:39:31',
            ),
            26 => 
            array (
                'created_at' => '2021-06-22 14:39:31',
                'description' => 'Anagrafiche/Profili Fatturazione Utente -  update',
                'group' => 'user_details',
                'guard_name' => 'web',
                'id' => 27,
                'name' => 'user_details_u',
                'updated_at' => '2021-06-22 14:39:31',
            ),
            27 => 
            array (
                'created_at' => '2021-06-22 14:39:31',
                'description' => 'Anagrafiche/Profili Fatturazione Utente -  delete',
                'group' => 'user_details',
                'guard_name' => 'web',
                'id' => 28,
                'name' => 'user_details_d',
                'updated_at' => '2021-06-22 14:39:31',
            ),
            28 => 
            array (
                'created_at' => '2022-04-04 13:54:13',
                'description' => 'Gestione Costruttori Apparecchiature -  create',
                'group' => 'builders',
                'guard_name' => 'web',
                'id' => 29,
                'name' => 'builders_c',
                'updated_at' => '2022-04-04 13:54:13',
            ),
            29 => 
            array (
                'created_at' => '2022-04-04 13:54:13',
                'description' => 'Gestione Costruttori Apparecchiature -  read',
                'group' => 'builders',
                'guard_name' => 'web',
                'id' => 30,
                'name' => 'builders_r',
                'updated_at' => '2022-04-04 13:54:13',
            ),
            30 => 
            array (
                'created_at' => '2022-04-04 13:54:13',
                'description' => 'Gestione Costruttori Apparecchiature -  update',
                'group' => 'builders',
                'guard_name' => 'web',
                'id' => 31,
                'name' => 'builders_u',
                'updated_at' => '2022-04-04 13:54:13',
            ),
            31 => 
            array (
                'created_at' => '2022-04-04 13:54:13',
                'description' => 'Gestione Costruttori Apparecchiature -  delete',
                'group' => 'builders',
                'guard_name' => 'web',
                'id' => 32,
                'name' => 'builders_d',
                'updated_at' => '2022-04-04 13:54:13',
            ),
            32 => 
            array (
                'created_at' => '2022-04-04 13:54:37',
                'description' => 'Gestione Tipologie Apparecchiature -  create',
                'group' => 'machine_types',
                'guard_name' => 'web',
                'id' => 33,
                'name' => 'machine_types_c',
                'updated_at' => '2022-04-04 13:54:37',
            ),
            33 => 
            array (
                'created_at' => '2022-04-04 13:54:37',
                'description' => 'Gestione Tipologie Apparecchiature -  read',
                'group' => 'machine_types',
                'guard_name' => 'web',
                'id' => 34,
                'name' => 'machine_types_r',
                'updated_at' => '2022-04-04 13:54:37',
            ),
            34 => 
            array (
                'created_at' => '2022-04-04 13:54:37',
                'description' => 'Gestione Tipologie Apparecchiature -  update',
                'group' => 'machine_types',
                'guard_name' => 'web',
                'id' => 35,
                'name' => 'machine_types_u',
                'updated_at' => '2022-04-04 13:54:37',
            ),
            35 => 
            array (
                'created_at' => '2022-04-04 13:54:37',
                'description' => 'Gestione Tipologie Apparecchiature -  delete',
                'group' => 'machine_types',
                'guard_name' => 'web',
                'id' => 36,
                'name' => 'machine_types_d',
                'updated_at' => '2022-04-04 13:54:37',
            ),
            36 => 
            array (
                'created_at' => '2022-04-04 13:55:51',
                'description' => 'Gestione Lavorazioni -  create',
                'group' => 'works',
                'guard_name' => 'web',
                'id' => 37,
                'name' => 'works_c',
                'updated_at' => '2022-04-04 13:55:51',
            ),
            37 => 
            array (
                'created_at' => '2022-04-04 13:55:51',
                'description' => 'Gestione Lavorazioni -  read',
                'group' => 'works',
                'guard_name' => 'web',
                'id' => 38,
                'name' => 'works_r',
                'updated_at' => '2022-04-04 13:55:51',
            ),
            38 => 
            array (
                'created_at' => '2022-04-04 13:55:51',
                'description' => 'Gestione Lavorazioni -  update',
                'group' => 'works',
                'guard_name' => 'web',
                'id' => 39,
                'name' => 'works_u',
                'updated_at' => '2022-04-04 13:55:51',
            ),
            39 => 
            array (
                'created_at' => '2022-04-04 13:55:51',
                'description' => 'Gestione Lavorazioni -  delete',
                'group' => 'works',
                'guard_name' => 'web',
                'id' => 40,
                'name' => 'works_d',
                'updated_at' => '2022-04-04 13:55:51',
            ),
            40 => 
            array (
                'created_at' => '2022-04-04 16:01:44',
                'description' => 'Gestione Macchine -  create',
                'group' => 'machines',
                'guard_name' => 'web',
                'id' => 41,
                'name' => 'machines_c',
                'updated_at' => '2022-04-04 16:01:44',
            ),
            41 => 
            array (
                'created_at' => '2022-04-04 16:01:44',
                'description' => 'Gestione Macchine -  read',
                'group' => 'machines',
                'guard_name' => 'web',
                'id' => 42,
                'name' => 'machines_r',
                'updated_at' => '2022-04-04 16:01:44',
            ),
            42 => 
            array (
                'created_at' => '2022-04-04 16:01:44',
                'description' => 'Gestione Macchine -  update',
                'group' => 'machines',
                'guard_name' => 'web',
                'id' => 43,
                'name' => 'machines_u',
                'updated_at' => '2022-04-04 16:01:44',
            ),
            43 => 
            array (
                'created_at' => '2022-04-04 16:01:44',
                'description' => 'Gestione Macchine -  delete',
                'group' => 'machines',
                'guard_name' => 'web',
                'id' => 44,
                'name' => 'machines_d',
                'updated_at' => '2022-04-04 16:01:44',
            ),
            44 => 
            array (
                'created_at' => '2022-04-08 06:57:23',
                'description' => 'Gestione Sincronizzazioni -  create',
                'group' => 'syncs',
                'guard_name' => 'web',
                'id' => 45,
                'name' => 'syncs_c',
                'updated_at' => '2022-04-08 06:57:23',
            ),
            45 => 
            array (
                'created_at' => '2022-04-08 06:57:23',
                'description' => 'Gestione Sincronizzazioni -  read',
                'group' => 'syncs',
                'guard_name' => 'web',
                'id' => 46,
                'name' => 'syncs_r',
                'updated_at' => '2022-04-08 06:57:23',
            ),
            46 => 
            array (
                'created_at' => '2022-04-08 06:57:23',
                'description' => 'Gestione Sincronizzazioni -  update',
                'group' => 'syncs',
                'guard_name' => 'web',
                'id' => 47,
                'name' => 'syncs_u',
                'updated_at' => '2022-04-08 06:57:23',
            ),
            47 => 
            array (
                'created_at' => '2022-04-08 06:57:23',
                'description' => 'Gestione Sincronizzazioni -  delete',
                'group' => 'syncs',
                'guard_name' => 'web',
                'id' => 48,
                'name' => 'syncs_d',
                'updated_at' => '2022-04-08 06:57:23',
            ),
            48 => 
            array (
                'created_at' => '2022-04-08 06:57:52',
                'description' => 'Gestione Programmi Lavorazione -  create',
                'group' => 'programs',
                'guard_name' => 'web',
                'id' => 49,
                'name' => 'programs_c',
                'updated_at' => '2022-04-08 06:57:52',
            ),
            49 => 
            array (
                'created_at' => '2022-04-08 06:57:52',
                'description' => 'Gestione Programmi Lavorazione -  read',
                'group' => 'programs',
                'guard_name' => 'web',
                'id' => 50,
                'name' => 'programs_r',
                'updated_at' => '2022-04-08 06:57:52',
            ),
            50 => 
            array (
                'created_at' => '2022-04-08 06:57:52',
                'description' => 'Gestione Programmi Lavorazione -  update',
                'group' => 'programs',
                'guard_name' => 'web',
                'id' => 51,
                'name' => 'programs_u',
                'updated_at' => '2022-04-08 06:57:52',
            ),
            51 => 
            array (
                'created_at' => '2022-04-08 06:57:52',
                'description' => 'Gestione Programmi Lavorazione -  delete',
                'group' => 'programs',
                'guard_name' => 'web',
                'id' => 52,
                'name' => 'programs_d',
                'updated_at' => '2022-04-08 06:57:52',
            ),
            52 => 
            array (
                'created_at' => '2022-04-11 07:11:08',
                'description' => 'Diagnostica Macchine -  create',
                'group' => 'machine_logs',
                'guard_name' => 'web',
                'id' => 53,
                'name' => 'diagnostics_c',
                'updated_at' => '2022-04-11 07:11:08',
            ),
            53 => 
            array (
                'created_at' => '2022-04-11 07:11:08',
                'description' => 'Diagnostica Macchine -  read',
                'group' => 'machine_logs',
                'guard_name' => 'web',
                'id' => 54,
                'name' => 'diagnostics_r',
                'updated_at' => '2022-04-11 07:11:08',
            ),
            54 => 
            array (
                'created_at' => '2022-04-11 07:11:08',
                'description' => 'Diagnostica Macchine -  update',
                'group' => 'machine_logs',
                'guard_name' => 'web',
                'id' => 55,
                'name' => 'diagnostics_u',
                'updated_at' => '2022-04-11 07:11:08',
            ),
            55 => 
            array (
                'created_at' => '2022-04-11 07:11:08',
                'description' => 'Diagnostica Macchine -  delete',
                'group' => 'machine_logs',
                'guard_name' => 'web',
                'id' => 56,
                'name' => 'diagnostics_d',
                'updated_at' => '2022-04-11 07:11:08',
            ),
            56 => 
            array (
                'created_at' => '2022-04-21 16:35:04',
                'description' => 'Pianificazione delle lavorazioni -  create',
                'group' => 'work_schedule',
                'guard_name' => 'web',
                'id' => 57,
                'name' => 'work_schedule_c',
                'updated_at' => '2022-04-21 16:35:04',
            ),
            57 => 
            array (
                'created_at' => '2022-04-21 16:35:04',
                'description' => 'Pianificazione delle lavorazioni -  read',
                'group' => 'work_schedule',
                'guard_name' => 'web',
                'id' => 58,
                'name' => 'work_schedule_r',
                'updated_at' => '2022-04-21 16:35:04',
            ),
            58 => 
            array (
                'created_at' => '2022-04-21 16:35:04',
                'description' => 'Pianificazione delle lavorazioni -  update',
                'group' => 'work_schedule',
                'guard_name' => 'web',
                'id' => 59,
                'name' => 'work_schedule_u',
                'updated_at' => '2022-04-21 16:35:04',
            ),
            59 => 
            array (
                'created_at' => '2022-04-21 16:35:04',
                'description' => 'Pianificazione delle lavorazioni -  delete',
                'group' => 'work_schedule',
                'guard_name' => 'web',
                'id' => 60,
                'name' => 'work_schedule_d',
                'updated_at' => '2022-04-21 16:35:04',
            ),
            60 => 
            array (
                'created_at' => '2022-12-02 08:49:43',
                'description' => 'Gestione Ordini -  create',
                'group' => 'orders',
                'guard_name' => 'web',
                'id' => 61,
                'name' => 'orders_c',
                'updated_at' => '2022-12-02 08:49:43',
            ),
            61 => 
            array (
                'created_at' => '2022-12-02 08:49:43',
                'description' => 'Gestione Ordini -  read',
                'group' => 'orders',
                'guard_name' => 'web',
                'id' => 62,
                'name' => 'orders_r',
                'updated_at' => '2022-12-02 08:49:43',
            ),
            62 => 
            array (
                'created_at' => '2022-12-02 08:49:43',
                'description' => 'Gestione Ordini -  update',
                'group' => 'orders',
                'guard_name' => 'web',
                'id' => 63,
                'name' => 'orders_u',
                'updated_at' => '2022-12-02 08:49:43',
            ),
            63 => 
            array (
                'created_at' => '2022-12-02 08:49:43',
                'description' => 'Gestione Ordini -  delete',
                'group' => 'orders',
                'guard_name' => 'web',
                'id' => 64,
                'name' => 'orders_d',
                'updated_at' => '2022-12-02 08:49:43',
            ),
            64 => 
            array (
                'created_at' => '2022-12-18 18:42:35',
                'description' => 'Gestione Provider Servizi -  create',
                'group' => 'providers',
                'guard_name' => 'web',
                'id' => 65,
                'name' => 'providers_c',
                'updated_at' => '2022-12-18 18:42:35',
            ),
            65 => 
            array (
                'created_at' => '2022-12-18 18:42:35',
                'description' => 'Gestione Provider Servizi -  read',
                'group' => 'providers',
                'guard_name' => 'web',
                'id' => 66,
                'name' => 'providers_r',
                'updated_at' => '2022-12-18 18:42:35',
            ),
            66 => 
            array (
                'created_at' => '2022-12-18 18:42:35',
                'description' => 'Gestione Provider Servizi -  update',
                'group' => 'providers',
                'guard_name' => 'web',
                'id' => 67,
                'name' => 'providers_u',
                'updated_at' => '2022-12-18 18:42:35',
            ),
            67 => 
            array (
                'created_at' => '2022-12-18 18:42:35',
                'description' => 'Gestione Provider Servizi -  delete',
                'group' => 'providers',
                'guard_name' => 'web',
                'id' => 68,
                'name' => 'providers_d',
                'updated_at' => '2022-12-18 18:42:35',
            ),
            68 => 
            array (
                'created_at' => '2022-12-31 11:39:14',
                'description' => 'Localizzazione Mezzi -  create',
                'group' => 'localizations',
                'guard_name' => 'web',
                'id' => 69,
                'name' => 'localizations_c',
                'updated_at' => '2022-12-31 11:39:14',
            ),
            69 => 
            array (
                'created_at' => '2022-12-31 11:39:14',
                'description' => 'Localizzazione Mezzi -  read',
                'group' => 'localizations',
                'guard_name' => 'web',
                'id' => 70,
                'name' => 'localizations_r',
                'updated_at' => '2022-12-31 11:39:14',
            ),
            70 => 
            array (
                'created_at' => '2022-12-31 11:39:15',
                'description' => 'Localizzazione Mezzi -  update',
                'group' => 'localizations',
                'guard_name' => 'web',
                'id' => 71,
                'name' => 'localizations_u',
                'updated_at' => '2022-12-31 11:39:15',
            ),
            71 => 
            array (
                'created_at' => '2022-12-31 11:39:15',
                'description' => 'Localizzazione Mezzi -  delete',
                'group' => 'localizations',
                'guard_name' => 'web',
                'id' => 72,
                'name' => 'localizations_d',
                'updated_at' => '2022-12-31 11:39:15',
            ),
            72 => 
            array (
                'created_at' => '2023-02-23 08:41:24',
                'description' => 'Gestione Tipologie Manutenzione -  create',
                'group' => 'manteinance_types',
                'guard_name' => 'web',
                'id' => 73,
                'name' => 'manteinance_types_c',
                'updated_at' => '2023-02-23 08:41:24',
            ),
            73 => 
            array (
                'created_at' => '2023-02-23 08:41:24',
                'description' => 'Gestione Tipologie Manutenzione -  read',
                'group' => 'manteinance_types',
                'guard_name' => 'web',
                'id' => 74,
                'name' => 'manteinance_types_r',
                'updated_at' => '2023-02-23 08:41:24',
            ),
            74 => 
            array (
                'created_at' => '2023-02-23 08:41:24',
                'description' => 'Gestione Tipologie Manutenzione -  update',
                'group' => 'manteinance_types',
                'guard_name' => 'web',
                'id' => 75,
                'name' => 'manteinance_types_u',
                'updated_at' => '2023-02-23 08:41:24',
            ),
            75 => 
            array (
                'created_at' => '2023-02-23 08:41:24',
                'description' => 'Gestione Tipologie Manutenzione -  delete',
                'group' => 'manteinance_types',
                'guard_name' => 'web',
                'id' => 76,
                'name' => 'manteinance_types_d',
                'updated_at' => '2023-02-23 08:41:24',
            ),
            76 => 
            array (
                'created_at' => '2023-02-23 08:41:51',
                'description' => 'Gestione Manutenzioni -  create',
                'group' => 'manteinances',
                'guard_name' => 'web',
                'id' => 77,
                'name' => 'manteinances_c',
                'updated_at' => '2023-02-23 08:41:51',
            ),
            77 => 
            array (
                'created_at' => '2023-02-23 08:41:51',
                'description' => 'Gestione Manutenzioni -  read',
                'group' => 'manteinances',
                'guard_name' => 'web',
                'id' => 78,
                'name' => 'manteinances_r',
                'updated_at' => '2023-02-23 08:41:51',
            ),
            78 => 
            array (
                'created_at' => '2023-02-23 08:41:51',
                'description' => 'Gestione Manutenzioni -  update',
                'group' => 'manteinances',
                'guard_name' => 'web',
                'id' => 79,
                'name' => 'manteinances_u',
                'updated_at' => '2023-02-23 08:41:51',
            ),
            79 => 
            array (
                'created_at' => '2023-02-23 08:41:51',
                'description' => 'Gestione Manutenzioni -  delete',
                'group' => 'manteinances',
                'guard_name' => 'web',
                'id' => 80,
                'name' => 'manteinances_d',
                'updated_at' => '2023-02-23 08:41:51',
            ),
            80 => 
            array (
                'created_at' => '2023-03-07 15:04:57',
                'description' => 'Gestione Lotti -  create',
                'group' => 'lots',
                'guard_name' => 'web',
                'id' => 81,
                'name' => 'lots_c',
                'updated_at' => '2023-03-07 15:04:57',
            ),
            81 => 
            array (
                'created_at' => '2023-03-07 15:04:57',
                'description' => 'Gestione Lotti -  read',
                'group' => 'lots',
                'guard_name' => 'web',
                'id' => 82,
                'name' => 'lots_r',
                'updated_at' => '2023-03-07 15:04:57',
            ),
            82 => 
            array (
                'created_at' => '2023-03-07 15:04:57',
                'description' => 'Gestione Lotti -  update',
                'group' => 'lots',
                'guard_name' => 'web',
                'id' => 83,
                'name' => 'lots_u',
                'updated_at' => '2023-03-07 15:04:57',
            ),
            83 => 
            array (
                'created_at' => '2023-03-07 15:04:57',
                'description' => 'Gestione Lotti -  delete',
                'group' => 'lots',
                'guard_name' => 'web',
                'id' => 84,
                'name' => 'lots_d',
                'updated_at' => '2023-03-07 15:04:57',
            ),
        ));
        
        
    }
}