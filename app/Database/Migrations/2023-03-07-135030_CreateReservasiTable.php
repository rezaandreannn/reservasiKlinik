<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservasiTable extends Migration
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
            'kode_reservasi' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true, // added unsigned attribute
            ],
            'treatment_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true, // added unsigned attribute
            ],
            'tanggal_reservasi' => [
                'type' => 'DATE',
            ],
            'jam_mulai' => [
                'type' => 'TIME',
            ], 
            'jam_selesai' => [
                'type' => 'TIME',    
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status_reservasi' => [
                'type' => 'ENUM',
                'constraint'  => ['pending','selesai', 'batal'],
                'default' => 'pending'
            ],
            'created_at' => [
				'type' => 'DATETIME',
			],
            'updated_at' => [
				'type' => 'DATETIME',
			],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('reservasi');

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('treatment_id', 'treatments', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        
        $this->forge->dropTable('reservasi');
    }
}