<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletTransfer extends Model
{
    public $timestamps=false;

    protected $fillable=['userid','txnid','fromWallet','toWallet','price','amount','type','updated_at',];
}
