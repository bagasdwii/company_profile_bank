<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_depositos', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar'); 
            $table->text('keterangan'); 
            $table->string('nama_button'); 
            $table->integer('nomor_button'); 
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
        Schema::dropIfExists('data_depositos');
    }
};
