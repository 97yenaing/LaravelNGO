<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\Lab;
use App\Models\Urine;

class HtyALabClinicController extends Controller
{
      public function lab_records(){
        $hiv = Lab::latest()->paginate(20);
        return view (
          'Labs.HivLabRecord',['hiv' => $hiv
        ]);
      }


      public function Hty_A_Lab_View()
      {
        $data= 1;
        return view ('Labs.HtyALabClinic',[
                'dd' => $data
                ]);
         //return view('file-import');
      }


      public function Hty_A_Lab_data(Request $request){
        $clinic = $request->input('clinic');
        $cid = $request->input('cid');
        $fuchiaID = $request->input('fuchiaID');
        $ageyear= $request->input('ageyear');
        $gender1 = $request->input('gender1');
        // for hiv test
        $ptype = $request->input('Patient Type');
        $ext = $request->input('ext');
        $visitDate = $request->input('visitDate');
        $bcdate = $request->input('bcdate');
        $d_result = $request->input('d_result');
        $uni_result = $request->input('uni_result');
        $stat_result = $request->input('stat_result');
        $final_result = $request->input('final_result');
        $md = $request->input('md');
        $counselor = $request->input('counselor');

        $comment = $request->input('comment');
        $lab_tech = $request->input('lab_tech');
        $issue_date= $request->input('issue_date');

        // For Urine test
        $Utest_done = $request->input('Utest_done');
        $Utot = $request->input('Utot');
        $Ucolor = $request->input('Ucolor');
        $Uapp = $request->input('Uapp');
        $Upus = $request->input('Upus');

        $ph = $request->input('ph');
        $Uprotein = $request->input('Uprotein');
        $Uglucose = $request->input('Uglucose');
        $Urbc = $request->input('Urbc');
        $Uleu = $request->input('Uleu');

        $Unitrite = $request->input('Unitrite');
        $Uketone = $request->input('Uketone');
        $Uepithelial = $request->input('Uepithelial');
        $Urobili= $request->input('Urobili');
        $Ubillru = $request->input('Ubillru');

        $Uery = $request->input('Uery');
        $Ucrystal= $request->input('Ucrystal');
        $Uhae = $request->input('Uhae');
        $Uother = $request->input('Uother');
        $Ucast = $request->input('Ucast');
        if($cid && $Utest_done){
            Urine::create([
              'ClinicName' => $request->clinic,
              'CID'=>$request->cid ,
              'fuchiacode'=>$request->fuchiaID ,
              'agey'=>$request->ageyear ,
             // 'agem'=>$request-> ,
              'Gender'=>$request->gender1 ,
              'Utest_done' => $request->Utest_done,
              'Utot' => $request->Utot,
              'Ucolor' => $request->Ucolor,
              'Uapp' => $request->Uapp,
              'Upus' => $request->Upus,

              'ph' => $request->ph,
              'Uprotein' => $request->Uprotein,
              'Uglucose' => $request->Uglucose,
              'Urbc' => $request->Urbc,
              'Uleu' => $request->Uleu,

              'Unitrite' => $request->Unitrite,
              'Uketone '=> $request->Uketone,
              'Uepithelial' => $request->Uepithelial,
              'Urobili'=> $request->Urobili,
              'Ubillru' => $request->Ubillru,

              'Uery' => $request->Uery,
              'Ucrystal'=> $request->Ucrystal,
              'Uhae' => $request->Uhae,
              'Uother' => $request->Uother,
              'Ucast' => $request->Ucast,
            ]);
        }

        if($cid){
          if($visitDate == null){
            $patientData = Patients::where('Pid',$cid)->first();
            return response()->json([$patientData]);
          }
        }
        if($cid && $visitDate ){
          //$request->validate([
        //    'ClinicName'=> 'required',
          ////  'Pid'        => 'required',
          //  'Patient_Type'=>'required'
        //    ]);
         Lab::create([
               'ClinicName' => $request->clinic,
               'CID'=>$request->cid ,
               'fuchiacode'=>$request->fuchiaID ,
               'agey'=>$request->ageyear ,
              // 'agem'=>$request-> ,
               'Gender'=>$request->gender1 ,
               'Patient_Type'=>$request->ptype ,
              // 'Pregnant Mother Sub'=>$request->ext ,
              // 'Spouse of Pregnant Mother Sub'=>$request-> ,
              // 'Partner of KP sub'=>$request-> ,
               //'FSW Sub'=>$request-> ,
              // 'MSM Sub'=>$request-> ,
               //'TG Sub'=>$request-> ,
               //'IDU Sub'=>$request-> ,
              // 'Low Risk Sub'=>$request-> ,
              // 'Special Group Sub'=>$request-> ,
               'Visit_date'=>$request->visitDate ,
               'bcollectdate'=>$request->bcdate,
               'Detmine_Result'=>$request->d_result,
               'Unigold_Result'=>$request->uni_result ,
               'STAT_PAK_Result'=>$request->stat_result ,
               'Final_Result'=>$request->final_result
               ]);
               $dataSuccess=[[ 	"id"   => 1,
                                 "name" => "Successfully Save the patient's data." ]];
              return response()->json([$dataSuccess]);
        }

      }
  }
