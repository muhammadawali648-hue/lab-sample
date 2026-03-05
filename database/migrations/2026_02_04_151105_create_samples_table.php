<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('samples', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_sample');
        $table->string('nama_sample');
        $table->string('lab_tujuan');
        $table->date('tanggal_masuk');
        $table->string('stok')->default('Ada');
        $table->string('status')->default('Masuk');
        $table->timestamps();
    });
}






    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samples');
    }
};
