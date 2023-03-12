<?php
namespace Database\Seeders;

use App\Models\Edificio;
use App\Models\Nivel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EdificioSeeder extends Seeder{
    
    public function run(){

        $json = File::get(base_path() .'/database/seeders/json/edificios.json');
        $data = json_decode($json);

        foreach ($data as $item){
            Edificio::create(array(
                    'name' => $item->name,
                    'photo_path' => $item->photo_path,
                    'categoria' => $item->categoria
            ));

        }

        $json = File::get(base_path() .'/database/seeders/json/niveles.json');
        $data = json_decode($json);

        foreach ($data as $item){
            Nivel::create(array(
                    'edificio_id' => $item->edificio_id,
                    'nivel' => $item->nivel,
                    'tiempo' => $item->tiempo
            ));

        }
    }
}
