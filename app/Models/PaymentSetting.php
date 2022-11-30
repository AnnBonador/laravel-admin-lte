<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;
    protected $fillable = ['clinic_id', 'username', 'password', 'secret', 'currency'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id')->withDefault();
    }
}
