<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    public $timestamps=false;

    protected $fillable=['userid','sponserid','level','total_direct','active_direct','total_downline','active_downline','level_income','roi_income','wallet_amount','total_investment','current_investment','total_level_investment','current_level_investment','total_self_investment','current_self_investment','total_direct_investment','current_direct_investment','booster','level_status','capping','roi_status','updated_at','userstatus','userstate','clubuser','salaryuser'];



    public function assetDetail(){
        return $this->hasOne('\App\AssetDetails','userid','id')->first();
    }

    public function user(){
        return $this->hasOne('\App\User','id','userid')->first();
    }

    public function totalDirect(){
        return $this->hasMany('\App\UserDetails','sponsorid','userid')->get();
    }

    public function guiderDetails(){
        return $this->hasOne('\App\UserDetails','userid','sponsorid')->first();
    }

    public function directDetails(){
        return $this->totalDirect()->join('users' ,'user_details.userid','=','users.id')
        ->selectRaw('concat(email,"( ",usersname," )") as name,case when userstatus=1 then "circleGreen" when userstatus=0 then "circleRed" end as class,userid,sponsorid')
        ->get();
    }

    public function activeDirect(){
        return \App\UserDetails::where([['sponsorid',$this->userid],['userstatus',1]])->get();
    }

    
}
