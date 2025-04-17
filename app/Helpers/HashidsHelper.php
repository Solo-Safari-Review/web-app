<?php

namespace App\Helpers;

use Hashids\Hashids;

class HashidsHelper
{
    protected static $hashids;

    // Konstruktor untuk inisialisasi Hashids dengan salt custom
    public static function initialize()
    {
        if (is_null(self::$hashids)) {
            self::$hashids = new Hashids(config('app.key'), 10);  // Anda bisa menggunakan 'salt_custom' di sini
        }
    }

    // Fungsi untuk mengonversi ID menjadi string hash
    public static function encode($id)
    {
        self::initialize();
        return self::$hashids->encode($id);
    }

    // Fungsi untuk mengonversi string hash kembali menjadi ID
    public static function decode($hash)
    {
        self::initialize();
        $decoded = self::$hashids->decode($hash);
        return count($decoded) > 0 ? $decoded[0] : null;
    }
}
