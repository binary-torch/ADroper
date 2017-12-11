<?php

use Illuminate\Database\Seeder;

class CollegesSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\College::class, 10)->create();
    }
}
