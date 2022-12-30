<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = ['fname', 'lname', 'email', 'contact', 'dob', 'gender', 'status', 'type', 'password', 'specialization_id', 'experience', 'clinic_id', 'address'];
    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'specialization_id' => 'json',
    ];

    public function setSpecializationAttribute($value)
    {
        $this->attributes['specialization_id'] = json_encode($value);
    }

    public function getSpecializationAttribute($value)
    {
        return json_decode($value);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id')->withDefault();
    }

    public function specialty()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id')->withDefault();
    }
    public function service()
    {
        return $this->hasMany(Service::class, 'doctor_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(ReviewRating::class, 'doctor_id', 'id');
    }

    public function reviews()
    {
        return $this->belongsTo(ReviewRating::class, 'id', 'doctor_id');
    }

    public function services()
    {
        return $this->belongsTo(Service::class, 'id', 'doctor_id');
    }
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "admin"][$value],
        );
    }
}
