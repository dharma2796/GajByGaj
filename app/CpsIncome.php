<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CpsIncome extends Model
{
    public $timestamps=false;

    protected $fillable =['userid','txnid','amount','remaining','totalamount','status','intxna','intxnb','created_at','updated_at'];
}
