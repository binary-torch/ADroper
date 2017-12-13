<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Models to be truncate before seeding.
     *
     * @var array
     */
    protected $toTruncate = [
        'users',
        'colleges',
        'courses',
        'sections',
        'application_statuses',
        'application_types'
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate();
        
        if (App::environment('local')) {
            $this->call(CollegesSeeds::class);
            $this->call(CoursesSeeds::class);
            $this->call(UsersSeeds::class);
            $this->call(SectionsSeeds::class);
        }
         
        $this->call(ApplicationStatusesSeeds::class);
        $this->call(ApplicationTypesSeeds::class);
    }
    
    public function truncate(){
        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
    }
}