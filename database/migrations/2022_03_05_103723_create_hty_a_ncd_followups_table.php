<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHtyANcdFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hty_a_ncd_followups', function (Blueprint $table) {
          
          $table->tinyText('pid')->nullable();
          $table->tinyText('pt_fuchiaid')->nullable();
          $table->tinyText('Visit_date')->nullable();
          $table->tinyText('visit_type')->nullable();
          $table->tinyText('visitdt')->nullable();
          $table->tinyText('fu_fuchiaid')->nullable();
          $table->tinyText('NCD_Diagnosis')->nullable();
          $table->tinyText('weight')->nullable();
          $table->tinyText('height')->nullable();
          $table->tinyText('bmi')->nullable();
          $table->tinyText('curage')->nullable();
          $table->tinyText('stage_of_hypertension')->nullable();
          $table->tinyText('rbs_result')->nullable();
          $table->tinyText('fbs_result')->nullable();
          $table->tinyText('HBA1C')->nullable();
          $table->tinyText('HbA1C_Unit')->nullable();
          $table->tinyText('fsystBP')->nullable();
          $table->tinyText('fdiasBP')->nullable();
          $table->tinyText('urinalysis')->nullable();
          $table->tinyText('creatinine')->nullable();
          $table->tinyText('Serum_creatinine_unit')->nullable();
          $table->tinyText('invistigations')->nullable();
          $table->tinyText('rbs_next_appt')->nullable();
          $table->tinyText('crcl')->nullable();
          $table->tinyText('fbs_next_appt')->nullable();
          $table->tinyText('hba1c_next_appt')->nullable();
          $table->tinyText('urine_acr')->nullable();
          $table->tinyText('bp_next_appt')->nullable();
          $table->tinyText('total_cholesterol')->nullable();
          $table->tinyText('Total_Cholesterol_Unit')->nullable();
          $table->tinyText('uri_next_appt')->nullable();
          $table->tinyText('triglyceride')->nullable();
          $table->tinyText('Triglyceride_unit')->nullable();
          $table->tinyText('hdl')->nullable();
          $table->tinyText('HDL_unit')->nullable();
          $table->tinyText('ldl')->nullable();
          $table->tinyText('LDL unit')->nullable();
          $table->tinyText('CVD risk')->nullable();
          $table->tinyText('Statin_Y/N')->nullable();
          $table->tinyText('alt')->nullable();
          $table->tinyText('Urine_done/not_done')->nullable();
          $table->tinyText('protein_res')->nullable();
          $table->tinyText('glucose_res')->nullable();
          $table->tinyText('urine_oth')->nullable();
          $table->tinyText('oth_inv1')->nullable();
          $table->tinyText('oth_inv1_res')->nullable();
          $table->tinyText('oth_inv2')->nullable();
          $table->tinyText('oth_inv2_res')->nullable();
          $table->tinyText('oth_inv3')->nullable();
          $table->tinyText('oth_inv3_res')->nullable();
          $table->tinyText('oth_inv4')->nullable();
          $table->tinyText('oth_inv4_res')->nullable();
          $table->tinyText('oth_inv5')->nullable();
          $table->tinyText('oth_inv5_res')->nullable();
          $table->tinyText('oth_inv6')->nullable();
          $table->tinyText('oth_inv6_res')->nullable();
          $table->tinyText('Lifestyle_advice')->nullable();
          $table->tinyText('Medication_changed')->nullable();
          $table->tinyText('Patient_adherence_to_medication')->nullable();
          $table->tinyText('Amlodipine_dose')->nullable();
          $table->tinyText('Amlodipine_frequency')->nullable();
          $table->tinyText('famlodipine_dur')->nullable();
          $table->tinyText('Enalapril_dose')->nullable();
          $table->tinyText('Enalapril_frequency')->nullable();
          $table->tinyText('fenalapril_dur')->nullable();
          $table->tinyText('Atorvastain_dose')->nullable();
          $table->tinyText('Atorvastain_frequency')->nullable();
          $table->tinyText('fatorvastain_dur')->nullable();
          $table->tinyText('Hydrochlorothiazide dose')->nullable();
          $table->tinyText('Hydrochlorothiazide frequency')->nullable();
          $table->tinyText('fhydrochlorothiazide_dur')->nullable();
          $table->tinyText('Aspirin_dose')->nullable();
          $table->tinyText('Aspirin_frequency')->nullable();
          $table->tinyText('faspirin_dur')->nullable();
          $table->tinyText('Metformin_500_dose')->nullable();
          $table->tinyText('Metformin_500_frequency')->nullable();
          $table->tinyText('fmetformin500_dur')->nullable();
          $table->tinyText('Metformin_1000_dose')->nullable();
          $table->tinyText('Metformin_1000_frequency')->nullable();
          $table->tinyText('fmetformin1000_dur')->nullable();
          $table->tinyText('Gliclazide_500_dose')->nullable();
          $table->tinyText('Gliclazide_500_frequency')->nullable();
          $table->tinyText('fgliclazide500_dur')->nullable();
          $table->tinyText('Gliclazide_1000_dose')->nullable();
          $table->tinyText('Gliclazide_1000_frequency')->nullable();
          $table->tinyText('fgliclazide1000_dur')->nullable();
          $table->tinyText('Symptom_hypoglycemia')->nullable();
          $table->tinyText('oth_complains')->nullable();
          $table->tinyText('Followup_Other_Medication')->nullable();
          $table->tinyText('foth_med_spec')->nullable();
          $table->tinyText('Referral_to_secondary_care')->nullable();
          $table->tinyText('ref_res')->nullable();
          $table->tinyText('Hypertension_control')->nullable();
          $table->tinyText('Diabetes_control')->nullable();
          $table->tinyText('Next_appointment_date')->nullable();
          $table->tinyText('Doctor_Name')->nullable();

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
        Schema::dropIfExists('hty_a_ncd_followups');
    }
}
