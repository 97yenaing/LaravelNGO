<?php

namespace App\Http\Controllers;

use App\Exports\Export_age;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\Stimale;
use App\Models\Stifemale;
use App\Models\Rprtest;
use App\Models\PtConfig;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
//Exports
use Illuminate\Database\Eloquent\Builder;
use App\Exports\Sti\StiExport;
//Imports
use App\Imports\StiFemaleImport;
use App\Imports\StiMaleImport;
use App\Imports\RprlabresultsImport;
use Illuminate\Support\Facades\Crypt;
use DateTime;


class StiController extends Controller

{
  public function sti_patients()
  {
    $sti_patients = Stimale::latest()->paginate(50);
    return view(
      'STI.sti-patients',
      [
        'sti_patients' => $sti_patients
      ]
    );
  }
  //Sti report view
  public function stiReport_View()
  {
    return view('Reports.STI_Report');
  }

  // for view
  public function stiform_View()
  {
    //$patients = Patients=>$request->=>$request->latest()->paginate(10);
    return view('STI.stiform');
  }
  // Sti Rrp Import view
  public function Lab_Rpr_View()
  {
    return view('import.RprlabresultsImport');
  }
  public function Lab_Rpr_input(Request $request)
  {
    Excel::import(new RprlabresultsImport, $request->file('file')->store('temp'));
    return back();
  }

  //Sti Female Import view
  public function stifemaleImport_View()
  {
    return view('import.StiFemale_Import');
  }
  public function StimaleView()
  {
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
  public function stidata(Request $request)
  {
    //to check (old or new )
    $ckPatient =         $request->input('ckPatient'); // find to updated 

    $ckpatient_find =    $request->input('ckpatient_find');
    $sti_Updated_fill =  $request->input('sti_Updated_fill');
    $pid =               $request->input('pid');
    $sti_female =        $request->input('sti_female');
    $sti_male =          $request->input('sti_male');
    $pid_shar =         $request->input('pid_update');
    $id_to_check =      $request->input('id_to_check');
    $date_to_check =    $request->input('date_to_check');
    $gender =           $request->input('duplicate_gender');
    $notice =           $request->input('notice');
    $table = 'General';

    if ($ckPatient == 1) //to check the patient is in sti table
    {

      $patientMale = Stimale::select("id", "Visit_date")->where('cid', $pid)->get();
      $patientFemale = Stifemale::select("id", "Visit_date")->where('cid', $pid)->get();
      foreach ($patientMale as $key => $one_patientMale) {
        if ($one_patientMale["Visit_date"]) {
          $patientMale[$key]["Visit_date"] = date('d-m-Y', strtotime($one_patientMale["Visit_date"]));
        } else {
          $patientMale[$key]["Visit_date"] = "-";
        }
      }
      foreach ($patientFemale as $key => $one_patientFemale) {
        if ($one_patientFemale["Visit_date"]) {
          $patientFemale[$key]["Visit_date"] = date('d-m-Y', strtotime($one_patientFemale["Visit_date"]));
        } else {
          $patientFemale[$key]["Visit_date"] = "-";
        }
      }

      $rprResult = Rprtest::where('pid', $pid)->get();



      if ($patientMale != null || $patientFemale != null) {
        $update = 333;
        return response()->json([
          $pid,
          $patientMale,
          $patientFemale,
          $rprResult,
          $update,

        ]);
      } else if ($patientMale == null && $$patientFemale == null) {
        $Unregistered = array('id' => 1, 'name' => 'You are not registered at Respection or HE/Peer.');
        return response()->json([$Unregistered]);
      }
    }
    if ($ckpatient_find == 1) {
      $patient_exist = PtConfig::where('Pid', $pid)->exists();
      $vdate = $request["sti_vdate"];
      if ($patient_exist) {
        $general_pt = PtConfig::where('Pid', $pid)->first();

        $patientMale = [];
        $patientFemale = [];
        if ($general_pt["Gender"] == 195997324) {
          $duplicate = Stimale::where('cid', $pid)->where("Visit_date", $vdate)->exists();
          if (!$duplicate) {
            $patientMale = Stimale::where('cid', $pid)->get();
            if (count($patientMale) > 0) {
              for ($i = 0; $i < count($patientMale); $i++) {
                $male_fupSex = Crypt::decrypt_light($patientMale[$i]['gender'], $table);
                $male_fupRisk = Crypt::decrypt_light($patientMale[$i]['risk_factor'], $table);
                $male_sex_risk = [
                  'male_sex' => $male_fupSex,
                  'male_risk' => $male_fupRisk
                ];
                $patientMale[$i] = array_merge($patientMale[$i]->toArray(), $male_sex_risk);
              }
            } //follwoup history for male
          } else {
            return response()->json(["Duplicate Data in same day"]);
          }
        } else if ($general_pt["Gender"] == 2532925997326) {
          $duplicate = Stifemale::where('cid', $pid)->where("Visit_date", $vdate)->exists();
          if (!$duplicate) {
            $patientFemale = Stifemale::where('cid', $pid)->get();
            if (count($patientFemale) > 0) {
              foreach ($patientFemale as $i => $female_data) {
                $female_fupSex = Crypt::decrypt_light($female_data['gender'], $table);
                $female_fupRisk = Crypt::decrypt_light($female_data['risk_factor'], $table);
                $female_sex_risk = [
                  'female_sex' => $female_fupSex,
                  'female_risk' => $female_fupRisk
                ];
                $patientFemale[$i] = array_merge($female_data->toArray(), $female_sex_risk);
              }
            } //followup history for femlae
          } else {
            return response()->json(["Duplicate Data in same day"]);
          }
        } else {
          return response()->json(["This Pateint do not include sex please fill at reception"]);
        }
        $general_pt = Export_age::Export_general($general_pt, $vdate, $general_pt["Date of Birth"], $general_pt);
        $rprResult = Rprtest::select('id', 'vdate', 'RPR Qualitative')->where('pid', $pid)->get();
        $rpr_qualitative = [];
        for ($i = 0; $i < count($rprResult); $i++) {
          $rpr_qualitative[$i] = Crypt::decrypt_light($rprResult[$i]['RPR Qualitative'], $table);
        }
        if ($general_pt != null || $patientMale != null || $patientFemale != null) {
          $sex = Crypt::decrypt_light($general_pt["Gender"], $table);
          $risk_factor = Crypt::decrypt_light($general_pt["Main Risk"], $table);

          return response()->json([
            $general_pt,
            $patientMale,
            $patientFemale,
            $rprResult,
            $sex,
            $risk_factor,
            $rpr_qualitative,
          ]);
        }
      } else {
        return response()->json(["This Pateint do not Register in this clinic"]);
      }
    }

    if ($sti_male == 1)   // STI Male Data Collector (Create)
    {

      Stimale::create([


        'gender'                       => Crypt::encrypt_light($request->input('gender'), $table),

        'CID'                          => $request->pid,
        'clinic'                       => $request->clinic,
        'created_by'                    => $request->created_by,
        'updated_by'                    => $request->updated_by,

        //'tbl_demog_first_visit'        => Crypt::encrypt_light( Crypt::encryptString($request->input('firstVisit')),$table),
        'last_vis_within'              => Crypt::encrypt_light($request->input('lastVisit'), $table),
        'age'                          => $request->age,
        'about_clinic'                 => Crypt::encrypt_light($request->input('aboutclinic'), $table),
        'Visit_date'                   => $request->regdate,
        'fuchiaID'                     => $request->fuchia,
        'episode'                      => Crypt::encrypt_light($request->input('episode'), $table),
        'Reason for Visit'             => Crypt::encrypt_light($request->input('reason'), $table),
        'risk_factor'                  => Crypt::encrypt_light($request->input('ptype'), $table),
        'urethral_disc'                => Crypt::encrypt_light($request->input('urethral_discharge'), $table),
        'urethral_disc_hl'             => Crypt::encrypt_light($request->input('howlong_days'), $table),
        'dysuria'                     => Crypt::encrypt_light($request->input('dysuria'), $table),
        'dysuria_hl'                   => Crypt::encrypt_light($request->input('howlong_dysuria'), $table),

        'genital_prut'                 => Crypt::encrypt_light($request->input('genital_prutitus'), $table),
        'genital_prut_hl'              => Crypt::encrypt_light($request->input('howlong_genital_pruti'), $table),
        'genital_pain'                 => Crypt::encrypt_light($request->input('genital_burn'), $table),
        'genital_pain_hl'              => Crypt::encrypt_light($request->input('howlong_genital_burn'), $table),
        'genital_ulcer'                => Crypt::encrypt_light($request->input('genital_ulcer'), $table),
        'genital_ulcer_hl'             => Crypt::encrypt_light($request->input('howlong_genital_ulcer'), $table),

        'pain'                         => Crypt::encrypt_light($request->input('pain'), $table),
        'ulcer'                        => Crypt::encrypt_light($request->input('ulcer'), $table),
        'prodromal_itch'               => Crypt::encrypt_light($request->input('prodormal_itch'), $table),
        'vesicles'                     => Crypt::encrypt_light($request->input('start_vesicles'), $table),
        'recurrent'                    => Crypt::encrypt_light($request->input('recurrent'), $table),
        'last_episode'                 => Crypt::encrypt_light($request->input('last_episode'), $table),
        'suspects_herpes'              => Crypt::encrypt_light($request->input('patient_suspect_herpes'), $table),

        'ing_lymph_node'               => Crypt::encrypt_light($request->input('inguinal_lymph_node'), $table),
        'ing_lymph_node_hl'            => Crypt::encrypt_light($request->input('hl_inguinal_lymph_node'), $table),
        'unilateal'                    => Crypt::encrypt_light($request->input('unilateal'), $table),
        'leg_ulcer'                    => Crypt::encrypt_light($request->input('leg_ulcer_inf'), $table),
        'scrotal_swelling'             => Crypt::encrypt_light($request->input('scrotal_swelling'), $table),
        'scrotal_swelling_hl'          => Crypt::encrypt_light($request->input('hl_scrotal_swelling'), $table),
        'td_ntd'                       => Crypt::encrypt_light($request->input('tender'), $table),
        'gen_wart'                     => Crypt::encrypt_light($request->input('genital_wart'), $table),
        'gen_wart_hl'                  => Crypt::encrypt_light($request->input('hl_genital_wart'), $table),
        ///first end
        ///second page
        'physical_exam'                => Crypt::encrypt_light($request->input('physical_exam'), $table),
        'urinated_wit_1h'              => Crypt::encrypt_light($request->input('urinated_within1hr'), $table),
        'discharge'                    => Crypt::encrypt_light($request->input('discharge'), $table),
        'discharge_milk'               => Crypt::encrypt_light($request->input('discharge_after_milking'), $table),
        'colour'                       => Crypt::encrypt_light($request->input('colour'), $table),
        'erythema'                     => Crypt::encrypt_light($request->input('phi_erythema'), $table),
        'blisters'                     => Crypt::encrypt_light($request->input('phi_blister_penis'), $table),
        'gen_ulcer'                    => Crypt::encrypt_light($request->input('phi_genital_ulcer'), $table),

        'esti_size'                    => Crypt::encrypt_light($request->input('phi_estimated_size'), $table),
        'sing_multi'                   => Crypt::encrypt_light($request->input('phi_single_multiple'), $table),
        'pain_full_less'               => Crypt::encrypt_light($request->input('phi_painfull'), $table),
        'herpes_suspect'               => Crypt::encrypt_light($request->input('phi_herpes_suspected'), $table),
        'inguinal_bubo'                => Crypt::encrypt_light($request->input('phi_inguinal_bubo'), $table),

        'fluctant'                     => Crypt::encrypt_light($request->input('phi_fluctant'), $table),
        'tendr_ntender'                => Crypt::encrypt_light($request->input('phi_tender'), $table),
        'oth_leg_inf'                  => Crypt::encrypt_light($request->input('phi_leg_inf'), $table),
        'phy_genital_wart'             => Crypt::encrypt_light($request->input('phi_genital_wart'), $table),

        'crab_lice'                    => Crypt::encrypt_light($request->input('phi_crab_lice'), $table),
        'scabies'                      => Crypt::encrypt_light($request->input('phi_scabies'), $table),
        'gscrotal_swelling'            => Crypt::encrypt_light($request->input('phi_scrotal_swelling'), $table),
        'estimated_siz'                => Crypt::encrypt_light($request->input('phi_esti_size'), $table),
        'unilateal_bilateral'          => Crypt::encrypt_light($request->input('phi_unilateal'), $table),
        'gtender_ntender'              => Crypt::encrypt_light($request->input('phi_tender_non'), $table),
        'erythem'                      => Crypt::encrypt_light($request->input('phi_erythema1'), $table),
        'des_size'                     => Crypt::encrypt_light($request->input('phi_drawing'), $table),
        //second page end
        //third page
        'tbl_treat_diagnosis_first_visit' => Crypt::encrypt_light($request->input('pt_1st_visit'), $table),
        'epi_discharge'                => Crypt::encrypt_light($request->input('pt_epi_dis_lastvisit'), $table),
        'unprot_sex_new_part'          => Crypt::encrypt_light($request->input('unprotected_sex'), $table),
        'genital_signs'                => Crypt::encrypt_light($request->input('genital_sign'), $table),

        'presumptive_diag'             => Crypt::encryptString($request->input('presumptive_diag'), $table),
        'pri_syphillis'                => Crypt::encrypt_light($request->input('primary_syphillis'), $table),
        'Gonorhoea'                    => Crypt::encrypt_light($request->input('gonorrhoea'), $table),
        'congenial_syphillis'          => Crypt::encrypt_light($request->input('congenial_syphillis'), $table),
        'sec_syphillis'                => Crypt::encrypt_light($request->input('secondary_syphillis'), $table),
        'non_gono_urethritis'          => Crypt::encrypt_light($request->input('non_gono_urethri'), $table),
        'latent_syphillis'             => Crypt::encrypt_light($request->input('latent_syphillis'), $table),
        'chancroid'                    => Crypt::encrypt_light($request->input('chancroid'), $table),
        'non_gono_procti'              => Crypt::encrypt_light($request->input('non_gono_procti'), $table),
        // need to ask
        //  'non_gono_cervities'                              => Crypt::encrypt_light($request->input(''),$table),
        'molluscum_contag'             => Crypt::encrypt_light($request->input('molluscum_contagiosum'), $table),
        'gen_herpes'                   => Crypt::encrypt_light($request->input('genital_herpes3'), $table),
        'trichomonas'                  => Crypt::encrypt_light($request->input('trichomonas'), $table),
        'bubos'                        => Crypt::encrypt_light($request->input('bubos'), $table),
        'othstd_genital_warts'         => Crypt::encrypt_light($request->input('genital_warts3'), $table),
        'gen_scabies'                  => Crypt::encrypt_light($request->input('genital_scabies3'), $table),
        'genital_candidiosis'          => Crypt::encrypt_light($request->input('genital_candidiosis'), $table),
        //                                => Crypt::encrypt_light($request->input('genital_warts3'),$table),
        'gud_other'                    => Crypt::encrypt_light($request->input('others3'), $table),
        'beterial_vaginosis'           => Crypt::encrypt_light($request->input('baterial_vaginosis'), $table),
        'ostd_other'                   => Crypt::encrypt_light($request->input('others33'), $table),
        'tre_azythro'                  => Crypt::encrypt_light($request->input('tre_azythro'), $table),
        'tre_cefixim'                  => Crypt::encrypt_light($request->input('tre_cefixim'), $table),
        'tre_ciprofloxacin'            => Crypt::encrypt_light($request->input('tre_ciprofloxacin'), $table),
        'tre_tinidazole'               => Crypt::encrypt_light($request->input('tre_tinidazole'), $table),
        'tre_fluconazole'              => Crypt::encrypt_light($request->input('tre_fluconazole'), $table),
        'tre_doxycycline'              => Crypt::encrypt_light($request->input('tre_doxycycline'), $table),
        'tre_ceftriaxone'              => Crypt::encrypt_light($request->input('tre_ceftriaxone'), $table),
        'tre_benz_pen'                 => Crypt::encrypt_light($request->input('tre_benzpen'), $table),
        'no_treat'                     => Crypt::encrypt_light($request->input('no_treament1'), $table),
        'al_Penicillin'                => Crypt::encrypt_light($request->input('allergy'), $table),
        'al_sulfa'                     => Crypt::encrypt_light($request->input('sulfa'), $table),
        'part_treat'                   => Crypt::encrypt_light($request->input('parter_treatment_given'), $table),
        'condom_giv'                   => Crypt::encrypt_light($request->input('condom'), $table),
        'tre_remarks'                  => Crypt::encryptString($request->input('remarkTreatment'), $table),
        'followup'                     => Crypt::encryptString($request->input('follwupText'), $table),
        'clinician_name'               => Crypt::encryptString($request->input('clinicainName'), $table),

      ]);



      $success = [[
        "id" => 1,
        "name" => "Your Sti male data has been successfully collected."
      ]];
      return response()->json([$success]);
    }
    if ($sti_female == 1) // STI Female Collector (Create)
    {
      Stifemale::create([
        'gender'            => Crypt::encrypt_light($request->fe_gender, $table),
        'clinic'            => $request->fe_clinic,
        'CID'               => $request->fe_pid,
        'fuchiaID'          => $request->fe_fuchiaID,
        'age'               => $request->fe_age,
        'created_by'        => $request->created_by,
        'updated_by'        => $request->updated_by,

        'first_visit'       => Crypt::encrypt_light($request->fe_firstVisit, $table),
        'last_vis_within'   => Crypt::encrypt_light($request->fe_lastVisit, $table),
        ////'vtype'            => Crypt::encrypt_light( $request -> ,$table),

        'about_clinic'      => Crypt::encrypt_light($request->fe_aboutclinic, $table),
        ////'demo_remarks'            => Crypt::encrypt_light( $request -> demo_remarks,$table),
        'Visit_date'        => $request->fe_regdate,
        ////      'Expr1'             => Crypt::encrypt_light( $request ->      ,$table),
        'episode'           => Crypt::encrypt_light($request->fe_episode, $table),
        'rea_for_visit'     => Crypt::encrypt_light($request->fe_reason, $table),
        'risk_factor'       => Crypt::encrypt_light($request->fe_ptype, $table),

        'abn_vaginal_disc'  => Crypt::encrypt_light($request->fe_abVagdischarge, $table),
        'abn_vaginal_disc_long' => Crypt::encrypt_light($request->fe_hl_ab_va_dis, $table),
        'linked_menstru'    => Crypt::encrypt_light($request->fe_Link_menstra, $table),
        'amount'            => Crypt::encrypt_light($request->fe_Amount, $table),
        'colour'            => Crypt::encrypt_light($request->fe_colour, $table),
        'colour_oth'        => Crypt::encrypt_light($request->fe_oth_colour, $table),

        'abn_veginal_odour' => Crypt::encrypt_light($request->fe_odour, $table),
        'l_abn_pain'        => Crypt::encrypt_light($request->fe_lower_abd_pain, $table),
        'l_abon_pain_hl'    => Crypt::encrypt_light($request->fe_hl_abd_pain, $table),
        'fever'             => Crypt::encrypt_light($request->fe_fever, $table),
        'rec_terminate_preg' => Crypt::encrypt_light($request->fe_terminate_preg, $table),
        'dyspareunia'       => Crypt::encrypt_light($request->fe_dyspareunia, $table),
        'oth_GI_sympt'      => Crypt::encryptString($request->fe_oth_gi_sym, $table),
        'dysuria'           => Crypt::encrypt_light($request->fe_dysuria, $table),
        'dysuria_hl'        => Crypt::encrypt_light($request->fe_howlong_dysuria, $table),
        'gen_prutitus'      => Crypt::encrypt_light($request->fe_genital_prutitus, $table),
        'gen_prutitus_hl'   => Crypt::encrypt_light($request->fe_howlong_genital_pruti, $table),
        'gen_burn_pain'     => Crypt::encrypt_light($request->fe_genital_burn, $table),
        'gen_burn_pain_hl'  => Crypt::encrypt_light($request->fe_howlong_genital_burn, $table),
        'gen_ulcer'         => Crypt::encrypt_light($request->fe_first_genital_ulcer, $table),
        'gen_ulcer_hl'      => Crypt::encrypt_light($request->fe_howlong_genital_ulcer, $table),
        'pain'              => Crypt::encrypt_light($request->fe_pain, $table),
        'ulcer'             => Crypt::encrypt_light($request->fe_ulcer, $table),
        'prodromal_itch'    => Crypt::encrypt_light($request->fe_prodormal_itch, $table),
        'vesicles'          => Crypt::encrypt_light($request->fe_start_vesicles, $table),
        'recurrent'         => Crypt::encrypt_light($request->fe_recurrent, $table),
        'recurrent_last_episode'  => Crypt::encrypt_light($request->fe_last_episode, $table),
        'patient_suspects_herpes' => Crypt::encrypt_light($request->fe_patient_suspect_herpes, $table),
        'inguinal_ln'             => Crypt::encrypt_light($request->fe_inguinal_lymph_node, $table),
        'inguinal_ln_hl'          => Crypt::encrypt_light($request->fe_hl_inguinal_lymph_node, $table),
        'unilateal_Bilateral'     => Crypt::encrypt_light($request->fe_unilateal, $table),
        'leg_ulcer_oth_inf'       => Crypt::encrypt_light($request->fe_leg_ulcer_inf, $table),
        'genital_warts'           => Crypt::encrypt_light($request->fe_genital_wart, $table),
        'genital_warts_hl'        => Crypt::encrypt_light($request->fe_hl_genital_wart, $table),
        //                                       fe_other_specify
        'phy_exam_done'           => Crypt::encrypt_light($request->fe_physical_exam, $table),
        'washed_inside'           => Crypt::encrypt_light($request->fe_wash_inside, $table),
        'vulvar_erythema'         => Crypt::encrypt_light($request->fe_vulvar_erythema, $table),
        'vulvar_odema'            => Crypt::encrypt_light($request->fe_vulvar_odema, $table),
        'vaginal_discharge'       => Crypt::encrypt_light($request->fe_vag_dis, $table),
        'vag_dis_amount'          => Crypt::encrypt_light($request->fe_vag_dis_amount, $table),
        'homogeneous'             => Crypt::encrypt_light($request->fe_homogeneous, $table),
        'homogeneous_col'         => Crypt::encrypt_light($request->fe_vag_dis_colour, $table),
        'smell_without_KOH'       => Crypt::encrypt_light($request->fe_smell_koh, $table),
        'vaginal_wall_injury'     => Crypt::encrypt_light($request->fe_phi_vag_wall, $table),
        'adnexal_tenderness'      => Crypt::encrypt_light($request->fe_phi_ad_tender, $table),
        'adnexal_enlargement'     => Crypt::encrypt_light($request->fe_phi_ad_enlarge, $table),
        'genital_blisters'        => Crypt::encrypt_light($request->fe_genital_blisters, $table),

        'genital_blisters_Location' => Crypt::encryptString($request->fe_genital_blisters_location, $table),
        'gential_ulcer'           => Crypt::encrypt_light($request->fe_genital_ulcer, $table),
        'gential_ulcerl'          => Crypt::encrypt_light($request->fe_genital_ulc_location, $table),

        'gent_ulcer_sm'           => Crypt::encrypt_light($request->fe_single_multiple, $table),
        'gential_ulcer_pain'      => Crypt::encrypt_light($request->fe_painfull, $table),
        'susp_herpes'             => Crypt::encrypt_light($request->fe_herpes_suspected, $table),
        'inguinal_bubo'           => Crypt::encrypt_light($request->fe_inguinal_bubo, $table),
        'fluctuant'               => Crypt::encrypt_light($request->fe_fluctant, $table),
        'fluctuant_tender'        => Crypt::encrypt_light($request->fe_tender, $table),
        'oth_leg_infection'       => Crypt::encrypt_light($request->fe_leg_inf, $table),
        'genital_wart'            => Crypt::encrypt_light($request->fephi_genital_wart, $table),

        'crab_lice'               => Crypt::encrypt_light($request->fe_crab_lice, $table),
        'scablices'               => Crypt::encrypt_light($request->fe_scabies, $table),
        'KOH_smell_test'          => Crypt::encrypt_light($request->fe_koh_smell, $table),
        'pH_vagina'               => Crypt::encrypt_light($request->fe_ph_vagina, $table),
        'des_size'                => Crypt::encryptString($request->fe_drawing_f, $table),

        'prev_STI'                => Crypt::encrypt_light($request->cal1, $table),
        'patient_genital_ulcer'   => Crypt::encrypt_light($request->cal3, $table),
        'patient_compl_low_abd'   => Crypt::encrypt_light($request->cal5, $table),
        'new_pat_past_3mont'      => Crypt::encrypt_light($request->cal2, $table),
        'part_compl_gential_sym'  => Crypt::encrypt_light($request->cal4, $table),
        'sworker'                 => Crypt::encrypt_light($request->cal6, $table),
        'rg_score'                => Crypt::encrypt_light($request->scoreAns, $table),
        'risk'                    => Crypt::encrypt_light($request->riskCal, $table),
        'risk_cal_remark'         => Crypt::encryptString($request->riskRemark, $table),
        'abn_yellow_disc'         => Crypt::encrypt_light($request->fe_ab_yellow_discharge, $table),
        'dysuria_risk_ass'        => Crypt::encrypt_light($request->cal8, $table),
        'low_abd_pain'            => Crypt::encrypt_light($request->cal10, $table),
        'pain_dur_sexual'         => Crypt::encrypt_light($request->cal7, $table),
        'unp_sex_new_clients'     => Crypt::encrypt_light($request->cal9, $table),
        'partner_ulcer'           => Crypt::encrypt_light($request->fe_partner_ulcer, $table),
        'presumptive_diag'        => Crypt::encryptString($request->fe_presumptive_diag, $table),
        'pri_syphillis'           => Crypt::encrypt_light($request->fe_primary_syphillis, $table),
        'sec_syphillis'           => Crypt::encrypt_light($request->fe_secondary_syphillis, $table),
        'chancroid'               => Crypt::encrypt_light($request->fe_chancroid, $table),
        'gen_herpes'              => Crypt::encrypt_light($request->fe_genital_herpes3, $table),
        'gen_scabies'             => Crypt::encrypt_light($request->fe_genital_scabies3, $table),
        //'gud_other'               => Crypt::encrypt_light( $request -> ,$table),
        'other_plz_specify'       => Crypt::encrypt_light($request->fe_other_specify, $table),
        'congenial_syphillis'     => Crypt::encrypt_light($request->fe_congenial_syphillis, $table),
        'Gonorhoea'               => Crypt::encrypt_light($request->fe_gonorrhoea, $table),
        'non_gono_urethritis'     => Crypt::encrypt_light($request->fe_non_gono_urethri, $table),
        'non_gono_cervities'      => Crypt::encrypt_light($request->fe_non_gono_cervities, $table),
        'trichomonas'             => Crypt::encrypt_light($request->fe_trichomonas, $table),
        'genital_candidiosis'     => Crypt::encrypt_light($request->fe_genital_candidiosis, $table),
        'beterial_vaginosis'      => Crypt::encrypt_light($request->fe_baterial_vaginosis, $table),
        'latent_syphillis_preg'   => Crypt::encrypt_light($request->fe_latent_syp_pregancy, $table),
        'latent_syphillis'        => Crypt::encrypt_light($request->fe_latent_syphillis, $table),
        'molluscum_contag'        => Crypt::encrypt_light($request->fe_molluscum_contagiosum, $table),
        'bubos'                   => Crypt::encrypt_light($request->fe_bubos, $table),
        'othstd_genital_warts'    => Crypt::encrypt_light($request->fe_genital_warts3, $table),
        'ostd_other'              => Crypt::encrypt_light($request->fe_others3, $table),
        'other_STD'               => Crypt::encrypt_light($request->fe_others33, $table),
        'tre_azythro'             => Crypt::encrypt_light($request->fe_tre_azythro, $table),
        'tre_cefixim'             => Crypt::encrypt_light($request->fe_tre_cefixim, $table),
        'tre_ciprofloxacin'       => Crypt::encrypt_light($request->fe_tre_ciprofloxacin, $table),
        'tre_tinidazole'          => Crypt::encrypt_light($request->fe_tre_tinidazole, $table),
        'tre_fluconazole'         => Crypt::encrypt_light($request->fe_tre_fluconazole, $table),
        'tre_doxycycline'         => Crypt::encrypt_light($request->fe_tre_doxycycline, $table),
        'tre_ceftriaxone'         => Crypt::encrypt_light($request->fe_tre_ceftriaxone, $table),
        'tre_benz_pen'            => Crypt::encrypt_light($request->fe_tre_benzpen, $table),
        'clotrimazole_vaginal_tab' => Crypt::encrypt_light($request->fe_clotrimazole, $table),
        'tre_Other'               => Crypt::encrypt_light($request->fe_no_treament, $table),
        'al_Penicillin'           => Crypt::encrypt_light($request->fe_allergy, $table),
        'al_sulfa'                => Crypt::encrypt_light($request->fe_sulfa, $table),
        'part_treat'              => Crypt::encrypt_light($request->fe_parter_treatment_given, $table),
        'condom_giv'              => Crypt::encrypt_light($request->fe_condom, $table),
        'tre_remarks'             => Crypt::encryptString($request->fe_remarkTreatment, $table),
        'followup'                => Crypt::encryptString($request->fe_follwupText, $table),
        'clinician'               => Crypt::encryptString($request->fe_clinicainName, $table),
      ]);
      $success = "Saved";
      return response()->json([$success, $request->fe_tre_azythro, $request->created_by,]);
    }
    if ($sti_male == 2) // STI Male Data Updater ( Update )
    {

      $updateID = $request->input('updateID');


      Stimale::where('id', $updateID)
        ->update([


          'updated_by'                  => $request->updated_by,
          'CID' => $request->pid,

          //'tbl_demog_first_visit'        =>Crypt::encrypt_light( $request -> tbl_demog_firt_visit,$table),
          'last_vis_within'              => Crypt::encrypt_light($request->lastVisit, $table),
          'about_clinic'                 => Crypt::encrypt_light($request->aboutclinic, $table),
          'Visit_date'                   => $request->regdate,
          //                              =>Crypt::encrypt_light( $request -> fuchia,$table),
          'episode'                      => Crypt::encrypt_light($request->episode, $table),
          'Reason for Visit'             => Crypt::encrypt_light($request->reason, $table),
          'risk_factor'                  => Crypt::encrypt_light($request->ptype, $table),
          'urethral_disc'                => Crypt::encrypt_light($request->urethral_discharge, $table),
          'urethral_disc_hl'             => Crypt::encrypt_light($request->howlong_days, $table),
          'dysuria'                      => Crypt::encrypt_light($request->dysuria, $table),
          'dysuria_hl'                   => Crypt::encrypt_light($request->howlong_dysuria, $table),

          'genital_prut'                 => Crypt::encrypt_light($request->genital_prutitus, $table),
          'genital_prut_hl'              => Crypt::encrypt_light($request->howlong_genital_pruti, $table),
          'genital_pain'                 => Crypt::encrypt_light($request->genital_burn, $table),
          'genital_pain_hl'              => Crypt::encrypt_light($request->howlong_genital_burn, $table),
          'genital_ulcer'                => Crypt::encrypt_light($request->genital_ulcer, $table),
          'genital_ulcer_hl'             => Crypt::encrypt_light($request->howlong_genital_ulcer, $table),

          'pain'                         => Crypt::encrypt_light($request->pain, $table),
          'ulcer'                        => Crypt::encrypt_light($request->ulcer, $table),
          'prodromal_itch'               => Crypt::encrypt_light($request->prodromal_itch, $table),
          'vesicles'                     => Crypt::encrypt_light($request->start_vesicles, $table),
          'recurrent'                    => Crypt::encrypt_light($request->recurrent, $table),
          'last_episode'                 => Crypt::encrypt_light($request->last_episode, $table),
          'suspects_herpes'              => Crypt::encrypt_light($request->patient_suspect_herpes, $table),

          'ing_lymph_node'               => Crypt::encrypt_light($request->inguinal_lymph_node, $table),
          'ing_lymph_node_hl'            => Crypt::encrypt_light($request->hl_inguinal_lymph_node, $table),
          'congenial_syphillis'          => Crypt::encrypt_light($request->fe_congenial_syphillis, $table),
          'unilateal'                    => Crypt::encrypt_light($request->unilateal, $table),
          'leg_ulcer'                    => Crypt::encrypt_light($request->leg_ulcer_inf, $table),
          'scrotal_swelling'             => Crypt::encrypt_light($request->scrotal_swelling, $table),
          'scrotal_swelling_hl'          => Crypt::encrypt_light($request->hl_scrotal_swelling, $table),
          'td_ntd'                       => Crypt::encrypt_light($request->tender, $table),
          'gen_wart'                     => Crypt::encrypt_light($request->genital_wart, $table),
          'gen_wart_hl'                  => Crypt::encrypt_light($request->hl_genital_wart, $table),
          //first end
          //second page
          'physical_exam'                => Crypt::encrypt_light($request->physical_exam, $table),
          'urinated_wit_1h'              => Crypt::encrypt_light($request->urinated_within1hr, $table),
          'discharge'                    => Crypt::encrypt_light($request->discharge, $table),
          'discharge_milk'               => Crypt::encrypt_light($request->discharge_after_milking, $table),
          'colour'                       => Crypt::encrypt_light($request->colour, $table),
          'erythema'                     => Crypt::encrypt_light($request->phi_erythema, $table),
          'blisters'                     => Crypt::encrypt_light($request->phi_blister_penis, $table),
          'gen_ulcer'                    => Crypt::encrypt_light($request->phi_genital_ulcer, $table),

          'esti_size'                    => Crypt::encrypt_light($request->phi_estimated_size, $table),
          'sing_multi'                   => Crypt::encrypt_light($request->phi_single_multiple, $table),
          'pain_full_less'               => Crypt::encrypt_light($request->phi_painfull, $table),
          'herpes_suspect'               => Crypt::encrypt_light($request->phi_herpes_suspected, $table),
          'inguinal_bubo'                => Crypt::encrypt_light($request->phi_inguinal_bubo, $table),

          'fluctant'                     => Crypt::encrypt_light($request->phi_fluctant, $table),
          'tendr_ntender'                => Crypt::encrypt_light($request->phi_tender, $table),
          'oth_leg_inf'                  => Crypt::encrypt_light($request->phi_leg_inf, $table),
          'phy_genital_wart'             => Crypt::encrypt_light($request->phi_genital_wart, $table),

          'crab_lice'                    => Crypt::encrypt_light($request->phi_crab_lice, $table),
          'scabies'                      => Crypt::encrypt_light($request->phi_scabies, $table),
          'gscrotal_swelling'            => Crypt::encrypt_light($request->phi_scrotal_swelling, $table),
          'estimated_siz'                => Crypt::encrypt_light($request->phi_esti_size, $table),
          'unilateal_bilateral'          => Crypt::encrypt_light($request->phi_unilateal, $table),
          'gtender_ntender'              => Crypt::encrypt_light($request->phi_tender_non, $table),
          'erythem'                      => Crypt::encrypt_light($request->phi_erythema1, $table),
          'des_size'                     => Crypt::encrypt_light($request->phi_drawing, $table),
          //second page end
          //third page
          'epi_discharge'                => Crypt::encrypt_light($request->pt_epi_dis_lastvisit, $table),
          'unprot_sex_new_part'          => Crypt::encrypt_light($request->unprotected_sex, $table),
          'genital_signs'                => Crypt::encrypt_light($request->genital_sign, $table),
          'tbl_treat_diagnosis_first_visit' => Crypt::encrypt_light($request->pt_1st_visit, $table),
          'presumptive_diag'             => Crypt::encryptString($request->presumptive_diag, $table),
          'pri_syphillis'                => Crypt::encrypt_light($request->primary_syphillis, $table),
          'Gonorhoea'                    => Crypt::encrypt_light($request->gonorrhoea, $table),
          'congenial_syphillis'          => Crypt::encrypt_light($request->congenial_syphillis, $table),
          'sec_syphillis'                => Crypt::encrypt_light($request->secondary_syphillis, $table),
          'non_gono_urethritis'          => Crypt::encrypt_light($request->non_gono_urethri, $table),
          'latent_syphillis'             => Crypt::encrypt_light($request->latent_syphillis, $table),
          'chancroid'                    => Crypt::encrypt_light($request->chancroid, $table),
          // need to ask
          //  'non_gono_cervities'                              =>Crypt::encrypt_light( $request -> ,$table),
          'molluscum_contag'             => Crypt::encrypt_light($request->molluscum_contagiosum, $table),
          'gen_herpes'                   => Crypt::encrypt_light($request->genital_herpes3, $table),
          'trichomonas'                  => Crypt::encrypt_light($request->trichomonas, $table),
          'bubos'                        => Crypt::encrypt_light($request->bubos, $table),
          'othstd_genital_warts'         => Crypt::encrypt_light($request->genital_warts3, $table),
          'gen_scabies'                  => Crypt::encrypt_light($request->genital_scabies3, $table),
          'genital_candidiosis'          => Crypt::encrypt_light($request->genital_candidiosis, $table),
          //                                =>Crypt::encrypt_light( $request -> genital_warts3,$table),
          'gud_other'                    => Crypt::encrypt_light($request->others3, $table),
          'beterial_vaginosis'           => Crypt::encrypt_light($request->baterial_vaginosis, $table),
          'ostd_other'        => Crypt::encrypt_light($request->others33, $table),
          //'other_STD'               => Crypt::encrypt_light($request  ->  fe_others33,$table),
          'tre_azythro'                  => Crypt::encrypt_light($request->tre_azythro, $table),
          'tre_cefixim'                  => Crypt::encrypt_light($request->tre_cefixim, $table),
          'tre_ciprofloxacin'            => Crypt::encrypt_light($request->tre_ciprofloxacin, $table),
          'tre_tinidazole'               => Crypt::encrypt_light($request->tre_tinidazole, $table),
          'tre_fluconazole'              => Crypt::encrypt_light($request->tre_fluconazole, $table),
          'tre_doxycycline'              => Crypt::encrypt_light($request->tre_doxycycline, $table),
          'tre_ceftriaxone'              => Crypt::encrypt_light($request->tre_ceftriaxone, $table),
          'tre_benz_pen'                 => Crypt::encrypt_light($request->tre_benzpen, $table),
          'no_treat'                     => Crypt::encrypt_light($request->no_treament1, $table),
          'al_Penicillin'                => Crypt::encrypt_light($request->allergy, $table),
          'al_sulfa'                     => Crypt::encrypt_light($request->sulfa, $table),
          'part_treat'                   => Crypt::encrypt_light($request->parter_treatment_given, $table),
          'condom_giv'                   => Crypt::encrypt_light($request->condom, $table),
          'tre_remarks'                  => Crypt::encryptString($request->remarkTreatment, $table),
          'followup'                     => Crypt::encryptString($request->follwupText, $table),
          'clinician_name'               => Crypt::encryptString($request->clinicainName, $table),

        ]);



      $success = [[
        "id"   => 1,
        "name" => "Your data has been successfully updated."
      ]];
      return response()->json([$success]);
    }
    if ($sti_female == 2) // STI Female Data Updater (Update)
    {
      $updateID = $request->input('updateID');
      Stifemale::where('id', $updateID)
        ->update([
          'first_visit'       => Crypt::encrypt_light($request->fe_firstVisit, $table),
          'last_vis_within'   => Crypt::encrypt_light($request->fe_lastVisit, $table),
          ////'vtype'            => Crypt::encrypt_light( $request -> ,$table),
          'updated_by'                  => $request->updated_by,
          'CID' => $request->pid,

          'about_clinic'      => Crypt::encrypt_light($request->fe_aboutclinic, $table),
          ////'demo_remarks'            => Crypt::encrypt_light( $request -> demo_remarks,$table),
          ////      'Expr1'             => Crypt::encrypt_light( $request ->      ,$table),
          'episode'           => Crypt::encrypt_light($request->fe_episode, $table),
          'rea_for_visit'     => Crypt::encrypt_light($request->fe_reason, $table),
          // 'risk_factor'       => Crypt::encrypt_light( $request -> fe_ptype,$table),

          'abn_vaginal_disc'  => Crypt::encrypt_light($request->fe_abVagdischarge, $table),
          'abn_vaginal_disc_long' => Crypt::encrypt_light($request->fe_hl_ab_va_dis, $table),
          'linked_menstru'    => Crypt::encrypt_light($request->fe_Link_menstra, $table),
          'amount'            => Crypt::encrypt_light($request->fe_Amount, $table),
          'colour'            => Crypt::encrypt_light($request->fe_colour, $table),
          'colour_oth'        => Crypt::encrypt_light($request->fe_oth_colour, $table),

          'abn_veginal_odour' => Crypt::encrypt_light($request->fe_odour, $table),
          'l_abn_pain'        => Crypt::encrypt_light($request->fe_lower_abd_pain, $table),
          'l_abon_pain_hl'    => Crypt::encrypt_light($request->fe_hl_abd_pain, $table),
          'fever'             => Crypt::encrypt_light($request->fe_fever, $table),
          'rec_terminate_preg' => Crypt::encrypt_light($request->fe_terminate_preg, $table),
          'dyspareunia'       => Crypt::encrypt_light($request->fe_dyspareunia, $table),
          'oth_GI_sympt'      => Crypt::encryptString($request->fe_oth_gi_sym, $table),
          'dysuria'           => Crypt::encrypt_light($request->fe_dysuria, $table),
          'dysuria_hl'        => Crypt::encrypt_light($request->fe_howlong_dysuria, $table),
          'gen_prutitus'      => Crypt::encrypt_light($request->fe_genital_prutitus, $table),
          'gen_prutitus_hl'   => Crypt::encrypt_light($request->fe_howlong_genital_pruti, $table),
          'gen_burn_pain'     => Crypt::encrypt_light($request->fe_genital_burn, $table),
          'gen_burn_pain_hl'  => Crypt::encrypt_light($request->fe_howlong_genital_burn, $table),
          'gen_ulcer'         => Crypt::encrypt_light($request->fe_first_genital_ulcer, $table),
          'gen_ulcer_hl'      => Crypt::encrypt_light($request->fe_howlong_genital_ulcer, $table),
          'pain'              => Crypt::encrypt_light($request->fe_pain, $table),
          'ulcer'             => Crypt::encrypt_light($request->fe_ulcer, $table),
          'prodromal_itch'    => Crypt::encrypt_light($request->fe_prodormal_itch, $table),
          'vesicles'          => Crypt::encrypt_light($request->fe_start_vesicles, $table),
          'recurrent'         => Crypt::encrypt_light($request->fe_recurrent, $table),
          'recurrent_last_episode'  => Crypt::encrypt_light($request->fe_last_episode, $table),
          'patient_suspects_herpes' => Crypt::encrypt_light($request->fe_patient_suspect_herpes, $table),
          'inguinal_ln'             => Crypt::encrypt_light($request->fe_inguinal_lymph_node, $table),
          'inguinal_ln_hl'          => Crypt::encrypt_light($request->fe_hl_inguinal_lymph_node, $table),
          'unilateal_Bilateral'     => Crypt::encrypt_light($request->fe_unilateal, $table),
          'leg_ulcer_oth_inf'       => Crypt::encrypt_light($request->fe_leg_ulcer_inf, $table),
          'genital_warts'           => Crypt::encrypt_light($request->fe_genital_wart, $table),
          'genital_warts_hl'        => Crypt::encrypt_light($request->fe_hl_genital_wart, $table),
          //                                       fe_other_specify
          'phy_exam_done'           => Crypt::encrypt_light($request->fe_physical_exam, $table),
          'washed_inside'           => Crypt::encrypt_light($request->fe_wash_inside, $table),
          'vulvar_erythema'         => Crypt::encrypt_light($request->fe_vulvar_erythema, $table),
          'vulvar_odema'            => Crypt::encrypt_light($request->fe_vulvar_odema, $table),
          'vaginal_discharge'       => Crypt::encrypt_light($request->fe_vag_dis, $table),
          'vag_dis_amount'          => Crypt::encrypt_light($request->fe_vag_dis_amount, $table),
          'homogeneous'             => Crypt::encrypt_light($request->fe_homogeneous, $table),
          'homogeneous_col'         => Crypt::encrypt_light($request->fe_vag_dis_colour, $table),
          'smell_without_KOH'       => Crypt::encrypt_light($request->fe_smell_koh, $table),
          'vaginal_wall_injury'     => Crypt::encrypt_light($request->fe_phi_vag_wall, $table),
          'adnexal_tenderness'      => Crypt::encrypt_light($request->fe_phi_ad_tender, $table),
          'adnexal_enlargement'     => Crypt::encrypt_light($request->fe_phi_ad_enlarge, $table),
          'genital_blisters'        => Crypt::encrypt_light($request->fe_genital_blisters, $table),

          'genital_blisters_Location' => Crypt::encryptString($request->fe_genital_blisters_location, $table),
          'gential_ulcer'           => Crypt::encrypt_light($request->fe_genital_ulcer, $table),
          'gential_ulcerl'          => Crypt::encrypt_light($request->fe_genital_ulc_location, $table),

          'gent_ulcer_sm'           => Crypt::encrypt_light($request->fe_single_multiple, $table),
          'gential_ulcer_pain'      => Crypt::encrypt_light($request->fe_painfull, $table),
          'susp_herpes'             => Crypt::encrypt_light($request->fe_herpes_suspected, $table),
          'inguinal_bubo'           => Crypt::encrypt_light($request->fe_inguinal_bubo, $table),
          'fluctuant'               => Crypt::encrypt_light($request->fe_fluctant, $table),
          'fluctuant_tender'        => Crypt::encrypt_light($request->fe_tender, $table),
          'oth_leg_infection'       => Crypt::encrypt_light($request->fe_leg_inf, $table),
          'genital_wart'            => Crypt::encrypt_light($request->fephi_genital_wart, $table),

          'crab_lice'               => Crypt::encrypt_light($request->fe_crab_lice, $table),
          'scablices'               => Crypt::encrypt_light($request->fe_scabies, $table),
          'KOH_smell_test'          => Crypt::encrypt_light($request->fe_koh_smell, $table),
          'pH_vagina'               => Crypt::encrypt_light($request->fe_ph_vagina, $table),
          'des_size'                => Crypt::encryptString($request->fe_drawing_f, $table),

          'prev_STI'                => Crypt::encrypt_light($request->cal1, $table),
          'patient_genital_ulcer'   => Crypt::encrypt_light($request->cal3, $table),
          'patient_compl_low_abd'   => Crypt::encrypt_light($request->cal5, $table),
          'new_pat_past_3mont'      => Crypt::encrypt_light($request->cal2, $table),
          'part_compl_gential_sym'  => Crypt::encrypt_light($request->cal4, $table),
          'sworker'                 => Crypt::encrypt_light($request->cal6, $table),
          'rg_score'                => Crypt::encrypt_light($request->scoreAns, $table),
          'risk'                    => Crypt::encrypt_light($request->risk, $table),
          'risk_cal_remark'         => Crypt::encryptString($request->riskRemark, $table),
          'abn_yellow_disc'         => Crypt::encrypt_light($request->fe_ab_yellow_discharge, $table),
          'dysuria_risk_ass'        => Crypt::encrypt_light($request->cal8, $table),
          'low_abd_pain'            => Crypt::encrypt_light($request->cal10, $table),
          'pain_dur_sexual'         => Crypt::encrypt_light($request->cal7, $table),
          'unp_sex_new_clients'     => Crypt::encrypt_light($request->cal9, $table),
          'partner_ulcer'           => Crypt::encrypt_light($request->fe_partner_ulcer, $table),
          'presumptive_diag'        => Crypt::encryptString($request->fe_presumptive_diag, $table),
          'pri_syphillis'           => Crypt::encrypt_light($request->fe_primary_syphillis, $table),
          'sec_syphillis'           => Crypt::encrypt_light($request->fe_secondary_syphillis, $table),
          'chancroid'               => Crypt::encrypt_light($request->fe_chancroid, $table),
          'gen_herpes'              => Crypt::encrypt_light($request->fe_genital_herpes3, $table),
          'gen_scabies'             => Crypt::encrypt_light($request->fe_genital_scabies3, $table),
          //'gud_other'               => Crypt::encrypt_light( $request -> ,$table),
          'other_plz_specify'       => Crypt::encrypt_light($request->fe_other_specify, $table),
          'congenial_syphillis'     => Crypt::encrypt_light($request->fe_congenial_syphillis, $table),
          'Gonorhoea'               => Crypt::encrypt_light($request->fe_gonorrhoea, $table),
          'non_gono_urethritis'     => Crypt::encrypt_light($request->fe_non_gono_urethri, $table),
          'non_gono_cervities'      => Crypt::encrypt_light($request->fe_non_gono_cervities, $table),
          'trichomonas'             => Crypt::encrypt_light($request->fe_trichomonas, $table),
          'genital_candidiosis'     => Crypt::encrypt_light($request->fe_genital_candidiosis, $table),
          'beterial_vaginosis'      => Crypt::encrypt_light($request->fe_baterial_vaginosis, $table),
          'latent_syphillis_preg'   => Crypt::encrypt_light($request->fe_latent_syp_pregancy, $table),
          'latent_syphillis'        => Crypt::encrypt_light($request->fe_latent_syphillis, $table),
          'molluscum_contag'        => Crypt::encrypt_light($request->fe_molluscum_contagiosum, $table),
          'bubos'                   => Crypt::encrypt_light($request->fe_bubos, $table),
          'othstd_genital_warts'    => Crypt::encrypt_light($request->fe_genital_warts3, $table),
          'ostd_other'              => Crypt::encrypt_light($request->fe_others3, $table),
          'other_STD'               => Crypt::encrypt_light($request->fe_others33, $table),

          'tre_azythro'             => Crypt::encrypt_light($request->fe_tre_azythro, $table),
          'tre_cefixim'             => Crypt::encrypt_light($request->fe_tre_cefixim, $table),
          'tre_ciprofloxacin'       => Crypt::encrypt_light($request->fe_tre_ciprofloxacin, $table),
          'tre_tinidazole'          => Crypt::encrypt_light($request->fe_tre_tinidazole, $table),
          'tre_fluconazole'         => Crypt::encrypt_light($request->fe_tre_fluconazole, $table),
          'tre_doxycycline'         => Crypt::encrypt_light($request->fe_tre_doxycycline, $table),
          'tre_ceftriaxone'         => Crypt::encrypt_light($request->fe_tre_ceftriaxone, $table),
          'tre_benz_pen'            => Crypt::encrypt_light($request->fe_tre_benzpen, $table),
          'clotrimazole_vaginal_tab' => Crypt::encrypt_light($request->fe_clotrimazole, $table),
          'tre_Other'               => Crypt::encrypt_light($request->fe_no_treament, $table),
          'al_Penicillin'           => Crypt::encrypt_light($request->fe_allergy, $table),
          'al_sulfa'                => Crypt::encrypt_light($request->fe_sulfa, $table),
          'part_treat'              => Crypt::encrypt_light($request->fe_parter_treatment_given, $table),
          'condom_giv'              => Crypt::encrypt_light($request->fe_condom, $table),
          'tre_remarks'             => Crypt::encryptString($request->fe_remarkTreatment, $table),
          'followup'                => Crypt::encryptString($request->fe_follwupText, $table),
          'clinician'               => Crypt::encryptString($request->fe_clinicainName, $table),
        ]);
      $success = $request->fe_firstVisit;
      return response()->json([$success]);
    }
    if ($sti_Updated_fill == "sti_fill_data") {
      $fill_id =  $request->input('fill_id');
      $updated_rowID =  $request->input('updated_rowID');
      $updatedsex =  $request->input('updatedsex');
      $patientMale = [];
      $patientFemale = [];
      $test;
      $gt_pateint = PtConfig::select("FuchiaID", "Agey", "Gender", "Main Risk",)->where('Pid', $fill_id)->get();
      $gt_pateint[0]["Main Risk"] = Crypt::decrypt_light($gt_pateint[0]["Main Risk"], $table);
      $gt_pateint[0]["Gender"] = Crypt::decrypt_light($gt_pateint[0]["Gender"], $table);

      // $success=$gt_pateint;

      if ($updatedsex == "male") {
        $patientMale_encrpt = Stimale::where('cid', $fill_id)->where('id', $updated_rowID)->get();
        $large_encData = [
          'presumptive_diag',
          'tre_remarks',
          'followup',
          'clinician_name',
        ];
        $male_dataName = [
          'tbl_demog_first_visit',
          'Expr1',
          'last_vis_within',


          'about_clinic',
          'demo_remarks',

          'visit_type',
          'visit_time',
          'followup_visit',
          'episode',
          'Reason for Visit',
          'risk_factor',
          'urethral_disc',
          'urethral_disc_hl',
          'dysuria',
          'dysuria_hl',
          'genital_prut',
          'genital_prut_hl',
          'genital_pain',
          'genital_pain_hl',
          'genital_ulcer',
          'genital_ulcer_hl',
          'pain',
          'ulcer',
          'prodromal_itch',
          'vesicles',
          'recurrent',
          'last_episode',
          'suspects_herpes',
          'ing_lymph_node',
          'ing_lymph_node_hl',
          'unilateal',
          'leg_ulcer',
          'scrotal_swelling',
          'scrotal_swelling_hl',
          'td_ntd',
          'gen_wart',
          'gen_wart_hl',
          'physical_exam',
          'urinated_wit_1h',
          'discharge',
          'discharge_milk',
          'colour',
          'erythema',
          'blisters',
          'gen_ulcer',
          'esti_size',
          'sing_multi',
          'pain_full_less',
          'herpes_suspect',
          'inguinal_bubo',
          'fluctant',
          'tendr_ntender',
          'oth_leg_inf',
          'phy_genital_wart',
          'crab_lice',
          'scabies',
          'gscrotal_swelling',
          'estimated_siz',
          'unilateal_bilateral',
          'gtender_ntender',
          'erythem',
          'des_size',
          'tbl_treat_diagnosis_first_visit',
          'epi_discharge',
          'unprot_sex_new_part',
          'genital_signs',

          'pri_syphillis',
          'sec_syphillis',
          'chancroid',
          'gen_herpes',
          'gen_scabies',
          'gud_other',
          'ostd_other',
          'Gonorhoea',
          'non_gono_urethritis',
          'non_gono_cervities',
          'trichomonas',
          'genital_candidiosis',
          'beterial_vaginosis',
          'congenial_syphillis',
          'latent_syphillis',
          'molluscum_contag',
          'bubos',
          'othstd_genital_warts',
          'ostd_other',
          'tre_azythro',
          'tre_cefixim',
          'tre_ciprofloxacin',
          'tre_tinidazole',
          'tre_fluconazole',
          'tre_doxycycline',
          'tre_ceftriaxone',
          'tre_benz_pen',
          'no_treat',
          'al_Penicillin',
          'al_sulfa',
          'part_treat',
          'condom_giv',
          'non_gono_procti',
        ];
        $no_encryptData = [
          'clinic',
          'CID',
          'fuchiaID',
          'age',
          'Visit_date',
          'id',
        ];


        for ($testcount = 0; $testcount < count($male_dataName); $testcount++) {
          $patientMale[0][$male_dataName[$testcount]] = Crypt::decrypt_light($patientMale_encrpt[0][$male_dataName[$testcount]], $table);
        }; //no encrypt data
        for ($testcount = 0; $testcount < count($no_encryptData); $testcount++) {
          $patientMale[0][$no_encryptData[$testcount]] = $patientMale_encrpt[0][$no_encryptData[$testcount]];
        }; //light encrypt data
        for ($testcount = 0; $testcount < count($large_encData); $testcount++) {
          $patientMale[0][$large_encData[$testcount]] = Crypt::decryptString($patientMale_encrpt[0][$large_encData[$testcount]], $table);
        } //laravel encrypt data

      } else if ($updatedsex == "female") {


        $patientFemale_encrpt = Stifemale::where('cid', $fill_id)->where('id', $updated_rowID)->get();
        $feno_encryptData = ['clinic', 'CID', 'fuchiaID', 'age', 'Visit_date', 'id',];
        $female_dataName = [
          'gender',
          'tbl_demog_first_visit',
          'last_vis_within',
          'vtype',
          'age',
          'about_clinic',
          'demo_remarks',
          'first_visit',

          'Expr1',
          'episode',
          'rea_for_visit',
          'risk_factor',
          'abn_vaginal_disc',
          'abn_vaginal_disc_long',
          'linked_menstru',
          'amount',
          'colour',
          'colour_oth',
          'abn_veginal_odour',
          'l_abn_pain',
          'l_abon_pain_hl',
          'fever',
          'rec_terminate_preg',
          'dyspareunia',

          'dysuria',
          'dysuria_hl',
          'gen_prutitus',
          'gen_prutitus_hl',
          'gen_burn_pain',
          'gen_burn_pain_hl',
          'gen_ulcer',
          'gen_ulcer_hl',
          'pain',
          'ulcer',
          'prodromal_itch',
          'vesicles',
          'recurrent',
          'recurrent_last_episode',
          'patient_suspects_herpes',
          'inguinal_ln',
          'inguinal_ln_hl',
          'unilateal_Bilateral',
          'leg_ulcer_oth_inf',
          'genital_warts',
          'genital_warts_hl',
          'phy_exam_done',
          'washed_inside',
          'vulvar_erythema',
          'vulvar_odema',
          'vaginal_discharge',
          'vag_dis_amount',
          'homogeneous',
          'homogeneous_col',
          'smell_without_KOH',
          'vaginal_wall_injury',
          'adnexal_tenderness',
          'adnexal_enlargement',
          'genital_blisters',

          'gential_ulcer',
          'gential_ulcerl',
          'gent_ulcer_sm',
          'gential_ulcer_pain',
          'susp_herpes',
          'inguinal_bubo',
          'fluctuant',
          'fluctuant_tender',
          'oth_leg_infection',
          'genital_wart',
          'crab_lice',
          'scablices',
          'KOH_smell_test',
          'pH_vagina',

          'prev_STI',
          'patient_genital_ulcer',
          'patient_compl_low_abd',
          'new_pat_past_3mont',
          'part_compl_gential_sym',
          'sworker',
          'rg_score',
          'risk',

          'abn_yellow_disc',
          'dysuria_risk_ass',
          'low_abd_pain',
          'pain_dur_sexual',
          'unp_sex_new_clients',
          'partner_ulcer',

          'pri_syphillis',
          'sec_syphillis',
          'chancroid',
          'gen_herpes',
          'gen_scabies',
          'gud_other',
          'other_plz_specify',
          'Gonorhoea',
          'non_gono_urethritis',
          'non_gono_cervities',
          'trichomonas',
          'genital_candidiosis',
          'beterial_vaginosis',
          'congenial_syphillis',
          'latent_syphillis',
          'latent_syphillis_preg',
          'molluscum_contag',
          'bubos',
          'othstd_genital_warts',
          'ostd_other',
          'tre_azythro',
          'tre_cefixim',
          'tre_ciprofloxacin',
          'tre_tinidazole',
          'tre_fluconazole',
          'tre_doxycycline',
          'tre_ceftriaxone',
          'tre_benz_pen',
          'tre_Other',
          'clotrimazole_vaginal_tab',
          'no_treatment',
          'al_Penicillin',
          'al_sulfa',
          'part_treat',
          'condom_giv',
          'other_STD',

        ];
        $felarge_encData = [
          'oth_GI_sympt',
          'genital_blisters_Location',
          'des_size',
          'risk_cal_remark',
          'presumptive_diag',
          'tre_remarks',
          'followup',
          'clinician',
        ];
        for ($testcount = 0; $testcount < count($female_dataName); $testcount++) {
          $patientFemale[0][$female_dataName[$testcount]] = Crypt::decrypt_light($patientFemale_encrpt[0][$female_dataName[$testcount]], $table);
        }; //light encrypt data
        for ($testcount = 0; $testcount < count($feno_encryptData); $testcount++) {
          $patientFemale[0][$feno_encryptData[$testcount]] = $patientFemale_encrpt[0][$feno_encryptData[$testcount]];
        }; //no encrypt data
        for ($testcount = 0; $testcount < count($felarge_encData); $testcount++) {
          $patientFemale[0][$felarge_encData[$testcount]] = Crypt::decryptString($patientFemale_encrpt[0][$felarge_encData[$testcount]], $table);
        } //laravel encrypt data


      }

      return response()->json([
        $gt_pateint,
        $patientMale,
        $patientFemale,
      ]);
      //$patientMale_encrpt[0][$male_dataName[$test_count]],$patientMale_encrpt[0]['demo_remarks'],


    }
    if ($notice == "sti_remove_data") {
      $remove_date = $request["remove_date"];
      $Pid = $request["remove_id"];
      $remvoe_rowID = $request["remvoe_rowID"];
      $remove_sex = $request["removesex"];
      if ($remove_sex == "male") {
        $sti_remove_exsits = Stimale::where("id", $remvoe_rowID)->where("CID", $Pid)->where("Visit_date", $remove_date)->exists();
        if ($sti_remove_exsits) {
          Stimale::where("id", $remvoe_rowID)->where("CID", $Pid)->where("Visit_date", $remove_date)->delete();
          return response()->json(["Successfully Delete"]);
        } else {
          return response()->json(["Your data is not valid to delete contant to Admin"]);
        }
      } else if ($remove_sex == "female") {
        $sti_remove_exsits = Stifemale::where("id", $remvoe_rowID)->where("CID", $Pid)->where("Visit_date", $remove_date)->exists();
        if ($sti_remove_exsits) {
          Stifemale::where("id", $remvoe_rowID)->where("CID", $Pid)->where("Visit_date", $remove_date)->delete();
          return response()->json(["Successfully Delete"]);
        } else {
          return response()->json(["Your data is not valid to delete contant to Admin"]);
        }
      }
    }
  }

  public function stiReport_Calculator(Request $request)
  {
    $calculator = $request->input('calculate');
    $chart = $request->input('chart');
    $stiRange = $request->input('range');
    $rpMonth = $request->input('month');
    $stiYear = $request->input('year');

    if ($calculator == 1) {
      if ($stiYear == "2021") {
        if ($stiRange == "onlyOne") //to calculate monthly
        {
          if ($rpMonth == 9) {
            $from = date('2021-09-01');
            $to = date('2021-09-30');
            $from_ck_new_old = date('2021-1-1');
            $to_ck_new_old = date('2021-8-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 10) {
            $from = date('2021-10-01');
            $to = date('2021-10-31');
            $from_ck_new_old = date('2021-1-1');
            $to_ck_new_old = date('2021-9-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 11) {
            $from = date('2021-11-01');
            $to = date('2021-11-30');
            $from_ck_new_old = date('2021-1-1');
            $to_ck_new_old = date('2021-10-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 12) {
            $from = date('2021-12-01');
            $to = date('2021-12-31');
            $from_ck_new_old = date('2021-1-1');
            $to_ck_new_old = date('2021-12-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
        }
        if ($stiRange == "firstQ") //to calculate First Quarter
        {
        }
        if ($stiRange == "secondQ") //to calculate Second Quarter
        {
        }
        if ($stiRange == "thirdQ") //to calculate Third Quarter
        {
        }
        if ($stiRange == "annual") //to calculate Annual Year
        {
        }
      }
      if ($stiYear == "2022") {
        if ($stiRange == "onlyOne") //to calculate monthly
        {
          if ($rpMonth == 1) {
            $from = date('2022-01-01');
            $to = date('2022-01-31');

            return $this->dataDrawer($from, $to, $rpMonth, $stiRange);
          }
          if ($rpMonth == 2) {
            $from = date('2022-02-01');
            $to = date('2022-02-28');
            $from_ck_new_old = date('2022-01-01');
            $to_ck_new_old = date('2022-01-31');
            $loopTime = 1;
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 3) {
            $from = date('2022-03-01');
            $to = date('2022-03-31');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-2-28');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 4) {
            $from = date('2022-04-01');
            $to = date('2022-04-30');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-3-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 5) {
            $from = date('2022-05-01');
            $to = date('2022-05-31');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-4-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 6) {
            $from = date('2022-06-01');
            $to = date('2022-06-30');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-5-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 7) {
            $from = date('2022-07-01');
            $to = date('2022-07-31');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-6-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 8) {
            $from = date('2022-08-01');
            $to = date('2022-08-28');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-7-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 9) {
            $from = date('2022-09-01');
            $to = date('2022-09-28');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-8-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 10) {
            $from = date('2022-10-01');
            $to = date('2022-10-28');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-9-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 11) {
            $from = date('2022-11-01');
            $to = date('2022-11-28');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-10-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 12) {
            $from = date('2022-12-01');
            $to = date('2022-12-28');
            $from_ck_new_old = date('2022-1-1');
            $to_ck_new_old = date('2022-11-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
        }
        if ($stiRange == "firstQ") //to calculate First Quarter
        {
        }
        if ($stiRange == "secondQ") //to calculate Second Quarter
        {
        }
        if ($stiRange == "thirdQ") //to calculate Third Quarter
        {
        }
        if ($stiRange == "annual") //to calculate Annual Year
        {
        }
      }
      if ($stiYear == "2023") {
        if ($stiRange == "onlyOne") //to calculate monthly
        {
          if ($rpMonth == 1) {
            $from = date('2023-01-01');
            $to = date('2023-01-31');

            return $this->dataDrawer($from, $to, $rpMonth, $stiRange);
          }
          if ($rpMonth == 2) {
            $from = date('2023-02-01');
            $to = date('2023-02-28');
            $from_ck_new_old = date('2023-01-01');
            $to_ck_new_old = date('2023-01-31');
            $loopTime = 1;
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 3) {
            $from = date('2023-03-01');
            $to = date('2023-03-31');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-2-28');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 4) {
            $from = date('2023-04-01');
            $to = date('2023-04-30');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-3-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 5) {
            $from = date('2023-05-01');
            $to = date('2023-05-31');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-4-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 6) {
            $from = date('2023-06-01');
            $to = date('2023-06-30');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-5-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 7) {
            $from = date('2023-07-01');
            $to = date('2023-07-31');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-6-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 8) {
            $from = date('2023-08-01');
            $to = date('2023-08-28');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-7-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 9) {
            $from = date('2023-09-01');
            $to = date('2023-09-28');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-8-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 10) {
            $from = date('2023-10-01');
            $to = date('2023-10-28');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-9-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 11) {
            $from = date('2023-11-01');
            $to = date('2023-11-28');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-10-31');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
          if ($rpMonth == 12) {
            $from = date('2023-12-01');
            $to = date('2023-12-28');
            $from_ck_new_old = date('2023-1-1');
            $to_ck_new_old = date('2023-11-30');
            return $this->dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange);
          }
        }
        if ($stiRange == "firstQ") //to calculate First Quarter
        {
        }
        if ($stiRange == "secondQ") //to calculate Second Quarter
        {
        }
        if ($stiRange == "thirdQ") //to calculate Third Quarter
        {
        }
        if ($stiRange == "annual") //to calculate Annual Year
        {
        }
      }
    }
    if ($chart == 1) {
      if ($stiYear == "2021") {
        if ($stiRange == "firstQ") //to calculate First Quarter
        {
          $from9 = date('2021-09-01');
          $to9 = date('2021-09-30');
          $from10 = date('2021-10-01');
          $to10 = date('2021-10-31');
          $from11 = date('2021-11-01');
          $to11 = date('2021-11-30');
          $from12 = date('2021-12-01');
          $to12 = date('2021-12-31');
          return $this->firstQuarter($from9, $to9, $from10, $to10, $from11, $to11, $from12, $to12);
        }
        if ($stiRange == "secondQ") //to calculate Second Quarter
        {
        }
        if ($stiRange == "thirdQ") //to calculate Third Quarter
        {
        }
        if ($stiRange == "annual") //to calculate Annual Year
        {
        }
      }
      if ($stiYear == "2022") {
        if ($stiRange == "firstQ") //to calculate First Quarter
        {
        }
        if ($stiRange == "secondQ") //to calculate Second Quarter
        {
        }
        if ($stiRange == "thirdQ") //to calculate Third Quarter
        {
        }
        if ($stiRange == "annual") //to calculate Annual Year
        {
        }
      }
      if ($stiYear == "2023") {
        if ($stiRange == "firstQ") //to calculate First Quarter
        {
        }
        if ($stiRange == "secondQ") //to calculate Second Quarter
        {
        }
        if ($stiRange == "thirdQ") //to calculate Third Quarter
        {
        }
        if ($stiRange == "annual") //to calculate Annual Year
        {
        }
      }
    }
  }
  //database dbx_query
  public function dataDrawer($from, $to, $from_ck_new_old, $to_ck_new_old, $rpMonth, $stiRange)
  {
    //attendence
    $rp_month_m = Stimale::whereBetween('Visit_date', [$from, $to])->get();
    $old_month_m = Stimale::whereBetween('Visit_date', [$from_ck_new_old, $to_ck_new_old])->get();


    $rp_month_ID_m = array();
    for ($i = 0; $i < count($rp_month_m); $i++) {
      $rp_month_ID_m[] = intval($rp_month_m[$i]['CID']); // this is report month's all ID
    }

    $rp_monthID_unique = array();
    foreach ($rp_month_ID_m as $key => $value) {
      $rp_monthID_unique[] = $value;
    }
    rsort($rp_monthID_unique);
    //$rp_monthID_unique = array_unique($rp_monthID_unique);
    //$aa = array_diff_key( $rp_month_ID_m , array_unique($rp_month_ID_m ) );


    $old_month_ID_m = array();
    for ($i = 0; $i < count($old_month_m); $i++) {
      $old_month_ID_m[] = $old_month_m[$i]['CID']; // this is old month's all ID before report Month ID
    }
    $intersectID = array_intersect($rp_month_ID_m, $old_month_ID_m);
    $differID_a = array_diff($rp_month_ID_m, $intersectID);
    $differID_b = array_diff($intersectID, $rp_month_ID_m);
    $differID = array_merge($differID_a, $differID_b); // this is differend ID between report Month and Old months

    // For Gonorrhea Only Male
    $gono_14_m = 0;
    $gono_24_m = 0;
    $gono_25_m = 0;
    for ($i = 0; $i < count($rp_monthID_unique); $i++) {

      $rp_ID_Unique = $rp_monthID_unique[$i]; // Unique ID from report Month

      $rp_pt_rows = Stimale::whereBetween('Visit_date', [$from, $to])
        ->orderBy('Visit_date')
        ->where('CID', $rp_ID_Unique)
        ->get();
      $countGono = count($rp_pt_rows);
      if ($countGono > 0) {
        if ($countGono == 1) {
          $rpMonthAge = intval($rp_pt_rows[0]['age']);
          $rpMonthGono = intval($rp_pt_rows[0]['Gonorhoea']);
          if ($rpMonthAge < 15) {
            if ($rpMonthGono == 1) {
              $gono_14_m += 1;
            }
          }
          if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
            if ($rpMonthGono == 1) {
              $gono_24_m += 1;
            }
          }
          if ($rpMonthAge >= 25) {
            if ($rpMonthGono == 1) {
              $gono_25_m += 1;
            }
          }
        }

        if ($countGono  == 2) { /// duplicate id
          $gonoArray = array();
          for ($a = 0; $a < $countGono; $a++) {

            $rpMonthAge = intval($rp_pt_rows[$a]['age']);
            $gonoArray[] = intval($rp_pt_rows[$a]['Gonorhoea']);
          }
          if ($gonoArray[0] == 1 and $gonoArray[1] == 1) {
            if ($rpMonthAge < 15) {
              $gono_14_m += 1;
            }
            if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
              $gono_24_m += 1;
            }
            if ($rpMonthAge >= 25) {
              $gono_25_m += 1;
            }
          }
          if ($gonoArray[0] == 2 and $gonoArray[1] == 1) {
            if ($rpMonthAge < 15) {
              $gono_14_m += 1;
            }
            if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
              $gono_24_m += 1;
            }
            if ($rpMonthAge >= 25) {
              $gono_25_m += 1;
            }
          }
        }
        if ($countGono == 3) {
          if ($gonoArray[0] == 2 and $gonoArray[1] == 2 and $gonoArray == 1) {
            if ($rpMonthAge < 15) {
              $gono_14_m += 1;
            }
            if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
              $gono_24_m += 1;
            }
            if ($rpMonthAge >= 25) {
              $gono_25_m += 1;
            }
          }
          if ($gonoArray[0] == 1 and $gonoArray[1] == 2 and $gonoArray == 1) {
            if ($rpMonthAge < 15) {
              $gono_14_m += 1;
            }
            if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
              $gono_24_m += 1;
            }
            if ($rpMonthAge >= 25) {
              $gono_25_m += 1;
            }
          }
        }
      }
    }
    //////////////// Gono End ///////////////





    // For RPR results Only Male
    $msm_P_14_m = 0;
    $msm_rdt_14_m = 0;
    $tg_rdt_14_m = 0;
    $tg_P_14_m = 0;
    $idu_P_14_m = 0;
    $idu_rdt_14_m = 0;
    $msm_P_24_m = 0;
    $msm_rdt_24_m = 0;
    $tg_rdt_24_m = 0;
    $tg_P_24_m = 0;
    $idu_P_24_m = 0;
    $idu_rdt_24_m = 0;
    $msm_P_25_m = 0;
    $msm_rdt_25_m = 0;
    $tg_rdt_25_m = 0;
    $tg_P_25_m = 0;
    $idu_P_25_m = 0;
    $idu_rdt_25_m = 0;

    $rpr_month_m = Rprtest::whereBetween('visit_date', [$from, $to])->get();
    $rpr_month_m_back = Rprtest::whereBetween('visit_date', [$from_ck_new_old, $to_ck_new_old])->get();
    // for rpr
    $rpr_month_ID_m = array();
    for ($i = 0; $i < count($rpr_month_m); $i++) {
      $rpr_month_ID_m[] = intval($rpr_month_m[$i]['pid']); // this is report month's all ID
    }
    $rpr_monthID_unique = array();
    foreach ($rpr_month_ID_m as $key => $value) {
      $rpr_monthID_unique[] = $value;
    }
    rsort($rpr_monthID_unique);
    /// old months History
    $old_month_ID_m_rpr = array();
    for ($i = 0; $i < count($rpr_month_m_back); $i++) {
      $old_month_ID_m_rpr[] = $rpr_month_m_back[$i]['pid']; // this is old month's all ID before report Month ID
    }
    $intersectID_rpr = array_intersect($rpr_month_ID_m, $old_month_ID_m_rpr); // to get back history
    $differID_a_rpr = array_diff($rpr_month_ID_m, $intersectID_rpr); // to get very very new patient
    $differID_b_rpr = array_diff($intersectID_rpr, $rpr_month_ID_m); // to get very very new patient
    $differID_rpr = array_merge($differID_a_rpr, $differID_b_rpr); // this is differend ID between report Month and Old months

    //////////// For very very New patients Section
    $rpr_newID = array();
    foreach ($differID_rpr as $key => $value) {
      $rpr_newID[] = $value;
    }

    for ($i = 0; $i < count($rpr_newID); $i++) {
      $rp_ID_new = $rpr_newID[$i];
      $rpMonth_New_Rows = Rprtest::whereBetween('visit_date', [$from, $to])
        ->orderBy('visit_date', 'desc')
        ->where('pid', $rp_ID_new)
        ->get();
      $rpMonthAge = intval($rpMonth_New_Rows[0]['agey']);
      $risk_sub = $rpMonth_New_Rows[0]['Patient Type Sub'];
      $rdt_result = $rpMonth_New_Rows[0]['RDT Result'];
      $counter_rpr_new = count($rpMonth_New_Rows);
      if ($counter_rpr_new == 1) {
        if ($rpMonthAge < 15) {
          if ($risk_sub == "MSM") {
            if ($rdt_result == "Positive") {
              $msm_P_14_m += 1;
              $msm_rdt_14_m += 1;
            }
            if ($rdt_result == "Negative") {
              $msm_rdt_14_m += 1;
            }
          }
          if ($risk_sub == "TG") {
            if ($rdt_result == "Positive") {
              $tg_P_14_m += 1;
              $tg_rdt_14_m += 1;
            }
            if ($rdt_result == "Negative") {
              $tg_rdt_14_m += 1;
            }
          }
        }
        if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
          if ($risk_sub == "MSM") {
            if ($rdt_result == "Positive") {
              $msm_P_24_m += 1;
              $msm_rdt_24_m += 1;
            }
            if ($rdt_result == "Negative") {
              $msm_rdt_24_m += 1;
            }
          }
          if ($risk_sub == "TG") {
            if ($rdt_result == "Positive") {
              $tg_P_24_m += 1;
              $tg_rdt_24_m += 1;
            }
            if ($rdt_result == "Negative") {
              $tg_rdt_24_m += 1;
            }
          }
          if ($risk_sub == "IDU") {
            if ($rdt_result == "Positive") {
              $idu_P_24_m += 1;
              $idu_rdt_24_m += 1;
            }
            if ($rdt_result == "Negative") {
              $idu_rdt_24_m += 1;
            }
          }
        }
        if ($rpMonthAge >= 25) {
          if ($risk_sub == "MSM") {
            if ($rdt_result == "Positive") {
              $msm_P_25_m += 1;
              $msm_rdt_25_m += 1;
            }
            if ($rdt_result == "Negative") {
              $msm_rdt_25_m += 1;
            }
          }
          if ($risk_sub == "TG") {
            if ($rdt_result == "Positive") {
              $tg_P_25_m += 1;
              $tg_rdt_25_m += 1;
            }
            if ($rdt_result == "Negative") {
              $tg_rdt_25_m += 1;
            }
          }
          if ($risk_sub == "IDU") {
            if ($rdt_result == "Positive") {
              $idu_P_25_m += 1;
              $idu_rdt_25_m += 1;
            }
            if ($rdt_result == "Negative") {
              $idu_rdt_25_m += 1;
            }
          }
        }
      }
      if ($counter_rpr_new == 2) {
        if ($rpMonthAge < 15) {
          $rdt_result_1 = $rpMonth_New_Rows[1]['RDT Result'];
          if ($risk_sub == "MSM") {
            if ($rdt_result = "Negative" and $rdt_result_1 == "Positive") {
              $msm_P_14_m += 1;
              $msm_rdt_14_m += 2;
            }
            if ($rdt_result = "Negative" and $rdt_result_1 == "Negative") {
              $msm_rdt_14_m += 1;
            }
          }
          if ($risk_sub == "TG") {
            if ($rdt_result != $rdt_result_1 and $rdt_result_1 == "Positive") {
              $msm_P_14_m += 1;
              $msm_rdt_14_m += 2;
            }
            if ($rdt_result = "Negative" and $rdt_result_1 == "Negative") {
              $msm_rdt_14_m += 1;
            }
          }
        }
        if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
          $rdt_result_1 = $rpMonth_New_Rows[1]['RDT Result'];
          if ($risk_sub == "MSM") {
            if ($rdt_result != $rdt_result_1 and $rdt_result_1 == "Positive") {
              $msm_P_24_m += 1;
              $msm_rdt_24_m += 2;
            }
            if ($rdt_result = "Negative" and $rdt_result_1 == "Negative") {
              $msm_rdt_24_m += 1;
            }
          }
          if ($risk_sub == "TG") {
            if ($rdt_result != $rdt_result_1 and $rdt_result_1 == "Positive") {
              $msm_P_24_m += 1;
              $msm_rdt_24_m += 2;
            }
            if ($rdt_result = "Negative" and $rdt_result_1 == "Negative") {
              $msm_rdt_24_m += 1;
            }
          }
        }
        if ($rpMonthAge >= 25) {
          $rdt_result_1 = $rpMonth_New_Rows[1]['RDT Result'];
          if ($risk_sub == "MSM") {
            if ($rdt_result != $rdt_result_1 and $rdt_result_1 == "Positive") {
              $msm_P_25_m += 1;
              $msm_rdt_25_m += 2;
            }
            if ($rdt_result = "Negative" and $rdt_result_1 == "Negative") {
              $msm_rdt_25_m += 1;
            }
          }
          if ($risk_sub == "TG") {
            if ($rdt_result != $rdt_result_1 and $rdt_result_1 == "Positive") {
              $msm_P_25_m += 1;
              $msm_rdt_25_m += 2;
            }
            if ($rdt_result = "Negative" and $rdt_result_1 == "Negative") {
              $msm_rdt_25_m += 1;
            }
          }
        }
      }
    }
    /////////RPR Old connected data /////////////////
    $msm_P_14_m_old = 0;
    $msm_rdt_14_m_old = 0;
    $tg_rdt_14_m_old = 0;
    $tg_P_14_m_old = 0;
    $idu_rdt_14_m_old = 0;
    $idu_P_14_m_old = 0;
    $msm_P_24_m_old = 0;
    $msm_rdt_24_m_old = 0;
    $tg_rdt_24_m_old = 0;
    $tg_P_24_m_old = 0;
    $idu_rdt_24_m_old = 0;
    $idu_P_14_m_old = 0;
    $msm_P_25_m_old = 0;
    $msm_rdt_25_m_old = 0;
    $tg_rdt_25_m_old = 0;
    $tg_P_25_m_old = 0;
    $idu_rdt_25_m_old = 0;
    $idu_P_14_m_old = 0;
    $idu_P_14_m_old = 0;
    $idu_rdt_14_m_old = 0;
    $idu_P_24_m_old = 0;
    $idu_rdt_24_m_old = 0;
    $idu_P_25_m_old = 0;
    $idu_rdt_25_m_old = 0;
    $needyID_rpr = array();
    $intersectID_rpr =  array_unique($intersectID_rpr);
    foreach ($intersectID_rpr as $key => $value) {
      $needyID_rpr[] = $value;
    }

    for ($i = 0; $i < count($needyID_rpr); $i++) { // without duplicate ID
      $rpID_rpr = $needyID_rpr[$i];
      $rpMonth_Rows = Rprtest::whereBetween('visit_date', [$from, $to])
        ->orderBy('visit_date', 'desc')
        ->where('pid', $rpID_rpr)
        ->get();
      $rp_Age = $rpMonth_New_Rows[0]['agey'];
      $risk_sub = $rpMonth_New_Rows[0]['Patient Type Sub'];
      $rdt_result = $rpMonth_New_Rows[0]['RDT Result'];

      $old_pt_rows = Rprtest::whereBetween('visit_date', [$from_ck_new_old, $to_ck_new_old])
        ->orderBy('visit_date', 'desc')
        ->where('pid', $rpID_rpr)
        ->get();
      $rdt_result_1 = $old_pt_rows[0]['RDT Result'];
      if ($rp_Age < 15) {
        if ($risk_sub == "MSM") {
          if ($rdt_result == "Positive" and $rdt_result_1 == "Negative") {
            $msm_P_14_m_old += 1;
            $msm_rdt_14_m_old += 1;
          }
        }
        if ($risk_sub == "TG") {
          if ($rdt_result == "Positive" and $rdt_result_1 == "Negative") {
            $msm_P_14_m_old += 1;
            $msm_rdt_14_m_old += 1;
          }
        }
      }
      if ($rp_Age >= 15 and $rp_Age < 25) {
        if ($risk_sub == "MSM") {
          if ($rdt_result == "Positive" and $rdt_result_1 == "Negative") {
            $msm_P_24_m_old += 1;
            $msm_rdt_24_m_old += 1;
          }
        }
        if ($risk_sub == "TG") {
          if ($rdt_result == "Positive" and $rdt_result_1 == "Negative") {
            $msm_P_24_m_old += 1;
            $msm_rdt_24_m_old += 1;
          }
        }
        if ($risk_sub == "IDU") {
          if ($rdt_result_1 == "Negative" and $rdt_result == "Positive") {
            $idu_P_25_m_old += 1;
            $idu_rdt_25_m_old += 1;
          }
        }
      }
      if ($rp_Age >= 25) {
        if ($risk_sub == "MSM") {
          if ($rdt_result_1 == "Negative" and $rdt_result == "Positive") {
            $msm_P_25_m_old += 1;
            $msm_rdt_25_m_old += 1;
          }
        }
        if ($risk_sub == "TG") {
          if ($rdt_result_1 == "Negative" and $rdt_result == "Positive") {
            $msm_P_25_m_old += 1;
            $msm_rdt_25_m_old += 1;
          }
        }
        if ($risk_sub == "IDU") {
          if ($rdt_result_1 == "Negative" and $rdt_result == "Positive") {
            $idu_P_25_m_old += 1;
            $idu_rdt_25_m_old += 1;
          }
        }
      }
    }

    // Combination section

    $msm_P_14_m += $msm_P_14_m_old;
    $msm_rdt_14_m += $msm_rdt_14_m_old;
    $tg_rdt_14_m += $tg_rdt_14_m_old;
    $tg_P_14_m += $tg_P_14_m_old;
    $msm_P_24_m += $msm_P_24_m_old;
    $msm_rdt_24_m += $msm_rdt_24_m_old;
    $tg_rdt_24_m += $tg_rdt_24_m_old;
    $tg_P_24_m += $tg_P_24_m_old;
    $msm_P_25_m += $msm_P_25_m_old;
    $msm_rdt_25_m += $msm_rdt_25_m_old;
    $tg_rdt_25_m += $tg_rdt_25_m_old;
    $tg_P_25_m += $tg_P_25_m_old;

    $idu_P_14_m += $idu_P_14_m_old;
    $idu_rdt_14_m += $idu_rdt_14_m_old;
    $idu_P_24_m += $idu_P_24_m_old;
    $idu_rdt_24_m += $idu_rdt_24_m_old;
    $idu_P_25_m += $idu_P_25_m_old;
    $idu_rdt_25_m += $idu_rdt_25_m_old;
    // Combination End


    //Male ____other OI of Gono //////// Checking with Old Oi History in a calendar Year
    $G1_pri_syp_14 = 0;
    $rp_G1_sec_syp_14 = 0;
    $rp_G1_chan_14 = 0;
    $rp_G1_gen_herpes_14 = 0;
    $rp_G1_gen_scabies_14 = 0;
    $rp_G1_gud_other_14 = 0;
    $rp_G2_non_gono_ure_14 = 0;
    $rp_Gw_non_gono_cer_14 = 0;
    $rp_G2_trichomonas_14 = 0;
    $rp_G2_gen_candidiosis_14 = 0;
    $rp_G2_beterial_vaginosis_14 = 0;
    $rp_G3_congenial_syphillis_14 = 0;
    $rp_G3_latent_syphillis_14 = 0;
    $rp_G3_molluscum_contag_14 = 0;
    $rp_G3_bubos_14 = 0;
    $rp_G3_othstd_genital_warts_14 = 0;
    $rp_G3_ostd_other_14 = 0;
    $G1_pri_syp_24 = 0;
    $rp_G1_sec_syp_24 = 0;
    $rp_G1_chan_24 = 0;
    $rp_G1_gen_herpes_24 = 0;
    $rp_G1_gen_scabies_24 = 0;
    $rp_G1_gud_other_24 = 0;
    $rp_G2_non_gono_ure_24 = 0;
    $rp_Gw_non_gono_cer_24 = 0;
    $rp_G2_trichomonas_24 = 0;
    $rp_G2_gen_candidiosis_24 = 0;
    $rp_G2_beterial_vaginosis_24 = 0;
    $rp_G3_congenial_syphillis_24 = 0;
    $rp_G3_latent_syphillis_24 = 0;
    $rp_G3_molluscum_contag_24 = 0;
    $rp_G3_bubos_24 = 0;
    $rp_G3_othstd_genital_warts_24 = 0;
    $rp_G3_ostd_other_24 = 0;

    $G1_pri_syp_25 = 0;
    $rp_G1_sec_syp_25 = 0;
    $rp_G1_chan_25 = 0;
    $rp_G1_gen_herpes_25 = 0;
    $rp_G1_gen_scabies_25 = 0;
    $rp_G1_gud_other_25 = 0;
    $rp_G2_non_gono_ure_25 = 0;
    $rp_Gw_non_gono_cer_25 = 0;
    $rp_G2_trichomonas_25 = 0;
    $rp_G2_gen_candidiosis_25 = 0;
    $rp_G2_beterial_vaginosis_25 = 0;
    $rp_G3_congenial_syphillis_25 = 0;
    $rp_G3_latent_syphillis_25 = 0;
    $rp_G3_molluscum_contag_25 = 0;
    $rp_G3_bubos_25 = 0;
    $rp_G3_othstd_genital_warts_25 = 0;
    $rp_G3_ostd_other_25 = 0;

    $G1_pri_syp_14_new = 0;
    $rp_G1_sec_syp_14_new = 0;
    $rp_G1_chan_14_new = 0;
    $rp_G1_gen_herpes_14_new = 0;
    $rp_G1_gen_scabies_14_new = 0;
    $rp_G1_gud_other_14_new = 0;
    $rp_G2_non_gono_ure_14_new = 0;
    $rp_Gw_non_gono_cer_14_new = 0;
    $rp_G2_trichomonas_14_new = 0;
    $rp_G2_gen_candidiosis_14_new = 0;
    $rp_G2_beterial_vaginosis_14_new = 0;
    $rp_G3_congenial_syphillis_14_new = 0;
    $rp_G3_latent_syphillis_14_new = 0;
    $rp_G3_molluscum_contag_14_new = 0;
    $rp_G3_bubos_14_new = 0;
    $rp_G3_othstd_genital_warts_14_new = 0;
    $rp_G3_ostd_other_14_new = 0;
    $G1_pri_syp_24_new = 0;
    $rp_G1_sec_syp_24_new = 0;
    $rp_G1_chan_24_new = 0;
    $rp_G1_gen_herpes_24_new = 0;
    $rp_G1_gen_scabies_24_new = 0;
    $rp_G1_gud_other_24_new = 0;
    $rp_G2_non_gono_ure_24_new = 0;
    $rp_Gw_non_gono_cer_24_new = 0;
    $rp_G2_trichomonas_24_new = 0;
    $rp_G2_gen_candidiosis_24_new = 0;
    $rp_G2_beterial_vaginosis_24_new = 0;
    $rp_G3_congenial_syphillis_24_new = 0;
    $rp_G3_latent_syphillis_24_new = 0;
    $rp_G3_molluscum_contag_24_new = 0;
    $rp_G3_bubos_24_new = 0;
    $rp_G3_othstd_genital_warts_24_new = 0;
    $rp_G3_ostd_other_24_new = 0;

    $G1_pri_syp_25_new = 0;
    $rp_G1_sec_syp_25_new = 0;
    $rp_G1_chan_25_new = 0;
    $rp_G1_gen_herpes_25_new = 0;
    $rp_G1_gen_scabies_25_new = 0;
    $rp_G1_gud_other_25_new = 0;
    $rp_G2_non_gono_ure_25_new = 0;
    $rp_Gw_non_gono_cer_25_new = 0;
    $rp_G2_trichomonas_25_new = 0;
    $rp_G2_gen_candidiosis_25_new = 0;
    $rp_G2_beterial_vaginosis_25_new = 0;
    $rp_G3_congenial_syphillis_25_new = 0;
    $rp_G3_latent_syphillis_25_new = 0;
    $rp_G3_molluscum_contag_25_new = 0;
    $rp_G3_bubos_25_new = 0;
    $rp_G3_othstd_genital_warts_25_new = 0;
    $rp_G3_ostd_other_25_new = 0;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $rp_newID = array();
    //$differID =  array_unique($differID);
    foreach ($differID as $key => $value) {
      $rp_newID[] = $value;
    }

    for ($i = 0; $i < count($rp_newID); $i++) {
      $rp_ID_new = $rp_newID[$i];
      $rpMonth_New_Rows = Stimale::whereBetween('Visit_date', [$from, $to])
        ->orderBy('Visit_date', 'desc')
        ->where('CID', $rp_ID_new)
        ->get();
      $rp_Age = intval($rpMonth_New_Rows[0]['age']);
      $rp_visitDate = intval($rpMonth_New_Rows[0]['Visit_date']);

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

      if ($rp_Age < 15) {
        if ($rp_G1_pri_syp == 1) {
          $G1_pri_syp_14_new += 1;
        }
        if ($rp_G1_sec_syp == 1) {
          $rp_G1_sec_syp_14_new += 1;
        }
        if ($rp_G1_chan == 1) {
          $rp_G1_chan_14_new += 1;
        }
        if ($rp_G1_gen_herpes == 1) {
          $rp_G1_gen_herpes_14_new += 1;
        }
        if ($rp_G1_gen_scabies == 1) {
          $rp_G1_gen_scabies_14_new += 1;
        }
        if ($rp_G1_gud_other == 1) {
          $rp_G1_gud_other_14_new += 1;
        }
        if ($rp_G2_non_gono_ure == 1) {
          $rp_G2_non_gono_ure_14_new += 1;
        }
        if ($rp_G2_non_gono_cer == 1) {
          $rp_Gw_non_gono_cer_14_new += 1;
        }
        if ($rp_G2_trichomonas == 1) {
          $rp_G2_trichomonas_14_new += 1;
        }
        if ($rp_G2_gen_candidiosis == 1) {
          $rp_G2_gen_candidiosis_14_new += 1;
        }
        if ($rp_G3_congenial_syphillis == 1) {
          $rp_G3_congenial_syphillis_14_new += 1;
        }
        if ($rp_G3_latent_syphillis == 1) {
          $rp_G3_latent_syphillis_14_new += 1;
        }
        if ($rp_G3_molluscum_contag == 1) {
          $rp_G3_molluscum_contag_14_new += 1;
        }
        if ($rp_G3_bubos == 1) {
          $rp_G3_bubos_14_new += 1;
        }
        if ($rp_G3_othstd_genital_warts == 1) {
          $rp_G3_othstd_genital_warts_14_new += 1;
        }
        if ($rp_G3_ostd_other == 1) {
          $rp_G3_ostd_other_14_new += 1;
        }
      } /// end of age under 15
      if ($rp_Age >= 15 and $rp_Age < 25) {
        if ($rp_G1_pri_syp == 1) {
          $G1_pri_syp_24_new += 1;
        }
        if ($rp_G1_sec_syp == 1) {
          $rp_G1_sec_syp_24_new += 1;
        }
        if ($rp_G1_chan == 1) {
          $rp_G1_chan_24_new += 1;
        }
        if ($rp_G1_gen_herpes == 1) {
          $rp_G1_gen_herpes_24_new += 1;
        }
        if ($rp_G1_gen_scabies == 1) {
          $rp_G1_gen_scabies_24_new += 1;
        }
        if ($rp_G1_gud_other == 1) {
          $rp_G1_gud_other_24_new += 1;
        }
        if ($rp_G2_non_gono_ure == 1) {
          $rp_G2_non_gono_ure_24_new += 1;
        }
        if ($rp_G2_non_gono_cer == 1) {
          $rp_Gw_non_gono_cer_24_new += 1;
        }
        if ($rp_G2_trichomonas == 1) {
          $rp_G2_trichomonas_24_new += 1;
        }
        if ($rp_G2_gen_candidiosis == 1) {
          $rp_G2_gen_candidiosis_24_new += 1;
        }
        if ($rp_G3_congenial_syphillis == 1) {
          $rp_G3_congenial_syphillis_24_new += 1;
        }
        if ($rp_G3_latent_syphillis == 1) {
          $rp_G3_latent_syphillis_24_new += 1;
        }
        if ($rp_G3_molluscum_contag == 1) {
          $rp_G3_molluscum_contag_24_new += 1;
        }
        if ($rp_G3_bubos == 1) {
          $rp_G3_bubos_24_new += 1;
        }
        if ($rp_G3_othstd_genital_warts == 1) {
          $rp_G3_othstd_genital_warts_24_new += 1;
        }
        if ($rp_G3_ostd_other == 1) {
          $rp_G3_ostd_other_24_new += 1;
        }
      }
      if ($rp_Age > 25) {
        if ($rp_G1_pri_syp == 1) {
          $G1_pri_syp_25_new += 1;
        }
        if ($rp_G1_sec_syp == 1) {
          $rp_G1_sec_syp_25_new += 1;
        }
        if ($rp_G1_chan == 1) {
          $rp_G1_chan_25_new += 1;
        }
        if ($rp_G1_gen_herpes == 1) {
          $rp_G1_gen_herpes_25_new += 1;
        }
        if ($rp_G1_gen_scabies == 1) {
          $rp_G1_gen_scabies_25_new += 1;
        }
        if ($rp_G1_gud_other == 1) {
          $rp_G1_gud_other_25_new += 1;
        }
        if ($rp_G2_non_gono_ure == 1) {
          $rp_G2_non_gono_ure_25_new += 1;
        }
        if ($rp_G2_non_gono_cer == 1) {
          $rp_Gw_non_gono_cer_25_new += 1;
        }
        if ($rp_G2_trichomonas == 1) {
          $rp_G2_trichomonas_25_new += 1;
        }
        if ($rp_G2_gen_candidiosis == 1) {
          $rp_G2_gen_candidiosis_25_new += 1;
        }
        if ($rp_G3_congenial_syphillis == 1) {
          $rp_G3_congenial_syphillis_25_new += 1;
        }
        if ($rp_G3_latent_syphillis == 1) {
          $rp_G3_latent_syphillis_25_new += 1;
        }
        if ($rp_G3_molluscum_contag == 1) {
          $rp_G3_molluscum_contag_25_new += 1;
        }
        if ($rp_G3_bubos == 1) {
          $rp_G3_bubos_25_new += 1;
        }
        if ($rp_G3_othstd_genital_warts == 1) {
          $rp_G3_othstd_genital_warts_25_new += 1;
        }
        if ($rp_G3_ostd_other == 1) {
          $rp_G3_ostd_other_25_new += 1;
        }
      }
    }
    // Old Connected data////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    $needyID = array();
    $intersectID =  array_unique($intersectID);
    foreach ($intersectID as $key => $value) {
      $needyID[] = $value;
    }

    for ($i = 0; $i < count($needyID); $i++) { // without duplicate ID
      $rpID = $needyID[$i];
      $rpMonth_Rows = Stimale::whereBetween('Visit_date', [$from, $to])
        ->orderBy('Visit_date', 'desc')
        ->where('CID', $rpID)
        ->get();
      $rp_Age = intval($rpMonth_Rows[0]['age']);
      $rp_visitDate = intval($rpMonth_Rows[0]['Visit_date']);

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

      $old_pt_rows = Stimale::whereBetween('Visit_date', [$from_ck_new_old, $to_ck_new_old])
        ->orderBy('Visit_date', 'desc')
        ->where('CID', $rpID)
        ->get();
      //////////////////////////////////////////////////////////
      if ($rp_Age < 15) {
        if ($rp_G1_pri_syp    != intval($old_pt_rows[0]['pri_syphillis'])) {
          if ($rp_G1_pri_syp == 1) {
            $G1_pri_syp_14 += 1;
          }
        }
        if ($rp_G1_sec_syp    != intval($old_pt_rows[0]['sec_syphillis'])) {
          if ($rp_G1_sec_syp == 1) {
            $rp_G1_sec_syp_14 += 1;
          }
        }
        if ($rp_G1_chan       != intval($old_pt_rows[0]['chancroid'])) {
          if ($rp_G1_chan == 1) {
            $rp_G1_chan_14 += 1;
          }
        }
        if ($rp_G1_gen_herpes != intval($old_pt_rows[0]['gen_herpes'])) {
          if ($rp_G1_gen_herpes == 1) {
            $rp_G1_gen_herpes_14 += 1;
          }
        }
        if ($rp_G1_gen_scabies != intval($old_pt_rows[0]['gen_scabies'])) {
          if ($rp_G1_gen_scabies == 1) {
            $rp_G1_gen_scabies_14 += 1;
          }
        }
        if ($rp_G1_gud_other  != intval($old_pt_rows[0]['gud_other'])) {
          if ($rp_G1_gud_other == 1) {
            $rp_G1_gud_other_14 += 1;
          }
        }

        if ($rp_G2_non_gono_ure       != intval($old_pt_rows[0]['non_gono_urethritis'])) {
          if ($rp_G2_non_gono_ure == 1) {
            $rp_G2_non_gono_ure_14 += 1;
          }
        }
        if ($rp_G2_non_gono_cer       != intval($old_pt_rows[0]['non_gono_cervities'])) {
          if ($rp_G2_non_gono_cer == 1) {
            $rp_Gw_non_gono_cer_14 += 1;
          }
        }
        if ($rp_G2_trichomonas        != intval($old_pt_rows[0]['trichomonas'])) {
          if ($rp_G2_trichomonas == 1) {
            $rp_G2_trichomonas_14 += 1;
          }
        }
        if ($rp_G2_gen_candidiosis    != intval($old_pt_rows[0]['genital_candidiosis'])) {
          if ($rp_G2_gen_candidiosis == 1) {
            $rp_G2_gen_candidiosis_14 += 1;
          }
        }

        if ($rp_G3_congenial_syphillis  != intval($old_pt_rows[0]['congenial_syphillis'])) {
          if ($rp_G3_congenial_syphillis == 1) {
            $rp_G3_congenial_syphillis_14 += 1;
          }
        }
        if ($rp_G3_latent_syphillis     != intval($old_pt_rows[0]['latent_syphillis'])) {
          if ($rp_G3_latent_syphillis == 1) {
            $rp_G3_latent_syphillis_14 += 1;
          }
        }

        if ($rp_G3_molluscum_contag     != intval($old_pt_rows[0]['molluscum_contag'])) {
          if ($rp_G3_molluscum_contag == 1) {
            $rp_G3_molluscum_contag_14 += 1;
          }
        }
        if ($rp_G3_bubos                != intval($old_pt_rows[0]['bubos'])) {
          if ($rp_G3_bubos == 1) {
            $rp_G3_bubos_14 += 1;
          }
        }
        if ($rp_G3_othstd_genital_warts != intval($old_pt_rows[0]['othstd_genital_warts'])) {
          if ($rp_G3_othstd_genital_warts == 1) {
            $rp_G3_othstd_genital_warts_14 += 1;
          }
        }
        if ($rp_G3_ostd_other           != intval($old_pt_rows[0]['ostd_other'])) {
          if ($rp_G3_ostd_other == 1) {
            $rp_G3_ostd_other_14 += 1;
          }
        }
      } /// end of age under 15
      if ($rp_Age >= 15 and $rp_Age < 25) {
        if ($rp_G1_pri_syp    != intval($old_pt_rows[0]['pri_syphillis'])) {
          if ($rp_G1_pri_syp == 1) {
            $G1_pri_syp_24 += 1;
          }
        }
        if ($rp_G1_sec_syp    != intval($old_pt_rows[0]['sec_syphillis'])) {
          if ($rp_G1_sec_syp == 1) {
            $rp_G1_sec_syp_24 += 1;
          }
        }
        if ($rp_G1_chan       != intval($old_pt_rows[0]['chancroid'])) {
          if ($rp_G1_chan == 1) {
            $rp_G1_chan_24 += 1;
          }
        }
        if ($rp_G1_gen_herpes != intval($old_pt_rows[0]['gen_herpes'])) {
          if ($rp_G1_gen_herpes == 1) {
            $rp_G1_gen_herpes_24 += 1;
          }
        }
        if ($rp_G1_gen_scabies != intval($old_pt_rows[0]['gen_scabies'])) {
          if ($rp_G1_gen_scabies == 1) {
            $rp_G1_gen_scabies_24 += 1;
          }
        }
        if ($rp_G1_gud_other  != intval($old_pt_rows[0]['gud_other'])) {
          if ($rp_G1_gud_other == 1) {
            $rp_G1_gud_other_24 += 1;
          }
        }

        if ($rp_G2_non_gono_ure       != intval($old_pt_rows[0]['non_gono_urethritis'])) {
          if ($rp_G2_non_gono_ure == 1) {
            $rp_G2_non_gono_ure_24 += 1;
          }
        }
        if ($rp_G2_non_gono_cer       != intval($old_pt_rows[0]['non_gono_cervities'])) {
          if ($rp_G2_non_gono_cer == 1) {
            $rp_Gw_non_gono_cer_24 += 1;
          }
        }
        if ($rp_G2_trichomonas        != intval($old_pt_rows[0]['trichomonas'])) {
          if ($rp_G2_trichomonas == 1) {
            $rp_G2_trichomonas_24 += 1;
          }
        }
        if ($rp_G2_gen_candidiosis    != intval($old_pt_rows[0]['genital_candidiosis'])) {
          if ($rp_G2_gen_candidiosis == 1) {
            $rp_G2_gen_candidiosis_24 += 1;
          }
        }

        if ($rp_G3_congenial_syphillis    != intval($old_pt_rows[0]['congenial_syphillis'])) {
          if ($rp_G3_congenial_syphillis == 1) {
            $rp_G3_congenial_syphillis_24 += 1;
          }
        }
        if ($rp_G3_latent_syphillis       != intval($old_pt_rows[0]['latent_syphillis'])) {
          if ($rp_G3_latent_syphillis == 1) {
            $rp_G3_latent_syphillis_24 += 1;
          }
        }

        if ($rp_G3_molluscum_contag       != intval($old_pt_rows[0]['molluscum_contag'])) {
          if ($rp_G3_molluscum_contag == 1) {
            $rp_G3_molluscum_contag_24 += 1;
          }
        }
        if ($rp_G3_bubos                  != intval($old_pt_rows[0]['bubos'])) {
          if ($rp_G3_bubos == 1) {
            $rp_G3_bubos_24 += 1;
          }
        }
        if ($rp_G3_othstd_genital_warts   != intval($old_pt_rows[0]['othstd_genital_warts'])) {
          if ($rp_G3_othstd_genital_warts == 1) {
            $rp_G3_othstd_genital_warts_24 += 1;
          }
        }
        if ($rp_G3_ostd_other             != intval($old_pt_rows[0]['ostd_other'])) {
          if ($rp_G3_ostd_other == 1) {
            $rp_G3_ostd_other_24 += 1;
          }
        }
      }
      if ($rp_Age > 25) {
        if ($rp_G1_pri_syp <> $old_pt_rows[0]['pri_syphillis']) {
          if ($rp_G1_pri_syp == 1) {
            $G1_pri_syp_25 += 1;
          }
        }
        if ($rp_G1_sec_syp <> $old_pt_rows[0]['sec_syphillis']) {
          if ($rp_G1_sec_syp == 1) {
            $rp_G1_sec_syp_25 += 1;
          }
        }
        if ($rp_G1_chan <> $old_pt_rows[0]['chancroid']) {
          if ($rp_G1_chan == 1) {
            $rp_G1_chan_25 += 1;
          }
        }
        if ($rp_G1_gen_herpes <> $old_pt_rows[0]['gen_herpes']) {
          if ($rp_G1_gen_herpes == 1) {
            $rp_G1_gen_herpes_25 += 1;
          }
        }
        if ($rp_G1_gen_scabies <> $old_pt_rows[0]['gen_scabies']) {
          if ($rp_G1_gen_scabies == 1) {
            $rp_G1_gen_scabies_25 += 1;
          }
        }
        if ($rp_G1_gud_other <> $old_pt_rows[0]['gud_other']) {
          if ($rp_G1_gud_other == 1) {
            $rp_G1_gud_other_25 += 1;
          }
        }

        if ($rp_G2_non_gono_ure  <> $old_pt_rows[0]['non_gono_urethritis']) {
          if ($rp_G2_non_gono_ure == 1) {
            $rp_G2_non_gono_ure_25 += 1;
          }
        }
        if ($rp_G2_non_gono_cer  <> $old_pt_rows[0]['non_gono_cervities']) {
          if ($rp_G2_non_gono_cer == 1) {
            $rp_Gw_non_gono_cer_25 += 1;
          }
        }
        if ($rp_G2_trichomonas <> $old_pt_rows[0]['trichomonas']) {
          if ($rp_G2_trichomonas == 1) {
            $rp_G2_trichomonas_25 += 1;
          }
        }
        if ($rp_G2_gen_candidiosis <> $old_pt_rows[0]['genital_candidiosis']) {
          if ($rp_G2_gen_candidiosis == 1) {
            $rp_G2_gen_candidiosis_25 += 1;
          }
        }
        if ($rp_G3_congenial_syphillis <> $old_pt_rows[0]['congenial_syphillis']) {
          if ($rp_G3_congenial_syphillis == 1) {
            $rp_G3_congenial_syphillis_25 += 1;
          }
        }
        if ($rp_G3_latent_syphillis <> $old_pt_rows[0]['latent_syphillis']) {
          if ($rp_G3_latent_syphillis == 1) {
            $rp_G3_latent_syphillis_25 += 1;
          }
        }

        if ($rp_G3_molluscum_contag <> $old_pt_rows[0]['molluscum_contag']) {
          if ($rp_G3_molluscum_contag == 1) {
            $rp_G3_molluscum_contag_25 += 1;
          }
        }
        if ($rp_G3_bubos <> $old_pt_rows[0]['bubos']) {
          if ($rp_G3_bubos == 1) {
            $rp_G3_bubos_25 += 1;
          }
        }
        if ($rp_G3_othstd_genital_warts <> $old_pt_rows[0]['othstd_genital_warts']) {
          if ($rp_G3_othstd_genital_warts == 1) {
            $rp_G3_othstd_genital_warts_25 += 1;
          }
        }
        if ($rp_G3_ostd_other <> $old_pt_rows[0]['ostd_other']) {
          if ($rp_G3_ostd_other == 1) {
            $rp_G3_ostd_other_25 += 1;
          }
        }
      }
    }
    ////////////////////Female /////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////
    $rp_month_f = Stifemale::whereBetween('Visit_date', [$from, $to])->get();
    $old_month_f = Stifemale::whereBetween('Visit_date', [$from_ck_new_old, $to_ck_new_old])->get();
    $rp_month_ID_f = array();
    for ($i = 0; $i < count($rp_month_f); $i++) {
      $rp_month_ID_f[] = intval($rp_month_f[$i]['CID']); // this is report month's all ID
    }

    $rp_monthID_unique_f = array();
    foreach ($rp_month_ID_f as $key => $value) {
      $rp_monthID_unique_f[] = $value;
    }

    $old_month_ID_f = array();
    for ($i = 0; $i < count($old_month_f); $i++) {
      $old_month_ID_f[] = $old_month_f[$i]['CID']; // this is old month's all ID before report Month ID
    }
    $intersectID_f = array_intersect($rp_month_ID_f, $old_month_ID_f);
    $differID_a = array_diff($rp_month_ID_f, $old_month_ID_f);
    $differID_b = array_diff($old_month_ID_f, $rp_month_ID_f);
    $differID_f = array_merge($differID_a, $differID_b); // this is differend ID between report Month and Old months

    // For Gonorrhea Only Female
    $gono_14_f = 0;
    $gono_24_f = 0;
    $gono_25_f = 0;

    for ($i = 0; $i < count($rp_monthID_unique_f); $i++) {

      $rp_ID_Unique = $rp_monthID_unique_f[$i]; // Unique ID from report Month

      $rp_pt_rows = Stifemale::whereBetween('Visit_date', [$from, $to])
        ->orderBy('Visit_date')
        ->where('CID', $rp_ID_Unique)
        ->get();
      $countGono = count($rp_pt_rows);
      if ($countGono > 0) {
        if ($countGono == 1) {
          $rpMonthAge = intval($rp_pt_rows[0]['age']);
          $rpMonthGono = intval($rp_pt_rows[0]['Gonorhoea']);
          if ($rpMonthAge < 15) {
            if ($rpMonthGono == 1) {
              $gono_14_f += 1;
            }
          }
          if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
            if ($rpMonthGono == 1) {
              $gono_24_f += 1;
            }
          }
          if ($rpMonthAge >= 25) {
            if ($rpMonthGono == 1) {
              $gono_25_f += 1;
            }
          }
        }

        if ($countGono  == 2) { /// duplicate id
          $gonoArray = array();
          for ($a = 0; $a < $countGono; $a++) {

            $rpMonthAge = intval($rp_pt_rows[$a]['age']);
            $gonoArray[] = intval($rp_pt_rows[$a]['Gonorhoea']);
          }
          if ($gonoArray[0] == 1 and $gonoArray[1] == 1) {
            if ($rpMonthAge < 15) {
              $gono_14_f += 1;
            }
            if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
              $gono_24_m += 1;
            }
            if ($rpMonthAge >= 25) {
              $gono_25_m += 1;
            }
          }
          if ($gonoArray[0] == 2 and $gonoArray[1] == 1) {
            if ($rpMonthAge < 15) {
              $gono_14_f += 1;
            }
            if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
              $gono_24_m += 1;
            }
            if ($rpMonthAge >= 25) {
              $gono_25_m += 1;
            }
          }
        }
        if ($countGono == 3) {
          if ($gonoArray[0] == 2 and $gonoArray[1] == 2 and $gonoArray == 1) {
            if ($rpMonthAge < 15) {
              $gono_14_f += 1;
            }
            if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
              $gono_24_f += 1;
            }
            if ($rpMonthAge >= 25) {
              $gono_25_f += 1;
            }
          }
          if ($gonoArray[0] == 1 and $gonoArray[1] == 2 and $gonoArray == 1) {
            if ($rpMonthAge < 15) {
              $gono_14_f += 1;
            }
            if ($rpMonthAge >= 15 and $rpMonthAge < 25) {
              $gono_24_f += 1;
            }
            if ($rpMonthAge >= 25) {
              $gono_25_f += 1;
            }
          }
        }
      }
    }
    ////////////////End _ of _Gono _ female _////////////////////////////////////////////////////////

    //female ____other OI of Gono //////// Checking with Old Oi History in a calendar Year
    $G1_pri_syp_14_f = 0;
    $rp_G1_sec_syp_14_f = 0;
    $rp_G1_chan_14_f = 0;
    $rp_G1_gen_herpes_14_f = 0;
    $rp_G1_gen_scabies_14_f = 0;
    $rp_G1_gud_other_14_f = 0;
    $rp_G2_non_gono_ure_14_f = 0;
    $rp_Gw_non_gono_cer_14_f = 0;
    $rp_G2_trichomonas_14_f = 0;
    $rp_G2_gen_candidiosis_14_f = 0;
    $rp_G2_beterial_vaginosis_14_f = 0;
    $rp_G3_congenial_syphillis_14_f = 0;
    $rp_G3_latent_syphillis_14_f = 0;
    $rp_G3_latent_syphillis_preg_14_pp_f = 0;
    $rp_G3_molluscum_contag_14_f = 0;
    $rp_G3_bubos_14_f = 0;
    $rp_G3_othstd_genital_warts_14_f = 0;
    $rp_G3_ostd_other_14_f = 0;
    $rp_G3_latent_syphillis_preg_14_mp_f = 0;
    $G1_pri_syp_24_f = 0;
    $rp_G1_sec_syp_24_f = 0;
    $rp_G1_chan_24_f = 0;
    $rp_G1_gen_herpes_24_f = 0;
    $rp_G1_gen_scabies_24_f = 0;
    $rp_G1_gud_other_24_f = 0;
    $rp_G2_non_gono_ure_24_f = 0;
    $rp_Gw_non_gono_cer_24_f = 0;
    $rp_G2_trichomonas_24_f = 0;
    $rp_G2_gen_candidiosis_24_f = 0;
    $rp_G2_beterial_vaginosis_24_f = 0;
    $rp_G3_congenial_syphillis_24_f = 0;
    $rp_G3_latent_syphillis_24_f = 0;
    $rp_G3_latent_syphillis_preg_24_pp_f = 0;
    $rp_G3_molluscum_contag_24_f = 0;
    $rp_G3_bubos_24_f = 0;
    $rp_G3_othstd_genital_warts_24_f = 0;
    $rp_G3_ostd_other_24_f = 0;
    $rp_G3_latent_syphillis_preg_24_mp_f = 0;
    $G1_pri_syp_25_f = 0;
    $rp_G1_sec_syp_25_f = 0;
    $rp_G1_chan_25_f = 0;
    $rp_G1_gen_herpes_25_f = 0;
    $rp_G1_gen_scabies_25_f = 0;
    $rp_G1_gud_other_25_f = 0;
    $rp_G2_non_gono_ure_25_f = 0;
    $rp_Gw_non_gono_cer_25_f = 0;
    $rp_G2_trichomonas_25_f = 0;
    $rp_G2_gen_candidiosis_25_f = 0;
    $rp_G2_beterial_vaginosis_25_f = 0;
    $rp_G3_congenial_syphillis_25_f = 0;
    $rp_G3_latent_syphillis_25_f = 0;
    $rp_G3_latent_syphillis_preg_25_pp_f = 0;
    $rp_G3_molluscum_contag_25_f = 0;
    $rp_G3_bubos_25_f = 0;
    $rp_G3_othstd_genital_warts_25_f = 0;
    $rp_G3_ostd_other_25_f = 0;
    $rp_G3_latent_syphillis_preg_25_mp_f = 0;

    $G1_pri_syp_14_f_new = 0;
    $rp_G1_sec_syp_14_f_new = 0;
    $rp_G1_chan_14_f_new = 0;
    $rp_G1_gen_herpes_14_f_new = 0;
    $rp_G1_gen_scabies_14_f_new = 0;
    $rp_G1_gud_other_14_f_new = 0;
    $rp_G2_non_gono_ure_14_f_new = 0;
    $rp_Gw_non_gono_cer_14_f_new = 0;
    $rp_G2_trichomonas_14_f_new = 0;
    $rp_G2_gen_candidiosis_14_f_new = 0;
    $rp_G2_beterial_vaginosis_14_f_new = 0;
    $rp_G3_congenial_syphillis_14_f_new = 0;
    $rp_G3_latent_syphillis_14_f_new = 0;
    $rp_G3_latent_syphillis_preg_14_pp_f_new = 0;
    $rp_G3_molluscum_contag_14_f_new = 0;
    $rp_G3_bubos_14_f_new = 0;
    $rp_G3_othstd_genital_warts_14_f_new = 0;
    $rp_G3_ostd_other_14_f_new = 0;
    $rp_G3_latent_syphillis_preg_14_mp_f_new = 0;
    $G1_pri_syp_24_f_new = 0;
    $rp_G1_sec_syp_24_f_new = 0;
    $rp_G1_chan_24_f_new = 0;
    $rp_G1_gen_herpes_24_f_new = 0;
    $rp_G1_gen_scabies_24_f_new = 0;
    $rp_G1_gud_other_24_f_new = 0;
    $rp_G2_non_gono_ure_24_f_new = 0;
    $rp_Gw_non_gono_cer_24_f_new = 0;
    $rp_G2_trichomonas_24_f_new = 0;
    $rp_G2_gen_candidiosis_24_f_new = 0;
    $rp_G2_beterial_vaginosis_24_f_new = 0;
    $rp_G3_congenial_syphillis_24_f_new = 0;
    $rp_G3_latent_syphillis_24_f_new = 0;
    $rp_G3_latent_syphillis_preg_24_pp_f_new = 0;
    $rp_G3_molluscum_contag_24_f_new = 0;
    $rp_G3_bubos_24_f_new = 0;
    $rp_G3_othstd_genital_warts_24_f_new = 0;
    $rp_G3_ostd_other_24_f_new = 0;
    $rp_G3_latent_syphillis_preg_24_mp_f_new = 0;
    $G1_pri_syp_25_f_new = 0;
    $rp_G1_sec_syp_25_f_new = 0;
    $rp_G1_chan_25_f_new = 0;
    $rp_G1_gen_herpes_25_f_new = 0;
    $rp_G1_gen_scabies_25_f_new = 0;
    $rp_G1_gud_other_25_f_new = 0;
    $rp_G2_non_gono_ure_25_f_new = 0;
    $rp_Gw_non_gono_cer_25_f_new = 0;
    $rp_G2_trichomonas_25_f_new = 0;
    $rp_G2_gen_candidiosis_25_f_new = 0;
    $rp_G2_beterial_vaginosis_25_f_new = 0;
    $rp_G3_congenial_syphillis_25_f_new = 0;
    $rp_G3_latent_syphillis_25_f_new = 0;
    $rp_G3_latent_syphillis_preg_25_pp_f_new = 0;
    $rp_G3_molluscum_contag_25_f_new = 0;
    $rp_G3_bubos_25_f_new = 0;
    $rp_G3_othstd_genital_warts_25_f_new = 0;
    $rp_G3_ostd_other_25_f_new = 0;
    $rp_G3_latent_syphillis_preg_25_mp_f_new = 0;


    for ($i = 0; $i < count($rp_month_f); $i++) { // without duplicate ID
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
      $rp_G2_beterial_vaginosis = $rp_month_f[$i]['beterial_vaginosis'];

      $rp_G3_congenial_syphillis  = $rp_month_f[$i]['congenial_syphillis'];
      $rp_G3_latent_syphillis     = $rp_month_f[$i]['latent_syphillis'];
      $rp_G3_latent_syphillis_preg = $rp_month_f[$i]['latent_syphillis_preg'];
      $rp_G3_lat_syp_preg_pp_mp =   $rp_month_f[$i]['risk_factor'];
      $rp_G3_molluscum_contag   =   $rp_month_f[$i]['molluscum_contag'];
      $rp_G3_bubos                = $rp_month_f[$i]['bubos'];
      $rp_G3_othstd_genital_warts = $rp_month_f[$i]['othstd_genital_warts'];
      $rp_G3_ostd_other           = $rp_month_f[$i]['ostd_other'];

      $old_pt_rows = Stifemale::whereBetween('Visit_date', [$from_ck_new_old, $to_ck_new_old])
        ->where('CID', $rpID)
        ->get();
      $counter0 = count($old_pt_rows);

      if ($counter0 > 0) {
        $old_visitDate = array();
        for ($a = 0; $a < count($old_pt_rows); $a++) {
          $old_visitDate[] = $old_pt_rows[$a]['Visit_date'];
        }
        rsort($old_visitDate);
        $old_final_date = $old_visitDate[0]; // Final date here

        for ($b = 0; $b < count($old_pt_rows); $b++) {
          if ($old_final_date == $old_pt_rows[$b]['Visit_date']) {
            $old_final_row = $old_pt_rows[$b]; // This is final row to match with report month data
          }
        }
        if ($rp_Age < 15) {
          if ($rp_G1_pri_syp    != intval($old_final_row['pri_syphillis'])) {
            if ($rp_G1_pri_syp == 1) {
              $G1_pri_syp_14_f += 1;
            }
          }
          if ($rp_G1_sec_syp    != intval($old_final_row['sec_syphillis'])) {
            if ($rp_G1_sec_syp == 1) {
              $rp_G1_sec_syp_14_f += 1;
            }
          }
          if ($rp_G1_chan       != intval($old_final_row['chancroid'])) {
            if ($rp_G1_chan == 1) {
              $rp_G1_chan_14_f += 1;
            }
          }
          if ($rp_G1_gen_herpes != intval($old_final_row['gen_herpes'])) {
            if ($rp_G1_gen_herpes == 1) {
              $rp_G1_gen_herpes_14_f += 1;
            }
          }
          if ($rp_G1_gen_scabies != intval($old_final_row['gen_scabies'])) {
            if ($rp_G1_gen_scabies == 1) {
              $rp_G1_gen_scabies_14_f += 1;
            }
          }
          if ($rp_G1_gud_other  != intval($old_final_row['gud_other'])) {
            if ($rp_G1_gud_other == 1) {
              $rp_G1_gud_other_14_f += 1;
            }
          }

          if ($rp_G2_non_gono_ure       != intval($old_final_row['non_gono_urethritis'])) {
            if ($rp_G2_non_gono_ure == 1) {
              $rp_G2_non_gono_ure_14_f += 1;
            }
          }
          if ($rp_G2_non_gono_cer       != intval($old_final_row['non_gono_cervities'])) {
            if ($rp_G2_non_gono_cer == 1) {
              $rp_Gw_non_gono_ure_14_f += 1; //Combination of two variables
            }
          }
          if ($rp_G2_trichomonas        != intval($old_final_row['trichomonas'])) {
            if ($rp_G2_trichomonas == 1) {
              $rp_G2_trichomonas_14_f += 1;
            }
          }
          if ($rp_G2_gen_candidiosis    != intval($old_final_row['genital_candidiosis'])) {
            if ($rp_G2_gen_candidiosis == 1) {
              $rp_G2_gen_candidiosis_14_f += 1;
            }
          }
          if ($rp_G2_beterial_vaginosis != intval($old_final_row['beterial_vaginosis'])) {
            if ($rp_G2_beterial_vaginosis == 1) {
              $rp_G2_beterial_vaginosis_14_f += 1;
            }
          }

          if ($rp_G3_congenial_syphillis  != intval($old_final_row['congenial_syphillis'])) {
            if ($rp_G3_congenial_syphillis == 1) {
              $rp_G3_congenial_syphillis_14_f += 1;
            }
          }
          if ($rp_G3_latent_syphillis     != intval($old_final_row['latent_syphillis'])) {
            if ($rp_G3_latent_syphillis == 1) {
              $rp_G3_latent_syphillis_14_f += 1;
            }
          }
          if ($rp_G3_latent_syphillis_preg != intval($old_final_row['latent_syphillis_preg'])) {
            if ($rp_G3_latent_syphillis_preg == 1) {
              if ($rp_G3_lat_syp_preg_pp_mp == "ANC_PP") {
                $rp_G3_latent_syphillis_preg_14_pp_f += 1;
              }
              if ($rp_G3_lat_syp_preg_pp_mp == "ANC_MP") {
                $rp_G3_latent_syphillis_preg_14_mp_f += 1;
              }
            }
          }
          if ($rp_G3_molluscum_contag     != intval($old_final_row['molluscum_contag'])) {
            if ($rp_G3_molluscum_contag == 1) {
              $rp_G3_molluscum_contag_14_f += 1;
            }
          }
          if ($rp_G3_bubos                != intval($old_final_row['bubos'])) {
            if ($rp_G3_bubos == 1) {
              $rp_G3_bubos_14_f += 1;
            }
          }
          if ($rp_G3_othstd_genital_warts != intval($old_final_row['othstd_genital_warts'])) {
            if ($rp_G3_othstd_genital_warts == 1) {
              $rp_G3_othstd_genital_warts_14_f += 1;
            }
          }
          if ($rp_G3_ostd_other           != intval($old_final_row['ostd_other'])) {
            if ($rp_G3_ostd_other == 1) {
              $rp_G3_ostd_other_14_f += 1;
            }
          }
        } /// end of age under 15
        if ($rp_Age >= 15 and $rp_Age < 25) {
          if ($rp_G1_pri_syp    != intval($old_final_row['pri_syphillis'])) {
            if ($rp_G1_pri_syp == 1) {
              $G1_pri_syp_24_f += 1;
            }
          }
          if ($rp_G1_sec_syp    != intval($old_final_row['sec_syphillis'])) {
            if ($rp_G1_sec_syp == 1) {
              $rp_G1_sec_syp_24_f += 1;
            }
          }
          if ($rp_G1_chan       != intval($old_final_row['chancroid'])) {
            if ($rp_G1_chan == 1) {
              $rp_G1_chan_24_f += 1;
            }
          }
          if ($rp_G1_gen_herpes != intval($old_final_row['gen_herpes'])) {
            if ($rp_G1_gen_herpes == 1) {
              $rp_G1_gen_herpes_24_f += 1;
            }
          }
          if ($rp_G1_gen_scabies != intval($old_final_row['gen_scabies'])) {
            if ($rp_G1_gen_scabies == 1) {
              $rp_G1_gen_scabies_24_f += 1;
            }
          }
          if ($rp_G1_gud_other  != intval($old_final_row['gud_other'])) {
            if ($rp_G1_gud_other == 1) {
              $rp_G1_gud_other_24_f += 1;
            }
          }

          if ($rp_G2_non_gono_ure       != intval($old_final_row['non_gono_urethritis'])) {
            if ($rp_G2_non_gono_ure == 1) {
              $rp_G2_non_gono_ure_24_f += 1;
            }
          }
          if ($rp_G2_non_gono_cer       != intval($old_final_row['non_gono_cervities'])) {
            if ($rp_G2_non_gono_cer == 1) {
              $rp_Gw_non_gono_ure_24_f += 1; // combination of two variables
            }
          }
          if ($rp_G2_trichomonas        != intval($old_final_row['trichomonas'])) {
            if ($rp_G2_trichomonas == 1) {
              $rp_G2_trichomonas_24_f += 1;
            }
          }
          if ($rp_G2_gen_candidiosis    != intval($old_final_row['genital_candidiosis'])) {
            if ($rp_G2_gen_candidiosis == 1) {
              $rp_G2_gen_candidiosis_24_f += 1;
            }
          }
          if ($rp_G2_beterial_vaginosis != intval($old_final_row['beterial_vaginosis'])) {
            if ($rp_G2_beterial_vaginosis == 1) {
              $rp_G2_beterial_vaginosis_24_f += 1;
            }
          }

          if ($rp_G3_congenial_syphillis    != intval($old_final_row['congenial_syphillis'])) {
            if ($rp_G3_congenial_syphillis == 1) {
              $rp_G3_congenial_syphillis_24_f += 1;
            }
          }
          if ($rp_G3_latent_syphillis       != intval($old_final_row['latent_syphillis'])) {
            if ($rp_G3_latent_syphillis == 1) {
              $rp_G3_latent_syphillis_24_f += 1;
            }
          }
          if ($rp_G3_latent_syphillis_preg != intval($old_final_row['latent_syphillis_preg'])) {
            if ($rp_G3_latent_syphillis_preg == 1) {
              if ($rp_G3_lat_syp_preg_pp_mp == "ANC_PP") {
                $rp_G3_latent_syphillis_preg_24_pp_f += 1;
              }
              if ($rp_G3_lat_syp_preg_pp_mp == "ANC_MP") {
                $rp_G3_latent_syphillis_preg_24_mp_f += 1;
              }
            }
          }
          if ($rp_G3_molluscum_contag       != intval($old_final_row['molluscum_contag'])) {
            if ($rp_G3_molluscum_contag == 1) {
              $rp_G3_molluscum_contag_24_f += 1;
            }
          }
          if ($rp_G3_bubos                  != intval($old_final_row['bubos'])) {
            if ($rp_G3_bubos == 1) {
              $rp_G3_bubos_24_f += 1;
            }
          }
          if ($rp_G3_othstd_genital_warts   != intval($old_final_row['othstd_genital_warts'])) {
            if ($rp_G3_othstd_genital_warts == 1) {
              $rp_G3_othstd_genital_warts_24_f += 1;
            }
          }
          if ($rp_G3_ostd_other             != intval($old_final_row['ostd_other'])) {
            if ($rp_G3_ostd_other == 1) {
              $rp_G3_ostd_other_24_f += 1;
            }
          }
        }
        if ($rp_Age > 25) {
          if ($rp_G1_pri_syp    != intval($old_final_row['pri_syphillis'])) {
            if ($rp_G1_pri_syp == 1) {
              $G1_pri_syp_25_f += 1;
            }
          }
          if ($rp_G1_sec_syp    != intval($old_final_row['sec_syphillis'])) {
            if ($rp_G1_sec_syp == 1) {
              $rp_G1_sec_syp_25_f += 1;
            }
          }
          if ($rp_G1_chan       != intval($old_final_row['chancroid'])) {
            if ($rp_G1_chan == 1) {
              $rp_G1_chan_25_f += 1;
            }
          }
          if ($rp_G1_gen_herpes != intval($old_final_row['gen_herpes'])) {
            if ($rp_G1_gen_herpes == 1) {
              $rp_G1_gen_herpes_25_f += 1;
            }
          }
          if ($rp_G1_gen_scabies != intval($old_final_row['gen_scabies'])) {
            if ($rp_G1_gen_scabies == 1) {
              $rp_G1_gen_scabies_25_f += 1;
            }
          }
          if ($rp_G1_gud_other  != intval($old_final_row['gud_other'])) {
            if ($rp_G1_gud_other == 1) {
              $rp_G1_gud_other_25_f += 1;
            }
          }
          if ($rp_G2_non_gono_ure     != intval($old_final_row['non_gono_urethritis'])) {
            if ($rp_G2_non_gono_ure == 1) {
              $rp_G2_non_gono_ure_25_f += 1;
            }
          }
          if ($rp_G2_non_gono_cer     != intval($old_final_row['non_gono_cervities'])) {
            if ($rp_G2_non_gono_cer == 1) {
              $rp_Gw_non_gono_ure_25_f += 1; // combination of two variables
            }
          }
          if ($rp_G2_trichomonas      != intval($old_final_row['trichomonas'])) {
            if ($rp_G2_trichomonas == 1) {
              $rp_G2_trichomonas_25_f += 1;
            }
          }
          if ($rp_G2_gen_candidiosis  != intval($old_final_row['genital_candidiosis'])) {
            if ($rp_G2_gen_candidiosis == 1) {
              $rp_G2_gen_candidiosis_25_f += 1;
            }
          }
          if ($rp_G2_beterial_vaginosis != intval($old_final_row['beterial_vaginosis'])) {
            if ($rp_G2_beterial_vaginosis == 1) {
              $rp_G2_beterial_vaginosis_25_f += 1;
            }
          }
          if ($rp_G3_congenial_syphillis      != intval($old_final_row['congenial_syphillis'])) {
            if ($rp_G3_congenial_syphillis == 1) {
              $rp_G3_congenial_syphillis_25_f += 1;
            }
          }
          if ($rp_G3_latent_syphillis         != intval($old_final_row['latent_syphillis'])) {
            if ($rp_G3_latent_syphillis == 1) {
              $rp_G3_latent_syphillis_25_f += 1;
            }
          }
          if ($rp_G3_latent_syphillis_preg != intval($old_final_row['latent_syphillis_preg'])) {
            if ($rp_G3_latent_syphillis_preg == 1) {
              if ($rp_G3_lat_syp_preg_pp_mp == "ANC_PP") {
                $rp_G3_latent_syphillis_preg_25_pp_f += 1;
              }
              if ($rp_G3_lat_syp_preg_pp_mp == "ANC_MP") {
                $rp_G3_latent_syphillis_preg_25_mp_f += 1;
              }
            }
          }
          if ($rp_G3_molluscum_contag         != intval($old_final_row['molluscum_contag'])) {
            if ($rp_G3_molluscum_contag == 1) {
              $rp_G3_molluscum_contag_25_f += 1;
            }
          }
          if ($rp_G3_bubos                    != intval($old_final_row['bubos'])) {
            if ($rp_G3_bubos == 1) {
              $rp_G3_bubos_25_f += 1;
            }
          }
          if ($rp_G3_othstd_genital_warts     != intval($old_final_row['othstd_genital_warts'])) {
            if ($rp_G3_othstd_genital_warts == 1) {
              $rp_G3_othstd_genital_warts_25_f += 1;
            }
          }
          if ($rp_G3_ostd_other               != intval($old_final_row['ostd_other'])) {
            if ($rp_G3_ostd_other == 1) {
              $rp_G3_ostd_other_25_f += 1;
            }
          }
        }
      }
    }
    //Addition Section


    //Counting section
    $result_m = count($rp_month_m);
    $result_f = count($rp_month_f);
    $G1_pri_syp_14 += $G1_pri_syp_14_new;
    $G1_pri_syp_14_f += $G1_pri_syp_14_f_new;
    $G1_pri_syp_24 += $G1_pri_syp_24_new;
    $G1_pri_syp_24_f += $G1_pri_syp_24_f_new;
    $G1_pri_syp_25 += $G1_pri_syp_25_new;
    $G1_pri_syp_25_f += $G1_pri_syp_25_f_new;
    $rp_G1_sec_syp_14 += $rp_G1_sec_syp_14_new;
    $rp_G1_sec_syp_14_f += $rp_G1_sec_syp_14_f_new;
    $rp_G1_sec_syp_24 += $rp_G1_sec_syp_24_new;
    $rp_G1_sec_syp_24_f += $rp_G1_sec_syp_24_f_new;
    $rp_G1_sec_syp_25 += $rp_G1_sec_syp_25_new;
    $rp_G1_sec_syp_25_f += $rp_G1_sec_syp_25_f_new;
    $rp_G1_chan_14 += $rp_G1_chan_14_new;
    $rp_G1_chan_14_f += $rp_G1_chan_14_f_new;
    $rp_G1_chan_24 += $rp_G1_chan_24_new;
    $rp_G1_chan_24_f += $rp_G1_chan_24_f_new;
    $rp_G1_chan_25 += $rp_G1_chan_25_new;
    $rp_G1_chan_25_f += $rp_G1_chan_25_f_new;
    $rp_G1_gen_herpes_14 += $rp_G1_gen_herpes_14_new;
    $rp_G1_gen_herpes_14_f += $rp_G1_gen_herpes_14_f_new;
    $rp_G1_gen_herpes_24 += $rp_G1_gen_herpes_24_new;
    $rp_G1_gen_herpes_24_f += $rp_G1_gen_herpes_24_f_new;
    $rp_G1_gen_herpes_25 += $rp_G1_gen_herpes_25_new;
    $rp_G1_gen_herpes_25_f += $rp_G1_gen_herpes_25_f_new;
    $rp_G1_gen_scabies_14 += $rp_G1_gen_scabies_14_new;
    $rp_G1_gen_scabies_14_f += $rp_G1_gen_scabies_14_f_new;
    $rp_G1_gen_scabies_24 += $rp_G1_gen_scabies_24_new;
    $rp_G1_gen_scabies_24_f += $rp_G1_gen_scabies_24_f_new;
    $rp_G1_gen_scabies_25 += $rp_G1_gen_scabies_25_new;
    $rp_G1_gen_scabies_25_f += $rp_G1_gen_scabies_25_f_new;
    $rp_G1_gud_other_14 += $rp_G1_gud_other_14_new;
    $rp_G1_gud_other_14_f += $rp_G1_gud_other_14_f_new;
    $rp_G1_gud_other_24 += $rp_G1_gud_other_24_new;
    $rp_G1_gud_other_24_f += $rp_G1_gud_other_24_f_new;
    $rp_G1_gud_other_25 += $rp_G1_gud_other_25_new;
    $rp_G1_gud_other_25_f += $rp_G1_gud_other_25_f_new;
    // Gono place
    $rp_G2_non_gono_ure_14 += $rp_G2_non_gono_ure_14_new;
    $rp_G2_non_gono_ure_14_f += $rp_G2_non_gono_ure_14_f_new;
    $rp_G2_non_gono_ure_24 += $rp_G2_non_gono_ure_24_new;
    $rp_G2_non_gono_ure_24_f += $rp_G2_non_gono_ure_24_f_new;
    $rp_G2_non_gono_ure_25 += $rp_G2_non_gono_ure_25_new;
    $rp_G2_non_gono_ure_25_f += $rp_G2_non_gono_ure_25_f_new;
    $rp_G2_trichomonas_14 += $rp_G2_trichomonas_14_new;
    $rp_G2_trichomonas_14_f += $rp_G2_trichomonas_14_f_new;
    $rp_G2_trichomonas_24 += $rp_G2_trichomonas_24_new;
    $rp_G2_trichomonas_24_f += $rp_G2_trichomonas_24_f_new;
    $rp_G2_trichomonas_25 += $rp_G2_trichomonas_25_new;
    $rp_G2_trichomonas_25_f += $rp_G2_trichomonas_25_f_new;
    $rp_G2_gen_candidiosis_14 += $rp_G2_gen_candidiosis_14_new;
    $rp_G2_gen_candidiosis_14_f += $rp_G2_gen_candidiosis_14_f_new;
    $rp_G2_gen_candidiosis_24 += $rp_G2_gen_candidiosis_24_new;
    $rp_G2_gen_candidiosis_24_f += $rp_G2_gen_candidiosis_24_f_new;
    $rp_G2_gen_candidiosis_25 += $rp_G2_gen_candidiosis_25_new;
    $rp_G2_gen_candidiosis_25_f += $rp_G2_gen_candidiosis_25_f_new;
    $rp_G2_beterial_vaginosis_14_f += $rp_G2_beterial_vaginosis_14_f_new;
    $rp_G2_beterial_vaginosis_24_f += $rp_G2_beterial_vaginosis_24_f_new;
    $rp_G2_beterial_vaginosis_25_f += $rp_G2_beterial_vaginosis_25_f_new;
    $rp_G3_congenial_syphillis_14 += $rp_G3_congenial_syphillis_14_new;
    $rp_G3_congenial_syphillis_14_f += $rp_G3_congenial_syphillis_14_f_new;
    $rp_G3_congenial_syphillis_24 += $rp_G3_congenial_syphillis_24_new;
    $rp_G3_congenial_syphillis_24_f += $rp_G3_congenial_syphillis_24_f_new;
    $rp_G3_congenial_syphillis_25 += $rp_G3_congenial_syphillis_25_new;
    $rp_G3_congenial_syphillis_25_f += $rp_G3_congenial_syphillis_25_f_new;
    $rp_G3_latent_syphillis_14 += $rp_G3_latent_syphillis_14_new;
    $rp_G3_latent_syphillis_14_f += $rp_G3_latent_syphillis_14_f_new;
    $rp_G3_latent_syphillis_24 += $rp_G3_latent_syphillis_24_new;
    $rp_G3_latent_syphillis_24_f += $rp_G3_latent_syphillis_24_f_new;
    $rp_G3_latent_syphillis_25 += $rp_G3_latent_syphillis_25_new;
    $rp_G3_latent_syphillis_25_f += $rp_G3_latent_syphillis_25_f_new;
    $rp_G3_latent_syphillis_preg_14_pp_f += $rp_G3_latent_syphillis_preg_14_pp_f_new;
    $rp_G3_latent_syphillis_preg_14_mp_f += $rp_G3_latent_syphillis_preg_14_mp_f_new;
    $rp_G3_latent_syphillis_preg_24_pp_f += $rp_G3_latent_syphillis_preg_24_pp_f_new;
    $rp_G3_latent_syphillis_preg_24_mp_f += $rp_G3_latent_syphillis_preg_24_mp_f_new;
    $rp_G3_latent_syphillis_preg_25_pp_f += $rp_G3_latent_syphillis_preg_25_pp_f_new;
    $rp_G3_latent_syphillis_preg_25_mp_f += $rp_G3_latent_syphillis_preg_25_mp_f_new;
    $rp_G3_molluscum_contag_14 += $rp_G3_molluscum_contag_14_new;
    $rp_G3_molluscum_contag_14_f += $rp_G3_molluscum_contag_14_f_new;
    $rp_G3_molluscum_contag_24 += $rp_G3_molluscum_contag_24_new;
    $rp_G3_molluscum_contag_24_f += $rp_G3_molluscum_contag_24_f_new;
    $rp_G3_molluscum_contag_25 += $rp_G3_molluscum_contag_25_new;
    $rp_G3_molluscum_contag_25_f += $rp_G3_molluscum_contag_25_f_new;
    $rp_G3_bubos_14 += $rp_G3_bubos_14_new;
    $rp_G3_bubos_14_f += $rp_G3_bubos_14_f_new;
    $rp_G3_bubos_24 += $rp_G3_bubos_24_new;
    $rp_G3_bubos_24_f += $rp_G3_bubos_24_f_new;
    $rp_G3_bubos_25 += $rp_G3_bubos_25_new;
    $rp_G3_bubos_25_f += $rp_G3_bubos_25_f_new;
    $rp_G3_othstd_genital_warts_14 += $rp_G3_othstd_genital_warts_14_new;
    $rp_G3_othstd_genital_warts_14_f += $rp_G3_othstd_genital_warts_14_f_new;
    $rp_G3_othstd_genital_warts_24 += $rp_G3_othstd_genital_warts_24_new;
    $rp_G3_othstd_genital_warts_24_f += $rp_G3_othstd_genital_warts_24_f_new;
    $rp_G3_othstd_genital_warts_25 += $rp_G3_othstd_genital_warts_25_new;
    $rp_G3_othstd_genital_warts_25_f += $rp_G3_othstd_genital_warts_25_f_new;
    $rp_G3_ostd_other_14 += $rp_G3_ostd_other_14_new;
    $rp_G3_ostd_other_14_f += $rp_G3_ostd_other_14_f_new;
    $rp_G3_ostd_other_24 += $rp_G3_ostd_other_24_new;
    $rp_G3_ostd_other_24_f += $rp_G3_ostd_other_24_f_new;
    $rp_G3_ostd_other_25 += $rp_G3_ostd_other_25_new;
    $rp_G3_ostd_other_25_f += $rp_G3_ostd_other_25_f_new;


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
      $rp_G2_beterial_vaginosis_14_f, // female only
      $rp_G2_beterial_vaginosis_24_f, // female only
      $rp_G2_beterial_vaginosis_25_f, // female only
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
      $rp_G3_latent_syphillis_preg_14_pp_f, //female only
      $rp_G3_latent_syphillis_preg_14_mp_f, // female only
      $rp_G3_latent_syphillis_preg_24_pp_f, //female only
      $rp_G3_latent_syphillis_preg_24_mp_f, // female only
      $rp_G3_latent_syphillis_preg_25_pp_f, //female only
      $rp_G3_latent_syphillis_preg_25_mp_f, // female only
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

      $msm_rdt_14_m, // RPR section
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
      $idu_P_14_m,
      $idu_rdt_24_m,
      $idu_P_24_m,
      $idu_rdt_25_m,
      $idu_P_25_m,

    ]);
  }



  public function firstQuarter($from9, $to9, $from10, $to10, $from11, $to11, $from12, $to12)
  {
    $filterYear_m = Stimale::whereBetween('Visit date', [$from9, $to9])->get();
    $filterYear_f = Stifemale::whereBetween('Visit date', [$from9, $to9])->get();
    $epi_m = Stimale::whereBetween('Visit date', [$from9, $to9])
      ->where('episode', '=', 1)
      ->get();
    $epi_f = Stifemale::whereBetween('Visit date', [$from9, $to9])
      ->where('episode', '=', 1)
      ->get();
    $sept_m = count($filterYear_m);
    $sept_f = count($filterYear_f);
    $sept_epi_m = count($epi_m);
    $sept_epi_f = count($epi_f);

    $filterYear_oct_m = Stimale::whereBetween('Visit date', [$from10, $to10])->get();
    $filterYear_oct_f = Stifemale::whereBetween('Visit date', [$from10, $to10])->get();
    $oct_epi_m = Stimale::whereBetween('Visit date', [$from10, $to10])
      ->where('episode', '=', 1)
      ->get();
    $oct_epi_f = Stifemale::whereBetween('Visit date', [$from10, $to10])
      ->where('episode', '=', 1)
      ->get();
    $oct_m = count($filterYear_oct_m);
    $oct_f = count($filterYear_oct_f);
    $oct_epi_m = count($oct_epi_m);
    $oct_epi_f = count($oct_epi_f);

    $filterYear_nov_m = Stimale::whereBetween('Visit date', [$from11, $to11])->get();
    $filterYear_nov_f = Stifemale::whereBetween('Visit date', [$from11, $to11])->get();
    $nov_epi_m = Stimale::whereBetween('Visit date', [$from11, $to11])
      ->where('episode', '=', 1)
      ->get();
    $nov_epi_f = Stifemale::whereBetween('Visit date', [$from11, $to11])
      ->where('episode', '=', 1)
      ->get();
    $nov_m = count($filterYear_m);
    $nov_f = count($filterYear_f);
    $nov_epi_m = count($nov_epi_m);
    $nov_epi_f = count($nov_epi_f);

    $filterYear_dec_m = Stimale::whereBetween('Visit date', [$from12, $to12])->get();
    $filterYear_dec_f = Stifemale::whereBetween('Visit date', [$from12, $to12])->get();
    $dec_epi_m = Stimale::whereBetween('Visit date', [$from12, $to12])
      ->where('episode', '=', 1)
      ->get();
    $dec_epi_f = Stifemale::whereBetween('Visit date', [$from12, $to12])
      ->where('episode', '=', 1)
      ->get();
    $dec_m = count($filterYear_dec_m);
    $dec_f = count($filterYear_dec_f);
    $dec_epi_m = count($dec_epi_m);
    $dec_epi_f = count($dec_epi_f);

    return response()->json([
      $sept_m,
      $sept_f,
      $sept_epi_m,
      $sept_epi_f,
      $oct_m,
      $oct_f,
      $oct_epi_m,
      $oct_epi_f,
      $nov_m,
      $nov_f,
      $nov_epi_m,
      $nov_epi_f,
      $dec_m,
      $dec_f,
      $dec_epi_m,
      $dec_epi_f,
    ]);
  }

  // This is for exports Section

  public function export(Request $data)
  {

    $from = $data->input('Datefrom');
    $date_from = DateTime::createFromFormat('d-m-Y', $from);
    $from = $date_from->format('Y-m-d');

    $to = $data->input('Dateto');
    $date_to = DateTime::createFromFormat('d-m-Y', $to);
    $to = $date_to->format('Y-m-d');

    $sex = $data->input('sex');

    if ($sex == "Male") {
      $users = Stimale::whereBetween('Visit_date', [$from, $to])
        ->with([
          'ptconfig' => function ($query) {
            $query->select("Pid", 'Date of Birth', 'Agey', 'Agem', "Main Risk", "Sub Risk", "Gender", "FuchiaID", "Risk Log", "Former Risk", "Risk Change_Date");
          }
        ])
        ->get();
      return Excel::download(new StiExport($users, $sex), 'sti_data(Male)-' . date("d-m-Y") . '.xlsx');
    } else if ($sex == "Female") {
      $users = Stifemale::whereBetween('Visit_date', [$from, $to])
        ->with([
          'ptconfig' => function ($query) {
            $query->select("Pid", 'Date of Birth', 'Agey', 'Agem', "Main Risk", "Sub Risk", "Gender", "FuchiaID", "Former Risk", "Risk Change_Date");
          }
        ])
        ->get();


      return Excel::download(new StiExport($users, $sex), 'sti_data(Female)-' . date("d-m-Y") . '.xlsx');
    }
  }
}
