<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stis', function (Blueprint $table) {
            $table->tinyText('clinic')->nullable();
            $table->biginteger('CID')->nullable();
            $table->tinyText('tbl_demog_first_visit')->nullable();
            $table->tinyText('Expr1')->nullable();
            $table->tinyText('last_vis_within')->nullable();
            $table->tinyText('age')->nullable();
            $table->tinyText('about_clinic')->nullable();
            $table->tinyText('demo_remarks')->nullable();
            $table->tinyText('Visit date')->nullable();
            $table->tinyText('visit_type')->nullable();
            $table->tinyText('visit_time')->nullable();
            $table->tinyText('followup_visit')->nullable();
            $table->tinyText('episode')->nullable();
            $table->tinyText('Reason for Visit')->nullable();
            $table->tinyText('risk_factor')->nullable();
            $table->tinyText('urethral_disc')->nullable();
            $table->tinyText('urethral_disc_hl')->nullable();
            $table->tinyText('dysuria	dysuria_hl')->nullable();
            $table->tinyText('genital_prut')->nullable();
            $table->tinyText('genital_prut_hl')->nullable();
            $table->tinyText('genital_pain')->nullable();
            $table->tinyText('genital_pain_hl')->nullable();
            $table->tinyText('genital_ulcer')->nullable();
            $table->tinyText('genital_ulcer_hl')->nullable();
            $table->tinyText('pain')->nullable();
            $table->tinyText('ulcer')->nullable();
            $table->tinyText('prodromal_itch')->nullable();
            $table->tinyText('vesicles')->nullable();
            $table->tinyText('recurrent')->nullable();
            $table->tinyText('last_episode')->nullable();
            $table->tinyText('suspects_herpes')->nullable();
            $table->tinyText('ing_lymph_node')->nullable();
            $table->tinyText('ing_lymph_node_hl')->nullable();
            $table->tinyText('unilateal')->nullable();
            $table->tinyText('leg_ulcer')->nullable();
            $table->tinyText('scrotal_swelling')->nullable();
            $table->tinyText('scrotal_swelling_hl')->nullable();
            $table->tinyText('td_ntd')->nullable();
            $table->tinyText('gen_wart')->nullable();
            $table->tinyText('gen_wart_hl')->nullable();
            $table->tinyText('physical_exam')->nullable();
            $table->tinyText('urinated_wit_1h')->nullable();
            $table->tinyText('discharge')->nullable();
            $table->tinyText('discharge_milk')->nullable();
            $table->tinyText('colour')->nullable();
            $table->tinyText('erythema')->nullable();
            $table->tinyText('blisters')->nullable();
            $table->tinyText('gen_ulcer')->nullable();
            $table->tinyText('esti_size')->nullable();
            $table->tinyText('sing_multi')->nullable();
            $table->tinyText('pain_full_less')->nullable();
            $table->tinyText('herpes_suspect')->nullable();
            $table->tinyText('inguinal_bubo')->nullable();
            $table->tinyText('fluctant')->nullable();
            $table->tinyText('tendr_ntender')->nullable();
            $table->tinyText('oth_leg_inf')->nullable();
            $table->tinyText('phy_genital_wart')->nullable();
            $table->tinyText('crab_lice')->nullable();
            $table->tinyText('scabies')->nullable();
            $table->tinyText('gscrotal_swelling')->nullable();
            $table->tinyText('estimated_siz')->nullable();
            $table->tinyText('unilateal_bilateral')->nullable();
            $table->tinyText('gtender_ntender')->nullable();
            $table->tinyText('erythem')->nullable();
            $table->tinyText('des_size')->nullable();
            $table->tinyText('tbl_treat_diagnosis')->nullable();
            $table->tinyText('first_visit')->nullable();
            $table->tinyText('epi_discharge')->nullable();
            $table->tinyText('unprot_sex_new_part')->nullable();
            $table->tinyText('genital_signs')->nullable();
            $table->tinyText('presumptive_diag')->nullable();
            $table->tinyText('pri_syphillis')->nullable();
            $table->tinyText('sec_syphillis')->nullable();
            $table->tinyText('chancroid')->nullable();
            $table->tinyText('gen_herpes')->nullable();
            $table->tinyText('gen_scabies')->nullable();
            $table->tinyText('gud_other')->nullable();
            $table->tinyText('other(please specify)')->nullable();
            $table->tinyText('Gonorhoea')->nullable();
            $table->tinyText('non_gono_urethritis')->nullable();
            $table->tinyText('non_gono_cervities')->nullable();
            $table->tinyText('trichomonas')->nullable();
            $table->tinyText('genital_candidiosis')->nullable();
            $table->tinyText('beterial_vaginosis')->nullable();
            $table->tinyText('congenial_syphillis')->nullable();
            $table->tinyText('latent_syphillis')->nullable();
            $table->tinyText('molluscum_contag')->nullable();
            $table->tinyText('bubos	othstd_genital_warts')->nullable();
            $table->tinyText('ostd_other')->nullable();
            $table->tinyText('tre_azythro')->nullable();
            $table->tinyText('tre_cefixim')->nullable();
            $table->tinyText('tre_ciprofloxacin')->nullable();
            $table->tinyText('tre_tinidazole')->nullable();
            $table->tinyText('tre_fluconazole')->nullable();
            $table->tinyText('tre_doxycycline')->nullable();
            $table->tinyText('tre_ceftriaxone')->nullable();
            $table->tinyText('tre_benz_pen')->nullable();
            $table->tinyText('no_treat')->nullable();
            $table->tinyText('al_Penicillin')->nullable();
            $table->tinyText('al_sulfa')->nullable();
            $table->tinyText('part_treat')->nullable();
            $table->tinyText('condom_giv')->nullable();
            $table->tinyText('tre_remarks')->nullable();
            $table->tinyText('followup')->nullable();
            $table->tinyText('clinician_name')->nullable();
            $table->tinyText('abVagdischarge')->nullable();
            $table->tinyText('hl_ab_va_dis')->nullable();
            $table->tinyText('Link_menstra')->nullable();
            $table->tinyText('Amount')->nullable();
            $table->tinyText('th_colour')->nullable();
            $table->tinyText('odour')->nullable();
            $table->tinyText('lower_abd_pain')->nullable();
            $table->tinyText('hl_abd_pain')->nullable();
            $table->tinyText('fever')->nullable();
            $table->tinyText('terminate_preg')->nullable();
            $table->tinyText('dyspareunia')->nullable();
            $table->tinyText('oth_gi_sym')->nullable();
            $table->tinyText('other_specify')->nullable();
            $table->tinyText('wash_inside')->nullable();
            $table->tinyText('vulvar_erythema')->nullable();
            $table->tinyText('vulvar_odema')->nullable();
            $table->tinyText('vag_dis')->nullable();
            $table->tinyText('vag_dis_amount')->nullable();
            $table->tinyText('homogeneous')->nullable();
            $table->tinyText('vag_dis_colour')->nullable();
            $table->tinyText('smell-koh')->nullable();
            $table->tinyText('phi_vag_wall')->nullable();
            $table->tinyText('phi_ad_tender')->nullable();
            $table->tinyText('phi_ad_enlarge')->nullable();
            $table->tinyText('phi_koh_smell')->nullable();
            $table->tinyText('phi_ph_vagina')->nullable();
            $table->tinyText('phi_drawing')->nullable();
            $table->tinyText('genital_blisters')->nullable();
            $table->tinyText('genital_location')->nullable();
            $table->tinyText('genital_ulc_location')->nullable();
            $table->tinyText('cal1')->nullable();
            $table->tinyText('cal2')->nullable();
            $table->tinyText('cal3')->nullable();
            $table->tinyText('cal4')->nullable();
            $table->tinyText('cal5')->nullable();
            $table->tinyText('cal6')->nullable();
            $table->tinyText('ariskRemark')->nullable();
            $table->tinyText('ab_yellow_discharge')->nullable();
            $table->tinyText('cal7')->nullable();
            $table->tinyText('cal8')->nullable();
            $table->tinyText('cal9')->nullable();
            $table->tinyText('cal10')->nullable();
            $table->tinyText('cal11')->nullable();
            $table->tinyText('latent_syp_pregancy')->nullable();
            $table->tinyText('clotrimazole')->nullable();
            $table->tinyText('no_treament')->nullable();
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
        Schema::dropIfExists('stis');
    }
}
