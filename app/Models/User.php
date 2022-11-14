<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "admin", "doctor", "receptionist"][$value],
        );
    }
    public static function generatePassword()
    {
        // Generate random string and encrypt it.
        return bcrypt(Str::random(35));
    }

    public static function sendWelcomeEmail($clinic_admin)
    {
        // Generate a new reset password token
        $token = app('auth.password.broker')->createToken($clinic_admin);

        // Send email
        Mail::send('emails.welcome', ['user' => $clinic_admin, 'token' => $token], function ($m) use ($clinic_admin) {
            $m->from('hello@appsite.com', 'Your App Name');

            $m->to($clinic_admin->email, $clinic_admin->full_name)->subject('Welcome to APP');
        });
    }
}
