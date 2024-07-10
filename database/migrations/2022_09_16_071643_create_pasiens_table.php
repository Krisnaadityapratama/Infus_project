<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('alat'); // Mengubah tipe data menjadi unsignedInteger
            $table->string('nama')->nullable();
            $table->string('ruang')->nullable();
            $table->integer('status');
            $table->timestamps();

            // Definisi foreign key
            $table->foreign('alat')->references('id')->on('sensors')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
}
