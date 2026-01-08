<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()
            ->mapWithKeys(function ($setting) {
                $value = $setting->value;

                if ($setting->type === 'json') {
                    $decoded = json_decode($setting->value, true);
                    $value = is_array($decoded) ? $decoded : [];
                }

                return [$setting->key => $value];
            });
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|string|max:10',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'smtp_encryption' => 'nullable|string|max:10',
            'smtp_from_address' => 'nullable|email|max:255',
            'smtp_from_name' => 'nullable|string|max:255',
            'monthly_dues_amount' => 'required|numeric|min:0',
            'subscription_amount' => 'required|numeric|min:0',
            'payment_methods' => 'nullable|array',
            'bank_account_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_routing_number' => 'nullable|string|max:255',
            'auto_suspend_days' => 'nullable|integer|min:0',
        ]);

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            $oldLogo = SiteSetting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            $logoPath = $request->file('site_logo')->store('logos', 'public');
            SiteSetting::set('site_logo', $logoPath, 'image');
        }

        // Update other settings
        foreach ($validated as $key => $value) {
            if ($key !== 'site_logo') {
                if ($key === 'payment_methods') {
                    SiteSetting::set($key, $value, 'json');
                } else {
                    SiteSetting::set($key, $value);
                }
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Site settings updated successfully.');
    }
}
