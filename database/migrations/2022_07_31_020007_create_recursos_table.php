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

        Schema::dropIfExists('recursos');

        Schema::create('recursos', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('photo_path', 2048)->nullable();
            
        });       
        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('recursos');
    }
};
