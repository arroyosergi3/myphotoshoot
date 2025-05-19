<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
     public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }
}
