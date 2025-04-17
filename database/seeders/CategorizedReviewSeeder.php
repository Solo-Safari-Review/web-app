<?php

namespace Database\Seeders;

use App\Models\CategorizedReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorizedReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['category_id' => 1, 'review_id' => 1],
            ['category_id' => 1, 'review_id' => 2],
            ['category_id' => 1, 'review_id' => 3],
            ['category_id' => 2, 'review_id' => 4],
            ['category_id' => 2, 'review_id' => 5],
            ['category_id' => 2, 'review_id' => 6],
            ['category_id' => 3, 'review_id' => 7],
        ];

        foreach ($data as $item) {
            CategorizedReview::create($item);
        }
    }
}
