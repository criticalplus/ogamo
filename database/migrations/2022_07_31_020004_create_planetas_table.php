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

        Schema::dropIfExists('planetas');

        Schema::create('planetas', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('universo_id')->unsigned();
            $table->bigInteger('sistema_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->string('nombre')->nullable();
            $table->unsignedTinyInteger('pos');        // 0 a 127
            $table->boolean('habitable');
            $table->boolean('atmosfera');
            $table->enum('tipo', ['roca','gas'])->default('roca');
            $table->enum('bioma', ['biodiverso','alien','hielo','desierto','oceano','lava'])->default('biodiverso');
            $table->enum('magnitud', ['meteroide','asteroide','enano','mediano','gigante'])->default('mediano');
            $table->softDeletes();

        });       
        
        /*  Añadimos relación de universo_id con id de la tabla universo*/
        Schema::table('planetas', function($table) {
            $table->foreign('universo_id')->references('id')->on('universos')->onDelete('cascade')->index('planeta_universo');
            $table->foreign('sistema_id')->references('id')->on('sistemas')->onDelete('cascade')->index('planetas_sistemas');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->index('planetas_users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('planetas');
    }
};
