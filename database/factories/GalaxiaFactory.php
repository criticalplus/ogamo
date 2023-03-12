<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Galaxia;

class GalaxiaFactory extends Factory{

    protected $model = Galaxia::class;

    public function definition(){






        return [
            'posY' => $this->faker->numberBetween(-25, 25),
            'posZ' => $this->faker->numberBetween(-25, 25),
            'tipo' => $this->faker->randomElement( ['espiral','lenticular','eliptica','irregular'] ),
        ];
    }



}