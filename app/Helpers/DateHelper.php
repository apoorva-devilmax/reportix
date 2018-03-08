<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Helpers;
use \Carbon\Carbon;
/**
 * Description of DateHelper
 *
 * @author apoorva
 */
class DateHelper 
{
    public static function formatDate($datetime)
    {
        return Carbon::parse($datetime)->toFormattedDateString();
    }
    
    public static function formatDateTime($datetime)
    {
        return Carbon::parse($datetime)->toDayDateTimeString();
    }
}
