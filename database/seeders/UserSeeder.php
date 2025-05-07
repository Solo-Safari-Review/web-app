<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userType = [
            'admin-review',
            'admin-operasional',
            'admin-satwa',
            'admin-konservasi-pendidikan',
            'admin-pengunjung',
            'admin-komunikasi-pemasaran',
            'admin-administrasi-keuangan',
            'admin-inovasi-pengembangan'
        ];

        foreach ($userType as $type) {
            $user = User::create([
                'first_name' => '',
                'last_name' => $type,
                'email' => $type . '@example.com',
                'phone' => '088888888888',
                'password' => bcrypt('S0loSAFARI@password'),
                'is_validated' => 1
            ]);

            if ($type == 'admin-review') {$user->assignRole('Admin Review');} else {$user->assignRole('Admin Departemen');}
        }
    }
}
