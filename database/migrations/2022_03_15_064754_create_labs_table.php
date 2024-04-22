<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->String("ClinicName")->nullable();
            $table->biginteger("CID")->nullable();
            $table->String("fuchiacode")->nullable();
            $table->integer("agey")->nullable();
            $table->integer("agem")->nullable();
            $table->String("Gender")->nullable();
            $table->String("Patient_Type")->nullable();
            $table->String("Patient Type Sub")->nullable();
            $table->String("Patient Type Sub1")->nullable();
            $table->date("Visit_date")->nullable();
            $table->date("bcollectdate")->nullable();
            $table->String("Detmine_Result")->nullable();
            $table->String("Unigold_Result")->nullable();
            $table->String("STAT_PAK_Result")->nullable();
            $table->String("Final_Result")->nullable();
            $table->String("Req_Doct_old")->nullable();
            $table->String("Req_Doct")->nullable();
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
        Schema::dropIfExists('labs');
    }
}
