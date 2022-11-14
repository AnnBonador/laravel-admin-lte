<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $casts = [
        'service' => 'json',
    ];

    public function setServiceAttribute($value)
    {
        $this->attributes['service'] = json_encode($value);
    }

    public function getServiceAttribute($value)
    {
        return json_decode($value);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
    
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    // public function schedules()
    // {
    //     return $this->belongsTo(Schedule::class);
    // }
}
