<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'nullable',
            'company_email' => 'nullable|email',
            'company_phone' => 'nullable',
            'company_address' => 'nullable',
            'logo' => 'nullable|image'
        ]);

        $setting = Setting::first();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return back()->with('success', 'Settings updated successfully');
    }
}
