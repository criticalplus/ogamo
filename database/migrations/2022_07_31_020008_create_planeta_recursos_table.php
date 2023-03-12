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

        Schema::dropIfExists('planeta_recursos');

        Schema::create('planeta_recursos', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('planeta_id')->unsigned();
            $table->bigInteger('recurso_id')->unsigned();
            $table->unsignedInteger('cantidad')->default(0);
            
        });       
        
        Schema::table('planeta_recursos', function($table) {
            $table->foreign('planeta_id')->references('id')->on('planetas')->onDelete('cascade')->index('planeta_recursos');
            $table->foreign('recurso_id')->references('id')->on('recursos')->onDelete('cascade')->index('recurso_planetas');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('planeta_recursos');
    }
};
