<?php

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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->integer('likes');
            $table->text('content');
            $table->integer('rating');
            $table->text('review_context_1')->nullable();
            $table->text('review_context_2')->nullable();
            $table->text('review_context_3')->nullable();
            $table->text('review_context_4')->nullable();
            $table->text('answer')->nullable();
            $table->integer('predicted_rating')->nullable();
            $table->boolean('answered_any_review_context')->nullable();
            $table->integer('review_length')->nullable();
            $table->boolean('is_local_guide')->nullable();
            $table->integer('reviewer_number_of_reviews')->nullable();
            $table->boolean('contains_question')->nullable();
            $table->boolean('contains_number')->nullable();
            $table->boolean('is_extreme_rating')->nullable();
            $table->boolean('is_weekend')->nullable();
            $table->integer('image_count')->nullable();
            $table->boolean('is_helpful')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
