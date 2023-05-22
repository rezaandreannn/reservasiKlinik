<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBankTable extends Migration
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
            'kode_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'nama_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'logo_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'no_rekening' => [
                'type' => 'INT',
                'constraint' => 50
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['aktif', 'tidak aktif']
            ],
            'created_at' => [
				'type' => 'DATETIME',
			],
            'updated_at' => [
				'type' => 'DATETIME',
			],
           
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bank');
    }

    public function down()
    {
        $this->forge->dropTable('bank');
    }
}