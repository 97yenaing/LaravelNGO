<?php

namespace App\Http\Controllers;
//use App\Exports\RiskLog\RiskHistroy;

use App\Exports\RiskbackExcel\RefillRisk;
use App\Exports\RiskLog\RiskHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;
use Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;



class RiskLogController extends Controller
{
  //new Ncd view
  public function risk_log_View()
  {
    return view('RiskHistory.risk_history', [
      'final_log' => null,
    ]);
  }
  public function risk_log(Request $request)
  {
    //dd($request);
    $table = "General";
    if ($request["notice"] == "RiskLogView") {
      $final_log = [];

      dd($request);

      if ($request["searchType"] == "Date") {
        $validator = Validator::make($request->all(), [
          'riskLog_From' => 'required|date', // Ensures 'riskLog_From' is a valid date
          'riskLog_To' => 'required|date',
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $request["riskLog_From"] = Carbon::parse($request["riskLog_From"])->format('Y-m-d');
        $request["riskLog_To"] = Carbon::parse($request["riskLog_To"])->format('Y-m-d');

        $export_viewData = Followup_general::on('mysql') // Specify the connection for Followup_general table
          ->whereBetween('Visit Date', [$request["riskLog_From"], $request["riskLog_To"]])
          ->join('confid.pt_configs', 'followup_generals.Pid', '=', 'pt_configs.Pid') // specify the connection for pt_configs table
          ->whereNotNull('pt_configs.Risk Log') // additional condition
          ->select('pt_configs.Risk Log', 'pt_configs.Pid')
          ->get();
      } else if ($request["searchType"] == "ID") {
        $validator = Validator::make($request->all(), [
          'riskLog_searchID' => 'required|integer', // Ensures 'riskLog_From' is a valid date
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $export_viewData = PtConfig::select("Risk Log", "Pid")->where("Pid", $request["riskLog_searchID"])->where("Risk Log", "!=", null)->get();
      }
      $final_log = RefillRisk::FillRisk($export_viewData);
      if ($request["export_view"] == "Export") {
        return Excel::download(new RiskHistory($final_log), 'Risk_Log(Export)-' . date("d-m-Y") . '.xlsx');
      } else {
        $request["riskLog_From"] = Carbon::parse($request["riskLog_From"])->format('d-m-Y');
        $request["riskLog_To"] = Carbon::parse($request["riskLog_To"])->format('d-m-Y');
        return redirect()->back()->withInput()->with('final_log', $final_log);
      }
    } elseif ($request["notice"] == "RiskLogUpdate") {
      $export_viewData = PtConfig::select("Risk Log", "Pid")->where("Pid", $request["generalID"])->where("Risk Log", "!=", null)->get();
      $final_log = RefillRisk::FillRisk($export_viewData);
      return response()->json($final_log);
    } elseif ($request["notice"] == "Updating Risk Log") {
      $riskhistory = null;
      $riskencrypt = [
        "mainRiskOld", "mainRiskCurrent", "subRiskOld", "subRiskCurrent"
      ];
      foreach ($request["riskFinaldata"] as $value) {
        foreach ($riskencrypt as $encrypt) {
          $value[$encrypt] = Crypt::encrypt_light($value[$encrypt], $table);
        }
        $riskhistory = $riskhistory . $value["riskChangeDate"] . ":" . $value["mainRiskOld"] . ":" . $value["mainRiskCurrent"] . ":" . $value["duetoPatient"] . ":" . $value["cangeUser"] . ":" . $value["subRiskOld"] . ":" . $value["subRiskCurrent"] . "/";
      }
      $updated = PtConfig::where('Pid', $request["generalID"])
        ->update([
          "Risk Log" => $riskhistory,
        ]);
      return response()->json($updated);
    }
  }
}
