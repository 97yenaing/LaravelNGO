<?php

namespace App\Http\Controllers;

use App\Exports\Export_age;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Illuminate\Support\Str;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MME_DashboardController extends Controller
{
	protected $DB = ["MAM_A", "MAM_C1", "MAM_C2", "MAM_B",];
	protected $table_code = "General";
	public function mme_dashboard_View()
	{
		return view(
			"MME.Dashboard.mneDiagnosisDashboard",
			["diagnosis_chart" => null, 'tb_chart' => null, 'hiv_chart' => null, 'prep_chart' => null, 'dashboardData' => null, 'inputData' => null]
		);
	}

	public function mme_dashboard_Calculate(Request $request)
	{
		$validator = $validator = Validator::make($request->all(), [
			"From_date" => "required|date",
			"To_date" => "required|date",
			"clinic_road" => [
				"required",
				function ($attribute, $value, $fail) {
					if (count($this->DB) < $value) {
						$fail("The clinic road is out of range.");
					}
				},
			],
		]);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$inputData["clinic_road"] = $request["clinic_road"];
		$inputData["From_date"] = $request["From_date"];
		$inputData["To_date"] = $request["To_date"];
		$inputData["dash_type"] = $request["dash_type"];

		$from_date = date("Y-m-d", strtotime($request["From_date"]));
		$to_date = date("Y-m-d", strtotime($request["To_date"]));

		if ($inputData["dash_type"] == "Diagnosis") {
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
			$dashboard_dataSet = array(
				"g_male" => 0, "g_female" => 0, "g_less" => 0, "g_over" => 0, "g_noAge" => 0, "pha" => 0, "art" => 0, "prep_new" => 0, "prep_old" => 0,
				"RTI<2wks" => 0, "RTI>=2" => 0, "ObstructiveDs" => 0, "RenalDs" => 0, "GI-Hepato" => 0, "SkinInfect" => 0, "Others" => 0, "Malnouri" => 0, "Child-Abuse" => 0, "Dengue-Fever" => 0,
				"TBHiv_pos" => 0, "TBHiv_neg" => 0, 'child_male' => 0, 'child_female' => 0, 'child' => 0, 'hiv_male' => 0, 'hiv_female' => 0, 'hiv_over' => 0, 'hiv_less' => 0, 'hiv_noAge' => 0,
				'prep_female' => 0, 'prep_over' => 0, 'prep_less' => 0, 'prep_noAge' => 0, 'prep_male' => 0, 'anc_female' => 0, 'anc_over' => 0, 'anc_less' => 0, 'anc_noAge' => 0, 'anc_male' => 0,
				'fp_female' => 0, 'fp_over' => 0, 'fp_less' => 0, 'fp_noAge' => 0, 'fp_male' => 0,
				'counselling_female' => 0, 'counselling_over' => 0, 'counselling_less' => 0, 'counselling_noAge' => 0, 'counselling_male' => 0,
				'tb_female' => 0, 'tb_over' => 0, 'tb_less' => 0, 'tb_noAge' => 0, 'tb_male' => 0,
			);

			$genral_diages = [
				"RTI<2wks", "RTI>=2", "ObstructiveDs", "RenalDs", "GI-Hepato", "SkinInfect", "Others", "Malnouri", "Child-Abuse", "Dengue-Fever",
			];
			$tb_chart = null;
			$hiv_chart = null;
			$prep_chart = null;
			$diagnosis_chart = null;

			$modelClassName = "App\\Models\\Followup_general"; // extend model
			$model = app()->make($modelClassName); // resolves the model from the service container.
			$model->setConnection($this->DB[$request["clinic_road"]]);
			$totalrow = 0;
			$reception_dashboard = $model
				->whereBetween("followup_generals.Visit Date", [$from_date, $to_date])
				->where("preCode", "!=", "1")
				->leftJoin("counsellor_records", function ($join) {
					$join->on("counsellor_records.Pid", "=", "followup_generals.Pid")
						->on("followup_generals.Visit Date", "=", "counsellor_records.Counselling_Date");
				})
				->leftJoin("tb_register_o3_s", function ($join) use ($from_date, $to_date) {
					$join->on("tb_register_o3_s.Pid_TB03", "=", "followup_generals.Pid")
						->whereBetween("tb_register_o3_s.TreDate_TB03", [$from_date, $to_date]);
				})
				->leftJoin("patients", "patients.Pid", "=", "followup_generals.Pid")
				->select(
					"followup_generals.*",
					"counsellor_records.Pid as cpid",
					"counsellor_records.Counselling_Date",
					"patients.Date of Birth as Date_of_Birth",
					"patients.Agey",
					"patients.Agem",
					"patients.Gender",
					"patients.FuchiaID",
					"patients.Pid",
					"patients.Main Risk as Main_Risk",
					"patients.Sub Risk as Sub_Risk",
					'PrEP',
					'PrEP Status',
					'Hivstatus_TB03',
					'Pid_TB03',
				)
				->get();


			foreach ($reception_dashboard as $index => $dashboard) {
				$counting = 0;
				$diagnosisArray = [];
				$diaString = $dashboard->Pateint_Diagnosis;


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

				$dashboard["diagnosis"] = $diagnosisArray;
				$dashboard["Gender"] = Crypt::decrypt_light($dashboard["Gender"], $this->table_code);

				if ($dashboard["Date_of_Birth"] != null) {
					$dashboard = Export_age::Export_general($dashboard, $dashboard["Visit Date"], $dashboard["Date_of_Birth"], $dashboard);
				} else {
					$dashboard["Current Agem"] = $dashboard["Current Agey"] = 404;
				}
				//dd($dashboard);
				if ($dashboard["Hivstatus_TB03"] == "P") {
					$dashboard_dataSet["TBHiv_pos"]++;
				} elseif ($dashboard["Hivstatus_TB03"] == "N") {
					$dashboard_dataSet["TBHiv_neg"]++;
				} // TB HIV

				if ($dashboard["Current Agey"] < 15 && $dashboard["Current Agey"] != 404) {
					$dashboard_dataSet["child"]++;
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["child_male"]++ : $dashboard_dataSet["child_female"]++;
				}
				//reception diagnosis
				if ($diagnosisArray["gneralcheck"] == "gneralcheck") {
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["g_male"]++ : $dashboard_dataSet["g_female"]++;
					$dashboard["Current Agey"] != 404 ? ($dashboard["Current Agey"] > 15 ? $dashboard_dataSet["g_over"]++ : $dashboard_dataSet["g_less"]++) : $dashboard_dataSet["g_noAge"]++;
				}

				if ($diagnosisArray["phacheck"] == "phacheck") {
					$dashboard_dataSet["pha"]++; //HIV
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["hiv_male"]++ : $dashboard_dataSet["hiv_female"]++;
					$dashboard["Current Agey"] != 404 ? ($dashboard["Current Agey"] > 15 ? $dashboard_dataSet["hiv_over"]++ : $dashboard_dataSet["hiv_less"]++) : $dashboard_dataSet["hiv_noAge"]++;
				}

				if ($diagnosisArray["artcheck"] == "artcheck") {
					$dashboard_dataSet["art"]++; //HIV
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["hiv_male"]++ : $dashboard_dataSet["hiv_female"]++;
					$dashboard["Current Agey"] != 404 ? ($dashboard["Current Agey"] > 15 ? $dashboard_dataSet["hiv_over"]++ : $dashboard_dataSet["hiv_less"]++) : $dashboard_dataSet["hiv_noAge"]++;
				}

				if ($diagnosisArray["prepcheck"] == "prepcheck") {
					$diagnosisArray["prep_new_old"] == "New" ? $dashboard_dataSet["prep_new"]++ : $dashboard_dataSet["prep_old"]++;
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["prep_male"]++ : $dashboard_dataSet["prep_female"]++;
					$dashboard["Current Agey"] != 404 ? ($dashboard["Current Agey"] > 15 ? $dashboard_dataSet["prep_over"]++ : $dashboard_dataSet["prep_less"]++) : $dashboard_dataSet["prep_noAge"]++;
				}

				if ($diagnosisArray["anccheck"] == "anccheck") {
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["anc_male"]++ : $dashboard_dataSet["anc_female"]++;
					$dashboard["Current Agey"] != 404 ? ($dashboard["Current Agey"] > 15 ? $dashboard_dataSet["anc_over"]++ : $dashboard_dataSet["anc_less"]++) : $dashboard_dataSet["anc_noAge"]++;
				}
				if ($diagnosisArray["fmaplancheck"] == "fmaplancheck") {
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["fp_male"]++ : $dashboard_dataSet["fp_female"]++;
					$dashboard["Current Agey"] != 404 ? ($dashboard["Current Agey"] > 15 ? $dashboard_dataSet["fp_over"]++ : $dashboard_dataSet["fp_less"]++) : $dashboard_dataSet["fp_noAge"]++;
				}

				if ($dashboard["Counselling_Date"] != null) {
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["counselling_male"]++ : $dashboard_dataSet["counselling_female"]++;
					$dashboard["Current Agey"] != 404 ? ($dashboard["Current Agey"] > 15 ? $dashboard_dataSet["counselling_over"]++ : $dashboard_dataSet["counselling_less"]++) : $dashboard_dataSet["counselling_noAge"]++;
				}

				if ($dashboard['Pid_TB03'] != null) {
					$dashboard["Gender"] == "Male" ? $dashboard_dataSet["tb_male"]++ : $dashboard_dataSet["tb_female"]++;
					$dashboard["Current Agey"] != 404 ? ($dashboard["Current Agey"] > 15 ? $dashboard_dataSet["tb_over"]++ : $dashboard_dataSet["tb_less"]++) : $dashboard_dataSet["tb_noAge"]++;
				}

				foreach ($genral_diages as $g_diag) {
					$diagnosisArray["general_diagnosis"] == $g_diag ? $dashboard_dataSet[$g_diag]++ : "";
				}
				//dd($diagnosisArray);
			}
			//dd($dashboard_dataSet);

			$diagnosis_chart = (new LarapexChart)->pieChart()
				->setTitle('Diease Category')
				->addData([
					$dashboard_dataSet["RTI<2wks"], $dashboard_dataSet["RTI>=2"], $dashboard_dataSet["ObstructiveDs"], $dashboard_dataSet["Dengue-Fever"], $dashboard_dataSet["RenalDs"],
					$dashboard_dataSet["GI-Hepato"], $dashboard_dataSet["Malnouri"], $dashboard_dataSet["Child-Abuse"], $dashboard_dataSet["SkinInfect"], $dashboard_dataSet["Others"],
				])
				->setLabels(['RTI (<2wks)', 'RTI (>=2wks)', 'Obstructive pul. D/S', 'DF', 'RenalDs', 'GI & Hepatobiary', 'Mainourished', 'Child Abuse', 'Skin Infection', 'Others'])
				->setWidth(450) // Custom width
				->setColors(["#2196F3", "#E64A19", "#616161", '#FFEA00', '#2962FF', '#388E3C', '#1A237E', '#4E342E', '#212121', '#8D6E63']);



			if ($dashboard_dataSet["TBHiv_pos"] != 0 || $dashboard_dataSet["TBHiv_neg"] != 0) {
				$tb_chart = (new LarapexChart)->pieChart()
					->setTitle('TB')
					->addData([$dashboard_dataSet["TBHiv_pos"], $dashboard_dataSet["TBHiv_neg"]])
					->setLabels(['HIV(+)ve TB', 'HIV(-)ve TB'])
					->setWidth(450)
					->setColors(['#1976D2', '#E64A19']);
			}


			$hiv_chart = (new LarapexChart)->pieChart()
				->setTitle('HIV')
				->addData([$dashboard_dataSet["pha"], $dashboard_dataSet["art"]])
				->setLabels(['PHA', 'ART'])
				->setWidth(450)
				->setColors(['#1976D2', '#E64A19']);
			$prep_chart = (new LarapexChart)->pieChart()
				->setTitle('PrEP')
				->addData([$dashboard_dataSet["prep_new"], $dashboard_dataSet["prep_old"]])
				->setLabels(['New', 'Old'])
				->setWidth(450)
				->setColors(['#1976D2', '#E64A19']);

			return view("MME.Dashboard.mneDiagnosisDashboard", compact('hiv_chart', 'diagnosis_chart', 'tb_chart', 'prep_chart'))
				->with('dashboardData', $dashboard_dataSet)
				->with('inputData', $inputData);
		} elseif ($inputData["dash_type"] == "Risk") {
			dd("Hello is mt");
		}
	}
}
