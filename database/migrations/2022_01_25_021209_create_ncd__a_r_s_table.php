<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNcdARSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncd__a_r_s', function (Blueprint $table) {
          $table->String('pid')->nullable();
          $table->tinyText('Visit_date')->nullable();
          $table->tinyText('NCD_diagnosis')->nullable();
          $table->tinyText('ar_num')->nullable();
          $table->tinyText('ar_date')->nullable();
          $table->tinyText('ar_bmi')->nullable();
          $table->tinyText('ar_systBP')->nullable();
          $table->tinyText('Annual_Check_Pulse_for_AF')->nullable();
          $table->tinyText('ar_fbs')->nullable();
          $table->tinyText('ar_hba1c')->nullable();
          $table->tinyText('Urine_Protein')->nullable();
          $table->tinyText('Urine_glucose')->nullable();
          $table->tinyText('ar_creatinine')->nullable();
          $table->tinyText('ar_CrCl')->nullable();
          $table->tinyText('ar_urine_acr')->nullable();
          $table->tinyText('ar_total_chol')->nullable();
          $table->tinyText('ar_HDL')->nullable();
          $table->tinyText('ar_LDL')->nullable();
          $table->tinyText('ar_Triglyceride')->nullable();
          $table->tinyText('ar_ALT')->nullable();
          $table->tinyText('ar_CVD_risk_score')->nullable();
          $table->tinyText('ar_Dia_foot_check')->nullable();
          $table->tinyText('ar_Refer_retinopathy_2_yearly')->nullable();
          $table->tinyText('ar_dietary_advice')->nullable();
          $table->tinyText('ar_Advice_physical_activity')->nullable();
          $table->tinyText('ar_discuss_smoking')->nullable();
          $table->tinyText('ar_doc')->nullable();
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
        Schema::dropIfExists('ncd__a_r_s');
    }
}
