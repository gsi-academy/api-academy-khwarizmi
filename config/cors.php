<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    // Pastikan path api dan sanctum tercover
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout'],

    'allowed_methods' => ['*'],

    // ⚠️ INI BAGIAN PENTING:
    // Hapus atau komen baris: 'allowed_origins' => ['*'],
    // Ganti dengan URL lengkap frontend Anda (pake http://)
    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // ⚠️ INI WAJIB TRUE untuk Sanctum/Login Session
    'supports_credentials' => true,

];