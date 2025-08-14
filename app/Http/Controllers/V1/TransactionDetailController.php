<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('logout');
        $this->username = $this->username();
    }

    public function editUserDetails(){

    }
}
