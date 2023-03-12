<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::dropIfExists('planeta_niveles');

        Schema::create('planeta_niveles', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('planeta_id')->unsigned();
            $table->bigInteger('nivel_id')->unsigned();
            $table->dateTime('fin');
            
        });       
        
        Schema::table('planeta_niveles', function($table) {
            $table->foreign('planeta_id')->references('id')->on('planetas')->onDelete('cascade')->index('planeta_edidicios');
            $table->foreign('nivel_id')->references('id')->on('niveles')->onDelete('cascade')->index('nivelesEdificio_planetas');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('planeta_niveles');
    }
};
