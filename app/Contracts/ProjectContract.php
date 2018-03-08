<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Contracts;

interface ProjectContract
{
    public function getAll($limit = 10);

    public function getById($id);
}