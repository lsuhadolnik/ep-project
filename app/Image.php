<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Hide the attributes in JSON serialization
	protected $hidden = ['pivot', 'created_at', 'updated_at'];

    protected $fillable = ['name', 'path', 'description'];

}
