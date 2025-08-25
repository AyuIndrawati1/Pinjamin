<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_peminjam'   => 'Ahmad Rizki Pratama',
                'merk_laptop'     => 'ASUS',
                'tgl_pinjam'      => '2024-01-15',
                'rencana_kembali' => '2024-01-20',
                'tgl_kembali'     => '2024-01-19',
                'keperluan'       => 'Presentasi',
                'petugas_pinjam'  => 'Admin A',
                'petugas_kembali' => 'Admin B',
                'status'          => 'dikembalikan',
            ],
            [
                'nama_peminjam'   => 'Siti Nurhaliza',
                'merk_laptop'     => 'Lenovo',
                'tgl_pinjam'      => '2024-01-16',
                'rencana_kembali' => '2024-01-18',
                'tgl_kembali'     => null,
                'keperluan'       => 'Kegiatan lapangan',
                'petugas_pinjam'  => 'Admin A',
                'status'          => 'terlambat',
            ],
            [
                'nama_peminjam'   => 'Budi Santoso',
                'merk_laptop'     => 'HP',
                'tgl_pinjam'      => '2024-01-17',
                'rencana_kembali' => '2024-01-25',
                'tgl_kembali'     => null,
                'keperluan'       => 'Rapat',
                'petugas_pinjam'  => 'Admin A',
                'status'          => 'dipinjam',
            ],
        ];

        $this->db->table('peminjaman')->insertBatch($data);
    }
}
