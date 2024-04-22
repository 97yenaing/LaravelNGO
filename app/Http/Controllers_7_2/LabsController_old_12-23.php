<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\PtConfig;
use App\Models\Followup_general;
use App\Models\Lab;
use App\Models\LabHbcTest;
use App\Models\Urine;
use App\Models\NcdAnual;
use App\Models\Rprtest;
use App\Models\Labstitest;
use App\Models\Lab_oi;
use App\Models\LabGeneralTest;
use App\Models\LabStoolTest;
use App\Models\LabAfbTest;
use App\Models\LabCovidTest;
use App\Models\Applog;

use Illuminate\Support\Facades\Crypt;

class LabsController extends Controller
{
  public function results(){
    $results = Rprtest::latest()->paginate(50);
    return view (
      'Labs.results',['results' => $results
    ]);
  }
  public function labs_view(){
      return view('Labs.labs');
      }
  public function lab_urine_records(){
      $hiv = Lab::latest()->paginate(20);
      return view (
        'Labs.UrineRecords',['hiv' => $hiv
      ]);
    }
  public function labResponse(Request $request){
        $hiv=0;$updateID=0;
         $cid       = $request  ->input('cid');
         $vdate     = $request  ->input('vDate');
         $checkPatient= $request->input('checkPatient');
         $hiv       = $request  ->input('hiv');//2
         $hiv_update = $request ->input('hiv_update');//
         $urineTest = $request  ->input('urineTest');//1
         $rprTest   = $request  ->input('rprTest');//1
         $stiTest   = $request  ->input('stiTest');//1
         $hbcTest   = $request  ->input('hbc');
         $oiTest    = $request  ->input('oiTest');
         $gtTest    = $request  ->input('gtTest');
         $stTest    = $request  ->input('stTest');
         $afbTest   = $request  ->input('afbTest');
         $covidTest = $request  ->input('covidTest');
         $id_hist  = $request  ->input('id_hist');
         $signal = $request -> input('signal');
         $updateID = $request -> input('update_rowNo');

         // Finding data from the databases
         if($checkPatient== 1){ //to check the patient is in general patients list
             $patientData = PtConfig::where('Pid',$cid)->first();
             $rprResult = Rprtest::where('pid',$cid)->latest()->first();

             $ptNameDecrypt = $patientData["Name"];
             $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);
             return response()->json([
               $patientData,$rprResult,$ptNameDecrypt
             ]);
             $checkPatient =0;
         }
         if($signal==1){
           $data =Lab::where('CID',$id_hist)->get();
           $data1 =Rprtest::where('pid',$id_hist)->get();
           $data2 =Labstitest::where('CID',$id_hist)->get();
           $data3 =LabHbcTest::where('CID',$id_hist)->get();
           $data4 =Urine::where('CID',$id_hist)->get();
           $data5 =Lab_oi::where('CID',$id_hist)->get();
           $data6 =LabGeneralTest::where('CID',$id_hist)->get();
           $data7 =LabStoolTest::where('CID',$id_hist)->get();
           $data8 =LabAfbTest::where('CID',$id_hist)->get();
           $data9 =LabCovidTest::where('CID',$id_hist)->get();


           return response()->json([
             $data,
             $data1,
             $data2,
             $data3,
             $data4,
             $data5,
             $data6,
             $data7,
             $data8,
             $data9,

           ]);
         }


         //Create Section
         if($covidTest==1 && $updateID<1){
           LabCovidTest::create([
             'CID'                  => $request -> cid ,
             'fuchiacode'           => $request -> fuchiaID  ,
             'agey'                 => $request -> agey ,
             'agem'                 => $request -> agem ,
             'Gender'               => $request -> gender ,
             'Requested Doctor'     => $request -> reqDoctor ,
             'visit_date'           => $request -> vDate  ,
             'Patient Type'         => $request -> Ptype,
             'Patient Type Sub'     => $request -> ext_sub,
             'Clinic'               => $request -> clinic,

             'co_Age'               => $request ->co_Age,
             'type_of_patient_covid'=> $request ->type_of_patient_covid,
             'specimen_type'        => $request ->specimen_type,
             'co_test_type'         => $request ->co_test_type,
             'covid_result'         => $request ->covid_result,
             'covid_lab_tech'       => $request ->covid_lab_tech,
             'covid_issue_date'     => $request ->covid_issue_date,

           ]);
           $covidTest=0;
           $success=[["id"=> 1,
           "name" => "Your data has been successfully collected."
           ]];
           return response()->json([$success]);
         }
         if($afbTest==1 && $updateID<1){
           //  $decrypted_string = Crypt::decryptString($encrypted_string); For decryption
           $ptName = $request -> input('afb_pt_name');
              $encrypted_Name = Crypt::encryptString($ptName);
           $ptAddress = $request -> input('afb_pt_address');
              $encrypted_Address= Crypt::encryptString($ptAddress);

           LabAfbTest::create([
             'CID'                  => $request -> cid ,
             'fuchiacode'           => $request -> fuchiaID  ,
             'agey'                 => $request -> agey ,
             'agem'                 => $request -> agem ,
             'Gender'               => $request -> gender ,
             'Requested Doctor'     => $request -> reqDoctor ,
             'visit_date'           => $request -> vDate  ,
             'Patient Type'         => $request -> Ptype,
             'Patient Type Sub'     => $request -> ext_sub,
             'Clinic'               => $request -> clinic,
             'afb_pt_name'          => $encrypted_Name,// Encrypted
             'afb_pt_address'       => $encrypted_Address,// Encrypted
             'Previous_TB'          => $request -> Previous_TB,
             'HIV_status'           => $request -> HIV_status,
             'reason_for_exam'      => $request -> reason_for_exam,
             'afb_Pt_type'          => $request -> afb_Pt_type,
             'follow_up_mt'         => $request -> follow_up_mt,
             'speci_type'           => $request -> speci_type,
             'slide_num_1'          => $request -> slide_num_1,
             //'slide_num_2'          => $request -> slide_num_2,
             'speci_receive_dt1'    => $request -> speci_receive_dt1,
             'speci_receive_dt2'    => $request -> speci_receive_dt2,
             'visual_app_1'         => $request -> visual_app_1,
             'afb_result1'          => $request -> afb_result1,
             'afb_result2'          => $request -> afb_result2,
             'sacnty_grading1'      => $request -> sacnty_grading1,
             'afb_lab_techca'       => $request -> afb_lab_tech,
             'afb_issue_date'       => $request -> afb_issue_date,
           ]);
           $afbTest=0;
           $success=[["id"=> 1,
           "name" => "Your data has been successfully collected."
           ]];
           return response()->json([$success]);
         }
         if($stTest==1 && $updateID<1){
           LabStoolTest::create([
             'CID'                  => $request -> cid ,
             'fuchiacode'           => $request -> fuchiaID  ,
             'agey'                 => $request -> agey ,
             'agem'                 => $request -> agem ,
             'Gender'               => $request -> gender ,
             'Requested Doctor'     => $request -> reqDoctor ,
             'visit_date'           => $request -> vDate  ,
             'Patient Type'         => $request -> Ptype,
             'Patient Type Sub'     => $request -> ext_sub,
             'Clinic'               => $request -> clinic,
             'st_stool'             => $request -> st_stool,
             'st_colour'            => $request -> st_colour,
             'wbc_pus_cell'         => $request -> wbc_pus_cell,
             'st_consistency'       => $request -> st_consistency,
             'st_rbcs'              => $request -> st_rbcs,
             'st_other'             => $request -> st_other,
             'st_comment'           => $request -> st_comment ,
             'st_lab_tech'          => $request -> st_lab_tech,
             'st_issue_date'        => $request -> st_issue_date,
           ]);
           $stTest=0;
           $success=[["id"=> 1,
           "name" => "Your data has been successfully collected."
           ]];
           return response()->json([$success]);
         }
         if($gtTest==1 && $updateID<1){
           LabGeneralTest::create([
             'CID'                  => $request -> cid ,
             'fuchiacode'           => $request -> fuchiaID  ,
             'agey'                 => $request -> agey ,
             'agem'                 => $request -> agem ,
             'Gender'               => $request -> gender ,
             'Requested Doctor old'     => $request -> reqDoctor ,
             'Visit_date'           => $request -> vDate  ,
             'Patient_Type'         => $request -> Ptype,
             'Patient Type Sub'     => $request -> ext_sub,
             'clinic code'               => $request -> clinic,

             'Dangue RDT'           => $request ->dangue_rdt   ,
             'NS1 Antigen'          => $request ->NS1_antigen   ,
             'IgG Result'           => $request ->igG   ,
             'IgM Result'           => $request ->igm   ,
             'Malaria RDT Result'   => $request ->dangue_rdt_result  ,
             'malaria_microscopy'   => $request ->malaria_done   ,
             'Malaria Microscopy Result'        => $request ->malaria_microscopy_result   ,
             'RBS'                  => $request ->rbs_result   ,
             'FBS'                  => $request ->fbs_result   ,
             'haemoglobin'          => $request ->haemoPercent   ,
             'hba1c'                => $request ->hba1c   ,
             //'visitID'              => $request ->   ,
             "Lab Tech"             => $request ->gt_lab_tech    ,
             "Issue Date"           => $request ->gt_issue_date   ,
             //"ClinicName"           => $request ->   ,
             
           ]);
           $gtTest=0;
           $success=[["id"=> 1,
           "name" => "Your data has been successfully collected."
           ]];
           return response()->json([$success]);
         }
         if($oiTest==1 && $updateID<1){
           Lab_oi::create([
             'CID'                  => $request -> cid ,
             'fuchiacode'           => $request -> fuchiaID  ,
             'agey'                 => $request -> agey ,
             'agem'                 => $request -> agem ,
             'Gender'               => $request -> gender ,
             'Requested Doctor'     => $request -> reqDoctor ,
             'visit_date'           => $request -> vDate  ,
             //'Patient Type'         => $request -> Ptype,
             //'Patient Type Sub'     => $request -> ext_sub,
             'clinic code'               => $request -> clinic,

             'TB_LAM_Report'        => $request -> tb_lam_report ,
             'Serum Result'         => $request -> serum_cry_antigen ,
             'serum_pos'            => $request -> serum_cry_due  ,
             'CSF for Cryptococcal Antigen'=> $request -> csf_cry_antigen ,
             'csf_crypto_pos'       => $request ->csf_due  ,
             'csf_fungal'           => $request -> csf_smear ,
             'CSF Smear Giemsa Stain'=> $request ->giemsa_stain_result  ,
             'CSF Smear India Ink'  => $request ->  india_ink_result ,
             'skin_fungal'          => $request -> skin_smear ,
             'Skin Smear Giemsa Stain'=> $request -> skin_giemsa_stain_result ,
             'lymph India Ink'          => $request ->lymph_india_ink  ,
             'Skin Smear India Ink' => $request ->  skin_india_ink_result ,
             //'sample_type'          => $request -> type_sample ,
             'lymph Giemsa Stain'           => $request ->lymph_giemsa_stain  ,
             'Lab Techanician'      => $request ->oi_lab_tech  ,
             'issued'               => $request ->oi_issue_date  ,
             //'visitID'
           ]);
           $oiTest=0;
           $success=[["id"=> 1,
           "name" => "Your data has been successfully collected."
           ]];
           return response()->json([$success]);
         }
         if($stiTest==1 && $updateID<1){
           Labstitest::create([
           'CID'=>$request->cid,
           'fuchiacode'=>$request->fuchiaID,
           'agey'=>$request->agey  ,
           'agem'=>$request->agem  ,
           'Gender'=>$request->gender  ,
           'Requested Doctor'=>$request->reqDoctor ,
           'visit_date'=>$request->vDate,
           'Type Of Patient'=>$request->Ptype  ,
           'Patient Type Sub'=>$request->ext_sub  ,

           'Wet Mount clue cell'=>$request->clue_cells,
           'Wet Mount Trichomonas'=>$request->tricho_wet,
           'Wet Mount candida'=>$request->candida_wet  ,
           'wetoth'=>$request->Sper_other_wet,
           //'urethra WBC'=>$request->pmnl_urethra  ,
           'Urethra diplococci intra-cell'=>$request->gram_intra_urethra,
           'Urethra diplococci extra-cell'=>$request->gram_extra_urethra,
           'Urethra Candida'=>$request->candida_urethra  ,
           'uoth'=>$request->Sper_other_urethra  ,
           'Fornix Clue Cells'=>$request->clue_post_fornix  ,
           'Fornix WBC'=>$request->fornix_wbc ,
           'Fornix diplococci intra-cell'=>$request->gram_intra_postfornix,
           'Fornix diplococci extra-cell'=>$request->gram_extra_postfornix,
           'Fornix Candida'=>$request->candida_postfornix  ,
           'pfother'=>$request->Sper_other_post,
           'Endo cervix WBC'=>$request->pmnl_endocevix  ,
           'Endo cervix diplococci intra-cell'=>$request->gram_intra_endo,
           'Endo cervix diplococci extra-cell'=>$request->gram_extra_endo,
           //'Endo cervix Candida'=>$request->  ,
           'eother'=>$request->Sper_other_endo,
           'Rectum WBC'=>$request->pmnl_rectum  ,
           'Rectum diplococci intra-cell'=>$request->gram_intra_rectum  ,
           'Rectum diplococci extra-cell'=>$request->gram_extra_rectum  ,
           'rother'=>$request->Sper_other_rectum,
           'First Per Urine'=>$request->urine_exam_done,
           'Epithelial cells'=>$request->epithelial_cell,
           //'PMNL cells'=>$request->  ,
           //'First Per Urine Diplococci Intra-Cell'=>$request->  ,
           //'First Per Urine Diplococci Extra-Cell'=>$request->  ,
           //'fpu_oth'=>$request->  ,
           'Lab Techanician'=>$request->sti_lab_tech,
           'idate'=>$request->sti_issuDate,
           //'visitID'=>$request->vDate,
           'Clue cells result'=>$request->clue_cell_result,
           'PMNL result'=>$request->pmnl_cell,
           'trichomonas result'=>$request->tricho_result,
           'diplococci intra cell result'=>$request->intra_cell,
           'diplococci extra cell result'=>$request->extra_cell,
           //'spermatozoites result'=>$request->  ,
           'candida result'=>$request->candida_result,
          ]);
            $stiTest=0;
            $success=[["id"=> 1,
            "name" => "Your data has been successfully collected."
            ]];
            return response()->json([$success]);
         }
         if($rprTest==1 && $updateID<1){// to collect rpr test results
          // $ptInfo =Patients::where('Pid',$cid)->first();
          // $divideExt = $request->rprext;
          // if($divideExt=="pp" || $divideExt ="mp"){
          //   $ext ='Pregnant Mother Sub';
          // }
          // if($divideExt=="hiv_pos" || $divideExt ="hiv_neg"){
          //   $ext ='Spouse of Pregnant Mother Sub';
          // }
          // if($divideExt=="fswpwid" || $divideExt ="fswpwud"){
          //   $ext ='FSW Sub';
          //}
          // if($divideExt=="msmpwid" || $divideExt ="msmpwud"){
          //   $ext ='MSM Sub';
          // }
          //if($divideExt=="pwidfsw"|| $divideExt ="pwidmsm"){
          //   $ext ='IDU Sub';
          //}
          //if($divideExt=="tgpwid" || $divideExt ="tgpwud"){
          //   $ext ='TG Sub';
          // }
          // if($divideExt=="ec-1" || $divideExt ="ec-2" || $divideExt=="ec-3" || $divideExt ="ec-4"){
          //   $ext ='Exposed children sub';
          // }
           Rprtest::create([
             'pid'=>$request->cid,
             'visit_date'=>$request->vDate,
             'fuchiacode'=> $request->fuchiaID,
             'agey'=>$request->agey,
             'agem'=>$request->agem,
             'Gender'=>$request->gender,

             'RPR Qualitative'=>$request->qualitative,
             'Type Of Patient'=>$request->Ptype,
             'Patient Type Sub'=>$request->Ptype_ext,
             //'Pregnant Mother Sub'=>$request->rpr_sub,
             //$ext => $request -> rprext,
             'Patient Type New'=>$request->rprPtype,
             'RDT(Yes/No)' => $request->rdtYes_no,
             'RDT Result' => $request->Sy_rdt_result,
             'RPR Qualitative'=>$request->qualitative,

             'Titre(current)'=>$request->titreCur,
             'Titre(Last)'=>$request->titreLast
           ]);
           $rprTest=0;
           $success=[["id"=> 1,
           "name" => "Your data has been successfully collected."
           ]];
           return response()->json([$success]);

         }
         if($hiv==2 && $updateID<1){
           if($hiv && $cid){
             Lab::create([
                   'ClinicName' => $request->clinic,
                   'CID'=>$request->cid ,
                   'fuchiacode'=>$request->fuchiaID ,
                   'agey'=>$request->agey ,
                   'agem'=>$request->agem ,
                   'Gender'=>$request->gender ,
                   'Patient_Type'=>$request->Ptype,
                   'Patient Type Sub'=>$request->ext_sub,
                   //'Pregnant_Mother_Sub'=>$request->PregMother,
                   //'Spouse_of_Pregnant_Mother_Sub'=>$request->spouseMother ,
                  // 'Partner of KP sub'=>$request->ext ,
                   //'FSW Sub'=>$request->ext ,
                //   'MSM Sub'=>$request->ext ,
                  // 'TG Sub'=>$request->ext ,
                  // 'IDU Sub'=>$request->ext ,
                  // 'Low Risk Sub'=>$request->ext ,
                  //'Special Group Sub'=>$request->ext ,
                   'Visit_date'=>$request->vDate ,
                   'bcollectdate'=>$request->bcdate,
                   'Detmine_Result'=>$request->d_result,
                   'Unigold_Result'=>$request->uni_result ,
                   'STAT_PAK_Result'=>$request->stat_result ,
                   'Final_Result'=>$request->final_result
                   ]);
                   Patients::where('Pid',$cid)
                   ->update([
                     'Main Risk'=>$request->Ptype,
                     'Sub Risk'=>$request->ext_sub
                   ]);
                   Followup_general::where('Pid',$cid)
                   ->update([
                     'Main Risk'=>$request->Ptype,
                     'Sub Risk'=>$request->ext_sub
                   ]);
                   PtConfig::where('Pid',$cid)
                   ->update([
                     'Main Risk'=>$request->Ptype,
                     'Sub Risk'=>$request->ext_sub
                   ]);


                   $hiv=0;
                   $success=[[ 	"id"   => 1,
                   "name" => "Your data has been successfully collected." ]];
                   return response()->json([$success]);

                 }
               }
         if($urineTest==1 && $updateID<1){
           //if($sd && $cid){
              // if former data has / have to check and then UPDATE
              // NcdAnual::create([
                // 'pid'=>$request->cid,
                // 'Visit_date'=>$request->visitDate,
              //   'Urine_Protein'=> $request->protein,
                // 'U_glucose'=> $request->glucose
              //   ]);
               Urine::create([
                 'ClinicName'  => $request->clinic,
                 'CID'         =>$request->cid ,
                 'visitDate'   =>$request->vDate,
                 'fuchiacode'  =>$request->fuchiaID ,
                 'agey'        =>$request->agey ,
                 'agem'        =>$request->agem ,
                 'Gender'      =>$request->gender,

                 'Utest_done'  => $request->utest,
                 'Utot'        => $request->typeoftest,
                 'Ucolor'      => $request->color,
                 'Uapp'        => $request->appear,
                 'Upus'        => $request->pus,

                 'ph'          => $request->uph,
                 'Uprotein'    => $request->protein,
                 'Uglucose'    => $request->glucose,
                 'Urbc'        => $request->rbc,
                 'Uleu'        => $request->leu,

                 'Unitrite'    => $request->nitrite,
                 'Uketone'    => $request->ketone,
                 'Uepithelial' => $request->epithelial,
                 'Urobili'     => $request->robili,
                 'Ubillru'     => $request->billru,

                 'Uery'        => $request->ery,
                 'Ucrystal'    => $request->crystal,
                 'Uhae'        => $request->hae,
                 'Uother'      => $request->other,
                 'Ucast'       => $request->cast,
                 'comment'     => $request->Ument,
                 'lab_tech'    => $request->lab_tech,
                 'issue_date'  => $request->issue_date
             ]);
                 // response to blade
                 $dataSuccess=[[ 	"id"   => 1,
                 "name" => "Successfully Save the patient's data." ]];
                 return response()->json([$dataSuccess]);
             }
         if($hbcTest==1 && $updateID<1){
           LabHbcTest::create([
             'CID'=>$request->cid ,
             'fuchiacode'=>$request->fuchiaID ,
             'agey'=>$request->agey ,
             'agem'=>$request->agem ,
             'Gender'=>$request->gender ,
             'Visit_date'=>$request->vDate ,
             'Requested Doctor old'=>$request->reqDoctor ,
             //'requested Doctor new'=>$request-> ,
             'tdate'=>$request->bcdate,
             'Patient_Type'=>$request->Ptype ,
             'Patient Type Sub'=>$request->ext_sub ,
             //'Hiv status'=>$request-> ,
             'HepB Test'=>$request->hepB ,
             'HepB TOT'=>$request->totB ,
             'HepB Result'=>$request->b_result ,
             'HepC Test'=>$request->c_test ,
             'HepC TOT'=>$request->totC ,
             'HepC Result'=>$request->c_result ,
             'Lab Tech'=>$request->c_lab_tech ,
             'Issue Date'=>$request->c_issueDate,
             //'Visit ID'=>$request-> ,
             'clinic code'=>$request->clinic ,
           ]);
           $hbc=0;
           $success=[[ 	"id"   => 1,
           "name" => "Your data has been successfully collected." ]];
           return response()->json([$success]);
         }

         // Update Section
         if($hiv_update==3 && $updateID>0){

            Lab::where('id',$updateID)
                ->update([
                   'ClinicName' => $request->clinic,
                   'CID'=>$request->cid ,
                   'fuchiacode'=>$request->fuchiaID ,
                   'agey'=>$request->agey ,
                   'agem'=>$request->agem ,
                   'Gender'=>$request->gender ,
                   'Patient_Type'=>$request->Ptype,
                   'Patient Type Sub'=>$request->ext_sub,

                   'Visit_date'=>$request->vDate ,
                   'bcollectdate'=>$request->bcdate,
                   'Detmine_Result'=>$request->d_result,
                   'Unigold_Result'=>$request->uni_result ,
                   'STAT_PAK_Result'=>$request->stat_result ,
                   'Final_Result'=>$request->final_result
                   ]);
                   Patients::where('Pid',$cid)
                   ->update([
                     'Main Risk'=>$request->Ptype,
                     'Sub Risk'=>$request->ext_sub
                   ]);
                   Followup_general::where('Pid',$cid)
                   ->update([
                     'Main Risk'=>$request->Ptype,
                     'Sub Risk'=>$request->ext_sub
                   ]);
                   PtConfig::where('Pid',$cid)
                   ->update([
                     'Main Risk'=>$request->Ptype,
                     'Sub Risk'=>$request->ext_sub
                   ]);
                   Applog::create([
                     'User'=> $request->appUser,
                     'Pid'=> $request->cid ,
                     'tableName'=>"Lab-HIV-Test",
                     'Org_info'=> $request->org_info ,
                     'Updated_info'   => $request ->updated_info ,
                   ]);


                   $hiv=0;
                   $success=[[ 	"id"   => 1,
                   "name" => "updated" ]];
                   return response()->json([$success]);
         }
         if($rprTest==2 && $updateID>0){// to collect rpr test results
          // $ptInfo =Patients::where('Pid',$cid)->first();
          // $divideExt = $request->rprext;
          // if($divideExt=="pp" || $divideExt ="mp"){
          //   $ext ='Pregnant Mother Sub';
          // }
          // if($divideExt=="hiv_pos" || $divideExt ="hiv_neg"){
          //   $ext ='Spouse of Pregnant Mother Sub';
          // }
          // if($divideExt=="fswpwid" || $divideExt ="fswpwud"){
          //   $ext ='FSW Sub';
          //}
          // if($divideExt=="msmpwid" || $divideExt ="msmpwud"){
          //   $ext ='MSM Sub';
          // }
          //if($divideExt=="pwidfsw"|| $divideExt ="pwidmsm"){
          //   $ext ='IDU Sub';
          //}
          //if($divideExt=="tgpwid" || $divideExt ="tgpwud"){
          //   $ext ='TG Sub';
          // }
          // if($divideExt=="ec-1" || $divideExt ="ec-2" || $divideExt=="ec-3" || $divideExt ="ec-4"){
          //   $ext ='Exposed children sub';
          // }
           Rprtest::where('id',$updateID)
           ->update([
             'pid'=>$request->cid,
             'visit_date'=>$request->vDate,
             'fuchiacode'=> $request->fuchiaID,
             'agey'=>$request->agey,
             'agem'=>$request->agem,
             'Gender'=>$request->gender,

             'RPR Qualitative'=>$request->qualitative,
             'Type Of Patient'=>$request->Ptype,
             'Patient Type Sub'=>$request->Ptype_ext,
             //'Pregnant Mother Sub'=>$request->rpr_sub,
             //$ext => $request -> rprext,
             //'Patient Type New'=>$request->rprPtype,
             'RDT(Yes/No)' => $request->rdtYes_no,
             'RDT Result' => $request->Sy_rdt_result,
             'RPR Qualitative'=>$request->qualitative,

             'Titre(current)'=>$request->titreCur,
             'Titre(Last)'=>$request->titreLast
           ]);
           Applog::create([
             'User'=> $request->appUser,
             'Pid'=> $request->cid ,
             'tableName'=>"Lab-RPR-Test",
             'Org_info'=> $request->org_info ,
             'Updated_info'   => $request ->updated_info ,
           ]);

           $rprTest=0;
           $success=[["id"=> 1,
           "name" => "updated"
           ]];
           return response()->json([$success]);

         }
         if($stiTest==2 && $updateID>0){
           Labstitest::where('id',$updateID)
           ->update([
           'CID'=>$request->cid,
           'fuchiacode'=>$request->fuchiaID,
           'agey'=>$request->agey  ,
           'agem'=>$request->agem  ,
           'Gender'=>$request->gender  ,
           'Requested Doctor'=>$request->reqDoctor ,
           'visit_date'=>$request->vDate,
           'Type Of Patient'=>$request->Ptype  ,
           'Patient Type Sub'=>$request->ext_sub  ,

           'Wet Mount clue cell'=>$request->clue_cells,
           'Wet Mount Trichomonas'=>$request->tricho_wet,
           'Wet Mount candida'=>$request->candida_wet  ,
           'wetoth'=>$request->Sper_other_wet,
           //'urethra WBC'=>$request->  ,
           'Urethra diplococci intra-cell'=>$request->gram_intra_urethra,
           'Urethra diplococci extra-cell'=>$request->gram_extra_urethra,
           'Urethra Candida'=>$request->candida_urethra  ,
           'uoth'=>$request->Sper_other_urethra  ,
           'Fornix Clue Cells'=>$request->clue_post_fornix  ,
           //'PMNL WBC'=>$request->  ,
           'Fornix diplococci intra-cell'=>$request->gram_intra_postfornix,
           'Fornix diplococci extra-cell'=>$request->gram_extra_postfornix,
           'Fornix Candida'=>$request->candida_postfornix  ,
           'pfother'=>$request->Sper_other_post,
           //'Endo cervix WBC'=>$request->  ,
           'Endo cervix diplococci intra-cell'=>$request->gram_intra_endo,
           'Endo cervix diplococci extra-cell'=>$request->gram_extra_endo,
           //'Endo cervix Candida'=>$request->  ,
           'eother'=>$request->Sper_other_endo,
           //'Rectum WBC'=>$request->  ,
           'Rectum diplococci intra-cell'=>$request->gram_intra_rectum  ,
           'Rectum diplococci extra-cell'=>$request->gram_extra_rectum  ,
           'rother'=>$request->Sper_other_rectum,
           'First Per Urine'=>$request->urine_exam_done,
           'Epithelial cells'=>$request->epithelial_cell,
           //'PMNL cells'=>$request->  ,
           //'First Per Urine Diplococci Intra-Cell'=>$request->  ,
           //'First Per Urine Diplococci Extra-Cell'=>$request->  ,
           //'fpu_oth'=>$request->  ,
           'Lab Techanician'=>$request->sti_lab_tech,
           'idate'=>$request->sti_issuDate,
           //'visitID'=>$request->vDate,
           'Clue cells result'=>$request->clue_cell_result,
           'PMNL result'=>$request->pmnl_cell,
           'trichomonas result'=>$request->tricho_result,
           'diplococci intra cell result'=>$request->intra_cell,
           'diplococci extra cell result'=>$request->extra_cell,
           //'spermatozoites result'=>$request->  ,
           'candida result'=>$request->candida_result,
          ]);
          Applog::create([
            'User'=> $request->appUser,
            'Pid'=> $request->cid ,
            'tableName'=>"Lab-Hiv-Test",
            'Org_info'=> $request->org_info ,
            'Updated_info'   => $request ->updated_info ,
          ]);
            $stiTest=0;
            $success=[["id"=> 1,
            "name" => "updated"
            ]];
            return response()->json([$success]);
         }
         if($hbcTest==2 && $updateID>0){
           LabHbcTest::where('id',$updateID)
           ->update([
             'CID'=>$request->cid ,
             'fuchiacode'=>$request->fuchiaID ,
             'agey'=>$request->agey ,
             'agem'=>$request->agem ,
             'Gender'=>$request->gender ,
             'Visit_date'=>$request->vDate ,
             //'requested Doctor old'=>$request->reqDoctor ,
             //'$requested Doctor new'=>$request-> ,
             //'tdate'=>$request->bcdate,
             'Patient_Type'=>$request->Ptype ,
             'Patient Type Sub'=>$request->ext_sub ,
             //'Hiv status'=>$request-> ,
             'HepB Test'=>$request->hepB ,
             //'HepB TOT'=>$request->totB ,
             'HepB Result'=>$request->b_result ,
             'HepC Test'=>$request->c_test ,
            // 'HepC TOT'=>$request->totC ,
             'HepC Result'=>$request->c_result ,
             'Lab Tech'=>$request->c_lab_tech ,
             'Issue Date'=>$request->c_issueDate,
             //'Visit ID'=>$request-> ,
             'clinic code'=>$request->clinic ,
           ]);
           Applog::create([
             'User'=> $request->appUser,
             'Pid'=> $request->cid ,
             'tableName'=>"Lab-Hbc-Test",
             'Org_info'=> $request->org_info ,
             'Updated_info'   => $request ->updated_info ,
           ]);
           $hbc=0;
           $success=[["id"=> 1,
           "name" => "updated"
           ]];
           return response()->json([$success]);
         }
         if($urineTest==2 && $updateID>0){
           //if($sd && $cid){
              // if former data has / have to check and then UPDATE
              // NcdAnual::create([
                // 'pid'=>$request->cid,
                // 'Visit_date'=>$request->visitDate,
              //   'Urine_Protein'=> $request->protein,
                // 'U_glucose'=> $request->glucose
              //   ]);
               Urine::where('id',$updateID)
               ->update([
                 'ClinicName'  => $request->clinic,
                 'CID'         =>$request->cid ,
                 'visitDate'   =>$request->vDate,
                 'fuchiacode'  =>$request->fuchiaID ,
                 'agey'        =>$request->agey ,
                 'agem'        =>$request->agem ,
                 'Gender'      =>$request->gender,

                 'Utest_done'  => $request->utest,
                 'Utot'        => $request->typeoftest,
                 'Ucolor'      => $request->color,
                 'Uapp'        => $request->appear,
                 'Upus'        => $request->pus,

                 'ph'          => $request->uph,
                 'Uprotein'    => $request->protein,
                 'Uglucose'    => $request->glucose,
                 'Urbc'        => $request->rbc,
                 'Uleu'        => $request->leu,

                 'Unitrite'    => $request->nitrite,
                 'Uketone'    => $request->ketone,
                 'Uepithelial' => $request->epithelial,
                 'Urobili'     => $request->robili,
                 'Ubillru'     => $request->billru,

                 'Uery'        => $request->ery,
                 'Ucrystal'    => $request->crystal,
                 'Uhae'        => $request->hae,
                 'Uother'      => $request->other,
                 'Ucast'       => $request->cast,
                 'comment'     => $request->Ument,
                 'lab_tech'    => $request->lab_tech,
                 'issue_date'  => $request->issue_date
             ]);
             Applog::create([
               'User'=> $request->appUser,
               'Pid'=> $request->cid ,
               'tableName'=>"Lab-Hiv-Test",
               'Org_info'=> $request->org_info ,
               'Updated_info'   => $request ->updated_info ,
             ]);
             $success=[["id"=> 1,
             "name" => "updated"
             ]];
             return response()->json([$success]);
             }
         if($oiTest==2 && $updateID>0){
               Lab_oi::where('id',$updateID)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'Gender'               => $request -> gender ,
                 'Requested Doctor'     => $request -> reqDoctor ,
                 'visit_date'           => $request -> vDate  ,
                 //'Patient Type'         => $request -> Ptype,
                 //'Patient Type Sub'     => $request -> ext_sub,
                 'clinic code'               => $request -> clinic,

                 'TB_LAM_Report'        => $request -> tb_lam_report ,
                 'Serum Result'         => $request -> serum_cry_antigen ,
                 'serum_pos'            => $request -> serum_cry_due  ,
                 'CSF for Cryptococcal Antigen'=> $request -> csf_cry_antigen ,
                 'csf_crypto_pos'       => $request ->csf_due  ,
                 'csf_fungal'           => $request -> csf_smear ,


                 'CSF Smear Giemsa Stain'=> $request ->giemsa_stain_result  ,
                 'CSF Smear India Ink'  => $request ->  india_ink_result ,
                 'skin_fungal'          => $request -> skin_smear ,
                 'Skin Smear Giemsa Stain'=> $request -> skin_giemsa_stain_result ,
                 'Skin Smear India Ink' => $request ->  skin_india_ink_result ,
                 'sample_type'          => $request -> lymph_test,
                 'lymph Giemsa Stain'           => $request ->lymph_giemsa_stain  ,
                 'lymph India Ink'          => $request -> lymph_india_ink ,

                 'Lab Techanician'      => $request ->oi_lab_tech  ,
                 'issued'               => $request ->oi_issue_date  ,
                 //'visitID'
               ]);
               Applog::create([
                 'User'=> $request->appUser,
                 'Pid'=> $request->cid ,
                 'tableName'=>"Lab-Hiv-Test",
                 'Org_info'=> $request->org_info ,
                 'Updated_info'   => $request ->updated_info ,
               ]);
               $oiTest=0;
               $success=[["id"=> 1,
               "name" => "updated"
               ]];
               return response()->json([$success]);
             }
         if($gtTest==2 && $updateID>0){
               LabGeneralTest::where('id',$updateID)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'Gender'               => $request -> gender ,
                 'Requested Doctor old'     => $request -> reqDoctor ,
                 'Visit_date'           => $request -> vDate  ,
                 'Patient_Type'         => $request -> Ptype,
                 'Patient Type Sub'     => $request -> ext_sub,
                 'clinic code'               => $request -> clinic,

                 'Dangue RDT'           => $request ->dangue_rdt   ,
                 'NS1 Antigen'          => $request ->NS1_antigen   ,
                 'IgG Result'           => $request ->igG   ,
                 'IgM Result'           => $request ->igm   ,
                 'Malaria RDT Result'   => $request ->malaria_rdt_result   ,
                 'malaria_microscopy'   => $request ->malaria_done   ,
                 'Malaria Microscopy Result'        => $request ->malaria_microscopy_result   ,
                 'RBS'                  => $request ->rbs_result   ,
                 'FBS'                  => $request ->fbs_result   ,
                 'haemoglobin'          => $request ->haemoPercent   ,
                 'hba1c'                => $request ->hba1c   ,
                 //'visitID'              => $request ->   ,
                 "Lab Tech"             => $request ->gt_lab_tech    ,
                 "Issue Date"           => $request ->gt_issue_date   ,
                 //"ClinicName"           => $request ->   ,

               ]);
               Applog::create([
                 'User'=> $request->appUser,
                 'Pid'=> $request->cid ,
                 'tableName'=>"Lab-Hiv-Test",
                 'Org_info'=> $request->org_info ,
                 'Updated_info'   => $request ->updated_info ,
               ]);
               $gtTest=0;
               $success=[["id"=> 1,
               "name" => "updated"
               ]];
               return response()->json([$success]);
             }
         if($stTest==2 && $updateID>0){
               LabStoolTest::where('id',$updateID)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'Gender'               => $request -> gender ,
                 'Requested Doctor'     => $request -> reqDoctor ,
                 'visit_date'           => $request -> vDate  ,
                 'Patient Type'         => $request -> Ptype,
                 'Patient Type Sub'     => $request -> ext_sub,
                 'Clinic'               => $request -> clinic,
                 'st_stool'             => $request -> st_stool,
                 'st_colour'            => $request -> st_colour,
                 'wbc_pus_cell'         => $request -> wbc_pus_cell,
                 'st_consistency'       => $request -> st_consistency,
                 'st_rbcs'              => $request -> st_rbcs,
                 'st_other'             => $request -> st_other,
                 'st_comment'           => $request -> st_comment ,
                 'st_lab_tech'          => $request -> st_lab_tech,
                 'st_issue_date'        => $request -> st_issue_date,
               ]);
               Applog::create([
                 'User'=> $request->appUser,
                 'Pid'=> $request->cid ,
                 'tableName'=>"Lab-Hiv-Test",
                 'Org_info'=> $request->org_info ,
                 'Updated_info'   => $request ->updated_info ,
               ]);
               $stTest=0;
               $success=[["id"=> 1,
               "name" => "updated"
               ]];
               return response()->json([$success]);
             }
         if($afbTest==2 && $updateID>0){
               //  $decrypted_string = Crypt::decryptString($encrypted_string); For decryption
               $ptName = $request -> input('afb_pt_name');
                  $encrypted_Name = Crypt::encryptString($ptName);
               $ptAddress = $request -> input('afb_pt_address');
                  $encrypted_Address= Crypt::encryptString($ptAddress);

               LabAfbTest::where('id',$updateID)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'Gender'               => $request -> gender ,
                 'Requested Doctor'     => $request -> reqDoctor ,
                 'visit_date'           => $request -> vDate  ,
                 'Patient Type'         => $request -> Ptype,
                 'Patient Type Sub'     => $request -> ext_sub,
                 'Clinic'               => $request -> clinic,
                 'afb_pt_name'          => $encrypted_Name,// Encrypted
                 'afb_pt_address'       => $encrypted_Address,// Encrypted
                 'Previous_TB'          => $request -> Previous_TB,
                 'HIV_status'           => $request -> HIV_status,
                 'reason_for_exam'      => $request -> reason_for_exam,
                 'afb_Pt_type'          => $request -> afb_Pt_type,
                 'follow_up_mt'         => $request -> follow_up_mt,
                 'speci_type'           => $request -> speci_type,
                 'slide_num_1'          => $request -> slide_num_1,
                 //'slide_num_2'          => $request -> slide_num_2,
                 'speci_receive_dt1'    => $request -> speci_receive_dt1,
                 'speci_receive_dt2'    => $request -> speci_receive_dt2,
                 'visual_app_1'         => $request -> visual_app_1,
                 'afb_result1'          => $request -> afb_result1,
                 'afb_result2'          => $request -> afb_result2,
                 'slide1_grading1'      => $request -> sacnty_grading1,
                 'slide2_grading2'      => $request -> sacnty_grading2,
                 'afb_lab_techca'       => $request -> afb_lab_tech,
                 'afb_issue_date'       => $request -> afb_issue_date,
               ]);
               Applog::create([
                 'User'=> $request->appUser,
                 'Pid'=> $request->cid ,
                 'tableName'=>"Lab-Hiv-Test",
                 'Org_info'=> $request->org_info ,
                 'Updated_info'   => $request ->updated_info ,
               ]);
               $afbTest=0;
               $success=[["id"=> 1,
               "name" => "updated"
               ]];
               return response()->json([$success]);
             }
         if($covidTest==2 && $updateID>0){
               LabCovidTest::where('id',$updateID)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'Gender'               => $request -> gender ,
                 'Requested Doctor'     => $request -> reqDoctor ,
                 'visit_date'           => $request -> vDate  ,
                 'Patient Type'         => $request -> Ptype,
                 'Patient Type Sub'     => $request -> ext_sub,
                 'Clinic'               => $request -> clinic,

                 'co_Age'               => $request ->co_Age,
                 'type_of_patient_covid'=> $request ->type_of_patient_covid,
                 'specimen_type'        => $request ->specimen_type,
                 'co_test_type'         => $request ->co_test_type,
                 'covid_result'         => $request ->covid_result,
                 'covid_lab_tech'       => $request ->covid_lab_tech,
                 'covid_issue_date'     => $request ->covid_issue_date,

               ]);
               Applog::create([
                 'User'=> $request->appUser,
                 'Pid'=> $request->cid ,
                 'tableName'=>"Lab-Covid-Test",
                 'Org_info'=> $request->org_info ,
                 'Updated_info'   => $request ->updated_info ,
               ]);
               $covidTest=0;
               $success=[["id"=> 1,
               "name" => "updated"
               ]];
               return response()->json([$success]);
             }
     }

}
