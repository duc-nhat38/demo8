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
                "expirationDate" => '2020-08-28 00:00:00',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],
            [
                'title' => 'Bns nhà',
                'imageAddress'=> 'anhnha.jpg',
                'user_id' =>'1',
                'partner'=>'VinHomes',
                'show' => 1,
                "expirationDate" => '2020-08-28 00:00:00',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],
            [
                'title' => 'Bns nhà',
                'imageAddress'=> 'anhnha.jpg',
                'user_id' =>'1',
                'partner'=>'VinHomes',
                'show' => 1,
                "expirationDate" => '2020-08-28 00:00:00',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],
            [
                'title' => 'Bns nhà',
                'imageAddress'=> 'anhnha.jpg',
                'user_id' =>'1',
                'partner'=>'VinHomes',
                'show' => 1,
                "expirationDate" => '2020-08-28 00:00:00',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],

        ]);
    }
}
