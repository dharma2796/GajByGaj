<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CpsDetails extends Model
{
    public $timestamps=false;

    protected $fillable =['cps','status'];
}
