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

        Schema::dropIfExists('sistemas');

        Schema::create('sistemas', function (Blueprint $table) {

            $table->id();

            $table->bigInteger('galaxia_id')->unsigned();
            $table->tinyInteger('posY');        // -128 a 127
            $table->tinyInteger('posZ');        // -128 a 127
            //$table->unsignedTinyInteger('num_planetas');     // 0 a 127
            $table->enum('num_estrellas', [0,1,2,3,4,5,6])->default(1);
            $table->enum('tipo_estrellas', ['O','B','A','F','G','K','M'])->default('K');            

        });       
        
        /*  Añadimos relación de universo_id con id de la tabla universo*/
        Schema::table('sistemas', function($table) {
            $table->foreign('galaxia_id')->references('id')->on('galaxias')->onDelete('cascade')->index('sistemas_galaxia');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('sistemas');
    }
};
