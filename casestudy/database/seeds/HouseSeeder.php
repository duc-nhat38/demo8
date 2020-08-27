<?php

use App\Models\House;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('houses')->insert([
            [
                'user_id' => '1',
                'district_id' => '1',
                'business_type_id' => '1',
                'price'=> '10000',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
                
            ],   
            [
                'user_id' => '1',
                'district_id' => '2',
                'business_type_id' => '2',
                'price'=> '124532',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],   
            [
                'user_id' => '1',
                'district_id' => '3',
                'business_type_id' => '3',
                'price'=> '17654',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],   
            [
                'user_id' => '1',
                'district_id' => '2',
                'business_type_id' => '1',
                'price'=> '1345678',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],   
        ]);
    }
}
