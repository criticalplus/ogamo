<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Universo;

class UniversoFactory extends Factory{

    protected $model = Universo::class;

    public function definition(){

        return [
            'name' => $this->faker->firstName(),
            'photo_path' => $this->faker->image(),
        ];
    }



}