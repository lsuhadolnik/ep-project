<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use \App\Image;

class Product extends Model
{

	// Add the computed attributes to the JSON
	protected $appends = ['images', 'rating', 'quantity'];
	// Preload the relationships to save some bytes
	protected $with = ['producer', 'images'];
	protected $hidden = ['producer_id', 'producer', 'status', 'created_at', 'updated_at', 'pivot'];

	// Define relationships
	public function images(){
		return $this->belongsToMany('App\Image', 'product_images');
	}

	public function producer(){
		return $this->belongsTo('App\Producer');
	}

	public function getProducerNameAttribute()
	{

	}

	// Computed attributes Like-A-Boss :)
	public function getImagesAttribute() {
		return $this->images()->get();
	}

	public function getQuantityAttribute() {
		if(!isset($this->pivot)){
			return 0;
		}
		
		return $this->pivot->quantity;
	}

	public function getProducerAttribute(){
		$p = $this->producer()->first();
		if($p){
			return $p->name;
		}

		return null;
	}

	public function getRatingAttribute(){


		$rating_info = DB::select(
			"SELECT 
				COUNT(*) AS num_ratings, 
				SUM(pr.rating)/COUNT(*) AS rating 
			FROM product_ratings pr 
			WHERE pr.product_id = ?", [$this->id]);

		if($rating_info == null){
			return null;
		}

		if(count($rating_info) == 0){
			return null;
		}

		$rating_info = $rating_info[0];

		if($rating_info->num_ratings == 0){
			$rating_info->rating = 0;
		}

		return $rating_info;

	}

	public static function mostWanted($n = 10)
	{
		$ids = DB::select("SELECT p.id AS id, SUM(op.quantity) AS quantity
		FROM products p 
        JOIN order_products op ON p.id = op.product_id
        JOIN orders o ON o.id = op.order_id
        
        WHERE o.status != 'draft'
        
		GROUP BY p.id
		ORDER BY SUM(op.quantity)
        LIMIT ?", [$n]);

		if($ids == null){
			return null;
		}

		$product_ids = [];
		foreach($ids as $product_stat){
			$product_ids[] = $product_stat->id;
		}

		return Product::whereIn('id', $product_ids)->get();

	}

	public static function topRated($n = 10)
	{
		$ids = DB::select("SELECT 
		
		pr.product_id as id, 
		AVG(pr.rating) AS rating, 
		COUNT(pr.rating) AS num_ratings
		
		FROM product_ratings pr
		GROUP BY pr.product_id
		ORDER BY AVG(pr.rating) DESC
		LIMIT ?", [$n]);

		if($ids == null){
			return;
		}

		$p_ids = [];
		foreach($ids as $product_stat){
			$p_ids[] = $product_stat->id;
		}

		return Product::whereIn('id', $p_ids)->get();

	}

}
