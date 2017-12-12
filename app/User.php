<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['applications', 'college'];
    
    /**
     * Get all the user's applications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications(){
        return $this->hasMany(Application::class);
    }
    
    /**
     * Get the college that this user belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function college(){
        return $this->belongsTo(College::class);
    }
}
