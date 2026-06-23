<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getSetting($key, $default = null)
    {
        return cache()->rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function setSetting($key, $value)
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        cache()->forget("setting.{$key}");
    }
}
