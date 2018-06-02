<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can create new application or not.
     *
     * @param  \App\User $user
     * @return mixed
     * @internal param Application $application
     */
    public function create(User $user)
    {
        $application = $user->applications()->where([
            'course_id'           =>  request()->course_id,
            'section_id'          => request()->section_id,
            'application_type_id' => request()->application_type_id
        ])->first();
        
        if($application){
            return false;
        }
        
        return true;
    }
}
