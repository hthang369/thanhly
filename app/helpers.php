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

if (!function_exists('form')) {

    function form(Form $form, array $options = [])
    {
        return $form->renderForm($options);
    }
}

if (!function_exists('vnn_asset')) {
    function vnn_asset($path) {
        return asset($path);
    }
}