<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabStoolTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_stool_tests', function (Blueprint $table) {
          $table->id();
          $table->integer(      'Clinic Code'                  )->nullable();
          $table->biginteger(      'CID'                  )->nullable();
          $table->String(      'fuchiacode'           )->nullable();
          $table->integer(      'agey'                 )->nullable();
          $table->integer(      'agem'                 )->nullable();
          $table->String(      'Gender'               )->nullable();
          $table->String(      'Requested Doctor'     )->nullable();
          $table->String(      'visit_date'           )->nullable();
          $table->String(      'Patient Type'         )->nullable();
          $table->String(      'Patient Type Sub'     )->nullable();
          $table->integer(      'Clinic'               )->nullable();
          $table->String(      'st_stool'             )->nullable();
          $table->String(      'st_colour'            )->nullable();
          $table->String(      'wbc_pus_cell'         )->nullable();
          $table->String(      'st_consistency'       )->nullable();
          $table->String(      'st_rbcs'              )->nullable();
          $table->String(      'st_other'             )->nullable();
          $table->String(      'st_comment'           )->nullable();
          $table->String(      'st_lab_tech'          )->nullable();
          $table->String(      'st_issue_date'        )->nullable();
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
        Schema::dropIfExists('lab_stool_tests');
    }
}
