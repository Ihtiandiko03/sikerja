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
        Schema::table('kerjasama_unit_kerja', function (Blueprint $table) {
            $table->bigInteger('unit_kerja')->unsigned()->change();
            $table->dropColumn('is_deleted');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerjasama_unit_kerja', function (Blueprint $table) {
            //
        });
    }
};
