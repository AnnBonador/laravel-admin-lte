<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_patient = Patient::count();
        return view('admin.dashboard.index', compact('total_patient'));
    }
}
