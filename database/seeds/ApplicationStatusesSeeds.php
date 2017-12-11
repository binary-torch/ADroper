<?php

use Illuminate\Database\Seeder;

class ApplicationStatusesSeeds extends Seeder
{
    /**
     * All possible application's statuses.
     *
     * @var array
     */
    protected $statuses = [
        "Sent",
        "Lecturer Approved",
        "Lecturer Rejected",
        "S.A. Approved",
        "S.A. Rejected",
        "Completed"
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->statuses as $status){
            \App\ApplicationStatus::create([
                "name" => $status
            ]);
        }
    }
}
