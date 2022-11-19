<?php

namespace App\Http\Controllers\User;

use App\Models\Treated;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class TreatedController extends Controller
{
    public function index()
    {
        $treated = Treated::whereHas('appointment', function (Builder $query) {
            $query->where('patient_id', '=', Auth::id());
        })->get();

        return view('user.treated.index', compact('treated'));
    }
    public function show($id)
    {
        $treated = Treated::find($id);
        $transact = Transaction::where('appointment_id', $treated->app_id)->where('appointment_id', $treated->app_id)->get();
        return view('user.treated.show', compact('treated', 'transact'));
    }
}
