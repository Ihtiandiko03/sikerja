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
        Schema::table('kerjasama', function (Blueprint $table) {
            $table->bigInteger('unit_kerja_inisiator')->unsigned()->change();
            $table->bigInteger('bentuk_kegiatan')->unsigned()->change();
            $table->tinyInteger('is_publish')->default(1)->after('status_kerjasama');
            $table->dropColumn('is_deleted');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerjasama', function (Blueprint $table) {
            //
        });
    }
};
