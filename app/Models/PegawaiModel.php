<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';         // nama tabel di database
    protected $primaryKey = 'id';         // kolom primary key
    protected $allowedFields = ['nama'];  // kolom yang bisa diisi (fillable)
}
