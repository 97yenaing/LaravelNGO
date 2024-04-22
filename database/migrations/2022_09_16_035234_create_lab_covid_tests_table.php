<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabCovidTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_covid_tests', function (Blueprint $table) {
          $table->biginteger(      'CID'                 )->nullable();
          $table->String(      'fuchiacode'           )->nullable();
          $table->integer(      'agey'                )->nullable();
          $table->integer(      'agem'                )->nullable();
          $table->String(      'Gender'               )->nullable();
          $table->String(      'Requested Doctor'     )->nullable();
          $table->String(      'visit_date'           )->nullable();
          $table->String(      'Patient Type'         )->nullable();
          $table->String(      'Patient Type Sub'     )->nullable();
          $table->integer(      'Clinic'              )->nullable();
          $table->integer(      'co_Age'              )->nullable();
          $table->String(      'type_of_patient_covid')->nullable();
          $table->String(      'specimen_type'        )->nullable();
          $table->String(      'co_test_type'         )->nullable();
          $table->String(      'covid_result'         )->nullable();
          $table->String(      'covid_lab_tech'       )->nullable();
          $table->String(      'covid_issue_date'     )->nullable();
          $table->id();
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
        Schema::dropIfExists('lab_covid_tests');
    }
}
