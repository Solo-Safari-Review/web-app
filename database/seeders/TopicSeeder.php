<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Toilet', 'Tempat Duduk', 'Area Parkir', 'Fasilitas Disabilitas', 'Restoran'];

        foreach ($data as $value) {
            Topic::create([
                'name' => $value,
                'category_id' => rand(1, 4)
            ]);
        }
    }
}
