<?php

namespace App\Models;

use CodeIgniter\Model;

class LaptopModel extends Model
{
    protected $table      = 'laptop';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_laptop', 'seri', 'tahun_pengadaan'];
    protected $useSoftDeletes = false;
}
