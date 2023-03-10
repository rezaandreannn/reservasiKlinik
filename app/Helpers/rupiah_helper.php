<?php

if (!function_exists('format_rupiah')) {
    function format_rupiah($value) {
        $result = 'Rp ' . number_format($value, 0, ',', '.');
        return $result;
    }
}