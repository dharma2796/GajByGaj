<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function findUserName($value){
        if(filter_var($value, FILTER_VALIDATE_EMAIL)){
            $data['type']='email';
            $data['regex']='email';
            //return false;
        }else{
            $data['type']='uuid';
            $data['regex']='regex:/^GBG|gbg|Gbg[0-9]{7}+$/';
        }
        return $data;
    }

}
