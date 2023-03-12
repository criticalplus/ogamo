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

        Schema::dropIfExists('edificios');

        Schema::create('edificios', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('photo_path', 2048)->nullable();
            $table->enum('categoria', ['civil','militar','energia','recursos','investigacion']);
            
        });       
        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('edificios');
    }
};
