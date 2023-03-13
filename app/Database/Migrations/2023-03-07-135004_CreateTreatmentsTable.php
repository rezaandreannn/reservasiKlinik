<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTreatmentsTable extends Migration
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
            'nama_treatment' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kategori_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true, // added unsigned attribute
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'deskripsi' => [
                'type' => 'TEXT'
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 30,
                'default' => 0
            ],
            'durasi' => [
                'type' => 'TIME',    
            ],
            'created_at' => [
				'type' => 'DATETIME',
			],
            'updated_at' => [
				'type' => 'DATETIME',
			],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('treatments');
    }

    public function down()
    {
        $this->forge->dropTable('treatments');
    }
}