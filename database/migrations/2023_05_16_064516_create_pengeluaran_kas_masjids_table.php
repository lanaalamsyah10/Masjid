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
        Schema::create('pengeluaran_kas_masjids', function (Blueprint $table) {
            $table->id();

            //  $table->foreignId('pemasukan_id')->nullable()->constrained('pemasukan_kas_masjids')->nullOnDelete();

            $table->string('keterangan_pengeluaran');
            $table->decimal('jumlah_pengeluaran', 12, 2);
            $table->string('tanggal_pengeluaran');

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
        Schema::dropIfExists('pengeluaran_kas_masjids');
    }
};
