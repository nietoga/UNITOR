<?php

use Illuminate\Database\Seeder;
use App\Period;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Period::class, 6)->create();
    }
}
