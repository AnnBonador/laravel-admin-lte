<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    public function index()
    {
        return view('admin.reports.medical-report.index');
    }

    public function filter(Request $request)
    {
        $date = explode(" - ", request()->input('from-to', ""));

        // START - This is to implement data range filter in Attendance view
        if (count($date) != 2) {
            $date = [now()->subDays(29)->format("Y-m-d"), now()->format("Y-m-d")];
        }

        $results = User::doesntHave('roles')->whereBetween('created_at',  $date)->get();
        dd($date);
        return view('admin.reports.medical-report.view', compact('results'));
    }
}
