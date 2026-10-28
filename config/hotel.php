<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Hotel Information & Official WhatsApp
    |--------------------------------------------------------------------------
    |
    | Konfigurasi kontak resmi WhatsApp Grand Senyum Hotel Yogyakarta.
    | Nomor ini otomatis tersinkronisasi di seluruh web (desktop & mobile)
    | untuk layanan Concierge 24 Jam, Reservasi, dan Shuttle Stasiun Tugu.
    |
    | Format nomor: kode negara tanpa tanda '+' atau spasi (contoh: 6281234567890)
    |
    */
    'name' => 'Grand Senyum Hotel Yogyakarta',
    'whatsapp' => env('HOTEL_WHATSAPP', '6282135477676'),
    'whatsapp_display' => env('HOTEL_WHATSAPP_DISPLAY', '0821 3547 7676'),
    'phone' => '0274 566 306',
    'email' => 'grandsenyum@gmail.com',
    'concierge_hours' => '24 Jam',
    'address' => 'Jalan Pangeran Diponegoro No.27, Gowongan, Kecamatan Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta ( 55232 )',
    'address_short' => 'Jl. Pangeran Diponegoro No.27, Gowongan, Jetis, Kota Yogyakarta (55232)',
];
