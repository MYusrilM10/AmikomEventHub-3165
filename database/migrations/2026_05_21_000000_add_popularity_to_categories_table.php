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
        Schema::table('categories', function (Blueprint $table) {
            // Tambah kolom popularity jika belum ada
            if (!Schema::hasColumn('categories', 'popularity')) {
                $table->enum('popularity', ['Trending', 'Popular', 'New'])
                    ->default('New')
                    ->after('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Drop kolom popularity
            if (Schema::hasColumn('categories', 'popularity')) {
                $table->dropColumn('popularity');
            }
        });
    }
};
