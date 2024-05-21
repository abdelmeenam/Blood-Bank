<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function editSetting()
    {
        $setting = Setting::first();
        return view('AdminDashboard.Settings.edit', [
            'setting' => $setting ?? new Setting()
        ]);
    }

    public function updateSetting(Request $request)
    {
        $request->validate([
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:20',
            'notification_settings_text' => 'sometimes|string|max:255',
            'about_app' => 'sometimes|string|max:255',
            'insta_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
            'whatsapp_link' => 'nullable|url|max:255',
            'google_link' => 'nullable|url|max:255',
            'fb_link' => 'nullable|url|max:255',
            'tw_link' => 'nullable|url|max:255',
        ]);

        $setting = Setting::first();
        $setting->update($request->all());

        toastr()->success(__('Settings updated successfully'));
        return redirect()->route('settings.edit');
    }
}