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
      if($update==1){
        $ptName = $request -> input('name');
           $encrypted_Name = Crypt::encryptString($ptName);
        $fatherName = $request -> input('father');
           $encrypted_Father = Crypt::encryptString($fatherName);
          Patients::where('Pid',$gid)
          ->update([
            'Agey'      => $request->agey,
            'Agem'      => $request->agem,
            'Gender'    => $request->gender,
            'Date Of Birth'=>$request->dobdate,
            'Main Risk'=> $request->Ptype,
            'Sub Risk'=>$request->tt_sub,
          ]);
          PtConfig::where('Pid',$gid)
          ->update([
            'Agey'      => $request->agey,
            'Agem'      => $request->agem,
            'Gender'    => $request->gender,
            'Date Of Birth'=>$request->dobdate,
            'Main Risk'=> $request->Ptype,
            'Sub Risk'=>$request->tt_sub,
          ]);

          $success=[[ 	"id"  => 1,
          "name" => "Successfully collected" ]];
           return response()->json([
             $success
           ]);
      }
      if($ckID ==1){ //to check the patient is in general patients list
          $patientData = PtConfig::where('Pid','=',$gid)->first();
          if($patientData != null){
            $ptNameDecrypt = $patientData["Name"];
            $ptNameDecrypt =Crypt::decryptString($ptNameDecrypt);
            $ptFather = $patientData["Father"];
            $ptFather = Crypt::decryptString($ptFather);

            return response()->json([
              $patientData,$ptNameDecrypt,$ptFather
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


      }
  }
