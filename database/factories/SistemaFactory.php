<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sistema;

class SistemaFactory extends Factory{

    protected $model = Sistema::class;

    public function definition(){


        return [
            'posY' => $this->faker->numberBetween(-25, 25),
            'posZ' => $this->faker->numberBetween(-25, 25),
/*             'posY' => $this->faker->numberBetween(-128, 127),
            'posZ' => $this->faker->numberBetween(-128, 127), */
            //'num_planetas' => $this->faker->numberBetween(0, 6),
            'num_estrellas' => $this->faker->randomElement( ['1','1','1','1','1','2','2','3'] ),
            'tipo_estrellas' => $this->faker->randomElement( ['O','B','A','F','G','K','M'] ),
        ];
    }



}