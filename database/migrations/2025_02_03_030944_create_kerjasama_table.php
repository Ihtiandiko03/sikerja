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
    Schema::create('kerjasama', function (Blueprint $table) {
      $table->id();
      $table->string('unit_kerja_inisiator');
      $table->string('bentuk_kegiatan');
      $table->string('nomor_kerjasama');
      $table->string('jenis_kerjasama');
      $table->string('jenis_perjanjian');
      $table->text('judul_kerjasama');
      $table->date('masa_berlaku_tmt');
      $table->date('masa_berlaku_tat');
      $table->string('dokumen_kerjasama');
      $table->string('dokumen_lpj_kerjasama')->nullable();
      $table->string('status_kerjasama')->nullable();

      $table->string('created_by')->nullable();
      $table->string('updated_by')->nullable();

      $table->tinyInteger('is_deleted')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('kerjasama');
  }
};
