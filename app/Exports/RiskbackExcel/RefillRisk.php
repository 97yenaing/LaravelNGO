<?php

namespace App\Exports\RiskbackExcel;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class RefillRisk
{
	public static function FillRisk($export_viewData)
	{
		$define_name = ["RiskChangeDate", "Old Risk", "Current Risk", "Due_to_patient", "change_user", "Old Sub Risk", "Current Sub Risk"];
		$final_log = [];
		foreach ($export_viewData as $key => $value) {

			if (!array_key_exists($value["Pid"], $final_log)) {
				$log_counts = explode("/", $value["Risk Log"]);
				$final_log[$value["Pid"]] = [];
				foreach ($log_counts as $log_count) {
					$same_index = 0;
					$risklog_detail = explode(":", $log_count);
					foreach ($risklog_detail as $index => $log) {
						//dd($risklog_detail[1]);
						if (isset($risklog_detail[1]) && $risklog_detail[1] != null && isset($risklog_detail[2]) && $risklog_detail[2] != null) {

							if ($index == 0) {
								$change_date = Carbon::parse($log)->format('d-m-Y');
								if (array_key_exists($change_date, $final_log[$value["Pid"]])) {
									$change_date = $change_date . '-' . ++$same_index;
								}
							} else if (in_array($index, [1, 2, 5, 6])) {
								$final_log[$value["Pid"]][$change_date][$define_name[$index]] = Crypt::decrypt_light($log, "General");
							} else {
								$final_log[$value["Pid"]][$change_date][$define_name[$index]] = $log;
							}
						}
					}
				}
			}
		}
		return $final_log;
	}
}
