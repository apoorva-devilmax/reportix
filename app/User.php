<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function hasRole($roles) {
        return in_array($this->role, $roles);
    }
    
    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'created_by_id');
    }
    
    public function reportsAsApprover()
    {
        return $this->hasMany('App\Models\Report', 'approved_by_id');
    }
    
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
    
    public function issuesAsRejecter()
    {
        return $this->hasMany('App\Issue', 'rejected_by_id');
    }
    
    public function screenshots()
    {
        return $this->hasMany('App\Models\Screenshot');
    }
    
    public function isReporter()
    {
        return $this->role === Role::REPORTER;
    }
    
    public function isAdmin()
    {
        return $this->role === Role::ADMIN;
    }
}
