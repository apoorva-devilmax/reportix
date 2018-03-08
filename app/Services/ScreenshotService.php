<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Contracts\ScreenshotContract;
use Exception;
use App\Models\Screenshot;
use File;
use App\Helpers\ImageHelper;

class ScreenshotService implements ScreenshotContract
{
    private static $storage_path = 'SCREEN/';
    
    public function getAll($request, $issue, $limit = 10)
    {
        $user =$request->user();
        $is_not_admin = !$user->isAdmin();
        $user_id = $user->id;
        return Screenshot::where('issue_id', $issue->id)
                        ->when($is_not_admin, function ($query) use ($user_id) {
                            return $query->where('user_id', $user_id);
                        })
                        ->get();
    }
    
    public function save($request, $issue, $id = null) {
        try {
            if($id && $id>0){
                $screenshot = Screenshot::findOrFail($id);
                //image upload
                if ($request->hasFile('screen')) {
                    $save_path = self::$storage_path.$issue->report->project->id.'/'.$issue->report->id.'/'.$issue->id;
                    $upload = ImageHelper::replace($screenshot->img_name, $save_path, $request, 'screen');
                    if ($upload['status'] === 'success'){
                        $screenshot->img_path = $save_path;
                        $screenshot->img_name = $upload['file_name'];
                    } else {
                        throw new Exception('File could not be uploaded.');
                    }
                }
            } else {
                $screenshot = new Screenshot();
                $screenshot->user_id = $request->user()->id;
                $screenshot->issue_id = $issue->id;
                //image upload
                if ($request->hasFile('screen')) {
                    $save_path = self::$storage_path.$issue->report->project->id.'/'.$issue->report->id.'/'.$issue->id;
                    $upload = ImageHelper::upload($save_path, $request, 'screen');
                    //dd($upload);
                    if ($upload['status'] === 'success'){
                        $screenshot->img_path = $save_path;
                        $screenshot->img_name = $upload['file_name'];
                    } else {
                        throw new Exception('File could not be uploaded.');
                    }
                } else {
                    throw new Exception('Screenshot file is not present.');
                }
                
            }
            $screenshot->img_description = $request->description;
            
            $screenshot->save();
            $status = 'success';
        } catch (Exception $ex) {
            $status = 'failure';
        }
        return $status;
    }
    
    public function getById($id)
    {
        return Screenshot::findOrFail($id);
    }
    
    public function remove($issue, $id){
        try {
            if($id && $id>0){
                $screenshot = $this->getById($id);
                // store the img name
                $img_path = $screenshot->img_path;
                $img_name = $screenshot->img_name;
                $screenshot->delete();
                // also unlink the uploaded image
                ImageHelper::unlink($img_path, $img_name);
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