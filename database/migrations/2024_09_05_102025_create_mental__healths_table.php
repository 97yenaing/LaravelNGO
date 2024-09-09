<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentalHealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mental__healths', function (Blueprint $table) {
            $table->id();
            $table->biginteger('Pid');
            $table->date("Counselling_Date");
            $table->integer("Q1_Q2")->nullable();
            $table->integer("Q3_Q4")->nullable();
            $table->integer("gad7_amount")->nullable();
            $table->integer("PHQ9_amount")->nullable();
            $table->string("Drug3M", 100)->nullable();
            $table->string("SexDrug", 100)->nullable();
            $table->string("ChemSex", 100)->nullable();
            $table->integer("A",)->nullable();
            $table->integer("B",)->nullable();
            $table->integer("C",)->nullable();
            $table->integer("D",)->nullable();
            $table->text("Remark")->nullable();
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
        Schema::dropIfExists('mental__healths');
    }
}
