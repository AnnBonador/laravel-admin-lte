<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function index()
    {
        return view('admin.receptionist.index');
    }

    public function create()
    {
        $clinic = Clinic::pluck('name', 'id');
        return view('admin.receptionist.create', compact('clinic'));
    }
}
