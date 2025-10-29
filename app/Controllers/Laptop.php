<?php

namespace App\Controllers;

use App\Models\LaptopModel;

class Laptop extends BaseController
{
    protected $laptopModel;

    public function __construct()
    {
        $this->laptopModel = new LaptopModel();
    }

    public function index()
    {
        $data['laptops'] = $this->laptopModel->findAll();
        return view('laptop/index', $data);
    }

    public function create()
    {
        return view('laptop/create');
    }

    public function store()
    {
        $this->laptopModel->save([
            'nama_laptop'     => $this->request->getPost('nama_laptop'),
            'seri'            => $this->request->getPost('seri'),
            'tahun_pengadaan' => $this->request->getPost('tahun_pengadaan')
        ]);

        return redirect()->to('/laptop')->with('success', 'Data laptop berhasil ditambahkan');
    }

    public function edit($id)
    {
        $laptop = $this->laptopModel->find($id);

        if (!$laptop) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data laptop tidak ditemukan');
        }

        return view('laptop/edit', ['laptop' => $laptop]);
    }

    public function update($id)
    {
        $this->laptopModel->update($id, [
            'nama_laptop'     => $this->request->getPost('nama_laptop'),
            'seri'            => $this->request->getPost('seri'),
            'tahun_pengadaan' => $this->request->getPost('tahun_pengadaan'),
        ]);

        return redirect()->to('/laptop')->with('success', 'Data laptop berhasil diperbarui');
    }

    public function delete($id)
    {
        $laptop = $this->laptopModel->find($id);
        if (!$laptop) {
            return redirect()->to('/laptop')->with('error', 'Data laptop tidak ditemukan.');
        }

        $this->laptopModel->delete($id);

        return redirect()->to('/laptop')->with('success', 'Data laptop berhasil dihapus.');
    }

}
