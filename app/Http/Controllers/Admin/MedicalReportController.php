<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class MedicalReportController extends Controller
{
    public function index()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $data = User::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $data = User::latest()->get();
        }
        return view('admin.reports.index', compact('data'));
    }
}
