<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function gallery()
    {
        return $this->belongsTo(Photoshoot::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
