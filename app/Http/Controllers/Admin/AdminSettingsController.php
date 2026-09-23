<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function show()
    {
        $settings = [
            'adsense_enabled' => Setting::get('adsense_enabled', '0'),
            'adsense_publisher_id' => Setting::get('adsense_publisher_id', ''),
            'adsense_ad_slot_header' => Setting::get('adsense_ad_slot_header', ''),
            'adsense_ad_slot_sidebar' => Setting::get('adsense_ad_slot_sidebar', ''),
            'adsense_ad_slot_footer' => Setting::get('adsense_ad_slot_footer', ''),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'adsense_publisher_id' => 'nullable|string|max:30',
            'adsense_ad_slot_header' => 'nullable|string|max:20',
            'adsense_ad_slot_sidebar' => 'nullable|string|max:20',
            'adsense_ad_slot_footer' => 'nullable|string|max:20',
        ]);

        Setting::set('adsense_enabled', $request->boolean('adsense_enabled') ? '1' : '0');
        Setting::set('adsense_publisher_id', $request->adsense_publisher_id ?? '');
        Setting::set('adsense_ad_slot_header', $request->adsense_ad_slot_header ?? '');
        Setting::set('adsense_ad_slot_sidebar', $request->adsense_ad_slot_sidebar ?? '');
        Setting::set('adsense_ad_slot_footer', $request->adsense_ad_slot_footer ?? '');

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}
