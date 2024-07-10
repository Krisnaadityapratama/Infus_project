<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->id();
            $table->integer("tpm")->nullable();
            $table->decimal("kapasitas")->nullable();
            $table->decimal("prediksi")->nullable();
            $table->string("status")->nullable();
            $table->timestamps();

                                    // Tambahkan foreign key dengan onDelete cascade
            $table->foreignId('IdPasien')->nullable()->constrained('pasiens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
}
