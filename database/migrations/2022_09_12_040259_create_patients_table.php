<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
          $table->id();
          $table->String("Clinic Code")->nullable();
          $table->biginteger('Pid');
          $table->String("FuchiaID")->nullable();
          $table->integer("Agey")->nullable();
          $table->integer("Agem")->nullable();
          $table->String("Gender")->nullable();
          $table->date("Reg Date")->nullable();
          $table->date("Date of Birth")->nullable();
          $table->String("Region")->nullable();
          $table->String("Township")->nullable();
          $table->String("Quarter")->nullable();
          $table->String("Patient Type")->nullable();
          $table->String("Patient Type Sub")->nullable();
          $table->String("Patient Type Sub1")->nullable();
          $table->String("Main Risk")->nullable();
          $table->String("Sub Risk")->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
