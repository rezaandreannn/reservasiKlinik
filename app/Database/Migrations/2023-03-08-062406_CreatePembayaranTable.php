<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'reservasi_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true, // added unsigned attribute
            ],
            'bank_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true, // added unsigned attribute
            ],
            'jenis_bayar' => [
                'type' => 'ENUM',
                'constraint' => ['DP', 'Cash'],
                'default' => 'DP'
            ],
            'bukti_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'sisa_pembayaran' => [
                'type' => 'INT',
                'constraint' => 30,
                'default' => 0
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'konfirmasi', 'selesai', 'batal'],
                'default' => 'pending'
            ],
            'created_at' => [
				'type' => 'DATETIME',
			],
            'updated_at' => [
				'type' => 'DATETIME',
			],
           
        ]);

        $this->forge->addForeignKey('reservasi_id', 'reservasi', 'id');
        // $this->forge->addForeignKey('bank_id', 'bank', 'id');

        $this->forge->addKey('id', true);
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}