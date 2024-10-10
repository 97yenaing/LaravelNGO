<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Exports\Export_age;
use App\Exports\MME_Export\Reception\ReceptionExport;
use App\Exports\MME_Export\Lab\LabExport;
use App\Exports\MME_Export\Counselling\CounsellingExport;
use App\Exports\MME_Export\STI\STIExport;
use App\Exports\MME_Export\Prevention\PreventionExport;
use App\Exports\MME_Export\CervicalCancer\CervicalExport;
use App\Exports\MME_Export\CMV\CMVExport;
use App\Exports\MME_Export\NCD\NCDExport;
use App\Exports\MME_Export\TB\TBExport;
use App\Exports\RiskbackExcel\RefillRisk;
use DateTime;

class MME_ExportController extends Controller
{
	//new Ncd view
	protected $DB = ["MAM_A", "MAM_B", "MAM_C1", "MAM_C2", "MAM_SPT", "MAM_SDG", "MAM_TL"];
	protected $table_code = "General";
	protected $final_risklog = [];
	protected	$final_log = [];

	public function mme_export_View()
	{
		return view("MME.mme_export");
	}
	public function mme_export(Request $request)
	{
		//dd($request);
		$validator = Validator::make($request->all(), [
			"road" => "required",
			'clinics' => 'required|array|min:1', // Ensure it's an array with at least one item
			'clinics.*' => 'string|in:All,0,1,2,3,4,5,6', // Validate each item if necessary
			'exportQuarter' => 'required|string',
			'From_date' => [
				'required_if:exportQuarter,ByDate',
				'date',
			],
			'To_date' => [
				'required_if:exportQuarter,ByDate',
				'date',
			],
		]);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}
		if ($request["exportQuarter"] == "All Data") {
			$request["From_date"] = "01-01-2000";
			$request["To_date"] = today()->format('d-m-Y');
		}
		if ($request["clinics"][0] == "All") {
			$request["clinics"] = [0, 1, 2, 3, 4, 5, 6];
		}
		$request["From_date"] = date("Y-m-d", strtotime($request["From_date"]));
		$request["To_date"] = date("Y-m-d", strtotime($request["To_date"]));

		switch ($request["road"]) {
			case "0":
				return $this->Reception_Export($request);
				break;
			case "1":
				return $this->Lab_Export($request);
				break;
			case "2":
				return $this->Counselling_Export($request);
				break;
			case "3":
				return $this->STI_Export($request);
				break;
			case "4":
				return $this->Prevention_Export($request);
				break;
			case "5":
				return $this->Cervical_Export($request);
				break;
			case "6":
				return $this->CMV_Export($request);
				break;
			case "7":
				return $this->NCD_Export($request);
				break;
			case "8": //TB03
			case "9": //PreTB
			case "10": //IPT
				return $this->TB_Export($request);
				break;
			default:
				return redirect()->back();
				break;
		}
	}

	public function Reception_Export($request)
	{
		// Increase memory limit to 1GB
		$vdate = "Visit Date";
		$dob = "Date of Birth";
		$export_data = collect([]);

		$modelClassName = "App\\Models\\Followup_general"; // extend model
		$model = app()->make($modelClassName); // resolves the model from the service container.
		foreach ($request["clinics"] as $clinic) {
			$model->setConnection($this->DB[$clinic]);
			$users = $model
				->whereBetween("Visit Date", [$request["From_date"], $request["To_date"]])
				->where("preCode", "!=", "1")
				->leftJoin("patients", "patients.Pid", "=", "followup_generals.Pid")
				->select("followup_generals.*", "Date of Birth", "patients.Agey", "patients.Agem", "patients.Gender", "patients.FuchiaID", "patients.Main Risk", "patients.Sub Risk", 'Risk Log', 'Risk Change_Date', 'Former Risk')
				->get();
			$export_data = $export_data->merge($users);
		}



		$Dates_excel = ["Next Appointment Date", "Visit Date"];
		$Decrypt_excel = ["Main Risk", "Sub Risk", "Gender", "Fever", "MUAC"];
		$diagnosis_dataonly = [
			"phacheck",
			"pha_new_old",
			"pha_cohort", //0
			"artcheck",
			"art_new_old",
			"art_cohort", //1
			"prepcheck",
			"prep_new_old", //2
			"pmtctcheck",
			"pmtct_new_old", //3
			"anccheck",
			"anc_new_old", //4
			"fmaplancheck",
			"famaplan_new_old", //5
			"gneralcheck",
			"general_new_old",
			"general_diagnosis",
			"OPD", //6
			"ncdcheck",
			"ncd_new_old",
			"ncd_diagnosis",
			"ncd_drugSupply", //7
			"hivTBcheck",
			"hivTB_new_old", //8
			"fcentercheck",
			"feedcentre_new_old", //9
			"labInvestcheck",
			"labInvest_new_old", //10
		]; // 27

		$diagnosisArray = [];
		foreach ($export_data as $index => $export) {
			$counting = 0;

			$diaString = $export["Pateint_Diagnosis"];

			if ($diaString != null && $diaString != "" && $diaString != 731) {
				$diagnosis_cut = explode("/", $diaString);
				for ($i = 0; $i < 11; $i++) {
					$diagnosis_name = explode("-", $diagnosis_cut[$i]);
					for ($j = 0; $j < count($diagnosis_name); $j++) {
						if (Str::contains($diagnosis_name[$j], "\\")) {
							$diagnosis_name[$j] = trim($diagnosis_name[$j], "\\");
						}
						if ($diagnosis_name[$j] == "731") {
							$diagnosis_final[$diagnosis_dataonly[$counting]] = "";
						} else {
							$diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($diagnosis_name[$j], $this->table_code); //decrpting all diagnosis and adding new object array
						}

						if ($counting == 21) {
							if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "hivTBcheck") {
								$diagnosis_final[$diagnosis_dataonly[$counting]] = "hiv(Neg)-TBcheck";
							} elseif ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
								$diagnosis_final[$diagnosis_dataonly[$counting]] == "";
							}
						}
						if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
							$diagnosis_final[$diagnosis_dataonly[$counting]] = "";
						}
						if ($i == 6 && count($diagnosis_name) == 3 && $j == 2) {
							$counting += 2;
						} else {
							$counting++;
						}
					}
					$diagnosisArray = $diagnosis_final;
				}
			} else {
				for ($i = 0; $i < count($diagnosis_dataonly); $i++) {
					$diagnosisArray[$diagnosis_dataonly[$i]] = "";
				}
			}


			if ($export["Date of Birth"] != null) {
				$export = Export_age::Export_general($export, $export["Visit Date"], $export["Date of Birth"], $export);
			}
			if ($export["Risk Log"] != null) {
				$carbonDate = Carbon::createFromFormat('Y-m-d', $export['Visit Date']);
				$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
				$vdate = new DateTime($carbonDate);
				$forRiskCheck[1]['Pid'] = $export['Pid'];
				$forRiskCheck[1]['Risk Log'] = $export['Risk Log'];
				if (!array_key_exists($export['Pid'], $this->final_log) && $export['Risk Log'] != null) {
					$this->final_risklog = RefillRisk::FillRisk($forRiskCheck);
					$this->final_log[$export['Pid']] = $this->final_risklog;
				}
				if (array_key_exists($export['Pid'], $this->final_log)) {
					foreach (array_reverse($this->final_log[$export['Pid']][$export['Pid']]) as $date => $data) {
						if (strlen($date) == 10) {
							$riskChangeDate = new DateTime($date);
							if ($vdate < $riskChangeDate) {
								$export['Main Risk'] = Crypt::encrypt_light($data['Old Risk'], 'General');
								$export['Sub Risk'] = Crypt::encrypt_light($data['Old Sub Risk'], 'General');
							}
						}
					}
				}
			} elseif ($export['Former Risk'] != null && $export['Former Risk'] != "731" && $export['Risk Change_Date'] != null) {
				$riskChangeDate = Carbon::createFromFormat('Y-m-d', $export['Risk Change_Date']);
				$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
				if ($vdate < $riskChangeDate) {
					$export['Main Risk'] = $export['Former Risk'];
					$export['Sub Risk'] = '';
				}
			}
			foreach ($Dates_excel as $Date_excel) {
				if ($export[$Date_excel] != null) {
					$carbonDate = Carbon::createFromFormat("Y-m-d", $export[$Date_excel]);
					$carbonDate = Carbon::createFromFormat("d-m-Y", $carbonDate->format("d-m-Y"));
					$export[$Date_excel] = Date::dateTimeToExcel($carbonDate->startOfDay());
				}
			}
			foreach ($Decrypt_excel as $decrypt_excel) {

				$export[$decrypt_excel] = Crypt::decrypt_light($export[$decrypt_excel], $this->table_code);
				if (($decrypt_excel == "Main Risk" || $decrypt_excel == "Sub Risk") && $export[$decrypt_excel] == "-") {
					$export[$decrypt_excel] = null;
				}

				$export[$decrypt_excel] = Crypt::codeBook($export[$decrypt_excel], "encode");
			}
			if (!array_key_exists("OPD", $diagnosisArray)) {
				$diagnosisArray["OPD"] = "";
			}
			$export["Diagnosis_data"] = $diagnosisArray;
		}
		return Excel::download(new ReceptionExport($export_data), "FollowUP_Export-" . date("d-m-Y") . "." . $request["typeExport"]);
	}

	public function Lab_Export($request)
	{
		$target_id = "CID";
		$table_name = null;
		$act_table = null;
		$export_name = null;
		$users = collect([]);
		//dd($request);

		switch ($request["other"]) {
			case "hiv":
				$table_name = "Lab";
				$export_name = "lab_hiv_test";
				$act_table = "labs";
				$encrypted_columns = [
					"Main Risk",
					"Sub Risk",
					"Gender",
					"Patient_Type",
					"Patient Type Sub",
					"Detmine_Result",
					"Unigold_Result",
					"STAT_PAK_Result",
					"Final_Result",
					"Req_Doctor",
					"Counsellor",
					"LabTech"
				];

				$date_type = ["vdate", "bcollectdate"];
				break;
			case "rpr":
				$table_name = "Rprtest";
				$target_id = "pid";
				$export_name = "lab_rpr_test";
				$act_table = "rprtests";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Gender", "RDT(Yes/No)", "RDT Result", "Quantitative(Yes/No)", "RPR Qualitative", "Type Of Patient", "Patient Type Sub", "Titre(current)", "Titre(Last)", "Req_Doctor", "Counsellor", "Lab Tech"];
				$date_type = ["vdate", "TitreLastDate", "Issue Date"];
				break;
			case "sti":
				$table_name = "Labstitest";
				$export_name = "lab_sti_test";
				$act_table = "labstitests";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Gender", "Req_Doctor", "Requested Doctor New", "Patient_Type", "Patient Type Sub", "Wet Mount clue cell", "Wet Mount Trichomonas", "Wet Mount candida", "wetoth", "urethra WBC", "Urethra diplococci intra-cell", "Urethra diplococci extra-cell", "Urethra Candida", "uoth", "Fornix Clue Cells", "Fornix WBC", "Fornix diplococci intra-cell", "Fornix diplococci extra-cell", "Fornix Candida", "pfother", "Endo cervix WBC", "Endo cervix diplococci intra-cell", "Endo cervix diplococci extra-cell", "Endo cervix Candida", "eother", "Rectum WBC", "Rectum diplococci intra-cell", "Rectum diplococci extra-cell", "rother", "First Per Urine", "Epithelial cells", "PMNL cells", "First Per Urine Diplococci Intra-Cell", "First Per Urine Diplococci Extra-Cell", "fpu_oth", "Lab Techanician", "Other Bacteria"];
				$date_type = ["vdate", "idate"];
				break;
			case "hep_bc":
				$table_name = "LabHbcTest";
				$export_name = "lab_hep_bc_test";
				$act_table = "lab_hbc_tests";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Gender", "Requested Doctor old", "Req_Doctor", "Patient_Type", "Patient Type Sub", "Final_Result", "HepB Test", "HepB TOT", "HepB Result", "HepC Test", "HepC TOT", "HepC Result", "Lab Tech"];
				$date_type = ["vdate", "Issue Date"];
				break;
			case "urine":
				$table_name = "Urine";
				$export_name = "lab_urine_test";
				$act_table = "urines";
				$encrypted_columns = [
					"Main Risk",
					"Sub Risk",
					"Gender",
					"Req_Doctor",
					"Patient_Type",
					"Patient Type Sub",
					"Utest_done",
					"Utot",
					"Ucolor",
					// 'Uapp',
					"Uturbitity",
					"Upus",
					"ph",
					"Uprotein",
					"Uglucose",
					"Urbc",
					"Uleu",
					"Unitrite",
					"Uketone",
					"Uepithelial",
					"Urobili",
					"Ubillru",
					"Uery",
					"Ucrystal",
					"Uhae",
					"Uother",
					"Ucast",
					"comment",
					"lab_tech",

					"Cretinine",
					"Albumin",
					"A:C_ratio",
				];
				$date_type = ["vdate", "issue_date"];
				break;
			case "oi":
				$table_name = "Lab_oi";
				$export_name = "lab_oi_test";
				$act_table = "lab_ois";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Gender", "Req_Doctor", "Patient_Type", "Patient Type Sub", "TB_LAM_Report", "Serum Result", "serum_pos", "CSF for Cryptococcal Antigen", "csf_crypto_pos", "csf_fungal", "CSF Smear Giemsa Stain", "CSF Smear India Ink", "skin_fungal", "Skin Smear Giemsa Stain", "Skin Smear India Ink", "lymph_test", "Lymph Giemsa Stain", "Lymph India Ink", "Lab Techanician", "Toxo plasma", "Toxo igG", "Toxo igM"];
				$date_type = ["vdate", "issued"];
				break;
			case "general":
				$table_name = "LabGeneralTest";
				$export_name = "lab_general_test";
				$act_table = "lab_general_tests";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Gender", "Requested Doctor old", "Req_Doctor", "Patient_Type", "Patient Type Sub", "Dangue RDT", "NS1 Antigen", "IgG Result", "IgM Result", "Malaria RDT", "Malaria RDT Result", "Malaria_spec", "Malaria_grade", "Malaria_stage", "malaria_microscopy", "Malaria Microscopy Result", "RBS test", "RBS", "FBS test", "FBS", "haemo_done", "haemoglobin", "hba1c", "Lab Tech"];
				$date_type = ["vdate", "Issue Date"];
				break;
			case "stool":
				$table_name = "LabStoolTest";
				$export_name = "lab_stool_test";
				$act_table = "lab_stool_tests";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Gender", "Req_Doctor", "Patient_Type", "Patient Type Sub", "Clinic", "st_stool", "st_colour", "wbc_pus_cell", "st_consistency", "st_rbcs", "st_other", "st_comment", "st_lab_tech"];

				$date_type = ["vdate", "st_issue_date"];
				break;
			case "afb":
				$table_name = "LabAfbTest";
				$export_name = "lab_afb_test";
				$act_table = "lab_afb_tests";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Final_Result", "Gender", "Req_Doctor", "Patient_Type", "Patient Type Sub", "afb_pt_name", "afb_pt_address", "Previous_TB", "HIV_status", "reason_for_exam", "afb_Pt_type", "follow_up_mt", "speci_type", "oth_spe_ty", "slide_num_1", "slide_num_2", "visual_app_1", "afb_result1", "slide1_grading1", "visual_app_2", "afb_result2", "slide2_grading2", "afb_lab_techca"];
				$date_type = ["vdate", "speci_receive_dt1", "speci_receive_dt2", "afb_issue_date"];
				break;
			case "covid19":
				$table_name = "LabCovidTest";
				$export_name = "lab_covid_test";
				$act_table = "lab_covid_tests";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Gender", "Req_Doctor", "Patient_Type", "Patient Type Sub", "co_Age", "type_of_patient_covid", "specimen_type", "co_test_type", "covid_result", "covid_lab_tech"];
				$date_type = ["vdate", "covid_issue_date"];
				break;
			case "viral":
				$table_name = "Viralload";
				$export_name = "lab_viralload_test";
				$act_table = "viralloads";
				$encrypted_columns = ["Main Risk", "Sub Risk", "Gender", "Patient_Type", "Patient Type Sub", "Req_Doctor", "Sample Sent to", "Viral Load Result", "Other org code", "Detect"];

				$date_type = ["Sample_Ship_Date", "vdate", "Result received date", "ART_ini_date", "ART_duration"];
				break;
		}
		if ($table_name != null && $export_name != null && $act_table != null) {
			$modelClassName = "App\\Models\\" . $table_name; // extend model
			$model = app()->make($modelClassName); // resolves the model from the service container.
			foreach ($request["clinics"] as $clinic) {
				$model->setConnection($this->DB[$clinic]);
				$lab_data = $model
					->whereBetween($act_table . ".vdate", [$request["From_date"], $request["To_date"]])
					->leftJoin("patients", "patients.Pid", "=", $act_table . "." . $target_id)
					->select($act_table . ".*", "Date of Birth", "patients.Agey", "patients.Agem", "patients.Gender", "patients.FuchiaID", "patients.Pid", "patients.Main Risk", "patients.Sub Risk", $act_table . ".created_at", $act_table . ".updated_at", 'Risk log', 'Former Risk', 'Risk Change_Date')
					->get();
				$users = $users->merge($lab_data);
			}

			foreach ($users as $key => $user) {
				if ($user["Date of Birth"] != null) {
					$user = Export_age::Export_general($user, $user["vdate"], $user["Date of Birth"], $user);
				}
				$carbonDate = Carbon::createFromFormat('Y-m-d', $user['vdate']);
				$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
				$vdate = new DateTime($carbonDate);
				if ($user["Risk Log"] != null) {
					dd("hello is me");
					$forRiskCheck[1]['Pid'] = $user['Pid'];
					$forRiskCheck[1]['Risk Log'] = $user['Risk Log'];
					if (!array_key_exists($user['Pid'], $this->final_log)) {
						$this->final_risklog = RefillRisk::FillRisk($forRiskCheck);
						$this->final_log[$user['Pid']] = $this->final_risklog;
					}
					if (array_key_exists($user['Pid'], $this->final_log)) {
						foreach (array_reverse($this->final_log[$user['Pid']][$user['Pid']]) as $date => $data) {

							if (strlen($date) == 10) {
								$riskChangeDate = new DateTime($date);
								if ($vdate < $riskChangeDate) {
									$user['Main Risk'] = Crypt::encrypt_light($data['Old Risk'], 'General');
									$user['Sub Risk'] = Crypt::encrypt_light($data['Old Sub Risk'], 'General');
								}
							}
						}
					}
				} elseif ($user['Risk Change_Date'] != null && $user['Former Risk'] != null && $user['Former Risk'] != "731") {
					$riskChangeDate = Carbon::createFromFormat('Y-m-d', $user['Risk Change_Date']);
					$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
					if ($vdate < $riskChangeDate) {
						$user['Main Risk'] = $user['Former Risk'];
						$user['Sub Risk'] = '';
					}
				}
				if ($request["other"] == "hep_bc" || $request["other"] == "afb") {
					$labresult = app()->make("App\\Models\\Lab")->setConnection($user->getConnectionName())->where("CID", $user["CID"])
						->latest("vdate")
						->select("Final_Result", "Unigold_Result", "vdate")->first();
					if ($labresult) {
						$user["Final_Result"] = $labresult["Final_Result"];
						$user["Unigold_Result"] = $labresult["Unigold_Result"];
						$user["lab_vdate"] = $labresult["vdate"];
					} else {
						$user["Final_Result"] = null;
						$user["Unigold_Result"] = null;
					}
				}

				foreach ($date_type as $column) {
					$dateString = $user[$column];
					if (!empty($dateString)) {
						$carbonDate = Carbon::createFromFormat("Y-m-d", $dateString);
						$ddString = $carbonDate->format("d-m-Y");

						$carbonDate = Carbon::createFromFormat("d-m-Y", $ddString); // Assuming you have a Carbon instance
						$user[$column] = Date::dateTimeToExcel($carbonDate->startOfDay()); // Convert to Excel-compatible date
					}
				}
				foreach ($encrypted_columns as $column) {
					$user[$column] = Crypt::decrypt_light($user[$column], "General");
					if (($column == "Main Risk" || $column == "Sub Risk") && $user[$column] == "-") {
						$user[$column] = null;
					}
					$user[$column] = Crypt::codeBook($user[$column], "encode");

					if ($request["other"] == "hep_bc" || $request["other"] == "afb") {
						if ($column == "Final_Result") {
							if ($user[$column] != 24 && $user[$column] != 25) {
								$user[$column] = "unknown";
							}
						}
					}
				}
			}
			//dd($request["other"]);
			return Excel::download(new LabExport($users, $request["other"]), $request["other"] . "-" . date("d-m-Y") . "." . $request["typeExport"]);
		} else {
			abort(404);
		}
	}

	public function Counselling_Export($request)
	{
		$table_name = null;
		$act_table = null;
		$counselling_records = collect([]);
		switch ($request["other"]) {
			case "counsel_data":
				$act_table = "counsellor_records";
				$table_name = "CounsellorRecords";
				$export_name = "Counselling_Export";
				$encryptes = ["Counsellor", "Main Risk", "Sub Risk", "HTSdone", "Reason", "Status", "PrEP Status", "Gender"];
				$date_type = ["Counselling_Date", "Reg Date"];
				break;
			case "hts_data":
				$act_table = "coulsellings";
				$table_name = "Coulselling";
				$export_name = "HTS_Export";
				$encryptes = ["Gender", "Counsellor", "Service_Modality", "Mode of Entry", "New_Old", "Test_Location", "Main Risk", "Sub Risk", "HIV_Test_Determine", "HIV_Test_UNI", "HIV_Test_STAT", "HIV_Final_Result", "Syphillis_RDT", "Syphillis_RPR", "Syphillis_VDRL", "Hepatitis_B", "Hepatitis_C", "Req_Doctor"];
				$date_type = ["Counselling_Date", "HIV_Test_Date", "Syp_Test_Date", "Hep_Test_Date"];
				break;
		}

		if ($table_name != null && $act_table != null) {
			$modelClassName = "App\\Models\\" . $table_name; // extend model
			$model = app()->make($modelClassName); // resolves the model from the service container.
			foreach ($request["clinics"] as $clinic) {
				$model->setConnection($this->DB[$clinic]);
				$counselling_data = $model
					->whereBetween("Counselling_Date", [$request["From_date"], $request["To_date"]])
					->leftJoin("patients", "patients.Pid", "=", $act_table . ".Pid")
					->when($request["other"] == "hts_data", function ($query) use ($act_table) {
						return $query->leftJoin("labs", function ($join) use ($act_table) {
							$join->on("labs.CID", "=", $act_table . ".Pid")
								->whereColumn("labs.vdate", "=", "Counselling_Date");
						});
					})
					->select($act_table . ".*", "Date of Birth", "patients.Agey", "patients.Agem", "patients.Gender", "patients.FuchiaID", $act_table . ".Pid", "Risk Log", "Former Risk", "Risk Change_Date", "patients.Main Risk", "patients.Sub Risk", $act_table . ".created_at", $act_table . ".updated_at")
					->when($request["other"] == "hts_data", function ($query) {
						return $query->addSelect("labs.Req_Doctor");
					})
					->get();
				$counselling_records = $counselling_records->merge($counselling_data);
			}
		} else {
			abort(404);
		}
		foreach ($counselling_records as $key => $counselling_record) {
			if ($counselling_record["Date of Birth"] != null) {
				$counselling_record = Export_age::Export_general($counselling_record, $counselling_record["Counselling_Date"], $counselling_record["Date of Birth"], $counselling_record);
			}
			$carbonDate = Carbon::createFromFormat('Y-m-d', $counselling_record['Counselling_Date']);
			$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
			$vdate = new DateTime($carbonDate);
			if ($counselling_record["Risk Log"] != null) {
				$forRiskCheck[1]['Pid'] = $counselling_record['Pid'];
				$forRiskCheck[1]['Risk Log'] = $counselling_record['Risk Log'];
				if (!array_key_exists($counselling_record['Pid'], $this->final_log) && $counselling_record['Risk Log'] != null) {
					$this->final_risklog = RefillRisk::FillRisk($forRiskCheck);
					$this->final_log[$counselling_record['Pid']] = $this->final_risklog;
				}
				if (array_key_exists($counselling_record['Pid'], $this->final_log)) {
					foreach (array_reverse($this->final_log[$counselling_record['Pid']][$counselling_record['Pid']]) as $date => $data) {
						if (strlen($date) == 10) {
							$riskChangeDate = new DateTime($date);
							if ($vdate < $riskChangeDate) {
								$counselling_record['Main Risk'] = Crypt::encrypt_light($data['Old Risk'], 'General');
								$counselling_record['Sub Risk'] = Crypt::encrypt_light($data['Old Sub Risk'], 'General');
							}
						}
					}
				}
			} elseif ($counselling_record['Risk Change_Date'] != null && $counselling_record['Former Risk'] != null && $counselling_record['Former Risk'] != "731") {
				$riskChangeDate = Carbon::createFromFormat('Y-m-d', $counselling_record['Risk Change_Date']);
				$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
				if ($vdate < $riskChangeDate) {
					$counselling_record['Main Risk'] = $counselling_record['Former Risk'];
					$counselling_record['Sub Risk'] = '';
				}
			}

			foreach ($encryptes as $key => $encrypte) {
				$counselling_record[$encrypte] = Crypt::decrypt_light($counselling_record[$encrypte], "General");
				if (($encrypte == "Main Risk" || $encrypte == "Sub Risk") && $counselling_record[$encrypte] == "-") {
					$counselling_record[$encrypte] = null;
				}
				$counselling_record[$encrypte] = Crypt::codeBook($counselling_record[$encrypte], "encode");
			}
			foreach ($date_type as $column) {
				$dateString = $counselling_record[$column];
				if (!empty($dateString)) {
					$carbonDate = Carbon::createFromFormat("Y-m-d", $dateString);
					$ddString = $carbonDate->format("d-m-Y");

					$carbonDate = Carbon::createFromFormat("d-m-Y", $ddString); // Assuming you have a Carbon instance
					$counselling_record[$column] = Date::dateTimeToExcel($carbonDate->startOfDay()); // Convert to Excel-compatible date
				}
			}
		}

		return Excel::download(new CounsellingExport($counselling_records, $export_name), $export_name . "-" . date("d-m-Y") . "." . $request["typeExport"]);
	}

	public function STI_Export($request)
	{
		$table_name = null;
		$act_table = null;
		$sti_values = collect([]);

		switch ($request["other"]) {
			case "Male":
				$table_name = "Stimale";
				$act_table = "stimales";
				$encrypted_columns = [
					"Gender",
					"last_vis_within",
					"about_clinic",
					"demo_remarks",
					"visit_type",
					"visit_time",
					"followup_visit",
					"episode",
					"Reason for Visit",
					"Main Risk",
					"Sub Risk",
					"urethral_disc",
					"urethral_disc_hl",
					"dysuria",
					"dysuria_hl",
					"genital_prut",
					"genital_prut_hl",
					"genital_pain",
					"genital_pain_hl",
					"genital_ulcer",
					"genital_ulcer_hl",
					"pain",
					"ulcer",
					"prodromal_itch",
					"vesicles",
					"recurrent",
					"last_episode",
					"suspects_herpes",
					"ing_lymph_node",
					"ing_lymph_node_hl",
					"unilateal",
					"leg_ulcer",
					"scrotal_swelling",
					"scrotal_swelling_hl",
					"td_ntd",
					"gen_wart",
					"gen_wart_hl",
					"physical_exam",
					"urinated_wit_1h",
					"discharge",
					"discharge_milk",
					"colour",
					"erythema",
					"blisters",
					"gen_ulcer",
					"esti_size",
					"sing_multi",
					"pain_full_less",
					"herpes_suspect",
					"inguinal_bubo",
					"fluctant",
					"tendr_ntender",
					"oth_leg_inf",
					"phy_genital_wart",
					"crab_lice",
					"scabies",
					"gscrotal_swelling",
					"estimated_siz",
					"unilateal_bilateral",
					"gtender_ntender",
					"erythem",
					"des_size",
					"tbl_treat_diagnosis_first_visit",
					"epi_discharge",
					"unprot_sex_new_part",
					"genital_signs",
					"pri_syphillis",
					"sec_syphillis",
					"chancroid",
					"gen_herpes",
					"gen_scabies",
					"gud_other",
					"Gonorhoea",
					"non_gono_urethritis",
					"non_gono_procti",
					"trichomonas",
					"genital_candidiosis",
					"beterial_vaginosis",
					"congenial_syphillis",
					"latent_syphillis",
					"molluscum_contag",
					"bubos",
					"othstd_genital_warts",
					"ostd_other",
					"tre_azythro",
					"tre_cefixim",
					"tre_ciprofloxacin",
					"tre_tinidazole",
					"tre_fluconazole",
					"tre_doxycycline",
					"tre_ceftriaxone",
					"tre_benz_pen",
					"no_treat",
					"al_Penicillin",
					"al_sulfa",
					"part_treat",
					"condom_giv",
				];
				$encrypted_38 = ["presumptive_diag", "tre_remarks", "followup", "clinician_name"];
				break;
			case "Female":
				$table_name = "Stifemale";
				$act_table = "stifemales";
				$encrypted_columns = [
					"Gender",
					"last_vis_within",
					"vtype",
					"about_clinic",
					"demo_remarks",
					"episode",
					"rea_for_visit",
					"Main Risk",
					"Sub Risk",
					"abn_vaginal_disc",
					"abn_vaginal_disc_long",
					"linked_menstru",
					"amount",
					"colour",
					"colour_oth",
					"abn_veginal_odour",
					"l_abn_pain",
					"l_abon_pain_hl",
					"fever",
					"rec_terminate_preg",
					"dyspareunia",
					"dysuria",
					"dysuria_hl",
					"gen_prutitus",
					"gen_prutitus_hl",
					"gen_burn_pain",
					"gen_burn_pain_hl",
					"gen_ulcer",
					"gen_ulcer_hl",
					"pain",
					"ulcer",
					"prodromal_itch",
					"vesicles",
					"recurrent",
					"recurrent_last_episode",
					"patient_suspects_herpes",
					"inguinal_ln",
					"inguinal_ln_hl",
					"unilateal_Bilateral",
					"leg_ulcer_oth_inf",
					"genital_warts",
					"genital_warts_hl",
					"phy_exam_done",
					"washed_inside",
					"vulvar_erythema",
					"vulvar_odema",
					"vaginal_discharge",
					"vag_dis_amount",
					"homogeneous",
					"homogeneous_col",
					"smell_without_KOH",
					"vaginal_wall_injury",
					"adnexal_tenderness",
					"adnexal_enlargement",
					"genital_blisters",
					"gential_ulcer",
					"gential_ulcerl",
					"gent_ulcer_sm",
					"gential_ulcer_pain",
					"susp_herpes",
					"inguinal_bubo",
					"fluctuant",
					"fluctuant_tender",
					"oth_leg_infection",
					//ok
					"genital_wart",
					"crab_lice",
					"scablices",
					"KOH_smell_test",
					"pH_vagina",
					"prev_STI",
					"patient_genital_ulcer",
					"patient_compl_low_abd",
					"new_pat_past_3mont",
					"part_compl_gential_sym",
					"sworker",
					"rg_score",
					"risk",
					//ok
					"abn_yellow_disc",
					"dysuria_risk_ass",
					"low_abd_pain",
					"pain_dur_sexual",
					"unp_sex_new_clients",
					"partner_ulcer",

					"pri_syphillis",
					"sec_syphillis",
					"chancroid",
					"gen_herpes",
					"gen_scabies",
					"gud_other",
					"other_plz_specify",
					"Gonorhoea",
					"non_gono_urethritis",
					"non_gono_cervities",
					"trichomonas",
					//ok
					"genital_candidiosis",
					"beterial_vaginosis",
					"congenial_syphillis",
					"latent_syphillis",
					"latent_syphillis_preg",
					"molluscum_contag",
					"bubos",
					"othstd_genital_warts",
					"ostd_other",
					"tre_azythro",
					"tre_cefixim",
					"tre_ciprofloxacin",
					"tre_tinidazole",
					"tre_fluconazole",
					"tre_doxycycline",
					"tre_ceftriaxone",
					"tre_benz_pen",
					"tre_Other",
					"clotrimazole_vaginal_tab",
					"no_treatment",
					"al_Penicillin",
					"al_sulfa",
					"part_treat",
					"condom_giv",
					"first_visit",
					"other_STD",
				];
				$encrypted_38 = ["oth_GI_sympt", "genital_blisters_Location", "des_size", "risk_cal_remark", "presumptive_diag", "tre_remarks", "followup", "clinician"];
				break;
		}
		if ($table_name != null && $act_table != null) {
			$modelClassName = "App\\Models\\" . $table_name; // extend model
			$model = app()->make($modelClassName); // resolves the model from the service container.
			foreach ($request["clinics"] as $clinic) {
				$model->setConnection($this->DB[$clinic]);
				$sti_values_data = $model
					->whereBetween("Visit_date", [$request["From_date"], $request["To_date"]])
					->leftJoin("patients", "patients.Pid", "=", $act_table . ".CID")
					->select($act_table . ".*", "Date of Birth", "patients.Agey", "patients.Agem", "patients.Gender", "patients.FuchiaID", "patients.Pid", "Risk Log", "Former Risk", "Risk Change_Date", "patients.Main Risk", "patients.Sub Risk", $act_table . ".created_at", $act_table . ".updated_at")
					->get();
				$sti_values = $sti_values->merge($sti_values_data);
			}
		} else {
			dd("ok null");
			abort(404);
		}
		foreach ($sti_values as $key => $sit_value) {
			$carbonDate = Carbon::createFromFormat('Y-m-d', $sit_value['Visit_date']);
			$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
			$vdate = new DateTime($carbonDate);
			$sti_value['Pid'] = $sit_value['CID'];

			$sit_value = Export_age::Export_general($sit_value, $sit_value["Visit_date"], $sit_value["Date of Birth"], $sit_value);

			if ($sit_value["Date of Birth"] != null) {
				$modelClassName = "App\\Models\\Patients";
				$model->setConnection($this->Extra_DB($sit_value["Clinic Code"]));
				$model = app()->make($modelClassName);
				$extraPatient = $model->where('Pid', $sti_value['Pid'])
					->select("Date of Birth", "Agey", "Agem", "Gender", "FuchiaID", "Pid", "Risk Log", "Former Risk", "Risk Change_Date", "Main Risk", "Sub Risk")->first();

				if ($extraPatient) {
					$sti_value['Date of Birth'] = $extraPatient["Date of Birth"];
					$sti_value['Agey'] = $extraPatient["Agey"];
					$sti_value['Agem'] = $extraPatient["Agem"];
					$sti_value['FuchiaID'] = $extraPatient["FuchiaID"];
					$sti_value['Risk Log'] = $extraPatient["Risk Log"];
					$sti_value['Former Risk'] = $extraPatient["Former Risk"];
					$sti_value['Risk Change_Date'] = $extraPatient["Risk Change_Date"];
					$sti_value['Main Risk'] = $extraPatient["Main Risk"];
					$sti_value['Sub Risk'] = $extraPatient["Sub Risk"];
					$sit_value = Export_age::Export_general($sit_value, $sit_value["Visit_date"], $sit_value["Date of Birth"], $sit_value);
				}
			}

			if ($sit_value["Risk Log"] != null) {
				$forRiskCheck[1]['Pid'] = $sit_value['CID'];
				$forRiskCheck[1]['Risk Log'] = $sit_value['Risk Log'];
				if (!array_key_exists($sit_value['CID'], $this->final_log) && $sit_value['Risk Log'] != null) {
					$this->final_risklog = RefillRisk::FillRisk($forRiskCheck);
					$this->final_log[$sit_value['CID']] = $this->final_risklog;
				}
				if (array_key_exists($sit_value['CID'], $this->final_log)) {
					foreach (array_reverse($this->final_log[$sit_value['CID']][$sit_value['CID']]) as $date => $data) {
						if (strlen($date) == 10) {
							$riskChangeDate = new DateTime($date);
							if ($vdate < $riskChangeDate) {
								$sit_value['Main Risk'] = Crypt::encrypt_light($data['Old Risk'], 'General');
								$sit_value['Sub Risk'] = Crypt::encrypt_light($data['Old Sub Risk'], 'General');
							}
						}
					}
				}
			} elseif ($sit_value['Risk Change_Date'] != null && $sit_value['Former Risk'] != null && $sit_value['Former Risk'] != "731") {
				$riskChangeDate = Carbon::createFromFormat('Y-m-d', $sit_value['Risk Change_Date']);
				$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
				if ($vdate < $riskChangeDate) {
					$sit_value['Main Risk'] = $sit_value['Former Risk'];
					$sit_value['Sub Risk'] = '';
				}
			}

			foreach ($encrypted_columns as $key => $encrypte) {
				$sit_value[$encrypte] = Crypt::decrypt_light($sit_value[$encrypte], "General");
				if (($encrypte == "Main Risk" || $encrypte == "Sub Risk") && $sit_value[$encrypte] == "-") {
					$sit_value[$encrypte] = null;
				}
				$sit_value[$encrypte] = Crypt::codeBook($sit_value[$encrypte], "encode");
			}
			foreach ($encrypted_38 as $column) {
				$sit_value[$column] = Crypt::decryptString($sit_value[$column], "General");
			}
			$carbonDate = Carbon::createFromFormat("Y-m-d", $sit_value["Visit_date"]);
			$carbonDate = Carbon::createFromFormat("d-m-Y", $carbonDate->format("d-m-Y"));
			$sit_value["Visit_date"] = Date::dateTimeToExcel($carbonDate->startOfDay());
		}
		dd('hello is me');
		return Excel::download(new STIExport($sti_values, $request["other"]), "STI_" . $request["other"] . "-" . date("d-m-Y") . "." . $request["typeExport"]);
	}

	public function Prevention_Export($request)
	{
		$table_name = null;
		$act_table = null;
		$export_name = null;
		$prevention_values = collect([]);
		switch ($request["other"]) {
			case "log_sheet":
				$table_name = "PreventionLogsheet";
				$act_table = "prevention_logsheets";
				$export_name = "LogSheet";
				$encrypted_columns = ["Main_Risk", "Sub_Risk", "HIV Status", "Initial Risk", "Changed_Risk", "HIV_Final_result", "Gender"];
				$prevent_dates = ["date_confirm", "Reg_Date", "Visit_Date", "Risk changed Date", "OST_Initial_Date"];
				break;
			case "cbs":
				$table_name = "PreventionCBS";
				$act_table = "prevention_c_b_s";
				$export_name = "CBS";
				$encrypted_columns = [
					"Main_Risk",
					"Sub_Risk",
					"HIV_determine_result",
					"HIV result",
					"HIV Sero-Status",
					"Gender", // decrypt
				];
				$prevent_dates = ["Visit_Date", "date_confirm"];
				break;
			case "confidential":
				$table_name = "Patients";
				$act_table = "patients";
				$export_name = "Server_Confidential";
				$encrypted_columns = [
					"Main Risk",
					"Sub Risk",
					"Gender",
					"Former Risk", // decrypt
				];
				$prevent_dates = ["Reg Date", "Risk Change_Date"];
				break;
		}
		if ($table_name != null && $act_table != null) {
			$modelClassName = "App\\Models\\" . $table_name; // extend model
			$model = app()->make($modelClassName); // resolves the model from the service container.
			foreach ($request["clinics"] as $clinic) {
				$model->setConnection($this->DB[$clinic]);
				switch ($request["other"]) {
					case 'log_sheet':
					case 'cbs':
						$prevention_values_data = $model
							->whereBetween("Visit_Date", [$request["From_date"], $request["To_date"]])
							->leftJoin("patients", "patients.Pid", "=", $act_table . ".Pid")
							->select(
								$act_table . ".*",
								"Date of Birth",
								"patients.Agey",
								"patients.Agem",
								"patients.Gender",
								"patients.FuchiaID",
								"patients.PrEPCode",
								"patients.Main Risk",
								"patients.Sub Risk",
								"patients.Risk Log",
								"patients.Former Risk",
								"patients.Risk Change_Date",
								$act_table . ".created_at",
								$act_table . ".updated_at"
							)
							->get();
						break;
					case 'confidential':
						$prevention_values_data = $model->whereBetween("Reg Date", [$request["From_date"], $request["To_date"]])->get();
						break;
				}
				$prevention_values = $prevention_values->merge($prevention_values_data);
			}
		} else {
			abort(404);
		}

		foreach ($prevention_values as $key => $prevention_value) {
			if ($prevention_value["Date of Birth"] != null) {
				$prevention_value = Export_age::Export_general($prevention_value, $prevention_value["Visit_Date"], $prevention_value["Date of Birth"], $prevention_value);
			} else {
				$prevention_value['He Code'] = null;
				$prevention_value['Clinic Code'] = null;
				$prevention_value['PrEPCode'] = null;
			}
			if ($request["other"] != "confidential") {
				$carbonDate = Carbon::createFromFormat('Y-m-d', $prevention_value['Visit_Date']);
				$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
				$vdate = new DateTime($carbonDate);
				if ($prevention_value["Risk Log"] != null) {
					$forRiskCheck[1]['Pid'] = $prevention_value['Pid'];
					$forRiskCheck[1]['Risk Log'] = $prevention_value['Risk Log'];
					if (!array_key_exists($prevention_value['Pid'], $this->final_log) && $prevention_value['Risk Log'] != null) {
						$this->final_risklog = RefillRisk::FillRisk($forRiskCheck);
						$this->final_log[$prevention_value['Pid']] = $this->final_risklog;
					}
					if (array_key_exists($prevention_value['Pid'], $this->final_log)) {
						foreach (array_reverse($this->final_log[$prevention_value['Pid']][$prevention_value['Pid']]) as $date => $data) {
							if (strlen($date) == 10) {
								$riskChangeDate = new DateTime($date);
								if ($vdate < $riskChangeDate) {
									$prevention_value['Main Risk'] = Crypt::encrypt_light($data['Old Risk'], 'General');
									$prevention_value['Sub Risk'] = Crypt::encrypt_light($data['Old Sub Risk'], 'General');
								}
							}
						}
					}
				} elseif ($prevention_value['Risk Change_Date'] != null && $prevention_value['Former Risk'] != null && $prevention_value['Former Risk'] != "731") {
					$riskChangeDate = Carbon::createFromFormat('Y-m-d', $prevention_value['Risk Change_Date']);
					$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
					if ($vdate < $riskChangeDate) {
						$prevention_value['Main Risk'] = $prevention_value['Former Risk'];
						$prevention_value['Sub Risk'] = '';
					}
				}
				if ($request["other"] == "log_sheet") {
					$visit_year = explode('-', $prevention_value["Visit_Date"])[0];
					$model->setConnection($prevention_value->getConnectionName());
					$final_new_old = $model->whereYear('Visit_Date', $visit_year)
						->where("Pid", $prevention_value["Pid"])
						->where('Visit_Date', '<', $prevention_value["Visit_Date"])->exists();
					if ($final_new_old) {
						$prevention_value["New_Old"] = "Old";
					} else {
						$prevention_value["New_Old"] = "New";
					}
				}
			}



			foreach ($encrypted_columns as $key => $encrypte) {
				$prevention_value[$encrypte] = Crypt::decrypt_light($prevention_value[$encrypte], "General");
				if (($encrypte == "Main Risk" || $encrypte == "Sub Risk") && $prevention_value[$encrypte] == "-") {
					$prevention_value[$encrypte] = null;
				}
				$prevention_value[$encrypte] = Crypt::codeBook($prevention_value[$encrypte], "encode");
			}
			// if ($request["other"]=="confidential") {
			// 	$prevention_value["Date of Birth"] =Crypt::DecryptString($prevention_value["Date of Birth"]);
			// 	$time=strtotime($prevention_value["Date of Birth"]);
			// 	$prevention_value["Date of Birth"]=date('Y-m-d',$time);
			// }
			foreach ($prevent_dates as $column) {
				if ($prevention_value[$column] != null) {
					$carbonDate = Carbon::createFromFormat("Y-m-d", $prevention_value[$column]);
					$carbonDate = Carbon::createFromFormat("d-m-Y", $carbonDate->format("d-m-Y"));
					$prevention_value[$column] = Date::dateTimeToExcel($carbonDate->startOfDay());
				}
			}
		}
		//dd($prevention_values[0]);

		return Excel::download(new PreventionExport($prevention_values, $export_name), $export_name . "-" . date("d-m-Y") . "." . $request["typeExport"]);
	}

	public function Cervical_Export($request)
	{
		$cervical_values = collect([]);
		$cervical_dates = ["Visit_date", "LMP", "UCG_test_date", "Postpone_date", "Date", "Followup_date", "AE_Date", "AE_followUp_Date"];
		$modelClassName = "App\\Models\\Cervicalcancer"; // extend model
		$model = app()->make($modelClassName); // resolves the model from the service container.
		foreach ($request["clinics"] as $clinic) {
			$model->setConnection($this->DB[$clinic]);
			$cervical_values_data = $model
				->whereBetween("Visit_date", [$request["From_date"], $request["To_date"]])
				->leftJoin("patients", "patients.Pid", "=", "cervicalcancers.General ID")
				->select(
					"cervicalcancers.*",
					"Date of Birth",
					"patients.Agey",
					"patients.Agem",
					"patients.Gender",
					"patients.FuchiaID",
					"patients.Pid",
					"patients.Main Risk",
					"patients.Sub Risk",
					"cervicalcancers.created_at",
					"cervicalcancers.updated_at",
					"patients.Risk Log",
					"patients.Former Risk",
					"patients.Risk Change_Date"
				)
				->get();
			$cervical_values = $cervical_values->merge($cervical_values_data);
		}

		foreach ($cervical_values as $key => $cervical_value) {
			if ($cervical_value["Date of Birth"] != null) {
				$cervical_value = Export_age::Export_general($cervical_value, $cervical_value["Visit_date"], $cervical_value["Date of Birth"], $cervical_value);
			}
			foreach ($cervical_dates as $cervical_date) {
				if ($cervical_value[$cervical_date] != null) {
					$carbonDate = Carbon::createFromFormat("Y-m-d", $cervical_value[$cervical_date]);
					$carbonDate = Carbon::createFromFormat("d-m-Y", $carbonDate->format("d-m-Y"));
					$cervical_value[$cervical_date] = Date::dateTimeToExcel($carbonDate->startOfDay());
				}
			}
		}
		return Excel::download(new CervicalExport($cervical_values), "Cervical_CancerExport-" . date("d-m-Y") . "." . $request["typeExport"]);
	}

	public function CMV_Export($request)
	{
		$cmv_values = collect([]);
		$cmv_dates = ["Visit_date", "Art_StartDate", "Recent_CD4Date"];
		$encryptes = ["Art_Status", "Currnt_Art_Regime", "Most_CD4", "Gender"];
		$modelClassName = "App\\Models\\cmv"; // extend model
		$model = app()->make($modelClassName); // resolves the model from the service container.
		foreach ($request["clinics"] as $clinic) {
			$model->setConnection($this->DB[$clinic]);
			$cmv_values_data = $model
				->whereBetween("Visit_date", [$request["From_date"], $request["To_date"]])
				->leftJoin("patients", "patients.Pid", "=", "cmvs.Pid_cmv")
				->select("cmvs.*", "Date of Birth", "patients.Agey", "patients.Agem", "patients.Gender", "patients.FuchiaID", "patients.Pid", "patients.Main Risk", "patients.Sub Risk")
				->get();
			$cmv_values = $cmv_values->merge($cmv_values_data);
		}
		foreach ($cmv_values as $key => $cmv_value) {
			if ($cmv_value["Date of Birth"] != null) {
				$cmv_value = Export_age::Export_general($cmv_value, $cmv_value["Visit_date"], $cmv_value["Date of Birth"], $cmv_value);
			}
			foreach ($cmv_dates as $cmv_date) {
				if ($cmv_value[$cmv_date] != null) {
					$carbonDate = Carbon::createFromFormat("Y-m-d", $cmv_value[$cmv_date]);
					$carbonDate = Carbon::createFromFormat("d-m-Y", $carbonDate->format("d-m-Y"));
					$cmv_value[$cmv_date] = Date::dateTimeToExcel($carbonDate->startOfDay());
				}
			}
			foreach ($encryptes as $encrypte) {
				$cmv_value[$encrypte] = Crypt::decrypt_light($cmv_value[$encrypte], "General");
				$cmv_value[$encrypte] = Crypt::codeBook($cmv_value[$encrypte], "encode");
			}
		}
		return Excel::download(new CMVExport($cmv_values), "CMV_Export-" . date("d-m-Y") . "." . $request["typeExport"]);
	}

	public function NCD_Export($request)
	{
		$table_name = null;
		$act_table = null;
		$test_date = null;
		$ncd_values = collect([]);
		switch ($request["other"]) {
			case "Register":
				$table_name = "ncd_pt_register";
				$act_table = "ncd_pt_registers";
				$test_date = "Reg_Date";
				$encrypted_columns = ["Gender"];
				$ncd_dates = ["Reg_Date", "1stBP_date", "1st_DiagDate", "1st_RBS_date", "2ndBP_date", "2nd_DiagDate", "2nd_RBS_date", "3rdBP_date", "death_date"];
				break;
			case "Follow_Up":
				$table_name = "ncdFollowup";
				$act_table = "ncd_followups";
				$test_date = "Visit_date";
				$encrypted_columns = ["Gender"];
				$ncd_dates = ["Visit_date", "Next_Appointment", "FBS_test_date", "2HPP_test_date", "Lab_res_Date", "death_date", "Reg_Date"];
				break;
		}
		if ($table_name != null && $act_table != null) {
			$modelClassName = "App\\Models\\" . $table_name; // extend model
			$model = app()->make($modelClassName); // resolves the model from the service container.
			foreach ($request["clinics"] as $clinic) {
				$model->setConnection($this->DB[$clinic]);
				$ncd_values_data = $model
					->whereBetween($test_date, [$request["From_date"], $request["To_date"]])
					->leftJoin("patients", "patients.Pid", "=", $act_table . ".Pid")
					->when($request["other"] == "Follow_Up", function ($query) {
						return $query->leftJoin("ncd_pt_registers", "ncd_pt_registers.Pid", "=", "ncd_followups.Pid");
					})
					->select($act_table . ".*", "Date of Birth", "patients.Agey", "patients.Agem", "patients.Gender", "patients.FuchiaID", "patients.Main Risk", "patients.Sub Risk")
					->when($request["other"] == "Follow_Up", function ($query) {
						return $query->addSelect("ncd_pt_registers.visit_Age");
					})
					->get();
				$ncd_values = $ncd_values->merge($ncd_values_data);
			}
		} else {
			abort(404);
		}
		foreach ($ncd_values as $key => $ncd_value) {
			if ($ncd_value["Date of Birth"] != null) {
				$ncd_value = Export_age::Export_general($ncd_value, $ncd_value[$test_date], $ncd_value["Date of Birth"], $ncd_value);
			}
			foreach ($ncd_dates as $ncd_date) {
				if ($ncd_value[$ncd_date] !== null) {
					$carbonDate = Carbon::createFromFormat("Y-m-d", $ncd_value[$ncd_date]);
					$carbonDate = Carbon::createFromFormat("d-m-Y", $carbonDate->format("d-m-Y"));
					$ncd_value[$ncd_date] = Date::dateTimeToExcel($carbonDate->startOfDay());
				}
			}
			foreach ($encrypted_columns as $encrypte) {
				$ncd_value[$encrypte] = Crypt::decrypt_light($ncd_value[$encrypte], "General");
			}
		}
		return Excel::download(new NCDExport($ncd_values, $request["other"]), "NCD_" . $request["other"] . "-" . date("d-m-Y") . "." . $request["typeExport"]);
	}

	public function TB_Export($request)
	{
		$target_id = null;
		$table_name = null;
		$act_table = null;
		$export_name = null;
		$patient_vdate = null;
		$tb_values = collect([]);
		switch ($request["road"]) {
			case "8":
				$target_id = "Pid_TB03";
				$table_name = "tb_registerO3";
				$act_table = "tb_register_o3_s";
				$export_name = "TB03_Register";
				$patient_vdate = "TreDate_TB03";
				$date_values = [
					"TreDate_TB03",
					"ART_start_TB03",
					"CPT_start_TB03",
					"Intial_RegimenDate_TB03",
					"TrementOut_Date_TB03",
					"EstimentOut_Date_TB03"
				];
				break;
			case "9":
				$target_id = "Pid_preTB";
				$table_name = "preTB";
				$act_table = "pre_t_b_s";
				$export_name = "Pre_TB";
				$patient_vdate = "TBscreenDate_preTB";
				$date_values = [
					"VisitDate_preTB",
					"NextVDate_preTB",
					"TBscreenDate_preTB",
					"HTCDate_preTB",
					"AFBDate_preTB",
					"GeneXpertDate_preTB",
					"CXRDate_preTB"
				];
				break;
			case "10":
				$target_id = "Pid_iptTB";
				$table_name = "Tbipt";
				$act_table = "tbipts";
				$export_name = "IPT";
				$patient_vdate = "IPT_regDate";
				$date_values = ["IPT_regDate", "IPT_startDate", "IPT_disconDate"];
				break;
		}

		if ($table_name != null && $export_name != null && $act_table != null) {
			$encryptes = ["Main Risk", "Sub Risk", "Gender"];
			$modelClassName = "App\\Models\\" . $table_name; // extend model
			$model = app()->make($modelClassName); // resolves the model from the service container.
			foreach ($request["clinics"] as $clinic) {
				$model->setConnection($this->DB[$clinic]);
				$tb_values_data = $model
					->whereBetween($patient_vdate, [$request["From_date"], $request["To_date"]])
					->leftJoin("patients", "patients.Pid", "=", $act_table . '.' . $target_id)
					->select(
						$act_table . ".*",
						"Date of Birth",
						"patients.Agey",
						"patients.Agem",
						"patients.Gender",
						"patients.FuchiaID",
						"patients.Pid",
						"patients.Main Risk",
						"patients.Sub Risk"
					)
					->get();
				$tb_values = $tb_values->merge($tb_values_data);
			}

			foreach ($tb_values as $tb_value) {
				if ($tb_value["Date of Birth"] != null) {
					$tb_value = Export_age::Export_general($tb_value, $tb_value[$patient_vdate], $tb_value["Date of Birth"], $tb_value);
				}
				foreach ($encryptes as $key => $encrypte) {
					$tb_value[$encrypte] = Crypt::decrypt_light($tb_value[$encrypte], "General");
					if ($request["road"] == "8" && $encrypte == "Gender") {
						if ($tb_value[$encrypte] == "Male") {
							$tb_value[$encrypte] = "M";
						} else {
							$tb_value[$encrypte] = "F";
						}
					}
				}
				foreach ($date_values as $date_value) {
					if ($tb_value[$date_value] != null) {
						$carbonDate = Carbon::createFromFormat("Y-m-d", $tb_value[$date_value]);
						$carbonDate = Carbon::createFromFormat("d-m-Y", $carbonDate->format("d-m-Y"));
						$tb_value[$date_value] = Date::dateTimeToExcel($carbonDate->startOfDay());
					}
				}
			}
		}
		return Excel::download(new TBExport($tb_values, $export_name), $export_name . "-" . date("d-m-Y") . "." . $request["typeExport"]);
	}

	public function Extra_DB($data)
	{
		switch ($data) {
			case '71':
				return "MAM_A";
				break;
			case '72':
				return "MAM_B";
				break;
			case '73':
				return "MAM_SPT";
				break;
			case '74':
				return "MAM_TL";
				break;
			case '81':
				return "MAM_C2";
				break;
			case '83':
				return "MAM_C1";
				break;
			case '84':
				return "MAM_SDG";
				break;
			default:
				return false;
				break;
		}
	}
}
