<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\Stimale;
use App\Models\Stifemale;
use App\Models\Rprtest;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
//Exports
use App\Exports\StimaleExport;
//Imports
use App\Imports\StiFemaleImport;
use App\Imports\StiMaleImport;
use App\Imports\RprlabresultsImport;


class StiController extends Controller
{
  public function sti_patients(){
    $sti_patients = Stimale::latest()->paginate(50);
    return view (
      'STI.sti-patients',['sti_patients' => $sti_patients
    ]);
  }
  //Sti report view
  public function stiReport_View(){
    return view('Reports.STI_Report');
  }

  // for view
  public function stiform_View(){
    //$patients = Patients=>$request->=>$request->latest()->paginate(10);
    return view ('STI.stiform');
  }
  // Sti Rrp Import view
  public function Lab_Rpr_View(){
    return view('import.RprlabresultsImport');
  }
  public function Lab_Rpr_input(Request $request)
    {
      Excel::import(new RprlabresultsImport, $request->file('file')->store('temp'));
      return back();
    }

  //Sti Female Import view
  public function stifemaleImport_View(){
    return view('import.StiFemale_Import');
  }
  public function StimaleView(){
    return view('import.Stimale_Import');
  }

  //for STI  file Import
  public function StiFemaleInput(Request $request)
    {
      Excel::import(new StiFemaleImport, $request->file('file')->store('temp'));
      return back();
    }
  //for STI  file Import

  public function StimaleInput(Request $request)
    {
      Excel::import(new StiMaleImport, $request->file('file')->store('temp'));
      return back();
    }

  // for data collecting
  public function stidata(Request $request){
    //to check (old or new )
    $ckPatient=         $request->input('ckPatient');
    $pid=               $request->input('pid');
    $sti_female=        $request->input('sti_female');
    $sti_male=          $request->input('sti_male');
    $pid_shar =         $request->input('pid_update');
    $id_to_check =      $request->input('id_to_check');
    $date_to_check =    $request->input('date_to_check');
    $gender =           $request->input('duplicate_gender');

    if($id_to_check != null and $date_to_check != null)// to protect duplicate entry of ID and Date in the same day
    {
        if($gender == "male"){
          $duplicate_Stimale = Stimale::where('cid',$id_to_check)->latest()->first();
          $id_to_compare = $duplicate_Stimale["CID"];
          $date_to_compare = $duplicate_Stimale["Visit date"];

          if($id_to_compare == $id_to_check and $date_to_compare == $date_to_check ){
            $duplicate_pt = true;
            return response()->json([
               $duplicate_pt
             ]);
          }
        }elseif($gender == "faemale"){
          $duplicate_Stifemale = Stifemale::where('cid',$id_to_check)->latest()->first();
          $id_to_compare = $duplicate_Stimale["CID"];
          $date_to_compare = $duplicate_Stimale["Visit date"];
          if($id_to_compare == $id_to_check and $date_to_compare == $date_to_check ){
            $duplicate_pt = true;
            return response()->json([
               $duplicate_pt
             ]);
          }
        }else{

        }


    }
    if($ckPatient == 1)//to check the patient is in sti table
    {
      $general_pt = Patients::where('Pid',$pid)->get();
      $patientMale = Stimale::where('cid',$pid)->get();
      $patientFemale= Stifemale::where('cid',$pid)->get();
      $rprResult = Rprtest::where('pid',$pid)->get();

                if($general_pt != null){
                  if($pid_shar==1){
                    $update = 333;
                    return response()->json([
                        $general_pt, $patientMale,$patientFemale,$rprResult,$update
                    ]);
                  }else{
                    return response()->json([
                       $general_pt, $patientMale,$patientFemale,$rprResult,
                    ]);
                  }
                }
                if($patientMale != null){
                  if($pid_shar==1){
                    $update = 333;
                    return response()->json([
                        $general_pt, $patientMale,$patientFemale,$rprResult,$update
                    ]);
                  }else{
                    return response()->json([
                    $general_pt, $patientMale,$patientFemale,$rprResult,
                  ]);}

                }
                if($patientFemale != null){
                  if($pid_shar==1){
                    $update = 333;
                    return response()->json([
                        $general_pt, $patientMale,$patientFemale,$rprResult,$update
                    ]);
                  }else{
                    return response()->json([
                       $general_pt, $patientMale,$patientFemale,$rprResult,
                    ]);
                  }

                }
                if($general_pt==null and $patientMale==null and $$patientFemale==null ){
                  $Unregistered= array('id'=> 1,'name'=>'You are not registered at Respection or HE/Peer.');
                  return response()->json([$Unregistered]);
                }
    }
    if($sti_male == 1)   // STI Male Data Collector (Create)
    {
        /*
        $age=intval($request->input('age'));
        $Visit_date=$request->input('regdate');
          var_dump(date_parse($Visit_date));
        */
         Stimale::create([
                'gender'                       => $request -> gender,
                'CID'                          => $request -> pid,
                'clinic'                       => $request -> clinic,
                //'tbl_demog_first_visit'        => $request -> tbl_demog_firt_visit,
                'last_vis_within'              => $request -> lastVisit,
                'age'                          => $request -> age,
                'about_clinic'                 => $request -> aboutclinic ,
                'Visit date'                   => $request -> regdate,
                //                              => $request -> fuchia,
                'episode'                      => $request -> episode,
                'Reason for Visit'             => $request -> reason,
                'risk_factor'                  => $request -> ptype,
                'urethral_disc'                => $request -> urethral_discharge,
                'urethral_disc_hl'             => $request -> howlong_days,
                'dysuria'                     => $request -> dysuria,
                'dysuria_hl'                   => $request -> howlong_dysuria,

                'genital_prut'                 => $request -> genital_prutitus,
                'genital_prut_hl'              => $request -> howlong_genital_pruti,
                'genital_pain'                 => $request -> genital_burn,
                'genital_pain_hl'              => $request -> howlong_genital_burn,
                'genital_ulcer'                => $request -> genital_ulcer,
                'genital_ulcer_hl'             => $request -> howlong_genital_ulcer,

                'pain'                         => $request -> pain,
                'ulcer'                        => $request -> ulcer,
                'prodromal_itch'               => $request -> prodromal_itch,
                'vesicles'                     => $request -> start_vesicles,
                'recurrent'                    => $request -> recurrent,
                'last_episode'                 => $request -> last_episode,
                'suspects_herpes'              => $request -> patient_suspect_herpes,

                'ing_lymph_node'               => $request -> inguinal_lymph_node ,
                'ing_lymph_node_hl'            => $request -> hl_inguinal_lymph_node,
                'unilateal'                    => $request -> unilateal,
                'leg_ulcer'                    => $request -> leg_ulcer_inf,
                'scrotal_swelling'             => $request -> scrotal_swelling,
                'scrotal_swelling_hl'          => $request -> hl_scrotal_swelling,
                'td_ntd'                       => $request -> tender,
                'gen_wart'                     => $request -> genital_wart,
                'gen_wart_hl'                  => $request -> hl_genital_wart,
              //first end
              //second page
                'physical_exam'                => $request -> physical_exam ,
                'urinated_wit_1h'              => $request -> urinated_within1hr,
                'discharge'                    => $request -> discharge,
                'discharge_milk'               => $request -> discharge_after_milking,
                'colour'                       => $request -> colour,
                'erythema'                     => $request -> phi_erythema,
                'blisters'                     => $request -> phi_blister_penis,
                'gen_ulcer'                    => $request -> phi_genital_ulcer,

                'esti_size'                    => $request -> phi_estimated_size,
                'sing_multi'                   => $request -> phi_single_multiple,
                'pain_full_less'               => $request -> phi_painfull,
                'herpes_suspect'               => $request -> phi_herpes_suspected,
                'inguinal_bubo'                => $request -> phi_inguinal_bubo,

                'fluctant'                     => $request -> phi_fluctant,
                'tendr_ntender'                => $request -> phi_tender,
                'oth_leg_inf'                  => $request -> phi_leg_inf,
                'phy_genital_wart'             => $request -> phi_genital_wart,

                'crab_lice'                    => $request -> phi_crab_lice,
                'scabies'                      => $request -> phi_scabies,
                'gscrotal_swelling'            => $request -> phi_scrotal_swelling,
                'estimated_siz'                => $request -> phi_estimated_size,
                'unilateal_bilateral'          => $request -> phi_unilateal,
                'gtender_ntender'              => $request -> phi_tender_non,
                'erythem'                      => $request -> phi_erythema1,
                'des_size'                     => $request -> phi_drawing,
              //second page end
              //third page
                'tbl_treat_diagnosis_first_visit'=> $request -> pt_1st_visit,
                'epi_discharge'                => $request -> pt_epi_dis_lastvisit,
                'unprot_sex_new_part'          => $request -> unprotected_sex ,
                'genital_signs'                => $request -> genital_sign,

                'presumptive_diag'             => $request -> presumptive_diag,
                'pri_syphillis'                => $request -> primary_syphillis,
                'Gonorhoea'                    => $request -> gonorrhoea,
                'congenial_syphillis'          => $request -> congenial_syphillis,
                'sec_syphillis'                => $request -> secondary_syphillis,
                'non_gono_urethritis'          => $request -> non_gono_urethri,
                'latent_syphillis'             => $request -> latent_syphillis,
                'chancroid'                    => $request -> chancroid,
                // need to ask
              //  'non_gono_cervities'                              => $request -> ,
                'molluscum_contag'             => $request -> molluscum_contagiosum,
                'gen_herpes'                   => $request -> genital_herpes3,
                'trichomonas'                  => $request -> trichomonas,
                'bubos'                        => $request -> bubos,
                'othstd_genital_warts'         => $request -> genital_warts3,
                'gen_scabies'                  => $request -> genital_scabies3,
                'genital_candidiosis'          => $request -> genital_candidiosis,
                //                                => $request -> genital_warts3,
                'gud_other'                    => $request -> others3,
                'beterial_vaginosis'           => $request -> baterial_vaginosis,
                'other(please specify)'        => $request -> others33,
                'tre_azythro'                  => $request -> tre_azythro,
                'tre_cefixim'                  => $request -> tre_cefixim,
                'tre_ciprofloxacin'            => $request -> tre_ciprofloxacin,
                'tre_tinidazole'               => $request -> tre_tinidazole,
                'tre_fluconazole'              => $request -> tre_fluconazole,
                'tre_doxycycline'              => $request -> tre_doxycycline,
                'tre_ceftriaxone'              => $request -> tre_ceftriaxone,
                'tre_benz_pen'                 => $request -> tre_benzpen,
                'no_treat'                     => $request -> no_treament1,
                'al_Penicillin'                => $request -> allergy,
                'al_sulfa'                     => $request -> sulfa,
                'part_treat'                   => $request -> parter_treatment_given,
                'condom_giv'                   => $request -> condom,
                'tre_remarks'                  => $request -> remarkTreatment,
                'followup'                     => $request -> follwupText,
                'clinician_name'                    => $request -> clinicainName

            ]);

            $success=[["id"=> 1,
            "name" => "Your data has been successfully collected."
            ]];
            return response()->json([$success]);


    }
    if($sti_female == 1) // STI Female Collector (Create)
    {
        Stifemale::create([
          'gender'            => $request -> fe_gender,
          'clinic'            => $request -> fe_clinic,
          'CID'               => $request -> fe_pid,
          'first_visit'       => $request -> fe_firstVisit,
          'last_vis_within'   => $request -> fe_lastVisit,
          //'vtype'            => $request -> ,
          'age'               => $request -> fe_age,
          'about_clinic'      => $request -> fe_aboutclinic ,
          //'demo_remarks'            => $request -> demo_remarks,
          'Visit date'        => $request -> fe_regdate,
          //      'Expr1'             => $request ->      ,
          'episode'           => $request -> fe_episode,
          'rea_for_visit'     => $request -> fe_reason,
          'risk_factor'       => $request -> fe_ptype,

          'abn_vaginal_disc'  => $request -> fe_abVagdischarge,
          'abn_vaginal_disc_long' => $request -> fe_hl_ab_va_dis,
          'linked_menstru'    => $request -> fe_Link_menstra,
          'amount'            => $request -> fe_Amount,
          'colour'            => $request -> fe_colour,
          'colour_oth'        => $request -> fe_oth_colour,

          'abn_veginal_odour' => $request -> fe_odour,
          'l_abn_pain'        => $request -> fe_lower_abd_pain,
          'l_abon_pain_hl'    => $request -> fe_hl_abd_pain,
          'fever'             => $request -> fe_fever,
          'rec_terminate_preg'=> $request -> fe_terminate_preg,
          'dyspareunia'       => $request -> fe_dyspareunia,
          'oth_GI_sympt'      => $request -> fe_oth_gi_sym,
          'dysuria'           => $request -> fe_dysuria,
          'dysuria_hl'        => $request -> fe_howlong_dysuria,
          'gen_prutitus'      => $request -> fe_genital_prutitus,
          'gen_prutitus_hl'   => $request -> fe_howlong_genital_pruti,
          'gen_burn_pain'     => $request -> fe_genital_burn,
          'gen_burn_pain_hl'  => $request -> fe_howlong_genital_burn,
          'gen_ulcer'         => $request -> fe_genital_ulcer,
          'gen_ulcer_hl'      => $request -> fe_howlong_genital_ulcer,
          'pain'              => $request -> fe_pain,
          'ulcer'             => $request -> fe_ulcer,
          'prodromal_itch'    => $request -> fe_prodormal_itch,
          'vesicles'          => $request -> fe_start_vesicles,
          'recurrent'         => $request -> fe_recurrent,
          'recurrent_last_episode'  => $request -> fe_last_episode,
          'patient_suspects_herpes' => $request -> fe_patient_suspect_herpes,
          'inguinal_ln'             => $request -> fe_inguinal_lymph_node,
          'inguinal_ln_hl'          => $request -> fe_hl_inguinal_lymph_node,
          'unilateal_Bilateral'     => $request -> fe_unilateal,
          'leg_ulcer_oth_inf'       => $request -> fe_leg_ulcer_inf,
          'genital_warts'           => $request -> fe_genital_wart,
          'genital_warts_hl'        => $request -> fe_hl_genital_wart,
          //                                       fe_other_specify
          'phy_exam_done'           => $request -> fe_physical_exam,
          'washed_inside'           => $request -> fe_wash_inside,
          'vulvar_erythema'         => $request -> fe_vulvar_erythema,
          'vulvar_odema'            => $request -> fe_vulvar_odema,
          'vaginal_discharge'       => $request -> fe_vag_dis,
          'vag_dis_amount'          => $request -> fe_vag_dis_amount,
          'homogeneous'             => $request -> fe_homogeneous,
          'homogeneous_col'         => $request -> fe_vag_dis_colour,
          'smell_without_KOH'       => $request -> fe_smell_koh,
          'vaginal_wall_injury'     => $request -> fe_phi_vag_wall,
          'adnexal_tenderness'      => $request -> fe_phi_ad_tender,
          'adnexal_enlargement'     => $request -> fe_phi_ad_enlarge,
          'genital_blisters'        => $request -> fe_genital_blisters,

          'genital_blisters_Location'=> $request -> fe_genital_blisters_location,
          'gential_ulcer'           => $request -> fe_genital_ulcer,
          'gential_ulcerl'          => $request -> fe_genital_ulc_location,

          'gent_ulcer_sm'           => $request -> fe_single_multiple,
          'gential_ulcer_pain'      => $request -> fe_painfull,
          'susp_herpes'             => $request -> fe_herpes_suspected,
          'inguinal_bubo'           => $request -> fe_inguinal_bubo,
          'fluctuant'               => $request -> fe_fluctant,
          'fluctuant_tender'        => $request -> fe_tender,
          'oth_leg_infection'       => $request -> fe_leg_inf,
          'genital_wart'            => $request -> fephi_genital_wart,

          'crab_lice'               => $request -> fe_crab_lice,
          'scablices'               => $request -> fe_scabies,
          'KOH_smell_test'          => $request -> fe_koh_smell,
          'pH_vagina'               => $request -> fe_ph_vagina,
          'des_size'                => $request -> fe_drawing_f,

          'prev_STI'                => $request -> cal1,
          'patient_genital_ulcer'   => $request -> cal4,
          'patient_compl_low_abd'   => $request -> cal5,
          'new_pat_past_3mont'      => $request -> cal2,
          'part_compl_gential_sym'  => $request -> cal3,
          'sworker'                 => $request -> cal6,
          'rg_score'                => $request -> scoreAns,
          'risk'                    => $request -> riskCal,
          'risk_cal_remark'         => $request -> riskRemark,
          'abn_yellow_disc'         => $request -> cal7,
          'dysuria_risk_ass'        => $request -> cal9,
          'low_abd_pain'            => $request -> low_abd_pain,
          'pain_dur_sexual'         => $request -> cal8,
          'unp_sex_new_clients'     => $request -> cal10,
          'partner_ulcer'           => $request -> fe_partner_ulcer,
          'presumptive_diag'        => $request -> fe_presumptive_diag,
          'pri_syphillis'           => $request -> fe_primary_syphillis,
          'sec_syphillis'           => $request -> fe_secondary_syphillis,
          'chancroid'               => $request -> fe_chancroid,
          'gen_herpes'              => $request -> fe_genital_herpes3,
          'gen_scabies'             => $request -> fe_genital_scabies3,
          //'gud_other'               => $request -> ,
          'other_plz_specify'       => $request -> fe_other_specify,
          'Gonorhoea'               => $request -> fe_gonorrhoea,
          'non_gono_urethritis'     => $request -> fe_non_gono_urethri,
          'non_gono_cervities'      => $request -> fe_non_gono_cervities,
          'trichomonas'             => $request -> fe_trichomonas,
          'genital_candidiosis'     => $request -> fe_genital_candidiosis,
          'beterial_vaginosis'      => $request -> fe_baterial_vaginosis,
          'latent_syphillis_preg'   => $request -> fe_latent_syp_pregancy,
          'latent_syphillis'        => $request -> fe_latent_syphillis,
          'molluscum_contag'        => $request -> fe_molluscum_contagiosum,
          'bubos'                   => $request -> fe_bubos,
          'othstd_genital_warts'    => $request -> fe_genital_warts3,
          'ostd_other'              => $request -> fe_others3,
          'tre_azythro'             => $request -> fe_tre_azythro,
          'tre_cefixim'             => $request -> fe_tre_cefixim,
          'tre_ciprofloxacin'       => $request -> fe_tre_ciprofloxacin,
          'tre_tinidazole'          => $request -> fe_tre_tinidazole,
          'tre_fluconazole'         => $request -> fe_tre_fluconazole,
          'tre_doxycycline'         => $request -> fe_tre_doxycycline,
          'tre_ceftriaxone'         => $request -> fe_tre_ceftriaxone,
          'tre_benz_pen'            => $request -> fe_tre_benzpen,
          'clotrimazole_vaginal_tab'=> $request -> fe_clotrimazole,
          'tre_Other'               => $request -> fe_no_treament,
          'al_Penicillin'           => $request -> fe_allergy,
          'al_sulfa'                => $request -> fe_sulfa,
          'part_treat'              => $request -> fe_parter_treatment_given,
          'condom_giv'              => $request -> fe_condom,
          'tre_remarks'             => $request -> fe_remarkTreatment,
          'followup'                => $request -> fe_follwupText,
          'clinician'               => $request -> fe_clinicainName
      ]);
          $success="Saved";
            return response()->json([$success]);
    }
    if($sti_male == 2) // STI Male Data Updater ( Update )
    {
        $updateID = $request->input('updateID');
        Stimale::where('id',$updateID)
                ->update([
                  'gender'                       => $request -> gender,
                  'CID'                          => $request -> pid,
                  'clinic'                       => $request -> clinic,
                  //'tbl_demog_first_visit'        => $request -> tbl_demog_firt_visit,
                  'last_vis_within'              => $request -> lastVisit,
                  'age'                          => $request -> age,
                  'about_clinic'                 => $request -> aboutclinic ,
                  'Visit date'                   => $request -> regdate,
                  //                              => $request -> fuchia,
                  'episode'                      => $request -> episode,
                  'Reason for Visit'             => $request -> reason,
                  'risk_factor'                  => $request -> ptype,
                  'urethral_disc'                => $request -> urethral_discharge,
                  'urethral_disc_hl'             => $request -> howlong_days,
                  'dysuria'                      => $request -> dysuria,
                  'dysuria_hl'                   => $request -> howlong_dysuria,

                  'genital_prut'                 => $request -> genital_prutitus,
                  'genital_prut_hl'              => $request -> howlong_genital_pruti,
                  'genital_pain'                 => $request -> genital_burn,
                  'genital_pain_hl'              => $request -> howlong_genital_burn,
                  'genital_ulcer'                => $request -> genital_ulcer,
                  'genital_ulcer_hl'             => $request -> howlong_genital_ulcer,

                  'pain'                         => $request -> pain,
                  'ulcer'                        => $request -> ulcer,
                  'prodromal_itch'               => $request -> prodromal_itch,
                  'vesicles'                     => $request -> start_vesicles,
                  'recurrent'                    => $request -> recurrent,
                  'last_episode'                 => $request -> last_episode,
                  'suspects_herpes'              => $request -> patient_suspect_herpes,

                  'ing_lymph_node'               => $request -> inguinal_lymph_node ,
                  'ing_lymph_node_hl'            => $request -> hl_inguinal_lymph_node,
                  'congenial_syphillis'     => $request -> fe_congenial_syphillis,
                  'unilateal'                    => $request -> unilateal,
                  'leg_ulcer'                    => $request -> leg_ulcer_inf,
                  'scrotal_swelling'             => $request -> scrotal_swelling,
                  'scrotal_swelling_hl'          => $request -> hl_scrotal_swelling,
                  'td_ntd'                       => $request -> tender,
                  'gen_wart'                     => $request -> genital_wart,
                  'gen_wart_hl'                  => $request -> hl_genital_wart,
                //first end
                //second page
                  'physical_exam'                => $request -> physical_exam ,
                  'urinated_wit_1h'              => $request -> urinated_within1hr,
                  'discharge'                    => $request -> discharge,
                  'discharge_milk'               => $request -> discharge_after_milking,
                  'colour'                       => $request -> colour,
                  'erythema'                     => $request -> phi_erythema,
                  'blisters'                     => $request -> phi_blister_penis,
                  'gen_ulcer'                    => $request -> phi_genital_ulcer,

                  'esti_size'                    => $request -> phi_estimated_size,
                  'sing_multi'                   => $request -> phi_single_multiple,
                  'pain_full_less'               => $request -> phi_painfull,
                  'herpes_suspect'               => $request -> phi_herpes_suspected,
                  'inguinal_bubo'                => $request -> phi_inguinal_bubo,

                  'fluctant'                     => $request -> phi_fluctant,
                  'tendr_ntender'                => $request -> phi_tender,
                  'oth_leg_inf'                  => $request -> phi_leg_inf,
                  'phy_genital_wart'             => $request -> phi_genital_wart,

                  'crab_lice'                    => $request -> phi_crab_lice,
                  'scabies'                      => $request -> phi_scabies,
                  'gscrotal_swelling'            => $request -> phi_scrotal_swelling,
                  'estimated_siz'                => $request -> phi_estimated_size,
                  'unilateal_bilateral'          => $request -> phi_unilateal,
                  'gtender_ntender'              => $request -> phi_tender_non,
                  'erythem'                      => $request -> phi_erythema1,
                  'des_size'                     => $request -> phi_drawing,
                //second page end
                //third page
                  'epi_discharge'                => $request -> pt_epi_dis_lastvisit,
                  'unprot_sex_new_part'          => $request -> unprotected_sex ,
                  'genital_signs'                => $request -> genital_sign,
                  'tbl_treat_diagnosis_first_visit'=> $request -> pt_1st_visit,
                  'presumptive_diag'             => $request -> presumptive_diag,
                  'pri_syphillis'                => $request -> primary_syphillis,
                  'Gonorhoea'                    => $request -> gonorrhoea,
                  'congenial_syphillis'          => $request -> congenial_syphillis,
                  'sec_syphillis'                => $request -> secondary_syphillis,
                  'non_gono_urethritis'          => $request -> non_gono_urethri,
                  'latent_syphillis'             => $request -> latent_syphillis,
                  'chancroid'                    => $request -> chancroid,
                  // need to ask
                //  'non_gono_cervities'                              => $request -> ,
                  'molluscum_contag'             => $request -> molluscum_contagiosum,
                  'gen_herpes'                   => $request -> genital_herpes3,
                  'trichomonas'                  => $request -> trichomonas,
                  'bubos'                        => $request -> bubos,
                  'othstd_genital_warts'         => $request -> genital_warts3,
                  'gen_scabies'                  => $request -> genital_scabies3,
                  'genital_candidiosis'          => $request -> genital_candidiosis,
                  //                                => $request -> genital_warts3,
                  'gud_other'                    => $request -> others3,
                  'beterial_vaginosis'           => $request -> baterial_vaginosis,
                  'other(please specify)'        => $request -> others33,
                  'tre_azythro'                  => $request -> tre_azythro,
                  'tre_cefixim'                  => $request -> tre_cefixim,
                  'tre_ciprofloxacin'            => $request -> tre_ciprofloxacin,
                  'tre_tinidazole'               => $request -> tre_tinidazole,
                  'tre_fluconazole'              => $request -> tre_fluconazole,
                  'tre_doxycycline'              => $request -> tre_doxycycline,
                  'tre_ceftriaxone'              => $request -> tre_ceftriaxone,
                  'tre_benz_pen'                 => $request -> tre_benzpen,
                  'no_treat'                     => $request -> no_treament1,
                  'al_Penicillin'                => $request -> allergy,
                  'al_sulfa'                     => $request -> sulfa,
                  'part_treat'                   => $request -> parter_treatment_given,
                  'condom_giv'                   => $request -> condom,
                  'tre_remarks'                  => $request -> remarkTreatment,
                  'followup'                     => $request -> follwupText,
                  'clinician_name'                    => $request -> clinicainName

            ]);

              $success=[[ 	"id"   => 1,
              "name" => "Your data has been successfully updated." ]];
              return response()->json([$success,$updateID]);
    }
    if($sti_female == 2) // STI Female Data Updater (Update)
    {
      $updateID = $request->input('updateID');
      Stifemale::where('id',$updateID)
          ->update([
          'gender'            => $request -> fe_gender,
          'clinic'            => $request -> fe_clinic,
          'CID'               => $request -> fe_pid,
          'first_visit'       => $request -> fe_firstVisit,
          'last_vis_within'   => $request -> fe_lastVisit,
          //'vtype'            => $request -> ,
          'age'               => $request -> fe_age,
          'about_clinic'      => $request -> fe_aboutclinic ,
          //'demo_remarks'            => $request -> demo_remarks,
          'Visit date'        => $request -> fe_regdate,
          //      'Expr1'             => $request ->      ,
          'episode'           => $request -> fe_episode,
          'rea_for_visit'     => $request -> fe_reason,
          'risk_factor'       => $request -> fe_ptype,

          'abn_vaginal_disc'  => $request -> fe_abVagdischarge,
          'abn_vaginal_disc_long' => $request -> fe_hl_ab_va_dis,
          'linked_menstru'    => $request -> fe_Link_menstra,
          'amount'            => $request -> fe_Amount,
          'colour'            => $request -> fe_colour,
          'colour_oth'        => $request -> fe_oth_colour,

          'abn_veginal_odour' => $request -> fe_odour,
          'l_abn_pain'        => $request -> fe_lower_abd_pain,
          'l_abon_pain_hl'    => $request -> fe_hl_abd_pain,
          'fever'             => $request -> fe_fever,
          'rec_terminate_preg'=> $request -> fe_terminate_preg,
          'dyspareunia'       => $request -> fe_dyspareunia,
          'oth_GI_sympt'      => $request -> fe_oth_gi_sym,
          'dysuria'           => $request -> fe_dysuria,
          'dysuria_hl'        => $request -> fe_howlong_dysuria,
          'gen_prutitus'      => $request -> fe_genital_prutitus,
          'gen_prutitus_hl'   => $request -> fe_howlong_genital_pruti,
          'gen_burn_pain'     => $request -> fe_genital_burn,
          'gen_burn_pain_hl'  => $request -> fe_howlong_genital_burn,
          'gen_ulcer'         => $request -> fe_genital_ulcer,
          'gen_ulcer_hl'      => $request -> fe_howlong_genital_ulcer,
          'pain'              => $request -> fe_pain,
          'ulcer'             => $request -> fe_ulcer,
          'prodromal_itch'    => $request -> fe_prodormal_itch,
          'vesicles'          => $request -> fe_start_vesicles,
          'recurrent'         => $request -> fe_recurrent,
          'recurrent_last_episode'  => $request -> fe_last_episode,
          'patient_suspects_herpes' => $request -> fe_patient_suspect_herpes,
          'inguinal_ln'             => $request -> fe_inguinal_lymph_node,
          'inguinal_ln_hl'          => $request -> fe_hl_inguinal_lymph_node,
          'unilateal_Bilateral'     => $request -> fe_unilateal,
          'leg_ulcer_oth_inf'       => $request -> fe_leg_ulcer_inf,
          'genital_warts'           => $request -> fe_genital_wart,
          'genital_warts_hl'        => $request -> fe_hl_genital_wart,
          //                                       fe_other_specify
          'phy_exam_done'           => $request -> fe_physical_exam,
          'washed_inside'           => $request -> fe_wash_inside,
          'vulvar_erythema'         => $request -> fe_vulvar_erythema,
          'vulvar_odema'            => $request -> fe_vulvar_odema,
          'vaginal_discharge'       => $request -> fe_vag_dis,
          'vag_dis_amount'          => $request -> fe_vag_dis_amount,
          'homogeneous'             => $request -> fe_homogeneous,
          'homogeneous_col'         => $request -> fe_vag_dis_colour,
          'smell_without_KOH'       => $request -> fe_smell_koh,
          'vaginal_wall_injury'     => $request -> fe_phi_vag_wall,
          'adnexal_tenderness'      => $request -> fe_phi_ad_tender,
          'adnexal_enlargement'     => $request -> fe_phi_ad_enlarge,
          'genital_blisters'        => $request -> fe_genital_blisters,

          'genital_blisters_Location'=> $request -> fe_genital_blisters_location,
          'gential_ulcer'           => $request -> fe_genital_ulcer,
          'gential_ulcerl'          => $request -> fe_genital_ulc_location,

          'gent_ulcer_sm'           => $request -> fe_single_multiple,
          'gential_ulcer_pain'      => $request -> fe_painfull,
          'susp_herpes'             => $request -> fe_herpes_suspected,
          'inguinal_bubo'           => $request -> fe_inguinal_bubo,
          'fluctuant'               => $request -> fe_fluctant,
          'fluctuant_tender'        => $request -> fe_tender,
          'oth_leg_infection'       => $request -> fe_leg_inf,
          'genital_wart'            => $request -> fephi_genital_wart,

          'crab_lice'               => $request -> fe_crab_lice,
          'scablices'               => $request -> fe_scabies,
          'KOH_smell_test'          => $request -> fe_koh_smell,
          'pH_vagina'               => $request -> fe_ph_vagina,
          'des_size'                => $request -> fe_drawing_f,

          'prev_STI'                => $request -> cal1,
          'patient_genital_ulcer'   => $request -> cal4,
          'patient_compl_low_abd'   => $request -> cal5,
          'new_pat_past_3mont'      => $request -> cal2,
          'part_compl_gential_sym'  => $request -> cal3,
          'sworker'                 => $request -> cal6,
          'rg_score'                => $request -> scoreAns,
          'risk'                    => $request -> riskCal,
          'risk_cal_remark'         => $request -> riskRemark,
          'abn_yellow_disc'         => $request -> cal7,
          'dysuria_risk_ass'        => $request -> cal9,
          'low_abd_pain'            => $request -> low_abd_pain,
          'pain_dur_sexual'         => $request -> cal8,
          'unp_sex_new_clients'     => $request -> cal10,
          'partner_ulcer'           => $request -> fe_partner_ulcer,
          'presumptive_diag'        => $request -> fe_presumptive_diag,
          'pri_syphillis'           => $request -> fe_primary_syphillis,
          'sec_syphillis'           => $request -> fe_secondary_syphillis,
          'chancroid'               => $request -> fe_chancroid,
          'gen_herpes'              => $request -> fe_genital_herpes3,
          'gen_scabies'             => $request -> fe_genital_scabies3,
          //'gud_other'               => $request -> ,
          'other_plz_specify'       => $request -> fe_other_specify,
          'Gonorhoea'               => $request -> fe_gonorrhoea,
          'non_gono_urethritis'     => $request -> fe_non_gono_urethri,
          'non_gono_cervities'      => $request -> fe_non_gono_cervities,
          'trichomonas'             => $request -> fe_trichomonas,
          'genital_candidiosis'     => $request -> fe_genital_candidiosis,
          'beterial_vaginosis'      => $request -> fe_baterial_vaginosis,
          'latent_syphillis_preg'   => $request -> fe_latent_syp_pregancy,
          'latent_syphillis'        => $request -> fe_latent_syphillis,
          'molluscum_contag'        => $request -> fe_molluscum_contagiosum,
          'bubos'                   => $request -> fe_bubos,
          'othstd_genital_warts'    => $request -> fe_genital_warts3,
          'ostd_other'              => $request -> fe_others3,
          'tre_azythro'             => $request -> fe_tre_azythro,
          'tre_cefixim'             => $request -> fe_tre_cefixim,
          'tre_ciprofloxacin'       => $request -> fe_tre_ciprofloxacin,
          'tre_tinidazole'          => $request -> fe_tre_tinidazole,
          'tre_fluconazole'         => $request -> fe_tre_fluconazole,
          'tre_doxycycline'         => $request -> fe_tre_doxycycline,
          'tre_ceftriaxone'         => $request -> fe_tre_ceftriaxone,
          'tre_benz_pen'            => $request -> fe_tre_benzpen,
          'clotrimazole_vaginal_tab'=> $request -> fe_clotrimazole,
          'tre_Other'               => $request -> fe_no_treament,
          'al_Penicillin'           => $request -> fe_allergy,
          'al_sulfa'                => $request -> fe_sulfa,
          'part_treat'              => $request -> fe_parter_treatment_given,
          'condom_giv'              => $request -> fe_condom,
          'tre_remarks'             => $request -> fe_remarkTreatment,
          'followup'                => $request -> fe_follwupText,
          'clinician'               => $request -> fe_clinicainName
      ]);
          $success="Saved";
            return response()->json([$success]);
    }
  }

  public function stiReport_Calculator(Request $request){
      $calculator=$request->input('calculate');
      $chart=$request->input('chart');
      $stiRange=$request->input('range');
      $rpMonth=$request->input('month');
      $stiYear=$request->input('year');

      if($calculator==1){
        if($stiYear=="2021"){
          if($stiRange=="onlyOne")//to calculate monthly
          {
            if($rpMonth==9){
                $from=date('2021-09-01');
                $to=date('2021-09-30');
                $from_ck_new_old=date('2021-1-1');
                $to_ck_new_old=date('2021-8-31');
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==10){
                $from=date('2021-10-01');
                $to=date('2021-10-31');
                $from_ck_new_old=date('2021-1-1');
                $to_ck_new_old=date('2021-9-30');
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==11){
                $from=date('2021-11-01');
                $to=date('2021-11-30');
                $from_ck_new_old=date('2021-1-1');
                $to_ck_new_old=date('2021-10-30');
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==12){
                $from=date('2021-12-01');
                $to=date('2021-12-31');
                $from_ck_new_old=date('2021-1-1');
                $to_ck_new_old=date('2021-12-30');
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
          }
          if($stiRange=="firstQ")//to calculate First Quarter
          {

          }
          if($stiRange=="secondQ")//to calculate Second Quarter
          {

          }
          if($stiRange=="thirdQ")//to calculate Third Quarter
          {

          }
          if($stiRange=="annual")//to calculate Annual Year
          {

          }
        }
        if($stiYear=="2022"){
          if($stiRange=="onlyOne")//to calculate monthly
          {
            if($rpMonth==1){
                $from=date('2022-01-01');
                $to=date('2022-01-31');

                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==2){
                $from=date('2022-02-01');
                $to=date('2022-02-28');
                $from_ck_new_old=date('2022-01-01');
                $to_ck_new_old=date('2022-01-31');
                $loopTime=1;
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==3){
                $from=date('2022-03-01');
                $to=date('2022-03-31');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-2-28');
              return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==4){
                $from=date('2022-04-01');
                $to=date('2022-04-30');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-3-31');
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==5){
                $from=date('2022-05-01');
                $to=date('2022-05-31');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-4-30');
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==6){
                $from=date('2022-06-01');
                $to=date('2022-06-30');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-5-31');
              return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==7){
                $from=date('2022-07-01');
                $to=date('2022-07-31');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-6-30');
              return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==8){
                $from=date('2022-08-01');
                $to=date('2022-08-28');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-7-31');
              return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==9){
                $from=date('2022-09-01');
                $to=date('2022-09-28');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-8-31');
              return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==10){
                $from=date('2022-10-01');
                $to=date('2022-10-28');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-9-30');
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==11){
                $from=date('2022-11-01');
                $to=date('2022-11-28');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-10-31');
              return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }
            if($rpMonth==12){
                $from=date('2022-12-01');
                $to=date('2022-12-28');
                $from_ck_new_old=date('2022-1-1');
                $to_ck_new_old=date('2022-11-30');
                return $this->dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange);
            }

          }
          if($stiRange=="firstQ")//to calculate First Quarter
          {

          }
          if($stiRange=="secondQ")//to calculate Second Quarter
          {

          }
          if($stiRange=="thirdQ")//to calculate Third Quarter
          {

          }
          if($stiRange=="annual")//to calculate Annual Year
          {

          }
        }
      }
      if($chart==1){
        if($stiYear=="2021"){
          if($stiRange=="firstQ")//to calculate First Quarter
          {
            $from9=date('2021-09-01');
            $to9=date('2021-09-30');
            $from10=date('2021-10-01');
            $to10=date('2021-10-31');
            $from11=date('2021-11-01');
            $to11=date('2021-11-30');
            $from12=date('2021-12-01');
            $to12=date('2021-12-31');
          return $this->firstQuarter($from9,$to9,$from10,$to10,$from11,$to11,$from12,$to12);

          }
          if($stiRange=="secondQ")//to calculate Second Quarter
          {

          }
          if($stiRange=="thirdQ")//to calculate Third Quarter
          {

          }
          if($stiRange=="annual")//to calculate Annual Year
          {

          }
        }
        if($stiYear=="2022"){
          if($stiRange=="firstQ")//to calculate First Quarter
          {

          }
          if($stiRange=="secondQ")//to calculate Second Quarter
          {

          }
          if($stiRange=="thirdQ")//to calculate Third Quarter
          {

          }
          if($stiRange=="annual")//to calculate Annual Year
          {

          }
        }
      }
  }
  //database dbx_query
  public function dataDrawer($from,$to,$from_ck_new_old,$to_ck_new_old,$rpMonth,$stiRange){
    //attendence
    $rp_month_m =Stimale::whereBetween('Visit date', [$from, $to])->get();
    $old_month_m= Stimale::whereBetween('Visit date', [$from_ck_new_old, $to_ck_new_old])->get();


    $rp_month_ID_m =array();
    for ($i=0; $i <count($rp_month_m) ; $i++){
      $rp_month_ID_m[]=intval($rp_month_m[$i]['CID']); // this is report month's all ID
    }

    $rp_monthID_unique= array();
    foreach ($rp_month_ID_m as $key => $value) {
      $rp_monthID_unique[]=$value;
    }
    rsort($rp_monthID_unique);
    //$rp_monthID_unique = array_unique($rp_monthID_unique);
    //$aa = array_diff_key( $rp_month_ID_m , array_unique($rp_month_ID_m ) );


    $old_month_ID_m = array();
    for ($i=0; $i <count($old_month_m) ; $i++) {
      $old_month_ID_m[]= $old_month_m[$i]['CID']; // this is old month's all ID before report Month ID
    }
    $intersectID = array_intersect($rp_month_ID_m,$old_month_ID_m);
    $differID_a = array_diff($rp_month_ID_m,$intersectID);
    $differID_b = array_diff($intersectID,$rp_month_ID_m);
    $differID = array_merge($differID_a,$differID_b);// this is differend ID between report Month and Old months

    // For Gonorrhea Only Male
    $gono_14_m=0;$gono_24_m=0;$gono_25_m=0;
    for ($i=0; $i <count($rp_monthID_unique) ; $i++) {

      $rp_ID_Unique = $rp_monthID_unique[$i];// Unique ID from report Month

      $rp_pt_rows = Stimale::whereBetween('Visit date', [$from, $to])
                            ->orderBy('Visit date')
                            ->where('CID',$rp_ID_Unique)
                            ->get();
      $countGono = count($rp_pt_rows);
      if($countGono>0){
        if($countGono==1){
            $rpMonthAge = intval($rp_pt_rows[0]['age']);
            $rpMonthGono = intval($rp_pt_rows[0]['Gonorhoea']);
                if($rpMonthAge < 15 ){
                  if($rpMonthGono == 1){
                    $gono_14_m +=1;
                  }
                }
                if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                  if($rpMonthGono == 1){
                    $gono_24_m +=1;
                  }
                }
                if($rpMonthAge >= 25 ){
                  if($rpMonthGono == 1){
                    $gono_25_m +=1;
                  }
                }
      }

        if($countGono  == 2){/// duplicate id
        $gonoArray = array();
        for ($a=0; $a < $countGono ; $a++) {

        $rpMonthAge = intval($rp_pt_rows[$a]['age']);
        $gonoArray[] = intval($rp_pt_rows[$a]['Gonorhoea']);
      }
        if($gonoArray[0]==1 and $gonoArray[1]==1){
            if($rpMonthAge < 15 ){
                $gono_14_m +=1;
            }
            if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                $gono_24_m +=1;
            }
            if($rpMonthAge >= 25 ){
                $gono_25_m +=1;
            }
        }
        if($gonoArray[0]==2 and $gonoArray[1]==1){
            if($rpMonthAge < 15 ){
                $gono_14_m +=1;
            }
            if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                $gono_24_m +=1;
            }
            if($rpMonthAge >= 25 ){
                $gono_25_m +=1;
            }
        }
         }
        if($countGono ==3){
          if($gonoArray[0]==2 and $gonoArray[1]==2 and $gonoArray==1){
              if($rpMonthAge < 15 ){
                  $gono_14_m +=1;
              }
              if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                  $gono_24_m +=1;
              }
              if($rpMonthAge >= 25 ){
                  $gono_25_m +=1;
              }
          }
          if($gonoArray[0]==1 and $gonoArray[1]==2 and $gonoArray==1){
              if($rpMonthAge < 15 ){
                  $gono_14_m +=1;
              }
              if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                  $gono_24_m +=1;
              }
              if($rpMonthAge >= 25 ){
                  $gono_25_m +=1;
              }
          }
        }
        }
      }
      //////////////// Gono End ///////////////





    // For RPR results Only Male
      $msm_P_14_m=0;$msm_rdt_14_m=0;$tg_rdt_14_m=0;$tg_P_14_m=0;$idu_P_14_m =0;$idu_rdt_14_m = 0;
      $msm_P_24_m=0;$msm_rdt_24_m=0;$tg_rdt_24_m=0;$tg_P_24_m=0;$idu_P_24_m =0;$idu_rdt_24_m = 0;
      $msm_P_25_m=0;$msm_rdt_25_m=0;$tg_rdt_25_m=0;$tg_P_25_m=0;$idu_P_25_m =0;$idu_rdt_25_m = 0;

      $rpr_month_m =Rprtest::whereBetween('visit_date', [$from, $to])->get();
      $rpr_month_m_back =Rprtest::whereBetween('visit_date', [$from_ck_new_old, $to_ck_new_old])->get();
      // for rpr
      $rpr_month_ID_m =array();
      for ($i=0; $i <count($rpr_month_m) ; $i++) {
        $rpr_month_ID_m[]=intval($rpr_month_m[$i]['pid']); // this is report month's all ID
      }
      $rpr_monthID_unique= array();
      foreach ($rpr_month_ID_m as $key => $value) {
        $rpr_monthID_unique[]=$value;
      }
      rsort($rpr_monthID_unique);
      /// old months History
      $old_month_ID_m_rpr = array();
      for ($i=0; $i <count($rpr_month_m_back) ; $i++) {
        $old_month_ID_m_rpr[]= $rpr_month_m_back[$i]['pid']; // this is old month's all ID before report Month ID
      }
      $intersectID_rpr = array_intersect($rpr_month_ID_m,$old_month_ID_m_rpr);// to get back history
      $differID_a_rpr = array_diff($rpr_month_ID_m,$intersectID_rpr);// to get very very new patient
      $differID_b_rpr = array_diff($intersectID_rpr,$rpr_month_ID_m);// to get very very new patient
      $differID_rpr = array_merge($differID_a_rpr,$differID_b_rpr);// this is differend ID between report Month and Old months

      //////////// For very very New patients Section
      $rpr_newID = array();
      foreach ($differID_rpr as $key => $value) {
        $rpr_newID[]=$value;
      }

      for ($i=0; $i <count($rpr_newID) ; $i++) {
        $rp_ID_new = $rpr_newID[$i];
        $rpMonth_New_Rows = Rprtest::whereBetween('visit_date', [$from, $to])
                              ->orderBy('visit_date', 'desc')
                              ->where('pid',$rp_ID_new)
                              ->get();
                              $rpMonthAge = intval($rpMonth_New_Rows[0]['agey']);
                              $risk_sub = $rpMonth_New_Rows[0]['Patient Type Sub'];
                              $rdt_result = $rpMonth_New_Rows[0]['RDT Result'];
                  $counter_rpr_new= count($rpMonth_New_Rows);
                  if($counter_rpr_new==1){
                              if($rpMonthAge<15){
                                if($risk_sub == "MSM"){
                                    if($rdt_result=="Positive"){
                                      $msm_P_14_m +=1;
                                      $msm_rdt_14_m += 1;
                                    }
                                    if($rdt_result=="Negative"){
                                      $msm_rdt_14_m += 1;
                                    }
                                }
                                if($risk_sub == "TG"){
                                      if($rdt_result=="Positive"){
                                          $tg_P_14_m +=1;
                                          $tg_rdt_14_m += 1;
                                        }
                                        if($rdt_result=="Negative"){
                                            $tg_rdt_14_m += 1;
                                          }
                               }
                              }
                              if($rpMonthAge>=15 and $rpMonthAge<25){
                                if($risk_sub == "MSM"){
                                   if($rdt_result=="Positive"){
                                      $msm_P_24_m +=1;
                                      $msm_rdt_24_m += 1;
                                    }
                                    if($rdt_result=="Negative"){
                                      $msm_rdt_24_m += 1;
                                    }
                                }
                                if($risk_sub == "TG"){
                                      if($rdt_result=="Positive"){
                                          $tg_P_24_m +=1;
                                          $tg_rdt_24_m += 1;
                                        }
                                        if($rdt_result=="Negative"){
                                            $tg_rdt_24_m += 1;
                                          }
                               }
                               if($risk_sub == "IDU"){
                                     if($rdt_result=="Positive"){
                                         $idu_P_24_m +=1;
                                         $idu_rdt_24_m += 1;
                                       }
                                       if($rdt_result=="Negative"){
                                           $idu_rdt_24_m += 1;
                                         }
                              }
                              }
                              if($rpMonthAge>=25){
                                    if($risk_sub == "MSM"){
                                        if($rdt_result=="Positive"){
                                          $msm_P_25_m +=1;
                                          $msm_rdt_25_m += 1;
                                        }
                                        if($rdt_result=="Negative"){
                                          $msm_rdt_25_m += 1;
                                        }
                                    }
                                    if($risk_sub == "TG"){
                                          if($rdt_result=="Positive"){
                                              $tg_P_25_m +=1;
                                              $tg_rdt_25_m += 1;
                                            }
                                            if($rdt_result=="Negative"){
                                                $tg_rdt_25_m += 1;
                                              }
                                   }
                                   if($risk_sub == "IDU"){
                                         if($rdt_result=="Positive"){
                                             $idu_P_25_m +=1;
                                             $idu_rdt_25_m += 1;
                                           }
                                           if($rdt_result=="Negative"){
                                               $idu_rdt_25_m += 1;
                                             }
                                  }
                                }
                  }
                  if($counter_rpr_new==2){
                              if($rpMonthAge<15){
                                $rdt_result_1 = $rpMonth_New_Rows[1]['RDT Result'];
                                if($risk_sub == "MSM"){
                                    if($rdt_result="Negative" and $rdt_result_1=="Positive"){
                                      $msm_P_14_m +=1;
                                      $msm_rdt_14_m +=2;
                                    }
                                    if($rdt_result ="Negative" and $rdt_result_1=="Negative"){
                                      $msm_rdt_14_m +=1;
                                    }

                                }
                                if($risk_sub == "TG"){
                                    if($rdt_result != $rdt_result_1 and $rdt_result_1=="Positive"){
                                      $msm_P_14_m +=1;
                                      $msm_rdt_14_m +=2;
                                    }
                                    if($rdt_result ="Negative" and $rdt_result_1=="Negative"){
                                      $msm_rdt_14_m +=1;
                                    }
                                }
                              }
                              if($rpMonthAge>=15 and $rpMonthAge<25){
                                $rdt_result_1 = $rpMonth_New_Rows[1]['RDT Result'];
                                if($risk_sub == "MSM"){
                                    if($rdt_result != $rdt_result_1 and $rdt_result_1=="Positive"){
                                      $msm_P_24_m +=1;
                                      $msm_rdt_24_m +=2;
                                    }
                                    if($rdt_result ="Negative" and $rdt_result_1=="Negative"){
                                      $msm_rdt_24_m +=1;
                                    }
                                }
                                if($risk_sub == "TG"){
                                    if($rdt_result != $rdt_result_1 and $rdt_result_1=="Positive"){
                                      $msm_P_24_m +=1;
                                      $msm_rdt_24_m +=2;
                                    }
                                    if($rdt_result ="Negative" and $rdt_result_1=="Negative"){
                                      $msm_rdt_24_m +=1;
                                    }
                                }
                              }
                              if($rpMonthAge>=25){
                                $rdt_result_1 = $rpMonth_New_Rows[1]['RDT Result'];
                                if($risk_sub == "MSM"){
                                    if($rdt_result != $rdt_result_1 and $rdt_result_1=="Positive"){
                                      $msm_P_25_m +=1;
                                      $msm_rdt_25_m +=2;
                                    }
                                    if($rdt_result ="Negative" and $rdt_result_1=="Negative"){
                                      $msm_rdt_25_m +=1;
                                    }
                                }
                                if($risk_sub == "TG"){
                                    if($rdt_result != $rdt_result_1 and $rdt_result_1=="Positive"){
                                      $msm_P_25_m +=1;
                                      $msm_rdt_25_m +=2;
                                    }
                                    if($rdt_result ="Negative" and $rdt_result_1=="Negative"){
                                      $msm_rdt_25_m +=1;
                                    }
                                }
                              }
                  }
      }
        /////////RPR Old connected data /////////////////
      $msm_P_14_m_old=0;$msm_rdt_14_m_old=0;$tg_rdt_14_m_old=0;$tg_P_14_m_old=0;$idu_rdt_14_m_old=0;$idu_P_14_m_old=0;
      $msm_P_24_m_old=0;$msm_rdt_24_m_old=0;$tg_rdt_24_m_old=0;$tg_P_24_m_old=0;$idu_rdt_24_m_old=0;$idu_P_14_m_old=0;
      $msm_P_25_m_old=0;$msm_rdt_25_m_old=0;$tg_rdt_25_m_old=0;$tg_P_25_m_old=0;$idu_rdt_25_m_old=0;$idu_P_14_m_old=0;
      $idu_P_14_m_old=0;$idu_rdt_14_m_old=0;
      $idu_P_24_m_old=0;$idu_rdt_24_m_old=0;
      $idu_P_25_m_old=0;$idu_rdt_25_m_old=0;
      $needyID_rpr = array();
      $intersectID_rpr =  array_unique($intersectID_rpr);
      foreach ($intersectID_rpr as $key => $value) {
          $needyID_rpr[]=$value;
      }

      for ($i=0; $i <count($needyID_rpr) ; $i++) { // without duplicate ID
            $rpID_rpr = $needyID_rpr[$i];
            $rpMonth_Rows = Rprtest::whereBetween('visit_date', [$from, $to])
                                  ->orderBy('visit_date', 'desc')
                                  ->where('pid',$rpID_rpr)
                                  ->get();
            $rp_Age = $rpMonth_New_Rows[0]['agey'];
            $risk_sub = $rpMonth_New_Rows[0]['Patient Type Sub'];
            $rdt_result = $rpMonth_New_Rows[0]['RDT Result'];

            $old_pt_rows = Rprtest::whereBetween('visit_date',[$from_ck_new_old, $to_ck_new_old])
                                    ->orderBy('visit_date', 'desc')
                                    ->where('pid',$rpID_rpr)
                                    ->get();
                 $rdt_result_1 = $old_pt_rows[0]['RDT Result'];
                 if($rp_Age<15){
                   if($risk_sub == "MSM"){
                         if($rdt_result == "Positive" and $rdt_result_1=="Negative" ){
                             $msm_P_14_m_old += 1;
                             $msm_rdt_14_m_old += 1;
                         }
                    }
                    if($risk_sub == "TG"){
                          if($rdt_result == "Positive" and $rdt_result_1=="Negative"  ){
                              $msm_P_14_m_old += 1;
                              $msm_rdt_14_m_old += 1;
                          }
                     }


                 }
                 if($rp_Age>=15 and $rp_Age<25){
                   if($risk_sub == "MSM"){
                         if($rdt_result =="Positive" and $rdt_result_1=="Negative"  ){
                             $msm_P_24_m_old += 1;
                             $msm_rdt_24_m_old += 1;
                         }
                    }
                    if($risk_sub == "TG"){
                          if($rdt_result =="Positive" and $rdt_result_1=="Negative" ){
                              $msm_P_24_m_old += 1;
                              $msm_rdt_24_m_old += 1;
                          }
                     }
                     if($risk_sub == "IDU"){
                           if($rdt_result_1=="Negative" and $rdt_result =="Positive"){
                               $idu_P_25_m_old += 1;
                               $idu_rdt_25_m_old += 1;
                           }
                      }


                 }
                 if($rp_Age>=25){
                   if($risk_sub == "MSM"){
                         if($rdt_result_1=="Negative" and $rdt_result =="Positive"){
                             $msm_P_25_m_old += 1;
                             $msm_rdt_25_m_old += 1;
                         }
                    }
                    if($risk_sub == "TG"){
                          if($rdt_result_1=="Negative" and $rdt_result =="Positive"){
                              $msm_P_25_m_old += 1;
                              $msm_rdt_25_m_old += 1;
                          }
                     }
                     if($risk_sub == "IDU"){
                           if($rdt_result_1=="Negative" and $rdt_result =="Positive"){
                               $idu_P_25_m_old += 1;
                               $idu_rdt_25_m_old += 1;
                           }
                      }
                 }
          }

          // Combination section

          $msm_P_14_m += $msm_P_14_m_old;  $msm_rdt_14_m += $msm_rdt_14_m_old;  $tg_rdt_14_m += $tg_rdt_14_m_old;  $tg_P_14_m += $tg_P_14_m_old;
          $msm_P_24_m += $msm_P_24_m_old;  $msm_rdt_24_m += $msm_rdt_24_m_old;  $tg_rdt_24_m += $tg_rdt_24_m_old;  $tg_P_24_m += $tg_P_24_m_old;
          $msm_P_25_m += $msm_P_25_m_old;  $msm_rdt_25_m += $msm_rdt_25_m_old;  $tg_rdt_25_m += $tg_rdt_25_m_old;  $tg_P_25_m += $tg_P_25_m_old;

          $idu_P_14_m += $idu_P_14_m_old;   $idu_rdt_14_m += $idu_rdt_14_m_old;
          $idu_P_24_m += $idu_P_24_m_old;   $idu_rdt_24_m += $idu_rdt_24_m_old;
          $idu_P_25_m += $idu_P_25_m_old;   $idu_rdt_25_m += $idu_rdt_25_m_old;
          // Combination End


    //Male ____other OI of Gono //////// Checking with Old Oi History in a calendar Year
    $G1_pri_syp_14=0;
    $rp_G1_sec_syp_14=0;          $rp_G1_chan_14=0;                 $rp_G1_gen_herpes_14=0;       $rp_G1_gen_scabies_14=0;        $rp_G1_gud_other_14=0;          $rp_G2_non_gono_ure_14=0;
    $rp_Gw_non_gono_cer_14=0;     $rp_G2_trichomonas_14=0;          $rp_G2_gen_candidiosis_14=0;  $rp_G2_beterial_vaginosis_14=0; $rp_G3_congenial_syphillis_14=0;
    $rp_G3_latent_syphillis_14=0; $rp_G3_molluscum_contag_14=0; $rp_G3_bubos_14=0;              $rp_G3_othstd_genital_warts_14=0;
    $rp_G3_ostd_other_14=0;
    $G1_pri_syp_24=0;
    $rp_G1_sec_syp_24=0;          $rp_G1_chan_24=0;                 $rp_G1_gen_herpes_24=0;       $rp_G1_gen_scabies_24=0;        $rp_G1_gud_other_24=0;          $rp_G2_non_gono_ure_24=0 ;
    $rp_Gw_non_gono_cer_24=0;     $rp_G2_trichomonas_24=0;          $rp_G2_gen_candidiosis_24=0;  $rp_G2_beterial_vaginosis_24=0; $rp_G3_congenial_syphillis_24=0;
    $rp_G3_latent_syphillis_24=0; $rp_G3_molluscum_contag_24=0; $rp_G3_bubos_24=0;              $rp_G3_othstd_genital_warts_24=0;
    $rp_G3_ostd_other_24=0;

    $G1_pri_syp_25=0;
    $rp_G1_sec_syp_25=0;          $rp_G1_chan_25=0;                   $rp_G1_gen_herpes_25=0;       $rp_G1_gen_scabies_25=0;        $rp_G1_gud_other_25=0;          $rp_G2_non_gono_ure_25=0 ;
    $rp_Gw_non_gono_cer_25=0;     $rp_G2_trichomonas_25=0;          $rp_G2_gen_candidiosis_25=0;  $rp_G2_beterial_vaginosis_25=0; $rp_G3_congenial_syphillis_25=0;
    $rp_G3_latent_syphillis_25=0; $rp_G3_molluscum_contag_25=0; $rp_G3_bubos_25=0;              $rp_G3_othstd_genital_warts_25=0;
    $rp_G3_ostd_other_25=0;

    $G1_pri_syp_14_new=0;
    $rp_G1_sec_syp_14_new=0;          $rp_G1_chan_14_new=0;                 $rp_G1_gen_herpes_14_new=0;       $rp_G1_gen_scabies_14_new=0;        $rp_G1_gud_other_14_new=0;          $rp_G2_non_gono_ure_14_new=0;
    $rp_Gw_non_gono_cer_14_new=0;     $rp_G2_trichomonas_14_new=0;          $rp_G2_gen_candidiosis_14_new=0;  $rp_G2_beterial_vaginosis_14_new=0; $rp_G3_congenial_syphillis_14_new=0;
    $rp_G3_latent_syphillis_14_new=0; $rp_G3_molluscum_contag_14_new=0; $rp_G3_bubos_14_new=0;              $rp_G3_othstd_genital_warts_14_new=0;
    $rp_G3_ostd_other_14_new=0;
    $G1_pri_syp_24_new=0;
    $rp_G1_sec_syp_24_new=0;          $rp_G1_chan_24_new=0;                 $rp_G1_gen_herpes_24_new=0;       $rp_G1_gen_scabies_24_new=0;        $rp_G1_gud_other_24_new=0;          $rp_G2_non_gono_ure_24_new=0 ;
    $rp_Gw_non_gono_cer_24_new=0;     $rp_G2_trichomonas_24_new=0;          $rp_G2_gen_candidiosis_24_new=0;  $rp_G2_beterial_vaginosis_24_new=0; $rp_G3_congenial_syphillis_24_new=0;
    $rp_G3_latent_syphillis_24_new=0; $rp_G3_molluscum_contag_24_new=0; $rp_G3_bubos_24_new=0;              $rp_G3_othstd_genital_warts_24_new=0;
    $rp_G3_ostd_other_24_new=0;

    $G1_pri_syp_25_new=0;
    $rp_G1_sec_syp_25_new=0;          $rp_G1_chan_25_new=0;                   $rp_G1_gen_herpes_25_new=0;       $rp_G1_gen_scabies_25_new=0;        $rp_G1_gud_other_25_new=0;          $rp_G2_non_gono_ure_25_new=0 ;
    $rp_Gw_non_gono_cer_25_new=0;     $rp_G2_trichomonas_25_new=0;          $rp_G2_gen_candidiosis_25_new=0;  $rp_G2_beterial_vaginosis_25_new=0; $rp_G3_congenial_syphillis_25_new=0;
    $rp_G3_latent_syphillis_25_new=0; $rp_G3_molluscum_contag_25_new=0; $rp_G3_bubos_25_new=0;              $rp_G3_othstd_genital_warts_25_new=0;
    $rp_G3_ostd_other_25_new=0;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $rp_newID = array();
    //$differID =  array_unique($differID);
    foreach ($differID as $key => $value) {
      $rp_newID[]=$value;
    }

    for ($i=0; $i <count($rp_newID) ; $i++) {
      $rp_ID_new = $rp_newID[$i];
      $rpMonth_New_Rows = Stimale::whereBetween('Visit date', [$from, $to])
                            ->orderBy('Visit date', 'desc')
                            ->where('CID',$rp_ID_new)
                            ->get();
                            $rp_Age = intval($rpMonth_New_Rows[0]['age']);
                            $rp_visitDate = intval($rpMonth_New_Rows[0]['Visit date']);

                            $rp_G1_pri_syp      = intval($rpMonth_New_Rows[0]['pri_syphillis']);
                            $rp_G1_sec_syp      = $rpMonth_New_Rows[0]['sec_syphillis'];
                            $rp_G1_chan         = $rpMonth_New_Rows[0]['chancroid'];
                            $rp_G1_gen_herpes   = $rpMonth_New_Rows[0]['gen_herpes'];
                            $rp_G1_gen_scabies  = $rpMonth_New_Rows[0]['gen_scabies'];
                            $rp_G1_gud_other    = $rpMonth_New_Rows[0]['gud_other'];

                            $rp_G2_non_gono_ure    = $rpMonth_New_Rows[0]['non_gono_urethritis'];
                            $rp_G2_non_gono_cer    = $rpMonth_New_Rows[0]['non_gono_cervities'];
                            $rp_G2_trichomonas     = $rpMonth_New_Rows[0]['trichomonas'];
                            $rp_G2_gen_candidiosis = $rpMonth_New_Rows[0]['genital_candidiosis'];

                            $rp_G3_congenial_syphillis  = $rpMonth_New_Rows[0]['congenial_syphillis'];
                            $rp_G3_latent_syphillis     = intval($rpMonth_New_Rows[0]['latent_syphillis']);

                            $rp_G3_molluscum_contag    = $rpMonth_New_Rows[0]['molluscum_contag'];
                            $rp_G3_bubos                = $rpMonth_New_Rows[0]['bubos'];
                            $rp_G3_othstd_genital_warts = $rpMonth_New_Rows[0]['othstd_genital_warts'];
                            $rp_G3_ostd_other           = $rpMonth_New_Rows[0]['ostd_other'];

                            if($rp_Age<15){
                                if($rp_G1_pri_syp == 1){
                                    $G1_pri_syp_14_new += 1;
                                }
                                if($rp_G1_sec_syp == 1){
                                  $rp_G1_sec_syp_14_new += 1;
                                }
                                if($rp_G1_chan == 1){
                                  $rp_G1_chan_14_new += 1;
                                }
                                if($rp_G1_gen_herpes == 1){
                                  $rp_G1_gen_herpes_14_new +=1 ;
                                }
                                if($rp_G1_gen_scabies == 1){
                                  $rp_G1_gen_scabies_14_new +=1;
                                }
                                if($rp_G1_gud_other == 1){
                                  $rp_G1_gud_other_14_new += 1;
                                }
                                if($rp_G2_non_gono_ure==1){
                                  $rp_G2_non_gono_ure_14_new += 1;
                                }
                                if($rp_G2_non_gono_cer==1){
                                  $rp_Gw_non_gono_cer_14_new += 1;
                                }
                                if($rp_G2_trichomonas == 1){
                                  $rp_G2_trichomonas_14_new += 1 ;
                                }
                                if($rp_G2_gen_candidiosis == 1){
                                  $rp_G2_gen_candidiosis_14_new += 1;
                                }
                                if($rp_G3_congenial_syphillis == 1){
                                  $rp_G3_congenial_syphillis_14_new += 1 ;
                                }
                                if($rp_G3_latent_syphillis == 1){
                                  $rp_G3_latent_syphillis_14_new += 1;
                                }
                                if($rp_G3_molluscum_contag==1){
                                  $rp_G3_molluscum_contag_14_new += 1;
                                }
                                if($rp_G3_bubos == 1){
                                  $rp_G3_bubos_14_new += 1 ;
                                }
                                if($rp_G3_othstd_genital_warts == 1){
                                  $rp_G3_othstd_genital_warts_14_new += 1 ;
                                }
                                if($rp_G3_ostd_other == 1){
                                  $rp_G3_ostd_other_14_new += 1;
                                }
                            }/// end of age under 15
                            if($rp_Age>=15 and $rp_Age<25){
                                if($rp_G1_pri_syp == 1){
                                    $G1_pri_syp_24_new += 1;
                                }
                                if($rp_G1_sec_syp == 1){
                                  $rp_G1_sec_syp_24_new += 1;
                                }
                                if($rp_G1_chan == 1){
                                  $rp_G1_chan_24_new += 1;
                                }
                                if($rp_G1_gen_herpes == 1){
                                  $rp_G1_gen_herpes_24_new +=1 ;
                                }
                                if($rp_G1_gen_scabies == 1){
                                  $rp_G1_gen_scabies_24_new +=1;
                                }
                                if($rp_G1_gud_other == 1){
                                  $rp_G1_gud_other_24_new += 1;
                                }
                                if($rp_G2_non_gono_ure==1){
                                  $rp_G2_non_gono_ure_24_new += 1;
                                }
                                if($rp_G2_non_gono_cer==1){
                                  $rp_Gw_non_gono_cer_24_new += 1;
                                }
                                if($rp_G2_trichomonas == 1){
                                  $rp_G2_trichomonas_24_new += 1 ;
                                }
                                if($rp_G2_gen_candidiosis == 1){
                                  $rp_G2_gen_candidiosis_24_new += 1;
                                }
                                if($rp_G3_congenial_syphillis == 1){
                                  $rp_G3_congenial_syphillis_24_new += 1 ;
                                }
                                if($rp_G3_latent_syphillis == 1){
                                  $rp_G3_latent_syphillis_24_new += 1;
                                }
                                if($rp_G3_molluscum_contag==1){
                                  $rp_G3_molluscum_contag_24_new += 1;
                                }
                                if($rp_G3_bubos == 1){
                                  $rp_G3_bubos_24_new += 1 ;
                                }
                                if($rp_G3_othstd_genital_warts == 1){
                                  $rp_G3_othstd_genital_warts_24_new += 1 ;
                                }
                                if($rp_G3_ostd_other == 1){
                                  $rp_G3_ostd_other_24_new += 1;
                                }
                            }
                            if($rp_Age>25){
                                if($rp_G1_pri_syp == 1){
                                    $G1_pri_syp_25_new += 1;
                                }
                                if($rp_G1_sec_syp == 1){
                                  $rp_G1_sec_syp_25_new += 1;
                                }
                                if($rp_G1_chan == 1){
                                  $rp_G1_chan_25_new += 1;
                                }
                                if($rp_G1_gen_herpes == 1){
                                  $rp_G1_gen_herpes_25_new +=1 ;
                                }
                                if($rp_G1_gen_scabies == 1){
                                  $rp_G1_gen_scabies_25_new +=1;
                                }
                                if($rp_G1_gud_other == 1){
                                  $rp_G1_gud_other_25_new += 1;
                                }
                                if($rp_G2_non_gono_ure==1){
                                  $rp_G2_non_gono_ure_25_new += 1;
                                }
                                if($rp_G2_non_gono_cer==1){
                                  $rp_Gw_non_gono_cer_25_new += 1;
                                }
                                if($rp_G2_trichomonas == 1){
                                  $rp_G2_trichomonas_25_new += 1 ;
                                }
                                if($rp_G2_gen_candidiosis == 1){
                                  $rp_G2_gen_candidiosis_25_new += 1;
                                }
                                if($rp_G3_congenial_syphillis == 1){
                                  $rp_G3_congenial_syphillis_25_new += 1 ;
                                }
                                if($rp_G3_latent_syphillis == 1){
                                  $rp_G3_latent_syphillis_25_new += 1;
                                }
                                if($rp_G3_molluscum_contag==1){
                                  $rp_G3_molluscum_contag_25_new += 1;
                                }
                                if($rp_G3_bubos == 1){
                                  $rp_G3_bubos_25_new += 1 ;
                                }
                                if($rp_G3_othstd_genital_warts == 1){
                                  $rp_G3_othstd_genital_warts_25_new += 1 ;
                                }
                                if($rp_G3_ostd_other == 1){
                                  $rp_G3_ostd_other_25_new += 1;
                                }

                            }

    }
    // Old Connected data////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    $needyID = array();
    $intersectID =  array_unique($intersectID);
    foreach ($intersectID as $key => $value) {
      $needyID[]=$value;
    }

    for ($i=0; $i <count($needyID) ; $i++) { // without duplicate ID
        $rpID = $needyID[$i];
        $rpMonth_Rows = Stimale::whereBetween('Visit date', [$from, $to])
                              ->orderBy('Visit date', 'desc')
                              ->where('CID',$rpID)
                              ->get();
        $rp_Age = intval($rpMonth_Rows[0]['age']);
        $rp_visitDate = intval($rpMonth_Rows[0]['Visit date']);

        $rp_G1_pri_syp      = intval($rpMonth_Rows[0]['pri_syphillis']);
        $rp_G1_sec_syp      = $rpMonth_Rows[0]['sec_syphillis'];
        $rp_G1_chan         = $rpMonth_Rows[0]['chancroid'];
        $rp_G1_gen_herpes   = $rpMonth_Rows[0]['gen_herpes'];
        $rp_G1_gen_scabies  = $rpMonth_Rows[0]['gen_scabies'];
        $rp_G1_gud_other    = $rpMonth_Rows[0]['gud_other'];

        $rp_G2_non_gono_ure    = $rpMonth_Rows[0]['non_gono_urethritis'];
        $rp_G2_non_gono_cer    = $rpMonth_Rows[0]['non_gono_cervities'];
        $rp_G2_trichomonas     = $rpMonth_Rows[0]['trichomonas'];
        $rp_G2_gen_candidiosis = $rpMonth_Rows[0]['genital_candidiosis'];

        $rp_G3_congenial_syphillis  = $rpMonth_Rows[0]['congenial_syphillis'];
        $rp_G3_latent_syphillis     = intval($rpMonth_Rows[0]['latent_syphillis']);

        $rp_G3_molluscum_contag    = $rpMonth_Rows[0]['molluscum_contag'];
        $rp_G3_bubos                = $rpMonth_Rows[0]['bubos'];
        $rp_G3_othstd_genital_warts = $rpMonth_Rows[0]['othstd_genital_warts'];
        $rp_G3_ostd_other           = $rpMonth_Rows[0]['ostd_other'];

        $old_pt_rows = Stimale::whereBetween('Visit date', [$from_ck_new_old, $to_ck_new_old])
                                ->orderBy('Visit date', 'desc')
                                ->where('CID',$rpID)
                                ->get();
             //////////////////////////////////////////////////////////
             if($rp_Age<15){
               if($rp_G1_pri_syp    != intval($old_pt_rows[0]['pri_syphillis'])){
                 if($rp_G1_pri_syp == 1){
                     $G1_pri_syp_14 += 1;
                 }
               }
               if($rp_G1_sec_syp    != intval($old_pt_rows[0]['sec_syphillis'])){
                 if($rp_G1_sec_syp == 1){
                   $rp_G1_sec_syp_14 += 1;
                 }
               }
               if($rp_G1_chan       != intval($old_pt_rows[0]['chancroid'])){
                 if($rp_G1_chan == 1){
                   $rp_G1_chan_14 += 1;
                 }
               }
               if($rp_G1_gen_herpes != intval($old_pt_rows[0]['gen_herpes'])){
                 if($rp_G1_gen_herpes == 1){
                   $rp_G1_gen_herpes_14 +=1 ;
                 }
               }
               if($rp_G1_gen_scabies!= intval($old_pt_rows[0]['gen_scabies'])){
                 if($rp_G1_gen_scabies == 1){
                   $rp_G1_gen_scabies_14 +=1;
                 }
               }
               if($rp_G1_gud_other  != intval($old_pt_rows[0]['gud_other'])){
                 if($rp_G1_gud_other == 1){
                   $rp_G1_gud_other_14 += 1;
                 }
               }

               if($rp_G2_non_gono_ure       != intval($old_pt_rows[0]['non_gono_urethritis'])){
                 if($rp_G2_non_gono_ure==1){
                   $rp_G2_non_gono_ure_14 += 1;
                 }
               }
               if($rp_G2_non_gono_cer       != intval($old_pt_rows[0]['non_gono_cervities'])){
                 if($rp_G2_non_gono_cer==1){
                   $rp_Gw_non_gono_cer_14 += 1;
                 }
               }
               if($rp_G2_trichomonas        != intval($old_pt_rows[0]['trichomonas'])){
                 if($rp_G2_trichomonas == 1){
                   $rp_G2_trichomonas_14 += 1 ;
                 }
               }
               if($rp_G2_gen_candidiosis    != intval($old_pt_rows[0]['genital_candidiosis'])){
                 if($rp_G2_gen_candidiosis == 1){
                   $rp_G2_gen_candidiosis_14 += 1;
                 }
               }

               if($rp_G3_congenial_syphillis  != intval($old_pt_rows[0]['congenial_syphillis'] )){
                 if($rp_G3_congenial_syphillis == 1){
                   $rp_G3_congenial_syphillis_14 += 1 ;
                 }
               }
               if($rp_G3_latent_syphillis     != intval($old_pt_rows[0]['latent_syphillis'])){
                 if($rp_G3_latent_syphillis == 1){
                   $rp_G3_latent_syphillis_14 += 1;
                 }
               }

               if($rp_G3_molluscum_contag     != intval($old_pt_rows[0]['molluscum_contag'] )){
                 if($rp_G3_molluscum_contag==1){
                   $rp_G3_molluscum_contag_14 += 1;
                 }
               }
               if($rp_G3_bubos                != intval($old_pt_rows[0]['bubos'])){
                 if($rp_G3_bubos == 1){
                   $rp_G3_bubos_14 += 1 ;
                 }
               }
               if($rp_G3_othstd_genital_warts != intval($old_pt_rows[0]['othstd_genital_warts'])){
                 if($rp_G3_othstd_genital_warts == 1){
                   $rp_G3_othstd_genital_warts_14 += 1 ;
                 }
               }
               if($rp_G3_ostd_other           != intval($old_pt_rows[0]['ostd_other'])){
                 if($rp_G3_ostd_other == 1){
                   $rp_G3_ostd_other_14 += 1;
                 }
               }
             }/// end of age under 15
             if($rp_Age>=15 and $rp_Age<25){
               if($rp_G1_pri_syp    != intval($old_pt_rows[0]['pri_syphillis'])){
                 if($rp_G1_pri_syp == 1){
                     $G1_pri_syp_24 += 1;
                 }
               }
               if($rp_G1_sec_syp    != intval($old_pt_rows[0]['sec_syphillis'])){
                 if($rp_G1_sec_syp == 1){
                   $rp_G1_sec_syp_24 += 1;
                 }
               }
               if($rp_G1_chan       != intval($old_pt_rows[0]['chancroid'])){
                 if($rp_G1_chan == 1){
                   $rp_G1_chan_24 += 1;
                 }
               }
               if($rp_G1_gen_herpes != intval($old_pt_rows[0]['gen_herpes'])){
                 if($rp_G1_gen_herpes == 1){
                   $rp_G1_gen_herpes_24 +=1 ;
                 }
               }
               if($rp_G1_gen_scabies!= intval($old_pt_rows[0]['gen_scabies'])){
                 if($rp_G1_gen_scabies == 1){
                   $rp_G1_gen_scabies_24 +=1;
                 }
               }
               if($rp_G1_gud_other  != intval($old_pt_rows[0]['gud_other'])){
                 if($rp_G1_gud_other == 1){
                   $rp_G1_gud_other_24 += 1;
                 }
               }

               if($rp_G2_non_gono_ure       != intval($old_pt_rows[0]['non_gono_urethritis'])){
                 if($rp_G2_non_gono_ure==1){
                   $rp_G2_non_gono_ure_24 += 1;
                 }
               }
               if($rp_G2_non_gono_cer       != intval($old_pt_rows[0]['non_gono_cervities'])){
                 if($rp_G2_non_gono_cer==1){
                   $rp_Gw_non_gono_cer_24 += 1;
                 }
               }
               if($rp_G2_trichomonas        != intval($old_pt_rows[0]['trichomonas'])){
                 if($rp_G2_trichomonas == 1){
                   $rp_G2_trichomonas_24 += 1 ;
                 }
               }
               if($rp_G2_gen_candidiosis    != intval($old_pt_rows[0]['genital_candidiosis'])){
                 if($rp_G2_gen_candidiosis == 1){
                   $rp_G2_gen_candidiosis_24 += 1;
                 }
               }

               if($rp_G3_congenial_syphillis    != intval($old_pt_rows[0]['congenial_syphillis'])){
                 if($rp_G3_congenial_syphillis == 1){
                   $rp_G3_congenial_syphillis_24 += 1 ;
                 }
               }
               if($rp_G3_latent_syphillis       != intval($old_pt_rows[0]['latent_syphillis'])){
                 if($rp_G3_latent_syphillis == 1){
                   $rp_G3_latent_syphillis_24 += 1;
                 }
               }

               if($rp_G3_molluscum_contag       != intval($old_pt_rows[0]['molluscum_contag'])){
                 if($rp_G3_molluscum_contag==1){
                   $rp_G3_molluscum_contag_24 += 1;
                 }
               }
               if($rp_G3_bubos                  != intval($old_pt_rows[0]['bubos'])){
                 if($rp_G3_bubos == 1){
                   $rp_G3_bubos_24 += 1 ;
                 }
               }
               if($rp_G3_othstd_genital_warts   != intval($old_pt_rows[0]['othstd_genital_warts'])){
                 if($rp_G3_othstd_genital_warts == 1){
                   $rp_G3_othstd_genital_warts_24 += 1 ;
                 }
               }
               if($rp_G3_ostd_other             != intval($old_pt_rows[0]['ostd_other'])){
                 if($rp_G3_ostd_other == 1){
                   $rp_G3_ostd_other_24 += 1;
                 }
               }
             }
             if($rp_Age>25){
               if($rp_G1_pri_syp <> $old_pt_rows[0]['pri_syphillis']){
                 if($rp_G1_pri_syp == 1){
                     $G1_pri_syp_25 += 1;
                 }
               }
               if($rp_G1_sec_syp <> $old_pt_rows[0]['sec_syphillis']){
                 if($rp_G1_sec_syp == 1){
                   $rp_G1_sec_syp_25 += 1;
                 }
               }
               if($rp_G1_chan <> $old_pt_rows[0]['chancroid']){
                 if($rp_G1_chan == 1){
                   $rp_G1_chan_25 += 1;
                 }
               }
               if($rp_G1_gen_herpes <> $old_pt_rows[0]['gen_herpes']){
                 if($rp_G1_gen_herpes == 1){
                   $rp_G1_gen_herpes_25 +=1 ;
                 }
               }
               if($rp_G1_gen_scabies<> $old_pt_rows[0]['gen_scabies']){
                 if($rp_G1_gen_scabies == 1){
                   $rp_G1_gen_scabies_25 +=1;
                 }
               }
               if($rp_G1_gud_other <> $old_pt_rows[0]['gud_other']){
                 if($rp_G1_gud_other == 1){
                   $rp_G1_gud_other_25 += 1;
                 }
               }

               if($rp_G2_non_gono_ure  <> $old_pt_rows[0]['non_gono_urethritis']){
                 if($rp_G2_non_gono_ure==1){
                   $rp_G2_non_gono_ure_25 += 1;
                 }
               }
               if($rp_G2_non_gono_cer  <> $old_pt_rows[0]['non_gono_cervities']){
                 if($rp_G2_non_gono_cer==1){
                   $rp_Gw_non_gono_cer_25 += 1;
                 }
               }
               if($rp_G2_trichomonas <> $old_pt_rows[0]['trichomonas']){
                 if($rp_G2_trichomonas == 1){
                   $rp_G2_trichomonas_25 += 1 ;
                 }
               }
               if($rp_G2_gen_candidiosis <> $old_pt_rows[0]['genital_candidiosis']){
                 if($rp_G2_gen_candidiosis == 1){
                   $rp_G2_gen_candidiosis_25 += 1;
                 }
               }
               if($rp_G3_congenial_syphillis <> $old_pt_rows[0]['congenial_syphillis']){
                 if($rp_G3_congenial_syphillis == 1){
                   $rp_G3_congenial_syphillis_25 += 1 ;
                 }
               }
               if($rp_G3_latent_syphillis <> $old_pt_rows[0]['latent_syphillis']){
                 if($rp_G3_latent_syphillis == 1){
                   $rp_G3_latent_syphillis_25 += 1;
                 }
               }

               if($rp_G3_molluscum_contag <> $old_pt_rows[0]['molluscum_contag'] ){
                 if($rp_G3_molluscum_contag==1){
                   $rp_G3_molluscum_contag_25 += 1;
                 }
               }
               if($rp_G3_bubos <> $old_pt_rows[0]['bubos']){
                 if($rp_G3_bubos == 1){
                   $rp_G3_bubos_25 += 1 ;
                 }
               }
               if($rp_G3_othstd_genital_warts <> $old_pt_rows[0]['othstd_genital_warts']){
                 if($rp_G3_othstd_genital_warts == 1){
                   $rp_G3_othstd_genital_warts_25 += 1 ;
                 }
               }
               if($rp_G3_ostd_other <> $old_pt_rows[0]['ostd_other']){
                 if($rp_G3_ostd_other == 1){
                   $rp_G3_ostd_other_25 += 1;
                 }
               }
             }
      }
    ////////////////////Female /////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////
    $rp_month_f =Stifemale::whereBetween('Visit date', [$from, $to])->get();
    $old_month_f= Stifemale::whereBetween('Visit date', [$from_ck_new_old, $to_ck_new_old])->get();
    $rp_month_ID_f =array();
    for ($i=0; $i <count($rp_month_f) ; $i++) {
      $rp_month_ID_f[]=intval($rp_month_f[$i]['CID']); // this is report month's all ID
    }

    $rp_monthID_unique_f= array();
    foreach ($rp_month_ID_f as $key => $value) {
      $rp_monthID_unique_f[]=$value;
    }

    $old_month_ID_f = array();
    for ($i=0; $i <count($old_month_f) ; $i++) {
      $old_month_ID_f[]= $old_month_f[$i]['CID']; // this is old month's all ID before report Month ID
    }
    $intersectID_f = array_intersect($rp_month_ID_f,$old_month_ID_f);
    $differID_a = array_diff($rp_month_ID_f,$old_month_ID_f);
    $differID_b = array_diff($old_month_ID_f,$rp_month_ID_f);
    $differID_f = array_merge($differID_a,$differID_b);// this is differend ID between report Month and Old months

    // For Gonorrhea Only Female
    $gono_14_f=0;$gono_24_f=0;$gono_25_f=0;

    for ($i=0; $i <count($rp_monthID_unique_f) ; $i++) {

      $rp_ID_Unique = $rp_monthID_unique_f[$i];// Unique ID from report Month

      $rp_pt_rows = Stifemale::whereBetween('Visit date', [$from, $to])
                            ->orderBy('Visit date')
                            ->where('CID',$rp_ID_Unique)
                            ->get();
      $countGono = count($rp_pt_rows);
      if($countGono>0){
        if($countGono==1){
            $rpMonthAge = intval($rp_pt_rows[0]['age']);
            $rpMonthGono = intval($rp_pt_rows[0]['Gonorhoea']);
                if($rpMonthAge < 15 ){
                  if($rpMonthGono == 1){
                    $gono_14_f +=1;
                  }
                }
                if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                  if($rpMonthGono == 1){
                    $gono_24_f +=1;
                  }
                }
                if($rpMonthAge >= 25 ){
                  if($rpMonthGono == 1){
                    $gono_25_f +=1;
                  }
                }
      }

        if($countGono  == 2){/// duplicate id
        $gonoArray = array();
        for ($a=0; $a < $countGono ; $a++) {

        $rpMonthAge = intval($rp_pt_rows[$a]['age']);
        $gonoArray[] = intval($rp_pt_rows[$a]['Gonorhoea']);
      }
        if($gonoArray[0]==1 and $gonoArray[1]==1){
            if($rpMonthAge < 15 ){
                $gono_14_f +=1;
            }
            if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                $gono_24_m +=1;
            }
            if($rpMonthAge >= 25 ){
                $gono_25_m +=1;
            }
        }
        if($gonoArray[0]==2 and $gonoArray[1]==1){
            if($rpMonthAge < 15 ){
                $gono_14_f +=1;
            }
            if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                $gono_24_m +=1;
            }
            if($rpMonthAge >= 25 ){
                $gono_25_m +=1;
            }
        }
      }
      if($countGono ==3){
        if($gonoArray[0]==2 and $gonoArray[1]==2 and $gonoArray==1){
            if($rpMonthAge < 15 ){
                $gono_14_f +=1;
            }
            if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                $gono_24_f +=1;
            }
            if($rpMonthAge >= 25 ){
                $gono_25_f +=1;
            }
        }
        if($gonoArray[0]==1 and $gonoArray[1]==2 and $gonoArray==1){
            if($rpMonthAge < 15 ){
                $gono_14_f +=1;
            }
            if($rpMonthAge >=15 and $rpMonthAge < 25 ){
                $gono_24_f +=1;
            }
            if($rpMonthAge >= 25 ){
                $gono_25_f +=1;
            }
        }
      }
      }
    }
      ////////////////End _ of _Gono _ female _////////////////////////////////////////////////////////

      //female ____other OI of Gono //////// Checking with Old Oi History in a calendar Year
      $G1_pri_syp_14_f=0;
      $rp_G1_sec_syp_14_f=0;          $rp_G1_chan_14_f=0;                 $rp_G1_gen_herpes_14_f=0;       $rp_G1_gen_scabies_14_f=0;        $rp_G1_gud_other_14_f=0;          $rp_G2_non_gono_ure_14_f=0;
      $rp_Gw_non_gono_cer_14_f=0;     $rp_G2_trichomonas_14_f=0;          $rp_G2_gen_candidiosis_14_f=0;  $rp_G2_beterial_vaginosis_14_f=0; $rp_G3_congenial_syphillis_14_f=0;
      $rp_G3_latent_syphillis_14_f=0; $rp_G3_latent_syphillis_preg_14_pp_f=0;$rp_G3_molluscum_contag_14_f=0; $rp_G3_bubos_14_f=0;              $rp_G3_othstd_genital_warts_14_f=0;
      $rp_G3_ostd_other_14_f=0;       $rp_G3_latent_syphillis_preg_14_mp_f=0;
      $G1_pri_syp_24_f=0;
      $rp_G1_sec_syp_24_f=0;          $rp_G1_chan_24_f=0;                 $rp_G1_gen_herpes_24_f=0;       $rp_G1_gen_scabies_24_f=0;        $rp_G1_gud_other_24_f=0;          $rp_G2_non_gono_ure_24_f=0 ;
      $rp_Gw_non_gono_cer_24_f=0;     $rp_G2_trichomonas_24_f=0;          $rp_G2_gen_candidiosis_24_f=0;  $rp_G2_beterial_vaginosis_24_f=0; $rp_G3_congenial_syphillis_24_f=0;
      $rp_G3_latent_syphillis_24_f=0; $rp_G3_latent_syphillis_preg_24_pp_f=0;$rp_G3_molluscum_contag_24_f=0; $rp_G3_bubos_24_f=0;              $rp_G3_othstd_genital_warts_24_f=0;
      $rp_G3_ostd_other_24_f=0;       $rp_G3_latent_syphillis_preg_24_mp_f=0;
      $G1_pri_syp_25_f=0;
      $rp_G1_sec_syp_25_f=0;          $rp_G1_chan_25_f=0;                   $rp_G1_gen_herpes_25_f=0;       $rp_G1_gen_scabies_25_f=0;        $rp_G1_gud_other_25_f=0;          $rp_G2_non_gono_ure_25_f=0 ;
      $rp_Gw_non_gono_cer_25_f=0;     $rp_G2_trichomonas_25_f=0;          $rp_G2_gen_candidiosis_25_f=0;  $rp_G2_beterial_vaginosis_25_f=0; $rp_G3_congenial_syphillis_25_f=0;
      $rp_G3_latent_syphillis_25_f=0; $rp_G3_latent_syphillis_preg_25_pp_f=0;$rp_G3_molluscum_contag_25_f=0; $rp_G3_bubos_25_f=0;              $rp_G3_othstd_genital_warts_25_f=0;
      $rp_G3_ostd_other_25_f=0;       $rp_G3_latent_syphillis_preg_25_mp_f=0;

      $G1_pri_syp_14_f_new=0;
      $rp_G1_sec_syp_14_f_new=0;          $rp_G1_chan_14_f_new=0;                 $rp_G1_gen_herpes_14_f_new=0;       $rp_G1_gen_scabies_14_f_new=0;        $rp_G1_gud_other_14_f_new=0;          $rp_G2_non_gono_ure_14_f_new=0;
      $rp_Gw_non_gono_cer_14_f_new=0;     $rp_G2_trichomonas_14_f_new=0;          $rp_G2_gen_candidiosis_14_f_new=0;  $rp_G2_beterial_vaginosis_14_f_new=0; $rp_G3_congenial_syphillis_14_f_new=0;
      $rp_G3_latent_syphillis_14_f_new=0; $rp_G3_latent_syphillis_preg_14_pp_f_new=0;$rp_G3_molluscum_contag_14_f_new=0; $rp_G3_bubos_14_f_new=0;              $rp_G3_othstd_genital_warts_14_f_new=0;
      $rp_G3_ostd_other_14_f_new=0;       $rp_G3_latent_syphillis_preg_14_mp_f_new=0;
      $G1_pri_syp_24_f_new=0;
      $rp_G1_sec_syp_24_f_new=0;          $rp_G1_chan_24_f_new=0;                 $rp_G1_gen_herpes_24_f_new=0;       $rp_G1_gen_scabies_24_f_new=0;        $rp_G1_gud_other_24_f_new=0;          $rp_G2_non_gono_ure_24_f_new=0 ;
      $rp_Gw_non_gono_cer_24_f_new=0;     $rp_G2_trichomonas_24_f_new=0;          $rp_G2_gen_candidiosis_24_f_new=0;  $rp_G2_beterial_vaginosis_24_f_new=0; $rp_G3_congenial_syphillis_24_f_new=0;
      $rp_G3_latent_syphillis_24_f_new=0; $rp_G3_latent_syphillis_preg_24_pp_f_new=0;$rp_G3_molluscum_contag_24_f_new=0; $rp_G3_bubos_24_f_new=0;              $rp_G3_othstd_genital_warts_24_f_new=0;
      $rp_G3_ostd_other_24_f_new=0;       $rp_G3_latent_syphillis_preg_24_mp_f_new=0;
      $G1_pri_syp_25_f_new=0;
      $rp_G1_sec_syp_25_f_new=0;          $rp_G1_chan_25_f_new=0;                   $rp_G1_gen_herpes_25_f_new=0;       $rp_G1_gen_scabies_25_f_new=0;        $rp_G1_gud_other_25_f_new=0;          $rp_G2_non_gono_ure_25_f_new=0 ;
      $rp_Gw_non_gono_cer_25_f_new=0;     $rp_G2_trichomonas_25_f_new=0;          $rp_G2_gen_candidiosis_25_f_new=0;  $rp_G2_beterial_vaginosis_25_f_new=0; $rp_G3_congenial_syphillis_25_f_new=0;
      $rp_G3_latent_syphillis_25_f_new=0; $rp_G3_latent_syphillis_preg_25_pp_f_new=0;$rp_G3_molluscum_contag_25_f_new=0; $rp_G3_bubos_25_f_new=0;              $rp_G3_othstd_genital_warts_25_f_new=0;
      $rp_G3_ostd_other_25_f_new=0;       $rp_G3_latent_syphillis_preg_25_mp_f_new=0;


      for ($i=0; $i <count($rp_month_f) ; $i++) { // without duplicate ID
          $rpID = $rp_month_f[$i]['CID'];
          $rp_Age = intval($rp_month_f[$i]['age']);

          $rp_G1_pri_syp      = intval($rp_month_f[$i]['pri_syphillis']);
          $rp_G1_sec_syp      = $rp_month_f[$i]['sec_syphillis'];
          $rp_G1_chan         = $rp_month_f[$i]['chancroid'];
          $rp_G1_gen_herpes   = $rp_month_f[$i]['gen_herpes'];
          $rp_G1_gen_scabies  = $rp_month_f[$i]['gen_scabies'];
          $rp_G1_gud_other    = $rp_month_f[$i]['gud_other'];

          $rp_G2_non_gono_ure    = $rp_month_f[$i]['non_gono_urethritis'];
          $rp_G2_non_gono_cer    = $rp_month_f[$i]['non_gono_cervities'];
          $rp_G2_trichomonas     = $rp_month_f[$i]['trichomonas'];
          $rp_G2_gen_candidiosis = $rp_month_f[$i]['genital_candidiosis'];
          $rp_G2_beterial_vaginosis= $rp_month_f[$i]['beterial_vaginosis'];

          $rp_G3_congenial_syphillis  = $rp_month_f[$i]['congenial_syphillis'];
          $rp_G3_latent_syphillis     = $rp_month_f[$i]['latent_syphillis'];
          $rp_G3_latent_syphillis_preg= $rp_month_f[$i]['latent_syphillis_preg'];
          $rp_G3_lat_syp_preg_pp_mp =   $rp_month_f[$i]['risk_factor'];
          $rp_G3_molluscum_contag   =   $rp_month_f[$i]['molluscum_contag'];
          $rp_G3_bubos                = $rp_month_f[$i]['bubos'];
          $rp_G3_othstd_genital_warts = $rp_month_f[$i]['othstd_genital_warts'];
          $rp_G3_ostd_other           = $rp_month_f[$i]['ostd_other'];

          $old_pt_rows = Stifemale::whereBetween('Visit date', [$from_ck_new_old, $to_ck_new_old])
                                ->where('CID',$rpID)
                                ->get();
          $counter0 = count($old_pt_rows);

         if($counter0 > 0){
              $old_visitDate= array();
               for ($a=0; $a <count($old_pt_rows) ; $a++) {
                  $old_visitDate[] = $old_pt_rows[$a]['Visit date'];
               }
                  rsort($old_visitDate);
                   $old_final_date = $old_visitDate[0];// Final date here

                for ($b=0; $b <count($old_pt_rows); $b++){
                  if($old_final_date == $old_pt_rows[$b]['Visit date']){
                   $old_final_row = $old_pt_rows[$b]; // This is final row to match with report month data
                 }
               }
               if($rp_Age<15){
                 if($rp_G1_pri_syp    != intval($old_final_row['pri_syphillis'])){
                   if($rp_G1_pri_syp == 1){
                       $G1_pri_syp_14_f += 1;
                   }
                 }
                 if($rp_G1_sec_syp    != intval($old_final_row['sec_syphillis'])){
                   if($rp_G1_sec_syp == 1){
                     $rp_G1_sec_syp_14_f += 1;
                   }
                 }
                 if($rp_G1_chan       != intval($old_final_row['chancroid'])){
                   if($rp_G1_chan == 1){
                     $rp_G1_chan_14_f += 1;
                   }
                 }
                 if($rp_G1_gen_herpes != intval($old_final_row['gen_herpes'])){
                   if($rp_G1_gen_herpes == 1){
                     $rp_G1_gen_herpes_14_f +=1 ;
                   }
                 }
                 if($rp_G1_gen_scabies!= intval($old_final_row['gen_scabies'])){
                   if($rp_G1_gen_scabies == 1){
                     $rp_G1_gen_scabies_14_f +=1;
                   }
                 }
                 if($rp_G1_gud_other  != intval($old_final_row['gud_other'])){
                   if($rp_G1_gud_other == 1){
                     $rp_G1_gud_other_14_f += 1;
                   }
                 }

                 if($rp_G2_non_gono_ure       != intval($old_final_row['non_gono_urethritis'])){
                   if($rp_G2_non_gono_ure==1){
                     $rp_G2_non_gono_ure_14_f += 1;
                   }
                 }
                 if($rp_G2_non_gono_cer       != intval($old_final_row['non_gono_cervities'])){
                   if($rp_G2_non_gono_cer==1){
                     $rp_Gw_non_gono_ure_14_f += 1;//Combination of two variables
                   }
                 }
                 if($rp_G2_trichomonas        != intval($old_final_row['trichomonas'])){
                   if($rp_G2_trichomonas == 1){
                     $rp_G2_trichomonas_14_f += 1 ;
                   }
                 }
                 if($rp_G2_gen_candidiosis    != intval($old_final_row['genital_candidiosis'])){
                   if($rp_G2_gen_candidiosis == 1){
                     $rp_G2_gen_candidiosis_14_f += 1;
                   }
                 }
                 if($rp_G2_beterial_vaginosis != intval($old_final_row['beterial_vaginosis'])){
                  if($rp_G2_beterial_vaginosis == 1){
                    $rp_G2_beterial_vaginosis_14_f += 1;
                  }
                 }

                 if($rp_G3_congenial_syphillis  != intval($old_final_row['congenial_syphillis']) ){
                   if($rp_G3_congenial_syphillis == 1){
                     $rp_G3_congenial_syphillis_14_f += 1 ;
                   }
                 }
                 if($rp_G3_latent_syphillis     != intval($old_final_row['latent_syphillis'])){
                   if($rp_G3_latent_syphillis == 1){
                     $rp_G3_latent_syphillis_14_f += 1;
                   }
                 }
                 if($rp_G3_latent_syphillis_preg!= intval($old_final_row['latent_syphillis_preg'])){
                   if($rp_G3_latent_syphillis_preg == 1){
                     if($rp_G3_lat_syp_preg_pp_mp == "ANC_PP"){
                        $rp_G3_latent_syphillis_preg_14_pp_f += 1;
                     }
                     if($rp_G3_lat_syp_preg_pp_mp == "ANC_MP"){
                        $rp_G3_latent_syphillis_preg_14_mp_f += 1;
                     }
                   }
                 }
                 if($rp_G3_molluscum_contag     != intval($old_final_row['molluscum_contag']) ){
                   if($rp_G3_molluscum_contag==1){
                     $rp_G3_molluscum_contag_14_f += 1;
                   }
                 }
                 if($rp_G3_bubos                != intval($old_final_row['bubos'])){
                   if($rp_G3_bubos == 1){
                     $rp_G3_bubos_14_f += 1 ;
                   }
                 }
                 if($rp_G3_othstd_genital_warts != intval($old_final_row['othstd_genital_warts'])){
                   if($rp_G3_othstd_genital_warts == 1){
                     $rp_G3_othstd_genital_warts_14_f += 1 ;
                   }
                 }
                 if($rp_G3_ostd_other           != intval($old_final_row['ostd_other'])){
                   if($rp_G3_ostd_other == 1){
                     $rp_G3_ostd_other_14_f += 1;
                   }
                 }
               }/// end of age under 15
               if($rp_Age>=15 and $rp_Age<25){
                 if($rp_G1_pri_syp    != intval($old_final_row['pri_syphillis'])){
                   if($rp_G1_pri_syp == 1){
                       $G1_pri_syp_24_f += 1;
                   }
                 }
                 if($rp_G1_sec_syp    != intval($old_final_row['sec_syphillis'])){
                   if($rp_G1_sec_syp == 1){
                     $rp_G1_sec_syp_24_f += 1;
                   }
                 }
                 if($rp_G1_chan       != intval($old_final_row['chancroid'])){
                   if($rp_G1_chan == 1){
                     $rp_G1_chan_24_f += 1;
                   }
                 }
                 if($rp_G1_gen_herpes != intval($old_final_row['gen_herpes'])){
                   if($rp_G1_gen_herpes == 1){
                     $rp_G1_gen_herpes_24_f +=1 ;
                   }
                 }
                 if($rp_G1_gen_scabies!= intval($old_final_row['gen_scabies'])){
                   if($rp_G1_gen_scabies == 1){
                     $rp_G1_gen_scabies_24_f +=1;
                   }
                 }
                 if($rp_G1_gud_other  != intval($old_final_row['gud_other'])){
                   if($rp_G1_gud_other == 1){
                     $rp_G1_gud_other_24_f += 1;
                   }
                 }

                 if($rp_G2_non_gono_ure       != intval($old_final_row['non_gono_urethritis'])){
                   if($rp_G2_non_gono_ure==1){
                     $rp_G2_non_gono_ure_24_f += 1;
                   }
                 }
                 if($rp_G2_non_gono_cer       != intval($old_final_row['non_gono_cervities'])){
                   if($rp_G2_non_gono_cer==1){
                     $rp_Gw_non_gono_ure_24_f += 1; // combination of two variables
                   }
                 }
                 if($rp_G2_trichomonas        != intval($old_final_row['trichomonas'])){
                   if($rp_G2_trichomonas == 1){
                     $rp_G2_trichomonas_24_f += 1 ;
                   }
                 }
                 if($rp_G2_gen_candidiosis    != intval($old_final_row['genital_candidiosis'])){
                   if($rp_G2_gen_candidiosis == 1){
                     $rp_G2_gen_candidiosis_24_f += 1;
                   }
                 }
                 if($rp_G2_beterial_vaginosis != intval($old_final_row['beterial_vaginosis'])){
                  if($rp_G2_beterial_vaginosis == 1){
                    $rp_G2_beterial_vaginosis_24_f += 1;
                  }
                 }

                 if($rp_G3_congenial_syphillis    != intval($old_final_row['congenial_syphillis'])){
                   if($rp_G3_congenial_syphillis == 1){
                     $rp_G3_congenial_syphillis_24_f += 1 ;
                   }
                 }
                 if($rp_G3_latent_syphillis       != intval($old_final_row['latent_syphillis'])){
                   if($rp_G3_latent_syphillis == 1){
                     $rp_G3_latent_syphillis_24_f += 1;
                   }
                 }
                 if($rp_G3_latent_syphillis_preg!= intval($old_final_row['latent_syphillis_preg'])){
                   if($rp_G3_latent_syphillis_preg == 1){
                     if($rp_G3_lat_syp_preg_pp_mp == "ANC_PP"){
                        $rp_G3_latent_syphillis_preg_24_pp_f += 1;
                     }
                     if($rp_G3_lat_syp_preg_pp_mp == "ANC_MP"){
                        $rp_G3_latent_syphillis_preg_24_mp_f += 1;
                     }
                   }
                 }
                 if($rp_G3_molluscum_contag       != intval($old_final_row['molluscum_contag'] )){
                   if($rp_G3_molluscum_contag==1){
                     $rp_G3_molluscum_contag_24_f += 1;
                   }
                 }
                 if($rp_G3_bubos                  != intval($old_final_row['bubos'])){
                   if($rp_G3_bubos == 1){
                     $rp_G3_bubos_24_f += 1 ;
                   }
                 }
                 if($rp_G3_othstd_genital_warts   != intval($old_final_row['othstd_genital_warts'])){
                   if($rp_G3_othstd_genital_warts == 1){
                     $rp_G3_othstd_genital_warts_24_f += 1 ;
                   }
                 }
                 if($rp_G3_ostd_other             != intval($old_final_row['ostd_other'])){
                   if($rp_G3_ostd_other == 1){
                     $rp_G3_ostd_other_24_f += 1;
                   }
                 }

               }
               if($rp_Age>25){
                 if($rp_G1_pri_syp    != intval($old_final_row['pri_syphillis'])){
                   if($rp_G1_pri_syp == 1){
                       $G1_pri_syp_25_f += 1;
                   }
                 }
                 if($rp_G1_sec_syp    != intval($old_final_row['sec_syphillis'])){
                   if($rp_G1_sec_syp == 1){
                     $rp_G1_sec_syp_25_f += 1;
                   }
                 }
                 if($rp_G1_chan       != intval($old_final_row['chancroid'])){
                   if($rp_G1_chan == 1){
                     $rp_G1_chan_25_f += 1;
                   }
                 }
                 if($rp_G1_gen_herpes != intval($old_final_row['gen_herpes'])){
                   if($rp_G1_gen_herpes == 1){
                     $rp_G1_gen_herpes_25_f +=1 ;
                   }
                 }
                 if($rp_G1_gen_scabies!= intval($old_final_row['gen_scabies'])){
                   if($rp_G1_gen_scabies == 1){
                     $rp_G1_gen_scabies_25_f +=1;
                   }
                 }
                 if($rp_G1_gud_other  != intval($old_final_row['gud_other'])){
                   if($rp_G1_gud_other == 1){
                     $rp_G1_gud_other_25_f += 1;
                   }
                 }
                 if($rp_G2_non_gono_ure     != intval($old_final_row['non_gono_urethritis'])){
                   if($rp_G2_non_gono_ure==1){
                     $rp_G2_non_gono_ure_25_f += 1;
                   }
                 }
                 if($rp_G2_non_gono_cer     != intval($old_final_row['non_gono_cervities'])){
                   if($rp_G2_non_gono_cer==1){
                     $rp_Gw_non_gono_ure_25_f += 1; // combination of two variables
                   }
                 }
                 if($rp_G2_trichomonas      != intval($old_final_row['trichomonas'])){
                   if($rp_G2_trichomonas == 1){
                     $rp_G2_trichomonas_25_f += 1 ;
                   }
                 }
                 if($rp_G2_gen_candidiosis  != intval($old_final_row['genital_candidiosis'])){
                   if($rp_G2_gen_candidiosis == 1){
                     $rp_G2_gen_candidiosis_25_f += 1;
                   }
                 }
                 if($rp_G2_beterial_vaginosis!= intval($old_final_row['beterial_vaginosis'])){
                  if($rp_G2_beterial_vaginosis == 1){
                    $rp_G2_beterial_vaginosis_25_f += 1;
                  }
                 }
                 if($rp_G3_congenial_syphillis      != intval($old_final_row['congenial_syphillis']) ){
                   if($rp_G3_congenial_syphillis == 1){
                     $rp_G3_congenial_syphillis_25_f += 1 ;
                   }
                 }
                 if($rp_G3_latent_syphillis         != intval($old_final_row['latent_syphillis'])){
                   if($rp_G3_latent_syphillis == 1){
                     $rp_G3_latent_syphillis_25_f += 1;
                   }
                 }
                 if($rp_G3_latent_syphillis_preg!= intval($old_final_row['latent_syphillis_preg'])){
                   if($rp_G3_latent_syphillis_preg == 1){
                     if($rp_G3_lat_syp_preg_pp_mp == "ANC_PP"){
                        $rp_G3_latent_syphillis_preg_25_pp_f += 1;
                     }
                     if($rp_G3_lat_syp_preg_pp_mp == "ANC_MP"){
                        $rp_G3_latent_syphillis_preg_25_mp_f += 1;
                     }
                   }
                 }
                 if($rp_G3_molluscum_contag         != intval($old_final_row['molluscum_contag'] )){
                   if($rp_G3_molluscum_contag==1){
                     $rp_G3_molluscum_contag_25_f += 1;
                   }
                 }
                 if($rp_G3_bubos                    != intval($old_final_row['bubos'])){
                   if($rp_G3_bubos == 1){
                     $rp_G3_bubos_25_f += 1 ;
                   }
                 }
                 if($rp_G3_othstd_genital_warts     != intval($old_final_row['othstd_genital_warts'])){
                   if($rp_G3_othstd_genital_warts == 1){
                     $rp_G3_othstd_genital_warts_25_f += 1 ;
                   }
                 }
                 if($rp_G3_ostd_other               != intval($old_final_row['ostd_other'])){
                   if($rp_G3_ostd_other == 1){
                     $rp_G3_ostd_other_25_f += 1;
                   }
                 }
               }
          }
        }
    //Addition Section


    //Counting section
    $result_m=count($rp_month_m);
    $result_f=count($rp_month_f);
    $G1_pri_syp_14+=$G1_pri_syp_14_new;
    $G1_pri_syp_14_f+=$G1_pri_syp_14_f_new;
    $G1_pri_syp_24+=$G1_pri_syp_24_new;
    $G1_pri_syp_24_f+=$G1_pri_syp_24_f_new;
    $G1_pri_syp_25+=$G1_pri_syp_25_new;
    $G1_pri_syp_25_f+=$G1_pri_syp_25_f_new;
    $rp_G1_sec_syp_14+=$rp_G1_sec_syp_14_new;
    $rp_G1_sec_syp_14_f+=$rp_G1_sec_syp_14_f_new;
    $rp_G1_sec_syp_24+=$rp_G1_sec_syp_24_new;
    $rp_G1_sec_syp_24_f+=$rp_G1_sec_syp_24_f_new;
    $rp_G1_sec_syp_25+=$rp_G1_sec_syp_25_new;
    $rp_G1_sec_syp_25_f+=$rp_G1_sec_syp_25_f_new;
    $rp_G1_chan_14+=$rp_G1_chan_14_new;
    $rp_G1_chan_14_f+=$rp_G1_chan_14_f_new;
    $rp_G1_chan_24+=$rp_G1_chan_24_new;
    $rp_G1_chan_24_f+=$rp_G1_chan_24_f_new;
    $rp_G1_chan_25+=$rp_G1_chan_25_new;
    $rp_G1_chan_25_f+=$rp_G1_chan_25_f_new;
    $rp_G1_gen_herpes_14+=$rp_G1_gen_herpes_14_new;
    $rp_G1_gen_herpes_14_f+=$rp_G1_gen_herpes_14_f_new;
    $rp_G1_gen_herpes_24+=$rp_G1_gen_herpes_24_new;
    $rp_G1_gen_herpes_24_f+=$rp_G1_gen_herpes_24_f_new;
    $rp_G1_gen_herpes_25+=$rp_G1_gen_herpes_25_new;
    $rp_G1_gen_herpes_25_f+=$rp_G1_gen_herpes_25_f_new;
    $rp_G1_gen_scabies_14+=$rp_G1_gen_scabies_14_new;
    $rp_G1_gen_scabies_14_f+=$rp_G1_gen_scabies_14_f_new;
    $rp_G1_gen_scabies_24+=$rp_G1_gen_scabies_24_new;
    $rp_G1_gen_scabies_24_f+=$rp_G1_gen_scabies_24_f_new;
    $rp_G1_gen_scabies_25+=$rp_G1_gen_scabies_25_new;
    $rp_G1_gen_scabies_25_f+=$rp_G1_gen_scabies_25_f_new;
    $rp_G1_gud_other_14+=$rp_G1_gud_other_14_new;
    $rp_G1_gud_other_14_f+=$rp_G1_gud_other_14_f_new;
    $rp_G1_gud_other_24+=$rp_G1_gud_other_24_new;
    $rp_G1_gud_other_24_f+=$rp_G1_gud_other_24_f_new;
    $rp_G1_gud_other_25+=$rp_G1_gud_other_25_new;
    $rp_G1_gud_other_25_f+=$rp_G1_gud_other_25_f_new;
    // Gono place
    $rp_G2_non_gono_ure_14+=$rp_G2_non_gono_ure_14_new;
    $rp_G2_non_gono_ure_14_f+=$rp_G2_non_gono_ure_14_f_new;
    $rp_G2_non_gono_ure_24+=$rp_G2_non_gono_ure_24_new;
    $rp_G2_non_gono_ure_24_f+=$rp_G2_non_gono_ure_24_f_new;
    $rp_G2_non_gono_ure_25+=$rp_G2_non_gono_ure_25_new;
    $rp_G2_non_gono_ure_25_f+=$rp_G2_non_gono_ure_25_f_new;
    $rp_G2_trichomonas_14+=$rp_G2_trichomonas_14_new;
    $rp_G2_trichomonas_14_f+=$rp_G2_trichomonas_14_f_new;
    $rp_G2_trichomonas_24+=$rp_G2_trichomonas_24_new;
    $rp_G2_trichomonas_24_f+=$rp_G2_trichomonas_24_f_new;
    $rp_G2_trichomonas_25+=$rp_G2_trichomonas_25_new;
    $rp_G2_trichomonas_25_f+=$rp_G2_trichomonas_25_f_new;
    $rp_G2_gen_candidiosis_14+=$rp_G2_gen_candidiosis_14_new;
    $rp_G2_gen_candidiosis_14_f+=$rp_G2_gen_candidiosis_14_f_new;
    $rp_G2_gen_candidiosis_24+=$rp_G2_gen_candidiosis_24_new;
    $rp_G2_gen_candidiosis_24_f+=$rp_G2_gen_candidiosis_24_f_new;
    $rp_G2_gen_candidiosis_25+=$rp_G2_gen_candidiosis_25_new;
    $rp_G2_gen_candidiosis_25_f+=$rp_G2_gen_candidiosis_25_f_new;
    $rp_G2_beterial_vaginosis_14_f+=$rp_G2_beterial_vaginosis_14_f_new;
    $rp_G2_beterial_vaginosis_24_f+=$rp_G2_beterial_vaginosis_24_f_new;
    $rp_G2_beterial_vaginosis_25_f+=$rp_G2_beterial_vaginosis_25_f_new;
    $rp_G3_congenial_syphillis_14+=$rp_G3_congenial_syphillis_14_new;
    $rp_G3_congenial_syphillis_14_f+=$rp_G3_congenial_syphillis_14_f_new;
    $rp_G3_congenial_syphillis_24+=$rp_G3_congenial_syphillis_24_new;
    $rp_G3_congenial_syphillis_24_f+=$rp_G3_congenial_syphillis_24_f_new;
    $rp_G3_congenial_syphillis_25+=$rp_G3_congenial_syphillis_25_new;
    $rp_G3_congenial_syphillis_25_f+=$rp_G3_congenial_syphillis_25_f_new;
    $rp_G3_latent_syphillis_14+=$rp_G3_latent_syphillis_14_new;
    $rp_G3_latent_syphillis_14_f+=$rp_G3_latent_syphillis_14_f_new;
    $rp_G3_latent_syphillis_24+=$rp_G3_latent_syphillis_24_new;
    $rp_G3_latent_syphillis_24_f+=$rp_G3_latent_syphillis_24_f_new;
    $rp_G3_latent_syphillis_25+=$rp_G3_latent_syphillis_25_new;
    $rp_G3_latent_syphillis_25_f+=$rp_G3_latent_syphillis_25_f_new;
    $rp_G3_latent_syphillis_preg_14_pp_f+=$rp_G3_latent_syphillis_preg_14_pp_f_new;
    $rp_G3_latent_syphillis_preg_14_mp_f+=$rp_G3_latent_syphillis_preg_14_mp_f_new;
    $rp_G3_latent_syphillis_preg_24_pp_f+=$rp_G3_latent_syphillis_preg_24_pp_f_new;
    $rp_G3_latent_syphillis_preg_24_mp_f+=$rp_G3_latent_syphillis_preg_24_mp_f_new;
    $rp_G3_latent_syphillis_preg_25_pp_f+=$rp_G3_latent_syphillis_preg_25_pp_f_new;
    $rp_G3_latent_syphillis_preg_25_mp_f+=$rp_G3_latent_syphillis_preg_25_mp_f_new;
    $rp_G3_molluscum_contag_14+=$rp_G3_molluscum_contag_14_new;
    $rp_G3_molluscum_contag_14_f+=$rp_G3_molluscum_contag_14_f_new;
    $rp_G3_molluscum_contag_24+=$rp_G3_molluscum_contag_24_new;
    $rp_G3_molluscum_contag_24_f+=$rp_G3_molluscum_contag_24_f_new;
    $rp_G3_molluscum_contag_25+=$rp_G3_molluscum_contag_25_new;
    $rp_G3_molluscum_contag_25_f+=$rp_G3_molluscum_contag_25_f_new;
    $rp_G3_bubos_14+=$rp_G3_bubos_14_new;
    $rp_G3_bubos_14_f+=$rp_G3_bubos_14_f_new;
    $rp_G3_bubos_24+=$rp_G3_bubos_24_new;
    $rp_G3_bubos_24_f+=$rp_G3_bubos_24_f_new;
    $rp_G3_bubos_25+=$rp_G3_bubos_25_new;
    $rp_G3_bubos_25_f+=$rp_G3_bubos_25_f_new;
    $rp_G3_othstd_genital_warts_14+=$rp_G3_othstd_genital_warts_14_new;
    $rp_G3_othstd_genital_warts_14_f+=$rp_G3_othstd_genital_warts_14_f_new;
    $rp_G3_othstd_genital_warts_24+=$rp_G3_othstd_genital_warts_24_new;
    $rp_G3_othstd_genital_warts_24_f+=$rp_G3_othstd_genital_warts_24_f_new;
    $rp_G3_othstd_genital_warts_25+=$rp_G3_othstd_genital_warts_25_new;
    $rp_G3_othstd_genital_warts_25_f+=$rp_G3_othstd_genital_warts_25_f_new;
    $rp_G3_ostd_other_14+=$rp_G3_ostd_other_14_new;
    $rp_G3_ostd_other_14_f+=$rp_G3_ostd_other_14_f_new;
    $rp_G3_ostd_other_24+=$rp_G3_ostd_other_24_new;
    $rp_G3_ostd_other_24_f+=$rp_G3_ostd_other_24_f_new;
    $rp_G3_ostd_other_25+=$rp_G3_ostd_other_25_new;
    $rp_G3_ostd_other_25_f+=$rp_G3_ostd_other_25_f_new;


    return response()->json([
      $result_m,
      $result_f,
      $G1_pri_syp_14,
      $G1_pri_syp_14_f,
      $G1_pri_syp_24,
      $G1_pri_syp_24_f,
      $G1_pri_syp_25,
      $G1_pri_syp_25_f,
      $rp_G1_sec_syp_14,
      $rp_G1_sec_syp_14_f,
      $rp_G1_sec_syp_24,
      $rp_G1_sec_syp_24_f,
      $rp_G1_sec_syp_25,
      $rp_G1_sec_syp_25_f,
      $rp_G1_chan_14,
      $rp_G1_chan_14_f,
      $rp_G1_chan_24,
      $rp_G1_chan_24_f,
      $rp_G1_chan_25,
      $rp_G1_chan_25_f,
      $rp_G1_gen_herpes_14,
      $rp_G1_gen_herpes_14_f,
      $rp_G1_gen_herpes_24,
      $rp_G1_gen_herpes_24_f,
      $rp_G1_gen_herpes_25,
      $rp_G1_gen_herpes_25_f,
      $rp_G1_gen_scabies_14,
      $rp_G1_gen_scabies_14_f,
      $rp_G1_gen_scabies_24,
      $rp_G1_gen_scabies_24_f,
      $rp_G1_gen_scabies_25,
      $rp_G1_gen_scabies_25_f,
      $rp_G1_gud_other_14,
      $rp_G1_gud_other_14_f,
      $rp_G1_gud_other_24,
      $rp_G1_gud_other_24_f,
      $rp_G1_gud_other_25,
      $rp_G1_gud_other_25_f,
      $gono_14_m,
      $gono_14_f,
      $gono_24_m,
      $gono_24_f,
      $gono_25_m,
      $gono_25_f,
      $rp_G2_non_gono_ure_14,
      $rp_G2_non_gono_ure_14_f,
      $rp_G2_non_gono_ure_24,
      $rp_G2_non_gono_ure_24_f,
      $rp_G2_non_gono_ure_25,
      $rp_G2_non_gono_ure_25_f,
      $rp_G2_trichomonas_14,
      $rp_G2_trichomonas_14_f,
      $rp_G2_trichomonas_24,
      $rp_G2_trichomonas_24_f,
      $rp_G2_trichomonas_25,
      $rp_G2_trichomonas_25_f,
      $rp_G2_gen_candidiosis_14,
      $rp_G2_gen_candidiosis_14_f,
      $rp_G2_gen_candidiosis_24,
      $rp_G2_gen_candidiosis_24_f,
      $rp_G2_gen_candidiosis_25,
      $rp_G2_gen_candidiosis_25_f,
      $rp_G2_beterial_vaginosis_14_f,// female only
      $rp_G2_beterial_vaginosis_24_f,// female only
      $rp_G2_beterial_vaginosis_25_f,// female only
      $rp_G3_congenial_syphillis_14,
      $rp_G3_congenial_syphillis_14_f,
      $rp_G3_congenial_syphillis_24,
      $rp_G3_congenial_syphillis_24_f,
      $rp_G3_congenial_syphillis_25,
      $rp_G3_congenial_syphillis_25_f,
      $rp_G3_latent_syphillis_14,
      $rp_G3_latent_syphillis_14_f,
      $rp_G3_latent_syphillis_24,
      $rp_G3_latent_syphillis_24_f,
      $rp_G3_latent_syphillis_25,
      $rp_G3_latent_syphillis_25_f,
      $rp_G3_latent_syphillis_preg_14_pp_f,//female only
      $rp_G3_latent_syphillis_preg_14_mp_f,// female only
      $rp_G3_latent_syphillis_preg_24_pp_f,//female only
      $rp_G3_latent_syphillis_preg_24_mp_f,// female only
      $rp_G3_latent_syphillis_preg_25_pp_f,//female only
      $rp_G3_latent_syphillis_preg_25_mp_f,// female only
      $rp_G3_molluscum_contag_14,
      $rp_G3_molluscum_contag_14_f,
      $rp_G3_molluscum_contag_24,
      $rp_G3_molluscum_contag_24_f,
      $rp_G3_molluscum_contag_25,
      $rp_G3_molluscum_contag_25_f,
      $rp_G3_bubos_14,
      $rp_G3_bubos_14_f,
      $rp_G3_bubos_24,
      $rp_G3_bubos_24_f,
      $rp_G3_bubos_25,
      $rp_G3_bubos_25_f,
      $rp_G3_othstd_genital_warts_14,
      $rp_G3_othstd_genital_warts_14_f,
      $rp_G3_othstd_genital_warts_24,
      $rp_G3_othstd_genital_warts_24_f,
      $rp_G3_othstd_genital_warts_25,
      $rp_G3_othstd_genital_warts_25_f,
      $rp_G3_ostd_other_14,
      $rp_G3_ostd_other_14_f,
      $rp_G3_ostd_other_24,
      $rp_G3_ostd_other_24_f,
      $rp_G3_ostd_other_25,
      $rp_G3_ostd_other_25_f,

      $msm_rdt_14_m,// RPR section
      $msm_P_14_m,
      $msm_rdt_24_m,
      $msm_P_24_m,
      $msm_rdt_25_m,
      $msm_P_25_m,

      $tg_rdt_14_m,
      $tg_P_14_m,
      $tg_rdt_24_m,
      $tg_P_24_m,
      $tg_rdt_25_m,
      $tg_P_25_m,

      $idu_rdt_14_m,
      $idu_P_14_m ,
      $idu_rdt_24_m,
      $idu_P_24_m ,
      $idu_rdt_25_m,
      $idu_P_25_m ,

    ]);

  }
  public function firstQuarter($from9,$to9,$from10,$to10,$from11,$to11,$from12,$to12){
    $filterYear_m =Stimale::whereBetween('Visit date', [$from9, $to9])->get();
    $filterYear_f =Stifemale::whereBetween('Visit date', [$from9, $to9])->get();
    $epi_m =Stimale::whereBetween('Visit date', [$from9, $to9])
                    ->where('episode','=',1)
                    ->get();
    $epi_f =Stifemale::whereBetween('Visit date', [$from9, $to9])
                    ->where('episode','=',1)
                    ->get();
    $sept_m=count($filterYear_m);
    $sept_f=count($filterYear_f);
    $sept_epi_m=count($epi_m);
    $sept_epi_f=count($epi_f);

    $filterYear_oct_m =Stimale::whereBetween('Visit date', [$from10, $to10])->get();
    $filterYear_oct_f =Stifemale::whereBetween('Visit date', [$from10, $to10])->get();
    $oct_epi_m =Stimale::whereBetween('Visit date', [$from10, $to10])
                    ->where('episode','=',1)
                    ->get();
    $oct_epi_f =Stifemale::whereBetween('Visit date', [$from10, $to10])
                    ->where('episode','=',1)
                    ->get();
    $oct_m=count($filterYear_oct_m);
    $oct_f=count($filterYear_oct_f);
    $oct_epi_m=count($oct_epi_m);
    $oct_epi_f=count($oct_epi_f);

    $filterYear_nov_m =Stimale::whereBetween('Visit date', [$from11, $to11])->get();
    $filterYear_nov_f =Stifemale::whereBetween('Visit date', [$from11, $to11])->get();
    $nov_epi_m =Stimale::whereBetween('Visit date', [$from11, $to11])
                    ->where('episode','=',1)
                    ->get();
    $nov_epi_f =Stifemale::whereBetween('Visit date', [$from11, $to11])
                    ->where('episode','=',1)
                    ->get();
    $nov_m=count($filterYear_m);
    $nov_f=count($filterYear_f);
    $nov_epi_m=count($nov_epi_m);
    $nov_epi_f=count($nov_epi_f);

    $filterYear_dec_m =Stimale::whereBetween('Visit date', [$from12, $to12])->get();
    $filterYear_dec_f =Stifemale::whereBetween('Visit date', [$from12, $to12])->get();
    $dec_epi_m =Stimale::whereBetween('Visit date', [$from12, $to12])
                    ->where('episode','=',1)
                    ->get();
    $dec_epi_f =Stifemale::whereBetween('Visit date', [$from12, $to12])
                    ->where('episode','=',1)
                    ->get();
    $dec_m=count($filterYear_dec_m);
    $dec_f=count($filterYear_dec_f);
    $dec_epi_m=count($dec_epi_m);
    $dec_epi_f=count($dec_epi_f);

    return response()->json([
      $sept_m,$sept_f,
      $sept_epi_m,$sept_epi_f,
      $oct_m,$oct_f,
      $oct_epi_m,$oct_epi_f,
      $nov_m,$nov_f,
      $nov_epi_m,$nov_epi_f,
      $dec_m,$dec_f,
      $dec_epi_m,$dec_epi_f,
    ]);

  }

  // This is for exports Section
      public function export()
      {
          return Excel::download(new StimaleExport, 'stimale.xlsx');
      }


}
