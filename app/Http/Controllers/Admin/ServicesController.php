<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;

class ServicesController extends Controller
{
    public function index()
    {
        $service = Services::all();
        return view('admin.service.index', compact('service'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $doctor = User::where('type', '2')->where('status', '1')->get()->pluck('full_name', 'id');
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $doctor = User::where('type', '2')->where('status', '1')->where('clinic_id', auth()->user()->isClinicAdmin)->get()->pluck('full_name', 'id');
        }
        $service_cat = ServiceCategory::pluck('name', 'id');
        return view('admin.service.create', compact('doctor', 'service_cat'));
    }

    public function store(ServiceStoreRequest $request)
    {
        Services::create($request->all());

        return redirect()->route('services.index')->with('success', 'Service added successfully');
    }

    public function edit($id)
    {
        $service = Services::findOrFail($id);
        $doctor = User::where('type', '2')->where('status', '1')->get()->pluck('full_name', 'id');
        $service_cat = ServiceCategory::pluck('name', 'id');
        return view('admin.service.edit', compact('service', 'doctor', 'service_cat'));
    }

    public function update(ServiceStoreRequest $request, $id)
    {
        $service = Services::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }

    public function destroy(Request $request)
    {
        $service = Services::find($request->delete_id);
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }

    public function updateStatus(Request $request)
    {
        $user = Services::findOrFail($request->service_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Service status updated successfully.']);
    }
}
