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
    protected $fillable = [
        'name', 'surname', 'address', 'email', 'phone', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role_id'
    ];

	protected $with = ['role'];
	protected $appends = ['role'];

    public function role()
    {
		return $this->belongsTo('\App\Role');
    }

	public function getRoleAttribute()
	{ 
		return $this->role()->first();
	}

    public static function hello()
    {
		echo "Hello!";
    }

	public function orders()
	{
		return $this->hasMany('App\Order');
	}

	public function getShoppingCart()
	{

	}

}
