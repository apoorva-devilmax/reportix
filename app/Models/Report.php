<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    /**
     * Enable Soft Delete
     */
    use SoftDeletes;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
    
    public function author()
    {
        return $this->belongsTo('App\User', 'created_by_id');
    }
    
    public function approver()
    {
        return $this->belongsTo('App\User', 'approved_by_id');
    }
    
    public function issues()
    {
        return $this->hasMany('App\Models\Issue');
    }

}
