<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Models\Services;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::all();
        return view('admin.specialization.index', compact('specializations'));
    }
    public function create()
    {
        return view('admin.specialization.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specializations,name',
        ]);

        Specialization::create($request->all());

        return redirect()->route('specialization.index')->with('success', 'Specialization added successfully');
    }

    public function edit($id)
    {
        $specialization = Specialization::find($id);
        return view('admin.specialization.edit', compact('specialization'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:specializations,name', $id,
        ]);

        $specialization = Specialization::findOrFail($id);
        $specialization->update($request->all());

        return redirect()->route('specialization.index')->with('success', 'Specialization updated successfully');
    }

    public function destroy(Request $request)
    {
        $specialization = Specialization::find($request->delete_id);
        $specialization->delete();
        return redirect()->route('specialization.index')->with('success', 'Specialization deleted successfully');
    }

}
