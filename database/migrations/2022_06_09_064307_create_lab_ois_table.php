<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabOisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_ois', function (Blueprint $table) {
          $table->id();
          $table->integer('clinic code')->nullable();
          $table->biginteger('CID')->nullable();
          $table->String('fuchiacode',20)->nullable();
          $table->integer('agey')->nullable();
          $table->integer('agem')->nullable();
          $table->String('Gender',10)->nullable();
          $table->String('Requested Doctor',10)->nullable();
          $table->String('Requested Doctor_New',10)->nullable();
          $table->date('visit_date')->nullable();
          $table->String('TB_LAM_Report',10)->nullable();
          $table->String('Serum Result',10)->nullable();
          $table->String('serum_pos',10)->nullable();
          $table->String('CSF for Cryptococcal Antigen',20)->nullable();
          $table->String('csf_crypto_pos',20)->nullable();
          $table->String('csf_fungal',20)->nullable();
          $table->String('CSF Smear Giemsa Stain',20)->nullable();
          $table->String('CSF Smear India Ink',20)->nullable();
          $table->String('skin_fungal',20)->nullable();
          $table->String('Skin Smear Giemsa Stain',20)->nullable();
          $table->String('lymph India Ink',20)->nullable();// other Smear
          $table->String('Skin Smear India Ink',20)->nullable();
          $table->String('sample_type',20)->nullable();
          $table->String('lymph Giemsa Stain',20)->nullable();// other_gram
          $table->String('Lab Techanician',20)->nullable();
          $table->date('issued')->nullable();
          $table->integer('visitID')->nullable();
          $table->String('Toxo plasma',10)->nullable();
          $table->String('Toxo igG',10)->nullable();
          $table->String('Toxo igM',10)->nullable();
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
        Schema::dropIfExists('lab_ois');
    }
}
