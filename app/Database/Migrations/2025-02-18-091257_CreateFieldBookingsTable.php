<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFieldBookingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'booking_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'lapangan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'nama_customer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'nomor_telefon_customer' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'email_customer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'booking_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'bukti_transfer' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'payment_method' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['Pending', 'Paid', 'Cancelled'],
                'default' => 'Pending',
            ],
            'booking_status' => [
                'type' => 'ENUM',
                'constraint' => ['Booked', 'Completed', 'Cancelled'],
                'default' => 'Booked',
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

        $this->forge->addPrimaryKey('booking_id');
        $this->forge->createTable('fieldbookings');
    }

    public function down()
    {
        $this->forge->dropTable('fieldbookings');
    }
}
