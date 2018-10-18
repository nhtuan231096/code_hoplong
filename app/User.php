<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $fillable = [
        'username','fullname','email', 'password','avatar','group_id','status'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function group(){
        return $this->hasOne('App\Models\User_group','id','group_id');
    }
    public $remember_token=false;
}
