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
    Schema::create('kerjasama_unit_kerja', function (Blueprint $table) {
      $table->id();
      $table->integer('id_kerjasama');
      $table->string('unit_kerja');
      $table->string('penandatangan_nama_unit_kerja');
      $table->string('jabatan_penandatangan_unit_kerja');
      $table->string('penanggungjawab_nama_unit_kerja');
      $table->string('jabatan_penanggungjawab_unit_kerja');

      $table->tinyInteger('is_deleted')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('kerjasama_unit_kerja');
  }
};
