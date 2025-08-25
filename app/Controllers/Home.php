<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new PeminjamanModel();

        $data['dipinjam'] = $model->where('status', 'Dipinjam')->countAllResults();
        $data['dikembalikan'] = $model->where('status', 'Dikembalikan')->countAllResults();
        $data['terlambat'] = $model->where('status', 'Terlambat')->countAllResults();

        return view('home', $data);
    }
}
