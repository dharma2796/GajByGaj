<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDetails extends Model
{
    public $timestamps=false;

    protected $fillable =['userid','amount','amountusdt','planname','size','quantity','roiid','status','created_at','updated_at'];
}
