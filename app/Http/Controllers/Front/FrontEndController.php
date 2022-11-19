<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function homepage()
    {
        return view('welcome');
    }
    public function dentist()
    {
        return view('dentist');
    }
    public function clinics()
    {
        return view('clinics');
    }
}
