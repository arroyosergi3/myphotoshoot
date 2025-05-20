<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function photos()
    {
        return $this->hasMany(Photo::class, 'client_id');
    }

}
