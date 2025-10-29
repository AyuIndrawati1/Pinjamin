<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use CodeIgniter\Controller;

class Pegawai extends Controller
{
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    // ================== INDEX ==================
    public function index()
    {
        $data['pegawai'] = $this->pegawaiModel->findAll();
        return view('pegawai/index', $data);
    }

    // ================== CREATE ==================
    public function create()
    {
        return view('pegawai/create');
    }

    // ================== STORE ==================
    public function store()
    {
        $this->pegawaiModel->save([
            'nama' => $this->request->getPost('nama'),
            'role' => 'Pegawai', // default role
        ]);

        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil ditambahkan');
    }

    // ================== EDIT ==================
    public function edit($id)
    {
        $pegawai = $this->pegawaiModel->find($id);

        if (!$pegawai) {
            return redirect()->to('/pegawai')->with('error', 'Data pegawai tidak ditemukan');
        }

        return view('pegawai/edit', ['pegawai' => $pegawai]);
    }

    // ================== UPDATE ==================
    public function update($id)
    {
        $this->pegawaiModel->update($id, [
            'nama' => $this->request->getPost('nama'),
        ]);

        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil diperbarui');
    }

    // ================== DELETE ==================
    public function delete($id)
    {
        $this->pegawaiModel->delete($id);
        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil dihapus');
    }

    // ================== ROLE HANDLER ==================
    public function jadikanPeminjaman($id)
    {
        $this->pegawaiModel->update($id, ['role' => 'Petugas Peminjaman']);
        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil dijadikan Petugas Peminjaman');
    }

    public function jadikanPengembalian($id)
    {
        $this->pegawaiModel->update($id, ['role' => 'Petugas Pengembalian']);
        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil dijadikan Petugas Pengembalian');
    }

    public function jadikanPegawai($id)
    {
        $this->pegawaiModel->update($id, ['role' => 'Pegawai']);
        return redirect()->to('/pegawai')->with('success', 'Role pegawai berhasil dikembalikan');
    }
}
