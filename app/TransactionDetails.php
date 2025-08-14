<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    public $timestamps=false;

    protected $fillable =['userid','txntype','amountsftc','amountusdt','remaining','paymentstatus','txndesc','comments','planid','plan_status','currency','paidby','release_date','deduction','net_amount','b_status' ,'updated_at'];

    public function userDetail(){
        return $this->belongsTo('\App\UserDetails','userid','id')->first();
    }

    public function transactionInfo(){
        return $this->hasOne('\App\TransactionInfo','txnid','id')->first();
    }
}
