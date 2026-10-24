<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->string('password_file')->nullable()->after('kategori');
        });

        Schema::table('laporan_log', function (Blueprint $table) {
            $table->string('password_file')->nullable()->after('upload_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn('password_file');
        });

        Schema::table('laporan_log', function (Blueprint $table) {
            $table->dropColumn('password_file');
        });
    }
};
