<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Models\Doctor;
use App\Models\ServiceCategory;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $service = Services::all();
        return view('admin.service.index', compact('service'));
    }

    public function create()
    {
        $doctor = Doctor::get()->pluck('full_name', 'id');
        $service_cat = ServiceCategory::pluck('name', 'id');
        return view('admin.service.create', compact('doctor', 'service_cat'));
    }

    public function store(ServiceStoreRequest $request)
    {
        $service = Services::create($request->all());

        return redirect()->route('services.index')->with('success', 'Service added successfully');
    }

    public function edit($id)
    {
        $service = Services::findOrFail($id);
        $doctor = Doctor::get()->pluck('full_name', 'id');
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
}
