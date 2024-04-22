<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRprtestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rprtests', function (Blueprint $table) {
          $table->id();
          $table->integer('clinic code');
          $table->biginteger('pid');
          $table->date('visit_date')->nullable();
          $table->string('fuchiacode')->nullable();
          $table->string('agey')->nullable();
          $table->string('agem')->nullable();
          $table->string('Gender')->nullable();
          $table->string('RPR Qualitative')->nullable();
          $table->string('Type Of Patient')->nullable();
          $table->string('Patient Type Sub')->nullable();
          $table->string('RDT(Yes/No)')->nullable();
          $table->string('RDT Result')->nullable();
          $table->string('Quantitative(Yes/No)')->nullable();
          $table->string('Qualitative(Yes/No)')->nullable();
          $table->string('Titre(current)')->nullable();
          $table->string('Titre(Last)')->nullable();
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
        Schema::dropIfExists('rprtests');
    }
}
