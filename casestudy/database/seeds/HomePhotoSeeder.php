<?php

use App\Models\HomePhoto;
use Illuminate\Database\Seeder;

class HomePhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(HomePhoto::class, 20)->create();
    }
}
