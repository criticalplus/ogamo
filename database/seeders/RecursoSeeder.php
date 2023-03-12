<?php
namespace Database\Seeders;

use App\Models\Recurso;
use App\Models\Nivel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RecursoSeeder extends Seeder{

    public function run(){

        $json = File::get(base_path() .'/database/seeders/json/recursos.json');
        $data = json_decode($json);

        foreach ($data as $item){
            Recurso::create(array(
                    'name' => $item->name,
                    'photo_path' => $item->photo_path
            ));

        }
        

        $json = File::get(base_path() .'/database/seeders/json/recursos_niveles.json');
        $data = json_decode($json);

        foreach ($data as $item){

            if( $item->coste == -1 ){
                $item->coste = NULL;
            }
            if( $item->consumo == -1 ){
                $item->consumo = NULL;
            }
            if( $item->produccion == -1 ){
                $item->produccion = NULL;
            }

            DB::table('niveles_recursos')->insert(
                [
                    'nivel_id' => $item->nivel_id,
                    'recurso_id' => $item->recurso_id,
                    'coste' => $item->coste,
                    'consumo' => $item->consumo,
                    'produccion' => $item->produccion
                ]
            );

        }

    }
}
