<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Universo;
use App\Models\Galaxia;
use App\Models\Planeta;
use App\Models\Sistema;
use App\Models\Satelite;

class UniversoSeeder extends Seeder{


    public function run(){
        
        //Creo Universos
        for($d=1;$d<=3;$d++) {

            $universo = Universo::factory()->create();

            //Creo Galaxias
            for($a=1;$a<=10;$a++) {

                $galaxia = Galaxia::factory()->create(['universo_id' => $universo->id,]);

                //Creo Sistemas
                for($b=1;$b<=10;$b++) {

                    $sistema = Sistema::factory()->create(['galaxia_id' => $galaxia->id,]);
                    
                    //Creo Planetas
                    for($i=1;$i<=rand(1,8);$i++){

                        $planeta = Planeta::factory()->create([
                            'universo_id' => $universo->id,
                            'sistema_id' => $sistema->id,
                            'pos' => $i,
                        ]);

                        //Creo Satelites
                        $rand = rand(0,3);
                        if( $rand != 0 ){
                        for($s=1;$s<=$rand;$s++) {
                            Satelite::factory() 
                                ->create([
                                    'planeta_id' => $planeta->id,
                                    'pos' => $s,
                                ]);
                            }
                        }

                    }

                }    

            }   

        }

    }



}
