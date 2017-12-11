<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
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
