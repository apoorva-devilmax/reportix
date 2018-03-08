<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;
use App\Contracts\ProjectContract;
use App\Models\Project;
use Exception;

class ProjectService implements ProjectContract
{
    public function getAll($limit = 10)
    {
        return Project::orderBy('name')->paginate($limit);
    }
    
    public function getById($id)
    {
        return Project::findOrFail($id);
    }
    
    public function save($request, $id = null) {
        try {
            if($id && $id>0){
                $project = Project::findOrFail($id);
            } else {
                $project = new Project();
                $project->code = $request->code;
            }            
            $project->name = $request->name;
            $project->domain = $request->domain;
            $project->description = $request->description;       
            $project->save();
            $status = 'success';
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
    
    public function remove($id){
        try {
            if($id && $id>0){
                $project = Project::destroy($id);
                $status = 'success';
            } else {
                $status = 'failure';
            }
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
    
    public function getProjectForDropdown()
    {
        return Project::select('id', 'name', 'code')->get();
    }
}