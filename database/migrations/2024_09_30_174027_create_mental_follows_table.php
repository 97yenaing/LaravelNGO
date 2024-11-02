<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentalFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mental_follows', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Pid');
            $table->date('Visit_date');
            $table->string('Improve_symp', 100)->nullable();
            $table->string('Adh_problem', 100)->nullable();
            $table->string('Mental_asses_rescreen', 100)->nullable();
            $table->text('No_asses_describe')->nullable();
            $table->string('Drug_reassesment', 100)->nullable();
            $table->string('Assist_score_screen', 100)->nullable();
            $table->string('Scroe_1', 100)->nullable();
            $table->string('Scroe_1_risk', 100)->nullable();
            $table->string('Scroe_2', 100)->nullable();
            $table->string('Scroe_2_risk', 100)->nullable();
            $table->string('Scroe_3', 100)->nullable();
            $table->string('Scroe_3_risk', 100)->nullable();
            $table->string('Scroe_4', 100)->nullable();
            $table->string('Scroe_4_risk', 100)->nullable();
            $table->string('Scroe_5', 100)->nullable();
            $table->string('Scroe_5_risk', 100)->nullable();
            $table->text('Brief')->nullable();
            $table->text('Brief_plan')->nullable();
            $table->text('Brief_plan_detail')->nullable();
            $table->text('Brief_plan_changeDetail')->nullable();
            $table->string('Brief_stage', 100)->nullable();
            $table->string('Sucidal_risk_between_lastVist', 100)->nullable();
            $table->string('Phamological_effect', 100)->nullable();
            $table->string('Extrapyramidal_effect', 100)->nullable();
            $table->text('Other_effect')->nullable();
            $table->text('Management_effect')->nullable();
            $table->string('Artane', 100)->nullable();
            $table->text('Other_management')->nullable();
            $table->integer('Continue_same_traeat')->nullable();
            $table->text('Continue_same_traeat_describe')->nullable();
            $table->integer('Increase_dosage')->nullable();
            $table->text('Increase_dosage_describe')->nullable();
            $table->integer('Reduce_dosage')->nullable();
            $table->text('Reduce_dosage_describe')->nullable();
            $table->integer('Tapering_drug')->nullable();
            $table->text('Tapering_drug_describe')->nullable();
            $table->integer('Restart_drug')->nullable();
            $table->text('Restart_drug_describe')->nullable();
            $table->integer('Refer_psychiatrist')->nullable();
            $table->integer('Stop_drug')->nullable();
            $table->string('Psy_interview_mam', 100)->nullable();
            $table->string('Other_refer_psychiatrist', 100)->nullable();
            $table->string('MD_initial', 100)->nullable(); // Use string for fixed-length text
            $table->string('CSL_initial', 100)->nullable();
            $table->date('Next_meetdate')->nullable();
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
        Schema::dropIfExists('mental_follows');
    }
}
