<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
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
    
    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }
    
    public function vulnerability()
    {
        return $this->belongsTo('App\Models\Vulnerability');
    }
    
    public function severity()
    {
        return $this->belongsTo('App\Models\Severity');
    }
    
    public function reporter()
    {
        return $this->belongsTo('App\User');
    }
    
    public function rejecter()
    {
        return $this->belongsTo('App\User', 'rejected_by_id');
    }
    
    public function screenshots()
    {
        return $this->hasMany('App\Models\Screenshot');
    }
}
