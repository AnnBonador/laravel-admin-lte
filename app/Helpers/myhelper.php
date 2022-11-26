<?php

use App\Models\Clinic;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

function title()
{
    return Setting::value('title');
}
function name()
{
    return Setting::value('name');
}
function email()
{
    return Setting::value('email');
}
function logo()
{
    return Setting::value('logo');
}
function icon()
{
    return Setting::value('favicon');
}
function generatePass()
{
    $generated = Str::random(10);
    return Str::lower($generated);
}
function contact()
{
    return Setting::value('contact');
}
function getLogo()
{
    return Setting::value('logo');
}
function getFavicon()
{
    return Setting::value('favicon');
}
function getFooter()
{
    return Setting::value('footer');
}
function viewDoctors()
{
    $doctors = User::role('Doctor')->where('status', '1')->get();
    return $doctors;
}

function doctorHelper()
{
    return User::role('Doctor')->where('status', '1')->get()->pluck('full_name', 'id');
}

function getClinics()
{
    return Clinic::where('status', '1')->get();
}
