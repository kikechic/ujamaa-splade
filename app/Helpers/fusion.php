<?php

use Carbon\Carbon;
use Stillat\Numeral\Numeral;
use Stillat\Numeral\Languages\LanguageManager;

if (!function_exists('fusion_date_format')) {
    function fusion_date_format($date, $format = ''): string
    {
        if (!$date) {
            return '';
        }

        if ($date instanceof Carbon) {
            return $date->format($format ?: config('fusion.display_date_format'));
        }

        return Carbon::createFromFormat('Y-m-d', $date)->format($format ?: config('fusion.display_date_format'));
    }
}

if (!function_exists('status_name')) {
    function status_name(string|null $name): string|null
    {
        return ucwords(str_replace(search: '_', replace: ' ', subject: $name));
    }
}

if (!function_exists('fusion_float')) {
    function fusion_float($number)
    {
        $languageManager = new LanguageManager;
        $formatter = new Numeral;
        $formatter->setLanguageManager($languageManager);
        return $formatter->unformat($number);
    }
}

if (!function_exists('fusion_timezones')) {
    function fusion_timezones()
    {
        $timezones = [];
        //(DateTimeZone::AFRICA | DateTimeZone::ASIA)
        foreach (DateTimeZone::listIdentifiers(DateTimeZone::ALL) as $timezone) {
            $timezones[$timezone] = $timezone;
        }

        return $timezones;
    }
}
