<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => '1',
                'title' => 'TO LEAVE THE.;',
                'content' => 'TO LEAVE THE.',
                'coverImage'=> 'anhnha.jpg',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
                "expirationDate" => '2020-08-28 00:00:00'
            ],   
            [
                'user_id' => '1',
                'title' => 'TO LEAVE THE.;',
                'content' => 'TO LEAVE THE.',
                'coverImage'=> 'anhnha.jpg',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
                "expirationDate" => '2020-08-28 00:00:00'
            ], 
            
        ]);
    }
}
