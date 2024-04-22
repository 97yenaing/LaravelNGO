<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabGeneralTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_general_tests', function (Blueprint $table) {
          $table->id();
          $table->integer('clinic code')->nullable();
          $table->biginteger("CID")->nullable();
          $table->String("fuchiacode")->nullable();
          $table->integer("agey")->nullable();
          $table->integer("agem")->nullable();
          $table->String("Gender")->nullable();
          $table->String("Requested Doctor old")->nullable();
          $table->String("Requested Doctor new")->nullable();
          $table->date("Visit_date")->nullable();
          //$table->date("tdate")->nullable();
          $table->String("Patient_Type")->nullable();
          $table->String("Patient Type Sub")->nullable();
          $table->String('Dangue RDT')->nullable();
          $table->String('NS1 Antigen')->nullable();
          $table->String('IgG Result')->nullable();
          $table->String('IgM Result')->nullable();
          $table->String('Malaria RDT Result')->nullable();
          $table->String('malaria_microscopy')->nullable();
          $table->String('Malaria Microscopy Result')->nullable();
          $table->integer('RBS')->nullable();
          $table->integer('FBS')->nullable();
          $table->String('haemoglobin')->nullable();
          $table->String('hba1c')->nullable();
          $table->String("Lab Tech")->nullable();
          $table->date("Issue Date")->nullable();
          $table->integer("Visit ID")->nullable();
          $table->timestamps();
          $table->String("Malaria_spec")->nullable();
          $table->String("Malaria_grade")->nullable();
          $table->String("Malaria_stage")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_general_tests');
    }
}
