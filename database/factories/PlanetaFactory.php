<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Planeta;

class PlanetaFactory extends Factory{

    protected $model = Planeta::class;

    public function definition(){


        return [
            'nombre' => $this->faker->firstName(),
            'habitable' => $this->faker->boolean(),
            'atmosfera' => $this->faker->boolean(),
            'tipo' => $this->faker->randomElement( ['roca','gas'] ),
            'bioma' => $this->faker->randomElement( ['biodiverso','alien','hielo','desierto','oceano','lava'] ),
            'magnitud' => $this->faker->randomElement( ['meteroide','asteroide','enano','mediano','gigante'] ),
        ];
    }



}