<?php

use App\Models\AppSetting;

if (!function_exists('app_setting')) {
    function app_setting($key, $default = null)
    {
        return AppSetting::getSetting($key, $default);
    }
}
