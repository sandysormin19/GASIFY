<?php

namespace App\Models;

// Pastikan ini adalah namespace yang benar untuk paket MongoDB yang Anda gunakan
// Jika Anda menggunakan paket mongodb/laravel-mongodb (pengganti jenssegers), ini benar:
use MongoDB\Laravel\Eloquent\Model;
// Jika Anda masih menggunakan jenssegers/laravel-mongodb yang lebih lama, gunakan:
// use Jenssegers\Mongodb\Eloquent\Model;

class HomepageContent extends Model
{
    protected $connection = 'mongodb'; // Pastikan ini nama koneksi MongoDB Anda di config/database.php
    protected $collection = 'homepage_contents'; // Nama collection Anda

    // Field yang boleh diisi secara massal
    protected $fillable = [
        'section',
        'content',
        'is_active',
    ];

    // protected $guarded = ['*']; // <-- KOMENTARI ATAU HAPUS BARIS INI

    // Tipe data cast
    protected $casts = [
        'content' => 'collection', // Kita akan coba ubah ini di percobaan berikutnya jika perlu
        'is_active' => 'boolean',
    ];

    // Jika collection Anda tidak menggunakan timestamps 'created_at' dan 'updated_at' dari Eloquent,
    // tambahkan baris ini:
    // public $timestamps = false;
    // Namun, dari output dd Anda, sepertinya timestamps ada dan dikelola oleh Eloquent/Carbon.
}