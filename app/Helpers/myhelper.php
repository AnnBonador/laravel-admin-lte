<?php

use Illuminate\Support\Str;

function generatePass()
{
    $generated = Str::random(10);
    return Str::lower($generated);
}
