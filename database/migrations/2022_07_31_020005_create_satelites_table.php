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

        Schema::dropIfExists('satelites');

        Schema::create('satelites', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('planeta_id')->unsigned();

            $table->string('nombre')->nullable();
            $table->unsignedTinyInteger('pos');        // 0 a 127
            $table->enum('magnitud', ['meteroide','asteroide','enano','mediano','gigante'])->default('mediano');
            $table->softDeletes();

        });       
        
        /*  Añadimos relación de universo_id con id de la tabla universo*/
        Schema::table('satelites', function($table) {
            $table->foreign('planeta_id')->references('id')->on('planetas')->onDelete('cascade')->index('satelites_planetas');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('satelites');
    }
};
