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
    Schema::create('telaah', function (Blueprint $table) {
      $table->id();
      $table->string('unit_kerja_inisiator');
      $table->string('jenis_kerja_sama');
      $table->string('jenis_perjanjian');
      $table->text('judul_kerja_sama');
      $table->string('dokumen_pengantar');
      $table->string('dokumen_telaah');

      //MITRA
      $table->string('klasifikasi_mitra');
      $table->string('nama_instansi_mitra');
      $table->text('alamat_instansi_mitra');
      $table->string('nama_mitra_penandatangan');
      $table->string('nama_mitra_penanggungjawab');

      //STATUS
      $table->date('tanggal_masuk_bkmp')->nullable();
      $table->date('tanggal_keluar_bkmp')->nullable();
      // $table->date('tanggal_masuk_hukum')->nullable();
      // $table->date('tanggal_keluar_hukum')->nullable();
      // $table->date('tanggal_masuk_sekretariat')->nullable();
      // $table->date('tanggal_keluar_sekretariat')->nullable();

      $table->tinyInteger('validasi_bkmp')->default(0);
      // $table->tinyInteger('validasi_hukum')->default(0);
      // $table->tinyInteger('validasi_sekretariat')->default(0);

      $table->string('ctt_bkmp')->nullable();
      // $table->string('ctt_hukum')->nullable();
      // $table->string('ctt_sekretariat')->nullable();

      $table->enum('status_telaah', ['Diajukan', 'Dalam Proses', 'Selesai', 'Ditolak'])->default('Diajukan');
      $table->tinyInteger('is_deleted')->default(0);
      $table->string('created_by')->nullable();
      $table->string('updated_by')->nullable();

      // $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('telaah');
  }
};
