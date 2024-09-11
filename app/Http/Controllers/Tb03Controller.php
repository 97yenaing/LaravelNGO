<?php

namespace App\Http\Controllers;
//namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;
use App\Models\Dispensing;
use App\Models\tb_registerO3;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use App\Exports\TB03\TB03_Report;
use App\Exports\TB03\TB08_Report;
use App\Exports\TB03\TB_IPT_Report;
use App\Exports\TB03\TB03_Export;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Export_age;

class Tb03Controller extends Controller
{
  public function tb03_View()
  {
    return view('TB.tb03', ["report_view" => null]);
  }

  public function Tb03(Request $request)
  {
    $table = "General";
    $notice = $request->input('notice');
    if ($notice == "Find TB03 patient") {
      $Tb03_general = [];
      $Pid03 = $request->input('Pid03');
      $Fid03 = $request->input('Fid03');
      $TB03_Id = $request->input('TB03_Id');
      $NewRc_sameId = $request->input('NewRc_sameId');



      $Tb03_general[0] = PtConfig::select("Agey", "Agem", "Region", "Township", "Clinic Code", "Gender", "Pid", "FuchiaID", "Date of Birth", 'Reg Date')
        ->where('Pid', $Pid03)
        ->orwhere(function ($query) use ($Fid03) {
          if ($Fid03 !== null && $Fid03 !== "-") {
            $query->where('FuchiaID', $Fid03);
          }
        })
        ->first();
      if ($Tb03_general[0] !== null) {
        $Tb03_general[0] = Export_age::Export_general($Tb03_general[0], null, $Tb03_general[0]["Date of Birth"], $Tb03_general[0]);
        $Tb03_general[0]['Region'] = Crypt::decryptString($Tb03_general[0]['Region']);
        $Tb03_general[0]['Date of Birth'] = Crypt::decryptString($Tb03_general[0]['Date of Birth']);
        $Tb03_general[0]['Township'] = Crypt::decryptString($Tb03_general[0]['Township']);
        $Tb03_general[0]['Gender'] = Crypt::decrypt_light($Tb03_general[0]['Gender'], $table);
        $fine_date = explode('-', $Tb03_general[0]['Reg Date']);
        $Tb03_general[0]['Reg Date'] = $fine_date[2] . '-' . $fine_date[1] . '-' . $Tb03_general[0]['Reg year'];
      }
      if ($request["ID_change"] != "yes") {
        $Tb03_general[1] = tb_registerO3::where('Pid_TB03', $Pid03)
          ->orwhere(function ($query) use ($Fid03) {
            if ($Fid03 !== null && $Fid03 !== "-") {
              $query->where('FuchiaID_TB03', $Fid03);
            }
          })
          ->orwhere(function ($query) use ($TB03_Id) {
            if ($TB03_Id !== null && $TB03_Id !== "-") {
              $query->where('TNumber_TB03', $TB03_Id);
            }
          })->get();
      }



      return response()->json($Tb03_general);
    } else if ($notice == "TB_03 Register") {

      tb_registerO3::create([
        'Clinic_code' => $request->input("Clinic Code"),
        'Pid_TB03' => $request->input("TB03_pid"),
        'FuchiaID_TB03' => $request->input("TB03_fuchiaId"),
        'TNumber_TB03' => $request->input("TB03_id"),
        'Age_TB03' => $request->input("TB03_age"),
        'Gender' => $request->input("TB03_gender"),
        'TreDate_TB03' => $request->input("TB03_tremDate"),
        'State_TB03' => $request->input("TB03_state"),
        'Township_TB03' => $request->input("TB03_town"),
        'Nationality_TB03' => $request->input("TB03_nationality"),
        'FaciName_TB03' => $request->input("TB03_facility"),
        'RePariod_TB03' => $request->input("TB03_reportPeriod"),
        'TranferIn_TB03' => $request->input("TB03_transfer"),
        'ReferFrom_TB03' => $request->input("TB03_referFrom"),
        'TypePatient_TB03' => $request->input("TB03_typePatient"),
        'TBsite_TB03' => $request->input("TB03_site"),
        'EPTBsite_TB03' => $request->input("TB03_EPTB"),
        'TreRegimens_TB03' => $request->input("TB03_treRegimens"),
        'Smoke_status_TB03' => $request->input("TB03_smoke"),
        'DMstatue_TB03' => $request->input("TB03_dm"),
        'Hivstatus_TB03' => $request->input("TB03_hiv"),
        'ART_start_TB03' => $request->input("TB03_ART"),
        'CPT_start_TB03' => $request->input("TB03_CPT"),
        'Microscope_Res_TB03' => $request->input("TB03_microscope"),
        'Xpert_Res_TB03' => $request->input("TB03_Xpert"),
        'XRay_Res_TB03' => $request->input("TB03_Xray"),
        'Calture_Res_TB03' => $request->input("TB03_culture"),
        'Counsellor_TB03' => $request->input("TB03_counselor"),
        'BioClinical_TB03' => $request->input("TB03_bactlogical"),
        '2ndMicroscope_Res_TB03' => $request->input("TB03_2ndmicroscope"),
        '2ndXpert_Res_TB03' => $request->input("TB03_2ndXpert"),
        '3rdMicroscope_Res_TB03' => $request->input("TB03_3rdmicroscope"),
        '3rdXpert_Res_TB03' => $request->input("TB03_3rdXpert"),
        '5rdMicroscope_Res_TB03' => $request->input("TB03_5thmicroscope"),
        '5rdXpert_Res_TB03' => $request->input("TB03_5thXpert"),
        'EndTX_Microscope_Res_TB03' => $request->input("TB03_endmicroscope"),
        'EndTX_XRay_Res_TB03' => $request->input("TB03_endXray"),
        'EndTX_Xpert_Res_TB03' => $request->input("TB03_endXpert"),
        'TrementOut_TB03' => $request->input("TB03_outcome"),
        'Intial_RegimenDate_TB03' => $request->input("TB03_IRSD"),
        'TrementOut_Date_TB03' => $request->input("TB03_outDate"),
        'EstimentOut_Date_TB03' => $request->input("TB03_EoutDate"),
        'Remark_TB03' => $request->input("TB03_remark"),
        '2ndCulture_Res_TB03' => $request->input('TB03_culture_m2'),
        '3rdCulture_Res_TB03' => $request->input('TB03_culture_m3'),
        '5rdCulture_Res_TB03' => $request->input('TB03_culture_m5'),
        '1stDst' => $request->input('1st_dst'),

      ]);
      return response()->json(["Register 03 save Successfully"]);
    } else if ($notice == "TB_03 Update") {
      $rid = $request->input("Rid");
      tb_registerO3::where("id", $rid)->update([
        'Clinic_code' => $request->input("Clinic Code"),
        'Pid_TB03' => $request->input("TB03_pid"),
        'FuchiaID_TB03' => $request->input("TB03_fuchiaId"),
        'TNumber_TB03' => $request->input("TB03_id"),
        'Age_TB03' => $request->input("TB03_age"),
        'Gender' => $request->input("TB03_gender"),
        'TreDate_TB03' => $request->input("TB03_tremDate"),
        'State_TB03' => $request->input("TB03_state"),
        'Township_TB03' => $request->input("TB03_town"),
        'Nationality_TB03' => $request->input("TB03_nationality"),
        'FaciName_TB03' => $request->input("TB03_facility"),
        'RePariod_TB03' => $request->input("TB03_reportPeriod"),
        'TranferIn_TB03' => $request->input("TB03_transfer"),
        'ReferFrom_TB03' => $request->input("TB03_referFrom"),
        'TypePatient_TB03' => $request->input("TB03_typePatient"),
        'TBsite_TB03' => $request->input("TB03_site"),
        'EPTBsite_TB03' => $request->input("TB03_EPTB"),
        'TreRegimens_TB03' => $request->input("TB03_treRegimens"),
        'Smoke_status_TB03' => $request->input("TB03_smoke"),
        'DMstatue_TB03' => $request->input("TB03_dm"),
        'Hivstatus_TB03' => $request->input("TB03_hiv"),
        'ART_start_TB03' => $request->input("TB03_ART"),
        'CPT_start_TB03' => $request->input("TB03_CPT"),
        'Microscope_Res_TB03' => $request->input("TB03_microscope"),
        'Xpert_Res_TB03' => $request->input("TB03_Xpert"),
        'XRay_Res_TB03' => $request->input("TB03_Xray"),
        'Calture_Res_TB03' => $request->input("TB03_culture"),
        'Counsellor_TB03' => $request->input("TB03_counselor"),
        'BioClinical_TB03' => $request->input("TB03_bactlogical"),
        '2ndMicroscope_Res_TB03' => $request->input("TB03_2ndmicroscope"),
        '2ndXpert_Res_TB03' => $request->input("TB03_2ndXpert"),
        '3rdMicroscope_Res_TB03' => $request->input("TB03_3rdmicroscope"),
        '3rdXpert_Res_TB03' => $request->input("TB03_3rdXpert"),
        '5rdMicroscope_Res_TB03' => $request->input("TB03_5thmicroscope"),
        '5rdXpert_Res_TB03' => $request->input("TB03_5thXpert"),
        'EndTX_Microscope_Res_TB03' => $request->input("TB03_endmicroscope"),
        'EndTX_XRay_Res_TB03' => $request->input("TB03_endXray"),
        'EndTX_Xpert_Res_TB03' => $request->input("TB03_endXpert"),
        'TrementOut_TB03' => $request->input("TB03_outcome"),
        'Intial_RegimenDate_TB03' => $request->input("TB03_IRSD"),
        'TrementOut_Date_TB03' => $request->input("TB03_outDate"),
        'EstimentOut_Date_TB03' => $request->input("TB03_EoutDate"),
        'Remark_TB03' => $request->input("TB03_remark"),
        '2ndCulture_Res_TB03' => $request['TB03_culture_m2'],
        '3rdCulture_Res_TB03' => $request['TB03_culture_m3'],
        '5rdCulture_Res_TB03' => $request['TB03_culture_m5'],
        '1stDst' => $request['1st_dst'],
      ]);
      return response()->json(["Register Update save Successfully"]);
    } else if ($notice == "TB 03 Report" || $notice == "TB 03 Export") {
      $dateForm = date("Y-m-d", strtotime($request["dateFrom"]));
      $dateTo = date("Y-m-d", strtotime($request["dateTo"]));
      $TB03_report_dataes = tb_registerO3::whereBetween("TreDate_TB03", [$dateForm, $dateTo])
        ->with([
          'ptconfig' => function ($query) {
            $query->select("Pid", 'Date of Birth', 'Agey', 'Agem', "Main Risk", "Sub Risk", "Gender", "FuchiaID");
          }
        ])->get()->makeHidden(['created_at', 'updated_at']);

      $TB03_report_date = ["TreDate_TB03", "ART_start_TB03", "CPT_start_TB03", "Intial_RegimenDate_TB03", "TrementOut_Date_TB03", "EstimentOut_Date_TB03"];
      foreach ($TB03_report_dataes as $index => $TB03_report_data) {
        if ($TB03_report_data["ptconfig"] != null) {
          $TB03_report_data = Export_age::Export_general($TB03_report_data["ptconfig"], $TB03_report_data["TreDate_TB03"], $TB03_report_data["ptconfig"]["Date of Birth"], $TB03_report_data);
          //dd($TB03_report_data);
          $TB03_report_data["Gender"] = Crypt::decrypt_light($TB03_report_data["ptconfig"]["Gender"], "General");
          if ($TB03_report_data["Gender"] == "Male") {
            $TB03_report_data["Gender"] = "M";
          } else {
            $TB03_report_data["Gender"] = "F";
          };
        }



        if ($notice != "TB 03 Report") {
          foreach ($TB03_report_date as $column) {
            if ($TB03_report_data[$column] != null) {
              $carbonDate = Carbon::createFromFormat('Y-m-d', $TB03_report_data[$column]);
              $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
              $TB03_report_dataes[$index][$column] = Date::dateTimeToExcel($carbonDate->toDateTime());
            }
          }
        }
      }

      if ($notice == "TB 03 Report") {
        $selected_report = $request["TB_03_report"];
        $report_type = $request["TB_03_report_type"];
        $cal_resultes = [];
        if ($selected_report == "TB_O7") {
          if ($report_type == "Report_view") {
            $report_view = new TB03_Report($TB03_report_dataes, $cal_resultes);
            $report_view->calculating_report();
            $report_view->cal_resultes["report_type"] = "Report_view";
            // dd($test->cal_resultes);
            return view('TB.export.tb03_report_07', [
              'cal_resultes' => $report_view->cal_resultes,
            ]);
          } else {

            return Excel::download(new TB03_Report($TB03_report_dataes, $cal_resultes), 'TB03 Report' . date("d-m-Y") . '.xlsx');
          }
        } //07
        else if ($selected_report == "TB_O8") {
          if ($report_type == "Report_view") {
            $report_view = new TB08_Report($TB03_report_dataes, $cal_resultes);
            $report_view->calculate_report_O8();
            $report_view->cal_resultes["report_type"] = "Report_view";

            return view('TB.export.tb03_report_08', [
              'cal_resultes' => $report_view->cal_resultes,
            ]);
          } else {
            return Excel::download(new TB08_Report($TB03_report_dataes, $cal_resultes), 'TB_08 Report' . date("d-m-Y") . '.xlsx');
          }
        } //08
        else {
          if ($report_type == "Report_view") {
            $report_view = new TB_IPT_Report($TB03_report_dataes, $cal_resultes);
            $report_view->calculate_report_IPT();
            $report_view->cal_resultes["report_type"] = "Report_view";
            // dd($test->cal_resultes);
            return view('TB.export.tb03_report_IPT', [
              'cal_resultes' => $report_view->cal_resultes,
            ]);
          } else {
            return Excel::download(new TB_IPT_Report($TB03_report_dataes, $cal_resultes), 'TB_IPT Report' . date("d-m-Y") . '.xlsx');
          }
        } //IPT






      } //TB all Report
      else {

        return Excel::download(new TB03_Export($TB03_report_dataes), 'TB03 Export' . date("d-m-Y") . '.xlsx');
      } //TB all Export

    } else if ($notice == "Remvoe TB03") {
      $delete = tb_registerO3::where('id', $request["id"])->where('Pid_TB03', $request["Pid"])->delete();
      if ($delete) {
        DB::statement('SET @id := 0');
        DB::statement('UPDATE tb_register_o3_s SET id = @id := @id + 1');
        DB::statement('ALTER TABLE tb_register_o3_s AUTO_INCREMENT = 1');
      }
      return response()->json($delete);
    }
  }

  public function tb03_goback()
  {
    return redirect()->back();
  }
}
