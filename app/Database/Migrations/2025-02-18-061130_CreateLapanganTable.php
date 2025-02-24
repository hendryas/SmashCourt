<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLapanganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lapangan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'tipe_lantai' => [
                'type' => 'ENUM',
                'constraint' => ['Vinyl', 'Karpet', 'Kayu', 'Semen'],
                'null' => false,
            ],
            'harga_per_jam' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'fasilitas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Tersedia', 'Tidak Tersedia'],
                'default' => 'Tersedia',
            ],
            'delete_sts' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0,
            ],
            'created_user' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'updated_user' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('lapangan_id', true);
        $this->forge->createTable('lapangan');
    }

    public function down()
    {
        $this->forge->dropTable('lapangan');
    }
}
