<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $fillable = [
    'name',
    'description',
    'photoshoot_id',
    'price',
    'img_url',
    'photographer_id',
];

     public function photographer()
    {
        return $this->belongsTo(Photographer::class, 'photographer_id');
    }
    public function photoshoot()
    {
        return $this->belongsTo(Photoshoot::class, 'photoshoot_id');
    }
    public function products()
{
    return $this->belongsToMany(Product::class, 'pack_products')
        ->withPivot('cuantity') 
        ->withTimestamps();
}


}
