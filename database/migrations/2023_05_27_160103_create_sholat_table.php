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
        Schema::create('sholat', function (Blueprint $table) {
            $table->id();
            $table->enum('waktu', ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya']);
            $table->string('imam');
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
        Schema::dropIfExists('sholat');
    }
};
