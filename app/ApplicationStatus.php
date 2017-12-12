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
}
