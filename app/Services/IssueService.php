<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Contracts\IssueContract;
use App\Contracts\VulnerabilityContract;
use App\Contracts\SeverityContract;
use App\Models\Issue;
use Carbon\Carbon;

class IssueService implements IssueContract
{
    protected $vulnerability;
    protected $severity;
            
    function __construct(VulnerabilityContract $vulnerability, SeverityContract $severity) {
        $this->vulnerability = $vulnerability;
        $this->severity = $severity;
    }
    
    public function getVulnerabilityRef()
    {
        return $this->vulnerability;
    }
    
    public function getSeverityRef()
    {
        return $this->severity;
    }
    
    public function getAll($request, $report, $limit = 10)
    {
        $user =$request->user();
        $is_not_admin = !$user->isAdmin();
        $user_id = $user->id;
        return Issue::where('report_id', $report->id)
                        ->when($is_not_admin, function ($query) use ($user_id) {
                            return $query->where('user_id', $user_id);
                        })
                        ->orderBy('severity_id')
                        ->paginate($limit);
    }
    
    public function save($request, $report, $id = null) {
        try {
            if($id && $id>0){
                $issue = Issue::findOrFail($id);
            } else {
                $issue = new Issue();                
                $issue->user_id = $request->user()->id;
                $issue->report_id = $report->id;
            }
            $issue->name = $request->name;
            $issue->vulnerability_id = $request->vulnerability;
            $issue->severity_id = $request->severity;
            $issue->description = $request->description;
            $issue->recommendation = $request->recommendation;
            $issue->affected_url = $request->url;
            $issue->affected_params = $request->param;
            $issue->save();
            $status = 'success';
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
    
    public function getById($id)
    {
        return Issue::findOrFail($id);
    }
    
    public function remove($id){
        try {
            if($id && $id>0){
                $issue = Issue::destroy($id);
                // its screenshots also must be removed
                $status = 'success';
            } else {
                $status = 'failure';
            }
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
    
    public function reject($request, $id = null){
        try {
            if($id && $id>0){
                $issue = Issue::findOrFail($id);
                $issue->rejected_by_id = $request->user()->id;
                $issue->rejected_at = Carbon::now();
                $issue->save();
                $status = 'success';
            } else {
                $status = 'failure';
            }
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
}