<?php

namespace App\Http\Controllers\ADmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandingController extends Controller
{
    public function edit()
    {
        $settings = DB::table('settings')->first(); 
        return view('admin.settings.branding', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'recipient_email' => 'nullable|email'
        ]);

        $settings = DB::table('settings')->first();

        $logoPath = $settings->logo ?? null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        DB::table('settings')->updateOrInsert(
            ['id' => $settings->id ?? 1],
            [
                'app_name' => $request->app_name,
                'logo' => $logoPath,
                'recipient_email' => $request->recipient_email,
                'updated_at' => now()
            ]
        );

        return redirect()->back()->with('success', 'Branding updated successfully!');
    }
}
