<?php

if (!function_exists('format_rupiah')) {
    function format_rupiah($value) {
        $result = 'Rp ' . number_format($value, 0, ',', '.');
        return $result;
    }
}

if (!function_exists('format_time')) {
function format_time($time) {
    $timestamp = strtotime($time);
    $hour = date("H", $timestamp);
    $minute = date("i", $timestamp);

    if ($hour < 1) {
        $formatted_time = $minute . " menit";
    } else {
        $formatted_time = $hour . " jam " . $minute . " menit";
    }

    return $formatted_time;
}
}