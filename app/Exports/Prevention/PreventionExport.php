<?php

namespace App\Exports\Prevention;



//use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Export_age;
use App\Exports\RiskbackExcel\RefillRisk;
//class ReceptionExport implements FromQuery,   WithHeadings

use Carbon\Carbon;
use DateTime;

class PreventionExport implements FromView, WithColumnFormatting
{

	private $data;
	private $tableName;

	public function __construct($data, $tableName)
	{
		$this->data = $data;

		$this->tableName = $tableName;
	}
	public function view(): View
	{
		$tb = $this->tableName;
		$final_risklog = [];
		$final_log = [];
		if ($tb == "log_sheet") {
			$encrypted_columns = [
				"Main Risk",
				"Sub Risk",
				"HIV Status",
				"Initial Risk",
				"Changed_Risk",
				"HIV_Final_result", //decrypt section
				"Sex",

				"date_confirm",
				"Reg_Date",
				"Visit_Date",
				"Risk changed Date",
				// "OST_Initial_Date",
			];

			foreach ($this->data as $user) {
				$user["Name"] = Crypt::DecryptString($user["ptconfig"]["Name"]);
				$user["Township"] = Crypt::DecryptString($user["ptconfig"]["Township"]);
				$carbonDate = Carbon::createFromFormat('Y-m-d', $user["Visit_Date"]);
				$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
				$vdate = new DateTime($carbonDate);

				if ($user["ptconfig"] != null) {
					$user = Export_age::Export_general($user["ptconfig"], $user["Visit_Date"], $user["ptconfig"]["Date of Birth"], $user);
					$forRiskCheck[1]["Pid"] = $user["ptconfig"]["Pid"];
					$forRiskCheck[1]["Risk Log"] = $user["ptconfig"]["Risk Log"];
					if (!array_key_exists($user["ptconfig"]["Pid"], $final_log) && $user["ptconfig"]["Risk Log"] != null) {
						$final_risklog = RefillRisk::FillRisk($forRiskCheck);
						$final_log[$user["ptconfig"]["Pid"]] = $final_risklog;
					} elseif ($user["ptconfig"]["Risk Log"] == null) {
						if ($user['ptconfig']["Risk Change_Date"] != null) {
							$riskChangeDate = Carbon::createFromFormat('Y-m-d', $user['ptconfig']["Risk Change_Date"]);
							$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
							if ($vdate <= $riskChangeDate) {
								$user["Main Risk"] = $user['ptconfig']["Former Risk"];
								$user["Sub Risk"] = '';
							}
						}
					}

					if (array_key_exists($user["ptconfig"]["Pid"], $final_log)) {
						foreach (array_reverse($final_log[$user["ptconfig"]["Pid"]][$user["ptconfig"]["Pid"]]) as $date => $data) {
							if (strlen($date) == 10) {
								$riskChangeDate = new DateTime($date);
								if ($vdate < $riskChangeDate) {
									$user["Main Risk"] = Crypt::encrypt_light($data["Old Risk"], "General");
									$user["Sub Risk"] = Crypt::encrypt_light($data["Old Sub Risk"], "General");
								}
							}
						}
						// if ($user["ptconfig"]["Pid"] == "8122000904")
						// 	var_dump($user["Visit_Date"], $user["Main Risk"]);
					}
				}
				foreach ($encrypted_columns as $index => $column) {
					if ($index >= 0 && $index < 7) {
						$user[$column] = Crypt::decrypt_light($user[$column], "General");
						if ($user[$column] == "Invalid value") {
							$user[$column] = "";
						}
						$user[$column] = Crypt::codeBook($user[$column], "encode");
					}
					if ($index >= 7 && $index < count($encrypted_columns)) {
						$dateString = $user->{$column};
						// Check if $dateString is not empty
						if (!empty($dateString)) {
							// Parse the date from 'YYYY-mm-dd' to Carbon date object
							$carbonDate = Carbon::createFromFormat('Y-m-d', $dateString);
							// Format it as 'dd-mm-yyyy' and update the user object
							$ddString = $carbonDate->format('d-m-Y');

							$carbonDate = Carbon::createFromFormat('d-m-Y', $ddString); // Assuming you have a Carbon instance
							$user->{$column} = Date::dateTimeToExcel($carbonDate->startOfDay()); // Convert to Excel-compatible date

						}
					}
				}
			}
			//dd("hello is me");
			return view('Prevention.export_LogSheet', [
				'users' => $this->data,
				//'users2'=> $users2,
			]);
		}

		if ($tb == "cbs") {
			$encrypted_columns = [
				"Main Risk",
				"Sub Risk",
				"HIV_determine_result",
				"HIV result",
				"HIV Sero-Status",
				"Sex", // decrypt


				"Visit_Date",
				"date_confirm", //     Date of arrival at confirmation Facility (DD/MM/YY)


			];
			foreach ($this->data as $user) {
				if ($user["ptconfig"] != null) {
					$user = Export_age::Export_general($user["ptconfig"], $user["Visit_Date"], $user["ptconfig"]["Date of Birth"], $user);
					$carbonDate = Carbon::createFromFormat('Y-m-d', $user["Visit_Date"]);
					$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
					$vdate = new DateTime($carbonDate);
					$forRiskCheck[1]["Pid"] = $user["ptconfig"]["Pid"];
					$forRiskCheck[1]["Risk Log"] = $user["ptconfig"]["Risk Log"];
					if (!array_key_exists($user["ptconfig"]["Pid"], $final_log) && $user["ptconfig"]["Risk Log"] != null) {
						$final_risklog = RefillRisk::FillRisk($forRiskCheck);
						$final_log[$user["ptconfig"]["Pid"]] = $final_risklog;
					} elseif ($user["ptconfig"]["Risk Log"] == null) {
						if ($user['ptconfig']["Risk Change_Date"] != null&&$user['ptconfig']['Former Risk'] != null&&$user['ptconfig']['Former Risk'] != "731") {
							$riskChangeDate = Carbon::createFromFormat('Y-m-d', $user['ptconfig']["Risk Change_Date"]);
							$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
							if ($vdate <= $riskChangeDate) {
								$user["Main Risk"] = $user['ptconfig']["Former Risk"];
								$user["Sub Risk"] = '';
							}
						}
					}

					if (array_key_exists($user["ptconfig"]["Pid"], $final_log)) {
						foreach (array_reverse($final_log[$user["ptconfig"]["Pid"]][$user["ptconfig"]["Pid"]]) as $date => $data) {
							if (strlen($date) == 10) {
								$riskChangeDate = new DateTime($date);
								if ($vdate < $riskChangeDate) {
									$user["Main Risk"] = Crypt::encrypt_light($data["Old Risk"], "General");
									$user["Sub Risk"] = Crypt::encrypt_light($data["Old Sub Risk"], "General");
								}
							}
						}
					}
				}
				foreach ($encrypted_columns as $index => $column) {

					if ($column == "Visit_Date" || $column == "date_confirm") {
						$dateString = $user->{$column};

						if (!empty($dateString)) {
							// Parse the date from 'YYYY-mm-dd' to Carbon date object
							$carbonDate = Carbon::createFromFormat('Y-m-d', $dateString);
							// Format it as 'dd-mm-yyyy' and update the user1 object
							$ddString = $carbonDate->format('d-m-Y');

							$carbonDate = Carbon::createFromFormat('d-m-Y', $ddString); // Assuming you have a Carbon instance
							$user->{$column} = Date::dateTimeToExcel($carbonDate->startOfDay()); // Convert to Excel-compatible date

						}
					} else {
						$user->{$column} = Crypt::decrypt_light($user->{$column}, "General");
						if ($user->{$column} == "Invalid value") {
							$user->{$column} = "";
						}
						$user[$column] = Crypt::codeBook($user[$column], "encode");
					}
				}
			}

			return view('Prevention.export_cbs', [
				'users' => $this->data,
			]);
		}
	}

	public function columnFormats(): array
	{
		$tb = $this->tableName;
		if ($tb == "log_sheet") {
			return [
				'Q' => 'dd-mm-yyyy',
				'H' => 'dd-mm-yyyy',
				'I' => 'dd-mm-yyyy',
				'AJ' => 'dd-mm-yyyy',
				// 'AS' => 'dd-mm-yyyy',

			];
		} else if ($tb == "cbs") {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'G' => 'dd-mm-yyyy',
				'V' => 'dd-mm-yyyy',
			];
		}
	}
}// class end