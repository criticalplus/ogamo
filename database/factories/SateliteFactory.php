<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Satelite;

class SateliteFactory extends Factory{

    protected $model = Satelite::class;

    public function definition(){


        return [
            'nombre' => $this->faker->firstName(),
            'magnitud' => $this->faker->randomElement( ['meteroide','asteroide','enano','mediano','gigante'] ),
        ];
    }



}