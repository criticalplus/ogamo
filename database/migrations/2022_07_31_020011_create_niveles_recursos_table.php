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

        Schema::dropIfExists('niveles_recursos');

        Schema::create('niveles_recursos', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('nivel_id')->unsigned();
            $table->bigInteger('recurso_id')->unsigned();
            $table->integer('coste')->unsigned()->nullable()->default(null);
            $table->integer('consumo')->unsigned()->nullable()->default(null);
            $table->integer('produccion')->unsigned()->nullable()->default(null);
            
        });       
        
        Schema::table('niveles_recursos', function($table) {
            $table->foreign('nivel_id')->references('id')->on('niveles')->onDelete('cascade')->index('edificio_nivel_recursos');
            $table->foreign('recurso_id')->references('id')->on('recursos')->onDelete('cascade')->index('recurso_edificios');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('niveles_recursos');
    }
};
