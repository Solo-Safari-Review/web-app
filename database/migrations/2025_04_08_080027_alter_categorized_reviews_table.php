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
        Schema::table('categorized_reviews', function (Blueprint $table) {
            $table->renameColumn('departement_admin_comment', 'department_admin_comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorized_reviews', function (Blueprint $table) {
            $table->renameColumn('department_admin_comment', 'departement_admin_comment');
        });
    }
};
