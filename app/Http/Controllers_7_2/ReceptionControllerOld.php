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
class ReceptionController extends Controller
{
  // Recepiton Return Section
  public function receptionReturnView(){
    return view (
      'Reception.Reception_return'
    );
  }
  public function receptionReturn_data(Request $request){
      $gid    = $request->input('gid');
      $ckID   = $request->input('ckID');
      $next   = $request->input('next');
      $fDate = $request -> input('fDate');
      if($gid && $ckID){
        $patientData = Followup_general::
                        where('Pid','=',$gid)
                        ->orderBy('Visit Date', 'desc')
                        ->first();

        return response()->json([
          $patientData
        ]);
      }
      if($next && $gid){

        Followup_general::where('Pid',$gid)
        ->where('Visit Date','=',$fDate)
        ->update([
            'Next Appointment Date'=> $request -> nDate
          ]);

          $success=[[ 	"id"  => 1,
          "name" => "Successfully collected" ]];
           return response()->json([
             $success
           ]);
      }
  }
 // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

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
  public function Hty_A_Recession_View()
      {
        $lastPt = PtConfig::orderBy('id', 'desc')->limit(1)->get();


        return view('Reception.Reception',['lastPt'=> $lastPt]);
      }
  public function hty_A_Recession_data(Request $request){
      $gid    = $request->input('gid');
      $fuchiaID= $request->input('fuchiaID');
      $ckID   = $request->input('ckID');
      $pt_ID  = $request->input('Pt_ID');
      $shar   = $request->input('search_par');
      $fuchiaShar= $request->input('fuchiaShar');
      $fuID = $request->input('fuID');

      $gtReg  = $request->input('gtReg');
      $ptFup  = $request->input('ptFollowup');
      $update = $request->input('update');

      $genID = $request->input('generatedID');
      $genID1 = $request->input('generatedID1');
      $genIDarray = $request->input('genID');


      if($ckID ==1){ //to check the patient is in general patients list
          $patientData = PtConfig::where('Pid','=',$gid)->first();
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

            $ptPhone = $patientData["Phone"];
            $ptPhone = Crypt::decryptString($ptPhone);


            return response()->json([
              $patientData,$ptNameDecrypt,$ptFather,$dob,$region,$town,$quarter,$ptPhone
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
      if($shar==1){// finding in General patients files
         $patientData = PtConfig::where('Pid',$pt_ID)->first();
         $patientData1 = Patients::where('Pid',$pt_ID)->first();
         $patientData2 = Followup_general::where('Pid',$pt_ID)->get();
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


           return response()->json([
             $patientData,$ptNameDecrypt,$ptFather,$dob,$region,$town,$quarter,$phone
           ]);
           $ckID =0;
         }
         if($patientData == null){
           $patientData_fu = PtConfig::where('FuchiaID',$pt_ID)->first();
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
               $patientData_fu,$ptNameDecrypt,$ptFather,$dob,$region,$town,$quarter,$phone
             ]);
             $ckID =0;
           }
         }
         if($patientData==null && $patientData1==null){
           $err =null;
           return response()->json([
             $err
           ]);
           $ckID =0;
         }
      }
      if($fuchiaShar==1){
        $patientData_fu = PtConfig::where('FuchiaID',$fuID)->first();
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
            $patientData_fu,$ptNameDecrypt,$ptFather,$dob,$region,$town,$quarter,$phone
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

      if($gtReg == 1){
            $ptName = $request -> input('name');
            $encrypted_Name = Crypt::encryptString($ptName);

            $fatherName = $request -> input('father');
            $encrypted_Father = Crypt::encryptString($fatherName);

            $dob = $request -> input('dobdate');
            $dob = Crypt::encryptString($dob);

            $Ptype = $request -> input('Ptype');
            $Ptype = Crypt::encryptString($Ptype);

            $Ptype_sub = $request -> input('tt_sub');
            $Ptype_sub = Crypt::encryptString($Ptype_sub);

            $Ptype_sub_2 = $request -> input('tt_sub_2');
            $Ptype_sub_2 = Crypt::encryptString($Ptype_sub_2);

            $region = $request -> input('state');
            $region = Crypt::encryptString($region);

            $town = $request -> input('tt');
            $town = Crypt::encryptString($town);

            $quarter = $request -> input('quarter');
            $quarter = Crypt::encryptString($quarter);

            $phone = $request -> input('phone');
            $phone = Crypt::encryptString($phone);

            Patients::create([
              'Clinic Code'       => $request->clinic_code ,
              'Pid'               => $request->gid,
              'Agey'              => $request->agey,
              'Agem'              => $request->agem,
              'Gender'            => $request->gender,
              'FuchiaID'          => $request->fuchiaID,
              'Reg Date'          => $request->vdate,
              'Date Of Birth'     => $dob,
              'Region'            => $region,
              'Township'          => $town,
              'Quarter'           => $quarter,
              'Patient Type'      => $Ptype,
              'Patient Type Sub'  => $Ptype_sub,
              'Patient Type Sub1' => $Ptype_sub_2,
            ]);
            Followup_general::create([
                'Clinic Code'       => $request->clinic_code ,
                'Pid'               => $request->gid,
                'Agey'              => $request->agey,
                'Agem'              => $request->agem,
                'Gender'            => $request->gender,
                'FuchiaID'          => $request->fuchiaID,
                'Visit Date'        => $request->vdate,
                'Date Of Birth'     => $dob,
                'Patient Type'      => $Ptype,
                'Patient Type Sub'  => $Ptype_sub,
                'Patient Type Sub1' => $Ptype_sub_2,
                'New_Old'           => $request->new_old,
            ]);
            PtConfig::create([
              'Clinic Code'       => $request->clinic_code ,
              'Pid'               => $request->gid,
              'FuchiaID'          => $request->fuchiaID,
              'Name'              => $encrypted_Name,
              'Father'            => $encrypted_Father,
              'Agey'              => $request->agey,
              'Agem'              => $request->agem,
              'Gender'            => $request->gender,
              'Reg Date'          => $request->vdate,
              'Date Of Birth'     => $dob,
              'Patient Type'      => $Ptype,
              'Patient Type Sub'  => $Ptype_sub,
              'Patient Type Sub1' => $Ptype_sub_2,
              'Region'            => $region,
              'Township'          => $town,
              'Quarter'           => $quarter,
              'Phone'             => $phone,

            ]);
            $gtReg = 0;
            $success=[[ 	"id"  => 1,
            "name" => "Successfully collected" ]];
             return response()->json([
               $success
             ]);

      } // Create // to  register data first
      if($ptFup==1){ // follow up register
        $ptName = $request -> input('name');
        $encrypted_Name = Crypt::encryptString($ptName);

        $fatherName = $request -> input('father');
        $encrypted_Father = Crypt::encryptString($fatherName);

        $dob = $request -> input('dobdate');
        $dob = Crypt::encryptString($dob);

        $Ptype = $request -> input('Ptype');
        $Ptype = Crypt::encryptString($Ptype);

        $Ptype_sub = $request -> input('tt_sub');
        $Ptype_sub = Crypt::encryptString($Ptype_sub);

        $Ptype_sub_2 = $request -> input('tt_sub_2');
        $Ptype_sub_2 = Crypt::encryptString($Ptype_sub_2);

        $region = $request -> input('state');
        $region = Crypt::encryptString($region);

        $town = $request -> input('tt');
        $town = Crypt::encryptString($town);

        $quarter = $request -> input('quarter');
        $quarter = Crypt::encryptString($quarter);

        $phone = $request -> input('phone');
        $quarter = Crypt::encryptString($phone);

        Followup_general::create([
            'Clinic Code'=> $request->clinic_code ,
            'Pid'       => $request->gid,
            'Agey'      => $request->agey,
            'Agem'      => $request->agem,
            'Gender'    => $request->gender,
            'FuchiaID'  => $request->fuchiaID,
            'Visit Date'  => $request->vdate,
            'Date Of Birth'=>$dob,
            'Patient Type'=> $Ptype,
            'Patient Type Sub'=>$Ptype_sub,
            'Patient Type Sub1'=>$Ptype_sub_2,
            'New_Old' => $request->new_old,
        ]);
        $success=[["id"=> 1,
        "name" => "Successfully collected" ]];
         return response()->json([
           $success
         ]);
      }
      if($update==1){
           $ptName = $request -> input('name');
           $encrypted_Name = Crypt::encryptString($ptName);

           $fatherName = $request -> input('father');
           $encrypted_Father = Crypt::encryptString($fatherName);

           $dob = $request -> input('dobdate');
           $dob = Crypt::encryptString($dob);

           $Ptype = $request -> input('Ptype');
           $Ptype = Crypt::encryptString($Ptype);

           $Ptype_sub = $request -> input('tt_sub');
           $Ptype_sub = Crypt::encryptString($Ptype_sub);

           $Ptype_sub_2 = $request -> input('tt_sub_2');
           $Ptype_sub_2 = Crypt::encryptString($Ptype_sub_2);

           $region = $request -> input('state');
           $region = Crypt::encryptString($region);

           $town = $request -> input('tt');
           $town = Crypt::encryptString($town);

           $quarter = $request -> input('quarter');
           $quarter = Crypt::encryptString($quarter);

           $phone = $request -> input('phone');
           $quarter = Crypt::encryptString($phone);

           for ($i=0; $i < count($genIDarray); $i++) {
             Followup_general::where('id',$genIDarray[$i])
             ->update([
               'Clinic Code'=> $request->clinic_code ,
               'Pid'       => $request->gid,
               'Agey'      => $request->agey,
               'Agem'      => $request->agem,
               'Gender'    => $request->gender,
               'FuchiaID'  => $request->fuchiaID,
               'Visit Date'  => $request->vdate,
               'Date Of Birth'=>$dob,
               'Patient Type'=> $Ptype,
               'Patient Type Sub'=>$Ptype_sub,
               'Patient Type Sub1'=>$Ptype_sub_2,
               'New_Old' => $request->new_old,
             ]);
           }
          Patients::where('id',$genID1)
          ->update([
            'Clinic Code'=> $request->clinic_code ,
            'Pid'       => $request->gid,
            'Agey'      => $request->agey,
            'Agem'      => $request->agem,
            'Gender'    => $request->gender,
            'FuchiaID'  => $request->fuchiaID,
            'Reg Date'  => $request->vdate,
            'Date Of Birth'=>$dob,
            'Patient Type'=> $Ptype,
            'Patient Type Sub'=>$Ptype_sub,
            'Patient Type Sub1'=>$Ptype_sub_2,
          ]);
          PtConfig::where('id',$genID)
          ->update([
            'Clinic Code'=> $request->clinic_code ,
            'Pid'       => $request->gid,
            'Name'      => $encrypted_Name,
            'Father'    => $encrypted_Father,
            'Agey'      => $request->agey,
            'Agem'      => $request->agem,
            'Gender'    => $request->gender,
            'Reg Date'  => $request->vdate,
            'Date Of Birth'=>$dob,
            'Patient Type'=> $Ptype,
            'Patient Type Sub'=>$Ptype_sub,
            'Patient Type Sub1'=>$Ptype_sub_2,
            'Region'    => $region,
            'Township'  => $town,
            'Quarter'   => $quarter,
            'Phone'     => $phone,
            'FuchiaID'  => $request->fuchiaID,
          ]);

          $success=[[ 	"id"  => 1,
          "name" => "Successfully collected" ]];
           return response()->json([
             $success
           ]);
      } // to Update Data
    }
  }
