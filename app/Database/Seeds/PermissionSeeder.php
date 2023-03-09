<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'kelola pengguna',
            'description' => 'ini hanya untuk admin'
        ];

        $this->db->table('auth_permissions')->insert($data);
    }
}