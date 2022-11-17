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
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(SettingsRequest $request, $id)
    {
        $validatedData = $request->validated();
        $setting = Setting::find($id);
        $setting->name = $validatedData['name'];
        $setting->title = $validatedData['title'];
        $setting->footer = $validatedData['footer'];
        $setting->email = $validatedData['email'];

        $old_logo = $request->old_logo;
        if ($request->hasfile('logo')) {

            $logo_path = public_path('uploads/setting/');
            if (file_exists($logo_path . $old_logo)) {
                @unlink($logo_path . $old_logo);
            }
            $logo = $request->file('logo');
            $logo_ext = $logo->getClientOriginalExtension();
            $logo_name = rand(123456, 999999) . '.' . $logo_ext;
            $logo->move($logo_path, $logo_name);
            $final_logo = $logo_name;
        } else {
            $final_logo = $old_logo;
        }
        //icon
        $old_icon = $request->old_icon;
        if ($request->hasfile('favicon')) {

            $icon_path = public_path('uploads/setting/');
            if (file_exists($icon_path . $old_icon)) {
                @unlink($icon_path . $old_icon);
            }

            $icon = $request->file('favicon');
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = rand(123456, 999999) . '.' . $icon_ext;
            $icon->move($icon_path, $icon_name);
            $final_icon = $icon_name;
        } else {
            $final_icon = $old_icon;
        }

        $setting->logo = $final_logo;
        $setting->favicon = $final_icon;
        $setting->save();

        return redirect()->route('settings.index')->with('success', 'Service added successfully');
    }
}
