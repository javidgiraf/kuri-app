<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\Request;


class SettingService
{
    public function getSettings(): Object
    {

        return Setting::paginate(10);
    }
    public function createSetting(array $userData): Setting
    {

        $create = [
            'option_name'    => $userData['option_name'],
            'option_code'    => $userData['option_code'],
            'option_value'    => $userData['option_value'],
            'status'    => $userData['status'],

        ];
        $scheme = Setting::create($create);
        return $scheme;
    }

    public function getSetting($id): Object
    {
        return Setting::find($id);
    }


    public function updateSetting(Setting $setting, array $userData, string $imageUrl = null): void
    {

        $update = [
            'option_name'    => $userData['option_name'],
            'option_code'    => $userData['option_code'],
            'option_value'    => $userData['option_value'],
            'status'    => $userData['status'],

        ];
        $setting->update($update);
    }

    public function deleteSetting(Setting $setting): void
    {
        // delete scheme
        Setting::find($setting->id)->delete();
    }
}
