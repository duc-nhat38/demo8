<?php

use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            [
                'address' => 'Huế',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',

            ],
            [
                'address' => 'Ha Nội',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],
            [
                'address' => 'Sài Gòn',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ]
        ]);
    }
}
