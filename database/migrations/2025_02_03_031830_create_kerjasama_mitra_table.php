<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('kerjasama_mitra', function (Blueprint $table) {
      $table->id();
      $table->integer('id_kerjasama');
      $table->string('klasifikasi_mitra');
      $table->string('nama_instansi_mitra');
      $table->text('alamat_instansi_mitra');
      $table->string('penandatangan_nama_mitra');
      $table->string('jabatan_penandatangan_mitra');
      $table->string('penanggungjawab_nama_mitra');
      $table->string('jabatan_penanggungjawab_mitra');

      $table->tinyInteger('is_deleted')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('kerjasama_mitra');
  }
};
