<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
//use App\Mail\VerificationEmail;
//use App\Mail\WelcomeMail;
use Mail;
use App\User;
//use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\V1\BaseController;

class RegisterController extends BaseController
{
    public function register(Request $request){
        $data=$request->all();

        $datareg=$this->findUserName($data['referrer']);
        $regex=['required',$datareg['regex']];

        $vali=Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referrer'  =>$regex,
            'contact'    => ['required', 'numeric'],
            'countrycode'    => ['required', 'string'],
            'gender'    => ['required', 'numeric'],
        ]);
        if($vali->fails()){
            return $this->sendError('Validation Error.', $vali->errors());
        }
        set_time_limit(0);
        $guiderid=0;
        if(!is_null($data['referrer'])){
            $guiderid=User::where($datareg['type'],$data['referrer'])->select('id')->get()->first();
            if(is_null($guiderid))
                return $this->sendError('Invalid Referrer Id', $errorMessages = [], $code = 404);
        }
            $uidd=$this->randomid();
        $user= User::create([
            'usersname' => $data['name'],
            'email' => $data['email'],
            'contact'    => $data['contact'],
            'ccode' => $data['countrycode'],
            'gender'    => $data['gender'],
            'password' => Hash::make($data['password']),
            's_password' => Crypt::encrypt($data['password']),
            'doj'       => date("Y-m-d"),
            'created_at'  => now(),
            'uuid' => $uidd,
            'email_verified_at' => now(),
            ]);
        $userdetails=\App\UserDetails::insertGetId([
                'userid'   => $user->id,
                'sponsorid' => is_object($guiderid)?$guiderid->id:$guiderid
            ]);
        $token = Str::random(64);
       /* $userVerification=\App\UserVerification::create([
            'userid'  =>  $user->id,
            'token'  =>  $token,
            'purpose'  =>  'verification',
            'created_at'  =>  now(),
        ]);*/
        
        $details['id']=$user->email;
        $details['password']=$data['password'];
        $details['uid']=$userdetails;
        $details['email']=$data['email'];
        $details['uniqueid']=$uidd;
        event(new \App\Events\UserRegistered($details));
        try{
            /*\Mail::to($data['email'])->send(new VerificationEmail($token));*/
            //\Mail::to($data['email'])->send(new WelcomeMail($details));
        }
        catch(Exception $e){
            \Log::info('Error in mails after registration of user id '.$userdetails);
            \Log::info($e->messages());
        }
        finally{
            $success['token'] =  $user->createToken('GBGApp')->accessToken;
            $success['name'] =  $user->name;
            $details=array('email' => $user->email,/* 'userid' => $uidd,*/ 'password'=>$data['password'] ,);
            return $this->sendResponse($details, 'User register successfully.');
        }
    }

    public function getSponsor(Request $request){
        $datareg=$this->findUserName($request->id);
        //$regex=['required',$datareg['regex']];
        $name=\App\User::where($datareg['type'],$request->id)->pluck('usersname')->first();
        if(is_null($name))
            return $this->sendError('Invalid Referrer Id', $errorMessages = [], $code = 404);
        else{
            return $this->sendResponse($name, 'Sponser Name.');
        }
    }

    public function forgetPasswordMailSend(Request $request){
        $datareg=$this->findUserName($request->email);
        $regex=['required',$datareg['regex'],'exists:users,'.$datareg['type']];
        $vali=Validator::make($request->all(),[
            'email'  => $regex,
        ]);
        if($vali->fails()){
            return $this->sendError('Validation Error.', $vali->errors()); 
        }
        $user=\App\User::where($datareg['type'],$request->email)->first();
        if(!is_null($user)){
            $randomString=$this->generateRandomString(64);
            $delExisting=\DB::delete('delete from password_resets where email = ?', [$request->email]);
            $insPswdReset=\DB::table('password_resets')->insert(['email'=>$request->email,'token'=>\Hash::make($randomString),'created_at'=>now()]);
            $data['user']=$user->email;
            $data['token']=$randomString;
            Mail::to($user->email)->send(new PasswordResetMail($data));
            return $this->sendResponse([],'Password reset link successfully sent to your mail '.$user->email);
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function randomid(){
        $val=true;
        while ( $val) {
            $num="GBG".rand(1111111,9999999);
            $chkUser=\App\User::where('uuid',$num)->first();
            if(is_null($chkUser)){
                $val=false;
            }
        }
        return $num;
    }
}
