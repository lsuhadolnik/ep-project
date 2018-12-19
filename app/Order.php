<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    //

	protected $fillable = ['status', 'user_id'];
	protected $with = ['products'];
	protected $appends = ['totalPrice'];
	protected $hidden = ['pivot'];

	public function products() 
	{
		return $this->belongsToMany('App\Product', 'order_products')->withPivot('quantity');
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

	public function getTotalPriceAttribute(){

		if(!isset($this->id)){
			return 0;
			//throw new \Exception("Order ID not set. Did you save the model?");
		}

		$result = DB::select("SELECT 

		o.id AS OrderID, 
		SUM(p.price * op.quantity) AS TotalPrice
		
		FROM orders o 
		JOIN order_products op ON o.id = op.order_id 
		JOIN products p ON p.id = op.product_id
		WHERE o.id = ?	
		GROUP BY o.id", [$this->id]);

		if(count($result) == 0){
			return 0;
		}

		return $result[0]->TotalPrice;

	}

	public function modifyOrderProduct($product_id, $quantity){
		
		if(!$this->id) {
			$this->save();
		}

		// Če je quantity <= 0 -> odstrani iz košarice, če obstaja
		if($quantity <= 0) 
		{
			$this->products()->detach($product_id);
		}
		// Če je quantity > 0 -> dodaj/posodobi košarico
		else 
		{
			$p = $this->products()->find($product_id);
			if($p == null) 
			{
				$this->products()->attach($product_id, ['quantity' => $quantity]);
			}
			else
			{
				$p->pivot->quantity = $quantity;
				$p->save();
			}
			
		}

		return $this;
	}

}
