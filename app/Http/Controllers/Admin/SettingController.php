<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        return view('admin.settings');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'favicon' => 'required|url',
            'logo_light' => 'required|url',
            'logo_dark' => 'required|url',
            'logo_grey' => 'required|url',
            'public_pages_enabled' => 'required|in:1,0',
            'public_pages_redirect_url' => 'nullable|url',
        ]);

        AppSetting::setSetting('app_name', $request->app_name);
        AppSetting::setSetting('favicon', $request->favicon);
        AppSetting::setSetting('logo_light', $request->logo_light);
        AppSetting::setSetting('logo_dark', $request->logo_dark);
        AppSetting::setSetting('logo_grey', $request->logo_grey);
        AppSetting::setSetting('public_pages_enabled', $request->public_pages_enabled);
        AppSetting::setSetting('public_pages_redirect_url', $request->public_pages_redirect_url);

        return redirect()->back()->with('success', 'Pengaturan web berhasil diperbarui.');
    }
}
