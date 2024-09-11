<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Followup_general;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Lab;
use App\Models\LabHbcTest;

use App\Models\Rprtest;

use App\Models\Coulselling;
use App\Models\CounsellorRecords;

use App\Models\Cervicalcancer;

use App\Models\ncd_pt_register;
use App\Models\ncdFollowup;
use App\Models\tb_registerO3;


use App\Models\Tbipt;
use App\Models\preTB;

use Carbon\Carbon;
use Exception;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
// Exports
use App\Exports\Counselling\CounsellingExport;
use App\Exports\Counselling\MentalExport;
use Illuminate\Database\Eloquent\Builder;

use App\Models\TeleCounselling;
use DateTime;
use App\Exports\Export_age;
use App\Exports\RiskbackExcel\RefillRisk;
use App\Models\Mental_Health;

class CounsellingController extends Controller
{
	public function patients()
	{
		$patients = Patients::latest()->paginate(50);
		return view('Reception.patients', ['patients' => $patients]);
	}
	public function general_patients()
	{
		$patients_gt = Patients::latest()->paginate(50);
		return view('Reception.generalPatient', ['gt_patients' => $patients_gt]);
	}
	public function room_view()
	{
		return view('Counsellor.counselling');
	}
	public function save_data(Request $request)
	{
		$gid = $request->input('gid');
		$ckID = $request->input('ckID');
		$cdate = $request->input('cdate');
		$notice = $request['notice'];
		$table = 'General';

		$hiv_test_date = $request->input('hiv_test_date');
		$hiv_test = $request->input('hiv_test');
		$rpr_test = $request->input('rpr_test');
		$hepB_test = $request->input('hepB_test');
		$hiv_test_date = $request->input('hiv_test_date');
		$rpr_test_date = $request->input('rpr_test_date');
		$hepB_test_date = $request->input('hepB_test_date');

		$counsellingOnly = $request->input('counsellingOnly');
		// $both_hts_coun = $request -> input('both_hts_coun');
		$listShow = $request->input('listShow');
		$decryptFetch = $request->input('decryptFetch');

		$htsUpdate = $request->input('htsUpdate');
		$address = $request->input('address');
		$pt_data_update = $request->input('pt_data_update');

		$hts_counselling = $request->input('hts_counselling');
		$calDob = Crypt::encryptString($request->input('calDob'));

		if ($notice == 'HTS Remaining') {
			$datefrom = $request['datefrom'];
			$dateto = $request['dateto'];
			$hts_final_reaming = [];

			$hiv_count = Lab::select('CID', 'vdate', 'Patient_Type', 'Gender', 'agey')
				->whereBetween('vdate', [$datefrom, $dateto])
				->get();
			$hts_counting = Coulselling::select('Pid')
				->whereBetween('Counselling_Date', [$datefrom, $dateto])
				->get();
			$cidArray = $hiv_count->pluck('CID')->all();
			$pidArray = $hts_counting->pluck('Pid')->all();

			$differences = collect(
				array_udiff($cidArray, $pidArray, function ($a, $b) {
					return $a <=> $b;
				}),
			);
			$seraial_room = 0;
			$hts_remaining_dataes = $hiv_count->whereIn('CID', $differences->all());
			foreach ($hts_remaining_dataes as $key => $hts_remaining) {
				$hts_remaining_dataes[$key]['vdate'] = date('d-m-Y', strtotime($hts_remaining['vdate']));
				$hts_remaining_dataes[$key]['Patient_Type'] = Crypt::decrypt_light($hts_remaining['Patient_Type'], $table);
				$hts_remaining_dataes[$key]['Gender'] = Crypt::decrypt_light($hts_remaining['Gender'], $table);
				$hts_final_reaming[$seraial_room] = $hts_remaining_dataes[$key];
				$seraial_room++;
			}

			return response()->json([$hts_final_reaming]);
		} else if ($notice == "TeleCollection") {

			$tele_name = !$request->tele_id ? Crypt::encryptString($request->ph_name) : null;
			if ($request["task_do"] != "Tele update") {
				$tele_save = TeleCounselling::create([
					'Pid' => $request->tele_id,
					'Age' => $request->ph_age,
					'Enamal' => $tele_name,
					'Gender' => Crypt::encrypt_light($request->ph_sex, $table),
					'Call_Date' => $request->teleDate,
					'Counsellor' => $request->ph_counsellor,
					'Remark' => $request->ph_remark,
				]);
				return response()->json("Save လုပ်ဆောင်မှု့ အောင်မြင်ပါသည်");
			} else {
				$tele_save = TeleCounselling::where("id", $request["id"])->update([
					'Pid' => $request->tele_id,
					'Age' => $request->ph_age,
					'Enamal' => $tele_name,
					'Gender' => Crypt::encrypt_light($request->ph_sex, $table),
					'Call_Date' => $request->teleDate,
					'Counsellor' => $request->ph_counsellor,
					'Remark' => $request->ph_remark,
				]);
				return response()->json("Save လုပ်ဆောင်မှု့ အောင်မြင်ပါသည်");
			}
		} else if ($notice == "Mental Health") {
			if ($request["task"] == "Mental Save") {
				$mental_exist = Mental_Health::where('Pid', $request["gid"])->where('Counselling_Date', $request["counselling_date"])->exists();
				if (!$mental_exist) {
					Mental_Health::create([
						'Pid' => $request->gid,
						'Counselling_Date' => $request["counselling_date"],
						'Q1_Q2' => $request["q1q2"],
						'Q3_Q4' => $request["q3q4"],
						'gad7_amount' => $request["gad7_amount"],
						'PHQ9_amount' => $request["phq9_amount"],
						'Drug3M' => $request["mental_drug"],
						'SexDrug' => $request["sexdrug"],
						'ChemSex' => $request["chemsex"],
						'A' => $request["mental_A"],
						'B' => $request["mental_B"],
						'C' => $request["mental_C"],
						'D' => $request["mental_D"],
						'Remark' => $request["mental_remark"],
					]);
					return response()->json("Mental Health data သိမ်းဆည်းပြီးပါပြီ။");
				}
			} else if ($request["task"] == "Mental Update") {
				Mental_Health::where("Pid", $request["gid"])->where('Counselling_Date', $request["counselling_date"])->update([
					'Pid' => $request->gid,
					'Counselling_Date' => $request["counselling_date"],
					'Q1_Q2' => $request["q1q2"],
					'Q3_Q4' => $request["q3q4"],
					'gad7_amount' => $request["gad7_amount"],
					'PHQ9_amount' => $request["phq9_amount"],
					'Drug3M' => $request["mental_drug"],
					'SexDrug' => $request["sexdrug"],
					'ChemSex' => $request["chemsex"],
					'A' => $request["mental_A"],
					'B' => $request["mental_B"],
					'C' => $request["mental_C"],
					'D' => $request["mental_D"],
					'Remark' => $request["mental_remark"],
				]);
				CounsellorRecords::where("Pid", $request["gid"])->where('Counselling_Date', $request["counselling_date"])->update([
					'PHQ9' => $request->phq9,
					'gad7' => $request->gad7,
					'PHQ9_Define' => $request->phq9_def,
					'gad7_Define' => $request->gad7_def,
				]);

				return response()->json("Mental Health data ပြင်ဆင် ပြီးပါပြီ။");
			}
		}
		if ($hts_counselling == 1 || $counsellingOnly == 1 || $pt_data_update == 'Only Patient Info_Update' || $pt_data_update == 'Update') {
			// to save data in  table (config and counselling table and HTS)
			$current_date = Carbon::now()->format('Y-m-d');
			$region = $request->input('state');
			$region = Crypt::encryptString($region);

			$township = $request->input('township');
			$township = Crypt::encryptString($township);

			$quarter = $request->input('quarter');
			$quarter = Crypt::encryptString($quarter);

			$phone = $request->input('phone');
			$phone = Crypt::encryptString($phone);

			$phone2 = $request->input('phone2');
			$phone2 = Crypt::encryptString($phone2);

			$phone3 = $request->input('phone3');
			$phone3 = Crypt::encryptString($phone3);

			$fatherName = $request->input('father');
			$encrypted_Father = Crypt::encryptString($fatherName);

			$table = 'General';
			$main_risk = $request->input('Main_Risk');
			$main_risk = Crypt::encrypt_light($main_risk, $table);

			$sub_risk = $request->input('Sub_Risk');
			$sub_risk = Crypt::encrypt_light($sub_risk, $table);

			$gender = $request->input('Gender');
			$gender = Crypt::encrypt_light($gender, $table);

			$counsellor = $request->input('Counsellor');
			$counsellor = Crypt::encrypt_light($counsellor, $table);

			$service = $request->input('service');
			$service = Crypt::encrypt_light($service, $table);

			$mode_of_entry = $request->input('mode_of_entry');
			$mode_of_entry = Crypt::encrypt_light($mode_of_entry, $table);

			$new_old = $request->input('new_old');
			$new_old = Crypt::encrypt_light($new_old, $table);

			$hiv_determine = $request->input('hiv_determine');
			$hiv_determine = Crypt::encrypt_light($hiv_determine, $table);

			$hiv_unigold = $request->input('hiv_unigold');
			$hiv_unigold = Crypt::encrypt_light($hiv_unigold, $table);

			$hiv_stat = $request->input('hiv_stat');
			$hiv_stat = Crypt::encrypt_light($hiv_stat, $table);

			$hiv_final = $request->input('hiv_final');
			$hiv_final = Crypt::encrypt_light($hiv_final, $table);

			$syp_rdt = $request->input('syp_rdt');
			$syp_rdt = Crypt::encrypt_light($syp_rdt, $table);

			$syp_rpr = $request->input('syp_rpr');
			$syp_rpr = Crypt::encrypt_light($syp_rpr, $table);

			$syp_vdrl = $request->input('syp_vdrl');
			$syp_vdrl = Crypt::encrypt_light($syp_vdrl, $table);

			$PrEP_Status = $request->input('PrEP_Status');
			$PrEP_Status = Crypt::encrypt_light($PrEP_Status, $table);

			$hep_b = $request->input('hep_b');
			$hep_b = Crypt::encrypt_light($hep_b, $table);

			$hep_c = $request->input('hep_c');
			$hep_c = Crypt::encrypt_light($hep_c, $table);

			$HTSdone = $request->input('HTSdone');
			$HTSdone = Crypt::encrypt_light($HTSdone, $table);

			$Reason = $request->input('Reason');
			$Reason = Crypt::encrypt_light($Reason, $table);

			$Status = $request->input('Status');
			$Status = Crypt::encrypt_light($Status, $table);

			$change_risk_rason = $request['change_risk_rason'];
			$labTestDate = $request->input('labTestDate');

			$risk_change_date = $request->input('risk_change_date');


			$cdate = $request->input('Counselling_Date');

			$test_locate = $request->input('test_locate');

			$gid = $request->input('Pid');

			$edit = $request->input('edit');

			$follow_lastDate = Followup_general::where('Pid', $gid)->where('Visit Date', $cdate)->exists();
			$patient_lastDate = CounsellorRecords::where('Pid', $gid)->where("Counselling_Date", $risk_change_date)->exists();


			if ($follow_lastDate || ($pt_data_update == 'Only Patient Info_Update')) {
				$test_locate = Crypt::encrypt_light($test_locate, $table);
				if ($edit == 1) {
					Patients::where('Pid', $gid)->update([
						'Agey' => $request->register_age,
						'Agem' => $request->Agem,
						'Date of Birth' => $calDob,
						'updated_by' => $request->created_by,
					]);
					PtConfig::where('Pid', $gid)->update([
						'Agey' => $request->register_age,
						'Agem' => $request->Agem,
						'Date of Birth' => $calDob,
						'updated_by' => $request->created_by,
					]);
				}
				if ($risk_change_date == null) {
					$risk_change_date = $current_date;
				}
				$changesDate = new DateTime($risk_change_date);
				$old_risk_log = PtConfig::where('Pid', $gid)->select('Risk Log', 'Main Risk', 'Sub Risk')->first();

				$risk_history = $old_risk_log['Risk Log'] . $risk_change_date . ':' . $old_risk_log['Main Risk'] . ':' . $main_risk . ':' . $change_risk_rason . ':' . $request->created_by . ':' . $old_risk_log['Sub Risk'] . ':' . $sub_risk . '/';
				PtConfig::where('Pid', $gid)
					->where('Main Risk', '!=', $main_risk)
					->where('Main Risk', '!=', null)
					->where('Main Risk', '!=', '731')
					->update([
						'Risk Log' => $risk_history,
					]);
				Patients::where('Pid', $gid)
					->where('Main Risk', '!=', $main_risk)
					->where('Main Risk', '!=', null)
					->where('Main Risk', '!=', '731')
					->update([
						'Risk Log' => $risk_history,
					]);

				if ($follow_lastDate || $patient_lastDate) {
					$patient = Patients::where('Pid', $gid)->update([
						'Main Risk' => $main_risk,
						'Sub Risk' => $sub_risk,
						'updated_by' => $request->created_by,
					]);
					PtConfig::where('Pid', $gid)->update([
						'Main Risk' => $main_risk,
						'Sub Risk' => $sub_risk,
					]);
					$ptconfig = PtConfig::where('Pid', $gid)->update([
						'Region' => $region,
						'Township' => $township,
						'Quarter' => $quarter,
						'Phone' => $phone,
						'Phone2' => $phone2,
						'Phone3' => $phone3,
						'updated_by' => $request->created_by,
					]);

					if ($patient && $ptconfig && (($change_risk_rason == 'Yes' && $main_risk != $old_risk_log['Main Risk'])
						|| ($old_risk_log['Main Risk'] == null || $old_risk_log['Main Risk'] == "731"))) {

						if ($old_risk_log['Main Risk'] == null || $old_risk_log['Main Risk'] == "731") {
							$old_risk = $main_risk;
						} else {
							$old_risk = $old_risk_log['Main Risk'];
						}

						$ptconfig = PtConfig::where('Pid', $gid)->update([
							'Risk Change_Date' => $risk_change_date,
							'Former Risk' => $old_risk,
							'Risk Changed' => $change_risk_rason,
						]);

						$patient = Patients::where('Pid', $gid)->update([
							'Risk Change_Date' => $risk_change_date,
							'Former Risk' => $old_risk,
							'Risk Changed' => $change_risk_rason,
						]);
					}
				}
				if ($hts_counselling == 1 || $counsellingOnly == 1) {
					$counselling_exists = CounsellorRecords::where('Pid', '=', $gid)->where('Counselling_Date', $cdate)->exists();
					if ($counsellingOnly == 1) {
						if ($counselling_exists) {
							CounsellorRecords::where('Pid', '=', $gid)
								->where('Counselling_Date', '=', $cdate)
								->update([
									'Clinic Code' => $request->clinic_code,
									'Pid' => $request->Pid,
									'FuchiaID' => $request->FuchiaID,
									'PrEPCode' => $request->PrEPCode,
									'Gender' => $request->Gender,
									'Agey' => $request->Agey,
									'Agem' => $request->Agem,

									'Counselling_Date' => $request->Counselling_Date,
									'Counsellor' => $counsellor,
									'Main Risk' => $main_risk,
									'Sub Risk' => $sub_risk,

									'Pre' => $request->Pre,
									'Post' => $request->Post,
									'HTSdone' => $HTSdone,
									'Reason' => $Reason,
									'Status' => $Status,
									'PrEP' => $request->PrEP,
									'PrEP Status' => $PrEP_Status,
									'C1' => $request->c1,
									'C2' => $request->c2,
									'C3' => $request->c3,
									'ADH' => $request->adh,
									'Child under15 Adoles' => $request->Child_under15_Adoles,
									'Child under15 Dis' => $request->Child_under15_Dis,
									'Child under15 ADH' => $request->Child_under15_ADH,
									'MMT' => $request->mmt,
									'IPT' => $request->ipt,
									'TB' => $request->tb,
									'NCD' => $request->ncd,
									'ANC' => $request->anc,
									'PFA' => $request->pfa,
									'PHQ9' => $request->phq9,
									'Other' => $request->Other,
									'EAC' => $request->eac,
									'HMT' => $request->hmt,
									'C P case' => $request->c_p_case,
									'PMTCT' => $request->pmtct,
									'c2_done' => $request->c2_done,
									'stable' => $request->stable,
									'phq4' => $request->phq4,
									'gad7' => $request->gad7,
									'brest_cancer' => $request->brest_cancer,
									'hepC' => $request->hepC,
									'art_ost' => $request->art_ost,
									'd1' => $request->d1,
									'd2' => $request->d2,
									'd3' => $request->d3,
									'd4' => $request->d4,
									'cage' => $request->cage,
									'Disclosure_Define' => $request->disclosure_def,
									'Case_Presention' => $request->case_presention,
									'PHQ9_Define' => $request->phq9_def,
									'PHATB_Define' => $request->ipt_artTB_def,
									'Only_IPT' => $request->only_ipt,
									'Only_TB_Define' => $request->tb_def,
									'gad7_Define' => $request->gad7_def,

									'updated_by' => $request->created_by,
								]);
							$success = 1;
						} else {
							CounsellorRecords::create([ //where('Pid','=',$gid)->where('Counselling_Date','=',$hiv_test_date)
								'Clinic Code' => $request->clinic_code,
								'Pid' => $request->Pid,
								'FuchiaID' => $request->FuchiaID,
								'PrEPCode' => $request->PrEPCode,
								'Gender' => $request->Gender,
								'Agey' => $request->Agey,
								'Agem' => $request->Agem,

								'Counselling_Date' => $request->Counselling_Date,
								'Counsellor' => $counsellor,
								'Main Risk' => $main_risk,
								'Sub Risk' => $sub_risk,

								'Pre' => $request->Pre,
								'Post' => $request->Post,
								'HTSdone' => $HTSdone,
								'Reason' => $Reason,
								'Status' => $Status,
								'PrEP' => $request->PrEP,
								'PrEP Status' => $PrEP_Status,
								'C1' => $request->c1,
								'C2' => $request->c2,
								'C3' => $request->c3,
								'ADH' => $request->adh,
								'Child under15 Adoles' => $request->Child_under15_Adoles,
								'Child under15 Dis' => $request->Child_under15_Dis,
								'Child under15 ADH' => $request->Child_under15_ADH,
								'MMT' => $request->mmt,
								'IPT' => $request->ipt,
								'TB' => $request->tb,
								'NCD' => $request->ncd,
								'ANC' => $request->anc,
								'PFA' => $request->pfa,
								'PHQ9' => $request->phq9,
								'Other' => $request->Other,
								'EAC' => $request->eac,
								'HMT' => $request->hmt,
								'C P case' => $request->c_p_case,
								'PMTCT' => $request->pmtct,
								'c2_done' => $request->c2_done,
								'stable' => $request->stable,
								'phq4' => $request->phq4,
								'gad7' => $request->gad7,
								'brest_cancer' => $request->brest_cancer,
								'hepC' => $request->hepC,
								'art_ost' => $request->art_ost,
								'd1' => $request->d1,
								'd2' => $request->d2,
								'd3' => $request->d3,
								'd4' => $request->d4,
								'cage' => $request->cage,
								'Disclosure_Define' => $request->disclosure_def,
								'Case_Presention' => $request->case_presention,
								'PHQ9_Define' => $request->phq9_def,
								'PHATB_Define' => $request->ipt_artTB_def,
								'Only_IPT' => $request->only_ipt,
								'Only_TB_Define' => $request->tb_def,
								'gad7_Define' => $request->gad7_def,
								'created_by' => $request->created_by,
							]);
							$success = 1;
						}
					}
					// this is counselling only close
					elseif ($hts_counselling == 1) {
						$hts_exists = Coulselling::where('Pid', '=', $gid)->where('Counselling_Date', $cdate)->exists();
						$cbs_hts_exist = Coulselling::where('Pid', '=', $gid)->where('Counselling_Date', $cdate)->where('CBS_HTS', 1)->exists();

						$counsellor_hts_exist = Coulselling::where('Pid', '=', $gid)->where('Counselling_Date', $cdate)->where('CBS_HTS', 2)->exists();
						if (!$hts_exists || ($hts_exists && $cbs_hts_exist && !$counsellor_hts_exist)) {
							if (!$counselling_exists) {
								Coulselling::create([ // HTS Create row input
									'Clinic code' => $request->clinic_code,
									'Pid' => $request->Pid,
									'FuchiaID' => $request->FuchiaID,
									'Gender' => $gender,
									'Age' => $request->Agey,

									'Counsellor' => $counsellor,
									'Counselling_Date' => $request->Counselling_Date,
									'Pre' => $request->Pre,
									'Post' => $request->Post,

									'Main Risk' => $main_risk,
									'Sub Risk' => $sub_risk,
									'Service_Modality' => $service,
									'Mode of Entry' => $mode_of_entry,
									'New_Old' => $new_old,

									'HIV_Test_Date' => $request->hiv_test_date,
									'HIV_Test_Determine' => $hiv_determine,
									'HIV_Test_UNI' => $hiv_unigold,
									'HIV_Test_STAT' => $hiv_stat,
									'HIV_Final_Result' => $hiv_final,

									'Syp_Test_Date' => $request->syp_date,
									'Syphillis_RDT' => $syp_rdt,
									'Syphillis_RPR' => $syp_rpr,
									'Syphillis_VDRL' => $syp_vdrl,

									'Hep_Test_Date' => $request->hep_date,
									'Hepatitis_B' => $hep_b,
									'Hepatitis_C' => $hep_c,
									'CBS_HTS' => 2,
									'Test_Location' => $test_locate,
									'created_by' => $request->created_by,
								]);

								CounsellorRecords::create([ //where('Pid','=',$gid)->where('Counselling_Date','=',$hiv_test_date)
									'Clinic Code' => $request->clinic_code,
									'Pid' => $request->Pid,
									'FuchiaID' => $request->FuchiaID,
									'PrEPCode' => $request->PrEPCode,
									'Gender' => $request->Gender,
									'Agey' => $request->Agey,
									'Agem' => $request->Agem,

									'Counselling_Date' => $request->Counselling_Date,
									'Counsellor' => $counsellor,
									'Main Risk' => $main_risk,
									'Sub Risk' => $sub_risk,

									'Pre' => $request->Pre,
									'Post' => $request->Post,
									'HTSdone' => $HTSdone,
									'Reason' => $Reason,
									'Status' => $Status,
									'PrEP' => $request->PrEP,
									'PrEP Status' => $PrEP_Status,
									'C1' => $request->c1,
									'C2' => $request->c2,
									'C3' => $request->c3,
									'ADH' => $request->adh,
									'Child under15 Adoles' => $request->Child_under15_Adoles,
									'Child under15 Dis' => $request->Child_under15_Dis,
									'Child under15 ADH' => $request->Child_under15_ADH,
									'MMT' => $request->mmt,
									'IPT' => $request->ipt,
									'TB' => $request->tb,
									'NCD' => $request->ncd,
									'ANC' => $request->anc,
									'PFA' => $request->pfa,
									'PHQ9' => $request->phq9,
									'Other' => $request->Other,
									'EAC' => $request->eac,
									'HMT' => $request->hmt,
									'C P case' => $request->c_p_case,
									'PMTCT' => $request->pmtct,
									'c2_done' => $request->c2_done,
									'stable' => $request->stable,
									'phq4' => $request->phq4,
									'gad7' => $request->gad7,
									'brest_cancer' => $request->brest_cancer,
									'hepC' => $request->hepC,
									'art_ost' => $request->art_ost,
									'd1' => $request->d1,
									'd2' => $request->d2,
									'd3' => $request->d3,
									'd4' => $request->d4,
									'cage' => $request->cage,
									'Disclosure_Define' => $request->disclosure_def,
									'Case_Presention' => $request->case_presention,
									'PHQ9_Define' => $request->phq9_def,
									'PHATB_Define' => $request->ipt_artTB_def,
									'Only_IPT' => $request->only_ipt,
									'Only_TB_Define' => $request->tb_def,
									'gad7_Define' => $request->gad7_def,
									'created_by' => $request->created_by,
								]);

								$success = 1; // Custom alert box SuccessFully

							} else {

								Coulselling::create([ // HTS Create row input
									'Clinic code' => $request->clinic_code,
									'Pid' => $request->Pid,
									'FuchiaID' => $request->FuchiaID,
									'Gender' => $gender,
									'Age' => $request->Agey,
									'Test_Location' => $test_locate,

									'Counsellor' => $counsellor,
									'Counselling_Date' => $request->Counselling_Date,
									'Pre' => $request->Pre,
									'Post' => $request->Post,

									'Main Risk' => $main_risk,
									'Sub Risk' => $sub_risk,
									'Service_Modality' => $service,
									'Mode of Entry' => $mode_of_entry,
									'New_Old' => $new_old,

									'HIV_Test_Date' => $request->hiv_test_date,
									'HIV_Test_Determine' => $hiv_determine,
									'HIV_Test_UNI' => $hiv_unigold,
									'HIV_Test_STAT' => $hiv_stat,
									'HIV_Final_Result' => $hiv_final,

									'Syp_Test_Date' => $request->syp_date,
									'Syphillis_RDT' => $syp_rdt,
									'Syphillis_RPR' => $syp_rpr,
									'Syphillis_VDRL' => $syp_vdrl,
									'CBS_HTS' => 2,

									'Hep_Test_Date' => $request->hep_date,
									'Hepatitis_B' => $hep_b,
									'Hepatitis_C' => $hep_c,

									'created_by' => $request->created_by,
								]);
								CounsellorRecords::where('Pid', '=', $gid)
									->where('Counselling_Date', '=', $cdate)
									->update([
										'Clinic Code' => $request->clinic_code,
										'Pid' => $request->Pid,
										'FuchiaID' => $request->FuchiaID,
										'PrEPCode' => $request->PrEPCode,
										'Gender' => $request->Gender,
										'Agey' => $request->Agey,
										'Agem' => $request->Agem,

										'Counselling_Date' => $request->Counselling_Date,
										'Counsellor' => $counsellor,
										'Main Risk' => $main_risk,
										'Sub Risk' => $sub_risk,

										'Pre' => $request->Pre,
										'Post' => $request->Post,
										'HTSdone' => $HTSdone,
										'Reason' => $Reason,
										'Status' => $Status,
										'PrEP' => $request->PrEP,
										'PrEP Status' => $PrEP_Status,
										'C1' => $request->c1,
										'C2' => $request->c2,
										'C3' => $request->c3,
										'ADH' => $request->adh,
										'Child under15 Adoles' => $request->Child_under15_Adoles,
										'Child under15 Dis' => $request->Child_under15_Dis,
										'Child under15 ADH' => $request->Child_under15_ADH,
										'MMT' => $request->mmt,
										'IPT' => $request->ipt,
										'TB' => $request->tb,
										'NCD' => $request->ncd,
										'ANC' => $request->anc,
										'PFA' => $request->pfa,
										'PHQ9' => $request->phq9,
										'Other' => $request->Other,
										'EAC' => $request->eac,
										'HMT' => $request->hmt,
										'C P case' => $request->c_p_case,
										'PMTCT' => $request->pmtct,
										'c2_done' => $request->c2_done,
										'stable' => $request->stable,
										'phq4' => $request->phq4,
										'gad7' => $request->gad7,
										'brest_cancer' => $request->brest_cancer,
										'hepC' => $request->hepC,
										'art_ost' => $request->art_ost,
										'd1' => $request->d1,
										'd2' => $request->d2,
										'd3' => $request->d3,
										'd4' => $request->d4,
										'cage' => $request->cage,
										'Disclosure_Define' => $request->disclosure_def,
										'Case_Presention' => $request->case_presention,
										'PHQ9_Define' => $request->phq9_def,
										'PHATB_Define' => $request->ipt_artTB_def,
										'Only_IPT' => $request->only_ipt,
										'Only_TB_Define' => $request->tb_def,
										'gad7_Define' => $request->gad7_def,
										'created_by' => $request->created_by,
										'updated_by' => $request->created_by,
									]);

								$success = 1; // Custom alert box SuccessFully

							}
						} else {
							$success = 2.2; // This Patient has been Collected in thsi day
						}
					}
				} elseif ($pt_data_update == 'Only Patient Info_Update') {
					$success = 3;
					$pt_info_update = [$patient, $ptconfig];
					foreach ($pt_info_update as $pt_value) {
						if ($pt_value == 1) {
							$success = 1;
							break;
						}
					}
				} elseif ($pt_data_update == 'Update') {
					$updatedType = $request->input('updatedType');

					if ($updatedType == 1) {
						$counselling_update = CounsellorRecords::where('id', $address)
							->where('Pid', '=', $gid)
							->where('Counselling_Date', '=', $cdate)
							->update([
								'Clinic Code' => $request->clinic_code,
								'Pid' => $request->Pid,
								'FuchiaID' => $request->FuchiaID,
								'PrEPCode' => $request->PrEPCode,
								'Gender' => $request->Gender,
								'Agey' => $request->Agey,
								'Agem' => $request->Agem,

								'Counselling_Date' => $request->Counselling_Date,
								'Counsellor' => $counsellor,
								'Main Risk' => $main_risk,
								'Sub Risk' => $sub_risk,

								'Pre' => $request->Pre,
								'Post' => $request->Post,
								'HTSdone' => $HTSdone,
								'Reason' => $Reason,
								'Status' => $Status,
								'PrEP' => $request->PrEP,
								'PrEP Status' => $PrEP_Status,
								'C1' => $request->c1,
								'C2' => $request->c2,
								'C3' => $request->c3,
								'ADH' => $request->adh,
								'Child under15 Adoles' => $request->Child_under15_Adoles,
								'Child under15 Dis' => $request->Child_under15_Dis,
								'Child under15 ADH' => $request->Child_under15_ADH,
								'MMT' => $request->mmt,
								'IPT' => $request->ipt,
								'TB' => $request->tb,
								'NCD' => $request->ncd,
								'ANC' => $request->anc,
								'PFA' => $request->pfa,
								'PHQ9' => $request->phq9,
								'Other' => $request->Other,
								'EAC' => $request->eac,
								'HMT' => $request->hmt,
								'C P case' => $request->c_p_case,
								'PMTCT' => $request->pmtct,
								'c2_done' => $request->c2_done,
								'stable' => $request->stable,
								'phq4' => $request->phq4,
								'gad7' => $request->gad7,
								'brest_cancer' => $request->brest_cancer,
								'hepC' => $request->hepC,
								'art_ost' => $request->art_ost,
								'd1' => $request->d1,
								'd2' => $request->d2,
								'd3' => $request->d3,
								'd4' => $request->d4,
								'cage' => $request->cage,
								'Disclosure_Define' => $request->disclosure_def,
								'Case_Presention' => $request->case_presention,
								'PHQ9_Define' => $request->phq9_def,
								'PHATB_Define' => $request->ipt_artTB_def,
								'Only_IPT' => $request->only_ipt,
								'Only_TB_Define' => $request->tb_def,
								'gad7_Define' => $request->gad7_def,
								'created_by' => $request->created_by,
								'updated_by' => $request->created_by,
							]);

						Coulselling::where('Pid', '=', $gid)
							->where('Counselling_Date', '=', $cdate) // HTS Create row input
							->update([
								'Pid' => $request->Pid,
								'FuchiaID' => $request->FuchiaID,
								'Age' => $request->Agey,
								'Test_Location' => $test_locate,

								'Counsellor' => $counsellor,
								'Counselling_Date' => $request->Counselling_Date,
								'Pre' => $request->Pre,
								'Post' => $request->Post,
								'Main Risk' => $main_risk,
								'Sub Risk' => $sub_risk,
							]);
					}
					// conselling only
					elseif ($updatedType == 0) {
						$counselling_update = Coulselling::where('id', $address)
							->where('Pid', '=', $gid)
							->where('Counselling_Date', '=', $cdate) // HTS Create row input
							->update([
								'Clinic code' => $request->clinic_code,
								'Pid' => $request->Pid,
								'FuchiaID' => $request->FuchiaID,
								'Gender' => $gender,
								'Age' => $request->Agey,
								'Test_Location' => $test_locate,

								'Counsellor' => $counsellor,
								'Counselling_Date' => $request->Counselling_Date,
								'Pre' => $request->Pre,
								'Post' => $request->Post,

								'Main Risk' => $main_risk,
								'Sub Risk' => $sub_risk,
								'Service_Modality' => $service,
								'Mode of Entry' => $mode_of_entry,
								'New_Old' => $new_old,

								'HIV_Test_Date' => $request->hiv_test_date,
								'HIV_Test_Determine' => $hiv_determine,
								'HIV_Test_UNI' => $hiv_unigold,
								'HIV_Test_STAT' => $hiv_stat,
								'HIV_Final_Result' => $hiv_final,

								'Syp_Test_Date' => $request->syp_date,
								'Syphillis_RDT' => $syp_rdt,
								'Syphillis_RPR' => $syp_rpr,
								'Syphillis_VDRL' => $syp_vdrl,

								'Hep_Test_Date' => $request->hep_date,
								'Hepatitis_B' => $hep_b,
								'Hepatitis_C' => $hep_c,

								'updated_by' => $request->created_by,
							]);
						$counselling_update = CounsellorRecords::where('Pid', '=', $gid)
							->where('Counselling_Date', '=', $cdate)
							->update([
								'Clinic Code' => $request->clinic_code,
								'Pid' => $request->Pid,
								'FuchiaID' => $request->FuchiaID,
								'PrEPCode' => $request->PrEPCode,
								'Gender' => $request->Gender,
								'Agey' => $request->Agey,
								'Agem' => $request->Agem,

								'Counselling_Date' => $request->Counselling_Date,
								'Counsellor' => $counsellor,
								'Main Risk' => $main_risk,
								'Sub Risk' => $sub_risk,

								'Pre' => $request->Pre,
								'Post' => $request->Post,
								'HTSdone' => $HTSdone,
								'Reason' => $Reason,
								'Status' => $Status,
								'PrEP' => $request->PrEP,
								'PrEP Status' => $PrEP_Status,
								'C1' => $request->c1,
								'C2' => $request->c2,
								'C3' => $request->c3,
								'ADH' => $request->adh,
								'Child under15 Adoles' => $request->Child_under15_Adoles,
								'Child under15 Dis' => $request->Child_under15_Dis,
								'Child under15 ADH' => $request->Child_under15_ADH,
								'MMT' => $request->mmt,
								'IPT' => $request->ipt,
								'TB' => $request->tb,
								'NCD' => $request->ncd,
								'ANC' => $request->anc,
								'PFA' => $request->pfa,
								'PHQ9' => $request->phq9,
								'Other' => $request->Other,
								'EAC' => $request->eac,
								'HMT' => $request->hmt,
								'C P case' => $request->c_p_case,
								'PMTCT' => $request->pmtct,
								'c2_done' => $request->c2_done,
								'stable' => $request->stable,
								'phq4' => $request->phq4,
								'gad7' => $request->gad7,
								'brest_cancer' => $request->brest_cancer,
								'hepC' => $request->hepC,
								'art_ost' => $request->art_ost,
								'd1' => $request->d1,
								'd2' => $request->d2,
								'd3' => $request->d3,
								'd4' => $request->d4,
								'cage' => $request->cage,
								'Disclosure_Define' => $request->disclosure_def,
								'Case_Presention' => $request->case_presention,
								'PHQ9_Define' => $request->phq9_def,
								'PHATB_Define' => $request->ipt_artTB_def,
								'Only_IPT' => $request->only_ipt,
								'Only_TB_Define' => $request->tb_def,
								'gad7_Define' => $request->gad7_def,
								'created_by' => $request->created_by,
								'updated_by' => $request->created_by,
							]);
					}
					if ($counselling_update) {
						$success = 1;
					} else {
						$success = 3.2; //do not find HTS or Counseling;
					}
				}
			} else {
				$success = 2; //This Patient do not Pass Reception Center
			} // HTS and counselling close
			return response()->json([$success, $pt_data_update]);
		}

		if ($ckID == 1) {
			//to check the patient is in general patients list
			$year = $request->input('year');
			$vdate = $request->input('vdate');
			$type_counselling = [];
			$searchType = $request->input('searchType');

			$new_old = Coulselling::whereYear('Counselling_Date', $year)->where("Pid", $gid)->exists();
			$patientData = PtConfig::where('Pid', '=', $gid)
				->select('pt_configs.*')
				->get()
				->map(function ($ptConfig) use ($gid) {
					$rprtest = Rprtest::where('pid', $gid)
						->latest('vdate')
						->select('Titre(current)', 'vdate')
						->first();

					$ptConfig["Titre(current)"] = $rprtest["Titre(current)"] ?? null;
					$ptConfig->vdate = $rprtest->vdate ?? null;

					return $ptConfig;
				})
				->first();
			$follow = Followup_general::where('Pid', '=', $gid)->where('Visit Date', $vdate)->exists();
			if (($patientData && $follow) || ($patientData && $searchType == "pat_record") || ($patientData && $searchType == "TeleCounselling")) {
				$ptNameDecrypt = $patientData['Name'];
				$ptNameDecrypt = Crypt::decryptString($ptNameDecrypt);


				$patientData["Titre(current)"] = Crypt::decrypt_light($patientData["Titre(current)"], $table);

				$ptRegion = $patientData['Region'];
				$ptRegion = Crypt::decryptString($ptRegion);

				$ptTownship = $patientData['Township'];
				$ptTownship = Crypt::decryptString($ptTownship);

				$ptQuarter = $patientData['Quarter'];
				$ptQuarter = Crypt::decryptString($ptQuarter);

				$phone = $patientData['Phone'];
				$phone = Crypt::decryptString($phone);

				$phone2 = $patientData['Phone2'];
				$phone2 = Crypt::decryptString($phone2);

				$phone3 = $patientData['Phone3'];
				$phone3 = Crypt::decryptString($phone3);

				$dob = "";

				$table = 'General';
				$gender = $patientData['Gender'];
				$gender = Crypt::decrypt_light($gender, $table);

				$main_risk = $patientData['Main Risk'];
				$main_risk = Crypt::decrypt_light($main_risk, $table);

				$sub_risk = $patientData['Sub Risk'];
				$sub_risk = Crypt::decrypt_light($sub_risk, $table);
				if ($searchType == "TeleCounselling") {
					return response()->json([
						$patientData,
						$ptNameDecrypt,
						$ptRegion,
						$ptTownship,
						$ptQuarter,
						$phone,
						$phone2,
						$phone3,
						$new_old,
						$dob,
						$gender,
						$main_risk,
						$sub_risk,
						$type_counselling,
						// $last_rpr,
						// $last_rpr_date,
					]);
				}

				$coun_record_exist = CounsellorRecords::where('Pid', $gid)->exists();
				$coun_alredy_exist = CounsellorRecords::where('Pid', $gid)->where('Counselling_Date', $vdate)->exists();
				$mental_exist = Mental_Health::where('Pid', $gid)->where('Counselling_Date', $vdate)->first();
				$patientData["mental_exist"] = $mental_exist;
				if (!$coun_record_exist) {
					$patient = 'new';
				} else {
					$patient = 'old';
				}

				if ($coun_alredy_exist) {
					$type_counselling = CounsellorRecords::where('counsellor_records.Pid', '=', $gid)->where('counsellor_records.Counselling_Date', $vdate)
						->leftjoin('mental__healths', function ($join) {
							$join->on('counsellor_records.Pid', '=', 'mental__healths.Pid')
								->whereColumn('mental__healths.Counselling_Date', '=', 'counsellor_records.Counselling_Date');
						})
						->select('counsellor_records.*', 'mental__healths.Q1_Q2', 'mental__healths.Q3_Q4', 'mental__healths.gad7_amount', 'mental__healths.PHQ9_amount', 'mental__healths.Drug3M', 'mental__healths.SexDrug', 'mental__healths.ChemSex', 'mental__healths.A', 'mental__healths.B', 'mental__healths.C', 'mental__healths.D', 'mental__healths.Remark')
						->first();
					$table = 'General';
					$type_counselling['HTSdone'] = Crypt::decrypt_light($type_counselling['HTSdone'], $table);
					$type_counselling['PrEP Status'] = Crypt::decrypt_light($type_counselling['PrEP Status'], $table);
					$type_counselling['Reason'] = Crypt::decrypt_light($type_counselling['Reason'], $table);
					$type_counselling['Status'] = Crypt::decrypt_light($type_counselling['Status'], $table);
				}
				if ($searchType == "pat_record") {
					$coul_last_date = CounsellorRecords::where('Pid', $gid)->latest('Counselling_Date')
						->select('Counselling_Date')
						->first();
					if ($coul_last_date) {
						$patientData["Counselling_Date"] = $coul_last_date["Counselling_Date"];
					}
				}
				$patientData = Export_age::Export_general($patientData, $vdate, $patientData["Date of Birth"], $patientData);
				$acutal_reg_date = explode("-", $patientData["Reg Date"]);
				if ($acutal_reg_date[0] != $patientData["Reg year"]) {
					$patientData["Reg Date"] = $patientData["Reg year"] . "-" . $acutal_reg_date[1] . '-' . $acutal_reg_date[2];
				}

				return response()->json([
					$patientData,
					$ptNameDecrypt,
					$ptRegion,
					$ptTownship,
					$ptQuarter,
					$phone,
					$phone2,
					$phone3,
					$new_old,
					$dob,
					$gender,
					$main_risk,
					$sub_risk,
					$patient,
					$type_counselling,
					$coun_alredy_exist,

					// $last_rpr,
					// $last_rpr_date,
				]);
				$ckID = 0;
			} else {
				$err = null;
				return response()->json([$err]);
				$ckID = 0;
			}
		}
		if ($hiv_test == 1) {
			$table = 'General';
			$hiv_test_data = Lab::select('Detmine_Result', 'Unigold_Result', 'STAT_PAK_Result', 'Final_Result')->where('CID', '=', $gid)->where('vdate', '=', $hiv_test_date)->first();

			$determine_result = Crypt::decrypt_light($hiv_test_data['Detmine_Result'], $table);

			$unigold_Result = Crypt::decrypt_light($hiv_test_data['Unigold_Result'], $table);
			$stat_PAK_Result = Crypt::decrypt_light($hiv_test_data['STAT_PAK_Result'], $table);
			$final_Result = Crypt::decrypt_light($hiv_test_data['Final_Result'], $table);

			return response()->json([$hiv_test_data, $determine_result, $unigold_Result, $stat_PAK_Result, $final_Result]);
		}
		if ($rpr_test == 1) {
			$table = 'General';
			$rpr_test_data = Rprtest::select('RDT Result', 'RPR Qualitative')->where('pid', '=', $gid)->where('vdate', '=', $rpr_test_date)->latest('created_at')->first();

			$rdt = Crypt::decrypt_light($rpr_test_data['RDT Result'], $table);
			$rpr = Crypt::decrypt_light($rpr_test_data['RPR Qualitative'], $table);
			//  $vdrl=Crypt::decrypt_light($rpr_test_data["Final_Result"],$table);
			return response()->json([
				$rpr_test_data,
				$rdt,
				$rpr,
				// $vdrl,
			]);
		}
		if ($hepB_test == 1) {
			$table = 'General';
			$hepB_test_data = LabHbcTest::select('HepB Result', 'HepC Result')->where('CID', '=', $gid)->where('vdate', '=', $hepB_test_date)->latest('created_at')->first();

			$hbsag = Crypt::decrypt_light($hepB_test_data['HepB Result'], $table);
			$hcv_ab = Crypt::decrypt_light($hepB_test_data['HepC Result'], $table);
			return response()->json([$hepB_test_data, $hbsag, $hcv_ab]);
		}

		// HTS Section
		if ($listShow == 1) {
			$date_from = $request->input('dateFrom');
			$search_ID = $request->input('search_ID');
			$date_to = $request->input('dateTo');
			$updatedType = $request->input('updatedType');
			$date_from = date($date_from);
			$date_to = date($date_to);

			if ($updatedType == 1) {
				//Counselling only
				$counselling_data = CounsellorRecords::select('id', 'Pid', 'FuchiaID', 'Counselling_Date')
					->whereBetween('Counselling_Date', [$date_from, $date_to])
					->orwhere('Pid', $search_ID)
					->get();
				foreach ($counselling_data as $key => $value) {
					$pt_age_risk = PtConfig::select('Main Risk', 'Agey', 'Agem')
						->where('Pid', $value['Pid'])
						->first();
					if ($pt_age_risk) {
						$counselling_data[$key]['Main Risk'] = Crypt::decrypt_light($pt_age_risk['Main Risk'], $table);
						$counselling_data[$key]['Register Age'] = $pt_age_risk['Agey'];
						$counselling_data[$key]['Register Agem'] = $pt_age_risk['Agem'];
					}
				}
				$updated_data = $counselling_data;
			} elseif ($updatedType == 0) {
				//HTS
				$hts_data = Coulselling::where(function ($query) use ($date_from, $date_to, $search_ID) {
					$query->whereBetween('Counselling_Date', [$date_from, $date_to])
						->orWhere('Pid', $search_ID);
				})
					->leftjoin('labs', function ($join) {
						$join->on('coulsellings.Pid', '=', 'labs.CID')
							->whereColumn('labs.vdate', '=', 'coulsellings.Counselling_Date');
					})
					->select('labs.Req_Doctor', 'coulsellings.id', 'Pid', 'coulsellings.FuchiaID', 'Counselling_Date', 'HIV_Final_Result', 'New_Old')
					->get();

				foreach ($hts_data as $key => $value) {
					$pt_age_risk = PtConfig::select('Main Risk', 'Agey', 'Agem')
						->where('Pid', $value['Pid'])
						->first();
					if ($pt_age_risk) {
						$hts_data[$key]['Main Risk'] = Crypt::decrypt_light($pt_age_risk['Main Risk'], $table);
						$hts_data[$key]['Register Age'] = $pt_age_risk['Agey'];
						$hts_data[$key]['Register Agem'] = $pt_age_risk['Agem'];
					}

					$hts_data[$key]['HIV_Final_Result'] = Crypt::decrypt_light($hts_data[$key]['HIV_Final_Result'], $table);
					$hts_data[$key]['Req_Doctor'] = Crypt::decrypt_light($hts_data[$key]['Req_Doctor'], $table);
					$hts_data[$key]['New_Old'] = Crypt::decrypt_light($hts_data[$key]['New_Old'], $table);
					if ($hts_data[$key]['New_Old'] == null) {
						$hts_data[$key]['New_Old'] = '';
					}
				}
				$updated_data = $hts_data;
			} elseif ($updatedType == 2) {
				$confidential_data = PtConfig::where('Pid', $search_ID)
					->first();
				if ($confidential_data) {
					$confid_encrypt = [
						'Region',
						'Township',
						'Quarter',
						'Phone',
						'Phone2',
						'Phone3',
						'Date of Birth'
					];


					foreach ($confid_encrypt as $encypt) {
						$confidential_data[$encypt] = Crypt::decryptString($confidential_data[$encypt]);
					}

					$confidential_data["Main Risk"] = Crypt::decrypt_light($confidential_data["Main Risk"], $table);
					$confidential_data["Sub Risk"] = Crypt::decrypt_light($confidential_data["Sub Risk"], $table);
					return response()->json([$confidential_data, $updatedType]);
				}
			} elseif ($updatedType == 3) {
				$tele_data = TeleCounselling::whereBetween('Call_Date', [$date_from, $date_to])->leftjoin("confid.pt_configs", "pt_configs.Pid", "tele_counsellings.Pid")
					->select("tele_counsellings.*", "Name")->get();
				if ($tele_data) {
					foreach ($tele_data as $tele_each) {
						$tele_each["Enamal"] = ($tele_each["Enamal"] != null) ? Crypt::decryptString($tele_each["Enamal"]) : "";
						$tele_each["Enamal"] = ($tele_each["Name"] != null && $tele_each["Pid"] != null) ? Crypt::decryptString($tele_each["Name"]) : $tele_each["Enamal"];
						$tele_each["Gender"] = Crypt::decrypt_light($tele_each["Gender"], $table);
						if (!$tele_each["Pid"]) {
							$tele_each["Pid"] = "";
						}

						$tele_each["Call_Date"] = date('d-m-Y', strtotime($tele_each["Call_Date"]));
						if ($tele_each["Call_Date"] == '01-01-1970') {
							$tele_each["Call_Date"] = '';
						};
					}
				}
				return response()->json([$tele_data, $updatedType]);
			} elseif ($updatedType == 4) {
				$mental_data = Mental_Health::where(function ($query) use ($date_from, $date_to, $search_ID) {
					$query->whereBetween('mental__healths.Counselling_Date', [$date_from, $date_to])
						->orWhere('mental__healths.Pid', $search_ID);
				})->leftjoin('counsellor_records', function ($join) {
					$join->on('counsellor_records.Pid', '=', 'mental__healths.Pid')
						->whereColumn('counsellor_records.Counselling_Date', '=', 'mental__healths.Counselling_Date');
				})->select(
					'mental__healths.*',
					'counsellor_records.gad7',
					'counsellor_records.gad7_Define',
					'counsellor_records.PHQ9',
					'counsellor_records.PHQ9_Define',
					'counsellor_records.phq4',

				)->get();
				foreach ($mental_data as $mental_data_each) {
					$mental_data_each["Counselling_Date"] = date('d-m-Y', strtotime($mental_data_each["Counselling_Date"]));
					if ($mental_data_each["Counselling_Date"] == '01-01-1970') {
						$mental_data_each["Counselling_Date"] = '';
					};
				}

				return response()->json([$mental_data, $updatedType]);
			}

			if (count($updated_data) > 0) {
				foreach ($updated_data as $key => $up_data) {
					if (!empty($up_data)) {
						$updated_data[$key]['Counselling_Date'] = date('d-m-Y', strtotime($up_data['Counselling_Date']));
						if ($updated_data[$key]['Counselling_Date'] == '01-01-1970') {
							$updated_data[$key]['Counselling_Date'] = '';
						}
					} else {
						$updated_data[$key]['Counselling_Date'] = '';
					}
					if ($up_data['FuchiaID'] == null) {
						$updated_data[$key]['FuchiaID'] = '-';
					}
				}

				return response()->json([$updated_data, $updatedType]);
			} else {
				return response()->json(['no data']);
			}
		} // HTS data show
		if ($decryptFetch == 1) {
			$confid_encrypt = [
				'Region',
				'Township',
				'Quarter',
				'Phone',
				'Phone2',
				'Phone3',
			];
			$confid_samll = [
				'Main Risk',
				'Sub Risk',
				'Gender',
			];
			$counselling_only_encypt = [
				'Counsellor',
				'HTSdone',
				'Reason',
				'Status',
				'PrEP Status'
			];
			$hts_encrypt = [
				'New_Old',
				'Counsellor',
				'Service_Modality',
				'Mode of Entry',
				'HIV_Test_Determine',
				'HIV_Test_UNI',
				'HIV_Test_STAT',
				'HIV_Final_Result',
				'Syphillis_RDT',
				'Syphillis_RPR',
				'Syphillis_VDRL',
				'Hepatitis_B',
				'Hepatitis_C',
				'Test_Location'
			];
			$hts_data_next = [];
			// return data from view to encrypt the row
			$address = $request->input('address');
			$res_date = $request->input('res_date');
			$id = $request->input('id');
			$updatedType = $request->input('updatedType');
			$patientData = PtConfig::select('Pid', 'FuchiaID', 'PrEPCode', 'Region', 'Township', 'Quarter', 'Phone', 'Phone2', 'Phone3', 'Reg Date', 'Agey', 'PrEPCode', 'Clinic Code', 'Main Risk', 'Sub Risk', 'Agem', 'Date of Birth', 'Gender')->where('Pid', '=', $id)->first();
			$coun_row_data = CounsellorRecords::where('Pid', '=', $id)->where('Counselling_Date', $res_date)->first();
			if ($patientData) {
				foreach ($confid_encrypt as $value) {
					$patientData[$value] = Crypt::decryptString($patientData[$value]);
				}
				$patientData = Export_age::Export_general($patientData, $coun_row_data["Counselling_Date"], $patientData["Date of Birth"], $patientData);
				$acutal_reg_date = explode("-", $patientData["Reg Date"]);
				if ($acutal_reg_date[0] != $patientData["Reg year"]) {
					$patientData["Reg Date"] = $patientData["Reg year"] . "-" . $acutal_reg_date[1] . '-' . $acutal_reg_date[2];
				}

				$patientData["Date of Birth'"] = "";
				foreach ($confid_samll as $value) {
					$patientData[$value] = Crypt::decrypt_light($patientData[$value], $table);
				}
				if ($coun_row_data) {
					foreach ($counselling_only_encypt as $value) {
						$coun_row_data[$value] = Crypt::decrypt_light($coun_row_data[$value], $table);
					}
				}
				if ($updatedType == 0) {
					$hts_data_next = Coulselling::where('Pid', $id)->where('Counselling_Date', $res_date)->first();
					if ($hts_data_next) {
						foreach ($hts_encrypt as $value) {
							$hts_data_next[$value] = Crypt::decrypt_light($hts_data_next[$value], $table);
						}
					}
				}
				return response()->json([$patientData, $coun_row_data, $hts_data_next]);
			} else {
				return response()->json("No confidential");
			}
		}
		if ($htsUpdate == 'remove_row') {
			$id = $request['id'];
			$Pid = $request['Pid'];
			$counselling_date = $request['counselling_date'];
			$updated_type = $request['update_type'];
			if ($updated_type == 0) {
				$hts_exist = Coulselling::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->exists();
				if ($hts_exist) {
					Coulselling::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->delete();
					$remove_mesg = 'Delete HTS Data';
				} else {
					$remove_mesg = 'Your Wrong Credential contant to Admin';
				}
			}
			//HTS
			elseif ($updated_type == 1) {
				$counselling_exist = CounsellorRecords::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->exists();
				if ($counselling_exist) {
					CounsellorRecords::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->delete();
					$remove_mesg = 'Delete Counselling  Data';
				} else {
					$remove_mesg = 'Your Wrong Credential contant to Admin';
				}
			}
			//Counselling Only
			elseif ($updated_type == 3) {
				$tele_dele = TeleCounselling::where('id', $id)->where('Pid', $Pid)->where('Call_Date', $counselling_date)->delete();
				$remove_mesg = 'Delete TeleCounselling  Data';
				if (!$tele_dele) {
					$remove_mesg = 'Your Wrong Credential contant to Admin';
				}
			} elseif ($updated_type == 4) {
				$mental_delete = Mental_Health::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->delete();
				CounsellorRecords::where("Pid", $Pid)->where('Counselling_Date', $counselling_date)->update([
					'PHQ9' => 0,
					'gad7' => 0,
					'PHQ9_Define' => null,
					'gad7_Define' => null,
				]);

				if ($mental_delete) {
					$remove_mesg = "Mental Health Delete Successfull";
				} else {
					$remove_mesg = 'Your Wrong Credential contant to Admin';
				}
			} else {
				$remove_mesg = "You don't have permission to delete this record";
			}

			return response()->json($remove_mesg);
		} // Remvoe Date HTS or Counselling only

		// Risk_Age_ update
	}
	public function export_starter(Request $data)
	{
		$from = $data->input('dateFrom');
		$to = $data->input('dateTo');
		$table = 'General';

		$hts_coul = $data->input('hts_coul');
		if ($from != null && $from != '' && $to != null && $to != '') {
			$date_from = DateTime::createFromFormat('d-m-Y', $from);
			$from = $date_from->format('Y-m-d');
			$date_to = DateTime::createFromFormat('d-m-Y', $to);
			$to = $date_to->format('Y-m-d');
			$final_risklog = [];
			$final_log = [];
			if ($hts_coul == 'counsel_data') {
				$users1 = CounsellorRecords::whereBetween('Counselling_Date', [$from, $to])
					->with([
						'ptconfig' => function ($query) {
							$query->select('Pid', 'Name', 'Township', 'Gender', 'Date of Birth', 'Agey', 'Agem', 'Main Risk', 'Sub Risk', 'Risk Log', 'Risk Change_Date', 'Former Risk'); // Select the specific columns from ptconfig
						},
					])
					->get();


				$encrypted_columns = ['Counsellor', 'Main Risk', 'Sub Risk', 'HTSdone', 'Reason', 'Status', 'PrEP Status', 'Gender'];
				$counselling_dates = ['Counselling_Date', 'Reg Date'];

				foreach ($users1 as $key => $user1) {
					if ($user1['ptconfig'] != null) {
						$users1[$key] = Export_age::Export_general($user1['ptconfig'], $user1['Counselling_Date'], $user1['ptconfig']['Date of Birth'], $users1[$key]);
						$carbonDate = Carbon::createFromFormat('Y-m-d', $user1['Counselling_Date']);
						$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
						$vdate = new DateTime($carbonDate);
						$user1['Gender'] = $user1['ptconfig']['Gender'];
						$user1["Main Risk"] = $user1["ptconfig"]["Main Risk"];
						$user1["Sub Risk"] = $user1["ptconfig"]["Sub Risk"];
						$forRiskCheck[1]["Pid"] = $user1["ptconfig"]["Pid"];
						$forRiskCheck[1]["Risk Log"] = $user1["ptconfig"]["Risk Log"];

						if (!array_key_exists($user1["ptconfig"]["Pid"], $final_log) && $user1["ptconfig"]["Risk Log"] != null) {
							$final_risklog = RefillRisk::FillRisk($forRiskCheck);
							$final_log[$user1["ptconfig"]["Pid"]] = $final_risklog;
						} elseif ($user1["ptconfig"]["Risk Log"] == null) {
							if ($user1['ptconfig']["Risk Change_Date"] != null && $user1['ptconfig']["Former Risk"] != null && $user1['ptconfig']["Former Risk"] != "731") {
								$riskChangeDate = Carbon::createFromFormat('Y-m-d', $user1['ptconfig']["Risk Change_Date"]);
								$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
								if ($vdate < $riskChangeDate) {
									$user1["Main Risk"] = $user1['ptconfig']["Former Risk"];
									$user1["Sub Risk"] = '';
								}
							}
						}
						if (array_key_exists($user1["ptconfig"]["Pid"], $final_log)) {
							foreach (array_reverse($final_log[$user1["ptconfig"]["Pid"]][$user1["ptconfig"]["Pid"]]) as $date => $data) {
								if (strlen($date) == 10) {
									$riskChangeDate = new DateTime($date);
									if ($vdate < $riskChangeDate) {
										$user1["Main Risk"] = Crypt::encrypt_light($data["Old Risk"], "General");
										$user1["Sub Risk"] = Crypt::encrypt_light($data["Old Sub Risk"], "General");
									}
								}
							}
						}
					}
					$users1[$key]['Counselling_Date'] = Date::dateTimeToExcel($carbonDate->toDateTime());
					foreach ($encrypted_columns as $encrypted_column) {
						$user1[$encrypted_column] = Crypt::decrypt_light($user1[$encrypted_column], $table);
						$user1[$encrypted_column] = Crypt::codeBook($user1[$encrypted_column], 'encode');
					}
				}
				return Excel::download(new CounsellingExport($users1, $hts_coul), 'Counselling Export-' . date('d-m-Y') . '.xlsx');
			} elseif ($hts_coul == 'hts_data') {
				$users1 = Coulselling::whereBetween('Counselling_Date', [$from, $to])
					->leftjoin('labs', function ($join) {
						$join->on('coulsellings.Pid', '=', 'labs.CID')
							->whereColumn('labs.vdate', '=', 'coulsellings.Counselling_Date');
					})
					->select('coulsellings.*', 'labs.Req_Doctor')
					->with([
						'ptconfig' => function ($query) {
							$query->select('Pid', 'Name', 'Township', 'Date of Birth', 'Agey', 'Agem', 'Main Risk', 'Sub Risk', 'Risk Log', 'Gender', 'Risk Change_Date', 'Former Risk');
						},
					])
					->get();
				dd($users1);

				$encrypted_columns = ['Gender', 'Counsellor', 'Service_Modality', 'Mode of Entry', 'New_Old', 'Test_Location', 'Main Risk', 'Sub Risk', 'HIV_Test_Determine', 'HIV_Test_UNI', 'HIV_Test_STAT', 'HIV_Final_Result', 'Syphillis_RDT', 'Syphillis_RPR', 'Syphillis_VDRL', 'Hepatitis_B', 'Hepatitis_C', 'Req_Doctor'];
				$dates_hts = ['Counselling_Date', 'HIV_Test_Date', 'Syp_Test_Date', 'Hep_Test_Date'];

				foreach ($users1 as $key => $user1) {
					if ($user1['ptconfig'] != null) {
						$users1[$key] = Export_age::Export_general($user1['ptconfig'], $user1['Counselling_Date'], $user1['ptconfig']['Date of Birth'], $users1[$key]);
						$users1[$key]['Main Risk'] = $user1['ptconfig']['Main Risk'];
						$users1[$key]['Sub Risk'] = $user1['ptconfig']['Sub Risk'];
						$user1['Gender'] = $user1['ptconfig']['Gender'];
						$carbonDate = Carbon::createFromFormat('Y-m-d', $user1['Counselling_Date']);
						$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
						$vdate = new DateTime($carbonDate);
						$forRiskCheck[1]["Pid"] = $user1["ptconfig"]["Pid"];
						$forRiskCheck[1]["Risk Log"] = $user1["ptconfig"]["Risk Log"];

						if (!array_key_exists($user1["ptconfig"]["Pid"], $final_log) && $user1["ptconfig"]["Risk Log"] != null) {
							$final_risklog = RefillRisk::FillRisk($forRiskCheck);
							$final_log[$user1["ptconfig"]["Pid"]] = $final_risklog;
						} elseif ($user1["ptconfig"]["Risk Log"] == null) {
							if ($user1['ptconfig']["Risk Change_Date"] != null && $user1['ptconfig']["Former Risk"] != null && $user1['ptconfig']["Former Risk"] != "731") {
								$riskChangeDate = Carbon::createFromFormat('Y-m-d', $user1['ptconfig']["Risk Change_Date"]);
								$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
								if ($vdate <= $riskChangeDate) {
									$user1["Main Risk"] = $user1['ptconfig']["Former Risk"];
									$user1["Sub Risk"] = '';
								}
							}
						}
						if (array_key_exists($user1["ptconfig"]["Pid"], $final_log)) {
							foreach (array_reverse($final_log[$user1["ptconfig"]["Pid"]][$user1["ptconfig"]["Pid"]]) as $date => $data) {
								if (strlen($date) == 10) {
									$riskChangeDate = new DateTime($date);
									if ($vdate < $riskChangeDate) {
										$user1["Main Risk"] = Crypt::encrypt_light($data["Old Risk"], "General");
										$user1["Sub Risk"] = Crypt::encrypt_light($data["Old Sub Risk"], "General");
									}
								}
							}
						}
					}
					$visit_year = date('Y', strtotime($user1["Counselling_Date"]));

					// Query to check if a record exists with the specified conditions
					$final_new_old = Coulselling::whereYear('Counselling_Date', $visit_year)
						->where('Pid', $user1["Pid"])
						->where('Counselling_Date', '<', $user1["Counselling_Date"])
						->exists();
					if ($final_new_old) {
						$user1["Final_new_old"] = "Old";
					} else {
						$user1["Final_new_old"] = "New";
					}

					foreach ($dates_hts as $date) {
						if ($user1[$date] != null && $user1[$date] != '') {
							$carbonDate = Carbon::createFromFormat('Y-m-d', $user1[$date]);
							$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
							$users1[$key][$date] = Date::dateTimeToExcel($carbonDate->toDateTime());
						}
					}
					foreach ($encrypted_columns as $encrypted) {
						$users1[$key][$encrypted] = Crypt::decrypt_light($user1[$encrypted], $table);
						$users1[$key][$encrypted] = Crypt::codeBook($user1[$encrypted], 'encode');
					}
				}

				//dd($user1);
				return Excel::download(new CounsellingExport($users1, $hts_coul), 'HTS Export-' . date('d-m-Y') . '.xlsx');
			} elseif ($hts_coul == 'TeleCounselling') {
				$users = TeleCounselling::whereBetween('Call_Date', [$from, $to])
					->leftjoin('confid.pt_configs', 'pt_configs.Pid', '=', 'tele_counsellings.Pid')
					->select('tele_counsellings.*', 'Date of Birth', 'Name', 'Agey', 'Agem', 'pt_configs.Gender as Sex')
					->get();
				foreach ($users as $key => $user) {
					if ($user["Pid"] != null) {
						$user = Export_age::Export_general($user, $user['Call_Date'], $user['Date of Birth'], $user);
						$user["Name"] = Crypt::decryptString($user["Name"]);
						$user["Gender"] = Crypt::decrypt_light($user["Sex"], $table);
					} else {
						$user["Name"] = Crypt::decryptString($user["Enamal"]);
						$user["Gender"] = Crypt::decrypt_light($user["Gender"], $table);
					}
					$carbonDate = Carbon::createFromFormat('Y-m-d', $user["Call_Date"]);
					$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
					$user["Call_Date"] = Date::dateTimeToExcel($carbonDate->startOfDay());
				}
				return Excel::download(new CounsellingExport($users, $hts_coul), 'TeleCounselling-' . date('d-m-Y') . '.xlsx');
			} elseif ($hts_coul == 'Mental Health') {
				$mental_exportes = Mental_Health::WhereBetween("mental__healths.Counselling_Date", [$from, $to])
					->leftjoin('confid.pt_configs', function ($config_join) {
						$config_join->on("confid.pt_configs.Pid", '=', 'mental__healths.Pid');
					})->select(
						'mental__healths.*',
						'confid.pt_configs.FuchiaID',
						'confid.pt_configs.FuchiaID',
						'confid.pt_configs.Agey',
						'confid.pt_configs.Agem',
						'confid.pt_configs.Gender',
						'Date of Birth',
						'Former Risk',
						'Risk Change_Date',
						'Main Risk',
						'Sub Risk',
						'Risk Log'
					)->get();

				$encrypted_columns = ['Main Risk', 'Sub Risk', 'Gender', 'Final Result'];
				foreach ($mental_exportes as $mental_export) {
					if ($mental_export["Date of Birth"] != null) {
						$mental_export = Export_age::Export_general($mental_export, $mental_export['Counselling_Date'], $mental_export['Date of Birth'], $mental_export);
					}
					$carbonDate = Carbon::createFromFormat('Y-m-d', $mental_export['Counselling_Date']);
					$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
					$vdate = new DateTime($carbonDate);
					$forRiskCheck[1]["Pid"] = $mental_export["Pid"];
					$forRiskCheck[1]["Risk Log"] = $mental_export["Risk Log"];

					if (!array_key_exists($mental_export["Pid"], $final_log) && $mental_export["Risk Log"] != null) {
						$final_risklog = RefillRisk::FillRisk($forRiskCheck);
						$final_log[$mental_export["Pid"]] = $final_risklog;
					} elseif ($mental_export["Risk Log"] == null) {
						if ($mental_export["Risk Change_Date"] != null && $mental_export["Former Risk"] != null && $mental_export["Former Risk"] != "731") {
							$riskChangeDate = Carbon::createFromFormat('Y-m-d', $mental_export["Risk Change_Date"]);
							$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
							if ($vdate < $riskChangeDate) {
								$mental_export["Main Risk"] = $mental_export["Former Risk"];
								$mental_export["Sub Risk"] = '';
							}
						}
					}
					if (array_key_exists($mental_export["Pid"], $final_log)) {
						foreach (array_reverse($final_log[$mental_export["Pid"]][$mental_export["Pid"]]) as $date => $data) {
							if (strlen($date) == 10) {
								$riskChangeDate = new DateTime($date);
								if ($vdate < $riskChangeDate) {
									$mental_export["Main Risk"] = Crypt::encrypt_light($data["Old Risk"], "General");
									$mental_export["Sub Risk"] = Crypt::encrypt_light($data["Old Sub Risk"], "General");
								}
							}
						}
					}
					$mental_export['Counselling_Date'] = Date::dateTimeToExcel($carbonDate->startOfDay());
					$hiv_status = Lab::where("CID", $mental_export["Pid"])->latest('vdate')->select("Final_Result")->first();
					if ($hiv_status) {
						$mental_export["Final Result"] = $hiv_status["Final_Result"];
					}

					foreach ($encrypted_columns as $encrypted_column) {
						$mental_export[$encrypted_column] = Crypt::decrypt_light($mental_export[$encrypted_column], $table);
						$mental_export[$encrypted_column] = Crypt::codeBook($mental_export[$encrypted_column], 'encode');
					}
				}
				return Excel::download(new MentalExport($mental_exportes), 'Mental Health Export-' . date('d-m-Y') . '.xlsx');
			}
		} else {
			return view('Counsellor.counselling');
		}
	}
}
