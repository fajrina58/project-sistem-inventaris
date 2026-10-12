<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Kala & Kata</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #fdfbf7; 
            color: #2c3531; 
            padding: 50px 20px; 
            margin: 0;
        }
        .container { 
            max-width: 600px; 
            margin: auto; 
            background: #ffffff; 
            padding: 40px; 
            border-radius: 16px; 
            box-shadow: 0 8px 30px rgba(74, 93, 78, 0.04); 
            border: 1px solid rgba(74, 93, 78, 0.06); 
        }
        h2 { 
            font-family: 'Playfair Display', serif; 
            color: #4a5d4e; 
            font-size: 28px; 
            margin-top: 0; 
            margin-bottom: 30px;
            letter-spacing: -0.5px;
        }
        .form-group { margin-bottom: 20px; }
        label { 
            display: block; 
            font-weight: 600; 
            font-size: 13px; 
            color: #6e7773; 
            margin-bottom: 8px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }
        input { 
            width: 100%; 
            padding: 14px 16px; 
            border: 1px solid rgba(74, 93, 78, 0.2); 
            border-radius: 8px; 
            font-family: inherit; 
            font-size: 14px; 
            box-sizing: border-box; 
            transition: 0.3s; 
            background-color: #fafbfaf0;
        }
        input:focus { 
            outline: none; 
            border-color: #4a5d4e; 
            box-shadow: 0 0 0 3px rgba(74, 93, 78, 0.1); 
            background-color: #ffffff;
        }
        .btn-submit { 
            background-color: #4a5d4e; 
            color: #ffffff; 
            padding: 16px 24px; 
            border: none; 
            border-radius: 8px; 
            font-weight: 600; 
            width: 100%; 
            cursor: pointer; 
            transition: all 0.3s ease; 
            font-size: 15px; 
            margin-top: 10px; 
        }
        .btn-submit:hover { 
            background-color: #8c6239; 
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(140, 98, 57, 0.2);
        }
        .btn-back { 
            display: block; 
            text-align: center; 
            margin-top: 24px; 
            color: #6e7773; 
            text-decoration: none; 
            font-size: 14px; 
            font-weight: 600; 
            transition: 0.3s;
        }
        .btn-back:hover { color: #4a5d4e; }
        .row { display: flex; gap: 15px; }
        .row .form-group { flex: 1; }
    </style>
</head>
<body>

    <div class="container">
        <h2>✨ Tambah Arsip Buku</h2>
        
        <form action="/buku" method="POST">
            <!-- Token Keamanan Wajib Laravel -->
            @csrf
            
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" required placeholder="Contoh: Laut Bercerita">
            </div>
            
            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="penulis" required placeholder="Contoh: Leila S. Chudori">
            </div>
            
            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" required placeholder="Contoh: Kepustakaan Populer Gramedia">
            </div>
            
            <div class="row">
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" required placeholder="Contoh: 115000">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" required placeholder="Contoh: 10">
                </div>
            </div>
            
            <button type="submit" class="btn-submit">Simpan ke Rak Buku</button>
        </form>
        
        <a href="/" class="btn-back">← Kembali ke Halaman Utama</a>
    </div>

</body>
</html>