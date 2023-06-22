<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zakat_fitrah', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('tanggal');
            $table->integer('jumlah_beras')->nullable(); // Add this line
            $table->integer('jumlah_uang')->nullable(); // Add this line
            // $table->foreignId('kode_jenis_zakat');
            // $table->foreignId('kode_isi_zakat')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zakat_fitrah');
    }
};
