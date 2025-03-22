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
            $table->integer('predicted_rating')->nullable();
            $table->text('answer')->nullable();
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
