<?php

namespace App\Http\Controllers\Admin;

use App\Models\Treated;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TreatedRequest;
use Illuminate\Database\Eloquent\Builder;

class TreatedController extends Controller
{
    public function index()
    {
        $treated = Treated::with('appointment')->get();
        if (auth()->user()->hasRole('Doctor')) {
            $treated = Treated::whereHas('appointment', function (Builder $query) {
                $query->where('doctor_id', '=', auth()->id());
            })->get();
        } else if (auth()->user()->hasRole('Receptionist') || auth()->user()->hasRole('Clinic Admin')) {
            $treated = Treated::whereHas('appointment', function (Builder $query) {
                $query->where('clinic_id', '=', auth()->user()->clinic_id);
            })->get();
        }
        // dd($treated);
        return view('admin.treated.index', compact('treated'));
    }
    public function edit($id)
    {
        $treated = Treated::find($id);
        $transact = Transaction::where('appointment_id', $treated->app_id)->get();
        return view('admin.treated.edit', compact('treated', 'transact'));
    }
    public function update(TreatedRequest $request, $id)
    {
        $validatedData = $request->validated();
        $treated = Treated::find($id);
        $treated->teeth = $validatedData['teeth'];
        $treated->problem = $validatedData['problem'];
        $treated->fee = $validatedData['fee'];
        $treated->remarks = $validatedData['remarks'];
        $treated->status = $validatedData['status'];

        $old_file = $request->old_file;
        if ($request->file('file')) {

            $docu_path = public_path('storage/uploads/');
            if (file_exists($docu_path . $old_file)) {
                @unlink($docu_path . $old_file);
            }
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $treated->name = time() . '_' . $request->file->getClientOriginalName();
            $treated->file_path = '/storage/' . $filePath;
        }

        $treated->save();
        return redirect()->route('treated.index')->with('success', 'Record updated successfully');
    }

    public function destroy(Request $request)
    {
        $treated = Treated::find($request->delete_id);
        if ($treated->name) {
            $docu_path = public_path('storage/uploads/');
            if (file_exists($docu_path . $treated->name)) {
                @unlink($docu_path . $treated->name);
            }
        }
        $treated->delete();
        return redirect()->route('treated.index')->with('success', 'Record deleted successfully');
    }
}
