<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;

use App\Models\PreventionCBS;
use App\Models\PreventionLogsheet;
use App\Models\Coulselling;
use App\Models\Lab;

use App\Models\PtConfig;
use DateTime;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;


use App\Exports\PatientsExport;
//Export
use App\Exports\Prevention\PreventionExport;
use App\Exports\Prevention\ConfidExport;
use App\Exports\Export_age;


use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class Logsheet_cbsController extends Controller
{

  public function Prevention_View()
  {

    return view(
      'Prevention.log_sheet'
    );
  }
  // Main Switch
  public function Prevention_data(Request $request)
  {
    $functionLoco   = $request->input('functionLoco');

    switch ($functionLoco) {
      case 1:
        return $this->search_genID_existing($request);
        break;
      case 2:
        return $this->search_fuchia_eixsting($request);
        break;
      case 3:
        return $this->confidential($request);
        break;
      case 4:
        return $this->confidential_update($request);
        break;
      case 5:
        return $this->logsheet($request);
        break;
      case 6:
        return $this->cbs($request);
        break;
      case 7:
        return $this->determineResult($request);
        break;
      case 8:
        return $this->fatchData_to_update($request);
        break;
      case 9:
        return $this->Followup_to_update($request);
        break;
      case 10:
        return $this->change_id_in_followup_row($request);
        break;
      case 11:
        return $this->hiv_result_confirm($request);
      default:
      case 12:
        return $this->cbs_data_to_update($request);
        break;
      case 13:
        return $this->cbs_followup_update($request);
        break;
      case 14:
        return $this->logsheet_known_negative($request);
        break;
      case 15:
        return $this->export($request);
        break;
      case 16:
        return $this->prevention_remove($request);
        break;
      case 17:
        return $this->new_old($request);
        break;

        // code...
        break;
    }
  }
  public function prevention_remove($request)
  {
    $about = $request["about"];
    $date = $request["hts_date"];
    $rownumber = $request["rowNumber"];
    $generalID = $request["Pid"];
    if ($about == "logsheet") {
      $DB = "PreventionLogsheet";
      $DB_table = "prevention_logsheets";
    } else if ($about == "cbs") {
      $DB = "PreventionCBS";
      $DB_table = "prevention_c_b_s";
    }
    $modelClassName = 'App\\Models\\' . $DB; // extend model
    $model = app()->make($modelClassName); // resolves the model from the service container.
    $exist = $model->where("Pid", $generalID)->where("id", $rownumber)->where("Visit_Date", $date)->exists();
    if ($exist) {
      $delete = $model->where("Pid", $generalID)->where("id", $rownumber)->where("Visit_Date", $date)->delete();
      if ($delete) {
        DB::statement('SET @id := 0');
        DB::statement('UPDATE ' . $DB_table . ' SET id = @id := @id + 1');
        DB::statement('ALTER TABLE ' . $DB_table . ' AUTO_INCREMENT = 1');
      }
      if ($about = "cbs") {
        $cbs_hts_exists = Coulselling::where("Pid", $generalID)->where("Counselling_Date", $date)->where("CBS_HTS", 1)->exists();
        if ($cbs_hts_exists) {
          $cbs_hts_exists = Coulselling::where("Pid", $generalID)->where("Counselling_Date", $date)->where("CBS_HTS", 1)->delete();
          if ($cbs_hts_exists) {
            DB::statement('SET @id := 0');
            DB::statement('UPDATE coulsellings SET id = @id := @id + 1');
            DB::statement('ALTER TABLE coulsellings AUTO_INCREMENT = 1');
          }
        }
      }
      return response()->json("Success delete");
    } else {
      return response()->json("Your Wrong Credential contant to Admin");
    }
  }
  public function search_genID_existing($request) //1
  {

    $ckID   = $request->input('ckID');

    if ($ckID == 1) { //to check the patient is in general patients list
      $generalID    = $request->input('generalID');
      $Fid = $request->input('Fuchia_ID');
      $patientData = PtConfig::where('Pid', '=', $generalID)->orwhere(function ($query) use ($Fid) {
        if ($Fid !== null && $Fid !== "-") {
          $query->Where('FuchiaID', $Fid);
        }
      })->first();
      if ($patientData) {
        $generalID = $patientData["Pid"];
      }

      $logSheetData =  PreventionLogsheet::where('Pid', '=', $generalID)->get();
      foreach ($logSheetData as $key => $logsheet) {
        if ($logSheetData[$key]['Visit_Date']) {
          $logSheetData[$key]['Visit_Date'] = date("d-m-Y", strtotime($logsheet['Visit_Date']));
        } else {
          $logSheetData[$key]['Visit_Date'] = "";
        }
      }
      $cbsData =  PreventionCBS::where('Pid', '=', $generalID)->get();
      foreach ($cbsData as $key => $cbs) {
        if ($cbsData[$key]['Visit_Date']) {
          $cbsData[$key]['Visit_Date'] = date("d-m-Y", strtotime($cbs['Visit_Date']));
        } else {
          $cbsData[$key]['Visit_Date'] = "";
        }
      }

      $currentDate = Carbon::now();
      $formattedDate = $currentDate->format('Y-m-d H:i:s');
      $currentDateOnly = $currentDate->toDateString();
      $currentYear = Carbon::now()->year;
      $entry_year = $request["entry_year"];
      if ($patientData != null) {
        $ptNameDecrypt = $patientData["Name"];
        $ptNameDecrypt = Crypt::decryptString($ptNameDecrypt);

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


        $phone = Crypt::decryptString($patientData["Phone"]);
        $phone2 = Crypt::decryptString($patientData["Phone2"]);
        $phone3 = Crypt::decryptString($patientData["Phone3"]);

        $table = "General";

        $gender = Crypt::decrypt_light($patientData["Gender"], $table);
        $main_risk = Crypt::decrypt_light($patientData["Main Risk"], $table);
        $sub_risk = Crypt::decrypt_light($patientData["Sub Risk"], $table);

        if ($logSheetData != null) {
          $preventionLogsheet = $logSheetData;
        } else {
          $preventionLogsheet = "no data";
        }

        if ($cbsData == null) {
          $cbsData = "no data";
        }


        return response()->json([

          $patientData,
          $ptNameDecrypt,
          $ptFather,
          $dob,
          $region,
          $town,
          $quarter,
          $gender,
          $phone,
          $phone2,
          $phone3,
          $main_risk,
          $sub_risk,

          $preventionLogsheet,
          $cbsData,


        ]);
      } else {
        $err = null;
        return response()->json([
          $err
        ]);
        $ckID = "no data";
      }
    }
  }
  public function search_fuchia_eixsting($request)
  {
    $fuchiaShar   = $request->input('fuchiaShar');

    if ($fuchiaShar == 1) { //to check the patient is in general patients list
      $fuID    = $request->input('fuID');
      $patientData = PtConfig::where('FuchiaID', '=', $fuID)->first();


      if ($patientData != null) {
        $ptNameDecrypt = $patientData["Name"];
        $ptNameDecrypt = Crypt::decryptString($ptNameDecrypt);

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


        $phone = Crypt::decryptString($patientData["Phone"]);
        $phone2 = Crypt::decryptString($patientData["Phone2"]);
        $phone3 = Crypt::decryptString($patientData["Phone3"]);

        $table = "General";

        $gender = Crypt::decrypt_light($patientData["Gender"], $table);
        $main_risk = Crypt::decrypt_light($patientData["Main Risk"], $table);
        $sub_risk = Crypt::decrypt_light($patientData["Sub Risk"], $table);

        return response()->json([

          $patientData,
          $ptNameDecrypt,
          $ptFather,
          $dob,
          $region,
          $town,
          $quarter,
          $gender,
          $phone,
          $phone2,
          $phone3,
          $main_risk,
          $sub_risk,

        ]);
      } else {
        $err = null;
        return response()->json([
          $err
        ]);
        $ckID = "no data";
      }
    }
  }
  public function determineResult($request)
  {
    $generalID = $request->input('Pid');
    $vDate = $request->input('vDate');

    $latestVisit = Lab::where('CID', $generalID)
      ->where('vdate', $vDate)
      ->latest('vdate') // Order by visit_date in descending order
      ->first();
    return response()->json([$latestVisit]);
  }
  public function confidential($request)
  {

    $goal   = $request->input('goal');
    // to register newly confidential data
    if ($goal == 1) {

      $table = "General";
      $name = Crypt::encryptString($request->input('name'));
      $father = Crypt::encryptString($request->input('father'));
      $dob = Crypt::encryptString($request->input('dob'));
      $state = Crypt::encryptString($request->input('state'));
      $township = Crypt::encryptString($request->input('tt'));
      $quarter = Crypt::encryptString($request->input('quarter'));
      $phone = Crypt::encryptString($request->input('phone'));
      $phone2 = Crypt::encryptString($request->input('phone2'));
      $phone3 = Crypt::encryptString($request->input('phone3'));

      $main_risk = Crypt::encrypt_light($request->input('main_risk'), $table);
      $sub_risk = Crypt::encrypt_light($request->input('sub_risk'), $table);
      $gender = Crypt::encrypt_light($request->input('gender'), $table);

      $ConfigData = PtConfig::create([

        "Clinic Code" => $request->clinic_code,
        'Pid' => $request->gid,
        'FuchiaID' => $request->fid,
        'PrEPCode' => $request->prepCode,
        'Name' => $name,
        'Father' => $father,
        'Agey' => $request->register_agey,
        'Agem' => $request->register_agem,
        'Gender' => $gender,
        'Reg Date' => $request->regDate,
        'Date Of Birth' => $dob,
        'Region' => $state,
        'Township' => $township,
        'Quarter' => $quarter,

        'Main Risk' => $main_risk,
        'Sub Risk' => $sub_risk,
        // 'Risk Changed'=>$request ->risk_really_change,

        //'Former Risk',
        //'Risk Change_Date' ,
        'Phone' => $phone,
        'Phone2' => $phone2,
        'Phone3' => $phone3,

        'created_by' => $request->created_by,

      ]);
      Patients::create([
        "Clinic Code"           => $request->clinic_code,
        "Pid"                   => $request->gid,
        "FuchiaID"              => $request->fid,
        'PrEPCode'              => $request->prepCode,
        "Agey"                  => $request->register_agey,
        "Agem"                  => $request->register_agem,
        "Gender"                => $gender,
        'Reg Date'              => $request->regDate,
        'Date Of Birth'         => $dob,

        'Main Risk'             => $main_risk,
        'Sub Risk'              => $sub_risk,

      ]);


      if ($ConfigData instanceof PtConfig) {
        // // Data was successfully inserted
        $dardar = [];
        $dardar["ckID"] = 1;
        $dardar["generalID"] = $request->input('gid');
        $ConfigDataArray = $this->Finder($dardar);


        if ($goal == 1) {
          return response()->json([$goal, $ConfigDataArray]);
        }
      } else {
        if ($goal == 1) {
          $failed = "Failed";
          return response()->json([$failed]);
        }
      }
    }


    // to update to an old client's data


    if ($goal == 2) {
      return response()->json([
        $goal,
      ]);
    }
  }
  public function confidential_update($request)
  {

    $goal   = $request->input('goal');
    // to register newly confidential data
    if ($goal == 2) {

      $table = "General";
      $name = Crypt::encryptString($request->input('name'));
      $father = Crypt::encryptString($request->input('father'));
      $dob = Crypt::encryptString($request->input('dob'));
      $state = Crypt::encryptString($request->input('state'));
      $township = Crypt::encryptString($request->input('tt'));
      $quarter = Crypt::encryptString($request->input('quarter'));
      $phone = Crypt::encryptString($request->input('phone'));
      $phone2 = Crypt::encryptString($request->input('phone2'));
      $phone3 = Crypt::encryptString($request->input('phone3'));
      $registerDate = $request->input('regDate');
      $main_risk = Crypt::encrypt_light($request->input('main_risk'), $table);

      $main_riskChange = Crypt::encrypt_light($request->input('main_riskChange'), $table);

      if (strlen($main_riskChange) > 3) {
        $formerRisk = $main_risk;
        $main_risk = $main_riskChange;
      } else {
        $formerRisk = "";
      }
      if ($request->changeriskDate == null) {
        $request->changeriskDate = Carbon::now()->format('Y-m-d');;
      }
      $sub_risk = Crypt::encrypt_light($request->input('sub_risk'), $table);
      $gender = Crypt::encrypt_light($request->input('gender'), $table);



      $Pid   = $request->input('gid');
      $old_risk_log = PtConfig::where('Pid', $Pid)->select("Risk Log")->first();
      $risk_history = $old_risk_log["Risk Log"] . $request->changeriskDate . ':' . $formerRisk . ':' . $main_risk . ':' . $request["risk_really_change"] . ':' . $request->created_by . '/';
      PtConfig::where('Pid', $Pid)->where('Main Risk', "!=", $main_risk)->where('Main Risk', "!=", null)
        ->where('Main Risk', "!=", "731")
        ->update([
          "Risk Log" => $risk_history,
        ]);
      Patients::where('Pid', $Pid)->where('Main Risk', "!=", $main_risk)->where('Main Risk', "!=", null)
        ->where('Main Risk', "!=", "731")
        ->update([
          "Risk Log" => $risk_history,
        ]);




      PtConfig::where('Pid', $Pid)
        ->update([

          "Clinic Code" => $request->clinic_code,
          'Pid' => $request->gid,
          'FuchiaID' => $request->fid,
          'PrEPCode' => $request->prepCode,
          'Name' => $name,
          'Father' => $father,
          'Agey' => $request->register_agey,
          'Agem' => $request->register_agem,
          'Gender' => $gender,
          'Reg Date' => $registerDate,
          'Date Of Birth' => $dob,
          'Region' => $state,
          'Township' => $township,
          'Quarter' => $quarter,

          'Main Risk' => $main_risk,
          'Sub Risk' => $sub_risk,
          'mode' => 0,

          // 'Risk Change_Date' =>$request["risk_really_change"] == 'Yes' ? $request -> changeriskDate : null,
          // 'Former Risk' => $request["risk_really_change"] == 'Yes' ? $formerRisk : null,
          'Phone' => $phone,
          'Phone2' => $phone2,
          'Phone3' => $phone3,
          'updated_by' => $request->created_by,

        ]);
      Patients::where('Pid', $Pid)
        ->update([
          "Clinic Code"           => $request->clinic_code,
          "Pid"                   => $request->gid,
          "FuchiaID"              => $request->fid,
          'PrEPCode'              => $request->prepCode,
          "Agey"                  => $request->register_agey,
          "Agem"                  => $request->register_agem,
          "Gender"                => $gender,
          'Reg Date'              => $registerDate,
          'Date Of Birth'         => $dob,
          'Main Risk'             => $main_risk,
          'Sub Risk'              => $sub_risk,
          'updated_by' => $request->created_by,

        ]);
      if ($request["risk_really_change"] == "Yes") {
        PtConfig::where('Pid', $Pid)
          ->update([
            "Risk changed" => "Yes",
            'Former Risk' => $formerRisk,
            'Risk Change_Date' => $request->changeriskDate,
          ]);
        Patients::where('Pid', $Pid)
          ->update([
            "Risk changed" => "Yes",
            'Former Risk' => $formerRisk,
            'Risk Change_Date' => $request->changeriskDate,
          ]);
      }

      $cofid_updated_data = PtConfig::where('Pid', $Pid)->get();
      $cofid_updated_data[1] = $request->input('name');
      $cofid_updated_data[2] = $request->input('father');
      $cofid_updated_data[3] = $request->input('dob');
      $cofid_updated_data[5] = $request->input('tt');
      $cofid_updated_data[7] = $request->input('gender');
      $cofid_updated_data[11] = $request->input('main_risk');
      $cofid_updated_data[12] = $request->input('sub_risk');
      $logSheetData =  PreventionLogsheet::where('Pid', '=', $Pid)->get();
      foreach ($logSheetData as $key => $logsheet) {
        $logSheetData[$key]['Visit_Date'] = date("d-m-Y", strtotime($logsheet['Visit_Date']));
      }
      $cofid_updated_data[13] = $logSheetData;





      $chDate = $request->input('changeriskDate');
      if (strtotime($chDate) !== false) {
        PreventionLogsheet::where('Pid', $Pid)
          ->where('Visit_Date', '=', $chDate)
          ->update([
            "Risk changed" => true,
            "Changed_Risk" => $main_risk,
            "Risk changed Date" => $chDate,
          ]);
      }
      return response()->json([
        $goal, $cofid_updated_data,
      ]);
    }




    // to update to an old client's data

    if ($goal == 2) {
      return response()->json([
        $goal
      ]);
    }
  }
  public function logsheet($request)
  {
    $table = "General";
    // For He_Section data Concatination 
    $hiv_1 = $request->input('hiv_1');
    $sti_2 = $request->input('sti_2');
    $self_inject_3 = $request->input('self_inject_3');
    $safe_sex_4 = $request->input('safe_sex_4');
    $mmt_5 = $request->input('mmt_5');
    $tb = $request->input('tb');
    $family_plan = $request->input('family_plan');
    $overdose = $request->input('overdose');
    $hbvhcv = $request->input('hbvhcv');

    $HE_section = "";

    $he_section_arr = [$hiv_1, $sti_2, $self_inject_3, $safe_sex_4, $mmt_5, $tb, $family_plan, $overdose, $hbvhcv];
    foreach ($he_section_arr as $key => $value) {
      switch (true) {
        case $value != "":
          $HE_section = $HE_section . $value . ",";
          break;
      }
    }
    $Pid = $request->input('Pid');
    $vDate = $request->input('vDate');

    $Present_row_logsheet = PreventionLogsheet::where('Pid', $Pid)
      ->whereDate('Visit_Date', $vDate)
      ->exists();
    if (!$Present_row_logsheet) {

      $preVentdata = PreventionLogsheet::create([

        "He Code"                 => $request->He_code,
        "Clinic Code"             => $request->clinic_code,
        'Pid'                     => $request->Pid,
        "FuchiaID"                => $request->FuchiaID,
        "PrEPCode"                => $request->PrEPCode,

        "Agey"                    => $request->Age,
        "Sex"                     => $request->Sex,

        "Main_Risk"               => Crypt::encrypt_light($request->Main_Risk, $table),
        "Sub_Risk"                => Crypt::encrypt_light($request->Sub_Risk, $table),
        "Township"                => Crypt::encrypt_light($request->Township, $table),

        // "Reg_Date"                => $request ->Reg_Date ,
        "Visit_Date"              => $request->vdate,

        "New_Old"                 => $request->New_old,
        "Substantial Risk"        => $request->substainRisk,
        "Meeting Point"           => $request->meet_point,
        "Service Provision1"      => $request->serProvi_1,
        "Service Provision2"      => $request->serProvi_2,
        "Service Provision3"      => $request->serProvi_3,
        "HE_Section"              => $HE_section,
        "Ns_distribute"           => $request->ns_distru,
        "Condom_m"                => $request->comdome_male,
        "Condom_f"                => $request->comdome_female,
        "Ns_return"               => $request->ns_return,
        "HIV Status"              => Crypt::encrypt_light($request->hiv_status1, $table),

        "Test_duration"           => $request->hiv_status2,
        "HTS done"                => $request->Hts_done,
        "HIV_Final_result"        => Crypt::encrypt_light($request->final_result, $table), // Final
        "date_confirm"            => $request->date_comfirm,
        "Reach_whom"              => $request->reach_whom,
        // township_log	 need to ask (Reuse or not)
        "Source_doc"              => $request->source_doc,
        "Remark"                  => $request->log_remark,

        "Initial Risk"            => $request->Initial_Risk,          // add   
        // "Reg Year"              => $request ->Reg_Year ,             // add  
        // "Visit Year"            => $request ->Visit_Year ,            // add  
        // "Current Age"           => $request ->Current_Age ,
        "Mental_Health"         => $request->Mental_Health,
        "PHQ4_Q1_Q2"            => $request->PHQ4_1_2,
        "PHQ4_Q3_Q4" => $request->PHQ4_3_4,
        // "OST_Done"=>$request->OST_done,
        "OST_Accept" => $request->OST_accept,
        "OST_Eligible" => $request->OST_eligible,
        "Decline_Reason_new" => $request->decline_reason,
        "Referral_Coupon" => $request->referral_coupon,
        "Test_Clinic" => $request->test_clinic,
        // "OST_Initial_Date"=>$request->OST_inital_date,
        "Test_New_Old" => $request->Lab_New_old,
      ]);

      if ($preVentdata instanceof PreventionLogsheet) {
        $HE_section = "He section";
        $reqData = PreventionLogsheet::where('Pid', $Pid)
          ->whereDate('Visit_Date', $vDate)
          ->first();
        $reqData["Visit_Date"] = date("d-m-Y", strtotime($reqData["Visit_Date"]));
        return response()->json([
          $HE_section, $reqData
        ]);
      }
    } else {
      $dupli = false;
      return response()->json([$dupli]);
    }
  }
  // 8
  public function fatchData_to_update($request)
  {
    $ptID   = $request->input('ptID');
    $rowID   = $request->input('rowID');
    $table = "General";
    $toUpdateFollowup   = $request->input('toUpdateFollowup');
    if ($toUpdateFollowup == 1) {

      $ptData = PreventionLogsheet::where('id', $rowID)->where('Pid', $ptID)->first();
      $ptData["HIV Status"] = Crypt::decrypt_light($ptData["HIV Status"], $table);
      $ptData["Test_duration"] = $ptData["Test_duration"];
      $ptData["HIV_Final_result"] = Crypt::decrypt_light($ptData["HIV_Final_result"], $table);
      $ptData["Main_Risk"] = Crypt::decrypt_light($ptData["Main_Risk"], $table);
      $ptData["Sub_Risk"] = Crypt::decrypt_light($ptData["Sub_Risk"], $table);


      $configData = PtConfig::where('Pid', '=', $ptID)->first();
      $configData["Gender"] = Crypt::decrypt_light($configData["Gender"], $table);
      $configData["Main Risk"] = Crypt::decrypt_light($configData["Main Risk"], $table);
      $configData["Sub Risk"] = Crypt::decrypt_light($configData["Sub Risk"], $table);
      $configData["Township"] = Crypt::decrypt_light($configData["Township"], $table);


      $section = 1;
      return response()->json([
        $ptData,
        $configData,
        $section,

      ]);
    }
  }
  public function Followup_to_update($request)
  {

    $table = "General";
    // For He_Section data Concatination 
    $hiv_1 = $request->input('hiv_1');
    $sti_2 = $request->input('sti_2');
    $self_inject_3 = $request->input('self_infect_3');
    $safe_sex_4 = $request->input('safe_sex_4');
    $mmt_5 = $request->input('mmt_5');
    $tb = $request->input('tb');
    $family_plan = $request->input('family_plan');
    $overdose = $request->input('overdose');
    $hbvhcv = $request->input('hbvhcv');

    $HE_section = "";

    $he_section_arr = [$hiv_1, $sti_2, $self_inject_3, $safe_sex_4, $mmt_5, $tb, $family_plan, $overdose, $hbvhcv];
    foreach ($he_section_arr as $key => $value) {
      switch (true) {
        case $value != "":
          $HE_section = $HE_section . $value . ",";
          break;
      }
    }

    $Pid = $request->input('Pid');
    $vDate = $request->input('vDate');
    $RowID = $request->input("RowID");

    PreventionLogsheet::where('id', $RowID)
      ->update([
        "He Code"                 => $request->He_code,
        "Clinic Code"             => $request->clinic_code,
        'Pid'                     => $request->Pid,
        "FuchiaID"                => $request->FuchiaID,
        "PrEPCode"                => $request->PrEPCode,

        "Agey"                    => $request->Age,
        "Sex"                     => $request->Sex,

        "Main_Risk"               => Crypt::encrypt_light($request->Main_Risk, $table),
        "Sub_Risk"                => Crypt::encrypt_light($request->Sub_Risk, $table),

        // "Reg_Date"                => $request ->Reg_Date ,
        "Visit_Date"              => $request->vdate,

        "New_Old"                 => $request->New_old,
        "Substantial Risk"        => $request->substainRisk,
        "Meeting Point"           => $request->meet_point,
        "Service Provision1"      => $request->serProvi_1,
        "Service Provision2"      => $request->serProvi_2,
        "Service Provision3"      => $request->serProvi_3,
        "HE_Section"              => $HE_section,
        "Ns_distribute"           => $request->ns_distru,
        "Condom_m"                => $request->comdome_male,
        "Condom_f"                => $request->comdome_female,
        "Ns_return"               => $request->ns_return,
        "HIV Status"              => Crypt::encrypt_light($request->hiv_status1, $table),

        "Test_duration"           => $request->hiv_status2,
        "HTS done"                => $request->Hts_done,
        "HIV_Final_result"        => Crypt::encrypt_light($request->final_result, $table), // Final
        "date_confirm"            => $request->date_comfirm,
        "Reach_whom"              => $request->reach_whom,
        // township_log	 need to ask (Reuse or not)
        "Source_doc"              => $request->source_doc,
        "Remark"                  => $request->log_remark,
        "Mental_Health"         => $request->Mental_Health,
        "PHQ4_Q1_Q2"            => $request->PHQ4_1_2,
        "PHQ4_Q3_Q4" => $request->PHQ4_3_4,
        // "OST_Done" => $request->OST_done,
        // "OST_Accept" => $request->OST_accept,
        // "Decline_Reason" => $request->decline_reason,
        "Test_Clinic" => $request->test_clinic,
        "OST_Accept" => $request->OST_accept,
        "OST_Eligible" => $request->OST_eligible,
        "Decline_Reason_new" => $request->decline_reason,
        "Referral_Coupon" => $request->referral_coupon,
        // "OST_Initial_Date" => $request->OST_inital_date,
        "Test_New_Old" => $request->Lab_New_old,

      ]);


    $rece = "arrived to Followup_to _update";
    return response()->json([
      $rece

    ]);
  }
  public function change_id_in_followup_row($request)
  {
    $table = "General";
    $ptID   = $request->input('ptID_Change');
    $configData = PtConfig::where('Pid', '=', $ptID)->first();
    if ($configData) {
      $configData["Gender"] = Crypt::decrypt_light($configData["Gender"], $table);
      $configData["Main Risk"] = Crypt::decrypt_light($configData["Main Risk"], $table);
      $configData["Sub Risk"] = Crypt::decrypt_light($configData["Sub Risk"], $table);
      $configData["Township"] = Crypt::decrypt_light($configData["Township"], $table);
      return response()->json([
        $configData,
      ]);
    } else {
      $configData = false;
      return response()->json([
        $configData,
      ]);
    }
  }
  public function hiv_result_confirm($request)
  {
    $to_ck_id   = $request->input('to_ck_id');
    $hiv_confirm_date   = $request->input('hiv_confirm_date');

    $confirmData = Lab::where('CID', '=', $to_ck_id)
      ->where('vdate', '=', $hiv_confirm_date)
      ->first();
    if ($confirmData) {
      $confirmData["Final_Result"] = Crypt::decrypt_light($confirmData["Final_Result"], "General");
      return response()->json([
        $confirmData,
      ]);
    } else {
      $confirmData = false;
      return response()->json([
        $confirmData,
      ]);
    }
  }
  // CBS ***************************************************************
  public function cbs($request)
  {

    // $he = Crypt::encrypt_light($request -> input('he'),"General");
    // $condome =Crypt::encrypt_light($request -> input('condome'),"General");
    // $nsp =Crypt::encrypt_light($request -> input('nsp'),"General");
    // $cbs_sti =Crypt::encrypt_light($request -> input('cbs_sti'),"General");
    // $cbs_counselling =Crypt::encrypt_light($request -> input('cbs_counselling'),"General"); 

    $he = $request->input('he');
    $condome = $request->input('condome');
    $nsp = $request->input('nsp');
    $cbs_sti = $request->input('cbs_sti');
    $cbs_counselling = $request->input('cbs_counselling');

    $serviceProvision = $he . "," . $condome . "," . $nsp . "," . $cbs_sti . "," . $cbs_counselling;



    $Pid = $request->input('Pid');
    $vDate2 = $request->input('vDate2');
    $Present_row = PreventionCBS::where('Pid', $Pid)
      ->whereDate('Visit_Date', $vDate2)
      ->exists();
    if (!$Present_row) {
      $preVentdata =  PreventionCBS::create([
        "Clinic Code"       => $request->Clinic_Code,
        "Pid"               => $Pid,
        "FuchiaID"          => $request->FuchiaID,
        "PrEPCode"          => $request->PrEPCode,
        "Agey"              => $request->Agey,
        "Sex"               => $request->Sex,
        "Visit_Date"        => $vDate2,
        "New_Old"           => $request->reachKp_ptcalender,
        "Main_Risk"         => Crypt::encrypt_light($request->input('Risk'), "General"),
        "Meeting Point"     => $request->meetingPoint2,
        "Service Provision" => $serviceProvision,
        "Retesting"         => $request->retesting,
        "HIV result"        => Crypt::encrypt_light($request->input('HIV_status_2'), "General"),
        "HIV_determine_result" => Crypt::encrypt_light($request->input('hiv_determine'), "General"),
        "HIV Sero-Status"      => Crypt::encrypt_light($request->input('hiv_final'), "General"),
        "Counselling_pretest"       => $request->pre_counsel,
        "Counselling_posttest"       => $request->post_counsel,
        "Refer_to"          => $request->reactive_refer,
        "date_confirm"      => $request->date_confirm,
        "Remark"            => $request->remark,

        "Service_Modality"  => $request->service,
        "Mode_of_Entry"     => $request->mode,
      ]);
      Coulselling::create([
        'Clinic code'         => $request->Clinic_Code,
        'Pid'                 => $Pid,
        'FuchiaID'            => $request->FuchiaID,
        'Gender'              => $request->Sex,
        'Age'                 => $request->Agey,

        //'Counsellor'          => $request -> counsellor,
        'Counselling_Date'    => $vDate2,
        'Pre'                 => $request->pre_counsel,
        'Post'                => $request->post_counsel,

        'Main Risk'           => Crypt::encrypt_light($request->input('Risk'), "General"),
        //'Sub Risk'            => $request -> Sub_risk,

        'Service_Modality'    => $request->service,
        'Mode of Entry'       => $request->mode,

        //'New_Old'             => $request -> new_old,
        'HIV_Test_Date'       => $vDate2,
        'HIV_Test_Determine'  => Crypt::encrypt_light($request->input('hiv_determine'), "General"),
        // 'HIV_Test_UNI'        => $request -> hiv_unigold,
        // 'HIV_Test_STAT'       => $request -> hiv_stat,
        'HIV_Final_Result'    => Crypt::encrypt_light($request->input('hiv_final'), "General"),
        'CBS_HTS'             => 1,

        // 'Syp_Test_Date'       => $blank,
        // 'Syphillis_RDT'       => $request -> syp_rdt,
        // 'Syphillis_RPR'       => $request -> syp_rpr,
        // 'Syphillis_VDRL'      => $request -> syp_vdrl,

        // 'Hep_Test_Date'       => $request -> hep_date,
        // 'Hepatitis_B'         => $request -> hep_b,
        // 'Hepatitis_C'         => $request -> hep_c,

        //'created_by' => $request->updated_by,
      ]);


      if ($preVentdata instanceof PreventionCBS) {
        $success = "success";
        $reqData = PreventionCBS::where('Pid', $Pid)
          ->whereDate('Visit_Date', $vDate2)
          ->latest()
          ->first();
        $reqData["Visit_Date"] = date("d-m-Y", strtotime($reqData["Visit_Date"]));
        return response()->json([
          $success, [$reqData],
        ]);
      }
    } else {
      $dupli = false;
      return response()->json([$dupli]);
    }
  }
  // Number 12
  public function cbs_data_to_update($request)
  {
    $ptID   = $request->input('ptID');
    $rowID   = $request->input('rowID');
    $hts_date   = $request->input('hts_date');

    $table = "General";
    $toUpdateFollowup   = $request->input('toUpdateFollowup');
    if ($toUpdateFollowup == 1) {

      $ptData2 = PreventionCBS::where('id', $rowID)->where('Pid', $ptID)->first();
      if ($ptData2) {
        $ptData2["HIV_determine_result"] = Crypt::decrypt_light($ptData2["HIV_determine_result"], $table);
        $ptData2["HIV result"] = Crypt::decrypt_light($ptData2["HIV result"], $table);
        $ptData2["HIV Sero-Status"] = Crypt::decrypt_light($ptData2["HIV Sero-Status"], $table);
        $ptData2["Main_Risk"] = Crypt::decrypt_light($ptData2["Main_Risk"], $table);
        $ptData2["Sub_Risk"] = Crypt::decrypt_light($ptData2["Sub_Risk"], $table);
      } else {
        $ptData2 = "no data";
      }



      $configData = PtConfig::where('Pid', '=', $ptID)->first();
      if ($configData) {
        $configData["Gender"] = Crypt::decrypt_light($configData["Gender"], $table);
        $configData["Main Risk"] = Crypt::decrypt_light($configData["Main Risk"], $table);
        $configData["Sub Risk"] = Crypt::decrypt_light($configData["Sub Risk"], $table);
        $configData["Township"] = Crypt::decrypt_light($configData["Township"], $table);
      } else {
        $configData = "no data";
      }

      $hts_data = Coulselling::where('Pid', '=', $ptID)->where('Counselling_Date', '=', $hts_date)->first();

      $section = 2;
      return response()->json([
        $ptData2,
        $configData,
        $section,
        $hts_data,

      ]);
    }
  }
  public function cbs_followup_update($request)
  {
    $he = $request->input('he');
    $condome = $request->input('condome');
    $nsp = $request->input('nsp');
    $cbs_sti = $request->input('cbs_sti');
    $cbs_counselling = $request->input('cbs_counselling');

    $serviceProvision = $he . "," . $condome . "," . $nsp . "," . $cbs_sti . "," . $cbs_counselling;



    $Pid = $request->input('Pid');
    $vDate2 = $request->input('vDate2');
    $RowID = $request->input('RowID');

    PreventionCBS::where('id', $RowID)
      ->update([
        "Clinic Code"       => $request->Clinic_Code,
        "Pid"               => $Pid,
        "FuchiaID"          => $request->FuchiaID,
        "PrEPCode"          => $request->PrEPCode,
        "Agey"              => $request->Agey,
        "Sex"               => $request->Sex,
        "Visit_Date"             => $vDate2,
        "New_Old"           => $request->reachKp_ptcalender,
        "Main_Risk"         => Crypt::encrypt_light($request->input('Risk'), "General"),
        "Meeting Point"     => $request->meetingPoint2,
        "Service Provision" => $serviceProvision,
        "Retesting"         => $request->retesting,
        "HIV_determine_result"        => Crypt::encrypt_light($request->input('hiv_determine'), "General"),
        "HIV result"        => Crypt::encrypt_light($request->input('HIV_status_2'), "General"),
        "HIV Sero-Status"        => Crypt::encrypt_light($request->input('hiv_final'), "General"),
        "Counselling_pretest"       => $request->pre_counsel,
        "Counselling_posttest"       => $request->post_counsel,
        "Refer_to"          => $request->reactive_refer,
        "date_confirm"      => $request->date_confirm,

      ]);
    $blank = "";
    Coulselling::where('Pid', $Pid)->where('Counselling_Date', '=', $vDate2)
      ->update([
        'Clinic code'         => $request->Clinic_Code,
        'Pid'                 => $Pid,
        'FuchiaID'            => $request->FuchiaID,
        'Gender'              => $request->Sex,
        'Age'                 => $request->Agey,

        //'Counsellor'          => $request -> counsellor,
        'Counselling_Date'    => $request->$vDate2,
        'Pre'                 => $request->pre_counsel,
        'Post'                => $request->post_counsel,

        'Main Risk'           => Crypt::encrypt_light($request->input('Risk'), "General"),
        //'Sub Risk'            => $request -> Sub_risk,

        'Service_Modality'    => $request->service,
        'Mode of Entry'       => $request->mode,

        //'New_Old'             => $request -> new_old,
        'HIV_Test_Date'       => $vDate2,
        'HIV_Test_Determine'  => Crypt::encrypt_light($request->input('hiv_determine'), "General"),
        // 'HIV_Test_UNI'        => $request -> hiv_unigold,
        // 'HIV_Test_STAT'       => $request -> hiv_stat,
        'HIV_Final_Result'    => Crypt::encrypt_light($request->input('hiv_final'), "General"),

        // 'Syp_Test_Date'       => $blank,
        // 'Syphillis_RDT'       => $request -> syp_rdt,
        // 'Syphillis_RPR'       => $request -> syp_rpr,
        // 'Syphillis_VDRL'      => $request -> syp_vdrl,

        // 'Hep_Test_Date'       => $request -> hep_date,
        // 'Hepatitis_B'         => $request -> hep_b,
        // 'Hepatitis_C'         => $request -> hep_c,

        //'created_by' => $request->updated_by,
      ]);



    $success = "success";
    return response()->json([
      $success,
    ]);
  }


  public function logsheet_known_negative($request)
  {
    $kkID = $request->input('ptid');
    $vdate = $request->input('vdate');
    $diffInMonths = "0";
    $labData = PreventionLogsheet::select('Visit_Date')->where('Pid', '=', $kkID)->where('Visit_Date', "!=", $vdate)->whereDate('Visit_Date', '<', $vdate)
      ->latest('Visit_Date')
      ->first();

    if ($labData) {
      $diffInMonths = \Carbon\Carbon::parse($labData["Visit_Date"])->diffInMonths(\Carbon\Carbon::parse($vdate));
    }

    return response()->json([
      $diffInMonths, $labData
    ]);
  }
  // function 15
  public function export(Request $request)
  {
    $tableName = $request->input('tb_name');


    $from = $request->input('ddFrom');
    $date_from = DateTime::createFromFormat('d-m-Y', $from);
    $from = $date_from->format('Y-m-d');

    $to = $request->input('ddTo');
    $date_to = DateTime::createFromFormat('d-m-Y', $to);
    $to = $date_to->format('Y-m-d');
    if ($tableName == "log_sheet") {

      $data = PreventionLogsheet::with([
        'ptconfig' => function ($query) {
          $query->select('Pid', 'Name', 'Township', 'Date of Birth', 'Agey', 'Agem', 'Main Risk', 'Sub Risk', 'Former Risk', 'Risk Change_Date', 'Gender', 'Reg Date');
        }
      ])->whereBetween('Visit_Date', [$from, $to])->get();

      foreach ($data as $key => $per_data) {
        $data[$key]["Main_Risk"] = $per_data["ptconfig"]["Main Risk"];
        $data[$key]["Sub_Risk"] = $per_data["ptconfig"]["Sub Risk"];
        $data[$key]["Sex"] = $per_data["ptconfig"]["Gender"];
        $data[$key]["Reg_Date"] = $per_data["ptconfig"]["Reg Date"];
      }
      return Excel::download(new PreventionExport($data, $tableName), 'log_sheet_export-' . date("d-m-Y") . '-.xlsx');
    }
    if ($tableName == "cbs") {
      $cbs_data = PreventionCBS::with([
        'ptconfig' => function ($query) {
          $query->select("Pid", 'Date of Birth', 'Agey', 'Agem', "Main Risk", "Sub Risk", "Gender"); // Select the specific columns from ptconfig
        }
      ])->whereBetween('Visit_Date', [$from, $to])->get();

      foreach ($cbs_data as $key => $per_data) {
        $cbs_data[$key]["Main Risk"] = $per_data["ptconfig"]["Main Risk"];
        $cbs_data[$key]["Sub Risk"] = $per_data["ptconfig"]["Sub Risk"];
        $cbs_data[$key]["Sex"] = $per_data["ptconfig"]["Gender"];
      }
      return Excel::download(new PreventionExport($cbs_data, $tableName), 'cbs_export.xlsx');
      // return response()->json([$tableName]);
    }

    if ($tableName == "confid") {
      $data0 = PtConfig::query()
        ->whereBetween('Reg Date', [$from, $to])
        ->get();
      $visit_date = $to;

      return Excel::download(new ConfidExport($data0, $visit_date, $tableName), 'registration_export-' . date("d-m-y") . '-.xlsx');
    }
  }


  public function Finder($dataKeys)
  {

    $ckID   = $dataKeys['ckID'];

    if ($ckID == 1) { //to check the patient is in general patients list
      $generalID    = $dataKeys['generalID'];
      $patientData = PtConfig::where('Pid', '=', $generalID)->first();
      $logSheetData =  PreventionLogsheet::where('Pid', '=', $generalID)->get();
      $cbsData =  PreventionCBS::where('Pid', '=', $generalID)->get();

      $currentDate = Carbon::now();
      $formattedDate = $currentDate->format('Y-m-d H:i:s');
      $currentDateOnly = $currentDate->toDateString();
      $currentYear = Carbon::now()->year;
      $startDate = $currentYear . "-" . "01" . "-" . "01";
      $logSheetData_New_Old =  PreventionLogsheet::where('Pid', '=', $generalID)
        ->whereBetween('Visit_Date', [$startDate, $currentDateOnly])
        ->get();




      if ($patientData != null) {
        $ptNameDecrypt = $patientData["Name"];
        $ptNameDecrypt = Crypt::decryptString($ptNameDecrypt);

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


        $phone = Crypt::decryptString($patientData["Phone"]);
        $phone2 = Crypt::decryptString($patientData["Phone2"]);
        $phone3 = Crypt::decryptString($patientData["Phone3"]);

        $table = "General";

        $gender = Crypt::decrypt_light($patientData["Gender"], $table);
        $main_risk = Crypt::decrypt_light($patientData["Main Risk"], $table);
        $sub_risk = Crypt::decrypt_light($patientData["Sub Risk"], $table);

        if ($logSheetData != null) {
          $preventionLogsheet = $logSheetData;
        } else {
          $preventionLogsheet = "no data";
        }

        if ($cbsData == null) {
          $cbsData = "no data";
        }


        return ([

          $patientData,
          $ptNameDecrypt,
          $ptFather,
          $dob,
          $region,
          $town,
          $quarter,
          $gender,
          $phone,
          $phone2,
          $phone3,
          $main_risk,
          $sub_risk,

          $preventionLogsheet,
          $cbsData,

          $logSheetData_New_Old
        ]);
      }
    }
  }

  public function new_old($request)
  {

    if ($request["LS_updateSignal"] == "222") {
      $new_old["logCBS_reach"] = PreventionLogsheet::whereYear('Visit_Date', $request["visit_year"])
        ->where("Pid", $request["general_ID"])
        ->whereDate('Visit_Date', '<', $request["vdate"])
        ->exists();
    } else {
      $new_old["logCBS_reach"] = PreventionLogsheet::whereYear('Visit_Date', $request["visit_year"])
        ->whereDate('Visit_Date', '<', $request["vdate"])
        ->where("Pid", $request["general_ID"])->exists();
    }
    $new_old["lob_result"] = Lab::select("Final_Result")->where('Visit_Date', $request["vdate"])
      ->where("CID", $request["general_ID"])->first();
    if ($new_old["lob_result"]) {
      $new_old["lob_result"] = Crypt::decrypt_light($new_old["lob_result"]["Final_Result"], "General");
    }

    return response()->json([
      $new_old
    ]);
  }
}// class End