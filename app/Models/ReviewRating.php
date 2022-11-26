<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    use HasFactory;

    public function patients()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id')->withDefault();
    }
    public function doctors()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id')->withDefault();
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id')->withDefault();
    }
}
