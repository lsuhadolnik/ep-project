<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use \App\Image;

class Product extends Model
{

	// Add the computed attributes to the JSON
	protected $appends = ['images', 'producer'];
	// Preload the relationships to save some bytes
	protected $with = ['producer', 'images'];	

	protected $hidden = ['pivot'];	
	

	// Define relationships
	public function images(){
		return $this->belongsToMany('App\Image', 'product_images');
	}

	public function producer(){
		return $this->belongsTo('App\Producer');
	}

	// Computed attributes Like-A-Boss :)
	public function getImagesAttribute() {
		return $this->images()->get();
	}

	public function getProducerAttribute(){
		return $this->producer()->first();
	}
}
