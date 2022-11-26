<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = ['clinic_id', 'doctor_id', 'patient_id', 'date', 'medicine_name', 'frequency', 'duration', 'instruction'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id')->withDefault();
    }

    public function patients()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id')->withDefault();
    }

    public function doctors()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id')->withDefault();
    }
}
