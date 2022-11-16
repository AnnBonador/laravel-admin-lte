<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }
    public function store(SettingsRequest $request)
    {
        Setting::create($request->all());

        return redirect()->route('settings.index')->with('success', 'Service added successfully');
    }
}
