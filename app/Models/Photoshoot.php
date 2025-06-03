<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photoshoot extends Model
{
    protected $fillable = [
    'name',
    'description',
    'duration',
    'img_url',
    'photographer_id',
];

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }
     public function packs()
    {
        return $this->hasMany(Pack::class, 'photoshoot_id');
    }



  
}
