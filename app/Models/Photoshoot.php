<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photoshoot extends Model
{
    protected $fillable = [
    'name',
    'description',
    'img_url',
    'photographer_id',
];

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
