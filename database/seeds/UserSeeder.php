<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin123',
                'email' => 'ducpham123@gmail.com',
                'password' =>'$2y$10$F70xmZjpBmDUzCdJzB.n1emC.AbkXEYA9A/mMATANeWSYUVlHxIzi',
                'isAdmin'=> 1,
            ],  
        ]);
    }
}
