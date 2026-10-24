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
        Schema::table('laporan_log', function (Blueprint $table) {
            $table->string('waktu_enkripsi')->nullable();
            $table->string('ukuran_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_log', function (Blueprint $table) {
            $table->dropColumn(['waktu_enkripsi', 'ukuran_file']);
        });
    }
};
