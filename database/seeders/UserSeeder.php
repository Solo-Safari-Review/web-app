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
                'name' => $type,
                'email' => $type . '@example.com',
                'password' => bcrypt('S0loSAFARI@password'),
            ]);

            if ($type == 'admin-review') {$user->assignRole('review_admin');} else {$user->assignRole('department_admin');}
        }
    }
}
