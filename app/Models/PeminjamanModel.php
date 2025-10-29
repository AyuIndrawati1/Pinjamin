<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table         = 'peminjaman';
    protected $primaryKey    = 'id';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'nama_peminjam',
        'id_laptop',   
        'tgl_pinjam',
        'rencana_kembali',
        'tgl_kembali',
        'keperluan',
        'petugas_pinjam',
        'petugas_kembali',
        'status'
    ];

    public function getAll()
    {
        return $this->select('peminjaman.*, laptop.nama_laptop, laptop.seri')
                    ->join('laptop', 'laptop.id = peminjaman.id_laptop', 'left')
                    ->findAll();
    }

    public function normalizeStatus(array $row): string
    {
        if (!empty($row['tgl_kembali'])) {
            if (!empty($row['rencana_kembali']) && $row['tgl_kembali'] > $row['rencana_kembali']) {
                return 'Dikembalikan Terlambat';
            }
            return 'Dikembalikan';
        }

        $today = date('Y-m-d');
        return (!empty($row['rencana_kembali']) && $row['rencana_kembali'] < $today)
            ? 'Terlambat'
            : 'Dipinjam';
    }
}
