<?php

namespace App\Repository;

use App\Models\Setting;

class SettingRepository
{
    public function getSettings()
    {
        return Setting::get();
    }

    public function getSetting($id)
    {
        return Setting::find($id);
    }

    public function store($data)
    {
        return Setting::create($data);
    }

    public function update($setting, $data)
    {
        return $setting->update($data);
    }

    public function delete($setting)
    {
        return $setting->delete();
    }
}
