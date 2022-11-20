<?php

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
    $doctors = User::where('type', '2')->where('status', '1')->get();
    return $doctors;
}

function doctorHelper()
{
    return User::where('type', '2')->where('status', '1')->get()->pluck('full_name', 'id');
}
