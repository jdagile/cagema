<?php

/*namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{*/

namespace App;
use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
//use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract
{
use Authenticatable, EntrustUserTrait;
//use Authenticatable, CanResetPassword,EntrustUserTrait;



    protected $table='users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public static function GetUsersJson($orderBy='id',$order='asc',$page=1,$rows=20)
    {
        $users=User::orderBy($orderBy, $order)->skip(($page-1)*$rows)->take(20)->get();
        return $users;
    }
}
