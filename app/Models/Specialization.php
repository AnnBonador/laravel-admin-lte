<?php

namespace App\Models;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function clinic()
    {
        return $this->hasManyJson(Clinic::class, 'specialization_id')->withDefault();
    }
}
