<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\ServiceStoreRequest;

class ServicesController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $service = Service::all();
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $service = Service::whereHas('doctors', function (Builder $query) {
                $query->where('clinic_id', '=', auth()->user()->clinic_id);
            })->get();
        } else if (auth()->user()->hasRole('Doctor')) {
            $service = Service::where('doctor_id', auth()->id())->get();
        } else if (auth()->user()->hasRole('Receptionist')) {
            $service = Service::whereHas('doctors', function (Builder $query) {
                $query->where('clinic_id', '=', auth()->user()->clinic_id);
            })->get();
        }
        return view('admin.service.index', compact('service'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $doctor = User::role('Doctor')->where('status', '1')->get()->pluck('full_name', 'id');
        } else if (auth()->user()->hasRole('Clinic Admin')) {
            $doctor = User::role('Doctor')->where('status', '1')->where('clinic_id', auth()->user()->isClinicAdmin)->get()->pluck('full_name', 'id');
        } else if (auth()->user()->hasRole('Doctor') || auth()->user()->hasRole('Receptionist')) {
            $doctor = User::role('Doctor')->where('status', '1')->where('clinic_id', auth()->user()->clinic_id)->get()->pluck('full_name', 'id');
        }
        $service_cat = ServiceCategory::pluck('name', 'id');
        return view('admin.service.create', compact('doctor', 'service_cat'));
    }

    public function store(ServiceStoreRequest $request)
    {
        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Service added successfully');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $doctor = User::role('Doctor')->where('status', '1')->get()->pluck('full_name', 'id');
        $service_cat = ServiceCategory::pluck('name', 'id');
        return view('admin.service.edit', compact('service', 'doctor', 'service_cat'));
    }

    public function update(ServiceStoreRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }

    public function destroy(Request $request)
    {
        $service = Service::find($request->delete_id);
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }

    public function updateStatus(Request $request)
    {
        $user = Service::findOrFail($request->service_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Service status updated successfully.']);
    }
}
