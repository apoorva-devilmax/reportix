<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Helpers;
use Storage;
use File;
use Exception;
/**
 * Description of ImageHelper
 *
 * @author apoorva
 */
class ImageHelper 
{
    private static $storage_salt = '4~1@7b82#8=5d(c84*bb$1ff)3e-7+2';

    public static function upload($path, $request, $upload_field_name)
    {
        $file = $request->file($upload_field_name);
        $filename = md5($file->getClientOriginalName().time().self::$storage_salt).'.'.$file->getClientOriginalExtension();
        $absolute_path = storage_path('app/'.$path);
        try {
            if(!File::exists($absolute_path)){
                File::makeDirectory($absolute_path, 0755, true);
            }
            Storage::put(
                $path.'/'.$filename,
                file_get_contents($file->getRealPath())
            );
            $status = 'success';
        } catch (Exception $ex) {
            $status = 'failure';
            $filename = null;
        }        
        return [
            'status' => $status,
            'file_name' => $filename,
        ];
    }
    
    public static function replace($old_file, $path, $request, $upload_field_name)
    {
        $file = $request->file($upload_field_name);
        $new_filename = md5($file->getClientOriginalName().time().self::$storage_salt).'.'.$file->getClientOriginalExtension();
        $absolute_path = storage_path('app/'.$path);
        try {
            if(!File::exists($absolute_path)){
                File::makeDirectory($absolute_path, 0755, true);
            }
            Storage::put(
                $path.'/'.$new_filename,
                file_get_contents($file->getRealPath())
            );
            $delete = self::unlink($path, $old_file);
            $status = 'success';
        } catch (Exception $ex) {
            $status = 'failure';
            $new_filename = null;
        }        
        return [
            'status' => $status,
            'file_name' => $new_filename
        ];
    }
    
    public static function unlink($path, $filename)
    {
        try {
            Storage::delete($path.'/'.$filename);
            return true;
        } catch (Exception $ex) {
            return false;
        }        
    }
    
    public static function getSecureImageURL($path, $filename)
    {
        try {
            // Read image path, convert to base64 encoding
            $imageData = base64_encode(Storage::get($path.'/'.$filename));

            // Format the image SRC:  data:{mime};base64,{data};
            $src = 'data: image;base64,'.$imageData;
            return $src;
        } catch (Exception $ex) {
            return null;
        }
    }
}
