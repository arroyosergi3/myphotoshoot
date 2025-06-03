<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['user_id', 'photographer_id', 'appointment_date', 'notes','duration',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }
}
