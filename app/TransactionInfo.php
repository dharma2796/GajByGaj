<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionInfo extends Model
{
    public $timestamps=false;

    protected $fillable =['txnid','payment_addr','payee_addr','transaction_hash','amount','updated_at','contract_addr','txn_status'];
}
