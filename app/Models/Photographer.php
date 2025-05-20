<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Photographer extends Authenticatable
{
     protected $fillable = [
        'name',
        'email',
        'cif',
        'password',
    ];

     public function packs()
    {
        return $this->hasMany(Pack::class, 'photographer_id');
    }

     public function products()
    {
        return $this->hasMany(Product::class, 'photographer_id');
    }

    public function photoshoots()
    {
        return $this->hasMany(Photoshoot::class, 'photographer_id');
    }


}
