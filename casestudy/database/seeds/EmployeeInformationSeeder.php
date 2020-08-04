<?php


use App\Models\EmployeeInformation;
use Illuminate\Database\Seeder;

class EmployeeInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EmployeeInformation::class, 5)->create();
    }
}
