<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinic extends Model
{
    use HasFactory;

    protected $casts = [
        'specialization_id' => 'json',
    ];

    protected $fillable = ['name', 'email', 'contact', 'specialization_id', 'status', 'address', 'country', 'city'];

    public function setSpecializationAttribute($value)
    {
        $this->attributes['specialization_id'] = json_encode($value);
    }

    public function getSpecializationAttribute($value)
    {
        return json_decode($value);
    }
}
