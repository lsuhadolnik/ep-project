<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

	protected $fillable = ['status', 'user_id'];
	protected $with = ['products'];
	protected $appends = ['products'];
	protected $hidden = ['pivot'];

	public function products() 
	{
		return $this->belongsToMany('App\Product', 'order_products');
	}

	public function getProductsAttribute()
	{
		return $this->products()->get();
	}
	
	public static function shoppingCart($user_id){

		return Order::firstOrNew([
			'user_id' => $user_id,
			'status' => 'draft'
		]);

	}

}
