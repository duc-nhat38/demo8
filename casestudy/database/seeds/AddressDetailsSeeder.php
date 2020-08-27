<?php

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddressDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->insert([
            [
                'district' => 'Phú bài',
                'address_id' => '1'
            ],
            [
                'district' => 'Thủy Phù',
                'address_id' => '1'
            ],
            [
                'district' => 'Thủy Dương',
                'address_id' => '2'
            ],
            [
                'district' => 'Quận 3',
                'address_id' => '3'
            ],

        ]);
    }
}
