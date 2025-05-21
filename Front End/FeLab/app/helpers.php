<?php

if (!function_exists('file_url')) {
    function file_url($path = '') {
        return rtrim(config('services.api.file_base_url'), '/') . '/' . ltrim($path, '/');
    }
}
