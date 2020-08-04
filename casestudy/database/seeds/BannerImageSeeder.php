<?php

use App\Models\BannerImage;
use Illuminate\Database\Seeder;

class BannerImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BannerImage::class, 5)->create();
    }
}
