<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usersname', 'email', 'uuid', 'password', 'ccode', 'contact','gender', 'licence', 'permission', 'doj', 'created_at', 's_password', 'updated_at', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetails(){
        return $this->hasOne('\App\UserDetails','userid','id')->get();
    }

    public function maskedEmail(){
        
        $em   = explode("@",$this->email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        $len  = floor(strlen($name)/2);

        return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
    }

    public function maskedContact(){
        $length=strlen($this->contact);
        $frontlength=substr($this->contact,$length-10);
        return  substr($this->contact,0, $length-strlen($frontlength)).substr($this->contact,$length-strlen($frontlength), 2) . str_repeat('*', strlen($frontlength)-5) . substr($this->contact,$length-3, $length);
    }


}
