<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'index']);
Route::resource('buku', BookController::class)->except('index');
Route::get('/buat-kategori', function () {
    \App\Models\Category::create(['nama_kategori' => 'Novel Fiksi']);
    \App\Models\Category::create(['nama_kategori' => 'Sejarah & Budaya']);
    \App\Models\Category::create(['nama_kategori' => 'Sains & Teknologi']);
    return 'Kategori berhasil dibuat! Silakan kembali ke halaman utama.';
});
