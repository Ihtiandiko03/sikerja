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
        Schema::create('riwayat_telaah', function (Blueprint $table) {
            $table->id();
            $table->enum('aksi', ['VALIDASI', 'UPLOAD', 'REVISI'])->default('VALIDASI');
            $table->enum('validasi', ['TERIMA', 'TOLAK'])->default('TERIMA');
            $table->string('file_dokumen_telaah')->nullable();
            $table->text('catatan')->nullable();
            $table->bigInteger('telaah_id')->unsigned();
            $table->foreign('telaah_id')->references('id')->on('telaah')->onDelete('cascade');
            $table->string('created_by', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_telaah');
    }
};
