<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'nama_peminjam',
        'merk_laptop',
        'tgl_pinjam',
        'rencana_kembali',
        'tgl_kembali',
        'keperluan',
        'petugas_pinjam',
        'petugas_kembali',
        'status'
    ];

    // Hitung status dinamis (fallback jika field status tidak konsisten)
    public function normalizeStatus(array $row): string
    {
        if (!empty($row['tgl_kembali'])) return 'dikembalikan';
        $today = date('Y-m-d');
        return ($row['rencana_kembali'] < $today) ? 'terlambat' : 'dipinjam';
    }
}
