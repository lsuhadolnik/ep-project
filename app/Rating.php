<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Rating extends Model
{
    // Hide the attributes in JSON serialization
    protected $hidden = ['pivot', 'user_id', 'product_id'];
    protected $fillable = ['user_id', 'product_id', 'rating'];
    
    protected $primaryKey = ['user_id', 'product_id'];
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'product_ratings';

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('product_id', '=', $this->getAttribute('product_id'));
        return $query;
    }

}