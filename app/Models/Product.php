<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'name',
        'photographer_id',
        'img_url',
        'description',
        'price',
    ];
}
