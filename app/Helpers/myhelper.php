<?php

use App\Models\Setting;
use Illuminate\Support\Str;

function title()
{
    return Setting::value('title');
}
function name()
{
    return Setting::value('name');
}
function generatePass()
{
    $generated = Str::random(10);
    return Str::lower($generated);
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
