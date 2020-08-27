<?php

use App\Models\BannerImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banner_images')->insert([
            [
                'title' => 'Bns nhà',
                'imageAddress'=> 'anhnha.jpg',
                'user_id' =>'1',
                'partner'=>'VinHomes',
                'show' => 1,
            ],
            [
                'title' => 'Bns nhà',
                'imageAddress'=> 'anhnha.jpg',
                'user_id' =>'1',
                'partner'=>'VinHomes',
                'show' => 1,
            ],
            [
                'title' => 'Bns nhà',
                'imageAddress'=> 'anhnha.jpg',
                'user_id' =>'1',
                'partner'=>'VinHomes',
                'show' => 1,
            ],
            [
                'title' => 'Bns nhà',
                'imageAddress'=> 'anhnha.jpg',
                'user_id' =>'1',
                'partner'=>'VinHomes',
                'show' => 1,
            ],

        ]);
    }
}
