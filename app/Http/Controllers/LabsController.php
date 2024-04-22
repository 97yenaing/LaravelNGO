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
use App\Models\Viralload;
use App\Models\Applog;
use Maatwebsite\Excel\Facades\Excel;
// Exports
use App\Exports\Lab\LabExport;
use Illuminate\Database\Eloquent\Builder;
use DateTime;
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
      $mam_clinicID=Auth()->user()->clinic;
      switch ($mam_clinicID) {
        case 81:
          $lab_id="C2";
          break;
        case 71:
            $lab_id="A";
          break;
        case 72:
            $lab_id="B";
          break;
      }
      return view('Labs.labs',["Lab_id"=>$lab_id]);
      }
  public function lab_urine_records(){
      
      $hiv = Lab::latest()->paginate(20);
      return view (
        'Labs.UrineRecords',['hiv' => $hiv
      ]);
    }
  public function labResponse(Request $request){

         $hiv=0;$updateID=0;
         $notice=$request["notice"];
         

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
         $viral_loadTest = $request  ->input('viral_loadTest');

         $id_hist  = $request  ->input('id_hist');
         $getAllHistory = $request -> input('getAllHistory');

         $toFill = $request -> input('toFill');// to fill
         $test_name = $request -> input('test_name');// to update
         $drawData = $request -> input('drawData');// to update
         $table="General";

         $updateID_hiv = $request -> input('update_rowNo_hiv');
         $updateID_rpr = $request -> input('update_rowNo_rpr');
         $updateID_sti = $request -> input('update_rowNo_sti');
         $updateID_hbc = $request -> input('update_rowNo_hbc');
         $updateID_urine = $request -> input('update_rowNo_urine');
         $updateID_oi = $request -> input('update_rowNo_oi');
         $updateID_gt = $request -> input('update_rowNo_gt');
         $updateID_st = $request -> input('update_rowNo_st');
         $updateID_afb = $request -> input('update_rowNo_afb');
         $updateID_covid = $request -> input('update_rowNo_covid');
         $updateID_viral = $request -> input('update_rowNo_viralLoad');
         $printYN =$request -> input('printYN');
         $insert_row_exist=Followup_general::where("Visit Date",$vdate)->where("Pid",$cid)->exists();
        
      
               

         $test_type=$request["test_type"];


        
         // Finding data from the databases
         if($checkPatient== 1){ //to check the patient is in general patients list
             $patientData = PtConfig::where('Pid',$cid)->first();
             
            
             if($patientData){
              $rprResult = Rprtest::where('pid',$cid)->latest("vdate")->first();
              if($insert_row_exist||$test_type=="afb_tab"){

                $ptTownship= $patientData["Township"];
                $ptTownship =Crypt::decryptString($ptTownship);
 
                $ptRegion = $patientData["Region"];
                $ptRegion =Crypt::decryptString($ptRegion);
 
                $ptQuarter = $patientData["Quarter"];
                $ptQuarter =Crypt::decryptString($ptQuarter);
 
                $address = $ptQuarter.",".$ptTownship.",".$ptRegion;
 
                $ptNameDecrypt = $patientData["Name"];
                $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);
 
                $ptDOB = $patientData["Date of Birth"];
                $ptDOB =Crypt::decryptString($ptDOB);
 
                $table="General";
 
                $sex =Crypt::decrypt_light($patientData["Gender"],$table);
                $main_risk =Crypt::decrypt_light($patientData["Main Risk"],$table);
                $sub_risk =Crypt::decrypt_light($patientData["Sub Risk"],$table);
 
                if($rprResult){
                  $titre_current =Crypt::decrypt_light($rprResult["Titre(current)"],$table);
                }else{
                 $titre_current="-";
                }
                return response()->json([
                  $patientData,$rprResult,$ptNameDecrypt,$ptDOB,$address,$sex,$main_risk,$sub_risk,$titre_current
                ]);
                $checkPatient =0;
              }else{
                return response()->json([
                 "This Patient don't passed reception"
                ]);
              }
             }else{
              return response()->json([
                "This Patient don't register in Clinic"
              ]);
             }
            


         }
         if($getAllHistory==1){
           $patientData = PtConfig::where('Pid',$id_hist)->first();
           $ptTownship= $patientData["Township"];
           $ptTownship =Crypt::decryptString($ptTownship);
           $ptRegion = $patientData["Region"];
           $ptRegion =Crypt::decryptString($ptRegion);
           $ptQuarter = $patientData["Quarter"];
           $ptQuarter =Crypt::decryptString($ptQuarter);

           $address = $ptQuarter.",".$ptTownship.",".$ptRegion;

           $ptNameDecrypt = $patientData["Name"];
           $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);


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
           $data10=Viralload::where('CID',$id_hist)->get();

            // Combine the results from all tables
            $allResults = $data->merge($data1);
            $allResults = $allResults->merge($data2);
            $allResults = $allResults->merge($data3);
            $allResults = $allResults->merge($data4);
            $allResults = $allResults->merge($data5);
            $allResults = $allResults->merge($data6);
            $allResults = $allResults->merge($data7);
            $allResults = $allResults->merge($data8);
            $allResults = $allResults->merge($data9);
            $allResults = $allResults->merge($data10);

            $groupedResults = $allResults->groupBy('vdate');
            $keys = $groupedResults->keys()->all();
            $success = sort($keys);


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
             $data10,
             $ptNameDecrypt,
             $address,

            $groupedResults,
            $keys
           ]);
         }
         if($notice=="Lab Remove Row"){
          $count=0;$not_row=[];
          $test_seqs=$request["test_seqs"];
          $Pid=$request["Pid"];
          $test_date=$request["date"];

          foreach($test_seqs as $test_seq){
            $target_id="CID";
            switch ($test_seq) 
            {
              case 'HIV':
                $DB="Lab";
                break;
              case 'RPR':
                $DB="Rprtest";
                $target_id="pid";
                break;
              case 'STI':
                $DB="Labstitest";
                break;
              case 'Hepatitis':
                $DB="LabHbcTest";
                break;
              case 'Urine':
                $DB="Urine";
                break;
              case 'OI':
                $DB="Lab_oi";
                break;
              case 'General':
                $DB="LabGeneralTest";
                break;
              case 'Stool':
                $DB="LabStoolTest";
                break;
              case 'AFB':
                $DB="LabAfbTest";
                break;
              case 'Covid':
                $DB="LabCovidTest";
                break;
              case 'Viral Load':
                $DB="Viralload";
                break;
            };
            $modelClassName = 'App\\Models\\' . $DB; // extend model
            $model = app()->make($modelClassName);// resolves the model from the service container.

            $rowExist=$model->where($target_id,$Pid)->where("vdate",$test_date)->exists();
            if($rowExist){
              $model->where($target_id,$Pid)->where("vdate",$test_date)->delete();
            }else{
              $not_row[]="$test_seq doesn't have a data";;
            }
          }
          return response()->json([$not_row]);
            
         }
         else if($notice=="Follow Data Search"){
            $test_seq=$request["lab_test_type"];
            $form_date=$request["lab_follow_From"];
            $to_date=$request["lab_follow_to"];

            switch ($test_seq) 
            {
              case 'HIV':
                $DB="Lab";
                break;
              case 'RPR':
                $DB="Rprtest";
                $target_id="pid";
                break;
              case 'STI':
                $DB="Labstitest";
                break;
              case 'BC':
                $DB="LabHbcTest";
                break;
              case 'Urine':
                $DB="Urine";
                break;
              case 'OI':
                $DB="Lab_oi";
                break;
              case 'General':
                $DB="LabGeneralTest";
                break;
              case 'Stool':
                $DB="LabStoolTest";
                break;
              case 'AFB':
                $DB="LabAfbTest";
                break;
              case 'Covid':
                $DB="LabCovidTest";
                break;
              case 'Viral Load':
                $DB="Viralload";
                break;
            };

            $modelClassName = 'App\\Models\\' . $DB; // extend model
            $model = app()->make($modelClassName);// resolves the model from the service container.


          $lab_follow_data=$model->whereBetween('vdate',[$form_date,$to_date])->get();
          if($lab_follow_data){
            foreach ($lab_follow_data as $key => $value) {
              $lab_follow_data[$key]["vdate"]=date("d-m-Y",strtotime($value["vdate"]));
              $lab_follow_data[$key]["Req_Doctor"]=Crypt::decrypt_light($value["Req_Doctor"],$table);
            }
            switch ($test_seq) 
            {
              case 'HIV':
               foreach ($lab_follow_data as $key => $value) {
                $lab_follow_data[$key]["Final_Result"]=Crypt::decrypt_light($value["Final_Result"],$table);
               }
                break;
              case 'RPR':
                foreach ($lab_follow_data as $key => $value) {
                  $lab_follow_data[$key]["RDT(Yes/No)"]=Crypt::decrypt_light($value["RDT(Yes/No)"],$table);
                  $lab_follow_data[$key]["RDT Result"]=Crypt::decrypt_light($value["RDT Result"],$table);
                  $lab_follow_data[$key]["Quantitative(Yes/No)"]=Crypt::decrypt_light($value["Quantitative(Yes/No)"],$table);
                  $lab_follow_data[$key]["RPR Qualitative"]=Crypt::decrypt_light($value["RPR Qualitative"],$table);
                }
                break;
              case 'BC':
                foreach ($lab_follow_data as $key => $value) {
                  $lab_follow_data[$key]["HepB Test"]=Crypt::decrypt_light($value["HepB Test"],$table);
                  $lab_follow_data[$key]["HepB Result"]=Crypt::decrypt_light($value["HepB Result"],$table);
                  $lab_follow_data[$key]["HepC Test"]=Crypt::decrypt_light($value["HepC Test"],$table);
                  $lab_follow_data[$key]["HepC Result"]=Crypt::decrypt_light($value["HepC Result"],$table);

                }
                break;
            };

          }
          
          return response()->json([$lab_follow_data,$test_seq]);
         };
         //Create Section
         

         



         // Update Section
         if($hiv_update==3 && $updateID_hiv>0){
           Lab::where('id',$updateID_hiv)
               ->update([
                 'ClinicName' => $request->clinic,
                 'CID'=>$request->cid ,
                 'fuchiacode'=>$request->fuchiaID ,
                 'agey'=>$request->agey ,
                 'agem'=>$request->agem ,
                 'Visit_date'=>$request->vDate ,
                 'vdate'=>$request->vDate ,
                 'Gender'=>Crypt::encrypt_light($request->gender ,$table),
                 'Patient_Type'=>Crypt::encrypt_light($request->Ptype,$table),
                 'Patient Type Sub'=>Crypt::encrypt_light($request->ext_sub,$table),
                 'bcollectdate'=>$request->bcdate,
                 'Detmine_Result'=>Crypt::encrypt_light($request->d_result,$table),
                 'Unigold_Result'=>Crypt::encrypt_light($request->uni_result ,$table),
                 'STAT_PAK_Result'=>Crypt::encrypt_light($request->stat_result ,$table),
                 'Final_Result'=>Crypt::encrypt_light($request->final_result,$table),
                 'Counsellor'=>Crypt::encrypt_light($request->counsellor,$table),
                 'LabTech'=>Crypt::encrypt_light($request->lab_tech,$table),
                 'Req_Doctor' =>Crypt::encrypt_light($request->reqDoctor,$table),

                 'Incon'=>$request->Incon,
                 'updated_by'=>$request->updated_by,
                 'Comment'=>$request->Comment,

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
         if($rprTest==2 && $updateID_rpr>0){// to collect rpr test results

           Rprtest::where('id',$updateID_rpr)
           ->update([
             'pid'=>$request->cid,
             'visit_date'=>$request->vDate,
             'vdate'=>$request->vDate,
             'fuchiacode'=>$request->fuchiaID,
             'agey'=>$request->agey,
             'agem'=>$request->agem,
             'Gender'=>Crypt::encrypt_light($request->gender,$table),
             'Type Of Patient'=>Crypt::encrypt_light($request->Ptype,$table),
             'Patient Type Sub'=>Crypt::encrypt_light($request->Ptype_ext,$table),
             'RDT(Yes/No)' =>Crypt::encrypt_light( $request->rdtYes_no,$table),
             'RDT Result' =>Crypt::encrypt_light( $request->Sy_rdt_result,$table),
             'Quantitative(Yes/No)'=>Crypt::encrypt_light($request->rprYes_NO,$table),
             'RPR Qualitative'=>Crypt::encrypt_light($request->qualitative,$table),
             'Titre(current)'=>Crypt::encrypt_light($request->titreCur,$table),
             'Titre(Last)'=>Crypt::encrypt_light($request->titreLast,$table),
             'TitreLastDate'=>$request->lastTireDate,
             'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor,$table),
             'Counsellor'=>Crypt::encrypt_light($request->rpr_counselor,$table),
             'Lab Tech'=>Crypt::encrypt_light($request->lab_tech_rpr,$table),
             'Issue Date'=>$request->rpr_issue_date,
             'updated_by'=>$request->updated_by,
             'Comment'=>$request->Comment,
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
         if($stiTest==2 && $updateID_sti>0){
           Labstitest::where('id',$updateID_sti)
           ->update([
             'CID'=>$request->cid,
             'fuchiacode'=>$request->fuchiaID,
             'agey'=>$request->agey  ,
             'agem'=>$request->agem  ,
             'Gender'=> Crypt::encrypt_light($request->gender,$table),
             'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor ,$table),
             'visit_date'=>$request->vDate,
             'vdate'=>$request->vDate,
             'Type Of Patient'=>Crypt::encrypt_light($request->Ptype  ,$table),
             'Patient Type Sub'=>Crypt::encrypt_light($request->ext_sub  ,$table),

             'Wet Mount clue cell'=>Crypt::encrypt_light($request->clue_cells,$table),
             'Fornix Clue Cells'=>Crypt::encrypt_light($request->clue_post_fornix  ,$table),
             //next line*****************************
             'urethra WBC'=>Crypt::encrypt_light($request->pmnl_urethra ,$table),
             'Fornix WBC'=>Crypt::encrypt_light($request->pmnl_post_fix,$table),
             'Endo cervix WBC'=>Crypt::encrypt_light($request->pmnl_endocevix  ,$table),
             'Rectum WBC'=>Crypt::encrypt_light($request->pmnl_rectum  ,$table),
             // next line****************************
             'Wet Mount Trichomonas'=>Crypt::encrypt_light($request->tricho_wet,$table),
             // next line ***************************
             'Urethra diplococci intra-cell'=>Crypt::encrypt_light($request->gram_intra_urethra,$table),
             'Fornix diplococci intra-cell'=>Crypt::encrypt_light($request->gram_intra_postfornix,$table),
             'Endo cervix diplococci intra-cell'=>Crypt::encrypt_light($request->gram_intra_endo,$table),
             'Rectum diplococci intra-cell'=>Crypt::encrypt_light($request->gram_intra_rectum  ,$table),
             // next line **************************
             'Urethra diplococci extra-cell'=>Crypt::encrypt_light($request->gram_extra_urethra,$table),
             'Fornix diplococci extra-cell'=>Crypt::encrypt_light($request->gram_extra_postfornix,$table),
             'Endo cervix diplococci extra-cell'=>Crypt::encrypt_light($request->gram_extra_endo,$table),
             'Rectum diplococci extra-cell'=>Crypt::encrypt_light($request->gram_extra_rectum  ,$table),
             // next line ***************************
             'Wet Mount candida'=>Crypt::encrypt_light($request->candida_wet  ,$table),
             'Urethra Candida'=>Crypt::encrypt_light($request->candida_urethra  ,$table),
             'Fornix Candida'=>Crypt::encrypt_light($request->candida_postfornix  ,$table),
             'Endo cervix Candida'=>Crypt::encrypt_light($request->candida_endo  ,$table),
             // next line *******************************
             'wetoth'=>Crypt::encrypt_light($request->Sper_other_wet,$table),
            //  'uoth'=>Crypt::encrypt_light($request->Sper_other_urethra  ,$table),
            //  'pfother'=>Crypt::encrypt_light($request->Sper_other_post,$table),
            //  'eother'=>Crypt::encrypt_light($request->Sper_other_endo,$table),
            //  'rother'=>Crypt::encrypt_light($request->Sper_other_rectum,$table),
             // next line *****************************
             'First Per Urine'=>Crypt::encrypt_light($request->urine_exam_done,$table),
             'Epithelial cells'=>Crypt::encrypt_light($request->epithelial_cell,$table),
             //next line*******************************
             'First Per Urine Diplococci Intra-Cell'=>Crypt::encrypt_light($request->intra_cell,$table),
             'PMNL cells'=>Crypt::encrypt_light($request->pmnl_cell,$table),
             //next  line******************************
             'First Per Urine Diplococci Extra-Cell'=>Crypt::encrypt_light($request->extra_cell,$table),
             // next line ****************
             'Other Bacteria'=>Crypt::encrypt_light($request->oth_bact,$table),
             // End ***********////********************///*********************
             'Lab Techanician'=>Crypt::encrypt_light($request->sti_lab_tech,$table),
             'idate'=>$request->sti_issuDate,

             'updated_by'=>$request->updated_by,
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
         if($hbcTest==2 && $updateID_hbc>0){
           LabHbcTest::where('id',$updateID_hbc)
           ->update([
             'CID'=>$request->cid ,
             'fuchiacode'=>$request->fuchiaID ,
             'agey'=>$request->agey ,
             'agem'=>$request->agem ,
             'Gender'=>Crypt::encrypt_light($request->gender ,$table),
             'Visit_date'=>$request->vDate ,
             'vdate'=>$request->vDate,
             'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor ,$table),
             //'requested Doctor new'=>Crypt::encrypt_light($request-> ,$table),
            //  'tdate'=>$request->bcdate,
             'Patient_Type'=>Crypt::encrypt_light($request->Ptype ,$table),
             'Patient Type Sub'=>Crypt::encrypt_light($request->ext_sub ,$table),
             //'Hiv status'=>Crypt::encrypt_light($request-> ,$table),
             'HepB Test'=>Crypt::encrypt_light($request->hepB ,$table),
             'HepB TOT'=>Crypt::encrypt_light($request->totB ,$table),
             'HepB Result'=>Crypt::encrypt_light($request->b_result ,$table),
             'HepC Test'=>Crypt::encrypt_light($request->c_test ,$table),
             'HepC TOT'=>Crypt::encrypt_light($request->totC ,$table),
             'HepC Result'=>Crypt::encrypt_light($request->c_result ,$table),
             'Lab Tech'=>Crypt::encrypt_light($request->c_lab_tech ,$table),
             'Issue Date'=>$request->c_issueDate,
             //'Visit ID'=>Crypt::encrypt_light($request-> ,$table),
             'clinic code'=>$request->clinic ,

             'updated_by'=>$request->updated_by,
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
         if($urineTest==2 && $updateID_urine>0 ){

               Urine::where('id',$updateID_urine)
               ->update([
                 'ClinicName'  => $request->clinic,
                 'CID'         =>$request->cid ,
                 'visitDate'   =>$request->vDate,
                 'vdate'=>$request->vDate,
                 'fuchiacode'  =>$request->fuchiaID ,
                 'agey'        =>$request->agey ,
                 'agem'        =>$request->agem ,
                 'Gender'      =>Crypt::encrypt_light($request->gender,$table),
                 'Main Risk'    =>Crypt::encrypt_light($request->Ptype,$table),
                 'Sub Risk' =>Crypt::encrypt_light($request->ext_sub,$table),
                 'Req_Doctor'      =>Crypt::encrypt_light($request->reqDoctor,$table),

                 'Utest_done'  =>Crypt::encrypt_light( $request->utest_done,$table),
                 'Utot'        =>Crypt::encrypt_light( $request->typeoftest,$table),
                 'Uturbitity'      =>Crypt::encrypt_light( $request->turbitity,$table),
                 'Uapp'        =>Crypt::encrypt_light( $request->appear,$table),
                 'Upus'        =>Crypt::encrypt_light( $request->pus,$table),

                 'ph'          =>Crypt::encrypt_light( $request->uph,$table),
                 'Uprotein'    =>Crypt::encrypt_light( $request->protein,$table),
                 'Uglucose'    =>Crypt::encrypt_light( $request->glucose,$table),
                 'Urbc'        =>Crypt::encrypt_light( $request->rbc,$table),
                 'Uleu'        =>Crypt::encrypt_light( $request->leu,$table),

                 'Unitrite'    =>Crypt::encrypt_light( $request->nitrite,$table),
                 'Uketone'    =>Crypt::encrypt_light( $request->ketone,$table),
                 'Uepithelial' =>Crypt::encrypt_light( $request->epithelial,$table),
                 'Urobili'     =>Crypt::encrypt_light( $request->robili,$table),
                 'Ubillru'     =>Crypt::encrypt_light( $request->billru,$table),

                 'Uery'        =>Crypt::encrypt_light( $request->ery,$table),
                 'Ucrystal'    =>Crypt::encrypt_light( $request->crystal,$table),
                 'Uhae'        =>Crypt::encrypt_light( $request->hae,$table),
                 'Uother'      =>Crypt::encrypt_light( $request->other,$table),
                 'Ucast'       =>Crypt::encrypt_light( $request->cast,$table),
                 'comment'     =>Crypt::encrypt_light( $request->Ument,$table),

                 'Cretinine'     =>Crypt::encrypt_light( $request->cretinine,$table),
                 'Albumin'     =>Crypt::encrypt_light( $request->albumin,$table),
                 'A:C_ratio'     =>Crypt::encrypt_light( $request->a_c_ratio,$table),

                 'lab_tech'    =>Crypt::encrypt_light( $request->lab_tech,$table),
                 'issue_date'  => $request->issue_date,

                 'updated_by'=>$request->updated_by,
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
         if($oiTest==2 && $updateID_oi>0){
               Lab_oi::where('id',$updateID_oi)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'Gender'               =>Crypt::encrypt_light( $request -> gender ,$table),
                 'Req_Doctor'     =>Crypt::encrypt_light( $request -> reqDoctor ,$table),
                 'visit_date'           =>$request -> vDate,
                 'vdate'=>$request->vDate,
                 //'Patient Type'         =>Crypt::encrypt_light( $request -> Ptype,$table),
                 //'Patient Type Sub'     =>Crypt::encrypt_light( $request -> ext_sub,$table),
                 'clinic code'          =>$request -> clinic,

                 'TB_LAM_Report'        =>Crypt::encrypt_light( $request -> tb_lam_report ,$table),
                 'Serum Result'         =>Crypt::encrypt_light( $request -> serum_cry_antigen ,$table),
                 'serum_pos'            =>Crypt::encrypt_light( $request -> serum_cry_due  ,$table),
                 'CSF for Cryptococcal Antigen'=>Crypt::encrypt_light( $request -> csf_cry_antigen ,$table),
                 'csf_crypto_pos'       =>Crypt::encrypt_light( $request ->csf_due  ,$table),


                 'csf_fungal'           =>Crypt::encrypt_light( $request ->csf_smear ,$table),
                 'CSF Smear Giemsa Stain'=>Crypt::encrypt_light( $request ->giemsa_stain_result  ,$table),
                 'CSF Smear India Ink'  =>Crypt::encrypt_light( $request ->india_ink_result ,$table),

                 'skin_fungal'          =>Crypt::encrypt_light( $request -> skin_smear ,$table),
                 'Skin Smear Giemsa Stain'=>Crypt::encrypt_light( $request -> skin_giemsa_stain_result ,$table),
                 'Skin Smear India Ink' =>Crypt::encrypt_light( $request ->  skin_india_ink_result ,$table),

                 'lymph_test'          =>Crypt::encrypt_light( $request ->lymph_test,$table),
                 'lymph Giemsa Stain'           =>Crypt::encrypt_light( $request ->lymph_giemsa_stain  ,$table),
                 'lymph India Ink'           =>Crypt::encrypt_light( $request ->lymph_india_ink  ,$table),
                 //'sample_type'          =>Crypt::encrypt_light( $request -> type_sample ,$table),

                 'Toxo plasma'  =>Crypt::encrypt_light($request ->toxo_plasma,$table),
                 'Toxo igG'     =>Crypt::encrypt_light($request ->toxo_igG,$table),
                 'Toxo igM'     =>Crypt::encrypt_light($request ->toxo_igm,$table),
                 'Lab Techanician'      =>Crypt::encrypt_light( $request ->oi_lab_tech  ,$table),
                 'issued'               => $request ->oi_issue_date  ,

                 'updated_by'=>$request->updated_by,
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
         if($gtTest==2 && $updateID_gt>0){
               LabGeneralTest::where('id',$updateID_gt)
               ->update([
               'CID'                  => $request -> cid ,
               'fuchiacode'           => $request -> fuchiaID  ,
               'agey'                 => $request -> agey ,
               'agem'                 => $request -> agem ,
               'Gender'               =>Crypt::encrypt_light( $request -> gender ,$table),
               'Req_Doctor' =>Crypt::encrypt_light( $request -> reqDoctor ,$table),
               'Visit_date'           =>$request -> vDate ,
               'vdate'=>$request->vDate,
               'Patient_Type'         =>Crypt::encrypt_light( $request -> Ptype,$table),
               'Patient Type Sub'     =>Crypt::encrypt_light( $request -> ext_sub,$table),
               'clinic code'          =>Crypt::encrypt_light( $request -> clinic,$table),

               'Dangue RDT'           =>Crypt::encrypt_light( $request ->dangue_rdt   ,$table),
               'NS1 Antigen'          =>Crypt::encrypt_light( $request ->NS1_antigen   ,$table),
               'IgG Result'           =>Crypt::encrypt_light( $request ->igG   ,$table),
               'IgM Result'           =>Crypt::encrypt_light( $request ->igm   ,$table),
               'Malaria RDT'          =>Crypt::encrypt_light($request->malaria_rdt_done,$table),
               'Malaria RDT Result'   =>Crypt::encrypt_light( $request ->malaria_rdt_result  ,$table),
               'Malaria_spec'         =>Crypt::encrypt_light($request ->mal_spec,$table),
               'Malaria_grade'        =>Crypt::encrypt_light($request ->mal_grade,$table),
               'Malaria_stage'        =>Crypt::encrypt_light($request ->mal_stage ,$table),

               'malaria_microscopy'   =>Crypt::encrypt_light( $request ->malaria_done   ,$table),
               'Malaria Microscopy Result'=>Crypt::encrypt_light( $request ->malaria_microscopy_result   ,$table),
               'RBS test'             =>Crypt::encrypt_light( $request->rbs,$table),
               'RBS'                  =>Crypt::encrypt_light( $request ->rbs_result   ,$table),
               'FBS test'             =>Crypt::encrypt_light( $request->fbs,$table),
               'FBS'                  =>Crypt::encrypt_light( $request ->fbs_result   ,$table),
               'haemo_done'           =>Crypt::encrypt_light($request->gt_haemoglobin,$table),
               'haemoglobin'          =>Crypt::encrypt_light( $request ->haemoPercent   ,$table),

               'hba1c'                =>Crypt::encrypt_light( $request ->hba1c   ,$table),
               //'visitID'              =>Crypt::encrypt_light( $request ->   ,$table),
               "Lab Tech"             =>Crypt::encrypt_light( $request ->gt_lab_tech    ,$table),
               "Issue Date"           => $request ->gt_issue_date   ,
               //"ClinicName"           => $request ->   ,

               'updated_by'=>$request->updated_by,
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
         if($stTest==2 && $updateID_st>0){
               LabStoolTest::where('id',$updateID_st)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'visit_date'           => $request -> vDate  ,
                 'vdate'=>$request->vDate,
                 'Gender'               =>Crypt::encrypt_light( $request -> gender ,$table),
                 'Req_Doctor'     =>Crypt::encrypt_light( $request -> reqDoctor ,$table),
                 'Patient Type'         =>Crypt::encrypt_light( $request -> Ptype,$table),
                 'Patient Type Sub'     =>Crypt::encrypt_light( $request -> ext_sub,$table),
                 'Clinic'               =>Crypt::encrypt_light( $request -> clinic,$table),
                 'st_stool'             =>Crypt::encrypt_light( $request -> st_stool,$table),
                 'st_colour'            =>Crypt::encrypt_light( $request -> st_colour,$table),
                 'wbc_pus_cell'         =>Crypt::encrypt_light( $request -> wbc_pus_cell,$table),
                 'st_consistency'       =>Crypt::encrypt_light( $request -> st_consistency,$table),
                 'st_rbcs'              =>Crypt::encrypt_light( $request -> st_rbcs,$table),
                 'st_other'             =>Crypt::encrypt_light( $request -> st_other,$table),
                 'st_comment'           =>$request -> st_comment,
                 'st_lab_tech'          =>Crypt::encrypt_light( $request -> st_lab_tech,$table),
                 'st_issue_date'        => $request -> st_issue_date,

                 'updated_by'=>$request->updated_by,
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
         if($afbTest==2 && $updateID_afb>0){
               //  $decrypted_string = Crypt::decryptString($encrypted_string); For decryption
               $ptName = $request -> input('afb_pt_name');
                  $encrypted_Name = Crypt::encryptString($ptName);
               $ptAddress = $request -> input('afb_pt_address');
                  $encrypted_Address= Crypt::encryptString($ptAddress);

               LabAfbTest::where('id',$updateID_afb)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'visit_date'           => $request -> vDate  ,
                 'vdate'=>$request->vDate,
                 'clinic code'               => $request -> clinic,
                 'afb_pt_name'          => $encrypted_Name,// Encrypted
                 'afb_pt_address'       => $encrypted_Address,// Encrypted

                 'Gender'               =>Crypt::encrypt_light( $request -> gender ,$table),
                 'Req_Doctor'     =>Crypt::encrypt_light( $request -> reqDoctor ,$table),
                 'Patient Type'         =>Crypt::encrypt_light( $request -> Ptype,$table),
                 'Patient Type Sub'     =>Crypt::encrypt_light( $request -> ext_sub,$table),
                 'Previous_TB'          =>Crypt::encrypt_light( $request -> Previous_TB,$table),
                 'HIV_status'           =>Crypt::encrypt_light( $request -> HIV_status,$table),
                 'reason_for_exam'      =>$request -> reason_for_exam,
                 'afb_Pt_type'          =>Crypt::encrypt_light( $request -> afb_Pt_type,$table),
                 'follow_up_mt'         =>Crypt::encrypt_light( $request -> follow_up_mt,$table),
                 'speci_type'           =>Crypt::encrypt_light( $request -> speci_type,$table),
                 'slide_num_1'          =>Crypt::encrypt_light( $request -> slide_num_1,$table),
                 'slide_num_2'          =>Crypt::encrypt_light( $request -> slide_num_2,$table),
                 'speci_receive_dt1'    =>$request -> speci_receive_dt1,
                 'speci_receive_dt2'    =>$request -> speci_receive_dt2,
                 'visual_app_1'         =>Crypt::encrypt_light( $request -> visual_app_1,$table),
                 'visual_app_2'         =>Crypt::encrypt_light( $request -> visual_app_2,$table),
                 'afb_result1'          =>Crypt::encrypt_light( $request -> afb_result1,$table),
                 'afb_result2'          =>Crypt::encrypt_light( $request -> afb_result2,$table),
                 'slide1_grading1'      =>Crypt::encrypt_light( $request -> sacnty_grading1,$table),
                 'slide2_grading2'      =>Crypt::encrypt_light( $request -> sacnty_grading2,$table),
                 'afb_lab_techca'       =>Crypt::encrypt_light( $request -> afb_lab_tech,$table),

                 'afb_issue_date'       => $request -> afb_issue_date,

                 'updated_by'=>$request->updated_by,
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
         if($covidTest==2 && $updateID_covid>0){
               LabCovidTest::where('id',$updateID_covid)
               ->update([
                 'CID'                  => $request -> cid ,
                 'fuchiacode'           => $request -> fuchiaID  ,
                 'agey'                 => $request -> agey ,
                 'agem'                 => $request -> agem ,
                 'visit_date'           => $request -> vDate  ,
                 'vdate'=>$request->vDate,
                 'Clinic'               =>$request -> clinic,
                 'Gender'               =>Crypt::encrypt_light( $request ->gender ,$table),
                 'Req_Doctor'     =>Crypt::encrypt_light( $request ->reqDoctor ,$table),
                 'Patient Type'         =>Crypt::encrypt_light( $request ->Ptype,$table),
                 'Patient Type Sub'     =>Crypt::encrypt_light( $request ->ext_sub,$table),
                 'type_of_patient_covid'=>Crypt::encrypt_light( $request ->type_of_patient_covid,$table),
                 'specimen_type'        =>Crypt::encrypt_light( $request ->specimen_type,$table),
                 'co_test_type'         =>Crypt::encrypt_light( $request ->co_test_type,$table),
                 'covid_result'         =>Crypt::encrypt_light( $request ->covid_result,$table),
                 'covid_lab_tech'       =>Crypt::encrypt_light( $request ->covid_lab_tech,$table),
                 'covid_issue_date'     => $request ->covid_issue_date,
                 'Comment'=>$request->co_comment,
                 'updated_by'=>$request->updated_by,

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
         if($viral_loadTest==2 && $updateID_viral>0){
                   Viralload::where('id',$updateID_viral)
                   ->update([
                     'Clinic'=>$request->clinic ,
                     'CID'=>$request->cid ,
                     'fuchiacode'=>$request->fuchiaID ,
                     'agey'=>$request->agey ,
                     'agem'=>$request->agem ,
                     //'Visit_date'=>$request->vDate ,
                     'ART_ini_date'=> $request->art_initial_date_time ,
                     'Sample_Ship_Date'=> $request->sample_ship_date ,
                     'vdate'=>$request->vDate,
                     'Result received date'=>$request->result_received_date,

                     'Gender'=>Crypt::encrypt_light($request->gender ,$table),
                     'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor ,$table),
                     'ART_duration'=>Crypt::encrypt_light($request->art_duration,$table),
                     'Sample Sent to'=>Crypt::encrypt_light( $request->sample_sent_to ,$table),
                     'Detect'=>Crypt::encrypt_light( $request->detectable ,$table),
                     'Viral Load Result'=>Crypt::encrypt_light( $request->viral_load_result ,$table),
                     'Other org code'=>Crypt::encrypt_light( $request->other_org_code ,$table),

                     'Remark'=> $request->remark  ,
                     'updated_by'=>$request->updated_by,

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

        // to fill data to update
        if($toFill==1){
          $test_name_tofill = $request -> input('test_name_tofill');// to update
          switch ($test_name_tofill) {
            case 'HIV':
            return $this->hiv_data_drawer($request);
            break;
            case 'RPR':
            return $this->rpr_data_drawer($request);
            break;
            case 'STI':
            return $this->sti_data_drawer($request);
            break;
            case 'HBC':
            return $this->hepb_c_data_drawer($request);
            break;
            case 'Urine':
            return $this->urine_data_drawer($request);
            break;
            case 'OI':
            return $this->oi_data_drawer($request);
            break;
            case 'General':
            return $this->gen_data_drawer($request);
            break;
            case 'Stool':
            return $this->st_data_drawer($request);
            break;
            case 'AFB':
            return $this->afb_data_drawer($request);
            break;
            case 'Covid':
            return $this->covid_data_drawer($request);
            break;
            case 'Viral_load':
            return $this->viral_load_data_drawer($request);
            break;

            default:
            // code...
            break;
          }
        }

        if($drawData == 1){
          $dataPatient=[];
          if($printYN=="yes"){
            $id=$request->id;
            $date=$request->date;

            $dataPatient = PtConfig::select('Pid','FuchiaID','Agey','Agem','Gender')->where('Pid',$id)
            ->get();

          }else{
           $id = $request -> input('PtID');//
           $date = $request -> input('selected_Date');//
          }
           

          $data =Lab::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data1 =Rprtest::where('pid',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data2 =Labstitest::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data3 =LabHbcTest::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data4 =Urine::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data5 =Lab_oi::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data6 =LabGeneralTest::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data7 =LabStoolTest::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data8 =LabAfbTest::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data9 =LabCovidTest::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();
          $data10 =Viralload::where('CID',$id)
          ->where('vdate','=',$date)
          ->latest()
          ->limit(1)
          ->get();

          // decalared arrays
           $dataPrepare_hiv=[];$dataPrepare_rpr=[];$dataPrepare_sti=[];$dataPrepare_hbc=[];$dataPrepare_urine=[];
           $dataPrepare_oi=[];$dataPrepare_general=[];$dataPrepare_stool=[];$dataPrepare_afb=[];$dataPrepare_covid=[];
           $dataPrepare_viral=[];
           for ($i=0; $i <count($data) ; $i++) {
             $dataPrepare_hiv[$i]['id']=$data[$i]["id"];
             $dataPrepare_hiv[$i]['ClinicName']=$data[$i]["ClinicName"];
             $dataPrepare_hiv[$i]['CID']=$data[$i]["CID"];
             $dataPrepare_hiv[$i]['fuchiacode']=$data[$i]["fuchiacode"];
             $dataPrepare_hiv[$i]['agey']=$data[$i]["agey"];
             $dataPrepare_hiv[$i]['agem']=$data[$i]["agem"];
             $dataPrepare_hiv[$i]['Visit_date'] = $data[$i]["Visit_date"];
             $dataPrepare_hiv[$i]['Incon'] = $data[$i]["Incon"];

             $dataPrepare_hiv[$i]['Req_Doctor'] = Crypt::decrypt_light($data[$i]["Req_Doctor"],$table);
            
             $dataPrepare_hiv[$i]['Gender'] = Crypt::decrypt_light($data[$i]["Gender"],$table);
             $dataPrepare_hiv[$i]['Patient_Type'] = Crypt::decrypt_light($data[$i]["Patient_Type"],$table);
             $dataPrepare_hiv[$i]['Patient Type Sub'] = Crypt::decrypt_light($data[$i]["Patient Type Sub"],$table);

             $dataPrepare_hiv[$i]['bcollectdate'] = $data[$i]["bcollectdate"];
             $dataPrepare_hiv[$i]['Detmine_Result'] = Crypt::decrypt_light($data[$i]["Detmine_Result"],$table);
             $dataPrepare_hiv[$i]['Unigold_Result'] = Crypt::decrypt_light($data[$i]["Unigold_Result"],$table);
             $dataPrepare_hiv[$i]['STAT_PAK_Result'] = Crypt::decrypt_light($data[$i]["STAT_PAK_Result"],$table);
             $dataPrepare_hiv[$i]['Final_Result'] = Crypt::decrypt_light($data[$i]["Final_Result"],$table);

             $dataPrepare_hiv[$i]['Counsellor'] = Crypt::decrypt_light($data[$i]["Counsellor"],$table);
             $dataPrepare_hiv[$i]['LabTech']= Crypt::decrypt_light($data[$i]["LabTech"],$table);
             $dataPrepare_hiv[$i]['vdate']= $data[$i]["vdate"];
             $dataPrepare_hiv[$i]['Issue_Date']= $data[$i]["Issue_Date"];
             $dataPrepare_hiv[$i]['updated_by']= $data[$i]["updated_by"];
             $dataPrepare_hiv[$i]['created_by']= $data[$i]["created_by"];

             $dataPrepare_hiv[$i]['Comment']= $data[$i]["Comment"];




           }//hiv

           for ($i=0; $i <count($data1) ; $i++) {

             $dataPrepare_rpr[$i]["id"] = $data1[$i]["id"];
             $dataPrepare_rpr[$i]["clinic code"] = $data1[$i]["clinic code"];
             $dataPrepare_rpr[$i]["pid"] = $data1[$i]["pid"];
             $dataPrepare_rpr[$i]["visit_date"] = $data1[$i]["visit_date"];
             $dataPrepare_rpr[$i]["fuchiacode"] = $data1[$i]["fuchiacode"];
             $dataPrepare_rpr[$i]["agey"] = $data1[$i]["agey"];
             $dataPrepare_rpr[$i]["agem"] = $data1[$i]["agem"];
             $dataPrepare_rpr[$i]["Gender"] = Crypt::decrypt_light($data1[$i]["Gender"],$table);
             $dataPrepare_rpr[$i]["Type Of Patient"] = Crypt::decrypt_light($data1[$i]["Type Of Patient"],$table);
             $dataPrepare_rpr[$i]["Patient Type Sub"] = Crypt::decrypt_light($data1[$i]["Patient Type Sub"],$table);
             $dataPrepare_rpr[$i]["Req_Doctor"] = Crypt::decrypt_light($data1[$i]["Req_Doctor"],$table);

             $dataPrepare_rpr[$i]["RDT(Yes/No)"] = Crypt::decrypt_light($data1[$i]["RDT(Yes/No)"],$table);
             $dataPrepare_rpr[$i]["RDT Result"] = Crypt::decrypt_light($data1[$i]["RDT Result"],$table);
             $dataPrepare_rpr[$i]["Quantitative(Yes/No)"] = Crypt::decrypt_light($data1[$i]["Quantitative(Yes/No)"],$table);
             $dataPrepare_rpr[$i]["RPR Qualitative"] = Crypt::decrypt_light($data1[$i]["RPR Qualitative"],$table);

             $dataPrepare_rpr[$i]["Titre(current)"] = Crypt::decrypt_light($data1[$i]["Titre(current)"],$table);
             $dataPrepare_rpr[$i]["Titre(Last)"] = Crypt::decrypt_light($data1[$i]["Titre(Last)"],$table);
             $dataPrepare_rpr[$i]["TitreLastDate"] = $data1[$i]["TitreLastDate"];

             $dataPrepare_rpr[$i]["Counsellor"] = Crypt::decrypt_light($data1[$i]["Counsellor"],$table);
             $dataPrepare_rpr[$i]["Lab Tech"] = Crypt::decrypt_light($data1[$i]["Lab Tech"],$table);
             $dataPrepare_rpr[$i]["Issue Date"] = $data1[$i]["Issue Date"];
             $dataPrepare_rpr[$i]['vdate']= $data1[$i]["vdate"];
             $dataPrepare_rpr[$i]['updated_by']= $data1[$i]["updated_by"];
             $dataPrepare_rpr[$i]['created_by']= $data1[$i]["created_by"];

             $dataPrepare_rpr[$i]['Comment']= $data1[$i]["Comment"];
           }//rpr

           for ($i=0; $i <count($data2) ; $i++) {

             $dataPrepare_sti[$i]["id"] = $data2[$i]["id"];
             $dataPrepare_sti[$i]["clinic code"] = $data2[$i]["clinic code"];
             $dataPrepare_sti[$i]["CID"] = $data2[$i]["CID"];
             $dataPrepare_sti[$i]["fuchiacode"] = $data2[$i]["fuchiacode"];
             $dataPrepare_sti[$i]["agey"] = $data2[$i]["agey"];
             $dataPrepare_sti[$i]["agem"] = $data2[$i]["agem"];
             $dataPrepare_sti[$i]["visit_date"] = $data2[$i]["visit_date"];
             $dataPrepare_sti[$i]["Gender"] = Crypt::decrypt_light($data2[$i]["Gender"],$table);
             $dataPrepare_sti[$i]["Req_Doctor"] = Crypt::decrypt_light($data2[$i]["Req_Doctor"],$table);
             
             $dataPrepare_sti[$i]["Type Of Patient"] = Crypt::decrypt_light($data2[$i]["Type Of Patient"],$table);
             $dataPrepare_sti[$i]["Patient Type Sub"] = Crypt::decrypt_light($data2[$i]["Patient Type Sub"],$table);

             $dataPrepare_sti[$i]["Wet Mount clue cell"] = Crypt::decrypt_light($data2[$i]["Wet Mount clue cell"],$table);
             $dataPrepare_sti[$i]["Wet Mount Trichomonas"] = Crypt::decrypt_light($data2[$i]["Wet Mount Trichomonas"],$table);
             $dataPrepare_sti[$i]["Wet Mount candida"] = Crypt::decrypt_light($data2[$i]["Wet Mount candida"],$table);
             $dataPrepare_sti[$i]["wetoth"] = Crypt::decrypt_light($data2[$i]["wetoth"],$table);
             $dataPrepare_sti[$i]["urethra WBC"] = Crypt::decrypt_light($data2[$i]["urethra WBC"],$table);
             $dataPrepare_sti[$i]["Urethra diplococci intra-cell"] = Crypt::decrypt_light($data2[$i]["Urethra diplococci intra-cell"],$table);
             $dataPrepare_sti[$i]["Urethra diplococci extra-cell"] = Crypt::decrypt_light($data2[$i]["Urethra diplococci extra-cell"],$table);
             $dataPrepare_sti[$i]["Urethra Candida"] = Crypt::decrypt_light($data2[$i]["Urethra Candida"],$table);
             //$dataPrepare_sti[$i]["uoth"] = Crypt::decrypt_light($data2[$i]["uoth"],$table);
             $dataPrepare_sti[$i]["Fornix Clue Cells"] = Crypt::decrypt_light($data2[$i]["Fornix Clue Cells"],$table);
             $dataPrepare_sti[$i]["Fornix WBC"] = Crypt::decrypt_light($data2[$i]["Fornix WBC"],$table);
             $dataPrepare_sti[$i]["Fornix diplococci intra-cell"] = Crypt::decrypt_light($data2[$i]["Fornix diplococci intra-cell"],$table);
             $dataPrepare_sti[$i]["Fornix diplococci extra-cell"] = Crypt::decrypt_light($data2[$i]["Fornix diplococci extra-cell"],$table);
             $dataPrepare_sti[$i]["Fornix Candida"] = Crypt::decrypt_light($data2[$i]["Fornix Candida"],$table);
            // $dataPrepare_sti[$i]["pfother"] = Crypt::decrypt_light($data2[$i]["pfother"],$table);
             $dataPrepare_sti[$i]["Endo cervix WBC"] = Crypt::decrypt_light($data2[$i]["Endo cervix WBC"],$table);
             $dataPrepare_sti[$i]["Endo cervix diplococci intra-cell"] = Crypt::decrypt_light($data2[$i]["Endo cervix diplococci intra-cell"],$table);
             $dataPrepare_sti[$i]["Endo cervix diplococci extra-cell"] = Crypt::decrypt_light($data2[$i]["Endo cervix diplococci extra-cell"],$table);
             $dataPrepare_sti[$i]["Endo cervix Candida"] = Crypt::decrypt_light($data2[$i]["Endo cervix Candida"],$table);
            // $dataPrepare_sti[$i]["eother"] = Crypt::decrypt_light($data2[$i]["eother"],$table);
             $dataPrepare_sti[$i]["Rectum WBC"] = Crypt::decrypt_light($data2[$i]["Rectum WBC"],$table);
             $dataPrepare_sti[$i]["Rectum diplococci intra-cell"] = Crypt::decrypt_light($data2[$i]["Rectum diplococci intra-cell"],$table);
             $dataPrepare_sti[$i]["Rectum diplococci extra-cell"] = Crypt::decrypt_light($data2[$i]["Rectum diplococci extra-cell"],$table);
            // $dataPrepare_sti[$i]["rother"] = Crypt::decrypt_light($data2[$i]["rother"],$table);
             $dataPrepare_sti[$i]["First Per Urine"] = Crypt::decrypt_light($data2[$i]["First Per Urine"],$table);
             $dataPrepare_sti[$i]["Epithelial cells"] = Crypt::decrypt_light($data2[$i]["Epithelial cells"],$table);
             $dataPrepare_sti[$i]["PMNL cells"] = Crypt::decrypt_light($data2[$i]["PMNL cells"],$table);

             $dataPrepare_sti[$i]["First Per Urine Diplococci Intra-Cell"] = Crypt::decrypt_light($data2[$i]["First Per Urine Diplococci Intra-Cell"],$table);
             $dataPrepare_sti[$i]["First Per Urine Diplococci Extra-Cell"] = Crypt::decrypt_light($data2[$i]["First Per Urine Diplococci Extra-Cell"],$table);
             $dataPrepare_sti[$i]["fpu_oth"] = Crypt::decrypt_light($data2[$i]["fpu_oth"],$table);
             $dataPrepare_sti[$i]["Lab Techanician"] = Crypt::decrypt_light($data2[$i]["Lab Techanician"],$table);
             $dataPrepare_sti[$i]["idate"] = $data2[$i]["idate"];
             $dataPrepare_sti[$i]["visitID"] = Crypt::decrypt_light($data2[$i]["visitID"],$table);
             $dataPrepare_sti[$i]["Other Bacteria"] = Crypt::decrypt_light($data2[$i]["Other Bacteria"],$table);
             $dataPrepare_sti[$i]['vdate']= $data2[$i]["vdate"];
             $dataPrepare_sti[$i]['updated_by']= $data2[$i]["updated_by"];
             $dataPrepare_sti[$i]['created_by']= $data2[$i]["created_by"];
             

           }//sti

           for ($i=0; $i <count($data3) ; $i++) {
             $dataPrepare_hbc[$i]["id"]= $data3[$i]["id"];
             $dataPrepare_hbc[$i]["CID"]= $data3[$i]["CID"];
             $dataPrepare_hbc[$i]["fuchiacode"]= $data3[$i]["fuchiacode"];
             $dataPrepare_hbc[$i]["agey"]= $data3[$i]["agey"];
             $dataPrepare_hbc[$i]["agem"]= $data3[$i]["agem"];
             $dataPrepare_hbc[$i]["Visit_date"]=$data3[$i]["Visit_date"];
             $dataPrepare_hbc[$i]["Gender"]= Crypt::decrypt_light($data3[$i]["Gender"],$table);
             $dataPrepare_hbc[$i]["Patient_Type"]=Crypt::decrypt_light($data3[$i]["Patient_Type"],$table);
             $dataPrepare_hbc[$i]["Patient Type Sub"]=Crypt::decrypt_light($data3[$i]["Patient Type Sub"],$table);
             $dataPrepare_hbc[$i]["Req_Doctor"]=Crypt::decrypt_light($data3[$i]["Req_Doctor"],$table);
             

             $dataPrepare_hbc[$i]["HepB Test"]    =Crypt::decrypt_light($data3[$i]["HepB Test"],$table);
             $dataPrepare_hbc[$i]["HepB Result"]=Crypt::decrypt_light($data3[$i]["HepB Result"],$table);
             $dataPrepare_hbc[$i]["HepC Test"]=Crypt::decrypt_light($data3[$i]["HepC Test"],$table);
             $dataPrepare_hbc[$i]["HepC Result"]=Crypt::decrypt_light($data3[$i]["HepC Result"],$table);
             $dataPrepare_hbc[$i]["Lab Tech"]=Crypt::decrypt_light($data3[$i]["Lab Tech"],$table);
             $dataPrepare_hbc[$i]["Issue Date"]=$data3[$i]["Issue Date"];
             $dataPrepare_hbc[$i]['vdate']= $data3[$i]["vdate"];
             $dataPrepare_hbc[$i]['updated_by']= $data3[$i]["updated_by"];
             $dataPrepare_hbc[$i]['created_by']= $data3[$i]["created_by"];	
           }//hbc

           for ($i=0; $i <count($data4) ; $i++) {
             $dataPrepare_urine[$i]["id"]= $data4[$i]["id"];
             $dataPrepare_urine[$i]["CID"]=$data4[$i]["CID"];
             $dataPrepare_urine[$i]["agey"]=$data4[$i]["agey"];
             $dataPrepare_urine[$i]["agem"]=$data4[$i]["agem"];
             $dataPrepare_urine[$i]["visitDate"]=$data4[$i]["visitDate"];
             $dataPrepare_urine[$i]["fuchiacode"]=$data4[$i]["fuchiacode"];
             $dataPrepare_urine[$i]["Gender"]= Crypt::decrypt_light($data4[$i]["Gender"],$table);
             $dataPrepare_urine[$i]["Main Risk"]=Crypt::decrypt_light($data4[$i]["Main Risk"],$table);
             $dataPrepare_urine[$i]["Sub Risk"]=Crypt::decrypt_light($data4[$i]["Sub Risk"],$table);
             $dataPrepare_urine[$i]["Req_Doctor"]=Crypt::decrypt_light($data4[$i]["Req_Doctor"],$table);


             $dataPrepare_urine[$i]["Utot"]=Crypt::decrypt_light($data4[$i]["Utot"],$table);
             $dataPrepare_urine[$i]["Uapp"]=Crypt::decrypt_light($data4[$i]["Uapp"],$table);
             $dataPrepare_urine[$i]["Uturbitity"]=Crypt::decrypt_light($data4[$i]["Uturbitity"],$table);
             $dataPrepare_urine[$i]["Upus"]=Crypt::decrypt_light($data4[$i]["Upus"],$table);
             $dataPrepare_urine[$i]["ph"]=Crypt::decrypt_light($data4[$i]["ph"],$table);
             $dataPrepare_urine[$i]["Uprotein"]=Crypt::decrypt_light($data4[$i]["Uprotein"],$table);
             $dataPrepare_urine[$i]["Uglucose"]=Crypt::decrypt_light($data4[$i]["Uglucose"],$table);
             $dataPrepare_urine[$i]["Urbc"]=Crypt::decrypt_light($data4[$i]["Urbc"],$table);
             $dataPrepare_urine[$i]["Uleu"]=Crypt::decrypt_light($data4[$i]["Uleu"],$table);
             $dataPrepare_urine[$i]["Unitrite"]=Crypt::decrypt_light($data4[$i]["Unitrite"],$table);
             $dataPrepare_urine[$i]["Uketone"]=Crypt::decrypt_light($data4[$i]["Uketone"],$table);
             $dataPrepare_urine[$i]["Uepithelial"]=Crypt::decrypt_light($data4[$i]["Uepithelial"],$table);
             $dataPrepare_urine[$i]["Urobili"]=Crypt::decrypt_light($data4[$i]["Urobili"],$table);
             $dataPrepare_urine[$i]["Ubillru"]=Crypt::decrypt_light($data4[$i]["Ubillru"],$table);
             $dataPrepare_urine[$i]["Uery"]=Crypt::decrypt_light($data4[$i]["Uery"],$table);
             $dataPrepare_urine[$i]["Ucrystal"]=Crypt::decrypt_light($data4[$i]["Ucrystal"],$table);
             $dataPrepare_urine[$i]["Uhae"]=Crypt::decrypt_light($data4[$i]["Uhae"],$table);
             $dataPrepare_urine[$i]["Uother"]=Crypt::decrypt_light($data4[$i]["Uother"],$table);
             $dataPrepare_urine[$i]["Ucast"]=Crypt::decrypt_light($data4[$i]["Ucast"],$table);
             $dataPrepare_urine[$i]["Ument"]=Crypt::decrypt_light($data4[$i]["comment"],$table);
             $dataPrepare_urine[$i]["Cretinine"]=Crypt::decrypt_light($data4[$i]["Cretinine"],$table);
             $dataPrepare_urine[$i]["Albumin"]=Crypt::decrypt_light($data4[$i]["Albumin"],$table);
             $dataPrepare_urine[$i]["A:C_ratio"]=Crypt::decrypt_light($data4[$i]["A:C_ratio"],$table);
             $dataPrepare_urine[$i]["lab_tech"]=Crypt::decrypt_light($data4[$i]["lab_tech"],$table);
             $dataPrepare_urine[$i]["issue_date"]=$data4[$i]["issue_date"];
             $dataPrepare_urine[$i]['vdate']= $data4[$i]["vdate"];
             $dataPrepare_urine[$i]['updated_by']= $data4[$i]["updated_by"];
             $dataPrepare_urine[$i]['created_by']= $data4[$i]["created_by"];
           }//urine
            
           for ($i=0; $i <count($data5) ; $i++) {
             $dataPrepare_oi[$i]["id"]= $data5[$i]["id"];
             $dataPrepare_oi[$i]["CID"]= $data5[$i]["CID"];
             $dataPrepare_oi[$i]["fuchiacode"]=$data5[$i]["fuchiacode"];
             $dataPrepare_oi[$i]["agey"]=$data5[$i]["agey"];
             $dataPrepare_oi[$i]["agem"]=$data5[$i]["agem"];
             $dataPrepare_oi[$i]["Gender"]= Crypt::decrypt_light($data5[$i]["Gender"],$table);
             $dataPrepare_oi[$i]["visit_date"]=$data5[$i]["visit_date"];
             $dataPrepare_oi[$i]["Main Risk"]=Crypt::decrypt_light($data5[$i]["Main Risk"],$table);
             $dataPrepare_oi[$i]["Sub Risk"]= Crypt::decrypt_light($data5[$i]["Sub Risk"],$table);
             $dataPrepare_oi[$i]["Req_Doctor"]= Crypt::decrypt_light($data5[$i]["Req_Doctor"],$table);
             
             $dataPrepare_oi[$i]["TB_LAM_Report"]=Crypt::decrypt_light($data5[$i]["TB_LAM_Report"],$table);
             $dataPrepare_oi[$i]["Toxo plasma"]=Crypt::decrypt_light($data5[$i]["Toxo plasma"],$table);
             $dataPrepare_oi[$i]["Toxo igG"]=Crypt::decrypt_light($data5[$i]["Toxo igG"],$table);
             $dataPrepare_oi[$i]["Toxo igM"]=Crypt::decrypt_light($data5[$i]["Toxo igM"],$table);

             $dataPrepare_oi[$i]["Serum Result"]=Crypt::decrypt_light($data5[$i]["Serum Result"],$table);
             $dataPrepare_oi[$i]["serum_pos"]=Crypt::decrypt_light($data5[$i]["serum_pos"],$table);
             $dataPrepare_oi[$i]["CSF for Cryptococcal Antigen"]=Crypt::decrypt_light($data5[$i]["CSF for Cryptococcal Antigen"],$table);
             $dataPrepare_oi[$i]["csf_crypto_pos"]=Crypt::decrypt_light($data5[$i]["csf_crypto_pos"],$table);

             $dataPrepare_oi[$i]["csf_fungal"]=Crypt::decrypt_light($data5[$i]["csf_fungal"],$table);
             $dataPrepare_oi[$i]["CSF Smear India Ink"]=Crypt::decrypt_light($data5[$i]["CSF Smear India Ink"],$table);
             $dataPrepare_oi[$i]["CSF Smear Giemsa Stain"]=Crypt::decrypt_light($data5[$i]["CSF Smear Giemsa Stain"],$table);

             $dataPrepare_oi[$i]["skin_fungal"]=Crypt::decrypt_light($data5[$i]["skin_fungal"],$table);
             $dataPrepare_oi[$i]["Skin Smear Giemsa Stain"]=Crypt::decrypt_light($data5[$i]["Skin Smear Giemsa Stain"],$table);
             $dataPrepare_oi[$i]["Skin Smear India Ink"]=Crypt::decrypt_light($data5[$i]["Skin Smear India Ink"],$table);

             $dataPrepare_oi[$i]["lymph_test"]=Crypt::decrypt_light($data5[$i]["lymph_test"],$table);
             $dataPrepare_oi[$i]["lymph Giemsa Stain"]=Crypt::decrypt_light($data5[$i]["Lymph Giemsa Stain"],$table);
             $dataPrepare_oi[$i]["lymph India Ink"]=Crypt::decrypt_light($data5[$i]["Lymph India Ink"],$table);


             $dataPrepare_oi[$i]["Lab Techanician"]= Crypt::decrypt_light($data5[$i]["Lab Techanician"],$table);
             $dataPrepare_oi[$i]['vdate']= $data5[$i]["vdate"];
             $dataPrepare_oi[$i]['issued']= $data5[$i]["issued"];
             $dataPrepare_oi[$i]['updated_by']= $data5[$i]["updated_by"];
             $dataPrepare_oi[$i]['created_by']= $data5[$i]["created_by"];

           }//oi
           
           for ($i=0; $i <count($data6) ; $i++) {
             $dataPrepare_general[$i]["id"]= $data6[$i]["id"];
             $dataPrepare_general[$i]["CID"]= $data6[$i]["CID"];
             $dataPrepare_general[$i]["fuchiacode"]=$data6[$i]["fuchiacode"];
             $dataPrepare_general[$i]["agey"]=$data6[$i]["agey"];
             $dataPrepare_general[$i]["agem"]=$data6[$i]["agem"];
             $dataPrepare_general[$i]["Visit_date"]=$data6[$i]["Visit_date"];
             $dataPrepare_general[$i]["Gender"]= Crypt::decrypt_light($data6[$i]["Gender"],$table);
             $dataPrepare_general[$i]["Patient_Type"]=Crypt::decrypt_light($data6[$i]["Patient_Type"],$table);
             $dataPrepare_general[$i]["Patient Type Sub"]=Crypt::decrypt_light($data6[$i]["Patient Type Sub"],$table);
             $dataPrepare_general[$i]["Req_Doctor"]=Crypt::decrypt_light($data6[$i]["Req_Doctor"],$table);
             $dataPrepare_general[$i]["Lab Tech"]=Crypt::decrypt_light($data6[$i]["Lab Tech"],$table);


             $dataPrepare_general[$i]["Dangue RDT"]=Crypt::decrypt_light($data6[$i]["Dangue RDT"],$table);
             $dataPrepare_general[$i]["NS1 Antigen"]=Crypt::decrypt_light($data6[$i]["NS1 Antigen"],$table);
             $dataPrepare_general[$i]["IgG Result"]=Crypt::decrypt_light($data6[$i]["IgG Result"],$table);
             $dataPrepare_general[$i]["IgM Result"]=Crypt::decrypt_light($data6[$i]["IgM Result"],$table);
             $dataPrepare_general[$i]["Malaria RDT"]=Crypt::decrypt_light($data6[$i]["Malaria RDT"],$table);
             $dataPrepare_general[$i]["Malaria RDT Result"]=Crypt::decrypt_light($data6[$i]["Malaria RDT Result"],$table);
             $dataPrepare_general[$i]["malaria_microscopy"]=Crypt::decrypt_light($data6[$i]["malaria_microscopy"],$table);
             $dataPrepare_general[$i]["Malaria_spec"]=Crypt::decrypt_light($data6[$i]["Malaria_spec"],$table);
             $dataPrepare_general[$i]["Malaria_grade"]=Crypt::decrypt_light($data6[$i]["Malaria_grade"],$table);
             $dataPrepare_general[$i]["Malaria_stage"]=Crypt::decrypt_light($data6[$i]["Malaria_stage"],$table);
             //$dataPrepare_general[$i]["RBS test"]=Crypt::decrypt_light($data6[$i]["RBS test"],$table);
             $dataPrepare_general[$i]["RBS"]=Crypt::decrypt_light($data6[$i]["RBS"],$table);
             //$dataPrepare_general[$i]["FBS test"]=Crypt::decrypt_light($data6[$i]["FBS test"],$table);
             $dataPrepare_general[$i]["FBS"]=Crypt::decrypt_light($data6[$i]["FBS"],$table);
            // $dataPrepare_general[$i]["haemo_done"]=Crypt::decrypt_light($data6[$i]["haemo_done"],$table);
             $dataPrepare_general[$i]["haemoglobin"]=Crypt::decrypt_light($data6[$i]["haemoglobin"],$table);
             $dataPrepare_general[$i]["hba1c"]=Crypt::decrypt_light($data6[$i]["hba1c"],$table);
             //$lat_tech  $dataPrepare_general[$i]["Lab Tech"]=Crypt::decrypt_light($data6[$i]["Lab Tech"],$table);
             $dataPrepare_general[$i]['vdate']= $data6[$i]["vdate"];
             $dataPrepare_general[$i]['Issue Date']= $data6[$i]["Issue Date"];
             $dataPrepare_general[$i]['updated_by']= $data6[$i]["updated_by"];
             $dataPrepare_general[$i]['created_by']= $data6[$i]["created_by"];
           }//general

           for ($i=0; $i <count($data7) ; $i++){
             $dataPrepare_stool[$i]["id"]= $data7[$i]["id"];
             $dataPrepare_stool[$i]["CID"]= $data7[$i]["CID"];
             $dataPrepare_stool[$i]["fuchiacode"]=$data7[$i]["fuchiacode"];
             $dataPrepare_stool[$i]["agey"]=$data7[$i]["agey"];
             $dataPrepare_stool[$i]["agem"]=$data7[$i]["agem"];
             $dataPrepare_stool[$i]["visit_date"]=$data7[$i]["visit_date"];

             $dataPrepare_stool[$i]["Gender"]= Crypt::decrypt_light($data7[$i]["Gender"],$table);
             $dataPrepare_stool[$i]["Patient Type"]=Crypt::decrypt_light($data7[$i]["Patient Type"],$table);
             $dataPrepare_stool[$i]["Patient Type Sub"]=Crypt::decrypt_light($data7[$i]["Patient Type Sub"],$table);
             $dataPrepare_stool[$i]["Req_Doctor"]=Crypt::decrypt_light($data7[$i]["Req_Doctor"],$table);

             $dataPrepare_stool[$i]["st_stool"]=Crypt::decrypt_light($data7[$i]["st_stool"],$table);
             $dataPrepare_stool[$i]["st_colour"]=Crypt::decrypt_light($data7[$i]["st_colour"],$table);
             $dataPrepare_stool[$i]["wbc_pus_cell"]=Crypt::decrypt_light($data7[$i]["wbc_pus_cell"],$table);
             $dataPrepare_stool[$i]["st_consistency"]=Crypt::decrypt_light($data7[$i]["st_consistency"],$table);
             $dataPrepare_stool[$i]["st_rbcs"]=Crypt::decrypt_light($data7[$i]["st_rbcs"],$table);
             $dataPrepare_stool[$i]["st_other"]=Crypt::decrypt_light($data7[$i]["st_other"],$table);
             $dataPrepare_stool[$i]["st_comment"]=$data7[$i]["st_comment"];
             $dataPrepare_stool[$i]["st_lab_tech"]=Crypt::decrypt_light($data7[$i]["st_lab_tech"],$table);
             $dataPrepare_stool[$i]['vdate']= $data7[$i]["vdate"];
             $dataPrepare_stool[$i]['st_issue_date']= $data7[$i]["st_issue_date"];
             $dataPrepare_stool[$i]['updated_by']= $data7[$i]["updated_by"];
             $dataPrepare_stool[$i]['created_by']= $data7[$i]["created_by"];
           }//stool

           for ($i=0; $i < count($data8) ; $i++) {
             $dataPrepare_afb[$i]["id"]= $data8[$i]["id"];
             $dataPrepare_afb[$i]["CID"]= $data8[$i]["CID"];
             $dataPrepare_afb[$i]["fuchiacode"]=$data8[$i]["fuchiacode"];
             $dataPrepare_afb[$i]["agey"]=$data8[$i]["agey"];
             $dataPrepare_afb[$i]["agem"]=$data8[$i]["agem"];
             $dataPrepare_afb[$i]["visit_date"]=$data8[$i]["visit_date"];
             $dataPrepare_afb[$i]["Gender"]=Crypt::decrypt_light($data8[$i]["Gender"],$table);
             $dataPrepare_afb[$i]["Patient Type"]=Crypt::decrypt_light($data8[$i]["Patient Type"],$table);
             $dataPrepare_afb[$i]["Patient Type Sub"]=Crypt::decrypt_light($data8[$i]["Patient Type Sub"],$table);
             $dataPrepare_afb[$i]["Req_Doctor"]=Crypt::decrypt_light($data8[$i]["Req_Doctor"],$table);

             $dataPrepare_afb[$i]["afb_pt_name"]=Crypt::decryptString($data8[$i]["afb_pt_name"],$table);
             $dataPrepare_afb[$i]["afb_pt_address"]=Crypt::decryptString($data8[$i]["afb_pt_address"],$table);
             $dataPrepare_afb[$i]["Previous_TB"]=Crypt::decrypt_light($data8[$i]["Previous_TB"],$table);
             $dataPrepare_afb[$i]["HIV_status"]=Crypt::decrypt_light($data8[$i]["HIV_status"],$table);
             $dataPrepare_afb[$i]["reason_for_exam"]=$data8[$i]["reason_for_exam"];
             $dataPrepare_afb[$i]["afb_Pt_type"]=Crypt::decrypt_light($data8[$i]["afb_Pt_type"],$table);
             $dataPrepare_afb[$i]["follow_up_mt"]=Crypt::decrypt_light($data8[$i]["follow_up_mt"],$table);
             $dataPrepare_afb[$i]["speci_type"]=Crypt::decrypt_light($data8[$i]["speci_type"],$table);
             $dataPrepare_afb[$i]["slide_num_1"]=Crypt::decrypt_light($data8[$i]["slide_num_1"],$table);
             $dataPrepare_afb[$i]["slide_num_2"]=Crypt::decrypt_light($data8[$i]["slide_num_2"],$table);

             $dataPrepare_afb[$i]["visual_app_1"]=Crypt::decrypt_light($data8[$i]["visual_app_1"],$table);
             $dataPrepare_afb[$i]["visual_app_2"]=Crypt::decrypt_light($data8[$i]["visual_app_2"],$table);
             $dataPrepare_afb[$i]["afb_result1"]=Crypt::decrypt_light($data8[$i]["afb_result1"],$table);
             $dataPrepare_afb[$i]["afb_result2"]=Crypt::decrypt_light($data8[$i]["afb_result2"],$table);
             $dataPrepare_afb[$i]["slide1_grading1"]=Crypt::decrypt_light($data8[$i]["slide1_grading1"],$table);
             $dataPrepare_afb[$i]["slide2_grading2"]=Crypt::decrypt_light($data8[$i]["slide2_grading2"],$table);
             $dataPrepare_afb[$i]["afb_lab_techca"]=Crypt::decrypt_light($data8[$i]["afb_lab_techca"],$table);
             $dataPrepare_afb[$i]['vdate']= $data8[$i]["vdate"];
             $dataPrepare_afb[$i]['speci_receive_dt1']= $data8[$i]["speci_receive_dt1"];

             $dataPrepare_afb[$i]['speci_receive_dt2']= $data8[$i]["speci_receive_dt2"];
             $dataPrepare_afb[$i]['afb_issue_date']= $data8[$i]["afb_issue_date"];
             $dataPrepare_afb[$i]['updated_by']= $data8[$i]["updated_by"];
             $dataPrepare_afb[$i]['created_by']= $data8[$i]["created_by"];
           }//afb

           for ($i=0; $i < count($data9) ; $i++) {
             $dataPrepare_covid[$i]["id"]= $data9[$i]["id"];
             $dataPrepare_covid[$i]["CID"]= $data9[$i]["CID"];
             $dataPrepare_covid[$i]["fuchiacode"]=$data9[$i]["fuchiacode"];
             $dataPrepare_covid[$i]["agey"]=$data9[$i]["agey"];
             $dataPrepare_covid[$i]["agem"]=$data9[$i]["agem"];
             $dataPrepare_covid[$i]["visit_date"]=$data9[$i]["visit_date"];
             $dataPrepare_covid[$i]["Gender"]= Crypt::decrypt_light($data9[$i]["Gender"],$table);
             $dataPrepare_covid[$i]["Patient Type"]=Crypt::decrypt_light($data9[$i]["Patient Type"],$table);
             $dataPrepare_covid[$i]["Patient Type Sub"]=Crypt::decrypt_light($data9[$i]["Patient Type Sub"],$table);
             $dataPrepare_covid[$i]["Req_Doctor"]=Crypt::decrypt_light($data9[$i]["Req_Doctor"],$table);

             $dataPrepare_covid[$i]["type_of_patient_covid"]=Crypt::decrypt_light($data9[$i]["type_of_patient_covid"],$table);
             $dataPrepare_covid[$i]["specimen_type"]=Crypt::decrypt_light($data9[$i]["specimen_type"],$table);
             $dataPrepare_covid[$i]["co_test_type"]=Crypt::decrypt_light($data9[$i]["co_test_type"],$table);
             $dataPrepare_covid[$i]["covid_result"]=Crypt::decrypt_light($data9[$i]["covid_result"],$table);
             $dataPrepare_covid[$i]["covid_lab_tech"]=Crypt::decrypt_light($data9[$i]["covid_lab_tech"],$table);
             $dataPrepare_covid[$i]['vdate']= $data9[$i]["vdate"];
             $dataPrepare_covid[$i]['covid_issue_date']= $data9[$i]["covid_issue_date"];
             $dataPrepare_covid[$i]['updated_by']= $data9[$i]["updated_by"];
             $dataPrepare_covid[$i]['created_by']= $data9[$i]["created_by"];

             $dataPrepare_covid[$i]['Comment']= $data9[$i]["Comment"];

           }//covid

           for ($i=0; $i < count($data10) ; $i++) {
             $dataPrepare_viral[$i]["id"]= $data10[$i]["id"];
             $dataPrepare_viral[$i]["CID"]= $data10[$i]["CID"];
             $dataPrepare_viral[$i]["fuchiacode"]=$data10[$i]["fuchiacode"];
             $dataPrepare_viral[$i]["agey"]=$data10[$i]["agey"];
             $dataPrepare_viral[$i]["agem"]=$data10[$i]["agem"];
             $dataPrepare_viral[$i]["vdate"]=$data10[$i]["vdate"];

             $dataPrepare_viral[$i]["Gender"]= Crypt::decrypt_light($data10[$i]["Gender"],$table);
             $dataPrepare_viral[$i]["Main-Risk"]=Crypt::decrypt_light($data10[$i]["Main-Risk"],$table);
             $dataPrepare_viral[$i]["Sub-Risk"]=Crypt::decrypt_light($data10[$i]["Sub-Risk"],$table);
             $dataPrepare_viral[$i]["Req_Doctor"]=Crypt::decrypt_light($data10[$i]["Req_Doctor"],$table);

             $dataPrepare_viral[$i]["ART_ini_date"]=$data10[$i]["ART_ini_date"];
             $dataPrepare_viral[$i]["ART_duration"]=Crypt::decrypt_light($data10[$i]["ART_duration"],$table);
             $dataPrepare_viral[$i]["Result received date"]=$data10[$i]["Result received date"];
             $dataPrepare_viral[$i]["Sample_Ship_Date"]=$data10[$i]["Sample_Ship_Date"];
             $dataPrepare_viral[$i]["Sample Sent to"]=Crypt::decrypt_light($data10[$i]["Sample Sent to"],$table);
             $dataPrepare_viral[$i]["Detect"]=Crypt::decrypt_light($data10[$i]["Detect"],$table);
             $dataPrepare_viral[$i]["Viral Load Result"]=Crypt::decrypt_light($data10[$i]["Viral Load Result"],$table);
             $dataPrepare_viral[$i]["Other org code"]=Crypt::decrypt_light($data10[$i]["Other org code"],$table);
             $dataPrepare_viral[$i]["Remark"]=$data10[$i]["Remark"];
             $dataPrepare_viral[$i]['vdate']= $data10[$i]["vdate"];
             $dataPrepare_viral[$i]['updated_by']= $data10[$i]["updated_by"];
             $dataPrepare_viral[$i]['created_by']= $data10[$i]["created_by"];
           }//viral
            return response()->json([
              $dataPrepare_hiv,
              $dataPrepare_rpr,
              $dataPrepare_sti,
              $dataPrepare_hbc,
              $dataPrepare_urine,
              $dataPrepare_oi,
              $dataPrepare_general,
              $dataPrepare_stool,
              $dataPrepare_afb,
              $dataPrepare_covid,
              $dataPrepare_viral,
              $dataPatient,
            ]);
        }

        // Create new data
         if($insert_row_exist||$test_type=="afb_tab"){
          Patients::where('Pid', $request->cid)->where(function($query) use ($request) {
            $query->orWhere("Main Risk", "731")->orWhere("Main Risk", null);
            })->update([
                "Main Risk" => Crypt::encrypt_light($request->Ptype, $table),
                "Sub Risk" => Crypt::encrypt_light($request->ext_sub, $table),
            ]);
            PtConfig::where('Pid', $request->cid)->where(function($query) use ($request) {
              $query->orWhere("Main Risk", "731")->orWhere("Main Risk", null);
              })->update([
                  "Main Risk" => Crypt::encrypt_light($request->Ptype, $table),
                  "Sub Risk" => Crypt::encrypt_light($request->ext_sub, $table),
            ]);
          if($hiv==2 && $updateID_hiv<1){
            
            $Present_row = Lab::where('CID',$cid)
                                ->whereDate('vdate',$vdate)
                                ->exists();
           if(!$Present_row){
        
           if($hiv && $cid){
             Lab::create([
                   'ClinicName' => $request->clinic,
                   'CID'=>$request->cid ,
                   'fuchiacode'=>$request->fuchiaID ,
                   'agey'=>$request->agey ,
                   'agem'=>$request->agem ,
                   'Visit_date'=>$request->vDate ,
                   'vdate'=>$request->vDate ,
                   'Gender'=>Crypt::encrypt_light($request->gender ,$table),
                   'Patient_Type'=>Crypt::encrypt_light($request->Ptype,$table),
                   'Patient Type Sub'=>Crypt::encrypt_light($request->ext_sub,$table),
                   'bcollectdate'=>$request->bcdate,
                   'Detmine_Result'=>Crypt::encrypt_light($request->d_result,$table),
                   'Unigold_Result'=>Crypt::encrypt_light($request->uni_result ,$table),
                   'STAT_PAK_Result'=>Crypt::encrypt_light($request->stat_result ,$table),
                   'Final_Result'=>Crypt::encrypt_light($request->final_result,$table),
                   'Counsellor'=>Crypt::encrypt_light($request->counsellor,$table),
                   'LabTech'=>Crypt::encrypt_light($request->lab_tech,$table),
                   'Req_Doctor' =>Crypt::encrypt_light($request->reqDoctor,$table),
                   'Issue_Date'=>$request->issue_date,
                   'Incon'=>$request->Incon,
                   'created_by'=>$request->created_by,
                   'Comment'=>$request->Comment,
                   ]);

                   $hiv=0;
                   $success=["name" => "Your data has been successfully collected." ];
                   return response()->json($success);
            }
            }else{
                $dupli = false;
                return response()->json([$dupli]);
            }
          }
          if($rprTest==1 && $updateID_rpr<1){// to collect rpr test results
                          $Present_row = Rprtest::where('pid',$cid)
                          ->whereDate('vdate',$vdate)
                          ->exists();
                if(!$Present_row){
              
                  Rprtest::create([
                    'pid'=>$request->cid,
                    'visit_date'=>$request->vDate,
                    'vdate'=>$request->vDate,
                    'fuchiacode'=> $request->fuchiaID,
                    'agey'=>$request->agey,
                    'agem'=>$request->agem,

                    'Gender'=>Crypt::encrypt_light($request->gender,$table),
                    'Type Of Patient'=>Crypt::encrypt_light($request->Ptype,$table),
                    'Patient Type Sub'=>Crypt::encrypt_light($request->Ptype_ext,$table),

                    'RDT(Yes/No)' =>Crypt::encrypt_light( $request->rdtYes_no,$table),
                    'RDT Result' =>Crypt::encrypt_light( $request->Sy_rdt_result,$table),
                    'Quantitative(Yes/No)'=>Crypt::encrypt_light($request->rprYes_NO,$table),
                    'RPR Qualitative'=>Crypt::encrypt_light($request->qualitative,$table),
                    //'Calendar_Year'=>Crypt::encrypt_light($request->rprPtype,$table),
                    'Titre(current)'=>Crypt::encrypt_light($request->titreCur,$table),
                    'Titre(Last)'=>Crypt::encrypt_light($request->titreLast,$table),
                    'TitreLastDate'=>$request->lastTireDate,

                    'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor,$table),
                    'Counsellor'=>Crypt::encrypt_light($request->rpr_counselor,$table),
                    'Lab Tech'=>Crypt::encrypt_light($request->lab_tech_rpr,$table),

                    'Issue Date'=>$request->rpr_issue_date,

                    'created_by'=>$request->created_by,
                    'Comment'=>$request->Comment,
                  ]);
                  $rprTest=0;
                  $success=[  "name" => "Your data has been successfully collected." ];
                  return response()->json($success);
                  }else{
                    $dupli = false;
                    return response()->json([$dupli]);
                    }
                }
          if($stiTest==1 && $updateID_sti<1){
            $Present_row = Labstitest::where('CID',$cid)
                                    ->whereDate('vdate',$vdate)
                                    ->exists();
                  if(!$Present_row){
                  
                  Labstitest::create([
                  'CID'=>$request->cid,
                  'fuchiacode'=>$request->fuchiaID,
                  'agey'=>$request->agey  ,
                  'agem'=>$request->agem  ,
                  'Gender'=> Crypt::encrypt_light($request->gender,$table),
                  'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor ,$table),
                  
                  'visit_date'=>$request->vDate,
                  'vdate'=>$request->vDate,
                  'Type Of Patient'=>Crypt::encrypt_light($request->Ptype  ,$table),
                  'Patient Type Sub'=>Crypt::encrypt_light($request->ext_sub  ,$table),

                  'Wet Mount clue cell'=>Crypt::encrypt_light($request->clue_cells,$table),
                  'Fornix Clue Cells'=>Crypt::encrypt_light($request->clue_post_fornix  ,$table),
                  //next line*****************************
                  'urethra WBC'=>Crypt::encrypt_light($request->pmnl_urethra ,$table),
                  'Fornix WBC'=>Crypt::encrypt_light($request->pmnl_post_fix,$table),
                  'Endo cervix WBC'=>Crypt::encrypt_light($request->pmnl_endocevix  ,$table),
                  'Rectum WBC'=>Crypt::encrypt_light($request->pmnl_rectum  ,$table),
                  // next line****************************
                  'Wet Mount Trichomonas'=>Crypt::encrypt_light($request->tricho_wet,$table),
                  // next line ***************************
                  'Urethra diplococci intra-cell'=>Crypt::encrypt_light($request->gram_intra_urethra,$table),
                  'Fornix diplococci intra-cell'=>Crypt::encrypt_light($request->gram_intra_postfornix,$table),
                  'Endo cervix diplococci intra-cell'=>Crypt::encrypt_light($request->gram_intra_endo,$table),
                  'Rectum diplococci intra-cell'=>Crypt::encrypt_light($request->gram_intra_rectum  ,$table),
                  // next line **************************
                  'Urethra diplococci extra-cell'=>Crypt::encrypt_light($request->gram_extra_urethra,$table),
                  'Fornix diplococci extra-cell'=>Crypt::encrypt_light($request->gram_extra_postfornix,$table),
                  'Endo cervix diplococci extra-cell'=>Crypt::encrypt_light($request->gram_extra_endo,$table),
                  'Rectum diplococci extra-cell'=>Crypt::encrypt_light($request->gram_extra_rectum  ,$table),
                  // next line ***************************
                  'Wet Mount candida'=>Crypt::encrypt_light($request->candida_wet  ,$table),
                  'Urethra Candida'=>Crypt::encrypt_light($request->candida_urethra  ,$table),
                  'Fornix Candida'=>Crypt::encrypt_light($request->candida_postfornix  ,$table),
                  'Endo cervix Candida'=>Crypt::encrypt_light($request->candida_endo  ,$table),
                  // next line *******************************
                  'wetoth'=>Crypt::encrypt_light($request->Sper_other_wet,$table),
                  //  'uoth'=>Crypt::encrypt_light($request->Sper_other_urethra  ,$table),
                  //  'pfother'=>Crypt::encrypt_light($request->Sper_other_post,$table),
                  //  'eother'=>Crypt::encrypt_light($request->Sper_other_endo,$table),
                  //  'rother'=>Crypt::encrypt_light($request->Sper_other_rectum,$table),
                  // next line *****************************
                  'First Per Urine'=>Crypt::encrypt_light($request->urine_exam_done,$table),
                  'Epithelial cells'=>Crypt::encrypt_light($request->epithelial_cell,$table),
                  //next line*******************************
                  'First Per Urine Diplococci Intra-Cell'=>Crypt::encrypt_light($request->intra_cell,$table),
                  'PMNL cells'=>Crypt::encrypt_light($request->pmnl_cell,$table),
                  //next  line******************************
                  'First Per Urine Diplococci Extra-Cell'=>Crypt::encrypt_light($request->extra_cell,$table),
                  // next line ****************
                    'Other Bacteria'=>Crypt::encrypt_light($request->oth_bact,$table),
                  // End ***********////********************///*********************
                  'Lab Techanician'=>Crypt::encrypt_light($request->sti_lab_tech,$table),
                  'idate'=>$request->sti_issuDate,

                  'created_by'=>$request->created_by,

                  ]);
                    $stiTest=0;
                    $success=[  "name" => "Your data has been successfully collected." ];
                    return response()->json($success);
                  }else{
                    $dupli = false;
                    return response()->json([$dupli]);
                    }
                }
          if($hbcTest==1 && $updateID_hbc<1){
              $Present_row = LabHbcTest::where('CID',$cid)
                                        ->whereDate('vdate',$vdate)
                                        ->exists();
              if(!$Present_row){
                  LabHbcTest::create([
                    'CID'=>$request->cid ,
                    'fuchiacode'=>$request->fuchiaID ,
                    'agey'=>$request->agey ,
                    'agem'=>$request->agem ,
                    'Gender'=>Crypt::encrypt_light($request->gender ,$table),
                    'Visit_date'=>$request->vDate ,
                    'vdate'=>$request->vDate,
                    'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor ,$table),
                    
                    //  'tdate'=>$request->bcdate,
                    'Patient_Type'=>Crypt::encrypt_light($request->Ptype ,$table),
                    'Patient Type Sub'=>Crypt::encrypt_light($request->ext_sub ,$table),
                    //'Hiv status'=>Crypt::encrypt_light($request-> ,$table),
                    'HepB Test'=>Crypt::encrypt_light($request->hepB ,$table),
                    'HepB TOT'=>Crypt::encrypt_light($request->totB ,$table),
                    'HepB Result'=>Crypt::encrypt_light($request->b_result ,$table),
                    'HepC Test'=>Crypt::encrypt_light($request->c_test ,$table),
                    'HepC TOT'=>Crypt::encrypt_light($request->totC ,$table),
                    'HepC Result'=>Crypt::encrypt_light($request->c_result ,$table),
                    'Lab Tech'=>Crypt::encrypt_light($request->c_lab_tech ,$table),
                    'Issue Date'=>$request->c_issueDate,
                    //'Visit ID'=>Crypt::encrypt_light($request-> ,$table),
                    'clinic code'=>$request->clinic ,

                    'created_by'=>$request->created_by,
                  ]);
                  $hbc=0;
                  $success=[  "name" => "Your data has been successfully collected." ];
                  return response()->json($success);
                  }else{
                    $dupli = false;
                    return response()->json([$dupli]);
                    }
                }
          if($urineTest==1 && $updateID_urine<1){
                  $Present_row = Urine::where('CID',$cid)
                                      ->whereDate('vdate',$vdate)
                                      ->exists();
                    if(!$Present_row){
                      Urine::create([
                        'ClinicName'  => $request->clinic,
                        'CID'         =>$request->cid ,
                        'visitDate'   =>$request->vDate,
                        'vdate'=>$request->vDate,
                        'fuchiacode'  =>$request->fuchiaID ,
                        'agey'        =>$request->agey ,
                        'agem'        =>$request->agem ,
                        'Gender'      =>Crypt::encrypt_light($request->gender,$table),
                        'Main Risk'    =>Crypt::encrypt_light($request->Ptype,$table),
                        'Sub Risk' =>Crypt::encrypt_light($request->ext_sub,$table),
                        'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor,$table),

                        'Utest_done'  =>Crypt::encrypt_light( $request->utest_done,$table),
                        'Utot'        =>Crypt::encrypt_light( $request->typeoftest,$table),
                        'Uturbitity'      =>Crypt::encrypt_light( $request->turbitity,$table),
                        'Uapp'        =>Crypt::encrypt_light( $request->appear,$table),// Colour
                        'Upus'        =>Crypt::encrypt_light( $request->pus,$table),

                        'ph'          =>Crypt::encrypt_light( $request->uph,$table),
                        'Uprotein'    =>Crypt::encrypt_light( $request->protein,$table),
                        'Uglucose'    =>Crypt::encrypt_light( $request->glucose,$table),
                        'Urbc'        =>Crypt::encrypt_light( $request->rbc,$table),
                        'Uleu'        =>Crypt::encrypt_light( $request->leu,$table),

                        'Unitrite'    =>Crypt::encrypt_light( $request->nitrite,$table),
                        'Uketone'    =>Crypt::encrypt_light( $request->ketone,$table),
                        'Uepithelial' =>Crypt::encrypt_light( $request->epithelial,$table),
                        'Urobili'     =>Crypt::encrypt_light( $request->robili,$table),
                        'Ubillru'     =>Crypt::encrypt_light( $request->billru,$table),

                        'Uery'        =>Crypt::encrypt_light( $request->ery,$table),
                        'Ucrystal'    =>Crypt::encrypt_light( $request->crystal,$table),
                        'Uhae'        =>Crypt::encrypt_light( $request->hae,$table),
                        'Uother'      =>Crypt::encrypt_light( $request->other,$table),
                        'Ucast'       =>Crypt::encrypt_light( $request->cast,$table),
                        'comment'     =>Crypt::encrypt_light( $request->Ument,$table),

                        'Cretinine'     =>Crypt::encrypt_light( $request->cretinine,$table),
                        'Albumin'     =>Crypt::encrypt_light( $request->albumin,$table),
                        'A:C_ratio'     =>Crypt::encrypt_light( $request->a_c_ratio,$table),

                        'lab_tech'    =>Crypt::encrypt_light( $request->lab_tech,$table),
                        'issue_date'  => $request->issue_date,

                        'created_by'=>$request->created_by,
                    ]);
                        // response to blade
                        $success=[  "name" => "Your data has been successfully collected." ];
                        return response()->json($success);
                        }else{
                          $dupli = false;
                          return response()->json([$dupli]);
                          }
                    }
          if($oiTest==1 && $updateID_oi<1){
                  $Present_row = Lab_oi::where('CID',$cid)
                                      ->whereDate('vdate',$vdate)
                                      ->exists();
                  if(!$Present_row){
                      Lab_oi::create([
                        'CID'                  => $request -> cid ,
                        'fuchiacode'           => $request -> fuchiaID  ,
                        'agey'                 => $request -> agey ,
                        'agem'                 => $request -> agem ,
                        'Gender'               =>Crypt::encrypt_light( $request -> gender ,$table),
                        'Req_Doctor'           =>Crypt::encrypt_light( $request -> reqDoctor ,$table),
                        'visit_date'           =>$request -> vDate,
                        'vdate'                =>$request->vDate,
                        'Main Risk'         =>Crypt::encrypt_light( $request -> Ptype,$table),
                        'Sub Risk'     =>Crypt::encrypt_light( $request -> ext_sub,$table),
                        'clinic code'          =>$request -> clinic,

                        'TB_LAM_Report'        =>Crypt::encrypt_light( $request -> tb_lam_report ,$table),
                        'Serum Result'         =>Crypt::encrypt_light( $request -> serum_cry_antigen ,$table),
                        'serum_pos'            =>Crypt::encrypt_light( $request -> serum_cry_due  ,$table),
                        'CSF for Cryptococcal Antigen'=>Crypt::encrypt_light( $request -> csf_cry_antigen ,$table),
                        'csf_crypto_pos'       =>Crypt::encrypt_light( $request ->csf_due  ,$table),


                        'csf_fungal'           =>Crypt::encrypt_light( $request ->csf_smear ,$table),
                        'CSF Smear Giemsa Stain'=>Crypt::encrypt_light( $request ->giemsa_stain_result  ,$table),
                        'CSF Smear India Ink'  =>Crypt::encrypt_light( $request ->india_ink_result ,$table),

                        'skin_fungal'          =>Crypt::encrypt_light( $request -> skin_smear ,$table),
                        'Skin Smear Giemsa Stain'=>Crypt::encrypt_light( $request -> skin_giemsa_stain_result ,$table),
                        'Skin Smear India Ink' =>Crypt::encrypt_light( $request ->  skin_india_ink_result ,$table),

                        'lymph_test'          =>Crypt::encrypt_light( $request ->lymph_test,$table),
                        'lymph Giemsa Stain'           =>Crypt::encrypt_light( $request ->lymph_giemsa_stain  ,$table),
                        'lymph India Ink'           =>Crypt::encrypt_light( $request ->lymph_india_ink  ,$table),
                        //'sample_type'          =>Crypt::encrypt_light( $request -> type_sample ,$table),

                        'Toxo plasma'  =>Crypt::encrypt_light($request ->toxo_plasma,$table),
                        'Toxo igG'     =>Crypt::encrypt_light($request ->toxo_igG,$table),
                        'Toxo igM'     =>Crypt::encrypt_light($request ->toxo_igm,$table),
                        'Lab Techanician'      =>Crypt::encrypt_light( $request ->oi_lab_tech  ,$table),
                        'issued'               => $request ->oi_issue_date  ,

                        'created_by'=>$request->created_by,
                        //'visitID'
                      ]);
                      $oiTest=0;
                      $success=[  "name" => "Your data has been successfully collected." ];
                      return response()->json($success);
                      }else{
                        $dupli = false;
                        return response()->json([$dupli]);
                        }
                    }
          if($gtTest==1 && $updateID_gt<1){
                  $Present_row = LabGeneralTest::where('CID',$cid)
                                        ->whereDate('vdate',$vdate)
                                        ->exists();
                      if(!$Present_row){
                      LabGeneralTest::create([
                        'CID'                  => $request -> cid ,
                        'fuchiacode'           => $request -> fuchiaID  ,
                        'agey'                 => $request -> agey ,
                        'agem'                 => $request -> agem ,
                        'Gender'               =>Crypt::encrypt_light( $request -> gender ,$table),
                        'Req_Doctor'           =>Crypt::encrypt_light( $request -> reqDoctor ,$table),
                        
                        'Visit_date'           =>$request -> vDate ,
                        'vdate'=>$request->vDate,
                        'Patient_Type'         =>Crypt::encrypt_light( $request -> Ptype,$table),
                        'Patient Type Sub'     =>Crypt::encrypt_light( $request -> ext_sub,$table),
                        'clinic code'          =>Crypt::encrypt_light( $request -> clinic,$table),

                        'Dangue RDT'           =>Crypt::encrypt_light( $request ->dangue_rdt   ,$table),
                        'NS1 Antigen'          =>Crypt::encrypt_light( $request ->NS1_antigen   ,$table),
                        'IgG Result'           =>Crypt::encrypt_light( $request ->igG   ,$table),
                        'IgM Result'           =>Crypt::encrypt_light( $request ->igm   ,$table),
                        'Malaria RDT'          =>Crypt::encrypt_light($request->malaria_rdt_done,$table),
                        'Malaria RDT Result'   =>Crypt::encrypt_light( $request ->malaria_rdt_result  ,$table),
                        'Malaria_spec'         =>Crypt::encrypt_light($request ->mal_spec,$table),
                        'Malaria_grade'        =>Crypt::encrypt_light($request ->mal_grade,$table),
                        'Malaria_stage'        =>Crypt::encrypt_light($request ->mal_stage ,$table),

                        'malaria_microscopy'   =>Crypt::encrypt_light( $request ->malaria_done   ,$table),
                        'Malaria Microscopy Result'=>Crypt::encrypt_light( $request ->malaria_microscopy_result   ,$table),
                        'RBS test'             =>Crypt::encrypt_light( $request->rbs,$table),
                        'RBS'                  =>Crypt::encrypt_light( $request ->rbs_result   ,$table),
                        'FBS test'             =>Crypt::encrypt_light( $request->fbs,$table),
                        'FBS'                  =>Crypt::encrypt_light( $request ->fbs_result   ,$table),
                        'haemo_done'           =>Crypt::encrypt_light($request->gt_haemoglobin,$table),
                        'haemoglobin'          =>Crypt::encrypt_light( $request ->haemoPercent   ,$table),

                        'hba1c'                =>Crypt::encrypt_light( $request ->hba1c   ,$table),
                        //'visitID'              =>Crypt::encrypt_light( $request ->   ,$table),
                        "Lab Tech"             =>Crypt::encrypt_light( $request ->gt_lab_tech    ,$table),
                        "Issue Date"           => $request ->gt_issue_date   ,
                        //"ClinicName"           => $request ->   ,

                        'created_by'=>$request->created_by,


                      ]);
                      $gtTest=0;
                      $success=[  "name" => "Your data has been successfully collected." ];
                      return response()->json($success);
                      }else{
                        $dupli = false;
                        return response()->json([$dupli]);
                        }
                    }
          if($stTest==1 && $updateID_st<1){
                      $Present_row = LabStoolTest::where('CID',$cid)
                                              ->whereDate('vdate',$vdate)
                                              ->exists();
                      if(!$Present_row){
                      LabStoolTest::create([
                        'CID'                  => $request -> cid ,
                        'fuchiacode'           => $request -> fuchiaID  ,
                        'agey'                 => $request -> agey ,
                        'agem'                 => $request -> agem ,
                        'visit_date'           => $request -> vDate  ,
                        'vdate'=>$request->vDate,
                        'Gender'               =>Crypt::encrypt_light( $request -> gender ,$table),
                        'Req_Doctor'     =>Crypt::encrypt_light( $request -> reqDoctor ,$table),
                        'Patient Type'         =>Crypt::encrypt_light( $request -> Ptype,$table),
                        'Patient Type Sub'     =>Crypt::encrypt_light( $request -> ext_sub,$table),
                        'Clinic'               =>Crypt::encrypt_light( $request -> clinic,$table),
                        'st_stool'             =>Crypt::encrypt_light( $request -> st_stool,$table),
                        'st_colour'            =>Crypt::encrypt_light( $request -> st_colour,$table),
                        'wbc_pus_cell'         =>Crypt::encrypt_light( $request -> wbc_pus_cell,$table),
                        'st_consistency'       =>Crypt::encrypt_light( $request -> st_consistency,$table),
                        'st_rbcs'              =>Crypt::encrypt_light( $request -> st_rbcs,$table),
                        'st_other'             =>Crypt::encrypt_light( $request -> st_other,$table),
                        'st_comment'           =>$request -> st_comment,
                        'st_lab_tech'          =>Crypt::encrypt_light( $request -> st_lab_tech,$table),
                        'st_issue_date'        => $request -> st_issue_date,

                        'created_by'=>$request->created_by,
                      ]);
                      $stTest=0;
                      $success=["name" => "Your data has been successfully collected." ];
                      return response()->json($success);
                      }else{
                        $dupli = false;
                        return response()->json([$dupli]);
                        }
                    }
          if($afbTest==1 && $updateID_afb<1){
                      //  $decrypted_string = Crypt::decryptString($encrypted_string); For decryption
                      $ptName = $request -> input('afb_pt_name');
                          $encrypted_Name = Crypt::encryptString($ptName);
                      $ptAddress = $request -> input('afb_pt_address');
                          $encrypted_Address= Crypt::encryptString($ptAddress);

                      $Present_row = LabAfbTest::where('CID',$cid)
                                                  ->whereDate('vdate',$vdate)
                                                  ->exists();
                      if(!$Present_row){
                      LabAfbTest::create([
                        'CID'                  => $request -> cid ,
                        'fuchiacode'           => $request -> fuchiaID  ,
                        'agey'                 => $request -> agey ,
                        'agem'                 => $request -> agem ,
                        'visit_date'           => $request -> vDate  ,
                        'vdate'=>$request->vDate,
                        'clinic code'               => $request -> clinic,
                        'afb_pt_name'          => $encrypted_Name,// Encrypted
                        'afb_pt_address'       => $encrypted_Address,// Encrypted

                        'Gender'               =>Crypt::encrypt_light( $request -> gender ,$table),
                        'Req_Doctor'           =>Crypt::encrypt_light( $request -> reqDoctor ,$table),
                        'Patient Type'         =>Crypt::encrypt_light( $request -> Ptype,$table),
                        'Patient Type Sub'     =>Crypt::encrypt_light( $request -> ext_sub,$table),
                        'Previous_TB'          =>Crypt::encrypt_light( $request -> Previous_TB,$table),
                        'HIV_status'           =>Crypt::encrypt_light( $request -> HIV_status,$table),
                        'reason_for_exam'      =>$request -> reason_for_exam,
                        'afb_Pt_type'          =>Crypt::encrypt_light( $request -> afb_Pt_type,$table),
                        'follow_up_mt'         =>Crypt::encrypt_light( $request -> follow_up_mt,$table),
                        'speci_type'           =>Crypt::encrypt_light( $request -> speci_type,$table),
                        'slide_num_1'          =>Crypt::encrypt_light( $request -> slide_num_1,$table),
                        'slide_num_2'          =>Crypt::encrypt_light( $request -> slide_num_2,$table),
                        'speci_receive_dt1'    =>$request -> speci_receive_dt1,
                        'speci_receive_dt2'    =>$request -> speci_receive_dt2,
                        'visual_app_1'         =>Crypt::encrypt_light( $request -> visual_app_1,$table),
                        'visual_app_2'         =>Crypt::encrypt_light( $request -> visual_app_2,$table),
                        'afb_result1'          =>Crypt::encrypt_light( $request -> afb_result1,$table),
                        'afb_result2'          =>Crypt::encrypt_light( $request -> afb_result2,$table),
                        'slide1_grading1'      =>Crypt::encrypt_light( $request -> sacnty_grading1,$table),
                        'slide2_grading2'      =>Crypt::encrypt_light( $request -> sacnty_grading2,$table),
                        'afb_lab_techca'       =>Crypt::encrypt_light( $request -> afb_lab_tech,$table),

                        'afb_issue_date'       => $request -> afb_issue_date,

                        'created_by'=>$request->created_by,
                      ]);
                      $afbTest=0;
                      $success=[  "name" => "Your data has been successfully collected." ];
                      return response()->json($success);
                      }else{
                        $dupli = false;
                        return response()->json([$dupli]);
                        }
                    }
          if($covidTest==1 && $updateID_covid<1){
            $Present_row = LabCovidTest::where('CID',$cid)
                                      ->whereDate('vdate',$vdate)
                                      ->exists();
              if(!$Present_row){
            LabCovidTest::create([
              'CID'                  => $request -> cid ,
              'fuchiacode'           => $request -> fuchiaID  ,
              'agey'                 => $request -> agey ,
              'agem'                 => $request -> agem ,
              'visit_date'           => $request -> vDate  ,
              'vdate'=>$request->vDate,
              'Clinic'               =>$request -> clinic,
              'Gender'               =>Crypt::encrypt_light( $request ->gender ,$table),
              'Req_Doctor'     =>Crypt::encrypt_light( $request ->reqDoctor ,$table),
              'Patient Type'         =>Crypt::encrypt_light( $request ->Ptype,$table),
              'Patient Type Sub'     =>Crypt::encrypt_light( $request ->ext_sub,$table),
              'type_of_patient_covid'=>Crypt::encrypt_light( $request ->type_of_patient_covid,$table),
              'specimen_type'        =>Crypt::encrypt_light( $request ->specimen_type,$table),
              'co_test_type'         =>Crypt::encrypt_light( $request ->co_test_type,$table),
              'covid_result'         =>Crypt::encrypt_light( $request ->covid_result,$table),
              'covid_lab_tech'       =>Crypt::encrypt_light( $request ->covid_lab_tech,$table),
              'covid_issue_date'     => $request ->covid_issue_date,

              'created_by'=>$request->created_by,
              'Comment'=>$request->co_comment,
            ]);
            $covidTest=0;
            $success=[  "name" => "Your data has been successfully collected." ];
            return response()->json($success);
            }else{
              $dupli = false;
              return response()->json([$dupli]);
              }
          }
          if($viral_loadTest==1 && $updateID_viral<1){
            $Present_row = Viralload::where('CID',$cid)
                                      ->whereDate('vdate',$vdate)
                                      ->exists();
              if(!$Present_row){
            Viralload::create([
              'Clinic'=>$request->clinic ,
              'CID'=>$request->cid ,
              'fuchiacode'=>$request->fuchiaID ,
              'agey'=>$request->agey ,
              'agem'=>$request->agem ,
              //'Visit_date'=>$request->vDate ,
              'ART_ini_date'=> $request->art_initial_date_time ,
              'Sample_Ship_Date'=> $request->sample_ship_date ,
              'vdate'=>$request->vDate,
              'Result received date'=>$request->result_received_date,

              'Main-Risk'=>Crypt::encrypt_light($request->Ptype,$table),
              'Sub-Risk'=>Crypt::encrypt_light($request->ext_sub,$table),

              'Gender'=>Crypt::encrypt_light($request->gender ,$table),
              'Req_Doctor'=>Crypt::encrypt_light($request->reqDoctor ,$table),
              'ART_duration'=>Crypt::encrypt_light($request->art_duration,$table),
              'Sample Sent to'=>Crypt::encrypt_light($request->sample_sent_to ,$table),
              'Detect'=>Crypt::encrypt_light($request->detectable ,$table),
              'Viral Load Result'=>Crypt::encrypt_light( $request->viral_load_result ,$table),
              'Other org code'=>Crypt::encrypt_light( $request->other_org_code ,$table),

              'Remark'=> $request->remark  ,

              'created_by'=>$request->created_by,

            ]);
            $hbc=0;
            $success=[  "name" => "Your data has been successfully collected." ];
            return response()->json([$success,$test_type]);
            }else{
              $dupli = false;
              return response()->json([$dupli]);
              }
          }
         }else{
          $success=[
          "name" => "This ID Don't pass Reception center" ];
          return response()->json([$success,$test_type]);
         }
        
    }
     function hiv_data_drawer($request){
       $test_title ="HIV";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =Lab::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Patient_Type"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);
       $det=Crypt::decrypt_light($data[0]["Detmine_Result"],$table);
       $uni=Crypt::decrypt_light($data[0]["Unigold_Result"],$table);
       $stat=Crypt::decrypt_light($data[0]["STAT_PAK_Result"],$table);
       $final=Crypt::decrypt_light($data[0]["Final_Result"],$table);
       //$req_old=Crypt::decrypt_light($data[0]["Req_Doct_old"],$table);
       $req=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $coun=Crypt::decrypt_light($data[0]["Counsellor"],$table);
       $labTech=Crypt::decrypt_light($data[0]["LabTech"],$table);

       return response()->json([
         $test_title,
         $data,
         $gen,
         $risk,
         $sub_risk,
         $det,
         $uni,
         $stat,
         $final,
         //$req_old,
         $req,//9
         $coun,
         $labTech
       ]);

     }
     function rpr_data_drawer($request){
       $test_title ="RPR";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =Rprtest::where('pid',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Type Of Patient"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);

        $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
        $Counsellor=Crypt::decrypt_light($data[0]["Counsellor"],$table);
        $RDT_yes_no=Crypt::decrypt_light($data[0]["RDT(Yes/No)"],$table);
        $rdt_result=Crypt::decrypt_light($data[0]["RDT Result"],$table);
        $rpr_yes_no=Crypt::decrypt_light($data[0]["Quantitative(Yes/No)"],$table);
        $rpr_result=Crypt::decrypt_light($data[0]["RPR Qualitative"],$table);
        $titre_cur=Crypt::decrypt_light($data[0]["Titre(current)"],$table);
        $titre_last=Crypt::decrypt_light($data[0]["Titre(Last)"],$table);
       //
        $lab_tech=Crypt::decrypt_light($data[0]["Lab Tech"],$table);


       return response()->json([
         $test_title,
         $data,

         $gen,
         $risk,
         $sub_risk,
         $md,
         $Counsellor,
         $RDT_yes_no,
         $rdt_result,
         $rpr_yes_no,
         $rpr_result,
         $titre_cur,
         $titre_last,
        $lab_tech,

       ]);
     }
     function sti_data_drawer($request){
       $test_title ="STI";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =Labstitest::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Patient_Type"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);

       $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $wet_mount_clue_cell   =Crypt::decrypt_light($data[0]["Wet Mount clue cell"],$table);
       $fornix_clue_cell      =Crypt::decrypt_light($data[0]["Fornix Clue Cells"],$table);
       $urethra_wbc           =Crypt::decrypt_light($data[0]["urethra WBC"],$table);
       $fornix_wbc            =Crypt::decrypt_light($data[0]["Fornix WBC"],$table);
       $endo_cervix_wbc       =Crypt::decrypt_light($data[0]["Endo cervix WBC"],$table);
       $rectum_wbc            =Crypt::decrypt_light($data[0]["Rectum WBC"],$table);
       $wet_mount_trico       =Crypt::decrypt_light($data[0]["Wet Mount Trichomonas"],$table);
       $urethra_diplo_intra_cell=Crypt::decrypt_light($data[0]["Urethra diplococci intra-cell"],$table);
       $fornix_diplo_intra_cell=Crypt::decrypt_light($data[0]["Fornix diplococci intra-cell"],$table);
       $endo_cervix_diplo_intra_cell=Crypt::decrypt_light($data[0]["Endo cervix diplococci intra-cell"],$table);
       $rectum_diplo_intra_cell=Crypt::decrypt_light($data[0]["Rectum diplococci intra-cell"],$table);
       $urethra_diplo_extra_cell=Crypt::decrypt_light($data[0]["Urethra diplococci extra-cell"],$table);
       $fornix_diplo_extra_cell=Crypt::decrypt_light($data[0]["Fornix diplococci extra-cell"],$table);
       $endo_cervix_diplo_extra_cell=Crypt::decrypt_light($data[0]["Endo cervix diplococci extra-cell"],$table);
       $rectum_diplo_extra_cell=Crypt::decrypt_light($data[0]["Rectum diplococci extra-cell"],$table);
       $wet_mount_candida=Crypt::decrypt_light($data[0]["Wet Mount candida"],$table);
       $urethra_dandida=Crypt::decrypt_light($data[0]["Urethra Candida"],$table);
       $fornix_candida=Crypt::decrypt_light($data[0]["Fornix Candida"],$table);
       $endo_cervix_candida=Crypt::decrypt_light($data[0]["Endo cervix Candida"],$table);
       $wet_oth=Crypt::decrypt_light($data[0]["wetoth"],$table);
       $uoth=Crypt::decrypt_light($data[0]["uoth"],$table);
       $pfother=Crypt::decrypt_light($data[0]["pfother"],$table);
       $eother=Crypt::decrypt_light($data[0]["eother"],$table);
       $rother=Crypt::decrypt_light($data[0]["rother"],$table);
       $first_per_urine=Crypt::decrypt_light($data[0]["First Per Urine"],$table);
       $epithelial_cell=Crypt::decrypt_light($data[0]["Epithelial cells"],$table);
       $fpu_diplo_intra_cell=Crypt::decrypt_light($data[0]["First Per Urine Diplococci Intra-Cell"],$table);
       $pmnl_cells=Crypt::decrypt_light($data[0]["PMNL cells"],$table);
       $fpu_diplo_extra_cell=Crypt::decrypt_light($data[0]["First Per Urine Diplococci Extra-Cell"],$table);
       $other_bacteria=Crypt::decrypt_light($data[0]["Other Bacteria"],$table);
       //$lab_tech=Crypt::decrypt_light($data[0]["Lab Techanician"],$table);



       return response()->json([

         $test_title,
         $data,

         $gen,
         $risk,
         $sub_risk,

         $md,
         $wet_mount_clue_cell   ,//6
         $fornix_clue_cell      ,//7
         $urethra_wbc           ,//8
         $fornix_wbc            ,//9
         $endo_cervix_wbc       ,//10
         $rectum_wbc            ,//11
         $wet_mount_trico       ,//12
         $urethra_diplo_intra_cell,//13
         $fornix_diplo_intra_cell,// 14
         $endo_cervix_diplo_intra_cell,//15
         $rectum_diplo_intra_cell,//16
         $urethra_diplo_extra_cell,//17
         $fornix_diplo_extra_cell,//18
         $endo_cervix_diplo_extra_cell,//19
         $rectum_diplo_extra_cell,//20
         $wet_mount_candida,//21
         $urethra_dandida,// 22
         $fornix_candida,//23
         $endo_cervix_candida,//24
         $wet_oth,//25
         $uoth,//26
         $pfother,//27
         $eother,//28
         $rother,//29
         $first_per_urine,//30
         $epithelial_cell,//31
         $fpu_diplo_intra_cell,//32
         $pmnl_cells,//33
         $fpu_diplo_extra_cell,//34
         $other_bacteria,//35
        // $lab_tech,//36


       ]);
     }
     function hepb_c_data_drawer($request){
       $test_title ="HBC";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =LabHbcTest::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Patient_Type"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);

       $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $hep_b_test    =Crypt::decrypt_light($data[0]["HepB Test"],$table);
       $hep_b_result=Crypt::decrypt_light($data[0]["HepB Result"],$table);
       $hep_c_test=Crypt::decrypt_light($data[0]["HepC Test"],$table);
       $hep_c_resutl=Crypt::decrypt_light($data[0]["HepC Result"],$table);
       $lab_tech=Crypt::decrypt_light($data[0]["Lab Tech"],$table);



       return response()->json([

         $test_title,
         $data,
         $gen,
         $risk,
         $sub_risk,
         $md,//5
         $hep_b_test,//6
         $hep_b_result,//7
         $hep_c_test,//8
         $hep_c_resutl,//9
         $lab_tech,//10

       ]);
     }
     function urine_data_drawer($request){
       $test_title ="Urine";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =Urine::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Main Risk"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Sub Risk"],$table);
       $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $utot=Crypt::decrypt_light($data[0]["Utot"],$table);
       $uapp=Crypt::decrypt_light($data[0]["Uapp"],$table);
       $ucolor=Crypt::decrypt_light($data[0]["Uturbitity"],$table);
       $upus=Crypt::decrypt_light($data[0]["Upus"],$table);
       $uph=Crypt::decrypt_light($data[0]["ph"],$table);
       $uprotein=Crypt::decrypt_light($data[0]["Uprotein"],$table);
       $uglucose=Crypt::decrypt_light($data[0]["Uglucose"],$table);
       $urbc=Crypt::decrypt_light($data[0]["Urbc"],$table);
       $uleu=Crypt::decrypt_light($data[0]["Uleu"],$table);
       $unitrite=Crypt::decrypt_light($data[0]["Unitrite"],$table);
       $uketone=Crypt::decrypt_light($data[0]["Uketone"],$table);
       $uepithelial=Crypt::decrypt_light($data[0]["Uepithelial"],$table);
       $urobili=Crypt::decrypt_light($data[0]["Urobili"],$table);
       $ubrillru=Crypt::decrypt_light($data[0]["Ubillru"],$table);
       $uery=Crypt::decrypt_light($data[0]["Uery"],$table);
       $ucrystal=Crypt::decrypt_light($data[0]["Ucrystal"],$table);
       $uhae=Crypt::decrypt_light($data[0]["Uhae"],$table);
       $uother=Crypt::decrypt_light($data[0]["Uother"],$table);
       $ucast=Crypt::decrypt_light($data[0]["Ucast"],$table);
       $ucomment=Crypt::decrypt_light($data[0]["comment"],$table);
       $ucretinine=Crypt::decrypt_light($data[0]["Cretinine"],$table);
       $albumin=Crypt::decrypt_light($data[0]["Albumin"],$table);
       $ac_ratio=Crypt::decrypt_light($data[0]["A:C_ratio"],$table);
       $lab_tech=Crypt::decrypt_light($data[0]["lab_tech"],$table);



       return response()->json([

         $test_title,
         $data,
         $gen,//2
         $risk,//3
         $sub_risk,//4

         $gen  ,//5
         $risk  ,//6
         $sub_risk  ,//7
         $md  ,//8
         $utot  ,//9
         $uapp  ,//10
         $ucolor  ,//11
         $upus  ,//12
         $uph  ,//13
         $uprotein  ,//14
         $uglucose  ,//15
         $urbc  ,//16
         $uleu  ,//17
         $unitrite  ,//18
         $uketone  ,//19
         $uepithelial  ,//20
         $urobili  ,//21
         $ubrillru  ,//22
         $uery  ,//23
         $ucrystal  ,//24
         $uhae  ,//25
         $uother  ,//26
         $ucast  ,//27
         $ucomment  ,//28
         $ucretinine  ,//29
         $albumin  ,//30
         $ac_ratio  ,//31
         $lab_tech  ,//32


       ]);
     }
     function oi_data_drawer($request){
       $test_title ="OI";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =Lab_oi::where('CID',$PtID)->where('id','=',$rowID)->get();


       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Patient_Type"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);
       $tb_lam_report=Crypt::decrypt_light($data[0]["TB_LAM_Report"],$table);
       $toxo_plasma=Crypt::decrypt_light($data[0]["Toxo plasma"],$table);
       $toxo_igG=Crypt::decrypt_light($data[0]["Toxo igG"],$table);
       $toxo_igM=Crypt::decrypt_light($data[0]["Toxo igM"],$table);
       $serum_result=Crypt::decrypt_light($data[0]["Serum Result"],$table);
       $serum_pos=Crypt::decrypt_light($data[0]["serum_pos"],$table);
       $csf_cry_antigen=Crypt::decrypt_light($data[0]["CSF for Cryptococcal Antigen"],$table);
       $csf_cry_pos=Crypt::decrypt_light($data[0]["csf_crypto_pos"],$table);

       $csf_fungal=Crypt::decrypt_light($data[0]["csf_fungal"],$table);
       $csf_smear_india_ink=Crypt::decrypt_light($data[0]["CSF Smear India Ink"],$table);
       $csf_smear_giemsa_stain=Crypt::decrypt_light($data[0]["CSF Smear Giemsa Stain"],$table);

       $skin_fungal=Crypt::decrypt_light($data[0]["skin_fungal"],$table);
       $skin_smear_giemsa_stain=Crypt::decrypt_light($data[0]["Skin Smear Giemsa Stain"],$table);
       $skin_smear_india_ink=Crypt::decrypt_light($data[0]["Skin Smear India Ink"],$table);

       $lymph_test=Crypt::decrypt_light($data[0]["lymph_test"],$table);
       $lymph_giemsa_stain=Crypt::decrypt_light($data[0]["lymph Giemsa Stain"],$table);
       $lymph_india_ink=Crypt::decrypt_light($data[0]["lymph India Ink"],$table);

       $md= Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $lab_tech= Crypt::decrypt_light($data[0]["Lab Techanician"],$table);

       return response()->json([

         $test_title,//0
         $data,//1
         $gen,//2
         $risk,//3
         $sub_risk,//4
         $gen,    //5
         $risk,    //6
         $sub_risk,    //7
         $tb_lam_report,    //8
         $toxo_plasma,    //9
         $toxo_igG,    //10
         $toxo_igM,    //11
         $serum_result,    //12
         $serum_pos,    //13
         $csf_cry_antigen,    //14
         $csf_cry_pos,    //15

         $csf_fungal,//16
         $csf_smear_india_ink,//17
         $csf_smear_giemsa_stain,//18

         $skin_fungal,//19
         $skin_smear_giemsa_stain,//20
         $skin_smear_india_ink,//21

         $lymph_test,//22
         $lymph_giemsa_stain,//23
         $lymph_india_ink,//24
         $md,//25
         $lab_tech,//26


       ]);
     }
     function gen_data_drawer($request){
       $test_title ="General";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =LabGeneralTest::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Patient_Type"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);
       $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $dangue_rdt=Crypt::decrypt_light($data[0]["Dangue RDT"],$table);
       $ns1_antigen=Crypt::decrypt_light($data[0]["NS1 Antigen"],$table);
       $igG_result=Crypt::decrypt_light($data[0]["IgG Result"],$table);
       $igM_result=Crypt::decrypt_light($data[0]["IgM Result"],$table);
       $malaria_rdt=Crypt::decrypt_light($data[0]["Malaria RDT"],$table);
       $malaria_rdt_result=Crypt::decrypt_light($data[0]["Malaria RDT Result"],$table);
       $malaria_microscopy=Crypt::decrypt_light($data[0]["malaria_microscopy"],$table);
       $malaria_spec=Crypt::decrypt_light($data[0]["Malaria_spec"],$table);
       $malaria_grade=Crypt::decrypt_light($data[0]["Malaria_grade"],$table);
       $malaria_stage=Crypt::decrypt_light($data[0]["Malaria_stage"],$table);
       $rbs_test=Crypt::decrypt_light($data[0]["RBS test"],$table);
       $rbs=Crypt::decrypt_light($data[0]["RBS"],$table);
       $fbs_test=Crypt::decrypt_light($data[0]["FBS test"],$table);
       $fbs=Crypt::decrypt_light($data[0]["FBS"],$table);
       $haemo_done=Crypt::decrypt_light($data[0]["haemo_done"],$table);
       $haemoglobin=Crypt::decrypt_light($data[0]["haemoglobin"],$table);
       $hba1c=Crypt::decrypt_light($data[0]["hba1c"],$table);
       //$lat_tech=Crypt::decrypt_light($data[0]["Lab Tech"],$table);


       return response()->json([

         $test_title,//0
         $data,//1
         $gen,//2
         $risk,//3
         $sub_risk,//4

         $md,     // 5
         $dangue_rdt,     //6
         $ns1_antigen,     //7
         $igG_result,     //8
         $igM_result,     //9
         $malaria_rdt,     //10
         $malaria_rdt_result,     //11
         $malaria_microscopy,     //12
         $malaria_spec,     //13
         $malaria_grade,     //14
         $malaria_stage,     // 15
         $rbs_test,     //16
         $rbs,     // 17
         $fbs_test,     // 18
         $fbs,     //19
         $haemo_done,     //20
         $haemoglobin,     // 21
         $hba1c,     // 22
         //$lat_tech,     // 23

       ]);
     }
     function st_data_drawer($request){
       $test_title ="Stool";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =LabStoolTest::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Patient Type"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);
       $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $st_stool=Crypt::decrypt_light($data[0]["st_stool"],$table);
       $st_colour=Crypt::decrypt_light($data[0]["st_colour"],$table);
       $wbc_pus_cell=Crypt::decrypt_light($data[0]["wbc_pus_cell"],$table);
       $consistency=Crypt::decrypt_light($data[0]["st_consistency"],$table);
       $rbcs=Crypt::decrypt_light($data[0]["st_rbcs"],$table);
       $other=Crypt::decrypt_light($data[0]["st_other"],$table);
       //$comment=Crypt::decrypt_light($data[0]["st_comment"],$table);
       $st_lab_tech=Crypt::decrypt_light($data[0]["st_lab_tech"],$table);



       return response()->json([

         $test_title,//0
         $data,//1
         $gen,//2
         $risk,//3
         $sub_risk,//4

         $md ,    //5
         $st_stool ,    //6
         $st_colour ,    //7
         $wbc_pus_cell ,    //8
         $consistency ,    //9
         $rbcs ,    //10
         $other ,    //11
         //$comment ,    //12
         $st_lab_tech ,    //13

       ]);
     }
     function afb_data_drawer($request){
       $test_title ="AFB";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =LabAfbTest::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Patient Type"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);
       $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $pt_name=Crypt::decryptString($data[0]["afb_pt_name"],$table);
       $pt_address=Crypt::decryptString($data[0]["afb_pt_address"],$table);
       $previous_tb=Crypt::decrypt_light($data[0]["Previous_TB"],$table);
       $hiv_status=Crypt::decrypt_light($data[0]["HIV_status"],$table);
       $reason=Crypt::decrypt_light($data[0]["reason_for_exam"],$table);
       $afb_pt_type=Crypt::decrypt_light($data[0]["afb_Pt_type"],$table);
       $follow_up_mt=Crypt::decrypt_light($data[0]["follow_up_mt"],$table);
       $speci_type=Crypt::decrypt_light($data[0]["speci_type"],$table);
       $slide_num_1=Crypt::decrypt_light($data[0]["slide_num_1"],$table);
       $slide_num_2=Crypt::decrypt_light($data[0]["slide_num_2"],$table);

       $visual_app_1=Crypt::decrypt_light($data[0]["visual_app_1"],$table);
       $visula_app_2=Crypt::decrypt_light($data[0]["visual_app_2"],$table);
       $afb_result1=Crypt::decrypt_light($data[0]["afb_result1"],$table);
       $afb_result2=Crypt::decrypt_light($data[0]["afb_result2"],$table);
       $slide1_grading1=Crypt::decrypt_light($data[0]["slide1_grading1"],$table);
       $slide2_grading2=Crypt::decrypt_light($data[0]["slide2_grading2"],$table);
       $lab_tech=Crypt::decrypt_light($data[0]["afb_lab_techca"],$table);



       return response()->json([

         $test_title,//0
         $data,//1
         $gen,//2
         $risk,//3
         $sub_risk,//4


         $md ,    //5
         $pt_name, //6
         $pt_address, //7
         $previous_tb ,    //8
         $hiv_status ,    //9
         $reason ,    //10
         $afb_pt_type ,    //11
         $follow_up_mt ,    //12
         $speci_type ,    //13
         $slide_num_1 ,    //14
         $slide_num_2 ,    //15

         $visual_app_1 ,    //16
         $visula_app_2 ,    //17
         $afb_result1 ,    //18
         $afb_result2 ,    //19
         $slide1_grading1 ,    //20
         $slide2_grading2 ,    //21
         $lab_tech ,    //22


       ]);
     }
     function covid_data_drawer($request){
       $test_title ="Covid";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =LabCovidTest::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);
       $risk=Crypt::decrypt_light($data[0]["Patient Type"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Patient Type Sub"],$table);
       $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $co_age=Crypt::decrypt_light($data[0]["co_Age"],$table);
       $top_covid=Crypt::decrypt_light($data[0]["type_of_patient_covid"],$table);
       $speci_type=Crypt::decrypt_light($data[0]["specimen_type"],$table);
       $co_test_type=Crypt::decrypt_light($data[0]["co_test_type"],$table);
       $covid_result=Crypt::decrypt_light($data[0]["covid_result"],$table);
       $lab_tech=Crypt::decrypt_light($data[0]["covid_lab_tech"],$table);



       return response()->json([

         $test_title,//0
         $data,//1
         $gen,//2
         $risk,//3
         $sub_risk,//4
         $md ,  //5
         $co_age ,  //6
         $top_covid ,  //7
         $speci_type ,  //8
         $co_test_type ,  //9
         $covid_result ,  //10
         $lab_tech ,  //11

       ]);
     }
     function viral_load_data_drawer($request){
       $test_title ="Viral_load";
       $table="General";
       $PtID  = $request  ->input('PtID');
       $rowID  = $request  ->input('rowID');

       $data =Viralload::where('CID',$PtID)->where('id','=',$rowID)->get();

       $gen= Crypt::decrypt_light($data[0]["Gender"],$table);

       $risk=Crypt::decrypt_light($data[0]["Main-Risk"],$table);
       $sub_risk=Crypt::decrypt_light($data[0]["Sub-Risk"],$table);
       $md=Crypt::decrypt_light($data[0]["Req_Doctor"],$table);
       $art_duration=Crypt::decrypt_light($data[0]["ART_duration"],$table);
       $sample_sent_loco=Crypt::decrypt_light($data[0]["Sample Sent to"],$table);
       $viral_load_result=Crypt::decrypt_light($data[0]["Viral Load Result"],$table);
       $other_org_code=Crypt::decrypt_light($data[0]["Other org code"],$table);
       $remark=Crypt::decrypt_light($data[0]["Remark"],$table);


       return response()->json([

         $test_title,//0
         $data,//1
         $gen,//2
         $risk,//3
         $sub_risk,//4
         $md,//5
         $art_duration,//6
         $sample_sent_loco,//7
         $viral_load_result,//8
         $other_org_code,//9
         $remark//10

       ]);
     }

  public function export(Request $data){
      $from = $data->input('dateFrom');
      $date_from = DateTime::createFromFormat('d-m-Y', $from);
      $from = $date_from->format('Y-m-d');

      $to = $data->input('dateTo');
      $date_to = DateTime::createFromFormat('d-m-Y', $to);
      $to = $date_to->format('Y-m-d');

      $testName = $data->input('testNN');

      $users=0; $users1=0;$users2=0;
      $target_id="CID";

      switch ($testName) {
            
              case 'hiv':
                $DB="Lab";
                $export_name="lab_hiv_test";
                break;
              case 'rpr':
                $DB="Rprtest";
                $target_id="pid";
                $export_name="lab_rpr_test";
                break;
              case 'sti':
                $DB="Labstitest";
                $export_name="lab_sti_test";
                break;
              case 'hep_bc':
                $DB="LabHbcTest";
                $export_name="lab_hep_bc_test";
                break;
              case 'urine':
                $DB="Urine";
                $export_name="lab_urine_test";
                break;
              case 'oi':
                $DB="Lab_oi";
                $export_name="lab_oi_test";
                break;
              case 'general':
                $DB="LabGeneralTest";
                $export_name="lab_general_test";
                break;
              case 'stool':
                $DB="LabStoolTest";
                $export_name="lab_stool_test";
                break;
              case 'afb':
                $DB="LabAfbTest";
                $export_name="lab_afb_test";
                break;
              case 'covid19':
                $DB="LabCovidTest";
                $export_name="lab_covid_test";
                break;
              case 'viral':
                $DB="Viralload";
                $export_name="lab_viralload_test";
                break;
      };

      $modelClassName = 'App\\Models\\' . $DB; // extend model
      $model = app()->make($modelClassName);// resolves the model from the service container.
      $users =$model->whereBetween('vdate', [$from,$to])->with([
        'ptconfig' => function ($query) {
            $query->select("Pid",'Name', 'Township','Region','Quarter','Date of Birth','Agey','Agem',"Main Risk","Sub Risk","Gender"); // Select the specific columns from ptconfig
        }
      ])->get();
      if($testName=="hep_bc"){
        foreach ($users as $key => $value) {
          $hiv_data=Lab::select("Final_Result","Unigold_Result")->where("CID",$value["CID"])->latest("vdate")->first();
          if($hiv_data){
            $value["Hiv status"]=$hiv_data["Final_Result"];
          }
          
        }
       
      }
      return Excel::download(new LabExport($users,$testName), $export_name.'-'.date('d-m-Y').'--'.date('d-m-Y').'-.xlsx');
  }

}
