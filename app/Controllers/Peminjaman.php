<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PegawaiModel;
use App\Models\LaptopModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $pegawaiModel;
    protected $laptopModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->pegawaiModel    = new PegawaiModel();
        $this->laptopModel     = new LaptopModel();
    }

    public function index()
    {
        $items = $this->peminjamanModel->getAll();

        foreach ($items as &$item) {
            $item['status'] = $this->peminjamanModel->normalizeStatus($item);
            $this->peminjamanModel->update($item['id'], ['status' => $item['status']]);
        }

        return view('peminjaman/index', ['items' => $items]);
    }

    public function create()
    {
        $pegawaiList = $this->pegawaiModel->orderBy('nama', 'ASC')->findAll();
        $laptopList  = $this->laptopModel->findAll(); // Untuk select list, tapi tetap simpan merk_laptop

        return view('peminjaman/form', compact('pegawaiList', 'laptopList'));
    }

    public function store()
    {
        $data = [
            'nama_peminjam'   => $this->request->getPost('nama_peminjam'),
            'merk_laptop'     => $this->request->getPost('merk_laptop'), // pakai merk_laptop
            'tgl_pinjam'      => $this->convertDate($this->request->getPost('tgl_pinjam')),
            'rencana_kembali' => $this->convertDate($this->request->getPost('rencana_kembali')),
            'petugas_pinjam'  => $this->request->getPost('petugas_pinjam'),
            'petugas_kembali' => $this->request->getPost('petugas_kembali'),
            'keperluan'       => $this->request->getPost('keperluan'),
            'tgl_kembali'     => $this->convertDate($this->request->getPost('tgl_kembali')),
            'status'          => 'Dipinjam'
        ];

        $this->peminjamanModel->insert($data);
        return redirect()->to('/peminjaman')->with('success', 'Data peminjaman berhasil disimpan.');
    }

    public function edit($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);
        if (!$peminjaman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tidak ditemukan");
        }

        $pegawaiList = $this->pegawaiModel->findAll();
        $laptopList  = $this->laptopModel->findAll(); // Untuk select list merk_laptop

        return view('peminjaman/form', compact('peminjaman', 'pegawaiList', 'laptopList'));
    }

    public function update($id)
    {
        $data = [
            'nama_peminjam'   => $this->request->getPost('nama_peminjam'),
            'merk_laptop'     => $this->request->getPost('merk_laptop'), // pakai merk_laptop
            'tgl_pinjam'      => $this->convertDate($this->request->getPost('tgl_pinjam')),
            'rencana_kembali' => $this->convertDate($this->request->getPost('rencana_kembali')),
            'petugas_pinjam'  => $this->request->getPost('petugas_pinjam'),
            'petugas_kembali' => $this->request->getPost('petugas_kembali'),
            'keperluan'       => $this->request->getPost('keperluan'),
            'tgl_kembali'     => $this->convertDate($this->request->getPost('tgl_kembali')),
        ];

        $this->peminjamanModel->update($id, $data);
        return redirect()->to('/peminjaman')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->peminjamanModel->delete($id);
        return redirect()->to('/peminjaman')->with('success', 'Data berhasil dihapus.');
    }

    public function kembalikan($id)
    {
        $row = $this->peminjamanModel->find($id);
        if (!$row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tidak ditemukan");
        }

        if (in_array($row['status'], ['Dipinjam', 'Terlambat'])) {
            $this->peminjamanModel->update($id, [
                'status'      => 'Dikembalikan',
                'tgl_kembali' => date('Y-m-d'),
            ]);

            return redirect()->to('/peminjaman')->with('success', 'Laptop berhasil dikembalikan.');
        }

        return redirect()->to('/peminjaman')->with('info', 'Laptop sudah berstatus Dikembalikan.');
    }

    private function convertDate($date)
    {
        if (!$date) return null;
        $dt = \DateTime::createFromFormat('d/m/Y', $date);
        return $dt ? $dt->format('Y-m-d') : null;
    }
}
