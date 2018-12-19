<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Order;
use App\Rating;

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

    public function postalCode()
    {
        return $this->belongsTo('\App\PostalCode');
    }


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

	public function orders($status = 'none')
	{

        if(($status != 'none')){
            return $this->hasMany('App\Order')->where('status', $status);
        }

		return $this->hasMany('App\Order');
	}

	public function shoppingCart()
	{
        if(isset($this->id))
        {
            return Order::shoppingCart($this->id);
        }
        else
        {
            throw new \Exception("User ID is not set. Did you save the model?");
        }
    }
    


    // Edit

    public function setRole($role_name) {
        
        $role = Role::where('name', $role_name)->first();

        if(!$role)
        {
            return false;
        }

        $this->role_id = $role->id;
        return $this->save();

    }

    public function rateProduct($product_id, $rating){

        try {
            return Rating::create([
                'user_id'=>$this->id,
                'product_id'=>$product_id,
                'rating'=>$rating
            ]);
        } catch(Exception $e){
            return false;
        }
        
    }

}
