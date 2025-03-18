<?php

use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorized_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Review::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullOnDelete()->nullable();
            $table->enum('review_status', ['Belum diteruskan', 'Sudah diteruskan']);
            $table->enum('action_status', ['Belum dikerjakan', 'Dalam proses', 'Selesai']);
            $table->enum('answer_status', ['Belum dijawab', 'Sudah dijawab']);
            $table->text('review_admin_comment')->nullable();
            $table->text('departement_admin_comment')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorized_reviews');
    }
};
