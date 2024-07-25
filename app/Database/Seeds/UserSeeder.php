<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Marco',
                'email' => 'marco@gmail.com',
                'phone' => '4493249454'
            ],
        ];
        $this->db->table('user')->insertBatch($data);
    }
}
