<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaptop extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_laptop' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'spesifikasi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['tersedia', 'dipinjam'],
                'default'    => 'tersedia',
            ],

            // Jika mau, bisa hapus kolom status, created_at, updated_at juga
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('laptop');
    }

    public function down()
    {
        $this->forge->dropTable('laptop');
    }
}
