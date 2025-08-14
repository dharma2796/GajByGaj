<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionDetailsController extends Controller
{
    public function adminTopupPage(){
        $user=null;$roi=null;
        return view('control.adminTopup')->with('user',$user);
    }

    public function userSearchAdminTopup(Request $request){
        $user=\App\UserDetails::where('users.uuid',$request->userid)
        ->join('users','user_details.userid','users.id')
        ->select('users.email as email','users.usersname as name','users.uuid as userid')
        ->selectRaw('(user_details.id +'.\Session::get('logtime').') as id')
        ->first();
        $roiPlan=\App\CpsDetails::where('status',1)->selectRaw('(cps'.'%) as cps, (id+'.\Session::get('logtime').') as id')->get();
        if(is_null($user)){
            return redirect()->back()->with('warning','User not found. Check userid again.');
        }
        return view('control.aminTopup')->with('user',$user)->with('roi',$roiPlan);
    }

    public function adminTopupSubmit(){
        set_time_limit(0);
        $validator=Validator::make($request->all(),[
            'id'  =>  ['required','email','exists:users,uuid'],
            'amount'  => ['required','numeric'] ,
            'roi'   =>  ['required'],
            'project'   =>  ['required'],
            'size'  =>  ['required'],
            'quantity'  =>  ['required']
            'password'  =>['required'],
        ])->validate();
        if(!(\Hash::check($request->password,\Auth::user()->password))){
            return redirect()->back()->with('warning','Invalid Password. Please try with correct one.');
        }
        if($request->honeypotu<=\Session::get('logtime')){
            return redirect()->back()->with('warning','Error code 102. There is some issue.Please try again later.');
        }
        $user=\App\User::where('uuid',$request->id)->first();
        if($user->userDetails()->first()->id!=($request->honeypotu-\Session::get('logtime'))){
            return redirect()->back()->with('warning','Error code 103. There is some issue.Please try again later.');
        }
        $roiPlan=\App\CpsDetails::where('id',($request->roi-\Session::get('logtime')))->first();
        if(is_null($roiPlan)){
            return redirect()->back()->with('warning','Please select proper roi plan.');
        }
        $inserTransactionDetail=\App\TransactionDetails::insertGetId([
            'userid'  =>  $user->userDetails()->first()->id,
            'txntype'  =>  0,
            'amountsftc'  =>  $request->amount,
            'amountusdt'  =>  $request->amount,
            'remaining'  =>  0,
            'paymentstatus'  =>  2,
            'txndesc'  =>  'Admin Topup',
            'comments'  =>  'Admin Topup',
            'planid'  =>  1,
            'plan_status'  =>  1,
            'currency'  =>  'inr',
            'paidby'  =>  \Session::get('user.id'),
            'release_date'  =>  date('Y-m-d'),
            'deduction'  =>  0,
            'net_amount'  =>  $request->amount,
            'b_status'  =>  1,
        ]);
        $insertTransactionInfo=\App\TransactionInfo::create([
            'txnid'  =>  $inserTransactionDetail,
            'payment_addr'  =>  ' ',
            'payee_addr'  =>  ' ',
            'transaction_hash'  =>  'Admin Topup',
            'amount'  =>  $request->amount,
            'contract_addr'  =>  ' ' ,
            'txn_status'  =>  2,
            'updated_at'  =>  now(),
        ]);
        $createWalletTransfer=\App\WalletTransfer::create([
            'userid'  =>  $user->userDetails()->first()->id,
            'txnid'  =>  '0',
            'fromWallet'  =>  'AdminWallet',
            'toWallet'  =>  'Topup',
            'fromUser'  =>  \Session::get('user.id'),
            'amount'  =>  $request->amount,
            'release_date'  =>  date('Y-m-d'),
        ]);
        $planInsert=\App\PlanDetails::create([
            'userid'  =>  $user->userDetails()->first()->id,
            'amount'  =>  $request->amount,
            'amountusdt'  =>  $request->amount,
            'planname'  =>  $request->project,
            'size'  => $request->size ,
            'quantity'  =>  $request->quantity,
            'roiid'  =>  $roiPlan->id,
        ]);

        return redirect()->back()->with('success','Deposit Successfull');
    }
}
