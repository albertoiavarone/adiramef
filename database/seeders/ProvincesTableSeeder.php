<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provinces')->delete();
        
        \DB::table('provinces')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nation_id' => 110,
                'name' => 'Agrigento',
                'province_abbreviation' => 'AG',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            1 => 
            array (
                'id' => 2,
                'nation_id' => 110,
                'name' => 'Alessandria',
                'province_abbreviation' => 'AL',
                'region' => 'Piemonte',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            2 => 
            array (
                'id' => 3,
                'nation_id' => 110,
                'name' => 'Ancona',
                'province_abbreviation' => 'AN',
                'region' => 'Marche',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            3 => 
            array (
                'id' => 4,
                'nation_id' => 110,
                'name' => 'Arezzo',
                'province_abbreviation' => 'AR',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            4 => 
            array (
                'id' => 5,
                'nation_id' => 110,
                'name' => 'Ascoli Piceno',
                'province_abbreviation' => 'AP',
                'region' => 'Marche',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            5 => 
            array (
                'id' => 6,
                'nation_id' => 110,
                'name' => 'Asti',
                'province_abbreviation' => 'AT',
                'region' => 'Piemonte',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            6 => 
            array (
                'id' => 7,
                'nation_id' => 110,
                'name' => 'Avellino',
                'province_abbreviation' => 'AV',
                'region' => 'Campania',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            7 => 
            array (
                'id' => 8,
                'nation_id' => 110,
                'name' => 'Bari',
                'province_abbreviation' => 'BA',
                'region' => 'Puglia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            8 => 
            array (
                'id' => 9,
                'nation_id' => 110,
                'name' => 'Barletta-Andria-Trani',
                'province_abbreviation' => 'BT',
                'region' => 'Puglia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            9 => 
            array (
                'id' => 10,
                'nation_id' => 110,
                'name' => 'Belluno',
                'province_abbreviation' => 'BL',
                'region' => 'Veneto',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            10 => 
            array (
                'id' => 11,
                'nation_id' => 110,
                'name' => 'Benevento',
                'province_abbreviation' => 'BN',
                'region' => 'Campania',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            11 => 
            array (
                'id' => 12,
                'nation_id' => 110,
                'name' => 'Bergamo',
                'province_abbreviation' => 'BG',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            12 => 
            array (
                'id' => 13,
                'nation_id' => 110,
                'name' => 'Biella',
                'province_abbreviation' => 'BI',
                'region' => 'Piemonte',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            13 => 
            array (
                'id' => 14,
                'nation_id' => 110,
                'name' => 'Bologna',
                'province_abbreviation' => 'BO',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            14 => 
            array (
                'id' => 15,
                'nation_id' => 110,
                'name' => 'Bolzano',
                'province_abbreviation' => 'BZ',
                'region' => 'Trentino-Alto Adige',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            15 => 
            array (
                'id' => 16,
                'nation_id' => 110,
                'name' => 'Brescia',
                'province_abbreviation' => 'BS',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            16 => 
            array (
                'id' => 17,
                'nation_id' => 110,
                'name' => 'Brindisi',
                'province_abbreviation' => 'BR',
                'region' => 'Puglia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            17 => 
            array (
                'id' => 18,
                'nation_id' => 110,
                'name' => 'Cagliari',
                'province_abbreviation' => 'CA',
                'region' => 'Sardegna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            18 => 
            array (
                'id' => 19,
                'nation_id' => 110,
                'name' => 'Caltanissetta',
                'province_abbreviation' => 'CL',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            19 => 
            array (
                'id' => 20,
                'nation_id' => 110,
                'name' => 'Campobasso',
                'province_abbreviation' => 'CB',
                'region' => 'Molise',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            20 => 
            array (
                'id' => 21,
                'nation_id' => 110,
                'name' => 'Carbonia-Iglesias',
                'province_abbreviation' => 'CI',
                'region' => 'Sardegna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            21 => 
            array (
                'id' => 22,
                'nation_id' => 110,
                'name' => 'Caserta',
                'province_abbreviation' => 'CE',
                'region' => 'Campania',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            22 => 
            array (
                'id' => 23,
                'nation_id' => 110,
                'name' => 'Catania',
                'province_abbreviation' => 'CT',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            23 => 
            array (
                'id' => 24,
                'nation_id' => 110,
                'name' => 'Catanzaro',
                'province_abbreviation' => 'CZ',
                'region' => 'Calabria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            24 => 
            array (
                'id' => 25,
                'nation_id' => 110,
                'name' => 'Chieti',
                'province_abbreviation' => 'CH',
                'region' => 'Abruzzo',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            25 => 
            array (
                'id' => 26,
                'nation_id' => 110,
                'name' => 'Como',
                'province_abbreviation' => 'CO',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            26 => 
            array (
                'id' => 27,
                'nation_id' => 110,
                'name' => 'Cosenza',
                'province_abbreviation' => 'CS',
                'region' => 'Calabria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            27 => 
            array (
                'id' => 28,
                'nation_id' => 110,
                'name' => 'Cremona',
                'province_abbreviation' => 'CR',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            28 => 
            array (
                'id' => 29,
                'nation_id' => 110,
                'name' => 'Crotone',
                'province_abbreviation' => 'KR',
                'region' => 'Calabria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            29 => 
            array (
                'id' => 30,
                'nation_id' => 110,
                'name' => 'Cuneo',
                'province_abbreviation' => 'CN',
                'region' => 'Piemonte',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            30 => 
            array (
                'id' => 31,
                'nation_id' => 110,
                'name' => 'Enna',
                'province_abbreviation' => 'EN',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            31 => 
            array (
                'id' => 32,
                'nation_id' => 110,
                'name' => 'Fermo',
                'province_abbreviation' => 'FM',
                'region' => 'Marche',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            32 => 
            array (
                'id' => 33,
                'nation_id' => 110,
                'name' => 'Ferrara',
                'province_abbreviation' => 'FE',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            33 => 
            array (
                'id' => 34,
                'nation_id' => 110,
                'name' => 'Firenze',
                'province_abbreviation' => 'FI',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            34 => 
            array (
                'id' => 35,
                'nation_id' => 110,
                'name' => 'Foggia',
                'province_abbreviation' => 'FG',
                'region' => 'Puglia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            35 => 
            array (
                'id' => 36,
                'nation_id' => 110,
                'name' => 'Forlì-Cesena',
                'province_abbreviation' => 'FC',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            36 => 
            array (
                'id' => 37,
                'nation_id' => 110,
                'name' => 'Frosinone',
                'province_abbreviation' => 'FR',
                'region' => 'Lazio',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            37 => 
            array (
                'id' => 38,
                'nation_id' => 110,
                'name' => 'Genova',
                'province_abbreviation' => 'GE',
                'region' => 'Liguria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            38 => 
            array (
                'id' => 39,
                'nation_id' => 110,
                'name' => 'Gorizia',
                'province_abbreviation' => 'GO',
                'region' => 'Friuli-Venezia Giulia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            39 => 
            array (
                'id' => 40,
                'nation_id' => 110,
                'name' => 'Grosseto',
                'province_abbreviation' => 'GR',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            40 => 
            array (
                'id' => 41,
                'nation_id' => 110,
                'name' => 'Imperia',
                'province_abbreviation' => 'IM',
                'region' => 'Liguria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            41 => 
            array (
                'id' => 42,
                'nation_id' => 110,
                'name' => 'Isernia',
                'province_abbreviation' => 'IS',
                'region' => 'Molise',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            42 => 
            array (
                'id' => 43,
                'nation_id' => 110,
                'name' => 'L\'Aquila',
                'province_abbreviation' => 'AQ',
                'region' => 'Abruzzo',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            43 => 
            array (
                'id' => 44,
                'nation_id' => 110,
                'name' => 'La Spezia',
                'province_abbreviation' => 'SP',
                'region' => 'Liguria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            44 => 
            array (
                'id' => 45,
                'nation_id' => 110,
                'name' => 'Latina',
                'province_abbreviation' => 'LT',
                'region' => 'Lazio',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            45 => 
            array (
                'id' => 46,
                'nation_id' => 110,
                'name' => 'Lecce',
                'province_abbreviation' => 'LE',
                'region' => 'Puglia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            46 => 
            array (
                'id' => 47,
                'nation_id' => 110,
                'name' => 'Lecco',
                'province_abbreviation' => 'LC',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            47 => 
            array (
                'id' => 48,
                'nation_id' => 110,
                'name' => 'Livorno',
                'province_abbreviation' => 'LI',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            48 => 
            array (
                'id' => 49,
                'nation_id' => 110,
                'name' => 'Lodi',
                'province_abbreviation' => 'LO',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            49 => 
            array (
                'id' => 50,
                'nation_id' => 110,
                'name' => 'Lucca',
                'province_abbreviation' => 'LU',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            50 => 
            array (
                'id' => 51,
                'nation_id' => 110,
                'name' => 'Macerata',
                'province_abbreviation' => 'MC',
                'region' => 'Marche',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            51 => 
            array (
                'id' => 52,
                'nation_id' => 110,
                'name' => 'Mantova',
                'province_abbreviation' => 'MN',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            52 => 
            array (
                'id' => 53,
                'nation_id' => 110,
                'name' => 'Massa e Carrara',
                'province_abbreviation' => 'MS',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            53 => 
            array (
                'id' => 54,
                'nation_id' => 110,
                'name' => 'Matera',
                'province_abbreviation' => 'MT',
                'region' => 'Basilicata',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            54 => 
            array (
                'id' => 55,
                'nation_id' => 110,
                'name' => 'Medio Campidano',
                'province_abbreviation' => 'VS',
                'region' => 'Sardegna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            55 => 
            array (
                'id' => 56,
                'nation_id' => 110,
                'name' => 'Messina',
                'province_abbreviation' => 'ME',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            56 => 
            array (
                'id' => 57,
                'nation_id' => 110,
                'name' => 'Milano',
                'province_abbreviation' => 'MI',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            57 => 
            array (
                'id' => 58,
                'nation_id' => 110,
                'name' => 'Modena',
                'province_abbreviation' => 'MO',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            58 => 
            array (
                'id' => 59,
                'nation_id' => 110,
                'name' => 'Monza e Brianza',
                'province_abbreviation' => 'MB',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            59 => 
            array (
                'id' => 60,
                'nation_id' => 110,
                'name' => 'Napoli',
                'province_abbreviation' => 'NA',
                'region' => 'Campania',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            60 => 
            array (
                'id' => 61,
                'nation_id' => 110,
                'name' => 'Novara',
                'province_abbreviation' => 'NO',
                'region' => 'Piemonte',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            61 => 
            array (
                'id' => 62,
                'nation_id' => 110,
                'name' => 'Nuoro',
                'province_abbreviation' => 'NU',
                'region' => 'Sardegna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            62 => 
            array (
                'id' => 63,
                'nation_id' => 110,
                'name' => 'Ogliastra',
                'province_abbreviation' => 'OG',
                'region' => 'Sardegna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            63 => 
            array (
                'id' => 64,
                'nation_id' => 110,
                'name' => 'Olbia-Tempio',
                'province_abbreviation' => 'OT',
                'region' => 'Sardegna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            64 => 
            array (
                'id' => 65,
                'nation_id' => 110,
                'name' => 'Oristano',
                'province_abbreviation' => 'OR',
                'region' => 'Sardegna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            65 => 
            array (
                'id' => 66,
                'nation_id' => 110,
                'name' => 'Padova',
                'province_abbreviation' => 'PD',
                'region' => 'Veneto',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            66 => 
            array (
                'id' => 67,
                'nation_id' => 110,
                'name' => 'Palermo',
                'province_abbreviation' => 'PA',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            67 => 
            array (
                'id' => 68,
                'nation_id' => 110,
                'name' => 'Parma',
                'province_abbreviation' => 'PR',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            68 => 
            array (
                'id' => 69,
                'nation_id' => 110,
                'name' => 'Pavia',
                'province_abbreviation' => 'PV',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            69 => 
            array (
                'id' => 70,
                'nation_id' => 110,
                'name' => 'Perugia',
                'province_abbreviation' => 'PG',
                'region' => 'Umbria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            70 => 
            array (
                'id' => 71,
                'nation_id' => 110,
                'name' => 'Pesaro e Urbino',
                'province_abbreviation' => 'PU',
                'region' => 'Marche',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            71 => 
            array (
                'id' => 72,
                'nation_id' => 110,
                'name' => 'Pescara',
                'province_abbreviation' => 'PE',
                'region' => 'Abruzzo',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            72 => 
            array (
                'id' => 73,
                'nation_id' => 110,
                'name' => 'Piacenza',
                'province_abbreviation' => 'PC',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            73 => 
            array (
                'id' => 74,
                'nation_id' => 110,
                'name' => 'Pisa',
                'province_abbreviation' => 'PI',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            74 => 
            array (
                'id' => 75,
                'nation_id' => 110,
                'name' => 'Pistoia',
                'province_abbreviation' => 'PT',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            75 => 
            array (
                'id' => 76,
                'nation_id' => 110,
                'name' => 'Pordenone',
                'province_abbreviation' => 'PN',
                'region' => 'Friuli-Venezia Giulia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            76 => 
            array (
                'id' => 77,
                'nation_id' => 110,
                'name' => 'Potenza',
                'province_abbreviation' => 'PZ',
                'region' => 'Basilicata',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            77 => 
            array (
                'id' => 78,
                'nation_id' => 110,
                'name' => 'Prato',
                'province_abbreviation' => 'PO',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            78 => 
            array (
                'id' => 79,
                'nation_id' => 110,
                'name' => 'Ragusa',
                'province_abbreviation' => 'RG',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            79 => 
            array (
                'id' => 80,
                'nation_id' => 110,
                'name' => 'Ravenna',
                'province_abbreviation' => 'RA',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            80 => 
            array (
                'id' => 81,
                'nation_id' => 110,
            'name' => 'Reggio Calabria(metropolitana)',
                'province_abbreviation' => 'RC',
                'region' => 'Calabria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            81 => 
            array (
                'id' => 82,
                'nation_id' => 110,
                'name' => 'Reggio Emilia',
                'province_abbreviation' => 'RE',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            82 => 
            array (
                'id' => 83,
                'nation_id' => 110,
                'name' => 'Rieti',
                'province_abbreviation' => 'RI',
                'region' => 'Lazio',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            83 => 
            array (
                'id' => 84,
                'nation_id' => 110,
                'name' => 'Rimini',
                'province_abbreviation' => 'RN',
                'region' => 'Emilia-Romagna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            84 => 
            array (
                'id' => 85,
                'nation_id' => 110,
                'name' => 'Roma',
                'province_abbreviation' => 'RM',
                'region' => 'Lazio',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            85 => 
            array (
                'id' => 86,
                'nation_id' => 110,
                'name' => 'Rovigo',
                'province_abbreviation' => 'RO',
                'region' => 'Veneto',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            86 => 
            array (
                'id' => 87,
                'nation_id' => 110,
                'name' => 'Salerno',
                'province_abbreviation' => 'SA',
                'region' => 'Campania',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            87 => 
            array (
                'id' => 88,
                'nation_id' => 110,
                'name' => 'Sassari',
                'province_abbreviation' => 'SS',
                'region' => 'Sardegna',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            88 => 
            array (
                'id' => 89,
                'nation_id' => 110,
                'name' => 'Savona',
                'province_abbreviation' => 'SV',
                'region' => 'Liguria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            89 => 
            array (
                'id' => 90,
                'nation_id' => 110,
                'name' => 'Siena',
                'province_abbreviation' => 'SI',
                'region' => 'Toscana',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            90 => 
            array (
                'id' => 91,
                'nation_id' => 110,
                'name' => 'Siracusa',
                'province_abbreviation' => 'SR',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            91 => 
            array (
                'id' => 92,
                'nation_id' => 110,
                'name' => 'Sondrio',
                'province_abbreviation' => 'SO',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            92 => 
            array (
                'id' => 93,
                'nation_id' => 110,
                'name' => 'Taranto',
                'province_abbreviation' => 'TA',
                'region' => 'Puglia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            93 => 
            array (
                'id' => 94,
                'nation_id' => 110,
                'name' => 'Teramo',
                'province_abbreviation' => 'TE',
                'region' => 'Abruzzo',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            94 => 
            array (
                'id' => 95,
                'nation_id' => 110,
                'name' => 'Terni',
                'province_abbreviation' => 'TR',
                'region' => 'Umbria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            95 => 
            array (
                'id' => 96,
                'nation_id' => 110,
                'name' => 'Torino',
                'province_abbreviation' => 'TO',
                'region' => 'Piemonte',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            96 => 
            array (
                'id' => 97,
                'nation_id' => 110,
                'name' => 'Trapani',
                'province_abbreviation' => 'TP',
                'region' => 'Sicilia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            97 => 
            array (
                'id' => 98,
                'nation_id' => 110,
                'name' => 'Trento',
                'province_abbreviation' => 'TN',
                'region' => 'Trentino-Alto Adige',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            98 => 
            array (
                'id' => 99,
                'nation_id' => 110,
                'name' => 'Treviso',
                'province_abbreviation' => 'TV',
                'region' => 'Veneto',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            99 => 
            array (
                'id' => 100,
                'nation_id' => 110,
                'name' => 'Trieste',
                'province_abbreviation' => 'TS',
                'region' => 'Friuli-Venezia Giulia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            100 => 
            array (
                'id' => 101,
                'nation_id' => 110,
                'name' => 'Udine',
                'province_abbreviation' => 'UD',
                'region' => 'Friuli-Venezia Giulia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            101 => 
            array (
                'id' => 102,
                'nation_id' => 110,
                'name' => 'Aosta',
                'province_abbreviation' => 'AO',
                'region' => 'Valle d\'Aosta',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            102 => 
            array (
                'id' => 103,
                'nation_id' => 110,
                'name' => 'Varese',
                'province_abbreviation' => 'VA',
                'region' => 'Lombardia',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            103 => 
            array (
                'id' => 104,
                'nation_id' => 110,
                'name' => 'Venezia',
                'province_abbreviation' => 'VE',
                'region' => 'Veneto',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            104 => 
            array (
                'id' => 105,
                'nation_id' => 110,
                'name' => 'Verbano-Cusio-Ossola',
                'province_abbreviation' => 'VB',
                'region' => 'Piemonte',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            105 => 
            array (
                'id' => 106,
                'nation_id' => 110,
                'name' => 'Vercelli',
                'province_abbreviation' => 'VC',
                'region' => 'Piemonte',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            106 => 
            array (
                'id' => 107,
                'nation_id' => 110,
                'name' => 'Verona',
                'province_abbreviation' => 'VR',
                'region' => 'Veneto',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            107 => 
            array (
                'id' => 108,
                'nation_id' => 110,
                'name' => 'Vibo Valentia',
                'province_abbreviation' => 'VV',
                'region' => 'Calabria',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            108 => 
            array (
                'id' => 109,
                'nation_id' => 110,
                'name' => 'Vicenza',
                'province_abbreviation' => 'VI',
                'region' => 'Veneto',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
            109 => 
            array (
                'id' => 110,
                'nation_id' => 110,
                'name' => 'Viterbo',
                'province_abbreviation' => 'VT',
                'region' => 'Lazio',
                'created_at' => '2021-06-14 14:56:26',
                'updated_at' => '2021-06-14 14:56:26',
            ),
        ));
        
        
    }
}