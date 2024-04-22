<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Followup_general;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Lab;
use App\Models\LabHbcTest;
use App\Models\Urine;
use App\Models\Rprtest;
use App\Models\Labstitest;
use App\Models\Lab_oi;
use App\Models\LabGeneralTest;
use App\Models\LabStoolTest;
use App\Models\LabAfbTest;
use App\Models\LabCovidTest;
use App\Models\Viralload;
use App\Models\Coulselling;
use App\Models\CounsellorRecords;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
// Exports
use App\Exports\Counselling\CounsellingExport;
use Illuminate\Database\Eloquent\Builder;
use DateTime;
class CounsellingController extends Controller
{
  public function patients(){
    $patients = Patients::latest()->paginate(50);
    return view (
      'Reception.patients',['patients' => $patients
    ]);
  }
  public function general_patients(){
    $patients_gt = Patients::latest()->paginate(50);
    return view (
      'Reception.generalPatient',['gt_patients' => $patients_gt
    ]);
  }
  public function room_view()
  {
        return view('Counsellor.counselling');
  }
  public function save_data(Request $request){
      $gid    = $request->input('gid');
      $ckID   = $request->input('ckID');
      $update = $request->input('update');
      $cdate = $request->input('cdate');

      $hiv_test_date = $request->input('hiv_test_date');
      $htsEntry = $request->input('hts_entry');

      $hiv_test = $request->input('hiv_test');
      $rpr_test = $request->input('rpr_test');
      $hepB_test = $request->input('hepB_test');
      $hiv_test_date = $request -> input('hiv_test_date');
      $rpr_test_date = $request -> input('rpr_test_date');
      $hepB_test_date = $request -> input('hepB_test_date');

      $counsellingOnly = $request -> input('counsellingOnly');
      // $both_hts_coun = $request -> input('both_hts_coun');
      $listShow = $request -> input('listShow');
      $decryptFetch = $request -> input('decryptFetch');

      $htsUpdate = $request -> input('htsUpdate');
      $hts_row_address = $request -> input('address');
      $pt_data_update = $request -> input('pt_data_update');

      $hts_counselling = $request -> input('hts_counselling');



      if($update==1){ // to save data in two table (config and counselling table)
        $region = $request -> input('state');
        $region = Crypt::encryptString($region);

        $township = $request -> input('township');
        $township = Crypt::encryptString($township);

        $quarter = $request -> input('quarter');
        $quarter = Crypt::encryptString($quarter);

        $phone = $request -> input('phone');
        $phone = Crypt::encryptString($phone);

        $phone2 = $request -> input('phone2');
        $phone2 = Crypt::encryptString($phone2);

        $phone3 = $request -> input('phone3');
        $phone3 = Crypt::encryptString($phone3);

        $Date_of_Birth = $request -> input('Date_of_Birth');
        $Date_of_Birth = Crypt::encryptString($Date_of_Birth);

        $fatherName = $request -> input('father');
           $encrypted_Father = Crypt::encryptString($fatherName);
          Patients::where('Pid',$gid)
          ->update([
            'Main Risk'=> $request->Main_risk,
            'Sub Risk'=>$request->Sub_risk,
            'Agey'=>$request->Agey,
            'Date of Birth'=>$request->$Date_of_Birth,
            'updated_by' => $request->updated_by,
          ]);
          PtConfig::where('Pid',$gid)
          ->update([
            'Region'    => $region,
            'Township'  => $township,
            'Quarter'   => $quarter,
            'Phone'     => $phone,
            'Phone2'    => $phone2,
            'Phone3'    => $phone3,
            'Main Risk' => $request->Main_risk,
            'Sub Risk'  => $request->Sub_risk,
            'Agey'=>$request->Agey,
            'Date of Birth'=>$request->$Date_of_Birth,

            'updated_by' => $request->updated_by,
          ]);
          Followup_general::where('Pid','=',$gid)->where('Visit Date','=',$cdate)
          ->update([
            'Main Risk'=> $request->Main_risk,
            'Sub Risk'=>$request->Sub_risk,
            'Agey'=>$request->Agey,

            'updated_by' => $request->updated_by,
          ]);


          $save =0;
          $lastVisitData = Coulselling::where('Pid','=',$gid)->get();
          if(count($lastVisitData)>0){
            for ($i=0; $i < count($lastVisitData); $i++) {
              $lastVisitID = $lastVisitData[$i]["Pid"];
              $lastVisitDate = $lastVisitData[$i]["Counselling_Date"];

              if($lastVisitID == $gid && $lastVisitDate == $cdate){
                $gtReg = 0;
                $DuplicateInput = true;
                 return response()->json([
                   $DuplicateInput
                 ]);
              }else{
                $save = 1;
              }
            }
          }else{
            $save = 1;
          }

          if($save == 1){
            Coulselling::create([
            'Clinic code'         => $request -> clinic_code,
            'Pid'                 => $request -> gid,
            'FuchiaID'            => $request -> fuchiaID,
            'Gender'              => $request -> gender,
            'Age'                 => $request -> agey,

            'Counsellor'          => $request -> counsellor,
            'Counselling_Date'    => $request -> cdate,
            'Pre'                 => $request -> pre,
            'Post'                => $request -> post,

            'Main Risk'           => $request -> Main_risk,
            'Sub Risk'            => $request -> Sub_risk,
            'Service_Modality'    => $request -> service,
            'Mode of Entry'       => $request -> mode_of_entry,
            'New_Old'             => $request -> new_old,
            'HIV_Test_Date'       => $request -> hiv_test_date,
            'HIV_Test_Determine'  => $request -> hiv_determine,
            'HIV_Test_UNI'        => $request -> hiv_unigold,
            'HIV_Test_STAT'       => $request -> hiv_stat,
            'HIV_Final_Result'    => $request -> hiv_final,

            'Syp_Test_Date'       => $request -> syp_date,
            'Syphillis_RDT'       => $request -> syp_rdt,
            'Syphillis_RPR'       => $request -> syp_rpr,
            'Syphillis_VDRL'      => $request -> syp_vdrl,

            'Hep_Test_Date'       => $request -> hep_date,
            'Hepatitis_B'         => $request -> hep_b,
            'Hepatitis_C'         => $request -> hep_c,
            
            'created_by' => $request->updated_by,
        ]);
        }
          $success=[[ 	"id"  => 1,
          "name" => "Successfully collected" ]];
           return response()->json([
             $success
           ]);
      }
      if($hts_counselling==1){ // to save data in  table (config and counselling table and HTS)
        $region = $request -> input('state');
        $region = Crypt::encryptString($region);

        $township = $request -> input('township');
        $township = Crypt::encryptString($township);

        $quarter = $request -> input('quarter');
        $quarter = Crypt::encryptString($quarter);

        $phone = $request -> input('phone');
        $phone = Crypt::encryptString($phone);

        $phone2 = $request -> input('phone2');
        $phone2 = Crypt::encryptString($phone2);

        $phone3 = $request -> input('phone3');
        $phone3 = Crypt::encryptString($phone3);

        $fatherName = $request -> input('father');
        $encrypted_Father = Crypt::encryptString($fatherName);

        $table ="General";
        $main_risk = $request -> input('Main_Risk');
        $main_risk = Crypt::encrypt_light($main_risk,$table);

        $sub_risk = $request -> input('Sub_Risk');
        $sub_risk = Crypt::encrypt_light($sub_risk,$table);

        $gender = $request -> input('Gender');
        $gender = Crypt::encrypt_light($gender,$table);

        $counsellor = $request -> input('Counsellor');
        $counsellor = Crypt::encrypt_light($counsellor,$table);

        $service = $request -> input('service');
        $service = Crypt::encrypt_light($service ,$table);

        $mode_of_entry = $request -> input('mode_of_entry');
        $mode_of_entry = Crypt::encrypt_light($mode_of_entry,$table);

        $new_old = $request -> input('new_old');
        $new_old = Crypt::encrypt_light($new_old,$table);

        $hiv_determine = $request -> input('hiv_determine');
        $hiv_determine = Crypt::encrypt_light($hiv_determine,$table);

        $hiv_unigold = $request -> input('hiv_unigold');
        $hiv_unigold = Crypt::encrypt_light($hiv_unigold,$table);

        $hiv_stat = $request -> input('hiv_stat');
        $hiv_stat = Crypt::encrypt_light($hiv_stat,$table);

        $hiv_final = $request -> input('hiv_final');
        $hiv_final = Crypt::encrypt_light($hiv_final,$table);

        $syp_rdt = $request -> input('syp_rdt');
        $syp_rdt = Crypt::encrypt_light($syp_rdt,$table);

        $syp_rpr = $request -> input('syp_rpr');
        $syp_rpr = Crypt::encrypt_light($syp_rpr,$table);

        $syp_vdrl = $request -> input('syp_vdrl');
        $syp_vdrl = Crypt::encrypt_light($syp_vdrl,$table);

        $hep_b = $request -> input('hep_b');
        $hep_b = Crypt::encrypt_light($hep_b,$table);

        $hep_c = $request -> input('hep_c');
        $hep_c = Crypt::encrypt_light($hep_c,$table);

        $HTSdone = $request -> input('HTSdone');
        $HTSdone = Crypt::encrypt_light($HTSdone,$table);

        $Reason = $request -> input('Reason');
        $Reason = Crypt::encrypt_light($Reason,$table);

        $Status = $request -> input('Status');
        $Status= Crypt::encrypt_light($Status,$table);
        
        $PrEP_Status = $request -> input('PrEP_Status');
        $PrEP_Status = Crypt::encrypt_light($PrEP_Status,$table);
        
        $labTestDate=$request->input('labTestDate');


        $cdate= $request->input('Counselling_Date');

        $test_locate= $request->input('test_locate');


        $gid    = $request->input('Pid');

        $edit=$request->input ('edit');

        $follow_lastDate = Followup_general::where('Pid', $gid)
        ->latest('Visit Date')
        ->value('Visit Date');
        if($follow_lastDate == $cdate){
          $hiv = Lab::where('CID', $gid)
          ->latest('Visit_date')
          ->value('Visit_date');

          $hebc = LabHbcTest::where('CID', $gid)
          ->latest('Visit_date')
          ->value('Visit_date');

          $rpr = Rprtest::where('pid', $gid)
          ->latest('Visit_date')
          ->value('Visit_date');

          $urine = Urine::where('CID',$gid)
          ->latest('visitDate')
          ->value('visitDate');

          $labsti = Labstitest::where('CID',$gid)
          ->latest('visit_date')
          ->value('visit_date');

          $loboi =Lab_oi::where('CID',$gid)
          ->latest('visit_date')
          ->value('visit_date');

          $labgeneral = LabGeneralTest::where('CID',$gid)
          ->latest('Visit_date')
          ->value('Visit_date');

          $labstool = LabStoolTest::where('CID',$gid)
          ->latest('visit_date')
          ->value('visit_date');

          $labafb = LabAfbTest::where('CID',$gid)
          ->latest('visit_date')
          ->value('visit_date');

          $labcovid = LabCovidTest::where('CID',$gid)
          ->latest('visit_date')
          ->value('visit_date');

          $labviralload = Viralload::where('CID','=',$gid)
          ->latest('created_at')
          ->value('created_at');

           $hts_exists = Coulselling::where('Pid','=',$gid)->where('Counselling_Date',$cdate)
          ->exists();
          $counselling_exists = CounsellorRecords::where('Pid','=',$gid)->where('Counselling_Date',$cdate)
          ->exists();

          if(!$hts_exists){
           if(!$counselling_exists){
            if($hiv == $request -> hiv_test_date || $hebc == $request -> hep_date  || $rpr ==$request -> syp_date||$test_locate=="privite") {
               $test_locate = Crypt::encrypt_light($test_locate,$table);
              $hiv_res=$rpr_value=$hbc_res=$urine_res=$sti_lab_res=$general_res=$stool_res=$covid_res=$Vir_res= $afb_res=$oi_res=0;

                if($labTestDate==$urine){
                    $urine_res=Urine::where('CID','=',$gid)->where('visitDate',$urine)->latest()->limit(1)
                    ->update([
                    'Main Risk' => $main_risk,
                    'Sub Risk'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }
                  if($labTestDate==$labsti){
                    $sti_lab_res=Labstitest::where('CID','=',$gid)->where('visit_date',$labsti)->latest()->limit(1)
                    ->update([
                      'Type Of Patient' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);

                  }
                  if($labTestDate==$loboi){
                  $oi_res= Lab_oi::where('CID','=',$gid)->where('visit_date',$loboi)->latest()->limit(1)
                    ->update([
                      'Main Risk' => $main_risk,
                      'Sub Risk'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($labTestDate==$labgeneral){
                    $general_res=LabGeneralTest::where('CID','=',$gid)->where('Visit_date',$labgeneral)->latest()->limit(1)
                    ->update([
                      'Patient_Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }
                  if($labTestDate==$labafb){
                    $afb_res=LabAfbTest::where('CID','=',$gid)->where('visit_date',$labafb)->latest()->limit(1)
                    ->update([
                      'Patient Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }


                  if($labTestDate==$labstool){
                    $stool_res=LabStoolTest::where('CID','=',$gid)->where('visit_date',$labstool)->latest()->limit(1)
                    ->update([
                      'Patient Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($labTestDate==$labcovid){
                    $covid_res= LabCovidTest::where('CID','=',$gid)->where('visit_date',$labcovid)->latest()->limit(1)
                    ->update([
                      'Patient Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }
                  if($labTestDate==$labviralload){
                    $Vir_res=Viralload::where('CID','=',$gid)->where('created_at',$labviralload)->latest()->limit(1)
                    ->update([
                      'Main-Risk' => $main_risk,
                      'Sub-Risk'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($request -> hiv_test_date==$hiv){
                    $hiv_res=Lab::where('CID','=',$gid)->where('Visit_date','=',$request -> hiv_test_date)->latest()->limit(1)
                    ->update([
                      'Patient_Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($request -> syp_date==$rpr){
                    $rpr_value= Rprtest::where('pid','=',$gid)->where('visit_date','=',$request -> syp_date)->latest()->limit(1)
                    ->update([
                    'Type Of Patient' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }

                  if($request -> hep_date==$hebc){
                    $hbc_res=LabHbcTest::where('CID','=',$gid)->where('Visit_date','=',$request -> hep_date)->latest()->limit(1)
                    ->update([
                    'Patient_Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }

                  $labs_updatedHTs = [ $hiv_res, $rpr_value, $hbc_res ,$urine_res, $oi_res, $sti_lab_res , $afb_res, $general_res, $stool_res, $covid_res, $Vir_res ];



                if ($edit==1) {
                  Patients::where('Pid',$gid)
                  ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                  ]);
                  PtConfig::where('Pid',$gid)
                  ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                  ]);

                  Followup_general::where('Pid',$gid)->latest('Visit Date')
                  ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'updated_by' => $request->updated_by,
                  ]);
                }

              Patients::where('Pid',$gid)
              ->update([
                'Main Risk'=>$main_risk,
                'Sub Risk'=>$sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              PtConfig::where('Pid',$gid)
              ->update([
                'Region'    => $region,
                'Township'  => $township,
                'Quarter'   => $quarter,
                'Phone'     => $phone,
                'Phone2'    => $phone2,
                'Phone3'    => $phone3,
                'Main Risk' => $main_risk,
                'Sub Risk'  => $sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              Followup_general::where('Pid',$gid)->latest('Visit Date')
              ->update([
                'Main Risk'=>$main_risk,
                'Sub Risk'=>$sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              Patients::where('Pid',$gid)
              ->update([
                'Main Risk'=>$main_risk,
                'Sub Risk'=>$sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              PtConfig::where('Pid',$gid)
              ->update([
                'Region'    => $region,
                'Township'  => $township,
                'Quarter'   => $quarter,
                'Phone'     => $phone,
                'Phone2'    => $phone2,
                'Phone3'    => $phone3,
                'Main Risk' => $main_risk,
                'Sub Risk'  => $sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              Followup_general::where('Pid',$gid)->latest('Visit Date')
                ->update([
                  'Main Risk'=>$main_risk,
                  'Sub Risk'=>$sub_risk,
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'updated_by' => $request->updated_by,
                ]);

                Coulselling ::// HTS Create row input
                    create([
                    'Clinic code'         => $request -> clinic_code,
                    'Pid'                 => $request -> Pid,
                    'FuchiaID'            => $request -> FuchiaID,
                    'Gender'              => $gender,
                    'Age'                 => $request -> Agey,

                    'Counsellor'          => $counsellor,
                    'Counselling_Date'    => $request -> Counselling_Date,
                    'Pre'                 => $request -> Pre,
                    'Post'                => $request -> Post,

                    'Main Risk'           => $main_risk,
                    'Sub Risk'            => $sub_risk,
                    'Service_Modality'    => $service,
                    'Mode of Entry'       => $mode_of_entry ,
                    'New_Old'             => $new_old,

                    'HIV_Test_Date'       => $request -> hiv_test_date,
                    'HIV_Test_Determine'  => $hiv_determine,
                    'HIV_Test_UNI'        => $hiv_unigold,
                    'HIV_Test_STAT'       => $hiv_stat,
                    'HIV_Final_Result'    => $hiv_final,

                    'Syp_Test_Date'       => $request -> syp_date,
                    'Syphillis_RDT'       => $syp_rdt,
                    'Syphillis_RPR'       => $syp_rpr,
                    'Syphillis_VDRL'      => $syp_vdrl,

                    'Hep_Test_Date'       => $request -> hep_date,
                    'Hepatitis_B'         => $hep_b,
                    'Hepatitis_C'         => $hep_c,

                    'created_by' => $request->updated_by,
                    ]);

                  CounsellorRecords :://where('Pid','=',$gid)->where('Counselling_Date','=',$hiv_test_date)
                  create([
                 
                  "Clinic Code" => $request -> clinic_code ,
                  "Pid" => $request -> Pid,
                  "FuchiaID" => $request -> FuchiaID ,
                  "PrEPCode" => $request -> PrEPCode,
                  "Gender" => $request -> Gender,
                  "Agey" => $request -> Agey,
                  "Agem" => $request -> Agem,
  
                  "Counselling_Date" => $request -> Counselling_Date,
                  "Counsellor" => $counsellor,
                  "Main Risk" => $main_risk,
                  "Sub Risk" => $sub_risk,
  
                  "Pre" => $request -> Pre,
                  "Post" => $request -> Post,
                  "HTSdone" => $HTSdone,
                  "Reason" => $Reason,
                  "Status" => $Status,
                  "PrEP" => $request -> PrEP ,
                  "PrEP Status" => $PrEP_Status,
                  "C1" => $request -> c1,
                  "C2" => $request -> c2,
                  "C3" => $request -> c3,
                  "ADH" => $request -> adh,
                  "Child under15 Adoles" => $request -> Child_under15_Adoles,
                  "Child under15 Dis" => $request -> Child_under15_Dis,
                  "Child under15 ADH" => $request -> Child_under15_ADH,
                  "MMT" => $request -> mmt,
                  "IPT" => $request -> ipt,
                  "TB" => $request -> tb,
                  "NCD" => $request -> ncd,
                  "ANC" => $request -> anc,
                  "PFA" => $request -> pfa,
                  "PHQ9" => $request -> phq9,
                  "Other" => $request -> Other,
                  "EAC" => $request -> eac,
                  "HMT" => $request -> hmt,
                  "C P case" => $request -> c_p_case,
                  "PMTCT" => $request -> pmtct,
  
                  'created_by' => $request->created_by,
                  ]);

                $success = $labs_updatedHTs;// Custom alert box SuccessFully
            }else{
              $success=2.1;//This Patient do not test Any HTS Test on
            }
           }else {
            if($hiv == $request -> hiv_test_date || $hebc == $request -> hep_date  || $rpr ==$request -> syp_date||$test_locate=="privite") {
              $test_locate = Crypt::encrypt_light($test_locate,$table);
              $hiv_res=$rpr_value=$hbc_res=$urine_res=$sti_lab_res=$general_res=$stool_res=$covid_res=$Vir_res= $afb_res=$oi_res=0;

                if($labTestDate==$urine){
                    $urine_res=Urine::where('CID','=',$gid)->where('visitDate',$urine)->latest()->limit(1)
                    ->update([
                    'Main Risk' => $main_risk,
                    'Sub Risk'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }
                  if($labTestDate==$labsti){
                    $sti_lab_res=Labstitest::where('CID','=',$gid)->where('visit_date',$labsti)->latest()->limit(1)
                    ->update([
                      'Type Of Patient' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);

                  }
                  if($labTestDate==$loboi){
                  $oi_res= Lab_oi::where('CID','=',$gid)->where('visit_date',$loboi)->latest()->limit(1)
                    ->update([
                      'Main Risk' => $main_risk,
                      'Sub Risk'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($labTestDate==$labgeneral){
                    $general_res=LabGeneralTest::where('CID','=',$gid)->where('Visit_date',$labgeneral)->latest()->limit(1)
                    ->update([
                      'Patient_Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }
                  if($labTestDate==$labafb){
                    $afb_res=LabAfbTest::where('CID','=',$gid)->where('visit_date',$labafb)->latest()->limit(1)
                    ->update([
                      'Patient Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }


                  if($labTestDate==$labstool){
                    $stool_res=LabStoolTest::where('CID','=',$gid)->where('visit_date',$labstool)->latest()->limit(1)
                    ->update([
                      'Patient Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($labTestDate==$labcovid){
                    $covid_res= LabCovidTest::where('CID','=',$gid)->where('visit_date',$labcovid)->latest()->limit(1)
                    ->update([
                      'Patient Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }
                  if($labTestDate==$labviralload){
                    $Vir_res=Viralload::where('CID','=',$gid)->where('created_at',$labviralload)->latest()->limit(1)
                    ->update([
                      'Main-Risk' => $main_risk,
                      'Sub-Risk'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($request -> hiv_test_date==$hiv){
                    $hiv_res=Lab::where('CID','=',$gid)->where('Visit_date','=',$request -> hiv_test_date)->latest()->limit(1)
                    ->update([
                      'Patient_Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($request -> syp_date==$rpr){
                    $rpr_value= Rprtest::where('pid','=',$gid)->where('visit_date','=',$request -> syp_date)->latest()->limit(1)
                    ->update([
                    'Type Of Patient' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }

                  if($request -> hep_date==$hebc){
                    $hbc_res=LabHbcTest::where('CID','=',$gid)->where('Visit_date','=',$request -> hep_date)->latest()->limit(1)
                    ->update([
                    'Patient_Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }

                  $labs_updatedHTs = [ $hiv_res, $rpr_value, $hbc_res ,$urine_res, $oi_res, $sti_lab_res , $afb_res, $general_res, $stool_res, $covid_res, $Vir_res ];

                if ($edit==1) {
                  Patients::where('Pid',$gid)
                  ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                  ]);
                  PtConfig::where('Pid',$gid)
                  ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                  ]);

                  Followup_general::where('Pid',$gid)->latest('Visit Date')
                  ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'updated_by' => $request->updated_by,
                  ]);
                }

              Patients::where('Pid',$gid)
              ->update([
                'Main Risk'=>$main_risk,
                'Sub Risk'=>$sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              PtConfig::where('Pid',$gid)
              ->update([
                'Region'    => $region,
                'Township'  => $township,
                'Quarter'   => $quarter,
                'Phone'     => $phone,
                'Phone2'    => $phone2,
                'Phone3'    => $phone3,
                'Main Risk' => $main_risk,
                'Sub Risk'  => $sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              Followup_general::where('Pid',$gid)->latest('Visit Date')
              ->update([
                'Main Risk'=>$main_risk,
                'Sub Risk'=>$sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              Patients::where('Pid',$gid)
              ->update([
                'Main Risk'=>$main_risk,
                'Sub Risk'=>$sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              PtConfig::where('Pid',$gid)
              ->update([
                'Region'    => $region,
                'Township'  => $township,
                'Quarter'   => $quarter,
                'Phone'     => $phone,
                'Phone2'    => $phone2,
                'Phone3'    => $phone3,
                'Main Risk' => $main_risk,
                'Sub Risk'  => $sub_risk,
                'updated_by' => $request->updated_by,
              ]);
              Followup_general::where('Pid',$gid)->latest('Visit Date')
                ->update([
                  'Main Risk'=>$main_risk,
                  'Sub Risk'=>$sub_risk,
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'updated_by' => $request->updated_by,
                ]);

                Coulselling ::// HTS Create row input
                    create([
                    'Clinic code'         => $request -> clinic_code,
                    'Pid'                 => $request -> Pid,
                    'FuchiaID'            => $request -> FuchiaID,
                    'Gender'              => $gender,
                    'Age'                 => $request -> Agey,
                    'Test_Location'       => $test_locate,

                    'Counsellor'          => $counsellor,
                    'Counselling_Date'    => $request -> Counselling_Date,
                    'Pre'                 => $request -> Pre,
                    'Post'                => $request -> Post,

                    'Main Risk'           => $main_risk,
                    'Sub Risk'            => $sub_risk,
                    'Service_Modality'    => $service,
                    'Mode of Entry'       => $mode_of_entry ,
                    'New_Old'             => $new_old,

                    'HIV_Test_Date'       => $request -> hiv_test_date,
                    'HIV_Test_Determine'  => $hiv_determine,
                    'HIV_Test_UNI'        => $hiv_unigold,
                    'HIV_Test_STAT'       => $hiv_stat,
                    'HIV_Final_Result'    => $hiv_final,

                    'Syp_Test_Date'       => $request -> syp_date,
                    'Syphillis_RDT'       => $syp_rdt,
                    'Syphillis_RPR'       => $syp_rpr,
                    'Syphillis_VDRL'      => $syp_vdrl,

                    'Hep_Test_Date'       => $request -> hep_date,
                    'Hepatitis_B'         => $hep_b,
                    'Hepatitis_C'         => $hep_c,
                    
                    'created_by' => $request->updated_by,

                    ]);
                  CounsellorRecords ::where('Pid','=',$gid)->where('Counselling_Date','=',$cdate)
                  ->update([

                    "Clinic Code" => $request -> clinic_code ,
                    "Pid" => $request -> Pid,
                    "FuchiaID" => $request -> FuchiaID ,
                    "PrEPCode" => $request -> PrEPCode,
                    "Gender" => $request -> Gender,
                    "Agey" => $request -> Agey,
                    "Agem" => $request -> Agem,
    
                    "Counselling_Date" => $request -> Counselling_Date,
                    "Counsellor" => $counsellor,
                    "Main Risk" => $main_risk,
                    "Sub Risk" => $sub_risk,
    
                    "Pre" => $request -> Pre,
                    "Post" => $request -> Post,
                    "HTSdone" => $HTSdone,
                    "Reason" => $Reason,
                    "Status" => $Status,
                    "PrEP" => $request -> PrEP ,
                    "PrEP Status" => $PrEP_Status,
                    "C1" => $request -> c1,
                    "C2" => $request -> c2,
                    "C3" => $request -> c3,
                    "ADH" => $request -> adh,
                    "Child under15 Adoles" => $request -> Child_under15_Adoles,
                    "Child under15 Dis" => $request -> Child_under15_Dis,
                    "Child under15 ADH" => $request -> Child_under15_ADH,
                    "MMT" => $request -> mmt,
                    "IPT" => $request -> ipt,
                    "TB" => $request -> tb,
                    "NCD" => $request -> ncd,
                    "ANC" => $request -> anc,
                    "PFA" => $request -> pfa,
                    "PHQ9" => $request -> phq9,
                    "Other" => $request -> Other,
                    "EAC" => $request -> eac,
                    "HMT" => $request -> hmt,
                    "C P case" => $request -> c_p_case,
                    "PMTCT" => $request -> pmtct,
    
                    'updated_by' => $request->updated_by,

                  ]);

                $success = $labs_updatedHTs;// Custom alert box SuccessFully

            }else{
              $success=2.1;//This Patient do not test Any HTS Test on
            }
           }

          }else {
            $success=2.2;// This Patient has been Collected in thsi day
          }

        }else{
          $success=2;//This Patient do not Pass Reception Center
        }
        return response()->json([
          $success,$test_locate,
        ]);















      }

      if($ckID ==1){ //to check the patient is in general patients list
        $coun_history=array();
        $year = $request->input('year');
        $today = $request->input('today');

        $data_in_a_year =Coulselling::whereYear('created_at', $year)->get();

        $id_in_a_year = array();// collecting id in a year
        for ($i=0; $i <count($data_in_a_year) ; $i++) {
          $id_in_a_year[]= $data_in_a_year[$i]['Pid'];
        }
        $new_old = in_array($gid , $id_in_a_year);


          $patientData = PtConfig::where('Pid','=',$gid)->first();
          if($patientData != null){
           $last_rpr_row =  Rprtest::where('Pid','=',$gid)->latest()->limit(1)->get();

           if($last_rpr_row == true){
            $last_rpr = Crypt::decrypt_light($last_rpr_row[0]["Titre(current)"],"General");
            $last_rpr_date = $last_rpr_row[0]["visit_date"];
            
           }else{
            $last_rpr = "no data";
            $last_rpr_date="-";
           }
            $ptNameDecrypt = $patientData["Name"];
            $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);

            $ptRegion = $patientData["Region"];
            $ptRegion = Crypt::decryptString($ptRegion);

            $ptTownship = $patientData["Township"];
            $ptTownship = Crypt::decryptString($ptTownship);

            $ptQuarter = $patientData["Quarter"];
            $ptQuarter = Crypt::decryptString($ptQuarter);

            $phone = $patientData["Phone"];
            $phone  = Crypt::decryptString($phone);

            $phone2 = $patientData["Phone2"];
            $phone2  = Crypt::decryptString($phone2);

            $phone3 = $patientData["Phone3"];
            $phone3  = Crypt::decryptString($phone3);

            $dob = $patientData["Date of Birth"];
            $dob  = Crypt::decryptString($dob);

            $table="General";
            $gender = $patientData["Gender"];
            $gender  = Crypt::decrypt_light($gender,$table);

            $main_risk = $patientData["Main Risk"];
            $main_risk  = Crypt::decrypt_light($main_risk,$table);

            $sub_risk = $patientData["Sub Risk"];
            $sub_risk  = Crypt::decrypt_light($sub_risk,$table);

            // $hts_exist=Coulselling::where('Pid',$gid)
            // ->exists();

            $coun_record_exist=CounsellorRecords::where('Pid',$gid)->exists();
            $coun_alredy_exist=CounsellorRecords::where('Pid',$gid)->where('Counselling_Date',$today)->exists();
            if(!$coun_record_exist){
              $patient="new";
            }else{
              $patient="old";
            }
            if($coun_alredy_exist) {
              $adh= $anc= $c1 = $c2= $c3= $cp_case =$ch_under15_adh =$ch_under15_adole =$ch_under15_dis =$eac =$fht =$ipt =$mmt =$ncd
              =$other =$pfa =$phq9 =$pmtct =$prep =$tb=$pre=$post=0;
              $type_counselling=CounsellorRecords::select("HTSdone","Reason","Status","PrEP","PrEP Status","C1","C2","C3","ADH",
                "Child under15 Adoles","Child under15 Dis","Child under15 ADH","MMT","IPT","TB","NCD","ANC","PFA","PHQ9","Other",
                "EAC","HMT","C P case","PMTCT","Pre","Post")->where('Pid', '=', $gid)->where('Counselling_Date',$today)->get();


                $table="General";

                for($coun_res_row=0;$coun_res_row <count( $type_counselling);$coun_res_row++){
                  $hTSdone=Crypt::decrypt_light($type_counselling[$coun_res_row]["HTSdone"],$table);
                  $prep_status=Crypt::decrypt_light($type_counselling[$coun_res_row]["PrEP Status"],$table);
                  $reason=Crypt::decrypt_light($type_counselling[$coun_res_row]["Reason"],$table);
                  $status=Crypt::decrypt_light($type_counselling[$coun_res_row]["Status"],$table);
                  switch(0) {
                    case $adh :$adh=$type_counselling[$coun_res_row]["ADH"];
                    case $anc :$anc=$type_counselling[$coun_res_row]["ANC"];
                    case $c1 :$c1=$type_counselling[$coun_res_row]["C1"];
                    case $c2 :$c2=$type_counselling[$coun_res_row]["C2"];
                    case $c3 :$c3=$type_counselling[$coun_res_row]["C3"];
                    case $cp_case :$cp_case=$type_counselling[$coun_res_row]["C P case"];
                    case $ch_under15_adh :$ch_under15_adh=$type_counselling[$coun_res_row]["Child under15 ADH"];
                    case $ch_under15_adole :$ch_under15_adole=$type_counselling[$coun_res_row]["Child under15 Adoles"];
                    case $ch_under15_dis :$ch_under15_dis=$type_counselling[$coun_res_row]["Child under15 Dis"];
                    case $eac :$eac=$type_counselling[$coun_res_row]["EAC"];
                    case $fht :$fht=$type_counselling[$coun_res_row]["HMT"];
                    case $ipt :$ipt=$type_counselling[$coun_res_row]["IPT"];
                    case $mmt :$mmt=$type_counselling[$coun_res_row]["MMT"];
                    case $ncd :$ncd=$type_counselling[$coun_res_row]["NCD"];
                    case $other :$other=$type_counselling[$coun_res_row]["Other"];
                    case $pfa  :$pfa=$type_counselling[$coun_res_row]["PFA"];
                    case $phq9 :$phq9=$type_counselling[$coun_res_row]["PHQ9"];
                    case $pmtct :$pmtct=$type_counselling[$coun_res_row]["PMTCT"];
                    case $prep :$pmtct=$type_counselling[$coun_res_row]["PrEP"];
                    case $tb :$tb=$type_counselling[$coun_res_row]["TB"];
                    case $pre :$pre=$type_counselling[$coun_res_row]["Pre"];
                    case $post :$post=$type_counselling[$coun_res_row]["Post"];

                   }
                 }
                 $coun_history=[$pre,$post,$hTSdone,$reason,$status,$prep,
                 $prep_status,
                 $c1 ,$c2, $c3,
                 $adh  ,$ch_under15_adole ,$ch_under15_dis
                 ,$ch_under15_adh ,$mmt,$ipt
                 ,$tb,$ncd, $anc
                 ,$pfa ,$phq9,$other
                 ,$eac ,$fht,  $cp_case
                 ,$pmtct ,$type_counselling,
                 
                ];
            }







            //$service= $data_in_a_year["Service_Modality"];
            //$moe= $data_in_a_year["Mode of Entry"];

            return response()->json([
              $patientData,
              $ptNameDecrypt,
              $ptRegion,
              $ptTownship,
              $ptQuarter,
              $phone,
              $phone2,
              $phone3,
              $new_old,
              $dob,
              $gender,
              $main_risk,
              $sub_risk,
              $patient,
              // $coun_history,
              // $coun_alredy_exist,
              $coun_history,
              $coun_alredy_exist,

              $last_rpr,
              $last_rpr_date,
              $last_rpr_row,
              //$service,
              //$moe,
            ]);
            $ckID =0;
          }else
            {
            $err =null;
            return response()->json([
              $err
            ]);
            $ckID =0;
          }

      }
      if($hiv_test == 1){
        $table="General";
        $hiv_test_data = Lab::select('Detmine_Result','Unigold_Result','STAT_PAK_Result','Final_Result')->where('CID','=',$gid)->where('Visit_date','=',$hiv_test_date)->latest('created_at')->first();

          $determine_result = Crypt::decrypt_light($hiv_test_data["Detmine_Result"],$table);


         $unigold_Result=Crypt::decrypt_light($hiv_test_data["Unigold_Result"],$table);
          $stat_PAK_Result=Crypt::decrypt_light($hiv_test_data["STAT_PAK_Result"],$table);
          $final_Result=Crypt::decrypt_light($hiv_test_data["Final_Result"],$table);


        return response()->json([
          $hiv_test_data,
            $determine_result,
            $unigold_Result,
            $stat_PAK_Result,
            $final_Result,
        ]);
      }
      if($rpr_test == 1){
        $table="General";
        $rpr_test_data = Rprtest::select('RDT Result','RPR Qualitative')->where('pid', '=', $gid)
                         ->where('visit_date', '=', $rpr_test_date)
                         ->latest('created_at')
                         ->first();


        $rdt =Crypt::decrypt_light($rpr_test_data["RDT Result"],$table);
         $rpr=Crypt::decrypt_light($rpr_test_data["RPR Qualitative"],$table);
        //  $vdrl=Crypt::decrypt_light($rpr_test_data["Final_Result"],$table);
        return response()->json([
          $rpr_test_data,
           $rdt,
           $rpr,
          // $vdrl,
        ]);
      }
      if($hepB_test == 1){
        $table="General";
        $hepB_test_data = LabHbcTest::select('HepB Result','HepC Result')->where('CID','=',$gid)->where('Visit_date','=',$hepB_test_date)->latest('created_at')->first();

        $hbsag=Crypt::decrypt_light($hepB_test_data["HepB Result"],$table);
        $hcv_ab=Crypt::decrypt_light($hepB_test_data["HepC Result"],$table);
        return response()->json([
          $hepB_test_data,
           $hbsag,
           $hcv_ab,
        ]);
      }
      // HTS Section
      if($listShow == 1){
        $date_from      = $request ->input('dateFrom');
        $search_ID      =$request->input('search_ID');
        $date_to        = $request ->input('dateTo');
        $updatedType     = $request ->input('updatedType');
        $date_from = date($date_from);
        $date_to = date($date_to);

        if($updatedType==1){
          $counselling_data = CounsellorRecords::whereBetween('Counselling_Date', [$date_from, $date_to])
          ->orwhere('Pid',$search_ID)->get();
          $updated_data=$counselling_data;
        }else if($updatedType==0) {
          $hts_data = Coulselling::whereBetween('Counselling_Date', [$date_from, $date_to])->orwhere('Pid',$search_ID)->get();
          $updated_data=$hts_data;
        }

          if(count($updated_data)>0){
            return response()->json([
              $updated_data
            ]);
          }else{
            $nodata ="no data";
            return response()->json([
              $nodata
            ]);
          }
      } // HTS data show
      if($decryptFetch == 1){// return data from view to encrypt the row
        $address = $request -> input('address');
        $date_from = $request -> input('dateFrom');
        $date_to = $request -> input('dateTo');
        $res_date= $request->input('res_date');
        $id = $request -> input('id');
        $search_ID      =$request->input('search_ID');
        $updatedType      =$request->input('updatedType');
        $Age="";

        $date_from = date($date_from);
        $date_to = date($date_to);

        // $hts_data_next = Coulselling::whereBetween('Counselling_Date', [$date_from, $date_to])->orwhere('Pid',$search_ID)->get();

        $patientData = PtConfig::select('Region', 'Township','Quarter','Phone','Phone2','Phone3',)->where('Pid', '=', $id)->first();

        $table="General";
        $hTSdone=$prep_status=$reason=$status=$New_Old="";
        $HIV_Test_Date=$Syp_Test_Date=$Hep_Test_Date=$Service_Modality=$Mode_of_Entry=$HIV_Test_Determine=$HIV_Test_UNI="";
        $HIV_Test_STAT=$Syphillis_RDT=$HIV_Final_Result=$Syphillis_RPR=$Syphillis_VDRL=$Hepatitis_B=$Hepatitis_C=$test_locate="";
        $adh= $anc= $c1 = $c2= $c3= $cp_case =$ch_under15_adh =$ch_under15_adole =$ch_under15_dis =$eac =$fht =$ipt =$mmt =$ncd
        =$other =$pfa =$phq9 =$pmtct =$prep =$tb=0;
        if($updatedType==0){ //Updated data filler for Hts and counselling

          $hts_data_next = Coulselling::where('id',$address)->where('Pid',$id)->orwhere('Pid',$search_ID)->get();

          $type_counselling=CounsellorRecords::select("HTSdone","Reason","Status","PrEP","PrEP Status","C1","C2","C3","ADH",
          "Child under15 Adoles","Child under15 Dis","Child under15 ADH","MMT","IPT","TB","NCD","ANC","PFA","PHQ9","Other",
          "EAC","HMT","C P case","PMTCT",)->where('Pid', '=', $id)->where('Counselling_Date',$res_date)
          ->orderByDesc('created_at')
          ->get();

          for ($i=0; $i < count($hts_data_next) ; $i++) {

            if($address == $hts_data_next[$i]["id"]){
              $Pid= $hts_data_next[$i]["Pid"];
              $FuchiaID= $hts_data_next[$i]["FuchiaID"];
              $Age= $hts_data_next[$i]["Age"];
              $Pre= $hts_data_next[$i]["Pre"];
              $Post= $hts_data_next[$i]["Post"];
              $New_Old= $hts_data_next[$i]["New_Old"];
              $Counselling_Date= $hts_data_next[$i]["Counselling_Date"];
              $HIV_Test_Date= $hts_data_next[$i]["HIV_Test_Date"];
              $Syp_Test_Date= $hts_data_next[$i]["Syp_Test_Date"];
              $Hep_Test_Date= $hts_data_next[$i]["Hep_Test_Date"];

              // decrypted section
              $sex = Crypt::decrypt_light($hts_data_next[$i]["Gender"],$table);
              $Counsellor = Crypt::decrypt_light($hts_data_next[$i]["Counsellor"],$table);
              $Service_Modality = Crypt::decrypt_light($hts_data_next[$i]["Service_Modality"],$table);
              $Mode_of_Entry = Crypt::decrypt_light($hts_data_next[$i]["Mode of Entry"],$table);
              $Main_Risk = Crypt::decrypt_light($hts_data_next[$i]["Main Risk"],$table);
              $Sub_Risk = Crypt::decrypt_light($hts_data_next[$i]["Sub Risk"],$table);
              $HIV_Test_Determine = Crypt::decrypt_light($hts_data_next[$i]["HIV_Test_Determine"],$table);
              $HIV_Test_UNI = Crypt::decrypt_light($hts_data_next[$i]["HIV_Test_UNI"],$table);
              $HIV_Test_STAT = Crypt::decrypt_light($hts_data_next[$i]["HIV_Test_STAT"],$table);
              $HIV_Final_Result = Crypt::decrypt_light($hts_data_next[$i]["HIV_Final_Result"],$table);
              $Syphillis_RDT = Crypt::decrypt_light($hts_data_next[$i]["Syphillis_RDT"],$table);
              $Syphillis_RPR = Crypt::decrypt_light($hts_data_next[$i]["Syphillis_RPR"],$table);
              $Syphillis_VDRL = Crypt::decrypt_light($hts_data_next[$i]["Syphillis_VDRL"],$table);
              $Hepatitis_B = Crypt::decrypt_light($hts_data_next[$i]["Hepatitis_B"],$table);
              $Hepatitis_C = Crypt::decrypt_light($hts_data_next[$i]["Hepatitis_C"],$table);
              $test_locate = $hts_data_next[$i]["Test_Location"];
            }
          }

          for($coun_res_row=0;$coun_res_row <count( $type_counselling);$coun_res_row++){
            $hTSdone=Crypt::decrypt_light($type_counselling[$coun_res_row]["HTSdone"],$table);
            $prep_status=Crypt::decrypt_light($type_counselling[$coun_res_row]["PrEP Status"],$table);
            $reason=Crypt::decrypt_light($type_counselling[$coun_res_row]["Reason"],$table);
            $status=Crypt::decrypt_light($type_counselling[$coun_res_row]["Status"],$table);
            switch(0) {
              case $adh :$adh=$type_counselling[$coun_res_row]["ADH"];
              case $anc :$anc=$type_counselling[$coun_res_row]["ANC"];
              case $c1 :$c1=$type_counselling[$coun_res_row]["C1"];
              case $c2 :$c2=$type_counselling[$coun_res_row]["C2"];
              case $c3 :$c3=$type_counselling[$coun_res_row]["C3"];
              case $cp_case :$cp_case=$type_counselling[$coun_res_row]["C P case"];
              case $ch_under15_adh :$ch_under15_adh=$type_counselling[$coun_res_row]["Child under15 ADH"];
              case $ch_under15_adole :$ch_under15_adole=$type_counselling[$coun_res_row]["Child under15 Adoles"];
              case $ch_under15_dis :$ch_under15_dis=$type_counselling[$coun_res_row]["Child under15 Dis"];
              case $eac :$eac=$type_counselling[$coun_res_row]["EAC"];
              case $fht :$fht=$type_counselling[$coun_res_row]["HMT"];
              case $ipt :$ipt=$type_counselling[$coun_res_row]["IPT"];
              case $mmt :$mmt=$type_counselling[$coun_res_row]["MMT"];
              case $ncd :$ncd=$type_counselling[$coun_res_row]["NCD"];
              case $other :$other=$type_counselling[$coun_res_row]["Other"];
              case $pfa  :$pfa=$type_counselling[$coun_res_row]["PFA"];
              case $phq9 :$phq9=$type_counselling[$coun_res_row]["PHQ9"];
              case $pmtct :$pmtct=$type_counselling[$coun_res_row]["PMTCT"];
              case $prep :$prep=$type_counselling[$coun_res_row]["PrEP"];
              case $tb :$tb=$type_counselling[$coun_res_row]["TB"];

            }

         }

        }else if($updatedType==1){   // counselling only
          $coun_row_data=CounsellorRecords::where('id',$address)->get();
          for ($i=0; $i < count($coun_row_data) ; $i++) {
            $Pid=$coun_row_data[$i]["Pid"];
              $FuchiaID=$coun_row_data[$i]["FuchiaID"];
              $Age=$coun_row_data[$i]["Agey"];
              $Pre=$coun_row_data[$i]["Pre"];
              $Post=$coun_row_data[$i]["Post"];
              $Counselling_Date=$coun_row_data[$i]["Counselling_Date"];
              $sex = Crypt::decrypt_light($coun_row_data[$i]["Gender"],$table);
              $Counsellor = Crypt::decrypt_light($coun_row_data[$i]["Counsellor"],$table);
              $Main_Risk = Crypt::decrypt_light($coun_row_data[$i]["Main Risk"],$table);
              $Sub_Risk = Crypt::decrypt_light($coun_row_data[$i]["Sub Risk"],$table);


              $hTSdone=Crypt::decrypt_light($coun_row_data[$i]["HTSdone"],$table);
              $prep_status=Crypt::decrypt_light($coun_row_data[$i]["PrEP Status"],$table);
              $reason=Crypt::decrypt_light($coun_row_data[$i]["Reason"],$table);
              $status=Crypt::decrypt_light($coun_row_data[$i]["Status"],$table);
              switch(0) {
                case $adh :$adh=$coun_row_data[$i]["ADH"];
                case $anc :$anc=$coun_row_data[$i]["ANC"];
                case $c1 :$c1=$coun_row_data[$i]["C1"];
                case $c2 :$c2=$coun_row_data[$i]["C2"];
                case $c3 :$c3=$coun_row_data[$i]["C3"];
                case $cp_case :$cp_case=$coun_row_data[$i]["C P case"];
                case $ch_under15_adh :$ch_under15_adh=$coun_row_data[$i]["Child under15 ADH"];
                case $ch_under15_adole :$ch_under15_adole=$coun_row_data[$i]["Child under15 Adoles"];
                case $ch_under15_dis :$ch_under15_dis=$coun_row_data[$i]["Child under15 Dis"];
                case $eac :$eac=$coun_row_data[$i]["EAC"];
                case $fht :$fht=$coun_row_data[$i]["HMT"];
                case $ipt :$ipt=$coun_row_data[$i]["IPT"];
                case $mmt :$mmt=$coun_row_data[$i]["MMT"];
                case $ncd :$ncd=$coun_row_data[$i]["NCD"];
                case $other :$other=$coun_row_data[$i]["Other"];
                case $pfa  :$pfa=$coun_row_data[$i]["PFA"];
                case $phq9 :$phq9=$coun_row_data[$i]["PHQ9"];
                case $pmtct :$pmtct=$coun_row_data[$i]["PMTCT"];
                case $prep :$prep=$coun_row_data[$i]["PrEP"];
                case $tb :$tb=$coun_row_data[$i]["TB"];

              }

          }

        }






        $ptRegion = $patientData["Region"];
        $ptRegion = Crypt::decryptString($ptRegion);

        $ptTownship = $patientData["Township"];
        $ptTownship = Crypt::decryptString($ptTownship);

        $ptQuarter = $patientData["Quarter"];
        $ptQuarter = Crypt::decryptString($ptQuarter);

        $phone = $patientData["Phone"];
        $phone  = Crypt::decryptString($phone);

        $phone2 = $patientData["Phone2"];
        $phone2  = Crypt::decryptString($phone2);

        $phone3 = $patientData["Phone3"];
        $phone3  = Crypt::decryptString($phone3);



        return response()->json([
          $Pid,
          $FuchiaID,
          $Age,
          $Pre,
          $Post,
          $New_Old,
          $Counselling_Date,
          $HIV_Test_Date,
          $Syp_Test_Date,
          $Hep_Test_Date,

          $sex,//10
          $Counsellor,
          $Service_Modality,
          $Mode_of_Entry,
          $Main_Risk,
          $Sub_Risk,
           $HIV_Test_Determine,
           $HIV_Test_UNI,
           $HIV_Test_STAT,
           $HIV_Final_Result,
          $Syphillis_RDT,
          $Syphillis_RPR,
          $Syphillis_VDRL,
          $Hepatitis_B,
          $Hepatitis_C,
          $phone,
          $phone2,
          $phone3,
          $ptQuarter,
          $ptRegion,
          $ptTownship,
          $patientData,
          $hTSdone,
          $prep_status,
          $reason,
          $status,
          $prep,
          $c1 ,$c2, $c3,
          $adh  ,$ch_under15_adole ,$ch_under15_dis
          ,$ch_under15_adh ,$mmt,$ipt
          ,$tb,$ncd, $anc
          ,$pfa ,$phq9,$other
          ,$eac ,$fht,  $cp_case
          ,$pmtct ,$test_locate,
           //$coun_row_data,
          // $hts_data_next,
           $address,



        ]);
      }
      if($htsUpdate == 1){ // to update HTS data rows
        $table="General";
        $gid = $request -> input('pid');
        $cdate=$request->input('Counselling_Date');
        $hiv_test_date=$request->input('hiv_test_date');
        $syp_date=$request->input('syp_date');
        $hep_date=$request->input('hep_date');
        $counselor = Crypt::encrypt_light($request->input('Counsellor'),$table);
        $service = Crypt::encrypt_light($request->input('service'),$table);
        $mode_of_entry = Crypt::encrypt_light($request->input('mode_of_entry'),$table);
        $new_old = Crypt::encrypt_light($request->input('new_old'),$table);
        $Main_Risk = Crypt::encrypt_light($request->input('Main_Risk'),$table);
        $Sub_Risk = Crypt::encrypt_light($request->input('Sub_Risk'),$table);
        $hiv_determine = Crypt::encrypt_light($request->input('hiv_determine'),$table);
        $hiv_unigold = Crypt::encrypt_light($request->input('hiv_unigold'),$table);
        $hiv_stat = Crypt::encrypt_light($request->input('hiv_stat'),$table);
        $hiv_final = Crypt::encrypt_light($request->input('hiv_final'),$table);
        $syp_rdt = Crypt::encrypt_light($request->input('syp_rdt'),$table);
        $syp_rpr = Crypt::encrypt_light($request->input('syp_rpr'),$table);
        $syp_vdrl = Crypt::encrypt_light($request->input('syp_vdrl'),$table);
        $hep_b = Crypt::encrypt_light($request->input('hep_b'),$table);
        $hep_c = Crypt::encrypt_light($request->input('hep_c'),$table);


        $region = $request -> input('state');
        $region = Crypt::encryptString($region);

        $township = $request -> input('township');
        $township = Crypt::encryptString($township);

        $quarter = $request -> input('quarter');
        $quarter = Crypt::encryptString($quarter);

        $phone = $request -> input('phone');
        $phone = Crypt::encryptString($phone);

        $phone2 = $request -> input('phone2');
        $phone2 = Crypt::encryptString($phone2);

        $phone3 = $request -> input('phone3');
        $phone3 = Crypt::encryptString($phone3);

        $table ="General";
        $main_risk = $request -> input('Main_Risk');
        $main_risk = Crypt::encrypt_light($main_risk,$table);

        $sub_risk = $request -> input('Sub_Risk');
        $sub_risk = Crypt::encrypt_light($sub_risk,$table);

        $HTSdone = $request -> input('HTSdone');
        $HTSdone = Crypt::encrypt_light($HTSdone,$table);

        $Reason = $request -> input('Reason');
        $Reason = Crypt::encrypt_light($Reason,$table);

        $Status = $request -> input('Status');
        $Status= Crypt::encrypt_light($Status,$table);

        $PrEP_Status = $request -> input('PrEP_Status');
        $PrEP_Status = Crypt::encrypt_light($PrEP_Status,$table);
        $updatedType = $request -> input('updatedType');
        // $follow_exist = Followup_general::where('Pid', $gid)
        // ->where('Visit Date',$cdate)
        // ->exists();



          $hiv_exist = Lab::where('CID', $gid)
          ->where('Visit_date',$hiv_test_date)
          ->exists();

          $hebc_exist = LabHbcTest::where('CID', $gid)
          ->where('Visit_date',$hep_date)
          ->exists();

          $rpr_exist = Rprtest::where('pid', $gid)
          ->where('Visit_date',$syp_date)
          ->exists();

          $urine_exist = Urine::where('CID',$gid)
          ->where('visitDate',$cdate)
          ->exists();

          $labsti_exist = Labstitest::where('CID',$gid)
          ->where('visit_date',$cdate)
          ->exists();

          $loboi_exist =Lab_oi::where('CID',$gid)
          ->where('visit_date',$cdate)
          ->exists();

          $labgeneral_exist = LabGeneralTest::where('CID',$gid)
          ->where('Visit_date',$cdate)
          ->exists();

          $labstool_exist = LabStoolTest::where('CID',$gid)
          ->where('visit_date',$cdate)
          ->exists();

          $labafb_exist = LabAfbTest::where('CID',$gid)
          ->where('visit_date',$cdate)
          ->exists();

          $labcovid_exist = LabCovidTest::where('CID',$gid)
          ->where('visit_date')
          ->exists('visit_date');

          $labviralload_exist = Viralload::where('CID','=',$gid)
          ->where('created_at',$cdate)
          ->exists();
          if($updatedType==0) { // Updated Hts and Counselling
            if($hiv_exist||$hebc_exist||$rpr_exist ){

              $hts_exist=Coulselling::where('id',$hts_row_address)->where('Pid',$gid)->where('Counselling_Date',$cdate)
              ->exists();
              if($hts_exist){
                $coun_record_exist=CounsellorRecords::where('Pid',$gid)->where('Counselling_Date',$cdate)->exists();
                if($coun_record_exist){
                  if($labviralload_exist||$labcovid_exist||$labafb_exist||$labstool_exist
                  ||$labgeneral_exist||$loboi_exist|| $labsti_exist||$urine_exist)
                  {
                    if($urine_exist){
                    $urine_res=Urine::where('CID','=',$gid)->where('visitDate',$cdate)->latest()->limit(1)
                    ->update([
                    'Main Risk' => $main_risk,
                    'Sub Risk'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                    ]);
                    }
                    if($labsti_exist){
                      $sti_lab_res=Labstitest::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                      ->update([
                        'Type Of Patient' => $main_risk,
                        'Patient Type Sub'  => $sub_risk,
                        'updated_by' => $request->updated_by,
                      ]);

                    }
                    if($loboi_exist){
                    $oi_Lab= Lab_oi::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                      ->update([
                        'Main Risk' => $main_risk,
                        'Sub Risk'  => $sub_risk,
                        'updated_by' => $request->updated_by,
                      ]);
                    }

                    if($labgeneral_exist){
                      $general_res=LabGeneralTest::where('CID','=',$gid)->where('Visit_date',$cdate)->latest()->limit(1)
                      ->update([
                        'Patient_Type' => $main_risk,
                        'Patient Type Sub'  => $sub_risk,
                        'updated_by' => $request->updated_by,
                      ]);
                    }
                    if($labafb_exist){
                      $afb_res=LabAfbTest::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                      ->update([
                        'Patient Type' => $main_risk,
                        'Patient Type Sub'  => $sub_risk,
                        'updated_by' => $request->updated_by,
                      ]);
                    }


                    if($labstool_exist){
                      $stool_res=LabStoolTest::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                      ->update([
                        'Patient Type' => $main_risk,
                        'Patient Type Sub'  => $sub_risk,
                        'updated_by' => $request->updated_by,
                      ]);
                    }

                    if($labcovid_exist){
                      $covid_res= LabCovidTest::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                      ->update([
                        'Patient Type' => $main_risk,
                        'Patient Type Sub'  => $sub_risk,
                        'updated_by' => $request->updated_by,
                      ]);
                    }
                    if($labviralload_exist){
                      $Vir_res=Viralload::where('CID','=',$gid)->where('created_at',$cdate)->latest()->limit(1)
                      ->update([
                        'Main-Risk' => $main_risk,
                        'Sub-Risk'  => $sub_risk,
                        'updated_by' => $request->updated_by,
                      ]);
                    }
                  }

                  if($hiv_exist){
                    $hiv_res=Lab::where('CID','=',$gid)->where('Visit_date','=',$cdate)->latest()->limit(1)
                    ->update([
                      'Patient_Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($rpr_exist){
                    $rpr_value= Rprtest::where('pid','=',$gid)->where('visit_date','=',$cdate)->latest()->limit(1)
                    ->update([
                    'Type Of Patient' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }

                  if($hebc_exist){
                    $hbc_res=LabHbcTest::where('CID','=',$gid)->where('Visit_date','=',$cdate)->latest()->limit(1)
                    ->update([
                    'Patient_Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }



                  Patients::where('Pid',$gid)
                  ->update([
                  'Main Risk'=> $main_risk,
                  'Sub Risk'=> $sub_risk,
                  'updated_by' => $request->updated_by,
                    ]);
                  PtConfig::where('Pid',$gid)
                  ->update([
                  'Main Risk' => $main_risk,
                  'Sub Risk'  => $sub_risk,
                  'Region'    => $region,
                  'Township'  => $township,
                  'Quarter'   => $quarter,
                  'Phone'     => $phone,
                  'Phone2'    => $phone2,
                  'Phone3'    => $phone3,
                  'updated_by' => $request->updated_by,
                 ]);
                  CounsellorRecords::where('Pid',$gid)->where('Counselling_Date',$cdate)
                  ->update([
                    "Counselling_Date" => $request->Counselling_Date,
                    "Counsellor" =>  $counselor,
                    "Main Risk" => $main_risk,
                    "Sub Risk" => $sub_risk,

                    "Pre" => $request -> Pre,
                    "Post" => $request -> Post,
                    "HTSdone" => $HTSdone,
                    "Reason" => $Reason,
                    "Status" => $Status,
                    "PrEP" => $request -> PrEP ,
                    "PrEP Status" => $PrEP_Status,
                    "C1" => $request -> c1,
                    "C2" => $request -> c2,
                    "C3" => $request -> c3,
                    "ADH" => $request -> adh,
                    "Child under15 Adoles" => $request -> Child_under15_Adoles,
                    "Child under15 Dis" => $request -> Child_under15_Dis,
                    "Child under15 ADH" => $request -> Child_under15_ADH,
                    "MMT" => $request -> mmt,
                    "IPT" => $request -> ipt,
                    "TB" => $request -> tb,
                    "NCD" => $request -> ncd,
                    "ANC" => $request -> anc,
                    "PFA" => $request -> pfa,
                    "PHQ9" => $request -> phq9,
                    "Other" => $request -> Other,
                    "EAC" => $request -> eac,
                    "HMT" => $request -> hmt,
                    "C P case" => $request -> c_p_case,
                    "PMTCT" => $request -> pmtct,

                    'updated_by' => $request->updated_by,
                  ]);

                  Coulselling::where('id','=',$hts_row_address)
                    ->update([


                    "Counsellor"=> $counselor,
                    "Pre"=> $request->Pre,
                    "Post"=> $request->Post,
                    "Service_Modality"=> $service,
                    "Mode of Entry"=> $mode_of_entry,
                    'New_Old'=> $new_old,
                    "Counselling_Date"=> $request->Counselling_Date,

                    "Main Risk"=> $Main_Risk,
                    'Sub Risk'=> $Sub_Risk,

                    'HIV_Test_Date'=> $request->hiv_test_date,
                    'HIV_Test_Determine'=> $hiv_determine,
                    'HIV_Test_UNI'=> $hiv_unigold,
                    'HIV_Test_STAT'=> $hiv_stat,
                    'HIV_Final_Result'=> $hiv_final,

                    'Syp_Test_Date'=> $request->syp_date,
                    'Syphillis_RDT'=> $syp_rdt,
                    'Syphillis_RPR'=> $syp_rpr,
                    'Syphillis_VDRL'=> $syp_vdrl,

                    'Hep_Test_Date'=> $request->hep_date,
                    'Hepatitis_B'=> $hep_b,
                    'Hepatitis_C'=> $hep_c,

                    'updated_by' => $request->updated_by,
                  ]);
                  $lab_existTest=[$labviralload_exist,$labcovid_exist,$labafb_exist,$labstool_exist
                  ,$labgeneral_exist,$loboi_exist, $labsti_exist,$urine_exist,$rpr_exist,$hebc_exist,$hiv_exist];

                   $success=$lab_existTest;

                }else {
                  $success=2.4;// do not have counselling_record data
                }


              }else {
                $success=2.3;//do not have In Hts Data

              }



            }else {
            $success=2.1;//Do not test in HIV(or)RPR,(or)Hebc
           }

          }else if($updatedType==1) {  //Updated Counselling if have Hts Updated Hts
            $coun_record_exist=true;
            // $coun_record_exist=CounsellorRecords::where('Pid',$gid)->where('id',$hts_row_address)->where('Counselling_Date',$cdate)->exists();
                if($coun_record_exist){
                  if($labviralload_exist||$labcovid_exist||$labafb_exist||$labstool_exist
                  ||$labgeneral_exist||$loboi_exist|| $labsti_exist||$urine_exist)
                    {
                      if($urine_exist){
                      $urine_res=Urine::where('CID','=',$gid)->where('visitDate',$cdate)->latest()->limit(1)
                      ->update([
                      'Main Risk' => $main_risk,
                      'Sub Risk'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                      ]);
                      }
                      if($labsti_exist){
                        $sti_lab_res=Labstitest::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                        ->update([
                          'Type Of Patient' => $main_risk,
                          'Patient Type Sub'  => $sub_risk,
                          'updated_by' => $request->updated_by,
                        ]);

                      }
                      if($loboi_exist){
                      $oi_Lab= Lab_oi::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                        ->update([
                          'Main Risk' => $main_risk,
                          'Sub Risk'  => $sub_risk,
                          'updated_by' => $request->updated_by,
                        ]);
                      }

                      if($labgeneral_exist){
                        $general_res=LabGeneralTest::where('CID','=',$gid)->where('Visit_date',$cdate)->latest()->limit(1)
                        ->update([
                          'Patient_Type' => $main_risk,
                          'Patient Type Sub'  => $sub_risk,
                          'updated_by' => $request->updated_by,
                        ]);
                      }
                      if($labafb_exist){
                        $afb_res=LabAfbTest::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                        ->update([
                          'Patient Type' => $main_risk,
                          'Patient Type Sub'  => $sub_risk,
                          'updated_by' => $request->updated_by,
                        ]);
                      }


                      if($labstool_exist){
                        $stool_res=LabStoolTest::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                        ->update([
                          'Patient Type' => $main_risk,
                          'Patient Type Sub'  => $sub_risk,
                          'updated_by' => $request->updated_by,
                        ]);
                      }

                      if($labcovid_exist){
                        $covid_res= LabCovidTest::where('CID','=',$gid)->where('visit_date',$cdate)->latest()->limit(1)
                        ->update([
                          'Patient Type' => $main_risk,
                          'Patient Type Sub'  => $sub_risk,
                          'updated_by' => $request->updated_by,
                        ]);
                      }
                      if($labviralload_exist){
                        $Vir_res=Viralload::where('CID','=',$gid)->where('created_at',$cdate)->latest()->limit(1)
                        ->update([
                          'Main-Risk' => $main_risk,
                          'Sub-Risk'  => $sub_risk,
                          'updated_by' => $request->updated_by,
                        ]);
                      }
                  }

                  if($hiv_exist){
                    $hiv_res=Lab::where('CID','=',$gid)->where('Visit_date','=',$cdate)->latest()->limit(1)
                    ->update([
                      'Patient_Type' => $main_risk,
                      'Patient Type Sub'  => $sub_risk,
                      'updated_by' => $request->updated_by,
                    ]);
                  }

                  if($rpr_exist){
                    $rpr_value= Rprtest::where('pid','=',$gid)->where('visit_date','=',$cdate)->latest()->limit(1)
                    ->update([
                    'Type Of Patient' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }

                  if($hebc_exist){
                    $hbc_res=LabHbcTest::where('CID','=',$gid)->where('Visit_date','=',$cdate)->latest()->limit(1)
                    ->update([
                    'Patient_Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                  }



                  Patients::where('Pid',$gid)
                  ->update([
                  'Main Risk'=> $main_risk,
                  'Sub Risk'=> $sub_risk,
                  'updated_by' => $request->updated_by,
                    ]);
                  PtConfig::where('Pid',$gid)
                  ->update([
                  'Main Risk' => $main_risk,
                  'Sub Risk'  => $sub_risk,
                  'Region'    => $region,
                  'Township'  => $township,
                  'Quarter'   => $quarter,
                  'Phone'     => $phone,
                  'Phone2'    => $phone2,
                  'Phone3'    => $phone3,
                  'updated_by' => $request->updated_by,
                 ]);
                  CounsellorRecords::where('id',$hts_row_address)
                  ->update([
                    "Counselling_Date" => $request->Counselling_Date,
                    "Counsellor" =>  $counselor,
                    "Main Risk" => $main_risk,
                    "Sub Risk" => $sub_risk,

                    "Pre" => $request -> Pre,
                    "Post" => $request -> Post,
                    "HTSdone" => $HTSdone,
                    "Reason" => $Reason,
                    "Status" => $Status,
                    "PrEP" => $request -> PrEP ,
                    "PrEP Status" => $PrEP_Status,
                    "C1" => $request -> c1,
                    "C2" => $request -> c2,
                    "C3" => $request -> c3,
                    "ADH" => $request -> adh,
                    "Child under15 Adoles" => $request -> Child_under15_Adoles,
                    "Child under15 Dis" => $request -> Child_under15_Dis,
                    "Child under15 ADH" => $request -> Child_under15_ADH,
                    "MMT" => $request -> mmt,
                    "IPT" => $request -> ipt,
                    "TB" => $request -> tb,
                    "NCD" => $request -> ncd,
                    "ANC" => $request -> anc,
                    "PFA" => $request -> pfa,
                    "PHQ9" => $request -> phq9,
                    "Other" => $request -> Other,
                    "EAC" => $request -> eac,
                    "HMT" => $request -> hmt,
                    "C P case" => $request -> c_p_case,
                    "PMTCT" => $request -> pmtct,

                    'updated_by' => $request->updated_by,
                  ]);

                  Coulselling::where('Pid',$gid)->where('Counselling_Date',$cdate)
                    ->update([


                    "Counsellor"=> $counselor,
                    "Pre"=> $request->Pre,
                    "Post"=> $request->Post,
                    "Main Risk"=> $Main_Risk,
                    'Sub Risk'=> $Sub_Risk,
                    'updated_by' => $request->updated_by,
                  ]);


                   $success=1;

                }else {
                  $success=2.4;// do not have counselling_record data
                }
          }












         return response()->json([
           $success,
         ]);
      }

      // Risk_Age_ update
      if($pt_data_update==1){


        $table="General";

        $risk_changeDate = $request->input('risk_changeDate');

        $region = $request -> input('state');
        $region = Crypt::encryptString($region);

        $township = $request -> input('township');
        $township = Crypt::encryptString($township);

        $quarter = $request -> input('quarter');
        $quarter = Crypt::encryptString($quarter);

        $phone = $request -> input('phone');
        $phone = Crypt::encryptString($phone);

        $phone2 = $request -> input('phone2');
        $phone2 = Crypt::encryptString($phone2);

        $phone3 = $request -> input('phone3');
        $phone3 = Crypt::encryptString($phone3);

        $Date_of_Birth = $request -> input('Date_of_Birth');
        $Date_of_Birth = Crypt::encryptString($Date_of_Birth);

        $main_risk = Crypt::encrypt_light($request->input('Main_Risk'),$table);
        $sub_risk = Crypt::encrypt_light($request->input('Sub_Risk'),$table);


        if($risk_changeDate !=null) {
          Urine::where('CID','=',$gid)->where('visitDate',$risk_changeDate)->latest()->limit(1)
          ->update([
            'Main Risk' => $main_risk,
            'Sub Risk'  => $sub_risk,
            'updated_by' => $request->updated_by,
          ]);

          Labstitest::where('CID','=',$gid)->where('visit_date',$risk_changeDate)->latest()->limit(1)
            ->update([
              'Type Of Patient' => $main_risk,
              'Patient Type Sub'  => $sub_risk,
              'updated_by' => $request->updated_by,
            ]);
          Lab_oi::where('CID','=',$gid)->where('visit_date',$risk_changeDate)->latest()->limit(1)
            ->update([
              'Main Risk' => $main_risk,
              'Sub Risk'  => $sub_risk,
              'updated_by' => $request->updated_by,
            ]);

            LabGeneralTest::where('CID','=',$gid)->where('Visit_date',$risk_changeDate)->latest()->limit(1)
            ->update([
              'Patient_Type' => $main_risk,
              'Patient Type Sub'  => $sub_risk,
              'updated_by' => $request->updated_by,
            ]);
            LabAfbTest::where('CID','=',$gid)->where('visit_date',$risk_changeDate)->latest()->limit(1)
            ->update([
              'Patient Type' => $main_risk,
              'Patient Type Sub'  => $sub_risk,
              'updated_by' => $request->updated_by,
            ]);

            LabStoolTest::where('CID','=',$gid)->where('visit_date',$risk_changeDate)->latest()->limit(1)
            ->update([
              'Patient Type' => $main_risk,
              'Patient Type Sub'  => $sub_risk,
              'updated_by' => $request->updated_by,
            ]);

            LabCovidTest::where('CID','=',$gid)->where('visit_date',$risk_changeDate)->latest()->limit(1)
            ->update([
              'Patient Type' => $main_risk,
              'Patient Type Sub'  => $sub_risk,
              'updated_by' => $request->updated_by,
            ]);

            Viralload::where('CID','=',$gid)->where('created_at',$risk_changeDate)->latest()->limit(1)
            ->update([
              'Main-Risk' => $main_risk,
              'Sub-Risk'  => $sub_risk,
              'updated_by' => $request->updated_by,
            ]);


         }


        Patients::where('Pid',$gid)
        ->update([
          'Main Risk'=> $main_risk,
          'Sub Risk'=> $sub_risk,
            'Agey'=> $request->Agey,
            'Agem'=> $request->Agem,
            'Date of Birth'=>$Date_of_Birth,
            'updated_by' => $request->updated_by,
        ]);
        PtConfig::where('Pid',$gid)
        ->update([
          'Main Risk' => $main_risk,
          'Sub Risk'  => $sub_risk,
            'Agey'=> $request->Agey,
            'Agem'=> $request->Agem,
            'Region'    => $region,
            'Township'  => $township,
            'Quarter'   => $quarter,
            'Phone'     => $phone,
            'Phone2'    => $phone2,
            'Phone3'    => $phone3,
            'Date of Birth'=>$Date_of_Birth,
            'updated_by' => $request->updated_by,
        ]);
        Coulselling::where('Pid',$gid)
        ->update([
          'Main Risk'=> $main_risk,
          'Sub Risk'=> $sub_risk,
          //'Agey'=> $request->agey,
          'updated_by' => $request->updated_by,
        ]);




        $success=[[ 	"id"  => 1,
        "name" => "Successfully collected" ]];
         return response()->json([
           $success
         ]);
      }

      if($counsellingOnly==1){

        $labTestDate=$request->input('labTestDate');


        $cdate= $request->input('Counselling_Date');

        $gid    = $request->input('Pid');

        $region = $request -> input('state');
        $region = Crypt::encryptString($region);

        $township = $request -> input('township');
        $township = Crypt::encryptString($township);

        $quarter = $request -> input('quarter');
        $quarter = Crypt::encryptString($quarter);

        $phone = $request -> input('phone');
        $phone = Crypt::encryptString($phone);

        $phone2 = $request -> input('phone2');
        $phone2 = Crypt::encryptString($phone2);

        $phone3 = $request -> input('phone3');
        $phone3 = Crypt::encryptString($phone3);

        $calDob = Crypt::encryptString($request->input('calDob'));

        $table ="General";
        $main_risk = $request -> input('Main_Risk');
        $main_risk = Crypt::encrypt_light($main_risk,$table);

        $sub_risk = $request -> input('Sub_Risk');
        $sub_risk = Crypt::encrypt_light($sub_risk,$table);

        $counsellor = $request -> input('Counsellor');
        $counsellor = Crypt::encrypt_light($counsellor,$table);

        $HTSdone = $request -> input('HTSdone');
        $HTSdone = Crypt::encrypt_light($HTSdone,$table);

        $Reason = $request -> input('Reason');
        $Reason = Crypt::encrypt_light($Reason,$table);

        $Status = $request -> input('Status');
        $Status= Crypt::encrypt_light($Status,$table);

        $PrEP_Status = $request -> input('PrEP_Status');
        $PrEP_Status = Crypt::encrypt_light($PrEP_Status,$table);

        $edit=$request->input ('edit');

        $follow_lastDate = Followup_general::where('Pid', $gid)
        ->latest('Visit Date')
        ->value('Visit Date');
        if($follow_lastDate == $cdate){
          $conseling_exist = CounsellorRecords::where('Pid', $gid)->where('Counselling_Date',$cdate)
            ->exists();


          if(!$conseling_exist){
            $hiv = Lab::where('CID', $gid)
            ->latest('Visit_date')
            ->value('Visit_date');

            $hebc = LabHbcTest::where('CID', $gid)
            ->latest('Visit_date')
            ->value('Visit_date');

            $rpr = Rprtest::where('pid', $gid)
            ->latest('Visit_date')
            ->value('Visit_date');

            $urine = Urine::where('CID',$gid)
            ->latest('visitDate')
            ->value('visitDate');

            $labsti = Labstitest::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $loboi =Lab_oi::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $labgeneral = LabGeneralTest::where('CID',$gid)
            ->latest('Visit_date')
            ->value('Visit_date');

            $labstool = LabStoolTest::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $labafb = LabAfbTest::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $labcovid = LabCovidTest::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $labviralload = Viralload::where('CID','=',$gid)
            ->latest('created_at')
            ->value('created_at');

            $labs_visitDate = [$hiv,$hebc,$rpr,$urine,$labsti,$loboi,$labgeneral,$labstool,$labafb,$labcovid,$labviralload];
            $found= false;
            foreach($labs_visitDate as $value) {
              if($value==$labTestDate){
                $found=true;
                break;
              }
            }
            if($labTestDate=="preTest"||$found||$labTestDate=="postTest"){
              if($found){
                $hiv_res=$rpr_value=$hbc_res=$urine_res=$sti_lab_res=$general_res=$stool_res=$covid_res=$Vir_res= $afb_res=0;
                if($labTestDate==$urine){
                  $urine_res=Urine::where('CID','=',$gid)->where('visitDate',$urine)->latest()->limit(1)
                  ->update([
                  'Main Risk' => $main_risk,
                  'Sub Risk'  => $sub_risk,
                  'updated_by' => $request->updated_by,
                ]);
                }
                if($labTestDate==$labsti){
                  $sti_lab_res=Labstitest::where('CID','=',$gid)->where('visit_date',$labsti)->latest()->limit(1)
                  ->update([
                    'Type Of Patient' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);

                }
                if($labTestDate==$loboi){
                 $oi_Lab= Lab_oi::where('CID','=',$gid)->where('visit_date',$loboi)->latest()->limit(1)
                  ->update([
                    'Main Risk' => $main_risk,
                    'Sub Risk'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }

                if($labTestDate==$labgeneral){
                  $general_res=LabGeneralTest::where('CID','=',$gid)->where('Visit_date',$labgeneral)->latest()->limit(1)
                  ->update([
                    'Patient_Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }
                if($labTestDate==$labafb){
                  $afb_res=LabAfbTest::where('CID','=',$gid)->where('visit_date',$labafb)->latest()->limit(1)
                  ->update([
                    'Patient Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }


                if($labTestDate==$labstool){
                  $stool_res=LabStoolTest::where('CID','=',$gid)->where('visit_date',$labstool)->latest()->limit(1)
                  ->update([
                    'Patient Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }

                if($labTestDate==$labcovid){
                  $covid_res= LabCovidTest::where('CID','=',$gid)->where('visit_date',$labcovid)->latest()->limit(1)
                  ->update([
                    'Patient Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }
                if($labTestDate==$labviralload){
                  $Vir_res=Viralload::where('CID','=',$gid)->where('created_at',$labviralload)->latest()->limit(1)
                  ->update([
                    'Main-Risk' => $main_risk,
                    'Sub-Risk'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }

                if($labTestDate==$hiv){
                  $hiv_res=Lab::where('CID','=',$gid)->where('Visit_date','=',$hiv)->latest()->limit(1)
                  ->update([
                    'Patient_Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }

                if($labTestDate==$rpr){
                  $rpr_value= Rprtest::where('pid','=',$gid)->where('visit_date','=',$rpr)->latest()->limit(1)
                  ->update([
                  'Type Of Patient' => $main_risk,
                  'Patient Type Sub'  => $sub_risk,
                  'updated_by' => $request->updated_by,
                ]);
                }

                if($labTestDate==$hebc){
                  $hbc_res=LabHbcTest::where('CID','=',$gid)->where('Visit_date','=',$hebc)->latest()->limit(1)
                  ->update([
                  'Patient_Type' => $main_risk,
                  'Patient Type Sub'  => $sub_risk,
                  'updated_by' => $request->updated_by,
                ]);
                }

                $lab_updated_fine="no";

                  $labs_updated = [ $hiv_res, $rpr_value, $hbc_res ,$urine_res, $oi_Lab, $sti_lab_res , $afb_res, $general_res, $stool_res, $covid_res, $Vir_res ];
                    $updated_res= 0;

                    foreach($labs_updated as $updated_res) {
                      if($updated_res==1){
                        $lab_updated_fine="yes";
                        break;
                      }

                    }

                    if($lab_updated_fine=="yes"){

                        if ($edit==1) {
                          Patients::where('Pid',$gid)
                          ->update([
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'Date of Birth'=>$calDob,
                          'updated_by' => $request->updated_by,
                        ]);
                        PtConfig::where('Pid',$gid)
                        ->update([
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'Date of Birth'=>$calDob,
                          'updated_by' => $request->updated_by,

                        ]);
                        }
                        Followup_general::where('Pid',$gid)->latest('Visit Date')
                        ->update([
                          'Main Risk'=>$main_risk,
                          'Sub Risk'=>$sub_risk,
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'updated_by' => $request->updated_by,
                        ]);

                        Patients::where('Pid',$gid)
                        ->update([
                          'Main Risk'=>$main_risk,
                          'Sub Risk'=>$sub_risk,
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'Date of Birth'=>$calDob,
                          'updated_by' => $request->updated_by,
                        ]);
                        PtConfig::where('Pid',$gid)
                        ->update([
                          'Region'    => $region,
                          'Township'  => $township,
                          'Quarter'   => $quarter,
                          'Phone'     => $phone,
                          'Phone2'    => $phone2,
                          'Phone3'    => $phone3,
                          'Main Risk' => $main_risk,
                          'Sub Risk'  => $sub_risk,
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'Date of Birth'=>$calDob,
                          'updated_by' => $request->updated_by,
                        ]);

                        CounsellorRecords ::create([
                        "Clinic Code" => $request -> clinic_code ,
                        "Pid" => $request -> Pid,
                        "FuchiaID" => $request -> FuchiaID ,
                        "PrEPCode" => $request -> PrEPCode,
                        "Gender" => $request -> Gender,
                        "Agey" => $request -> Agey,
                        "Agem" => $request -> Agem,

                        "Counselling_Date" => $request -> Counselling_Date,
                        "Counsellor" => $counsellor,
                        "Main Risk" => $main_risk,
                        "Sub Risk" => $sub_risk,

                        "Pre" => $request -> Pre,
                        "Post" => $request -> Post,
                        "HTSdone" => $HTSdone,
                        "Reason" => $Reason,
                        "Status" => $Status,
                        "PrEP" => $request -> PrEP ,
                        "PrEP Status" => $PrEP_Status,
                        "C1" => $request -> c1,
                        "C2" => $request -> c2,
                        "C3" => $request -> c3,
                        "ADH" => $request -> adh,
                        "Child under15 Adoles" => $request -> Child_under15_Adoles,
                        "Child under15 Dis" => $request -> Child_under15_Dis,
                        "Child under15 ADH" => $request -> Child_under15_ADH,
                        "MMT" => $request -> mmt,
                        "IPT" => $request -> ipt,
                        "TB" => $request -> tb,
                        "NCD" => $request -> ncd,
                        "ANC" => $request -> anc,
                        "PFA" => $request -> pfa,
                        "PHQ9" => $request -> phq9,
                        "Other" => $request -> Other,
                        "EAC" => $request -> eac,
                        "HMT" => $request -> hmt,
                        "C P case" => $request -> c_p_case,
                        "PMTCT" => $request -> pmtct,

                        'created_by' => $request->updated_by,
                      ]);
                      $success=$labs_updated;  // Updated Risk With Lab Risk Data

                     }else{
                      $success=1.2; // Lab Test Date is not Final Testing Date
                     }

              }else{
                if ($edit==1) {
                  Patients::where('Pid',$gid)
                  ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                ]);
                PtConfig::where('Pid',$gid)
                ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                ]);
                }
                Followup_general::where('Pid',$gid)->latest('Visit Date')
                ->update([
                  'Main Risk'=>$main_risk,
                  'Sub Risk'=>$sub_risk,
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'updated_by' => $request->updated_by,
                ]);

                Patients::where('Pid',$gid)
                ->update([
                  'Main Risk'=>$main_risk,
                  'Sub Risk'=>$sub_risk,
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                ]);
                PtConfig::where('Pid',$gid)
                ->update([
                  'Region'    => $region,
                  'Township'  => $township,
                  'Quarter'   => $quarter,
                  'Phone'     => $phone,
                  'Phone2'    => $phone2,
                  'Phone3'    => $phone3,
                  'Main Risk' => $main_risk,
                  'Sub Risk'  => $sub_risk,
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                ]);

                CounsellorRecords ::create([
                "Clinic Code" => $request -> clinic_code ,
                "Pid" => $request -> Pid,
                "FuchiaID" => $request -> FuchiaID ,
                "PrEPCode" => $request -> PrEPCode,
                "Gender" => $request -> Gender,
                "Agey" => $request -> Agey,
                "Agem" => $request -> Agem,

                "Counselling_Date" => $request -> Counselling_Date,
                "Counsellor" => $counsellor,
                "Main Risk" => $main_risk,
                "Sub Risk" => $sub_risk,

                "Pre" => $request -> Pre,
                "Post" => $request -> Post,
                "HTSdone" => $HTSdone,
                "Reason" => $Reason,
                "Status" => $Status,
                "PrEP" => $request -> PrEP ,
                "PrEP Status" => $PrEP_Status,
                "C1" => $request -> c1,
                "C2" => $request -> c2,
                "C3" => $request -> c3,
                "ADH" => $request -> adh,
                "Child under15 Adoles" => $request -> Child_under15_Adoles,
                "Child under15 Dis" => $request -> Child_under15_Dis,
                "Child under15 ADH" => $request -> Child_under15_ADH,
                "MMT" => $request -> mmt,
                "IPT" => $request -> ipt,
                "TB" => $request -> tb,
                "NCD" => $request -> ncd,
                "ANC" => $request -> anc,
                "PFA" => $request -> pfa,
                "PHQ9" => $request -> phq9,
                "Other" => $request -> Other,
                "EAC" => $request -> eac,
                "HMT" => $request -> hmt,
                "C P case" => $request -> c_p_case,
                "PMTCT" => $request -> pmtct,

                'created_by' => $request->updated_by,
               ]);
               $success = 1; // has follow up and right lab test or do not include labTestDate

              }
            }else {
              $success = 1.1; // has follow_up but wrong Lab test data

            }


          }else if ($conseling_exist){
            $hiv = Lab::where('CID', $gid)
            ->latest('Visit_date')
            ->value('Visit_date');

            $hebc = LabHbcTest::where('CID', $gid)
            ->latest('Visit_date')
            ->value('Visit_date');

            $rpr = Rprtest::where('pid', $gid)
            ->latest('Visit_date')
            ->value('Visit_date');

            $urine = Urine::where('CID',$gid)
            ->latest('visitDate')
            ->value('visitDate');

            $labsti = Labstitest::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $loboi =Lab_oi::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $labgeneral = LabGeneralTest::where('CID',$gid)
            ->latest('Visit_date')
            ->value('Visit_date');

            $labstool = LabStoolTest::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $labafb = LabAfbTest::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $labcovid = LabCovidTest::where('CID',$gid)
            ->latest('visit_date')
            ->value('visit_date');

            $labviralload = Viralload::where('CID','=',$gid)
            ->latest('created_at')
            ->value('created_at');

            $labs_visitDate = [$hiv,$hebc,$rpr,$urine,$labsti,$loboi,$labgeneral,$labstool,$labafb,$labcovid,$labviralload];
            $found= false;
            foreach($labs_visitDate as $value) {
              if($value==$labTestDate){
                $found=true;
                break;
              }
            }
            if($labTestDate=="preTest"||$found||$labTestDate=="postTest"){
              if($found){
                $hiv_res=$rpr_value=$hbc_res=$urine_res=$sti_lab_res=$general_res=$stool_res=$covid_res=$Vir_res= $afb_res=0;
                if($labTestDate==$urine){
                  $urine_res=Urine::where('CID','=',$gid)->where('visitDate',$urine)->latest()->limit(1)
                  ->update([
                  'Main Risk' => $main_risk,
                  'Sub Risk'  => $sub_risk,
                  'updated_by' => $request->updated_by,
                ]);
                }
                if($labTestDate==$labsti){
                  $sti_lab_res=Labstitest::where('CID','=',$gid)->where('visit_date',$labsti)->latest()->limit(1)
                  ->update([
                    'Type Of Patient' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);

                }
                if($labTestDate==$loboi){
                 $oi_Lab= Lab_oi::where('CID','=',$gid)->where('visit_date',$loboi)->latest()->limit(1)
                  ->update([
                    'Main Risk' => $main_risk,
                    'Sub Risk'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }

                if($labTestDate==$labgeneral){
                  $general_res=LabGeneralTest::where('CID','=',$gid)->where('Visit_date',$labgeneral)->latest()->limit(1)
                  ->update([
                    'Patient_Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }
                if($labTestDate==$labafb){
                  $afb_res=LabAfbTest::where('CID','=',$gid)->where('visit_date',$labafb)->latest()->limit(1)
                  ->update([
                    'Patient Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }


                if($labTestDate==$labstool){
                  $stool_res=LabStoolTest::where('CID','=',$gid)->where('visit_date',$labstool)->latest()->limit(1)
                  ->update([
                    'Patient Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }

                if($labTestDate==$labcovid){
                  $covid_res= LabCovidTest::where('CID','=',$gid)->where('visit_date',$labcovid)->latest()->limit(1)
                  ->update([
                    'Patient Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }
                if($labTestDate==$labviralload){
                  $Vir_res=Viralload::where('CID','=',$gid)->where('created_at',$labviralload)->latest()->limit(1)
                  ->update([
                    'Main-Risk' => $main_risk,
                    'Sub-Risk'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }

                if($labTestDate==$hiv){
                  $hiv_res=Lab::where('CID','=',$gid)->where('Visit_date','=',$hiv)->latest()->limit(1)
                  ->update([
                    'Patient_Type' => $main_risk,
                    'Patient Type Sub'  => $sub_risk,
                    'updated_by' => $request->updated_by,
                  ]);
                }

                if($labTestDate==$rpr){
                  $rpr_value= Rprtest::where('pid','=',$gid)->where('visit_date','=',$rpr)->latest()->limit(1)
                  ->update([
                  'Type Of Patient' => $main_risk,
                  'Patient Type Sub'  => $sub_risk,
                  'updated_by' => $request->updated_by,
                ]);
                }

                if($labTestDate==$hebc){
                  $hbc_res=LabHbcTest::where('CID','=',$gid)->where('Visit_date','=',$hebc)->latest()->limit(1)
                  ->update([
                  'Patient_Type' => $main_risk,
                  'Patient Type Sub'  => $sub_risk,
                  'updated_by' => $request->updated_by,
                ]);
                }

                $lab_updated_fine="no";

                  $labs_updated = [ $hiv_res, $rpr_value, $hbc_res ,$urine_res, $oi_Lab, $sti_lab_res , $afb_res, $general_res, $stool_res, $covid_res, $Vir_res ];
                    $updated_res= 0;

                    foreach($labs_updated as $updated_res) {
                      if($updated_res==1){
                        $lab_updated_fine="yes";
                        break;
                      }

                    }

                    if($lab_updated_fine=="yes"){

                        if ($edit==1) {
                          Patients::where('Pid',$gid)
                          ->update([
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'Date of Birth'=>$calDob,
                          'updated_by' => $request->updated_by,
                        ]);
                        PtConfig::where('Pid',$gid)
                        ->update([
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'Date of Birth'=>$calDob,
                          'updated_by' => $request->updated_by,

                        ]);
                        }
                        Followup_general::where('Pid',$gid)->latest('Visit Date')
                        ->update([
                          'Main Risk'=>$main_risk,
                          'Sub Risk'=>$sub_risk,
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'updated_by' => $request->updated_by,
                        ]);

                        Patients::where('Pid',$gid)
                        ->update([
                          'Main Risk'=>$main_risk,
                          'Sub Risk'=>$sub_risk,
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'Date of Birth'=>$calDob,
                          'updated_by' => $request->updated_by,
                        ]);
                        PtConfig::where('Pid',$gid)
                        ->update([
                          'Region'    => $region,
                          'Township'  => $township,
                          'Quarter'   => $quarter,
                          'Phone'     => $phone,
                          'Phone2'    => $phone2,
                          'Phone3'    => $phone3,
                          'Main Risk' => $main_risk,
                          'Sub Risk'  => $sub_risk,
                          'Agey'=>$request->Agey,
                          'Agem'=>$request->Agem,
                          'Date of Birth'=>$calDob,
                          'updated_by' => $request->updated_by,
                        ]);

                        CounsellorRecords ::create([
                        "Clinic Code" => $request -> clinic_code ,
                        "Pid" => $request -> Pid,
                        "FuchiaID" => $request -> FuchiaID ,
                        "PrEPCode" => $request -> PrEPCode,
                        "Gender" => $request -> Gender,
                        "Agey" => $request -> Agey,
                        "Agem" => $request -> Agem,

                        "Counselling_Date" => $request -> Counselling_Date,
                        "Counsellor" => $counsellor,
                        "Main Risk" => $main_risk,
                        "Sub Risk" => $sub_risk,

                        "Pre" => $request -> Pre,
                        "Post" => $request -> Post,
                        "HTSdone" => $HTSdone,
                        "Reason" => $Reason,
                        "Status" => $Status,
                        "PrEP" => $request -> PrEP ,
                        "PrEP Status" => $PrEP_Status,
                        "C1" => $request -> c1,
                        "C2" => $request -> c2,
                        "C3" => $request -> c3,
                        "ADH" => $request -> adh,
                        "Child under15 Adoles" => $request -> Child_under15_Adoles,
                        "Child under15 Dis" => $request -> Child_under15_Dis,
                        "Child under15 ADH" => $request -> Child_under15_ADH,
                        "MMT" => $request -> mmt,
                        "IPT" => $request -> ipt,
                        "TB" => $request -> tb,
                        "NCD" => $request -> ncd,
                        "ANC" => $request -> anc,
                        "PFA" => $request -> pfa,
                        "PHQ9" => $request -> phq9,
                        "Other" => $request -> Other,
                        "EAC" => $request -> eac,
                        "HMT" => $request -> hmt,
                        "C P case" => $request -> c_p_case,
                        "PMTCT" => $request -> pmtct,
                        'created_by' => $request->updated_by,
                      ]);
                      $success=$labs_updated;  // Updated Risk With Lab Risk Data

                     }else{
                      $success=1.2; // Lab Test Date is not Final Testing Date
                     }





              }else{
                if ($edit==1) {
                  Patients::where('Pid',$gid)
                  ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                ]);
                PtConfig::where('Pid',$gid)
                ->update([
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                ]);
                }
                Followup_general::where('Pid',$gid)->latest('Visit Date')
                ->update([
                  'Main Risk'=>$main_risk,
                  'Sub Risk'=>$sub_risk,
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'updated_by' => $request->updated_by,
                ]);

                Patients::where('Pid',$gid)
                ->update([
                  'Main Risk'=>$main_risk,
                  'Sub Risk'=>$sub_risk,
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                ]);
                PtConfig::where('Pid',$gid)
                ->update([
                  'Region'    => $region,
                  'Township'  => $township,
                  'Quarter'   => $quarter,
                  'Phone'     => $phone,
                  'Phone2'    => $phone2,
                  'Phone3'    => $phone3,
                  'Main Risk' => $main_risk,
                  'Sub Risk'  => $sub_risk,
                  'Agey'=>$request->Agey,
                  'Agem'=>$request->Agem,
                  'Date of Birth'=>$calDob,
                  'updated_by' => $request->updated_by,
                ]);

                CounsellorRecords ::where('Pid',$gid)->where('Counselling_Date',$cdate)->update([
                "Clinic Code" => $request -> clinic_code ,
                "Pid" => $request -> Pid,
                "FuchiaID" => $request -> FuchiaID ,
                "PrEPCode" => $request -> PrEPCode,
                "Gender" => $request -> Gender,
                "Agey" => $request -> Agey,
                "Agem" => $request -> Agem,

                "Counselling_Date" => $request -> Counselling_Date,
                "Counsellor" => $counsellor,
                "Main Risk" => $main_risk,
                "Sub Risk" => $sub_risk,

                "Pre" => $request -> Pre,
                "Post" => $request -> Post,
                "HTSdone" => $HTSdone,
                "Reason" => $Reason,
                "Status" => $Status,
                "PrEP" => $request -> PrEP ,
                "PrEP Status" => $PrEP_Status,
                "C1" => $request -> c1,
                "C2" => $request -> c2,
                "C3" => $request -> c3,
                "ADH" => $request -> adh,
                "Child under15 Adoles" => $request -> Child_under15_Adoles,
                "Child under15 Dis" => $request -> Child_under15_Dis,
                "Child under15 ADH" => $request -> Child_under15_ADH,
                "MMT" => $request -> mmt,
                "IPT" => $request -> ipt,
                "TB" => $request -> tb,
                "NCD" => $request -> ncd,
                "ANC" => $request -> anc,
                "PFA" => $request -> pfa,
                "PHQ9" => $request -> phq9,
                "Other" => $request -> Other,
                "EAC" => $request -> eac,
                "HMT" => $request -> hmt,
                "C P case" => $request -> c_p_case,
                "PMTCT" => $request -> pmtct,

                'updated_by' => $request->updated_by,
               ]);
               $success = 1.5; // This Patient is second Time in counselling
              }
            }else {
              $success = 1.1; // has follow_up but wrong Lab test data

            }


          }
        }else {
          $success=2;
        }


        return response()->json([
          $success
        ]);


      }

  }
  public function export_starter(Request $data){

     $from = $data->input('dateFrom');
     $date_from = DateTime::createFromFormat('d-m-Y', $from);
     $from = $date_from->format('Y-m-d');

     $to = $data->input('dateTo');
     $date_to = DateTime::createFromFormat('d-m-Y', $to);
     $to = $date_to->format('Y-m-d');

     $hts_coul = $data->input('hts_coul');

     if($hts_coul == "counsel_data"){
       $users = CounsellorRecords::
       query()
       ->select(
         

         "Gender",
               "Counsellor",
               "Main Risk",
               "Sub Risk",
               "HTSdone",
               "Reason",
               "Status",
               "PrEP Status",
         )

         ->whereBetween('Counselling_Date', [$from,$to])
         ->get();

         $users1= CounsellorRecords::
         query()
             ->select(
              "Clinic Code",
              'Pid',
              "FuchiaID",
              "PrEPCode",
              "Agey",
              "Agem",
              "Counselling_Date",
              "C1",
              "C2",
              "C3",
              "ADH",
              "Child under15 Adoles",
              "Child under15 Dis",
              "Child under15 ADH",
              "MMT",
              "IPT",
              "TB",
              "NCD",
              "ANC",
              "PFA",
              "PHQ9",
              "Other",
              "EAC",
              "HMT",
              "C P case",
              "PMTCT",
              "PrEP",
              "Pre",
              "Post",
               )

           ->whereBetween('Counselling_Date', [$from, $to])
           ->get();
         return Excel::download(new CounsellingExport($users,$users1,$hts_coul), 'Counselling_data.xlsx');
     }
     else if($hts_coul == "hts_data"){
       $users = Coulselling::
       query()
       ->select(
         "Gender",
         "Counsellor",
         "Pre",
         "Post",
         "Service_Modality",
         "Mode of Entry",
         'New_Old',
         "Test_Location",
         "Main Risk",
         'Sub Risk',
         'HIV_Test_Determine',
         'HIV_Test_UNI',
         'HIV_Test_STAT',
         'HIV_Final_Result',
         'Syphillis_RDT',
         'Syphillis_RPR',
         'Syphillis_VDRL',
         'Hepatitis_B',
         'Hepatitis_C',
         )

         ->whereBetween('Counselling_Date', [$from,$to])
         ->get();

         $users1= Coulselling::
         query()
             ->select(


               'Clinic code',
               'Pid',
               "FuchiaID",
               "Age",
               "Counselling_Date",
               'HIV_Test_Date',
               'Hep_Test_Date',
               'Syp_Test_Date',
               )

           ->whereBetween('Counselling_Date', [$from, $to])
           ->get();

         return Excel::download(new CounsellingExport($users,$users1,$hts_coul), 'HTS_data.xlsx');




     }



  }
}
