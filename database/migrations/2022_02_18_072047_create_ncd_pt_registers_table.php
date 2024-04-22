<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNcdPtRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncd_pt_registers', function (Blueprint $table) {
          $table->tinyText('pid');
          $table->tinyText('Fuchsia_ID')->nullable();

          $table->tinyText('Age')->nullable();
          $table->tinyText('Agey')->nullable();
          $table->tinyText('Reg_Date')->nullable();
          $table->string('Area_Division')->nullable();
          $table->string('Township')->nullable();
          $table->tinyText('Height')->nullable();
          $table->tinyText('Weight')->nullable();
          $table->tinyText('Gender')->nullable();

          $table->tinyText('1stBP_Up')->nullable();
          $table->tinyText('1stBP_Low')->nullable();
          $table->tinyText('1stBP_date')->nullable();
          $table->tinyText('2ndBP_Up')->nullable();
          $table->tinyText('2ndBP_Low')->nullable();
          $table->tinyText('2ndBP_date')->nullable();
          $table->tinyText('3rdBP_Up')->nullable();
          $table->tinyText('3rdBP_Low')->nullable();
          $table->tinyText('3rdBP_date')->nullable();

          $table->tinyText('Hypertension')->nullable();
          $table->tinyText('Hyper_Di_date')->nullable();
          $table->tinyText('Diabetes')->nullable();
          $table->tinyText('Dia_Dig_date')->nullable();
          $table->string('Stage_of_Hyper')->nullable();

          $table->tinyText('1st_RBS')->nullable();
          $table->tinyText('1st_RBS_date')->nullable();
          $table->tinyText('2nd_RBS')->nullable();
          $table->tinyText('2nd_RBS_date')->nullable();

          $table->tinyText('Clinical_Symptoms')->nullable();
          $table->string('Clinical_Symptoms_Text')->nullable();
          $table->tinyText('Smoking_Status')->nullable();

          $table->tinyText('Amlodipine_dose')->nullable();
          $table->tinyText('Amlodipine_Freq')->nullable();
          $table->tinyText('Amlodipine_due')->nullable();

          $table->tinyText('Enalapril_dose')->nullable();
          $table->tinyText('Enalapril_Freq')->nullable();
          $table->tinyText('Enalapril_due')->nullable();

          $table->tinyText('Atorvastain_dose')->nullable();
          $table->tinyText('Atorvastain_Freq')->nullable();
          $table->tinyText('Atorvastain_due')->nullable();

          $table->tinyText('Hydrochlorothiazide_dose')->nullable();
          $table->tinyText('Hydrochlorothiazide_Freq')->nullable();
          $table->tinyText('Hydrochlorothiazide_due')->nullable();

          $table->tinyText('Aspirin_dose')->nullable();
          $table->tinyText('Aspirin_Freq')->nullable();
          $table->tinyText('Aspirin_due')->nullable();

          $table->tinyText('Metformin_dose')->nullable();
          $table->tinyText('Metformin_Freq')->nullable();
          $table->tinyText('Metformin_due')->nullable();

          $table->tinyText('Gliclazide_dose')->nullable();
          $table->tinyText('Gliclazide_Freq')->nullable();
          $table->tinyText('Gliclazide_due')->nullable();

          $table->tinyText('Other_NCD_medication')->nullable();
          $table->string('oth_ncd_med_spec')->nullable();
          $table->TinyText('cur_med1')->nullable();
          $table->TinyText('cur_med1_dose')->nullable();
          $table->TinyText('cur_med1_freq')->nullable();
          $table->TinyText('cur_med1_due')->nullable();

          $table->TinyText('cur_med2')->nullable();
          $table->TinyText('cur_med2_dose')->nullable();
          $table->TinyText('cur_med2_freq')->nullable();
          $table->TinyText('cur_med2_due')->nullable();

          $table->TinyText('cur_med3')->nullable();
          $table->TinyText('cur_med3_dose')->nullable();
          $table->TinyText('cur_med3_freq')->nullable();
          $table->TinyText('cur_med3_due')->nullable();

          $table->TinyText('cur_med4')->nullable();
          $table->TinyText('cur_med4_dose')->nullable();
          $table->TinyText('cur_med4_freq')->nullable();
          $table->TinyText('cur_med4_due')->nullable();

          $table->TinyText('cur_med5')->nullable();
          $table->TinyText('cur_med5_dose')->nullable();
          $table->TinyText('cur_med5_freq')->nullable();
          $table->TinyText('cur_med5_due')->nullable();

          $table->TinyText('cur_med6')->nullable();
          $table->TinyText('cur_med6_dose')->nullable();
          $table->TinyText('cur_med6_freq')->nullable();
          $table->TinyText('cur_med6_due')->nullable();

          $table->tinyText('Dia_foot')->nullable();
          $table->tinyText('Neuropathy')->nullable();
          $table->tinyText('Atril_Fib')->nullable();
          $table->tinyText('Hyperlipidemia')->nullable();
          $table->tinyText('CKD')->nullable();
          $table->tinyText('Change_in_Vision')->nullable();
          $table->tinyText('Gestational_Diabetes')->nullable();
          $table->tinyText('CVD')->nullable();
          $table->tinyText('Chronic_Lung_Disease')->nullable();
          $table->tinyText('Recur_infection')->nullable();
          $table->string('Recur_infection_text')->nullable();
          $table->tinyText('Family_Hyper')->nullable();
          $table->tinyText('Family_Diabetes')->nullable();


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
        Schema::dropIfExists('ncd_pt_registers');
    }
}
