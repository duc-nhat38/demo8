<?php

use App\Models\HomePhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_photos')->insert([
            [
                'photoAddress' => 'anhnha.jpg',
                'house_id' => '1',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],   
            [
                'photoAddress' => 'anhnha.jpg',
                'house_id' => '2',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],    
            [
                'photoAddress' => 'anhnha.jpg',
                'house_id' => '3',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],   
            [
                'photoAddress' => 'anhnha.jpg',
                'house_id' => '4',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],   
        ]);
    }
}
