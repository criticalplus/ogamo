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

        Schema::dropIfExists('niveles');

        Schema::create('niveles', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('edificio_id')->unsigned();
            $table->unsignedTinyInteger('nivel')->default(0);
            $table->unsignedInteger('tiempo')->default(0);
            
        });       
        
        Schema::table('niveles', function($table) {
            $table->foreign('edificio_id')->references('id')->on('edificios')->onDelete('cascade')->index('edificio_niveles');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('niveles');
    }
};
