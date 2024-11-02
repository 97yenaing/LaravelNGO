<?php

namespace App\Http\Controllers;

use App\Exports\Export_age;
use App\Models\Mental_Health;
use App\Models\mentalFollow;
use App\Models\mentalRegister;
use App\Models\PtConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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



			default:
				return false;
				break;
		}
	}

	public function FindConfidential($request)
	{
		$mentalFirstScreen = Mental_Health::where('Pid', $request["Pid"])
			->orderBy('Counselling_Date', 'asc') // Order by ascending vdate to get the first
			->first();
		if ($mentalFirstScreen) {
			$mentalData = PtConfig::where('Pid', $request["Pid"])->with([
				'mentalRegister',
				'mentalFollow'
			])->select('Date of Birth', 'Agey', 'Agem', 'FuchiaID', 'PrEPCode', 'Gender', 'Main Risk', 'Sub Risk', 'Pid')->first();
			if ($mentalData) {
				if ($mentalData['mentalRegister']) {
					$mentalData["Reg Date"] = $mentalData['mentalRegister']['Reg_date'];
				} else {
					$mentalData["Reg Date"] = $mentalFirstScreen['Counselling_Date'];
				}
				$mentalData = Export_age::Export_general($mentalData, $mentalData["Reg Date"], $mentalData["Date of Birth"], $mentalData);

				$mentalData['Gender'] = Crypt::decrypt_light($mentalData['Gender'], "General");
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
				'Hiv_status' => $request->mentalHIV,
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
			'Hiv_status' => $request->mentalHIV,
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
				'Scroe_1' => $request["drugScore-1"],
				'Scroe_1_risk' => $request["drugScore-1-Risk"],
				'Scroe_2' => $request["drugScore-2"],
				'Scroe_2_risk' => $request["drugScore-2-Risk"],
				'Scroe_3' => $request["drugScore-3"],
				'Scroe_3_risk' => $request["drugScore-3-Risk"],
				'Scroe_4' => $request["drugScore-4"],
				'Scroe_4_risk' => $request["drugScore-4-Risk"],
				'Scroe_5' => $request["drugScore-5"],
				'Scroe_5_risk' => $request["drugScore-5-Risk"],
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
			'Pid' => $request["Pid"],
			'Visit_date' => $request["mentalVisitDate"],
			'Improve_symp' => $request["impSymptoms"],
			'Adh_problem' => $request["Adherence_problem"],
			'Mental_asses_rescreen' => $request["mental_rescreen"],
			'No_asses_describe' => $request["noRescreen"],
			'Drug_reassesment' => $request["drugUseReassement"],
			'Assist_score_screen' => $request["assistScore"],
			'Scroe_1' => $request["drugScore-1"],
			'Scroe_1_risk' => $request["drugScore-1-Risk"],
			'Scroe_2' => $request["drugScore-2"],
			'Scroe_2_risk' => $request["drugScore-2-Risk"],
			'Scroe_3' => $request["drugScore-3"],
			'Scroe_3_risk' => $request["drugScore-3-Risk"],
			'Scroe_4' => $request["drugScore-4"],
			'Scroe_4_risk' => $request["drugScore-4-Risk"],
			'Scroe_5' => $request["drugScore-5"],
			'Scroe_5_risk' => $request["drugScore-5-Risk"],
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
}
