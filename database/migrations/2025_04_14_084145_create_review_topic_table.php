<?php

use App\Models\Review;
use App\Models\Topic;
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
        Schema::create('review_topic', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Review::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Topic::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_topic');
    }
};
