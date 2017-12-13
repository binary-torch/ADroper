<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    const Sent = "Sent";
    const LecturerApproved = "Lecturer Approved";
    const LecturerRejected = "Lecturer Rejected";
    const SAApproved = "S.A. Approved";
    const SARejected = "S.A. Rejected";
    const Completed = "Completed";
    
    const SentResponse = "Your application has been sent and waiting for the lecturer approval.";
    const LecturerApprovedResponse = "Congratulations, your application has been approved by your lecturer and now in process of getting students affairs approval.";
    const LecturerRejectedResponse = "Sorry, your application has been rejected by the lecturer due to: ";
    const SAApprovedResponse = "Congratulations, your application has been approved by the students affairs and waiting to be added in the system.";
    const SARejectedResponse = "Sorry, your application has been rejected by the students affairs due to: ";
    const CompletedResponse = "Yaah 🎉, congratulations the course has been added successfully, good luck in your semester.";
    
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Get the applications of status this.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications(){
        return $this->hasMany(Application::class);
    }
    
    /**
     * Get the progress percentage of the application based on it's current status.
     *
     * @param $status
     * @return int
     */
    public static function percentage($status){
        switch ($status) {
            case self::Sent:
                return 25;
            case self::LecturerApproved || self::LecturerRejected:
                return 50;
            case self::SAApproved || self::SARejected:
                return 75;
            case self::Completed:
                return 100;
        }
    }
    
    /**
     * Get the feedback message of the application based on it's current status.
     *
     * @param $status
     * @return string
     */
    public static function feedback($status){
        switch ($status) {
            case self::Sent:
                return self::SentResponse;
            case self::LecturerApproved:
                return self::LecturerApprovedResponse;
            case self::LecturerRejected:
                return self::LecturerRejectedResponse;
            case self::SAApproved:
                return self::SAApprovedResponse;
            case self::SARejected:
                return self::SARejectedResponse;
            case self::Completed:
                return self::CompletedResponse;
        }
    }
}
