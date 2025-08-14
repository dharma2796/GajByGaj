<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use DB;

class UserDetailController extends BaseController
{
    public function dashboard(Request $request){
        $data['userDetail']=\App\UserDetails::where('id',$request->user()->userDetails()->first()->id)->select('total_direct as totaldirect','active_direct as activedirect','total_downline as totaldownline','active_downline as activedownline','current_self_investment as myinvestment')
        ->selectRaw('(current_investment-current_self_investment) as totalbusiness')->first();
        
        /*$data['withdrawAmount']=DB::table('transaction_details')->where([['transaction_details.userid',$request->user()->userDetails()->first()->id],['transaction_details.txntype','1'],['transaction_details.txndesc','Withdrawal'],['transaction_details.paymentstatus',2]])
        ->select(DB::raw('sum(amountusdt) as amount'))
        ->get()->first();
        $directincm=DB::table('bonus_rewards')->where([['userid',$request->user()->userDetails()->first()->id],['description','referral']])
        ->select(DB::raw('sum(amount) as directincome'))
        ->get()->first();*/

        //$data['currentDeposit']=$request->user()->userDetails()->first()->stackingDeposite()->where('status','>',0)->sum('amount');
        /*$data['firstdeposit']=\App\StakingDeposit::where('userid',$request->user()->userDetails()->first()->id)->first();
        
        $data['totalIncome']=$request->user()->userDetails()->first()->totalIncome();
        $data['unpaidIncome']=$request->user()->userDetails()->first()->remainingIncome();
        $data['tradingDividend']=$request->user()->userDetails()->first()->stackingIncome()->sum('amount');
        $data['directIncome']=$request->user()->userDetails()->first()->bonusReward()->where('description','referral')->sum('amount');
        $data['tradingDividendBonus']=$request->user()->userDetails()->first()->levelIncome()->sum('amount');
        $data['teamGenerationIncome']=$request->user()->userDetails()->first()->clubIncome()->where('desc','G')->sum('amount');
        $data['generationBonus']=$request->user()->userDetails()->first()->clubIncome()->where('desc','R')->sum('amount');
        $data['salary']=$request->user()->userDetails()->first()->salaryIncome()->where('txnDesc','Salary')->sum('amount');*/
        
        /*if ($request->user()->userDetails()->first()->booster==2) {
            $data['boosterStatus']="Active";
        }else{
            $data['boosterStatus']="Inactive";
        }

        if(!is_null($request->user()->userDetails()->first()->userLoanStatus())){
            $data['loanAmount']=$request->user()->userDetails()->first()->userLoanStatus()->amount;
            $data['dueLoanAmount']=$request->user()->userDetails()->first()->userLoanStatus()->remaining;
        }else{
            $data['loanAmount']=0;
            $data['dueLoanAmount']=0;
        }*/

        /*$data['lockedIncome']=$request->user()->userDetails()->first()->lockedIncome();*/
        
        
        $data['referrallink']=url('/').'/register/'.$request->user()->email;
        
        $data['marquee']='Welcome to GajByGaj';
        $data['directList']=\App\UserDetails::where('sponsorid',$request->user()->userDetails()->first()->userid)
        ->join('users as u','user_details.userid','=','u.id')
        ->select(/*'u.id as id',*/ 'u.usersname as name', 'u.email as userID', 'u.doj as doj')
        ->selectRaw('case when user_details.userstatus=0 then "Unpaid" when user_details.userstatus=1 then "Paid" end as status')
        ->orderByRaw('u.id DESC')
        ->get();
        
        return $this->sendResponse($data,'Dashboard Data');
    }

    public function userProfile(Request $request){//dd($request->user()->maskedEmail(),$request->user()->maskedContact());
        $userdata=$this->userDatas($request);
        return $this->sendResponse($userdata,'Profile Data');
    }

    public function userDatas($request){

        $userdata['email']=$request->user()->maskedEmail();
        $userdata['name']=$request->user()->usersname;
        /*$userdata['userid']=$request->user()->uuid;*/
        $userdata['phone']=$request->user()->maskedContact();
        $userdata['guiderId']=$request->user()->userDetails()->first()->guiderDetails()->first()->user()->email;
        $userdata['guiderName']=$request->user()->userDetails()->first()->guiderDetails()->first()->user()->usersname;
        $userdata['bankname']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->bankname);
        $userdata['accountname']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->accountname);
        $userdata['accountno']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->accountno);
        $userdata['ifsc']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->ifsc);
        $userdata['upiid']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->upiid);
        $userdata['address']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->address);
        $userdata['city']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->city);
        $userdata['state']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->state);
        $userdata['pin']=(is_null($request->user()->userDetails()->first()->assetDetail())?null:$request->user()->userDetails()->first()->assetDetail()->pin);
        return $userdata;
    }

     public function updateUserDetails(Request $request){

        set_time_limit(0);
        /*$editstatus=\App\AssetDetailChanges::where([['userid',$request->user()->userDetails()->first()->id],['asset_status','>',0]])->get();
        if(count($editstatus)){
            return $this->sendError('Validation Error.', ['errors'=>'You already have a mail in your inbox to confirm.Please check your inbox.']);
        }*/
        $vali=Validator::make($request->all(),[
            'bankname'   =>['string','nullable'],
            'accountname'  =>  ['string','nullable'],
            'accountno'  =>  ['numeric','nullable'],
            'ifsc'  =>  ['string','nullable'],
            'upiid'  =>  ['string','nullable'],
            'address'  =>  ['string','nullable'],
            'city'  =>  ['string','nullable'],
            'state'  =>  ['string','nullable'],
            'pin'  =>  ['numeric','nullable'],
        ]);
        if($vali->fails()){
            return $this->sendError('Validation Error.', $vali->errors());       
        }
        $arrayName= array();
        if(!is_null($request->bankname)){$arrayName['bankname'] = $request->bankname;}
        if(!is_null($request->accountname)){$arrayName['accountname'] = $request->accountname;}
        if(!is_null($request->accountno)){$arrayName['accountno'] = $request->accountno;}
        if(!is_null($request->ifsc)){$arrayName['ifsc'] = $request->ifsc;}
        if(!is_null($request->upiid)){$arrayName['upiid'] = $request->upiid;}
        if(!is_null($request->address)){$arrayName['address'] = $request->address;}
        if(!is_null($request->city)){$arrayName['city'] = $request->city;}
        if(!is_null($request->state)){$arrayName['state'] = $request->state;}
        if(!is_null($request->pin)){$arrayName['pin'] = $request->pin;}
        if(sizeof($arrayName)){
            if(count($arrayName))
                $userUpdate=\App\AssetDetails::updateOrCreate(['userid'=>$request->user()->userDetails()->first()->id],
                    $arrayName
                );
            
            return $this->sendResponse($this->userDatas($request) ,'Profile Updated');

        }else{
            return $this->sendError('Validation Error.', ['errors'=> 'please update atleast one address.']);
        }        
    }


    public function updateUserPasswords(Request $request){
        $vali=Validator::make($request->all(),[
            'old_password'=>    ['required', 'string'],
            'new_password'=>    ['required' ,'string', 'min:6'/*, 'confirmed'*/],
        ]);
        if($vali->fails()){
            return $this->sendError('Validation Error.', $vali->errors());
        }
        if(\Hash::check($request->old_password, $request->user()->password)){
            $userUpdate=\App\User::where('id',$request->user()->id)->update([
                'password'  => \Hash::make($request->new_password),
                's_password' => Crypt::encrypt($request->new_password),
            ]);
            return $this->sendResponse([],'Password Changed.');
        }else{
            return $this->sendError('Validation Error', ['errors'   => 'Old Password is not correct.']);
        }
    }

    public function directTeam(Request $request){
        $direct=\App\UserDetails::where('user_details.id',$request->user()->userDetails()->first()->id)->join('user_details as ud','ud.sponsorid','=','user_details.userid')->join('users','ud.userid','=','users.id')->select('users.email as email','usersname as name',/*'uuid as userid',*/'contact as phone','doj as date')->get();
        foreach($direct as $d){
            $d->email=$this->maskedEmail($d->email);
            $d->phone=$this->maskedContact($d->phone);
        };
        return $this->sendResponse($direct,'Direct Details');
    }

    public function getTotalTeam(Request $request){
        $ar=array();
        $usrid=DB::table('user_details')->where('id',$request->user()->userDetails()->first()->id)->get()->pluck('userid')->first();
        $udata=DB::table('users')->where('id',$usrid)->first();
        if(is_null($udata)){
            return $this->sendError('User not found.', []);
        }
        else{
            $uid=array($usrid);
            for($i=1;$i<21;$i++){
                $arl=array();
                $rData=DB::table('users')->where('users.permission','1')
                ->whereIn('ud.sponsorid',$uid)
                ->join('user_details as ud','users.id','=','ud.userid')
                ->join('users as gu','ud.sponsorid','=','gu.id')
                ->select(/*'users.id as id',*/'users.usersname as name','users.email as username','ud.total_investment as team_business',/*'users.uuid as userid',*/'ud.current_self_investment as self_investment'/*,'gu.usersname as guidername','gu.user_gf as guidergf'*/)
                ->selectRaw('"Level-'. $i.'" as level,DATE_FORMAT(users.doj,"%d-%m-%Y") as doj')
        ->selectRaw('case when ud.userstatus=0 then "Unpaid" when ud.userstatus=1 then "Paid" end as status')
                ->get();
                foreach ($rData as $key ) {
                    $key->username=$this->maskedEmail($key->username);
                    array_push($arl, $key);
                }
                $ar['level'.$i]=$arl;
                $id=DB::table('user_details')->whereIn('sponsorid',$uid)->selectRaw('userid')->get()->pluck('userid');
                if(count($id)==0||$id=="")
                    break;
                else{  
                    $uid=$id;
                }
            }

            return $this->sendResponse($ar,'Team Details');
        }
    }

    public function getTotalTeamHeading(Request $request){
        $data['totalbusiness']=\App\UserDetails::where('id',$request->user()->userDetails()->first()->id)->select('current_investment as totalbusiness')->first();
        $data['headingsmall']='Refer your friends';
        $data['headinglarge']='Earn upto 2% reward';

        return $this->sendResponse($data,'Team Dashboard');
    }

    public function userDirectList(Request $request){
        $datareg=$this->findUserName($request->userid);
        $regex=['required','exists:users,'.$datareg['type']];

        $direct=\App\UserDetails::where('u.'.$datareg['type'],$request->userid)->join('users as u','user_details.userid','=','u.id')->join('user_details as ud','ud.sponsorid','=','user_details.userid')->join('users','ud.userid','=','users.id')
        ->select('users.email as email','users.usersname as name',/*'users.uuid as userid',*/'users.contact as phone','users.doj as date','ud.current_self_investment as currentselfamount','ud.current_investment as currentteamamount','ud.total_downline as totaldownline')->get();
        foreach($direct as $d){
            $d->email=$this->maskedEmail($d->email);
            $d->phone=$this->maskedContact($d->phone);
        };
        return $this->sendResponse($direct,'Direct Details');
    }

    public function logOutUser(Request $request){
        auth('api')->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return $this->sendResponse([],'Logged Out.');
    }



}
