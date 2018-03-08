<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;
use App\Contracts\ReportContract;
use App\Contracts\ProjectContract;
use App\Models\Report;
use Auth;

class ReportService implements ReportContract
{
    protected $project;
            
    function __construct(ProjectContract $project) {
        $this->project = $project;
    }


    public function getAll($limit = 10)
    {
        $user = Auth::user();
        $is_not_admin = !$user->isAdmin();
        $user_id = $user->id;
        return Report::when($is_not_admin, function ($query) use ($user_id) {
                            return $query->where('created_by_id', $user_id);
                        })
                        ->orderBy('submission_date')
                        ->paginate($limit);
    }
    
    public function getProjectRef()
    {
        return $this->project;
    }
    
    public function save($request, $id = null) {
        try {
            if($id && $id>0){
                $report = Report::findOrFail($id);
            } else {
                $report = new Report();                
                $report->created_by_id = $request->user()->id;
            }            
            $report->document_title = $request->name;
            $report->version = $request->version;
            $report->project_id = $request->project;
            $report->tested_domain = $request->domain;
            $report->description = $request->description;
            $report->submission_date = $request->submission;
            $report->save();
            $status = 'success';
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
    
    public function getById($id)
    {
        return Report::findOrFail($id);
    }
    
    public function remove($id){
        try {
            if($id && $id>0){
                $report = Report::destroy($id);
                // its issues and screenshots also must be removed
                $status = 'success';
            } else {
                $status = 'failure';
            }
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
    
    public function approve($request, $id = null){
        try {
            if($id && $id>0){
                $report = Report::findOrFail($id);
                $report->approved_by_id = $request->user()->id;
                $report->approved_at = Carbon::now();
                $report->save();
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