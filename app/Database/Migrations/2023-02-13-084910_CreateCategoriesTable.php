<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'description'      => [
				'type'           => 'TEXT',
				
			],
            'created_at'      => [
				'type'           => 'DATETIME',
			],
            'updated_at'      => [
				'type'           => 'DATETIME',
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel categories
		$this->forge->createTable('categories', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}