<?php

namespace App\Http\Controllers\User;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class PaymentController extends Controller
{
    public function index()
    {
        $payment = Transaction::whereHas('appointment', function (Builder $query) {
            $query->where('patient_id', '=', auth()->id());
        })->get();

        return view('user.payment.index', compact('payment'));
    }

    public function show($id)
    {
        $payment = Transaction::with('appointment')->where('id', $id)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        return view('user.payment.view', compact('payment'));
    }

    public function print($id)
    {
        $payment = Transaction::with('appointment')->where('id', $id)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        return view('user.payment.print', compact('payment'));
    }
}
