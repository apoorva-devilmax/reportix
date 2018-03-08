<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Severity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'severities';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public function vulnerabilities()
    {
        return $this->hasMany('App\Models\Vulnerability');
    }
    
    public function issues()
    {
        return $this->hasMany('App\Models\Issue');
    }
}
