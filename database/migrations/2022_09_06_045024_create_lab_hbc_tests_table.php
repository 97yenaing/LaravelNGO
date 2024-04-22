<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabHbcTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_hbc_tests', function (Blueprint $table) {
            $table->id();
            $table->integer("clinic code")->nullable();
            $table->biginteger("CID")->nullable();
            $table->String("fuchiacode")->nullable();
            $table->integer("agey")->nullable();
            $table->integer("agem")->nullable();
            $table->String("Gender")->nullable();
            $table->date("Visit_date")->nullable();
            $table->String("Requested Doctor old")->nullable();
            $table->String("Requested Doctor new")->nullable();
            $table->date("tdate")->nullable();
            $table->String("Patient_Type")->nullable();
            $table->String("Patient Type Sub")->nullable();
            $table->String("Hiv status")->nullable();
            $table->String("HepB Test")->nullable();
            $table->String("HepB TOT")->nullable();
            $table->String("HepB Result")->nullable();
            $table->String("HepC Test")->nullable();
            $table->String("HepC TOT")->nullable();
            $table->String("HepC Result")->nullable();
            $table->String("Lab Tech")->nullable();
            $table->date("Issue Date")->nullable();
            $table->integer("Visit ID")->nullable();
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
        Schema::dropIfExists('lab_hbc_tests');
    }
}
