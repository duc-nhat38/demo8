<?php

use App\Models\UserInformation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_information')->insert([
            [
                'fullName' => 'admin123',
                'phone' => '123456',
                'address' =>'Hà tĩnh',
                'user_id'=> 1,
                'avatar'=> 'avatar.jpg',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],  
        ]);
    }
}
