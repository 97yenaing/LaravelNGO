<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PtConfig_log;
use App\Models\Patient_log;
use Validator;




class IdFixController extends Controller
{
	public  function idFix_view()
	{
		return view('Id_Fix.Id_Delete', ['allCount' => null, 'Pid' => null]);
	}
	public function idFix_control(Request $request)
	{
		if ($request["notice"] == "View Detail") {
			$validator = Validator::make($request->all(), [
				"idInput" => "required",
			]);
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
		}

		$allTable = [
			'PtConfig', 'Patients', 'Followup_general', 'Lab', 'LabHbcTest', 'Urine',  'Labstitest', 'Lab_oi', 'LabGeneralTest', 'LabStoolTest', 'LabAfbTest',
			'LabCovidTest', 'Viralload', 'Rprtest', 'Coulselling', 'CounsellorRecords', 'Stifemale', 'Stimale', 'PreventionLogsheet', 'PreventionCBS', 'Cervicalcancer', 'cmv',
			'ncd_pt_register', 'ncdFollowup', 'tb_registerO3', 'Tbipt', 'preTB', 'Consumption',
		];
		$matchID = [
			'Pid', //Ptconfig 
			'Pid', //Patients
			'Pid', //reception
			'CID', //All Lab 
			'CID',
			'CID',
			'CID',
			'CID',
			'CID',
			'CID',
			'CID',
			'CID',
			'CID',
			'pid', //RPR
			'Pid', //Counselling
			'Pid', //Counsellor Record
			'CID', //sti female
			'CID', //sti male
			'Pid', //log sheet
			'Pid', //CBS
			'General ID', //Cancer
			'Pid_cmv', //CMV
			'Pid',
			'Pid',
			'Pid_TB03',
			'Pid_iptTB',
			'Pid_preTB',
			'Pid',
		];
		foreach ($allTable as $key => $table) {
			$delete_confid_data = null;
			$modelClass = 'App\\Models\\' . $table;
			if ($request["notice"] == "View Detail") {
				$allCount[$table] = $modelClass::where($matchID[$key], $request['idInput'])->count();
			} elseif ($request["notice"] == "Delete all") {
				if ($table == "PtConfig" || $table == "Patients") {
					$delete_confid_data = $modelClass::where($matchID[$key], $request['orgin_id'])->first();
					$destinationRow = new PtConfig_log();
					if ($delete_confid_data) {
						$destinationRow = ($table == "PtConfig") ? new PtConfig_log() : new Patient_log();

						$destinationRow->fill($delete_confid_data->toArray());
						$destinationRow->Reason .= ' Delete all';
						$destinationRow->save();
					}
				}
				$modelClass::where($matchID[$key], $request['orgin_id'])->delete();
			} else {
				if ($table == "PtConfig" || $table == "Patients") {
					$confid_exist = $modelClass::where($matchID[$key], $request['marge_id'])->exists();
					$delete_confid_data = $modelClass::where($matchID[$key], $request['orgin_id'])->first();
					if ($confid_exist) {
						if ($delete_confid_data) {
							$destinationRow = ($table == "PtConfig") ? new PtConfig_log() : new Patient_log();

							$destinationRow->fill($delete_confid_data->toArray());
							$destinationRow->Reason .= 'Delete and Marge';
							$destinationRow->Marge_ID .= $request['marge_id'];
							$destinationRow->save();
						}
						$modelClass::where($matchID[$key], $request['orgin_id'])->delete();
					} else {
						$destinationRow = ($table == "PtConfig") ? new PtConfig_log() : new Patient_log();
						$destinationRow->Pid .= $request['orgin_id'];
						$destinationRow->Reason .= 'Only marge';
						$destinationRow->Marge_ID .= $request['marge_id'];
						$destinationRow->save();
					}
				}
				$modelClass::where($matchID[$key], $request['orgin_id'])->update([
					$matchID[$key] => $request['marge_id']
				]);
			}
		}
		if ($request["notice"] == "View Detail") {
			return view('Id_Fix.Id_Delete', ['allCount' => $allCount, 'Pid' => $request['idInput']]);
		} elseif ($request["notice"] == "Delete all") {
			return response()->json("Delete all success");
		} else {
			return response()->json("All ID Changes Success");
		}
	}
}
