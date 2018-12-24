<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id', 'name'
    ];

}
