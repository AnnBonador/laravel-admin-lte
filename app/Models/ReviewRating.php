<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    use HasFactory;

    public function patients()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }
}
