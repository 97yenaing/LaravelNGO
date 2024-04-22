<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\Stimale;
use App\Models\Stifemale;
use App\Models\HtyANcdFollowup;
use App\Models\Followup_general;
use App\Models\PtConfig;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;


use App\Exports\PatientsExport;

// Exports
use App\Exports\Reception\ReceptionExport;
use Illuminate\Database\Eloquent\Builder;
use DateTime;
class ReceptionController extends Controller
{
  public function patients(){
    // $patients = Patients::latest()->paginate(50);
    // return view (
    //   'Reception.patients',['patients' => $patients
    // ]);

    $patients = Followup_general::all();
    return view (
      'Reception.patients',['patients' => $patients]
    );
  }
  public function general_patients(){
    $patients_gt = Patients::latest()->paginate(50);
    return view (
      'Reception.generalPatient',['gt_patients' => $patients_gt
    ]);


  }

   public function Reception_View()
       {

         $lastPt = PtConfig::where('Mode', '=', 0)
          ->where('Clinic Code', '=', 81)
          ->where('Pid','like','81%')

          ->orderBy('Pid', 'desc')
          //->orderBy('Reg Date', 'desc')
          //->get();
          //->orderBy('id', 'desc')
         ->limit(1)->get();

        return view('Reception.Reception',['lastPt'=> $lastPt]);

       }
   public function add_new_follow_up( $request)
   {
     $gid    = $request->input('gid');
     $vDate = $request->input('vdate');
     $fuchiaID= $request->input('fuchiaID');
     $ckID   = $request->input('ckID');
     $pt_ID  = $request->input('Pt_ID');
     $shar   = $request->input('search_par');
   }


   public function reception_data(Request $request){
     $functionLoco   = $request->input('functionLoco');
     switch ($functionLoco) {
       case 1:
         return $this->search_genID_existing($request);
         break;
       case 2:
        return $this->search_fuchia_eixsting($request);
        break;
       case 3:
        return $this->add_new_pt($request);
        break;
       case 4:
        return $this->add_follow_up($request);
        break;
       case 5:
        return $this->search_to_update($request);
        break;
       case 6:
        return $this->update_new_old_pt_data($request);
        break;
       case 7:
        return $this->search_genID_existing_return($request);
        break;
       case 8:
        return $this->search_fuchia_existing_return($request);
        break;
       case 9:
        return $this->save_next_diagnosis($request);
        break;
       case 10:
        return $this->nextappointment_list_show($request);
        break;
       case 11:
        return $this->show_followup_history($request);
        break;
       case 12:
        return $this->followup_update_filler($request);
        break;
       case 13:
         return $this->to_update_followup_data($request);
         break;

       default:
         // code...
         break;
     }


   }

   public function search_genID_existing($request)//1
   {
    $gid    = $request->input('gid');
    $ckID   = $request->input('ckID');
    if($ckID ==1){ //to check the patient is in general patients list
        $patientData = PtConfig::where('Pid','=',$gid)->first();
        $followupData = Followup_general::where('Pid','=',$gid)->latest()->first();// Follow up  last

        if($patientData != null){
          $ptNameDecrypt = $patientData["Name"];
          $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);

          $ptFather = $patientData["Father"];
          $ptFather = Crypt::decryptString($ptFather);

          $dob = $patientData["Date of Birth"];
          $dob = Crypt::decryptString($dob);

          $region = $patientData["Region"];
          $region = Crypt::decryptString($region);

          $town = $patientData["Township"];
          $town = Crypt::decryptString($town);

          $quarter = $patientData["Quarter"];
          $quarter = Crypt::decryptString($quarter);

          $table = "General";
          $gender = $patientData["Gender"];
          $gender = Crypt::decrypt_light($gender,$table);
          //$text = Crypt::decrypt_light($gender,$tableKey);
          //$ptPhone = Crypt::decryptString($ptPhone);


          return response()->json([
            $patientData,$ptNameDecrypt,$ptFather,$dob,$region,$town,$quarter,$followupData,$gender

          ]);
          $ckID =0;
        }
        else
        {
            $err =null;
            return response()->json([
              $err
            ]);
            $ckID =0;
        }

    }
   }
   public function search_fuchia_eixsting($request)//2
   {
     $gid    = $request->input('gid');
     $fuID = $request->input('fuID');
     $fuchiaShar= $request->input('fuchiaShar');
     if($fuchiaShar==1){
       $patientData_fu = PtConfig::where('FuchiaID',$fuID)->first();
       $followupData = Followup_general::where('Pid','=',$gid)->latest()->first();// Follow up  last

       if($patientData_fu != null){
         $ptNameDecrypt = $patientData_fu["Name"];
         $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);

         $ptFather = $patientData_fu["Father"];
         $ptFather = Crypt::decryptString($ptFather);

                     $dob = $patientData_fu["Date of Birth"];
                     $dob = Crypt::decryptString($dob);

                     $region = $patientData_fu["Region"];
                     $region = Crypt::decryptString($region);

                     $town = $patientData_fu["Township"];
                     $town = Crypt::decryptString($town);

                     $quarter = $patientData_fu["Quarter"];
                     $quarter = Crypt::decryptString($quarter);

                     $phone = $patientData_fu["Phone"];
                     $phone = Crypt::decryptString($phone);

         return response()->json([
           $patientData_fu,$ptNameDecrypt,$ptFather,$dob,$region,$town,$quarter,$phone,$followupData
         ]);
         $fuchiaShar =0;
       }else{
           $err =null;
           return response()->json([
             $err
           ]);
           $fuchiaShar =0;
         }
       }
   }
   public function add_new_pt($request)// 3
   {
     $gtReg  = $request->input('gtReg');
     $gid    = $request->input('gid');
     if($gtReg == 1){ // Register
       $lastVisitData = PtConfig::where('Pid','=',$gid)->get();

             $ptName = $request -> input('name');
             $encrypted_Name = Crypt::encryptString($ptName);

             $fatherName = $request -> input('father');
             $encrypted_Father = Crypt::encryptString($fatherName);

             $dob = $request -> input('dobdate');
             $dob = Crypt::encryptString($dob);

             $region = $request -> input('state');
             $region = Crypt::encryptString($region);

             $town = $request -> input('tt');
             $town = Crypt::encryptString($town);

             $quarter = $request -> input('quarter');
             $quarter = Crypt::encryptString($quarter);

             $phone = $request -> input('phone');
             $phone = Crypt::encryptString($phone);

             $phone2 = $request -> input('phone2');
             $phone2 = Crypt::encryptString($phone2);

             $phone3 = $request -> input('phone3');
             $phone3 = Crypt::encryptString($phone3);

             $table="General";
             $main_risk = $request -> input('main_risk');
             $main_risk = Crypt::encrypt_light($main_risk,$table);

             $sub_risk = $request -> input('sub_risk');
             $sub_risk = Crypt::encrypt_light($sub_risk,$table);

             $gender = $request -> input('gender');
             $gender = Crypt::encrypt_light($gender,$table);

             $main_risk = $request -> input('main_risk');
             $main_risk = Crypt::encrypt_light($main_risk,$table);

             $sub_risk = $request -> input('sub_risk');
             $sub_risk = Crypt::encrypt_light($sub_risk,$table);
             

             $dask = 731;
             $date_0= "0000-00-00";
             Patients::create([
               "Clinic Code"           => $request ->clinic_code ,
               "Pid"                   => $request ->gid ,
               "FuchiaID"              => $request ->fuchiaID ,
               'PrEPCode'              => $request ->prepCode,
               "Agey"                  => $request ->agey ,
               "Agem"                  => $request ->agem ,
               "Gender"                => $gender ,
               'Reg Date'              => $request ->vdate ,
               'Date Of Birth'         => $dob,

               'Main Risk'             => $main_risk,
               'Sub Risk'              => $sub_risk,
               'Mode'                  => $request -> mode,

             ]);
             Followup_general::create([
                 'Clinic Code'       => $request->clinic_code ,
                 'Pid'               => $request->gid,
                 'Agey'              => $request->agey,
                 'Agem'              => $request->agem,
                 'Gender'            => $gender,
                 'FuchiaID'          => $request->fuchiaID,
                 'PrEPCode'          => $request->prepCode,
                 'Visit Date'        => $request->vdate,
                 'Main Risk'         => $main_risk,
                 'Sub Risk'          => $sub_risk,

                 "Patient Type"          => $dask ,
                 "New_Old"               => $dask ,
                 "Fever"                 => $dask ,
                 "Diagnosis"             => $dask ,
                 "Support"               => $dask ,

                 "Patient Type_1"        => $dask ,
                 "New_Old_1"             => $dask ,
                 "Fever_1"               => $dask ,
                 "Diagnosis_1"           => $dask ,
                 "Support_1"             => $dask ,
                 "Next Appointment Date" => $date_0 ,
                 'Mode'                  => $request ->mode ,
                 "Unplan"                => $request ->unplan
             ]);
             PtConfig::create([
               'Clinic Code'       => $request->clinic_code ,
               'Pid'               => $request->gid,
               'FuchiaID'          => $request->fuchiaID,
               'PrEPCode'          => $request->prepCode,
               'Name'              => $encrypted_Name,
               'Father'            => $encrypted_Father,
               'Agey'              => $request->agey,
               'Agem'              => $request->agem,
               'Gender'            => $gender,
               'Reg Date'          => $request->vdate,
               'Date Of Birth'     => $dob,
               'Region'            => $region,
               'Township'          => $town,
               'Quarter'           => $quarter,
               'Phone'             => $phone,
               'Phone2'            => $phone2,
               'Phone3'            => $phone3,
               'Main Risk'         => $main_risk,//from counselor
               'Sub Risk'          => $sub_risk,//from counselor
               'Mode'              => $request ->mode,
             ]);
             $gtReg = 0;
             $success=[[ 	"id"  => 1,
             "name" => "Successfully collected" ]];
              return response()->json([
                $success
              ]);

     } //Register
   }
   public function add_follow_up($request)//4
   {
     $gid    = $request->input('gid');
     $ptFup  = $request->input('ptFollowup');
     $vDate = $request->input('vdate');
     if($ptFup==1){ // follow up register
       $unplan = $request->input('unplan');// is unplan visit
       $save =0;
       $lastVisitData = Followup_general::where('Pid','=',$gid)->get();
       if(count($lastVisitData)>0){
         for ($i=0; $i < count($lastVisitData); $i++) {
           $lastVisitID = $lastVisitData[$i]["Pid"];
           $lastVisitDate = $lastVisitData[$i]["Visit Date"];

           if($lastVisitID == $gid && $lastVisitDate == $vDate){
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
                       $dash = 731;

                       $dob = $request -> input('dobdate');
                       $dob = Crypt::encryptString($dob);

                       $table="General";

                       $gender = $request -> input('gender');
                       $gender = Crypt::encrypt_light($gender,$table);

                       $main_risk = $request -> input('main_risk');
                       $main_risk = Crypt::encrypt_light($main_risk,$table);

                       $sub_risk = $request -> input('sub_risk');
                       $sub_risk = Crypt::encrypt_light($sub_risk,$table);

                       $follow_generalPoint = Followup_general::where('Pid',$gid)->first();

                       if($follow_generalPoint != null) {
                        $followupData = Followup_general::where('Pid','=',$gid)->latest()->first();// Follow up  last
                       $lastFollowDate = $followupData["Next Appointment Date"];
                       Followup_general::where('Pid',$gid)->where('Next Appointment Date',$vDate)
                       ->update([
                         'Unplan' => 2,
                       ]);
                       $followupData = Followup_general::where('Pid','=',$gid)->latest()->first();// Follow up  last
                       $lastFollowDate = $followupData["Next Appointment Date"];
                       Followup_general::where('Pid',$gid)->where('Next Appointment Date','!=',$vDate)->where('Unplan',0)
                       ->update([
                         'Unplan' => 1,
                       ]);

                       }


                       
                       

                       Followup_general::create([
                           'Clinic Code'=> $request->clinic_code ,
                           'Pid'       => $request->gid,
                           'FuchiaID'  => $request->fuchiaID,
                           'PrEPCode'  => $request->prepCode,
                           'Agey'      => $request->agey,
                           'Agem'      => $request->agem,
                           'Gender'    => $gender,
                           'Visit Date'  => $request->vdate,


                           'Main Risk'     => $main_risk,
                           'Sub Risk'      => $sub_risk,
                           'Patient Type'  => $dash ,
                           'New_Old'       => $dash,
                           'Fever'         => $dash,
                           'Diagnosis'     => $dash ,
                           'Support'       => $dash ,

                           'Patient Type_1'=> $dash ,
                           'New_Old_1'     => $dash,
                           'Fever_1'       => $dash,
                           'Diagnosis_1'   => $dash,
                           'Support_1'     => $dash,
                           'Unplan'        => $request->unplan,

                         'Next Appointment Date'=> "0000-00-00",
                         'Mode'              => $request -> mode,
                       ]);
                 
                  
                 
                 $success=[["id"=> 1,
                        "name" => "Successfully collected" ]];
                        return response()->json([
                          $success
                        ]);
       }

     }
   }
   public function search_to_update($request)//5
   {

     $pt_ID  = $request->input('Pt_ID');
     $shar   = $request->input('search_par');
     if($shar==1){// finding in General patients files

        $patientData = PtConfig::where('Pid',$pt_ID)->first();
        if($patientData == false){
          $patientData = PtConfig::where('FuchiaID',$pt_ID)->first();
        }
        $patientData1 = Patients::where('Pid',$pt_ID)->first();
        $patientData2 = Followup_general::where('Pid',$pt_ID)->get();


      //  $followupData = Followup_general::where('Pid','=',$pt_ID)->latest()->first();// Follow up  last

        if($patientData != null){
          $ptNameDecrypt = $patientData["Name"];
          $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);

          $ptFather = $patientData["Father"];
          $ptFather = Crypt::decryptString($ptFather);

          $dob = $patientData["Date of Birth"];
          $dob = Crypt::decryptString($dob);

          $region = $patientData["Region"];
          $region = Crypt::decryptString($region);

          $town = $patientData["Township"];
          $town = Crypt::decryptString($town);

          $quarter = $patientData["Quarter"];
          $quarter = Crypt::decryptString($quarter);


          $phone = $patientData["Phone"];
          $phone = Crypt::decryptString($phone);
          $table="General";
          $sex = $patientData["Gender"];
          $sex = Crypt::decrypt_light($sex,$table);


          return response()->json([
            $patientData,$ptNameDecrypt,$ptFather,$dob,$region,$town,$quarter,$phone,$sex,
            $patientData1,$patientData2

          ]);
          $ckID =0;
        }
        // if($patientData == null){
        //   $patientData_fu = PtConfig::where('FuchiaID',$pt_ID)->first();
        //   if($patientData_fu != null){
        //     $ptNameDecrypt = $patientData_fu["Name"];
        //     $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);
        //
        //     $ptFather = $patientData_fu["Father"];
        //     $ptFather = Crypt::decryptString($ptFather);
        //
        //     $dob = $patientData_fu["Date of Birth"];
        //     $dob = Crypt::decryptString($dob);
        //
        //     $region = $patientData_fu["Region"];
        //     $region = Crypt::decryptString($region);
        //
        //     $town = $patientData_fu["Township"];
        //     $town = Crypt::decryptString($town);
        //
        //     $quarter = $patientData_fu["Quarter"];
        //     $quarter = Crypt::decryptString($quarter);
        //
        //
        //     $phone = $patientData_fu["Phone"];
        //     $phone = Crypt::decryptString($phone);
        //
        //     return response()->json([
        //       $patientData_fu,$ptNameDecrypt,$ptFather,$dob,$region,$town,$quarter,$phone
        //     ]);
        //     $ckID =0;
        //   }
        // }
        // if($patientData==null && $patientData1==null){
        //   $err =null;
        //   return response()->json([
        //     $err
        //   ]);
        //   $ckID =0;
        // }
     }
   }
   public function update_new_old_pt_data($request) // 6
   {
     $update = $request->input('update_reg');
     $genID = $request->input('generatedID');
     $genID1 = $request->input('generatedID1');
     $genIDarray = $request->input('genID');

     if($update==1){
          $ptName = $request -> input('name');
          $encrypted_Name = Crypt::encryptString($ptName);

          $fatherName = $request -> input('father');
          $encrypted_Father = Crypt::encryptString($fatherName);

          $dob = $request -> input('dobdate');
          $dob = Crypt::encryptString($dob);

          $region = $request -> input('state');
          $region = Crypt::encryptString($region);

          $town = $request -> input('tt');
          $town = Crypt::encryptString($town);

          $quarter = $request -> input('quarter');
          $quarter = Crypt::encryptString($quarter);

          $phone = $request -> input('phone');
          $phone = Crypt::encryptString($phone);

          $phone2 = $request -> input('phone2');
          $phone2 = Crypt::encryptString($phone2);

          $phone3 = $request -> input('phone3');
          $phone3 = Crypt::encryptString($phone3);

          $table="General";
          $main_risk = $request -> input('main_risk');
          $main_risk = Crypt::encrypt_light($main_risk,$table);

          $sub_risk = $request -> input('sub_risk');
          $sub_risk = Crypt::encrypt_light($sub_risk,$table);

          $gender = $request -> input('gender');
          $gender = Crypt::encrypt_light($gender,$table);

          for ($i=0; $i < count($genIDarray); $i++) {
            Followup_general::where('id',$genIDarray[$i])
            ->update([
              'Clinic Code'=> $request->clinic_code ,
              'Pid'                => $request->gid,
              'Agey'               => $request->agey,
              'Agem'               => $request->agem,
              'Gender'             => $gender,
              'FuchiaID'           => $request->fuchiaID,
              'PrEPCode'           => $request->prepCode,

            ]);
          }
         Patients::where('id',$genID1)
         ->update([
           'Clinic Code'           => $request->clinic_code ,
           'Pid'                   => $request->gid,
           'Agey'                  => $request->agey,
           'Agem'                  => $request->agem,
           'Gender'                => $gender,
           'FuchiaID'              => $request->fuchiaID,
           'PrEPCode'              => $request->prepCode,
           'Reg Date'              => $request->vdate,
           'Date Of Birth'         => $dob,
         ]);
         PtConfig::where('id',$genID)
         ->update([
           'Clinic Code'         => $request->clinic_code ,
           'Pid'                 => $request->gid,
           'FuchiaID'            => $request->fuchiaID,
           'PrEPCode'            => $request->prepCode,
           'Name'                => $encrypted_Name,
           'Father'              => $encrypted_Father,
           'Agey'                => $request->agey,
           'Agem'                => $request->agem,
           'Gender'              => $gender,
           'Reg Date'            => $request->vdate,
           'Date Of Birth'       => $dob,
           'Region'              => $region,
           'Township'            => $town,

         ]);

         $success=[[ 	"id"  => 1,
         "name" => "Successfully collected" ]];
          return response()->json([
            $success
          ]);
     } // to Update Data
   }
   public function search_genID_existing_return($request)// 7
   {
     $gid    = $request->input('gid_return');
     $ckID   = $request->input('ckID_return');
     if($gid && $ckID==1){
       $patientData = Followup_general::
                       where('Pid','=',$gid)
                       ->orderBy('Visit Date', 'desc')
                       ->first();

       return response()->json([
         $patientData
       ]);
     }
   }
   public function search_fuchia_existing_return($request)//8
   {
     $fid    = $request->input('fid_return');
     $ckFu   = $request->input('fuchiaShar');
     if($fid && $ckFu==1){
       $patientData = Followup_general::
                       where('FuchiaID','=',$fid)
                       ->orderBy('Visit Date', 'desc')
                       ->first();

       return response()->json([
         $patientData
       ]);
     }
   }
   public function save_next_diagnosis($request)//9
   {
     $gid    = $request->input('gid');
     $next   = $request->input('next');
     $fDate = $request -> input('fDate');

     $table = "General";
     $Patient_Type          =$request -> input('Patient_Type');
     $Patient_Type = Crypt::encrypt_light($Patient_Type,$table);
     $New_Old               =$request -> input('New_Old');
     $New_Old = Crypt::encrypt_light($New_Old,$table);

     $Fever                 =$request -> input('Fever');
     $Fever = Crypt::encrypt_light($Fever,$table);
     $Diagnosis             =$request -> input('Diagnosis');
     $Diagnosis = Crypt::encrypt_light($Diagnosis,$table);
     $Support               =$request -> input('Support');
     $Support = Crypt::encrypt_light($Support,$table);

     $Patient_Type_1        =$request -> input('Patient_Type_1');
     $Patient_Type_1 = Crypt::encrypt_light($Patient_Type_1,$table);
     $New_Old_1             =$request -> input('New_Old_1');
     $New_Old_1  = Crypt::encrypt_light($New_Old_1 ,$table);
     $Fever_1               =$request -> input('Fever_1');
     $Fever_1  = Crypt::encrypt_light($Fever_1 ,$table);
     $Diagnosis_1           =$request -> input('Diagnosis_1');
     $Diagnosis_1  = Crypt::encrypt_light($Diagnosis_1 ,$table);
     $Support_1             =$request -> input('Support_1');
     $Support_1  = Crypt::encrypt_light($Support_1 ,$table);

     if($next && $gid){

       Followup_general::where('Pid',$gid)
           ->where('Visit Date','=',$fDate)
           ->update([
               'Next Appointment Date'=> $request ->nDate,

               "Patient Type"        => $Patient_Type,
               "New_Old"             => $New_Old,
                "Fever"               => $Fever,
                "Diagnosis"           => $Diagnosis,
                "Support"             => $Support,

                "Patient Type_1"      => $Patient_Type_1,
                "New_Old_1"           => $New_Old_1,
                "Fever_1"             => $Fever_1,
                "Diagnosis_1"         => $Diagnosis_1,
                "Support_1"           => $Support_1   ,
             ]);

         $success=[[ 	"id"  => 1,
         "name" => "Successfully collected" ]];
          return response()->json([
            $success
          ]);
     }
   }
   public function nextappointment_list_show($request)//10
   {
     $nDate = $request -> input('ndate');
     $visit_type = $request -> input('visit_type');
     $num1=0;
     $num2=2;

     // $here = "-";
     // $do = Followup_general::
     //
     //                 where('trf','=',$here)
     //                 ->update(['FuchiaID'=>$here]);

     if($nDate && $visit_type=='PHA'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','2423133')// PHA
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       
                       ->orderBy('created_at', 'asc')
                       ->get();

       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='ART'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','1310453')//ART
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       ->orderBy('created_at', 'asc')
                       ->get();
       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='PrEP'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','249826244')//PrEP
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       ->orderBy('created_at', 'asc')
                       ->get();
       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='STI'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','3945273')//STI
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       ->orderBy('created_at', 'asc')
                       ->get();
       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='FC'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','25392')//FC
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       ->orderBy('created_at', 'asc')
                       ->get();
       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='General'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','223268329859977')//General
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       ->orderBy('created_at', 'asc')
                       ->get();
       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='PMTCT'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','24194539455')//PMTCT
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       ->orderBy('created_at', 'asc')
                       ->get();
       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='ANC'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','1337393')//ANC
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       ->orderBy('created_at', 'asc')
                       ->get();
       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='<15'){
       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','5721513')//<15
                    //    ->where(function($query) use ($num1, $num2) {
                    //     $query->where('Unplan', '=', $num2)
                    //           ->orWhere('Unplan', '=',$num1);
                    // })
                       ->orderBy('created_at', 'asc')
                       ->get();
       return response()->json([
         $patientData
       ]);
     }
     if($nDate && $visit_type=='lab_iv_only'){

       $patientData = Followup_general::
                       where('Next Appointment Date','=',$nDate)
                       ->where('Patient Type','=','975930618682618968974011')//<15
                      //  ->where('Unplan','=',0)
                       ->orderBy('created_at', 'asc')
                       ->get();

       return response()->json([
         $patientData
       ]);
     }
   }
   public function show_followup_history($request)//11
   {
     $gid    = $request->input('gid');
     $ck_followUpHistory = $request -> input('ck_followUpHistory');
     if($ck_followUpHistory==1){
         
         $fUp_data_last = Followup_general::where('Pid','=',$gid)->first();
         if($fUp_data_last){
          $fUp_data = Followup_general::where('Pid','=',$gid)->get();
         }
         if($fUp_data_last==false){
          $fUp_data_last = Followup_general::where('FuchiaID','=',$gid)->first();
          if($fUp_data_last){
           $fUp_data = Followup_general::where('FuchiaID','=',$gid)->get();
          }
         }
         if($fUp_data_last==false){
          $fUp_data_last = Followup_general::where('PrEPCode','=',$gid)->first();
          if($fUp_data_last){
           $fUp_data = Followup_general::where('PrEPCode','=',$gid)->get();
          }
         }

         $table="General";

         $decrypted_sex = Crypt::decrypt_light($fUp_data_last['Gender'],$table);

         return response()->json([$fUp_data,$decrypted_sex]);
     }
   }
   public function followup_update_filler($request)//12
   {

      $ptID    = $request->input('ptID');

      $rowID = $request->input('rowID');

      $toUpdateFollowup = $request->input('toUpdateFollowup');

      if($toUpdateFollowup==1){
        $followupData = Followup_general::where('Pid','=',$ptID)
                                         ->where('id','=',$rowID)
                                         ->get();// Follow up  last4

       $table = "General";

       $gender =   $followupData[0]["Gender"];
       $gender = Crypt::decrypt_light($gender,$table);

       $Ptype =   $followupData[0]["Patient Type"];
       $Ptype = Crypt::decrypt_light($Ptype,$table);

       $new_old =   $followupData[0]["New_Old"];
       $new_old = Crypt::decrypt_light($new_old,$table);

       $fever =   $followupData[0]["Fever"];
       $fever = Crypt::decrypt_light($fever,$table);

       $diagnosis =   $followupData[0]["Diagnosis"];
       $diagnosis = Crypt::decrypt_light($diagnosis,$table);

       $support =   $followupData[0]["Support"];
       $support = Crypt::decrypt_light($support,$table);

       $Ptype_1 =   $followupData[0]["Patient Type_1"];
       $Ptype_1 = Crypt::decrypt_light($Ptype_1,$table);

       $new_old_1 =   $followupData[0]["New_Old_1"];
       $new_old_1 = Crypt::decrypt_light($new_old_1,$table);

       $fever_1 =   $followupData[0]["Fever_1"];
       $fever_1 = Crypt::decrypt_light($fever_1,$table);

       $diagnosis_1_org =   $followupData[0]["Diagnosis_1"];
       $diagnosis_1 = Crypt::decrypt_light($diagnosis_1_org,$table);

       $support_1 =   $followupData[0]["Support_1"];
       $support_1 = Crypt::decrypt_light($support_1,$table);

      return response()->json([
       $followupData,$gender,$Ptype,$new_old,$fever,$diagnosis,$support,$Ptype_1,$new_old_1,$fever_1,$diagnosis_1,$support_1,$rowID,
       ]);
     }
   }
   public function to_update_followup_data($request)//13
   {

    $f_up_update = $request->input('f_up_update');
    $rowNumber = $request->input('rowNumber');
    $pid    = $request->input('pid');

     if($f_up_update==1){ // updating followup row with next appointment date
       $table="General";
       $gender = $request -> input('gender');
       $gender = Crypt::encrypt_light($gender,$table);

       $Ptype =   $request->input('ptype');
       $Ptype = Crypt::encrypt_light($Ptype,$table);

       $new_old =   $request->input('new_old');
       $new_old = Crypt::encrypt_light($new_old,$table);

       $fever =   $request->input('sub_1');
       $fever = Crypt::encrypt_light($fever,$table);

       $diagnosis =   $request->input('sub_2');
       $diagnosis = Crypt::encrypt_light($diagnosis,$table);

       $support =   $request->input('sub_3');
       $support = Crypt::encrypt_light($support,$table);

       $Ptype_1 =   $request->input('ptype_1');
       $Ptype_1 = Crypt::encrypt_light($Ptype_1,$table);

       $new_old_1 =   $request->input('new_old_1');
       $new_old_1 = Crypt::encrypt_light($new_old_1,$table);

       $fever_1 =   $request->input('sub_1_1');
       $fever_1 = Crypt::encrypt_light($fever_1,$table);

       $diagnosis_1 =   $request->input('sub_2_2');
       $diagnosis_1 = Crypt::encrypt_light($diagnosis_1,$table);

       $support_1 =   $request->input('sub_3_3');
       $support_1 = Crypt::encrypt_light($support_1,$table);

       Followup_general::where('id','=',$rowNumber)->where('Pid','=',$pid)
       ->update([

         'Agey'               => $request->agey,
         'Agem'               => $request->agem,
         'Gender'             => $gender,
         'FuchiaID'           => $request->fid,
         'PrEPCode'           => $request->prepCode,
         'Visit Date'         => $request->vDate,

         'Patient Type'  =>  $Ptype,
         'New_Old'       =>  $new_old,
         'Fever'         =>  $fever,
         'Diagnosis'     =>  $diagnosis,
         'Support'       =>  $support,

         'Patient Type_1'=>  $Ptype_1,
         'New_Old_1'     =>  $new_old_1,
         'Fever_1'       =>  $fever_1,
         'Diagnosis_1'   =>  $diagnosis_1,
         'Support_1'     =>  $support_1,

         'Next Appointment Date'=> $request->nDate,
       ]);
       $success = "It's OK";
       return response()->json([$success]);
     }
   }

 // Export Section
   public function export(Request $data)
   {
     $from = $data->input('Datefrom');
     $date_from = DateTime::createFromFormat('d-m-Y', $from);
     $from = $date_from->format('Y-m-d');

     $to = $data->input('Dateto');
     $date_to = DateTime::createFromFormat('d-m-Y', $to);
     $to = $date_to->format('Y-m-d');

        $users = Followup_general::query()
            ->select(
                    "Gender",
                    "Main Risk",
                    "Sub Risk",
                    "Patient Type",
                    "New_Old",
                    "Fever",
                    "Diagnosis",
                    "Support",
                    "Patient Type_1",
                    "New_Old_1",
                    "Fever_1",
                    "Diagnosis_1",
                    "Support_1",
              )
              ->whereBetween('Visit Date', [$from,$to])
              ->get();

        $users1= Followup_general::
                query()
                    ->select(
                      'id',
                      "Clinic Code",
                      "Pid",
                      "FuchiaID",
                      "PrEPCode",
                      "Agey",
                      "Agem",
                      'Visit Date',
                      "Next Appointment Date",
                      'Mode',
                      'Unplan',
                      )
                  ->whereBetween('Visit Date', [$from, $to])
                  ->get();
              return Excel::download(new ReceptionExport($users,$users1), 'followup_data.xlsx');
        }


  }// class End
