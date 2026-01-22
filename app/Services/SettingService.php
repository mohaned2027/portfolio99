<?php

namespace App\Services;

use App\Repository\SettingRepository;

class SettingService
{
    public function __construct(protected SettingRepository $settingRepository) {}

    public function getSettings()
    {
        return $this->settingRepository->getSettings();
    }

    public function getSetting($id)
    {
        return $this->settingRepository->getSetting($id) ?? false;
    }

    public function store($data)
    {
        return $this->settingRepository->store($data);
    }

    public function update($data, $id)
    {
        $setting = $this->settingRepository->getSetting($id);
        if (!$setting) return false;
        return $this->settingRepository->update($setting, $data);
    }

    public function delete($id)
    {
        $setting = $this->settingRepository->getSetting($id);
        if (!$setting) return false;
        return $this->settingRepository->delete($setting);
    }
}
