<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportQueries extends Model
{
    public $timestamps=false;

    protected $fillable=['uid','inqid','subject','title','message','answer','status','repliedby','created_at','updated_at',];
}
