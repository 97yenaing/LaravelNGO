<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return[
              'ClinicName'=>"HTY-A",
              'CID'=>rand(111111111,999999999),
              'agey'=>rand(30,70),
              'Gender'=>"Female",
              'fuchiacode'=>rand(111111111,999999999),
              'Patient_Type'=>"FSW"
        ];
    }
}
