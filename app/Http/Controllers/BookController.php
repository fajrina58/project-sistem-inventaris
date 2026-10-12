<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // READ: Menampilkan daftar buku, pencarian, pagination, dan statistik
    public function index()
    {
        // 1. Ambil kata kunci pencarian
        $katakunci = request('search');
        
        // 2. Cari buku, muat relasi kategori, dan bagi halaman (5 buku per halaman)
        $books = Book::with('category')->where('judul', 'like', '%' . $katakunci . '%')->paginate(5);
        
        // 3. Hitung statistik untuk dashboard
        $totalBuku = Book::count();
        $totalStok = Book::sum('stok');
        $stokMenipis = Book::where('stok', '<=', 5)->count();

        // 4. Kirim semua data yang sudah disiapkan ke halaman welcome
        return view('welcome', compact('books', 'totalBuku', 'totalStok', 'stokMenipis'));
    }

    // CREATE: Menampilkan halaman formulir tambah buku
    public function create()
    {
        return view('create');
    }

    // STORE: Menyimpan buku baru ke database
    public function store(Request $request)
    {
        Book::create($request->all());
        return redirect('/');
    }

    // EDIT: Menampilkan halaman edit buku berdasarkan ID
    public function edit($id)
    {
        $book = Book::find($id);
        return view('edit', compact('book'));
    }

    // UPDATE: Menyimpan perubahan data buku
    public function update(Request $request, $id)
{
    // 1. Aturan Validasi
    $validated = $request->validate([
        'judul'       => 'required|max:255',
        'penulis'     => 'required|max:255',
        'category_id' => 'required',
        'harga'       => 'required|numeric|min:0',
        'stok'        => 'required|integer|min:0',
    ], [
        // Pesan error custom agar lebih mudah dipahami
        'required' => 'Kolom ini wajib diisi!',
        'numeric'  => 'Harus berupa angka!',
        'integer'  => 'Harus berupa angka bulat!'
    ]);

    // 2. Simpan jika validasi lolos
    $book = \App\Models\Book::findOrFail($id);
    $book->update($validated);

    return redirect('/');
}
    

    // DELETE: Menghapus data buku
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect('/');
    }
}
