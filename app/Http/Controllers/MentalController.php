<?php

namespace App\Http\Controllers;

use App\Exports\Export_age;
use App\Exports\MentalHealth\MentalHealthExport;
use App\Exports\RiskbackExcel\RefillRisk;
use App\Models\Lab;
use App\Models\Mental_Health;
use App\Models\mentalFollow;
use App\Models\mentalRegister;
use App\Models\PtConfig;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Validator;

class MentalController extends Controller
{
	public function MentalView()
	{
		return view('MentalHealth.mentalHealth');
	}

	public function MentalProcess(Request $request)
	{
		switch ($request["notice"]) {
			case 'Find Confidential':
				return $this->FindConfidential($request);
				break;
			case 'saveMental':
				return $this->SaveMentalRegister($request);
				break;
			case 'updateMental':
				return $this->UpdateMentalRegister($request);
				break;
			case 'getFollowMark':
				return $this->FetchScreenMark($request);
				break;
			case 'saveMentalFollow':
				return $this->SaveMentalFollow($request);
				break;
			case 'updateMentalFollow':
				return $this->UpdateMentalFollow($request);
				break;
			case 'DeleteMentalFollow':
				return $this->RemoveMentalFollow($request);
				break;
			case 'Export Mental Data':
				$validator = Validator::make($request->all(), [
					"ExportType" => "required",
					'FromDate' => 'required|date',
					'ToDate' => 'required|date',
				]); // Ensure it's an array with at least one item
				if ($validator->fails()) {
					return redirect()->back()->withErrors($validator)->withInput();
				}
				return $this->ExportMentalHealth($request);
				break;
			default:
				return false;
				break;
		}
	}

	public function FindConfidential($request)
	{
		$oldpatient = mentalRegister::where('Pid', $request["Pid"])->first(); //test already reg or not
		if ($oldpatient)
			$request['RegisterDate'] = $oldpatient['Reg_date'];

		$mentalFirstScreen = Mental_Health::where('Pid', $request["Pid"])->where('Counselling_Date', $request['RegisterDate'])->first();

		if ($oldpatient || $mentalFirstScreen) {
			$mentalData = PtConfig::where('Pid', $request["Pid"])->with([
				'mentalRegister',
				'mentalFollow'
			])->select('Date of Birth', 'Agey', 'Agem', 'FuchiaID', 'PrEPCode', 'Gender', 'Main Risk', 'Sub Risk', 'Pid')->first();
			if ($mentalData) {
				if ($mentalData['mentalRegister']) {
					$mentalData["Reg Date"] = $mentalData['mentalRegister']['Reg_date'];
				} else {
					$mentalData["Reg Date"] = $request['RegisterDate'];
				}
				$mentalData = Export_age::Export_general($mentalData, $mentalData["Reg Date"], $mentalData["Date of Birth"], $mentalData);
				$hivResult = Lab::where('CID', $request["Pid"])->select('Final_Result')->latest('vdate')->first();

				$mentalData['Gender'] = Crypt::decrypt_light($mentalData['Gender'], "General");
				$mentalData['hivResult'] = Crypt::decrypt_light($hivResult["Final_Result"], "General");
				$mentalData['Main Risk'] = Crypt::decrypt_light($mentalData['Main Risk'], "General");
				$mentalData['Sub Risk'] = Crypt::decrypt_light($mentalData['Sub Risk'], "General");
				$mentalData["mentalScreening"] = $mentalFirstScreen;
				return response()->json($mentalData);
			}
		} else {
			return response()->json(false);
		}
	}

	public function SaveMentalRegister($request)
	{
		$mentalExist = mentalRegister::where('Pid', $request["Pid"])->exists();
		if (!$mentalExist) {
			$mentalSave = mentalRegister::create([
				'Pid' => $request->Pid,
				'If_pwud' => $request->ifPWID,
				'If_pwudEx' => $request->ifEx,
				'Alcohol_drinking' => $request->alcoholDrink,
				'Reg_date' => $request->mentalRegDate,
				'Psychosis' => $request->psychosis,
				'Symptoms' => $request->symptoms,
				'Psy_others' => $request->others,
				'Duration' => $request->duration,
				'Suicidal_risk' => $request->sucidalRisk,
				'Sucidal_yes' => $request->sucidalTime,
				'Drug_uses3month' => $request->drugUse,
				'Drug_willingness' => $request->drugWillness,
				'Sexual_drug' => $request->drugSexUse,
				'SexualDrug_willigness' => $request->drugSexWillness,
				'Injectable' => $request->injectDrugUse,
				'Injectable_yes' => $request->injectDrugYes, //TimeFrame
				'ASSIST_score' => $request->assistScore,
				'Drug_name_1' => $request["drugname-1"],
				'Drug_name_1_risk' => $request["drug-1-Risk"],
				'Drug_name_2' => $request["drugname-2"],
				'Drug_name_2_risk' => $request["drug-2-Risk"],
				'Drug_name_3' => $request["drugname-3"],
				'Drug_name_3_risk' => $request["drug-3-Risk"],
				'Drug_name_4' => $request["drugname-4"],
				'Drug_name_4_risk' => $request["drug-4-Risk"],
				'Drug_name_5' => $request["drugname-5"],
				'Drug_name_5_risk' => $request["drug-5-Risk"],
				'Brief' => $request->bi,
				'Brief_plan' => $request->planGo,
				'Brief_plan_detail' => $request->planDescribe,
				'Brief_stage' => $request->stageBi,
				'Brief_no' => $request->noBi,
				'Psychosocial_mam' => $request->psyMAM,
				'Pharmacologica_mam' => $request->phamacoMAM,
				'Fluoxetine' => $request->fluoxetine,
				'Haloparidol' => $request->haloparidol,
				'Tre_other' => $request->treatmentOther,
				'Refer_psychiatrist' => $request->referPsychiatrist,
				'MD_initial' => $request->mdInit,
				'CSL_initial' => $request->cslInit,
				'Next_meetdate' => $request->nextFollowDate,
			]);
			return response()->json(true);
		} else {
			return response()->json(!$mentalExist);
		}
	}

	public function UpdateMentalRegister($request)
	{
		$mentalUpdate = mentalRegister::where("id", $request["updateID"])->where("Pid", $request["updatePid"])->update([
			'If_pwud' => $request->ifPWID,
			'If_pwudEx' => $request->ifEx,
			'Alcohol_drinking' => $request->alcoholDrink,
			'Reg_date' => $request->mentalRegDate,
			'Psychosis' => $request->psychosis,
			'Symptoms' => $request->symptoms,
			'Psy_others' => $request->others,
			'Duration' => $request->duration,
			'Suicidal_risk' => $request->sucidalRisk,
			'Sucidal_yes' => $request->sucidalTime,
			'Drug_uses3month' => $request->drugUse,
			'Drug_willingness' => $request->drugWillness,
			'Sexual_drug' => $request->drugSexUse,
			'SexualDrug_willigness' => $request->drugSexWillness,
			'Injectable' => $request->injectDrugUse,
			'Injectable_yes' => $request->injectDrugYes, //TimeFrame
			'ASSIST_score' => $request->assistScore,
			'Drug_name_1' => $request["drugname-1"],
			'Drug_name_1_risk' => $request["drug-1-Risk"],
			'Drug_name_2' => $request["drugname-2"],
			'Drug_name_2_risk' => $request["drug-2-Risk"],
			'Drug_name_3' => $request["drugname-3"],
			'Drug_name_3_risk' => $request["drug-3-Risk"],
			'Drug_name_4' => $request["drugname-4"],
			'Drug_name_4_risk' => $request["drug-4-Risk"],
			'Drug_name_5' => $request["drugname-5"],
			'Drug_name_5_risk' => $request["drug-5-Risk"],
			'Brief' => $request->bi,
			'Brief_plan' => $request->planGo,
			'Brief_plan_detail' => $request->planDescribe,
			'Brief_stage' => $request->stageBi,
			'Brief_no' => $request->noBi,
			'Psychosocial_mam' => $request->psyMAM,
			'Pharmacologica_mam' => $request->phamacoMAM,
			'Fluoxetine' => $request->fluoxetine,
			'Haloparidol' => $request->haloparidol,
			'Tre_other' => $request->treatmentOther,
			'Refer_psychiatrist' => $request->referPsychiatrist,
			'MD_initial' => $request->mdInit,
			'CSL_initial' => $request->cslInit,
			'Next_meetdate' => $request->nextFollowDate,
		]);
		return response()->json($mentalUpdate);
	}

	public function FetchScreenMark($request)
	{
		$screenMark = Mental_Health::where('Pid', $request['Pid'])->where('Counselling_Date', $request["visitDate"])->first();
		if ($screenMark) {
			return response()->json($screenMark);
		} else {
			return response()->json(false);
		}
	}

	public function SaveMentalFollow($request)
	{
		$mentalFollwExisit = mentalFollow::where('Pid', $request["Pid"])->where('Visit_date', $request["mentalVisitDate"])->exists();
		if (!$mentalFollwExisit) {
			mentalFollow::create([
				'Pid' => $request["Pid"],
				'Visit_date' => $request["mentalVisitDate"],
				'Improve_symp' => $request["impSymptoms"],
				'Adh_problem' => $request["Adherence_problem"],
				'Mental_asses_rescreen' => $request["mental_rescreen"],
				'No_asses_describe' => $request["noRescreen"],
				'Drug_reassesment' => $request["drugUseReassement"],
				'Assist_score_screen' => $request["assistScore"],
				'Drug_1' => $request["followDrug_1"],
				'Scroe_1' => $request["drugScore-1"],
				'Scroe_1_risk' => $request["drugScore-1-Risk"],
				'Drug_2' => $request["followDrug_2"],
				'Scroe_2' => $request["drugScore-2"],
				'Scroe_2_risk' => $request["drugScore-2-Risk"],
				'Drug_3' => $request["followDrug_3"],
				'Scroe_3' => $request["drugScore-3"],
				'Scroe_3_risk' => $request["drugScore-3-Risk"],
				'Drug_4' => $request["followDrug_4"],
				'Scroe_4' => $request["drugScore-4"],
				'Scroe_4_risk' => $request["drugScore-4-Risk"],
				'Drug_5' => $request["followDrug_5"],
				'Scroe_5' => $request["drugScore-5"],
				'Scroe_5_risk' => $request["drugScore-5-Risk"],
				'Drug_6' => $request["followDrug_6"],
				'Scroe_6' => $request["drugScore-6"],
				'Scroe_6_risk' => $request["drugScore-6-Risk"],
				'Brief' => $request["bi"],
				'Brief_plan' => $request["planGo"],
				'Brief_plan_detail' => $request["planDescribe"],
				'Brief_plan_changeDetail' => $request["changePlanDescribe"],
				'Brief_stage' => $request["stageBi"],
				'Sucidal_risk_between_lastVist' => $request["suicidalRiskBetween"],
				'Phamological_effect' => $request["pharmaSideEffect"],
				'Extrapyramidal_effect' => $request["extrapySideEffect"],
				'Other_effect' => $request["otherSideEffect"],
				'Management_effect' => $request["manageSideEffect"],
				'Artane' => $request["artane"],
				'Other_management' => $request["otherManage"],
				'Continue_same_traeat' => $request["sameTre"],
				'Continue_same_traeat_describe' => $request["sameTreDosage"],
				'Increase_dosage' => $request["incDo"],
				'Increase_dosage_describe' => $request["incDoDosage"],
				'Reduce_dosage' => $request["reduceDo"],
				'Reduce_dosage_describe' => $request["reduceDoDosage"],
				'Tapering_drug' => $request["tapDurg"],
				'Tapering_drug_describe' => $request["tapDurgDosage"],
				'Restart_drug' => $request["restartDrug"],
				'Restart_drug_describe' => $request["restartDrugDosage"],
				'Refer_psychiatrist' => $request["referpsy"],
				'Stop_drug' => $request["stopDrug"],
				'Psy_interview_mam' => $request["psyMAM"],
				'Other_refer_psychiatrist' => $request["referPsychiatristOther"],
				'MD_initial' => $request["mdInit"], // Use string for fixed-length text
				'CSL_initial' => $request["cslInit"],
				'Next_meetdate' => $request["nextFollowDate"],
			]);
			return response()->json(true);
		} else {
			return response()->json(!$mentalFollwExisit);
		}
	}

	public function UpdateMentalFollow($request)
	{
		mentalFollow::where('id', $request["id"])->where('Pid', $request["Pid"])->update([
			'Visit_date' => $request["mentalVisitDate"],
			'Improve_symp' => $request["impSymptoms"],
			'Adh_problem' => $request["Adherence_problem"],
			'Mental_asses_rescreen' => $request["mental_rescreen"],
			'No_asses_describe' => $request["noRescreen"],
			'Drug_reassesment' => $request["drugUseReassement"],
			'Assist_score_screen' => $request["assistScore"],
			'Drug_1' => $request["followDrug_1"],
			'Scroe_1' => $request["drugScore-1"],
			'Scroe_1_risk' => $request["drugScore-1-Risk"],
			'Drug_2' => $request["followDrug_2"],
			'Scroe_2' => $request["drugScore-2"],
			'Scroe_2_risk' => $request["drugScore-2-Risk"],
			'Drug_3' => $request["followDrug_3"],
			'Scroe_3' => $request["drugScore-3"],
			'Scroe_3_risk' => $request["drugScore-3-Risk"],
			'Drug_4' => $request["followDrug_4"],
			'Scroe_4' => $request["drugScore-4"],
			'Scroe_4_risk' => $request["drugScore-4-Risk"],
			'Drug_5' => $request["followDrug_5"],
			'Scroe_5' => $request["drugScore-5"],
			'Scroe_5_risk' => $request["drugScore-5-Risk"],
			'Drug_6' => $request["followDrug_6"],
			'Scroe_6' => $request["drugScore-6"],
			'Scroe_6_risk' => $request["drugScore-6-Risk"],
			'Brief' => $request["bi"],
			'Brief_plan' => $request["planGo"],
			'Brief_plan_detail' => $request["planDescribe"],
			'Brief_plan_changeDetail' => $request["changePlanDescribe"],
			'Brief_stage' => $request["stageBi"],
			'Sucidal_risk_between_lastVist' => $request["suicidalRiskBetween"],
			'Phamological_effect' => $request["pharmaSideEffect"],
			'Extrapyramidal_effect' => $request["extrapySideEffect"],
			'Other_effect' => $request["otherSideEffect"],
			'Management_effect' => $request["manageSideEffect"],
			'Artane' => $request["artane"],
			'Other_management' => $request["otherManage"],
			'Continue_same_traeat' => $request["sameTre"],
			'Continue_same_traeat_describe' => $request["sameTreDosage"],
			'Increase_dosage' => $request["incDo"],
			'Increase_dosage_describe' => $request["incDoDosage"],
			'Reduce_dosage' => $request["reduceDo"],
			'Reduce_dosage_describe' => $request["reduceDoDosage"],
			'Tapering_drug' => $request["tapDurg"],
			'Tapering_drug_describe' => $request["tapDurgDosage"],
			'Restart_drug' => $request["restartDrug"],
			'Restart_drug_describe' => $request["restartDrugDosage"],
			'Refer_psychiatrist' => $request["referpsy"],
			'Stop_drug' => $request["stopDrug"],
			'Psy_interview_mam' => $request["psyMAM"],
			'Other_refer_psychiatrist' => $request["referPsychiatristOther"],
			'MD_initial' => $request["mdInit"], // Use string for fixed-length text
			'CSL_initial' => $request["cslInit"],
			'Next_meetdate' => $request["nextFollowDate"],
		]);
		return response()->json(true);
	}

	public function RemoveMentalFollow($request)
	{
		$deleteSuccess = mentalFollow::where("id", $request["id"])->where("Pid", $request["Pid"])->where("Visit_date", $request["vdate"])->delete();
		if ($deleteSuccess) {
			$mentalFollow = mentalFollow::where("Pid", $request["Pid"])->get();
			return response()->json($mentalFollow);
		} else {
			return response()->json(false);
		}
	}

	public function ExportMentalHealth($request)
	{
		$request["FromDate"] = date("Y-m-d", strtotime($request["FromDate"]));
		$request["ToDate"] = date("Y-m-d", strtotime($request["ToDate"]));
		$final_log = []; //for RiskLog
		$final_risklog = []; //for RiskLog
		switch ($request["ExportType"]) {
			case 'Register':
				$exportType = true;
				$modelClassName = "App\\Models\\mentalRegister"; // extend model
				$exportName = 'Register';
				$dbName = 'mental_registers';
				$vdate = "Reg_date";
				break;
			case 'FollowUp':
				$exportType = true;
				$modelClassName = "App\\Models\\mentalFollow";
				$vdate = "Visit_date";
				$dbName = "mental_follows";
				$exportName = 'FollowUp';
				break;
			default:
				abort(404);
				break;
		}
		$encryptes = ['Main Risk', 'Sub Risk', 'HivResult', 'Gender'];
		$date_type = [$vdate, 'Next_meetdate'];

		if ($exportType) {
			$model = app()->make($modelClassName);
			$mentalData = $model->whereBetween($vdate, [$request["FromDate"], $request["ToDate"]])
				->with([
					'ptConfig' => function ($query) {
						$query->select("Pid", 'Date of Birth', 'Agey', 'Agem', "Main Risk", "Sub Risk", "Gender", "FuchiaID", "Risk Log", "Risk Change_Date", "Former Risk", "PrEPCode");
					}
				])->leftjoin('mental__healths', function ($join) use ($dbName, $vdate) {
					$join->on('mental__healths.Pid', '=', $dbName . '.Pid')
						->whereColumn('mental__healths.Counselling_Date', '=', $dbName . '.' . $vdate);
				})->select($dbName . '.*', 'Q1_Q2', 'Q3_Q4', 'gad7_amount', 'PHQ9_amount')
				->get();

			if ($mentalData) {
				foreach ($mentalData as $mentalValue) {

					$labResult = Lab::where('CID', $mentalValue["Pid"])->select('Final_Result')->latest('vdate')->first();
					$mentalValue["HivResult"] = $labResult["Final_Result"] ?? "Unknown";

					if ($mentalValue["ptConfig"]) {
						$mentalValue['Main Risk'] = $mentalValue['ptConfig']["Main Risk"];
						$mentalValue['Sub Risk'] = $mentalValue['ptConfig']["Sub Risk"];
						$mentalValue['FuchiaID'] = $mentalValue['ptConfig']["FuchiaID"];
						$mentalValue['PrePCode'] = $mentalValue['ptConfig']["PrEPCode"];
						$mentalValue['Gender'] = $mentalValue['ptConfig']["Gender"];

						$mentalValue = Export_age::Export_general($mentalValue['ptConfig'], $mentalValue[$vdate], $mentalValue['ptConfig']["Date of Birth"], $mentalValue);
						//Calculate Age

						$carbonDate = Carbon::createFromFormat('Y-m-d', $mentalValue[$vdate]);
						$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
						$recordVdate = new DateTime($carbonDate); // change visit date to chenk with riskhistory

						if ($mentalValue["ptConfig"]["Risk Log"] != null) {
							$forRiskCheck[1]['Pid'] = $mentalValue['Pid'];
							$forRiskCheck[1]['Risk Log'] = $mentalValue["ptConfig"]['Risk Log'];
							if (!array_key_exists($mentalValue['Pid'], $final_log) && $mentalValue["ptConfig"]['Risk Log'] != null) {
								$final_risklog = RefillRisk::FillRisk($forRiskCheck);
								$final_log[$mentalValue['Pid']] = $final_risklog;
							}
							if (array_key_exists($mentalValue['Pid'], $final_log)) {
								foreach (array_reverse($final_log[$mentalValue['Pid']][$mentalValue['Pid']]) as $date => $data) {
									if (strlen($date) == 10) {
										$riskChangeDate = new DateTime($date);
										if ($recordVdate < $riskChangeDate) {
											$mentalValue['Main Risk'] = Crypt::encrypt_light($data['Old Risk'], 'General');
											$mentalValue['Sub Risk'] = Crypt::encrypt_light($data['Old Sub Risk'], 'General');
										}
									}
								}
							}
						} elseif ($mentalValue["ptConfig"]['Risk Change_Date'] != null && $mentalValue["ptConfig"]['Former Risk'] != null && $mentalValue["ptConfig"]['Former Risk'] != "731") {
							$riskChangeDate = Carbon::createFromFormat('Y-m-d', $mentalValue["ptConfig"]['Risk Change_Date']);
							$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
							if ($vdate < $riskChangeDate) {
								$mentalValue['Main Risk'] = $mentalValue["ptConfig"]['Former Risk'];
								$mentalValue['Sub Risk'] = '';
							}
						}
						//Check the RiskHistory

						foreach ($encryptes as $key => $encrypte) {
							$mentalValue[$encrypte] = Crypt::decrypt_light($mentalValue[$encrypte], "General");
							if ($mentalValue[$encrypte] == "-") {
								$mentalValue[$encrypte] = null;
							}
							$mentalValue[$encrypte] = Crypt::codeBook($mentalValue[$encrypte], "encode");
						}
						// Encrypt to decrypt
					}

					foreach ($date_type as $column) {
						$dateString = $mentalValue[$column];
						if (!empty($dateString)) {
							$carbonDate = Carbon::createFromFormat("Y-m-d", $dateString);
							$ddString = $carbonDate->format("d-m-Y");

							$carbonDate = Carbon::createFromFormat("d-m-Y", $ddString); // Assuming you have a Carbon instance
							$mentalValue[$column] = Date::dateTimeToExcel($carbonDate->startOfDay()); // Convert to Excel-compatible date
						}
					}
					// date format change dd-mm-yy (carbon);
				}
			}
			return Excel::download(new MentalHealthExport($mentalData, $exportName), "Mental Health " . $exportName . "-" . date("d-m-Y") . ".xlsx");
		}
	}
}
