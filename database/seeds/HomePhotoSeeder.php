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
            ],   
            [
                'photoAddress' => 'anhnha.jpg',
                'house_id' => '2',
            ],    
            [
                'photoAddress' => 'anhnha.jpg',
                'house_id' => '3',
            ],   
            [
                'photoAddress' => 'anhnha.jpg',
                'house_id' => '4',
            ],   
        ]);
    }
}
