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
            ],
            [
                'address' => 'Ha Nội',
            ],
            [
                'address' => 'Sài Gòn',
            ]
        ]);
    }
}
