<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Kala & Kata</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-page: #f4f1ea; --primary: #2d3b32; --primary-hover: #1f2822;
            --accent: #8c6239; --text-main: #232b28; --card-bg: #ffffff;
            --border-color: #e2ddd5;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-page); color: var(--text-main); margin: 0; padding: 50px 20px; display: flex; justify-content: center; }
        .form-card { background: var(--card-bg); padding: 40px; border-radius: 16px; border: 1px solid var(--border-color); width: 100%; max-width: 500px; box-shadow: 0 6px 20px rgba(45, 59, 50, 0.04); }
        h2 { font-family: 'Playfair Display', serif; color: var(--primary); font-size: 28px; margin-top: 0; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: var(--primary); margin-bottom: 8px; }
        input, select { width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid var(--border-color); font-size: 14px; background: #faf8f5; box-sizing: border-box; font-family: inherit; }
        input:focus, select:focus { outline: none; border-color: var(--primary); }
        .btn-submit { background-color: var(--primary); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 600; font-size: 14px; cursor: pointer; width: 100%; margin-top: 10px; transition: 0.2s; }
        .btn-submit:hover { background-color: var(--primary-hover); }
        .btn-back { display: block; text-align: center; margin-top: 20px; color: var(--accent); text-decoration: none; font-weight: 600; font-size: 13px; }
    </style>
</head>
<body>
    <div class="form-card">
        <h2>Edit Data Buku</h2>
        <form action="/buku/{{ $book->id }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label>Judul Buku</label>
        <input type="text" name="judul" value="{{ old('judul', $book->judul) }}">
        <!-- Kode di bawah ini yang akan memunculkan pesan error -->
        @error('judul') <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
    </div>
    
    <div class="form-group">
        <label>Penulis</label>
        <input type="text" name="penulis" value="{{ old('penulis', $book->penulis) }}">
        @error('penulis') <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
    </div>
    
    <div class="form-group">
        <label>Kategori</label>
        <select name="category_id">
            <option value="">-- Pilih Kategori --</option>
            @foreach(\App\Models\Category::all() as $cat)
                <option value="{{ $cat->id }}" {{ (old('category_id', $book->category_id) == $cat->id) ? 'selected' : '' }}>
                    {{ $cat->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
    </div>
    
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="text" name="harga" value="{{ old('harga', $book->harga) }}">
        @error('harga') <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
    </div>
    
    <div class="form-group">
        <label>Stok Tersedia</label>
        <input type="text" name="stok" value="{{ old('stok', $book->stok) }}">
        @error('stok') <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
    </div>
    
    <button type="submit" style="margin-top: 15px; padding: 10px 20px; background: #2d3b32; color: white; border-radius: 5px; cursor: pointer;">Simpan Perubahan</button>
</form>
        <a href="/" class="btn-back">← Batal dan Kembali</a>
    </div>
</body>
</html>