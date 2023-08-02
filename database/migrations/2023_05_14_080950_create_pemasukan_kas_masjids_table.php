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
        Schema::create('pemasukan_kas_masjids', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan_pemasukan');
            $table->decimal('jumlah_pemasukan', 12, 2);
            $table->date('tanggal_pemasukan');
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
        Schema::dropIfExists('pemasukan_kas_masjids');
    }
};
