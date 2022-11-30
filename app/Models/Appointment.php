<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['clinic_id', 'doctor_id', 'patient_id', 'schedule_id', 'description', 'status', 'payment_option', 'start_time', 'end_time'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id')->withDefault();
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id')->withDefault();
    }

    public function doctors()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id')->withDefault();
    }
    public function patients()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id')->withDefault();
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id')->withDefault();
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointment_service');
    }
}
