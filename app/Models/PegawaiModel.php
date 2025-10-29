<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';          // nama tabel di database
    protected $primaryKey = 'id';          // kolom primary key
    protected $allowedFields = ['nama', 'role'];  // tambahkan 'role'

    /**
     * Ambil semua pegawai
     * Bisa dipakai untuk dropdown
     */
    public function getAllPegawai()
    {
        return $this->orderBy('nama', 'ASC')->findAll();
    }

    /**
     * Ambil nama pegawai berdasarkan ID
     */
    public function getNamaById($id)
    {
        $pegawai = $this->find($id);
        return $pegawai ? $pegawai['nama'] : '-';
    }
}
