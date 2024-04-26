<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Followup_general;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Lab;
use App\Models\LabHbcTest;
use App\Models\Urine;
use App\Models\Rprtest;
use App\Models\Labstitest;
use App\Models\Lab_oi;
use App\Models\LabGeneralTest;
use App\Models\LabStoolTest;
use App\Models\LabAfbTest;
use App\Models\LabCovidTest;
use App\Models\Viralload;
use App\Models\Coulselling;
use App\Models\CounsellorRecords;
use App\Models\Stifemale;
use App\Models\Stimale;
use App\Models\PreventionLogsheet;
use App\Models\PreventionCBS;
use App\Models\Cervicalcancer;
use App\Models\cmv;
use App\Models\ncd_pt_register;
use App\Models\ncdFollowup;
use App\Models\tb_registerO3;
use App\Models\Tbipt;
use App\Models\preTB;
use App\Models\Consumption;



class IdFixController extends Controller
{
	public  function idFix_view()
	{
		return view('Id_Fix.Id_Delete');
	}
	public function idFix_control(Request $request)
	{
		switch ($request["notice"]) {
			case 'Delete all':
				return $this->Remove_all($request);
				break;

			default:
				# code...
				break;
		}
	}
	public function Remove_all($request)
	{
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
		// $allCount = PtConfig::where('Pid', $request['idInput'])->count();
		foreach ($allTable as $key => $table) {
			$modelClass = 'App\\Models\\' . $table;
			$allCount[$table] = $modelClass::where($matchID[$key], $request['idInput'])->count();
		}
		dd($allCount);
	}
}
