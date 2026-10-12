@extends('layouts.app')

@section('content')
    <div class="header-wrap">
        <div class="brand-title">
            <h1>Kala & Kata</h1>
            <p>Sistem Inventaris Koleksi Buku</p>
        </div>
    </div>

    <!-- Statistik Dashboard -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 35px;">
        <div style="background: white; padding: 28px; border-radius: 16px; border: 1px solid var(--border-color); border-left: 4px solid var(--accent);">
            <span style="font-size: 12px; font-weight: 700; color: var(--text-muted);">Total Koleksi 📚</span>
            <h2 style="font-size: 34px; color: var(--primary); margin: 12px 0 0 0;">{{ $totalBuku }}</h2>
        </div>
        <div style="background: white; padding: 28px; border-radius: 16px; border: 1px solid var(--border-color); border-left: 4px solid var(--accent);">
            <span style="font-size: 12px; font-weight: 700; color: var(--text-muted);">Akumulasi Stok 📦</span>
            <h2 style="font-size: 34px; color: var(--primary); margin: 12px 0 0 0;">{{ $totalStok }}</h2>
        </div>
        <div style="background: white; padding: 28px; border-radius: 16px; border: 1px solid var(--border-color); border-left: 4px solid {{ $stokMenipis > 0 ? 'var(--danger)' : 'var(--accent)' }};">
            <span style="font-size: 12px; font-weight: 700; color: var(--text-muted);">Stok Menipis ⚠️</span>
            <h2 style="font-size: 34px; color: {{ $stokMenipis > 0 ? 'var(--danger)' : 'var(--primary)' }}; margin: 12px 0 0 0;">{{ $stokMenipis }}</h2>
        </div>
    </div>

    <!-- Panel Tabel Utama -->
    <div style="background: white; border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden;">
        <div style="padding: 24px 30px; display: flex; justify-content: space-between; background: #faf8f5; border-bottom: 1px solid var(--border-color);">
            <a href="/create" style="background: var(--primary); color: white; padding: 12px 22px; border-radius: 10px; text-decoration: none; font-weight: 600;">+ Tambah Buku Baru</a>
        </div>
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr>
                    <th style="background: #f3efe6; padding: 18px 30px; color: var(--primary); text-transform: uppercase; font-size: 11px;">Judul Buku</th>
                    <th style="background: #f3efe6; padding: 18px 30px; color: var(--primary); text-transform: uppercase; font-size: 11px;">Penulis</th>
                    <th style="background: #f3efe6; padding: 18px 30px; color: var(--primary); text-transform: uppercase; font-size: 11px;">Kategori</th>
                    <th style="background: #f3efe6; padding: 18px 30px; color: var(--primary); text-transform: uppercase; font-size: 11px;">Harga</th>
                    <th style="background: #f3efe6; padding: 18px 30px; color: var(--primary); text-transform: uppercase; font-size: 11px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td style="padding: 18px 30px; border-bottom: 1px solid var(--border-color); font-weight: 600;">{{ $book->judul }}</td>
                    <td style="padding: 18px 30px; border-bottom: 1px solid var(--border-color);">{{ $book->penulis }}</td>
                    <td style="padding: 18px 30px; border-bottom: 1px solid var(--border-color);">
                        <span style="background: var(--accent-light); color: var(--accent); padding: 6px 14px; border-radius: 30px; font-size: 12px; font-weight: 600;">
                            {{ $book->category ? $book->category->nama_kategori : 'Belum Ada Kategori' }}
                        </span>
                    </td>
                    <td style="padding: 18px 30px; border-bottom: 1px solid var(--border-color);">Rp {{ number_format($book->harga, 0, ',', '.') }}</td>
                    <td style="padding: 18px 30px; border-bottom: 1px solid var(--border-color);">
                        <a href="/edit/{{ $book->id }}" style="color: var(--primary); font-weight: 600; text-decoration: none; margin-right: 10px;">Edit</a>
                        <button type="button" onclick="openModal({{ $book->id }})" style="color: var(--danger); background: none; border: none; font-weight: 600; cursor: pointer;">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon">🥀</div>
            <h3>Hapus Buku?</h3>
            <p>Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <form id="deleteForm" method="POST" style="margin: 0;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-confirm">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById('deleteModal').style.display = 'flex'; document.getElementById('deleteForm').action = '/delete/' + id; }
        function closeModal() { document.getElementById('deleteModal').style.display = 'none'; }
    </script>
@endsection