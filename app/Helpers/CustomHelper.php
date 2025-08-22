<?php

if (!function_exists('maskEmail')) {
    function maskEmail($email)
    {
        $parts = explode("@", $email);
        $name = $parts[0]; // Bagian sebelum @
        $domain = $parts[1]; // Bagian setelah @

        // Ambil 2 huruf pertama, sisanya diganti bintang
        $maskedName = substr($name, 0, 2) . str_repeat('*', max(0, strlen($name) - 2));

        return $maskedName . '@' . $domain;
    }
}
