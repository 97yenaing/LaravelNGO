<?php

namespace App\Http\Controllers;
//use App\Exports\RiskLog\RiskHistroy;
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



class ServerRiskLogController extends Controller
{
  //new Ncd view
  protected $DB = ["MAM_A", "MAM_C1", "MAM_C2", "MAM_B", "SPT"];
  public function risk_log_View()
  {
    return view('MME.serverRiskLog', [
      'final_log' => null,
    ]);
  }
  public function risk_log(Request $request)
  {
    $final_log = [];
    $table = "General";
    $define_name = ["RiskChangeDate", "Old Risk", "Current Risk", "Due_to_patient", "change_user"];
    if ($request["searchType"] == "Date") {
      $validator = Validator::make($request->all(), [
        'riskLog_From' => 'required|date', // Ensures 'riskLog_From' is a valid date
        'riskLog_To' => 'required|date',
        "clinic_road" => [
          "required",
          function ($attribute, $value, $fail) {
            if (count($this->DB) < $value) {
              $fail("The clinic doesn't have in server.");
            }
          },
        ],
      ]);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      $request["riskLog_From"] = Carbon::parse($request["riskLog_From"])->format('Y-m-d');
      $request["riskLog_To"] = Carbon::parse($request["riskLog_To"])->format('Y-m-d');

      $modelClassName = "App\\Models\\Followup_general"; // extend model
      $model = app()->make($modelClassName); // resolves the model from the service container.
      $model->setConnection($this->DB[$request["clinic_road"]]);

      $export_viewData = $model // Specify the connection for Followup_general table
        ->whereBetween('Visit Date', [$request["riskLog_From"], $request["riskLog_To"]])
        ->join('patients', 'followup_generals.Pid', '=', 'patients.Pid') // specify the connection for pt_configs table
        ->whereNotNull('patients.Risk Log') // additional condition
        ->select('patients.Risk Log', 'patients.Pid')
        ->get();
    } else if ($request["searchType"] == "ID") {
      $validator = Validator::make($request->all(), [
        'riskLog_searchID' => 'required|integer', // Ensures 'riskLog_From' is a valid date
        "clinic_road" => [
        "required",
        function ($attribute, $value, $fail) {
        if (count($this->DB) < $value) { $fail("The clinic doesn't have in server."); } }, ],
      ]);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      $export_viewData = PtConfig::select("Risk Log", "Pid")->where("Pid", $request["riskLog_searchID"])->where("Risk Log", "!=", null)->get();
    }
    //dd($export_viewData);
    foreach ($export_viewData as $key => $value) {

      $log_counts = explode("/", $value["Risk Log"]);
      foreach ($log_counts as $log_count) {
        $risklog_detail = explode(":", $log_count);
        foreach ($risklog_detail as $index => $log) {
          if ($index == 0) {
            $change_date = Carbon::parse($log)->format('d-m-Y');
          } else if ($index == 1 || $index == 2) {
            $final_log[$value["Pid"]][$change_date][$define_name[$index]] = Crypt::decrypt_light($log, $table);
          } else {
            $final_log[$value["Pid"]][$change_date][$define_name[$index]] = $log;
          }
        }
      }
    }
    if ($request["export_view"] == "Export") {
      return Excel::download(new RiskHistory($final_log), 'Risk_Log(Export)-' . date("d-m-Y") . '.xlsx');
    } else {
      $request["riskLog_From"] = Carbon::parse($request["riskLog_From"])->format('d-m-Y');
      $request["riskLog_To"] = Carbon::parse($request["riskLog_To"])->format('d-m-Y');
      return redirect()->back()->withInput()->with('final_log', $final_log);
    }
  }
}