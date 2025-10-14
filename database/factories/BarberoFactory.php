<?php

namespace Database\Factories;

use App\Models\Barbero;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barbero>
 */ 
    class BarberoFactory extends Factory
    {
        protected $model = Barbero::class;

        public function definition()
        {
            return [
                'nombre' => $this->faker->firstName(),
                'apellido' => $this->faker->lastName(),
                'especialidad' =>'degrade',
                'email' => $this->faker->unique()->safeEmail(),
            ];
        }
    }

