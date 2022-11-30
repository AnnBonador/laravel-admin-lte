<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['invoice', 'reference_no', 'appointment_id', 'clinic_id', 'doctor_id', 'patient_id', 'first_name', 'last_name', 'email', 'contact', 'amount', 'status'];
}
