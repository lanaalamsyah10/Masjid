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
        Schema::create('kurban', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('hewan_kurban', ['Sapi', 'Kambing']);
            $table->float('jumlah');
            $table->string('permintaan');
            $table->date('tanggal_masuk');
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
        Schema::dropIfExists('kurban');
    }
};
