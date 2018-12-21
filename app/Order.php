<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    //

	protected $fillable = ['user_id'];
	protected $with = ['products'];
	protected $appends = ['totalPrice', 'products'];
	protected $hidden = ['pivot', 'products'];

	public function products() 
	{
		return $this->belongsToMany('App\Product', 'order_products')->withPivot('quantity');
	}

	// @TODO Modify SetStatus Setter...

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
		
		// Če order še ne obstaja, ga ustvari
		if(!$this->id) {
			$this->save();
		}

		// Če je quantity <= 0 -> odstrani iz košarice, če obstaja
		if($quantity <= 0) 
		{
			$s = $this->products()->detach($product_id);
			if($s == 1)
			{
				$s = "Odstranjeno.";
			}
				
			return ["status" => $s, "action"=>"Remove order product $product_id."];
		}
		// Če je quantity > 0 -> dodaj/posodobi košarico
		else 
		{
			$p = $this->products()->find($product_id);
			if($p == null) 
			{
				$s = $this->products()->attach($product_id, ['quantity' => $quantity]);
				if(!$s)
				{
					$s = "Dodano.";
				}
				return ["status" => $s, "action"=>"Add new order product $product_id."];
			}
			else
			{
				$s = $this->products()->updateExistingPivot($product_id, ['quantity' => $quantity]);
				if($s == 1)
				{
					$s = "Količina posodobljena.";
				}
				else if($s == 0)
				{
					$s = "Količina ostaja enaka.";
				}
				return ["status" => $s, "action"=>"Change quantity of order product $product_id."];
			}
			
		}

		return $this;
	}

}
