<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi secara massal
    protected $guarded = ['id'];

    // Relasi: Satu buku milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}