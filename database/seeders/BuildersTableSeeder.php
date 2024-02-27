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
                'id' => 2,
                'uuid' => '696b542e-f429-4673-a9cb-f285c2a9fcf5',
            'name' => 'HP (Hewlett-Packard)',
                'logo_path' => 'builders/696b542e-f429-4673-a9cb-f285c2a9fcf5.png',
                'created_at' => '2024-02-02 10:54:48',
                'updated_at' => '2024-02-02 10:56:06',
            ),
            1 => 
            array (
                'id' => 3,
                'uuid' => 'df0dcbff-8b35-4491-9b0b-ddfcf28d3de0',
            'name' => 'HPE (Hewlett Packard Enterprise)',
                'logo_path' => 'builders/df0dcbff-8b35-4491-9b0b-ddfcf28d3de0.png',
                'created_at' => '2024-02-02 12:09:02',
                'updated_at' => '2024-02-02 12:09:02',
            ),
            2 => 
            array (
                'id' => 4,
                'uuid' => '96e1abc3-aaab-4d8c-a6fe-e8de935f7424',
                'name' => 'ASUS',
                'logo_path' => 'builders/96e1abc3-aaab-4d8c-a6fe-e8de935f7424.png',
                'created_at' => '2024-02-06 07:06:04',
                'updated_at' => '2024-02-06 07:06:05',
            ),
            3 => 
            array (
                'id' => 5,
                'uuid' => '872fb033-e126-4d5d-92cb-23eaa84ab282',
                'name' => 'Xerox',
                'logo_path' => 'builders/872fb033-e126-4d5d-92cb-23eaa84ab282.png',
                'created_at' => '2024-02-06 17:02:33',
                'updated_at' => '2024-02-06 17:02:33',
            ),
            4 => 
            array (
                'id' => 6,
                'uuid' => '5df5f01f-83a0-4a74-a371-d99a42f5d258',
                'name' => 'Dell',
                'logo_path' => 'builders/5df5f01f-83a0-4a74-a371-d99a42f5d258.png',
                'created_at' => '2024-02-07 06:24:28',
                'updated_at' => '2024-02-07 06:24:28',
            ),
            5 => 
            array (
                'id' => 7,
                'uuid' => '3783c93f-a521-4938-a1e5-0b8f2d79860b',
                'name' => 'Toshiba',
                'logo_path' => 'builders/3783c93f-a521-4938-a1e5-0b8f2d79860b.jpg',
                'created_at' => '2024-02-07 06:29:03',
                'updated_at' => '2024-02-07 06:29:03',
            ),
            6 => 
            array (
                'id' => 8,
                'uuid' => 'bf8666d8-21d3-430c-a7cc-a95badbfa95c',
                'name' => 'Huawei',
                'logo_path' => 'builders/bf8666d8-21d3-430c-a7cc-a95badbfa95c.png',
                'created_at' => '2024-02-07 06:32:04',
                'updated_at' => '2024-02-07 06:32:04',
            ),
            7 => 
            array (
                'id' => 9,
                'uuid' => '800267fd-5ff2-416d-8b81-b41dfe728f8a',
                'name' => 'ADJ',
                'logo_path' => 'builders/800267fd-5ff2-416d-8b81-b41dfe728f8a.jpg',
                'created_at' => '2024-02-07 06:41:19',
                'updated_at' => '2024-02-07 06:41:19',
            ),
            8 => 
            array (
                'id' => 10,
                'uuid' => 'a90384d7-ffb4-4f30-a255-fd036336acac',
                'name' => 'Acer',
                'logo_path' => 'builders/a90384d7-ffb4-4f30-a255-fd036336acac.jpg',
                'created_at' => '2024-02-07 07:10:11',
                'updated_at' => '2024-02-15 10:32:13',
            ),
            9 => 
            array (
                'id' => 11,
                'uuid' => '00c38884-5c5f-4ca3-a6ad-f5898a082efe',
                'name' => 'Lenovo',
                'logo_path' => 'builders/00c38884-5c5f-4ca3-a6ad-f5898a082efe.jpg',
                'created_at' => '2024-02-14 09:27:07',
                'updated_at' => '2024-02-15 10:30:04',
            ),
            10 => 
            array (
                'id' => 12,
                'uuid' => 'ddaca857-e6fc-41a2-9b80-6d5621125a57',
                'name' => 'Bender',
                'logo_path' => 'builders/ddaca857-e6fc-41a2-9b80-6d5621125a57.jpg',
                'created_at' => '2024-02-15 09:53:26',
                'updated_at' => '2024-02-15 09:53:27',
            ),
            11 => 
            array (
                'id' => 13,
                'uuid' => '6e008321-4a7f-4bae-bd52-54a484b9bfb1',
                'name' => 'S.P.L. ELEKTRONIK',
                'logo_path' => 'builders/6e008321-4a7f-4bae-bd52-54a484b9bfb1.jpg',
                'created_at' => '2024-02-15 10:26:39',
                'updated_at' => '2024-02-15 10:26:39',
            ),
            12 => 
            array (
                'id' => 14,
                'uuid' => 'b9a641bd-14d4-4656-861c-223971f49d70',
                'name' => 'Schiller',
                'logo_path' => 'builders/b9a641bd-14d4-4656-861c-223971f49d70.jpg',
                'created_at' => '2024-02-15 10:55:13',
                'updated_at' => '2024-02-15 10:55:13',
            ),
            13 => 
            array (
                'id' => 15,
                'uuid' => 'e356f021-a033-4578-9aaf-fe455a0b4b4d',
                'name' => 'DATREND SYSTEMS',
                'logo_path' => 'builders/e356f021-a033-4578-9aaf-fe455a0b4b4d.png',
                'created_at' => '2024-02-15 11:02:51',
                'updated_at' => '2024-02-15 11:02:51',
            ),
            14 => 
            array (
                'id' => 16,
                'uuid' => '50e459e4-9458-404f-a099-394d9d48d3b7',
                'name' => 'Mindray',
                'logo_path' => 'builders/50e459e4-9458-404f-a099-394d9d48d3b7.jpg',
                'created_at' => '2024-02-15 11:32:24',
                'updated_at' => '2024-02-15 11:32:24',
            ),
            15 => 
            array (
                'id' => 17,
                'uuid' => 'a0a956f9-c0b1-4e4d-be9e-19009e68ef8f',
                'name' => 'Medtronic',
                'logo_path' => 'builders/a0a956f9-c0b1-4e4d-be9e-19009e68ef8f.jpg',
                'created_at' => '2024-02-15 11:39:33',
                'updated_at' => '2024-02-15 11:39:33',
            ),
            16 => 
            array (
                'id' => 18,
                'uuid' => '522a7b32-208a-403b-926e-081d1d35afb1',
                'name' => 'Testo',
                'logo_path' => 'builders/522a7b32-208a-403b-926e-081d1d35afb1.png',
                'created_at' => '2024-02-15 11:43:09',
                'updated_at' => '2024-02-15 11:43:10',
            ),
            17 => 
            array (
                'id' => 19,
                'uuid' => '8e97c497-d50f-40f0-b0db-efcf1626b2a6',
                'name' => 'Delta OHM',
                'logo_path' => 'builders/8e97c497-d50f-40f0-b0db-efcf1626b2a6.jpg',
                'created_at' => '2024-02-15 11:46:40',
                'updated_at' => '2024-02-15 11:46:40',
            ),
            18 => 
            array (
                'id' => 20,
                'uuid' => '6e8703b8-0c0d-4e47-8138-f418c418b36a',
                'name' => 'Edan',
                'logo_path' => 'builders/6e8703b8-0c0d-4e47-8138-f418c418b36a.png',
                'created_at' => '2024-02-15 13:50:56',
                'updated_at' => '2024-02-15 13:50:56',
            ),
            19 => 
            array (
                'id' => 21,
                'uuid' => '5105ba75-186d-451e-ae4c-b79d85ae59d0',
                'name' => 'Infunix Tecnology',
                'logo_path' => 'builders/5105ba75-186d-451e-ae4c-b79d85ae59d0.jpg',
                'created_at' => '2024-02-15 13:55:00',
                'updated_at' => '2024-02-15 13:55:00',
            ),
            20 => 
            array (
                'id' => 22,
                'uuid' => '748ea50d-0693-4a19-b515-1043f1b6c4da',
                'name' => 'Hamilton Medical',
                'logo_path' => 'builders/748ea50d-0693-4a19-b515-1043f1b6c4da.jpg',
                'created_at' => '2024-02-15 14:00:04',
                'updated_at' => '2024-02-15 14:00:04',
            ),
            21 => 
            array (
                'id' => 23,
                'uuid' => 'f1371638-2d09-40d8-97b9-b7acf6426b7f',
                'name' => 'Samsung',
                'logo_path' => 'builders/f1371638-2d09-40d8-97b9-b7acf6426b7f.png',
                'created_at' => '2024-02-15 14:04:09',
                'updated_at' => '2024-02-15 14:04:09',
            ),
            22 => 
            array (
                'id' => 24,
                'uuid' => '86a57999-860b-449c-bf9f-ec5d5790fc1e',
                'name' => 'HT Italia',
                'logo_path' => 'builders/86a57999-860b-449c-bf9f-ec5d5790fc1e.png',
                'created_at' => '2024-02-16 08:02:43',
                'updated_at' => '2024-02-16 08:02:43',
            ),
            23 => 
            array (
                'id' => 25,
                'uuid' => 'f10361c6-53de-4553-8b17-0a688754af04',
                'name' => 'Esaote',
                'logo_path' => 'builders/f10361c6-53de-4553-8b17-0a688754af04.jpg',
                'created_at' => '2024-02-16 08:07:19',
                'updated_at' => '2024-02-16 08:07:19',
            ),
            24 => 
            array (
                'id' => 26,
                'uuid' => '5aad0862-c91a-4939-8710-ec7fad795014',
                'name' => 'Philips',
                'logo_path' => 'builders/5aad0862-c91a-4939-8710-ec7fad795014.jpg',
                'created_at' => '2024-02-16 08:10:24',
                'updated_at' => '2024-02-16 08:10:24',
            ),
            25 => 
            array (
                'id' => 27,
                'uuid' => 'ce72f1b1-4ebc-4a19-aee8-d58d67200654',
                'name' => 'Valleylab',
                'logo_path' => 'builders/ce72f1b1-4ebc-4a19-aee8-d58d67200654.png',
                'created_at' => '2024-02-16 08:14:55',
                'updated_at' => '2024-02-16 08:14:55',
            ),
            26 => 
            array (
                'id' => 28,
                'uuid' => 'fa9aee9f-6d00-49bb-9814-7b4c35626c03',
                'name' => 'Elcometer',
                'logo_path' => 'builders/fa9aee9f-6d00-49bb-9814-7b4c35626c03.jpg',
                'created_at' => '2024-02-16 08:18:03',
                'updated_at' => '2024-02-16 08:18:03',
            ),
            27 => 
            array (
                'id' => 29,
                'uuid' => 'c78e8cf7-34e4-4dd9-b7f2-3ec163352fd9',
                'name' => 'PCE',
                'logo_path' => 'builders/c78e8cf7-34e4-4dd9-b7f2-3ec163352fd9.jpg',
                'created_at' => '2024-02-16 10:01:00',
                'updated_at' => '2024-02-16 10:01:00',
            ),
            28 => 
            array (
                'id' => 30,
                'uuid' => '1808b94e-5a76-4ef1-add5-9b98882ac0a4',
                'name' => 'KW Apparecchi scientifici',
                'logo_path' => 'builders/1808b94e-5a76-4ef1-add5-9b98882ac0a4.png',
                'created_at' => '2024-02-16 10:20:46',
                'updated_at' => '2024-02-16 10:20:46',
            ),
            29 => 
            array (
                'id' => 31,
                'uuid' => 'ffbfc296-4651-4775-ac79-3e99057d1e60',
                'name' => 'Adiramef S.p.A.',
                'logo_path' => 'builders/ffbfc296-4651-4775-ac79-3e99057d1e60.png',
                'created_at' => '2024-02-16 12:10:39',
                'updated_at' => '2024-02-16 12:10:39',
            ),
            30 => 
            array (
                'id' => 32,
                'uuid' => 'd802fa66-6812-4f31-9188-a89194fab8d9',
                'name' => 'Fluke',
                'logo_path' => 'builders/d802fa66-6812-4f31-9188-a89194fab8d9.png',
                'created_at' => '2024-02-16 13:49:30',
                'updated_at' => '2024-02-16 13:49:30',
            ),
            31 => 
            array (
                'id' => 33,
                'uuid' => '4700a9a0-a463-46a5-857a-2ea3bec3559b',
                'name' => 'Boviar',
                'logo_path' => 'builders/4700a9a0-a463-46a5-857a-2ea3bec3559b.png',
                'created_at' => '2024-02-16 14:12:27',
                'updated_at' => '2024-02-16 14:12:27',
            ),
            32 => 
            array (
                'id' => 34,
                'uuid' => '3e163d11-0952-43ed-8123-8fd81051ef76',
                'name' => 'MSI',
                'logo_path' => 'builders/3e163d11-0952-43ed-8123-8fd81051ef76.png',
                'created_at' => '2024-02-19 09:48:08',
                'updated_at' => '2024-02-19 09:48:09',
            ),
            33 => 
            array (
                'id' => 35,
                'uuid' => 'bbe3de2f-988a-4c83-b571-db0e75862327',
                'name' => 'Microtech',
                'logo_path' => 'builders/bbe3de2f-988a-4c83-b571-db0e75862327.png',
                'created_at' => '2024-02-19 09:52:01',
                'updated_at' => '2024-02-19 09:52:01',
            ),
        ));
        
        
    }
}