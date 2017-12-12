<?php

use Illuminate\Database\Seeder;

class CollegesSeeds extends Seeder
{
    protected $colleges = [
        "LAWS",
        "ECONS",
        "IRKHS",
        "ENGIN",
        "KICT",
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->colleges as $college) {
            factory(\App\College::class, [
                "name" => $college
            ])->create();
        }
    }
}
