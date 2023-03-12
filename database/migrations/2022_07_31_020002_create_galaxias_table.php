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

        Schema::dropIfExists('galaxias');

        Schema::create('galaxias', function (Blueprint $table) {

            $table->id();

            $table->bigInteger('universo_id')->unsigned();
            $table->tinyInteger('posY');        // -128 a 127
            $table->tinyInteger('posZ');        // -128 a 127
            $table->enum('tipo', ['espiral','lenticular','eliptica','irregular'])->default('espiral');

            

        });       
        
        /*  Añadimos relación de universo_id con id de la tabla universo*/
        Schema::table('galaxias', function($table) {
            $table->foreign('universo_id')->references('id')->on('universos')->onDelete('cascade')->index('galaxias_universo');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('galaxias');
    }
};
