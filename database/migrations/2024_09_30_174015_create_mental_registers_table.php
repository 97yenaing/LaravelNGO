<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentalRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mental_registers', function (Blueprint $table) {
            $table->id()->index(); // Auto-incrementing primary key
            $table->bigInteger('Pid')->unique(); // No length for bigInteger
            $table->string('Hiv_status', 100)->nullable();
            $table->string('If_pwud', 100)->nullable();
            $table->text('If_pwudEx')->nullable();
            $table->string('Alcohol_drinking', 100)->nullable();
            $table->date('Reg_date');
            $table->string('Psychosis', 100)->nullable();
            $table->string('Symptoms', 100)->nullable();
            $table->text('Psy_others')->nullable();
            $table->string('Duration', 100)->nullable();
            $table->string('Suicidal_risk', 100)->nullable();
            $table->text('Sucidal_yes')->nullable();
            $table->string('Drug_uses3month', 100)->nullable();
            $table->string('Drug_willingness', 100)->nullable();
            $table->string('Sexual_drug', 100)->nullable();
            $table->string('SexualDrug_willigness', 100)->nullable();
            $table->string('Injectable', 100)->nullable();
            $table->text('Injectable_yes')->nullable();
            $table->string('ASSIST_score', 100)->nullable();
            $table->text('Drug_name_1')->nullable();
            $table->string('Drug_name_1_risk', 100)->nullable();
            $table->text('Drug_name_2')->nullable();
            $table->string('Drug_name_2_risk', 100)->nullable();
            $table->text('Drug_name_3')->nullable();
            $table->string('Drug_name_3_risk', 100)->nullable();
            $table->text('Drug_name_4')->nullable();
            $table->string('Drug_name_4_risk', 100)->nullable();
            $table->text('Brief')->nullable();
            $table->text('Brief_plan')->nullable();
            $table->text('Brief_plan_detail')->nullable();
            $table->string('Brief_stage', 100)->nullable();
            $table->string('Brief_no', 100)->nullable();
            $table->integer('Psychosocial_mam')->nullable(); // No length for integer
            $table->integer('Pharmacologica_mam')->nullable();
            $table->text('Fluoxetine')->nullable();
            $table->text('Haloparidol')->nullable();
            $table->text('Tre_other')->nullable();
            $table->integer('Refer_psychiatrist')->nullable();
            $table->integer('Mental_hospital')->nullable();
            $table->integer('General_hospital')->nullable();
            $table->integer('Private_psychiatrist')->nullable();
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
        Schema::dropIfExists('mental_registers');
    }
}
