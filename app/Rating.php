<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    // Hide the attributes in JSON serialization
    protected $hidden = ['pivot'];
    protected $fillable = ['user_id', 'product_id', 'rating'];
    
    public $timestamps = false;

    protected $table = 'product_ratings';

}