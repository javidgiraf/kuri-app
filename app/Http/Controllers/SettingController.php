<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\SettingService;
use App\Helpers\LogActivity;
use App\Http\Requests\SettingPostRequest;
use App\Http\Requests\SettingUpdateRequest;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SettingService $settingService)
    {
        //
        $settings = $settingService->getSettings();

        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingPostRequest $request, SettingService $settingService)
    {
        //
        $input = $request->all();
        $input['option_code'] = Str::slug($input['option_name']);

        $scheme = $settingService->createSetting($input);
        LogActivity::addToLog('New Setting Added by ' . auth()->user()->name);
        return redirect()->route('settings.index')->with('success', 'Setting created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, SettingService $settingService)
    {
        //
        $id = decrypt($id);
        $setting = $settingService->getSetting($id);
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, SettingUpdateRequest $request, SettingService $settingService)
    {
        //
        $id = decrypt($id);
        $input = $request->all();
        $input['option_code'] = Str::slug($input['option_name']);
        $setting = $settingService->getSetting($id);
        $settingService->updateSetting($setting, $input);
        LogActivity::addToLog('Setting ' . $input['option_name'] . ' updated by ' . auth()->user()->name);
        return redirect()->route('settings.index')->with('success', 'Setting updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, SettingService $settingService)
    {
        //
        $id = decrypt($id);
        $setting = $settingService->getSetting($id);
        $settingService->deleteSetting($setting);
        LogActivity::addToLog('Setting ' . $setting->option_name . ' removed by ' . auth()->user()->name);
        return redirect()->back()
            ->with('success', 'Setting deleted successfully');
    }
}
