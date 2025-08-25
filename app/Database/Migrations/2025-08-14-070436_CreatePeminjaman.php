<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeminjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_peminjam'     => ['type' => 'VARCHAR', 'constraint' => 120],
            'merk_laptop'       => ['type' => 'VARCHAR', 'constraint' => 80],
            'tgl_pinjam'        => ['type' => 'DATE'],
            'rencana_kembali'   => ['type' => 'DATE'],
            'tgl_kembali'       => ['type' => 'DATE', 'null' => true],
            'keperluan'         => ['type' => 'TEXT', 'null' => true],
            'petugas_pinjam'    => ['type' => 'VARCHAR', 'constraint' => 120],
            'petugas_kembali'   => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'status'            => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'dipinjam'], // dipinjam|terlambat|dikembalikan
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('peminjaman', true);
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman', true);
    }
}
