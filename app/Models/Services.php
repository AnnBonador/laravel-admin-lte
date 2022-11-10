<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = ['service_cid', 'name', 'charges', 'doctor_id', 'status'];

    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_cid', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
