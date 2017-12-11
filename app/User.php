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
    protected $with = ['applications'];
    
    /**
     * Get all the user's applications
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications(){
        return $this->hasMany(Application::class);
    }
}
