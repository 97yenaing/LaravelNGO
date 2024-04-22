<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStimalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stimales', function (Blueprint $table){
          $table->id();
          $table->tinyText('gender',6);
          $table->tinyInteger('clinic')->nullable();
          $table->bigInteger('CID')->nullable();
          $table->tinyInteger('tbl_demog_first_visit')->nullable();
          $table->tinyInteger('Expr1')->nullable();
          $table->tinyInteger('last_vis_within')->nullable();
          $table->mediumInteger('age')->nullable();
          $table->tinyInteger('about_clinic')->nullable();
          $table->tinyInteger('demo_remarks')->nullable();
          $table->date('Visit date')->nullable();
          $table->tinyText('visit_type',9)->nullable();
          $table->tinyText('visit_time',3)->nullable();
          $table->tinyInteger('followup_visit')->nullable();
          $table->tinyInteger('episode')->nullable();
          $table->tinyText('Reason for Visit',15)->nullable();
          $table->tinyText('risk_factor',15)->nullable();
          $table->tinyInteger('urethral_disc')->nullable();
          $table->tinyInteger('urethral_disc_hl')->nullable();
          $table->tinyInteger('dysuria')->nullable();
          $table->tinyInteger('dysuria_hl')->nullable();
          $table->tinyInteger('genital_prut')->nullable();
          $table->tinyInteger('genital_prut_hl')->nullable();
          $table->tinyInteger('genital_pain')->nullable();
          $table->tinyInteger('genital_pain_hl')->nullable();
          $table->tinyInteger('genital_ulcer')->nullable();
          $table->tinyInteger('genital_ulcer_hl')->nullable();
          $table->tinyInteger('pain')->nullable();
          $table->tinyInteger('ulcer')->nullable();
          $table->tinyInteger('prodromal_itch')->nullable();
          $table->tinyInteger('vesicles')->nullable();
          $table->tinyInteger('recurrent')->nullable();
          $table->tinyInteger('last_episode')->nullable();
          $table->tinyInteger('suspects_herpes')->nullable();
          $table->tinyInteger('ing_lymph_node')->nullable();
          $table->tinyInteger('ing_lymph_node_hl')->nullable();
          $table->tinyInteger('unilateal')->nullable();
          $table->tinyInteger('leg_ulcer')->nullable();
          $table->tinyInteger('scrotal_swelling')->nullable();
          $table->tinyInteger('scrotal_swelling_hl')->nullable();
          $table->tinyInteger('td_ntd')->nullable();
          $table->tinyInteger('gen_wart')->nullable();
          $table->tinyInteger('gen_wart_hl')->nullable();
          $table->tinyInteger('physical_exam')->nullable();
          $table->tinyInteger('urinated_wit_1h')->nullable();
          $table->tinyInteger('discharge')->nullable();
          $table->tinyInteger('discharge_milk')->nullable();
          $table->tinyInteger('colour')->nullable();
          $table->tinyInteger('erythema')->nullable();
          $table->tinyInteger('blisters')->nullable();
          $table->tinyInteger('gen_ulcer')->nullable();
          $table->tinyInteger('esti_size')->nullable();
          $table->tinyInteger('sing_multi')->nullable();
          $table->tinyInteger('pain_full_less')->nullable();
          $table->tinyInteger('herpes_suspect')->nullable();
          $table->tinyInteger('inguinal_bubo')->nullable();
          $table->tinyInteger('fluctant')->nullable();
          $table->tinyInteger('tendr_ntender')->nullable();
          $table->tinyInteger('oth_leg_inf')->nullable();
          $table->tinyInteger('phy_genital_wart')->nullable();
          $table->tinyInteger('crab_lice')->nullable();
          $table->tinyInteger('scabies')->nullable();
          $table->tinyInteger('gscrotal_swelling')->nullable();
          $table->tinyInteger('estimated_siz')->nullable();
          $table->tinyInteger('unilateal_bilateral')->nullable();
          $table->tinyInteger('gtender_ntender')->nullable();
          $table->tinyInteger('erythem')->nullable();
          $table->tinyInteger('des_size')->nullable();
          $table->tinyInteger('tbl_treat_diagnosis_first_visit')->nullable();
          $table->tinyInteger('epi_discharge')->nullable();
          $table->tinyInteger('unprot_sex_new_part')->nullable();
          $table->tinyInteger('genital_signs')->nullable();
          $table->tinyText('presumptive_diag',10)->nullable();
          $table->tinyInteger('pri_syphillis')->nullable();
          $table->tinyInteger('sec_syphillis')->nullable();
          $table->tinyInteger('chancroid')->nullable();
          $table->tinyInteger('gen_herpes')->nullable();
          $table->tinyInteger('gen_scabies')->nullable();
          $table->tinyInteger('gud_other')->nullable();
          $table->tinyInteger('other(please specify)')->nullable();
          $table->tinyInteger('Gonorhoea')->nullable();
          $table->tinyInteger('non_gono_urethritis')->nullable();
          $table->tinyInteger('non_gono_cervities')->nullable();
          $table->tinyInteger('trichomonas')->nullable();
          $table->tinyInteger('genital_candidiosis')->nullable();
          $table->tinyInteger('beterial_vaginosis')->nullable();
          $table->tinyInteger('congenial_syphillis')->nullable();
          $table->tinyInteger('latent_syphillis')->nullable();
          $table->tinyInteger('molluscum_contag')->nullable();
          $table->tinyInteger('bubos')->nullable();
          $table->tinyInteger('othstd_genital_warts')->nullable();
          $table->tinyInteger('ostd_other')->nullable();
          $table->tinyInteger('tre_azythro')->nullable();
          $table->tinyInteger('tre_cefixim')->nullable();
          $table->tinyInteger('tre_ciprofloxacin')->nullable();
          $table->tinyInteger('tre_tinidazole')->nullable();
          $table->tinyInteger('tre_fluconazole')->nullable();
          $table->tinyInteger('tre_doxycycline')->nullable();
          $table->tinyInteger('tre_ceftriaxone')->nullable();
          $table->tinyInteger('tre_benz_pen')->nullable();
          $table->tinyInteger('no_treat')->nullable();
          $table->tinyInteger('al_Penicillin')->nullable();
          $table->tinyInteger('al_sulfa')->nullable();
          $table->tinyInteger('part_treat')->nullable();
          $table->tinyInteger('condom_giv')->nullable();
          $table->tinyText('tre_remarks',15)->nullable();
          $table->tinyText('followup',150)->nullable();
          $table->tinyText('clinician_name',15)->nullable();
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
        Schema::dropIfExists('stimales');
    }
}
