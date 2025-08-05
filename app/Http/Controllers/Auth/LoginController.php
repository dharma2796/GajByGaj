<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo(){
        $user=\App\UserDetails::where('users.id',\Auth::user()->id)
            ->join('users','users.id','=','user_details.userid')
            ->leftjoin('users as u','u.id','=','user_details.sponsorid')
            ->select('user_details.id as id','users.usersname as name','users.email as email','users.uuid as uuid','users.doj as doj','u.uuid as sponsorid','users.contact as contact','users.licence as licence','users.permission as permission')
            ->first();
            \Session::put('user', $user);
            \Session::put('logtime',strtotime(now()));
            /*\Session::put('isMobile',1);*/
            
            
        //return '/User/Dashboard';
        if ($user->licence=='3') {
                return '/Main/Dashboard';
            }
            elseif($user->licence=='2'){
                return '/Manage/Dashboard';
            }
            else{
                return '/User/Dashboard';
            }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->username();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */

     public function username()
    {
        $login = request()->input('email');
 
        $fieldType ='uuid';
        
        request()->merge([$fieldType => $login]);
        request()->merge([
            'uuid' => request()->request->get('email'),
        ]);
        return $fieldType;
    }

}
