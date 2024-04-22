<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'ClinicName'=>"HTY-A",
          'Name'=>$this->faker->name(),
          'Age'=>rand(30,99),
          'Sex'=>$this->faker->sentence(),
          'Pid'=>rand(1,999999),
          'FuchiaID'=>rand(1,999999),
          'Region'=>$this->faker->sentence(),
          'Township'=>$this->faker->sentence()
        ];
    }
}
