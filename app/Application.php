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
    
    protected $hidden = ['token', 'created_at', 'updated_at'];
    
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['user', 'status', 'type', 'course', 'section'];
    
    /**
     * Get the owner of this application
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the application status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(ApplicationStatus::class, 'application_status_id');
    }
    
    /**
     * Get the application type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(ApplicationType::class, 'application_type_id');
    }

    /**
     * Get the application course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the application section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    
    /**
     * Application main route key.
     *
     * @return string
     */
    public function getRouteKeyName(){
        return 'token';
    }

    /**
     * @param $isApproved
     * @param $message
     */
    public function handleLecturerApproval($isApproved, $message){
        $this->generateNewToken();
        $this->message = $message;
        
        $ASI_LecturerApproved = ApplicationStatus::where('name', ApplicationStatus::LecturerApproved)->first()->id;
        $ASI_LecturerRejected = ApplicationStatus::where('name', ApplicationStatus::LecturerRejected)->first()->id;
        
        if($isApproved){
            $this->application_status_id = $ASI_LecturerApproved;
        }else{
            $this->application_status_id = $ASI_LecturerRejected;
        }
        
        $this->save();
    }

    /**
     * @param $isApproved
     * @param $message
     */
    public function handleStudentsAffairsApproval($isApproved, $message){
        $this->token = null;
        $this->message = $message;
        
        $ASI_SACompleted = ApplicationStatus::where('name', ApplicationStatus::Completed)->first()->id;
        $ASI_SARejected = ApplicationStatus::where('name', ApplicationStatus::SARejected)->first()->id;
        
        if($isApproved){
            $this->application_status_id = $ASI_SACompleted;
        }else{
            $this->application_status_id = $ASI_SARejected;
        }
        
        $this->save();
    }

    /**
     * Generate new token.
     */
    public function generateNewToken(){
        $this->token = str_limit(md5( time() . str_random(25)), 25, '');
    }
}
