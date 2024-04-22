<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lab;
use App\Models\Patients;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Patients::factory()->count(500)->create();


    }
}
