<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treated extends Model
{
    use HasFactory;
    protected $table = 'treated';

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'app_id', 'id')->withDefault();
    }
}
