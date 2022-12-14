<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['service_cid', 'name', 'charges', 'doctor_id', 'status'];

    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_cid', 'id')->withDefault();
    }

    public function doctors()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_services');
    }

}
