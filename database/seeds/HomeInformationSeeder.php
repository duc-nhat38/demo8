<?php

use App\Models\HomeInformation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_information')->insert([
            [
                'area' => '25',
                'title' => 'Nhà ở',
                'description' => 'Nhà ở',
                'house_id' => '1',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',

            ],    
            [
                'area' => '25',
                'title' => 'Nhà ở',
                'description' => 'Nhà ở',
                'house_id' => '2',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',

            ],  
            [
                'area' => '25',
                'title' => 'Nhà ở',
                'description' => 'Nhà ở',
                'house_id' => '3',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',

            ],  
            [
                'area' => '25',
                'title' => 'Nhà ở',
                'description' => 'Nhà ở',
                'house_id' => '4',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',

            ],   
        ]);
    }
}
