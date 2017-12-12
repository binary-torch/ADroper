<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['status', 'type'];
    
    /**
     * Get the owner of this application
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the application status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(){
        return $this->belongsTo(ApplicationStatus::class, 'application_status_id');
    }
    
    /**
     * Get the application type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(){
        return $this->belongsTo(ApplicationType::class, 'application_type_id');
    }

    /**
     * Get the application course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the application section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(){
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * Return the progress percentage of the application.
     *
     * @return int
     */
    public function percentage()
    {
        $percentage = 0;

        switch ($this->status->name) {
            case ApplicationStatus::Sent:
                $percentage = 25;
                break;
            case ApplicationStatus::LecturerApproved || ApplicationStatus::LecturerRejected:
                $percentage = 50;
                break;
            case ApplicationStatus::SAApproved || ApplicationStatus::SARejected:
                $percentage = 75;
                break;
            case ApplicationStatus::Completed:
                $percentage = 100;
                break;
        }

        return $percentage;
    }
}
