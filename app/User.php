<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPasswordNotification;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\CanResetPassword;


use App\Order;
use App\Rating;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'address', 'email', 'phone', 'password'
    ];

    protected $attributes = [
        'status' => 'active',
        'role_id' => 3,
        'phone' => null,
        'surname' => null,
        'name' => null,
        'postal_code' => null
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
        return $this->belongsTo('\App\PostalCode', 'postal_code');
    }


    // Sanitize input
    public function setNameAttribute($name){
        $this->attributes['name'] = e($name);
    }
    public function setSurnameAttribute($name){
        $this->attributes['surname'] = e($name);
    }
    public function setAddressAttribute($name){
        $this->attributes['address'] = e($name);
    }
    public function setPhoneAttribute($name){
        $this->attributes['phone'] = e($name);
    }
    // ------------------------------------

    public function setPasswordAttribute($pass){
        $this->attributes['password'] = Hash::make($pass);
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

        $rating = min($rating, 5);
        $rating = max($rating, 0);

        

        try {
            
            return Rating::updateOrCreate([
                'user_id'=> $this->id,
                'product_id'=>$product_id,
            ], ["rating" => $rating]);

        } catch(Exception $e){
            return var_dump($e);
            return $e;
        }
        
    }

    public function getRating($product_id)
    {
        return Rating::where(["user_id"=>$this->id, "product_id"=>$product_id])->first();
    }


    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}
