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
        Schema::table('telaah', function (Blueprint $table) {
            $table->bigInteger('bentuk_kegiatan')->after('klasifikasi_mitra')->unsigned();
            $table->string('dokumen_telaah')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('telaah', function (Blueprint $table) {
            //
        });
    }
};
