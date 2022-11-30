<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentService extends Model
{
    use HasFactory;
    protected $table = 'appointment_service';
    public $timestamps = false;
    protected $fillable = ['appointment_id', 'service_id'];
}
