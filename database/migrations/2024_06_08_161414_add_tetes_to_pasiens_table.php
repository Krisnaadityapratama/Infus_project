<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTetesToPasiensTable extends Migration
{
    public function up()
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->integer('tetes')->after('ruang'); // Sesuaikan sesuai kebutuhan
        });
    }
    
    public function down()
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->dropColumn('tetes');
        });
    }
    
}
