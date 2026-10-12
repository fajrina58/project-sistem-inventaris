<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kala & Kata — Manajemen Inventaris</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-page: #f4f1ea; --primary: #2d3b32; --primary-hover: #1f2822;
            --accent: #8c6239; --accent-light: #f3efe6; --text-main: #232b28;
            --text-muted: #6b7c73; --card-bg: #ffffff; --border-color: #e2ddd5;
            --danger: #b33939; --danger-hover: #9a2b2b;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-page); color: var(--text-main); margin: 0; padding: 50px 20px; }
        .container { max-width: 1100px; margin: 0 auto; }
        .header-wrap { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 35px; border-bottom: 2px solid var(--border-color); padding-bottom: 20px; }
        .brand-title h1 { font-family: 'Playfair Display', serif; color: var(--primary); font-size: 38px; margin: 0 0 6px 0; }
        .brand-title p { margin: 0; color: var(--accent); font-weight: 600; font-size: 13px; letter-spacing: 1.5px; text-transform: uppercase; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 35px; }
        .stat-card { background: var(--card-bg); padding: 28px; border-radius: 16px; border: 1px solid var(--border-color); position: relative; }
        .stat-card::after { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background-color: var(--accent); border-radius: 16px 0 0 16px; }
        .stat-card span { font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); }
        .stat-card h2 { font-size: 34px; font-weight: 700; color: var(--primary); margin: 12px 0 0 0; font-family: 'Playfair Display', serif; }
        .main-panel { background: var(--card-bg); border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden; }
        .toolbar { padding: 24px 30px; display: flex; justify-content: space-between; align-items: center; background: #faf8f5; border-bottom: 1px solid var(--border-color); }
        .btn-primary { background-color: var(--primary); color: white; padding: 12px 22px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { background-color: #f3efe6; color: var(--primary); font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 18px 30px; border-bottom: 1px solid var(--border-color); }
        td { padding: 18px 30px; border-bottom: 1px solid var(--border-color); font-size: 14px; }
        .badge-category { background-color: var(--accent-light); color: var(--accent); padding: 6px 14px; border-radius: 30px; font-size: 12px; font-weight: 600; }
        .btn-edit { background-color: #f4f1ea; color: var(--primary); padding: 6px 14px; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; margin-right: 8px;}
        .btn-delete { background-color: #fdf2f2; color: var(--danger); border: none; padding: 6px 14px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; }
        
        /* MODAL CSS (Tampilan Konfirmasi Estetik) */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(45, 59, 50, 0.7); backdrop-filter: blur(5px); align-items: center; justify-content: center; z-index: 1000; }
        .modal-box { background: var(--card-bg); padding: 35px; border-radius: 20px; max-width: 380px; width: 90%; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .modal-icon { font-size: 48px; margin-bottom: 15px; }
        .modal-box h3 { font-family: 'Playfair Display', serif; color: var(--primary); font-size: 26px; margin: 0 0 10px 0; }
        .modal-box p { color: var(--text-muted); font-size: 14px; margin-bottom: 25px; line-height: 1.6; }
        .modal-actions { display: flex; gap: 12px; justify-content: center; }
        .btn-cancel { background: #f4f1ea; color: var(--primary); border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .btn-confirm { background: var(--danger); color: white; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .btn-confirm:hover { background: var(--danger-hover); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-wrap">
            <div class="brand-title">
                <h1>Kala & Kata</h1>
                <p>Sistem Inventaris Koleksi Buku</p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card"><span>Total Koleksi 📚</span><h2>{{ $totalBuku }}</h2></div>
            <div class="stat-card"><span>Akumulasi Stok 📦</span><h2>{{ $totalStok }}</h2></div>
            <div class="stat-card"><span>Stok Menipis ⚠️</span><h2 style="color: {{ $stokMenipis > 0 ? 'var(--danger)' : 'var(--primary)' }}">{{ $stokMenipis }}</h2></div>
        </div>

        <div class="main-panel">
            <div class="toolbar">
                <a href="/buku/create" class="btn-primary">+ Tambah Buku Baru</a>
            </div>
            <table>
                <thead>
                    <tr><th>Judul Buku</th><th>Penulis</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td style="font-weight:600; color:var(--primary);">{{ $book->judul }}</td>
                        <td>{{ $book->penulis }}</td>
                        <td><span class="badge-category">{{ $book->category ? $book->category->nama_kategori : 'Belum Ada Kategori' }}</span></td>
                        <td>Rp {{ number_format($book->harga, 0, ',', '.') }}</td>
                        <td>{{ $book->stok }} pcs</td>
                        <td>
                            <a href="/buku/{{ $book->id }}/edit" class="btn-edit">Edit</a>
                            <!-- Tombol ini sekarang memanggil Modal Estetik, bukan alert bawaan browser -->
                            <button type="button" class="btn-delete" onclick="openModal({{ $book->id }})">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL HTML -->
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon">🥀</div>
            <h3>Hapus Buku?</h3>
            <p>Apakah kamu yakin ingin menghapus buku ini dari rak inventaris? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <form id="deleteForm" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-confirm">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL SCRIPT -->
    <script>
        function openModal(id) {
            document.getElementById('deleteModal').style.display = 'flex';
            // Set action URL form sesuai ID buku yang diklik
            document.getElementById('deleteForm').action = '/buku/' + id;
        }
        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
    </script>
</body>
</html>