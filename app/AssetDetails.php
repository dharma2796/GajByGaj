<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetDetails extends Model
{
    public $timestamps=false;

    protected $fillable =['userid','bep20addr','usdttrc20addr','usdtbep20addr','accountname','bankname','accountno','ifsc','upiid','name','landmark','address','city','state','pin','asset_status','updated_at'];
}
