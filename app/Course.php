<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Get all sections of this course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections(){
        return $this->hasMany(Section::class);
    }
}
