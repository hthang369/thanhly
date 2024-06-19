<?php

use Laka\Core\Forms\Form;

if (!function_exists('timezone_offset_string')) {
    function timezone_offset_string($localTimeZone)
    {
        $offset = timezone_offset_get(new DateTimeZone($localTimeZone), new DateTime());
        return sprintf("%s%02d:%02d", ($offset >= 0) ? '+' : '-', abs($offset / 3600), abs($offset % 3600));
    }
}

if (!function_exists('format_bytes')) {
    function format_bytes($bytes, $precision = 2, $format = null)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $exp = floor(log($bytes, 1024)) | 0;
        if (!is_null($format)) {
            $exp = array_search($format, $units);
        }

        return round($bytes / (pow(1024, $exp)), $precision).$units[$exp];
    }
}

if (!function_exists('rand_string')) {
    function rand_string($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&";

        return substr(str_shuffle($chars), 0, $length);
    }
}

if (!function_exists('image_asset')) {
    function image_asset($path)
    {
        if (blank($path)) {
            return "https://placehold.co/310x200";
        }
        return vnn_asset("storage/images/{$path}");
    }
}

if (!function_exists('vnn_data_get')) {
    function vnn_data_get($data, $key, $defaultKey = null, $defaultValue = null) {
        $newValue = data_get($data, $key);
        if (blank($newValue))
            $newValue = data_get($data, $defaultKey, $defaultValue);

        return $newValue;
    }
}

if (!function_exists('domain_is')) {
    function domain_is($domain) {
        return str_is(request()->getHost(), $domain);
    }
}

if (!function_exists('currency_format')) {
    function currency_format($value, $currency) {
        $numf = NumberFormatter::create('vi_VN', NumberFormatter::CURRENCY);
        return $numf->formatCurrency($value, $currency);
    }
}

if (!function_exists('link_to_tel')) {
    function link_to_tel($title, $url = null, $attribute = [])
    {
        $newUrl = $url ?? $title;
        return link_to("tel:{$newUrl}", $title, $attribute);
    }
}

if (!function_exists('link_to_email')) {
    function link_to_email($email, $title = null, $attribute = [])
    {
        return app('html')->mailto($email, $title ?? $email, $attribute);
    }
}
