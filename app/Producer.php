<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{

	protected $fillable = [
		'name', 'description'
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];

}
