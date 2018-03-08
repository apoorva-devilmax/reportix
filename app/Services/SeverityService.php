<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Models\Severity;
use App\Contracts\SeverityContract;
use Exception;

class SeverityService implements SeverityContract
{
    public function getAll($limit = 10)
    {
        return Severity::paginate($limit);
    }
    
    public function getById($id)
    {
        return Severity::findOrFail($id);
    }
    
    public function save($request, $id = null) {
        try {
            if($id && $id>0){
                $severity = Severity::findOrFail($id);
            } else {
                $severity = new Severity();
            }            
            $severity->level = $request->level;
            $severity->color_code = $request->color_code;
            $severity->description = $request->description;       
            $severity->save();
            $status = 'success';
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
    
    public function remove($id){
        try {
            if($id && $id>0){
                $severity = Severity::destroy($id);
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