<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrepScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prep_screens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Pid')->unique(); // No length for bigInteger
            $table->date('Inital_date')->nullable();
            $table->string('DHIS2_id', 100)->nullable();

            $table->string('Sex_other', 100)->nullable();
            $table->string('Birth_state', 100)->nullable();
            $table->string('Birth_township', 100)->nullable();
            $table->string('Facility_name', 100)->nullable();
            $table->string('Virtual_KPSC', 100)->nullable();
            $table->string('Nav_code', 100)->nullable();
            $table->string('Consider_sex', 100)->nullable();
            $table->text('Consider_other_sex')->nullable();
            $table->string('Sex_with', 100)->nullable();
            $table->string('Sex_orgam_6month', 100)->nullable();
            $table->string('Drug_use_6month', 100)->nullable();
            $table->integer('Sex_one_noCon')->nullable();
            $table->integer('Sex_oneMore_HIV')->nullable();
            $table->integer('Sex_STI_transmit')->nullable();
            $table->integer('PEP_expose')->nullable();
            $table->integer('Inject_equi_share')->nullable();
            $table->integer('Sex_HIV_noTre')->nullable();
            $table->integer('Prep_req')->nullable();
            $table->string('Risk_case_72H', 100)->nullable();
            $table->string('Symptoms_28D', 100)->nullable();
            $table->text('Reason')->nullable();
            $table->string('HIV_neg', 100)->nullable();
            $table->date('Test_date', 100)->nullable();
            $table->date('Result_date', 100)->nullable();
            $table->string('Test_result', 100)->nullable();
            $table->date('Reative_date', 100)->nullable();
            $table->string('Confirm_result', 100)->nullable();
            $table->string('HIV_sub_risk', 100)->nullable();
            $table->string('HIV_sup_infection', 100)->nullable();
            $table->string('Prep_eligible', 100)->nullable();
            //ko myo min ss DB
            $table->string('die_effect', 10)->nullable();
            $table->string('oth_might_think', 10)->nullable();
            $table->string('time_req_followup', 10)->nullable();
            $table->string('safety_med', 10)->nullable();
            $table->string('effectiveness_med', 10)->nullable();
            $table->string('other', 10)->nullable();
            $table->text('other_specify')->nullable();
            $table->string('ref_pep', 10)->nullable();
            $table->string('ref_hiv_retest', 10)->nullable();
            $table->string('ref_hiv_treat', 10)->nullable();


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
        Schema::dropIfExists('prep_screens');
    }
}
