<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'recipient_email' => 'required|email',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $setting = Setting::first() ?? new Setting();
        $setting->app_name = $request->app_name;
        $setting->recipient_email = $request->recipient_email;

        if ($request->hasFile('logo')) {
            $filename = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads'), $filename);
            $setting->logo = $filename;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function branding()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.branding', compact('settings'));
    }

    public function updateBranding(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        Setting::updateOrCreate(['key' => 'app_name'], ['value' => $request->app_name]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
        }

        return back()->with('success', 'Branding updated successfully.');
    }
}
