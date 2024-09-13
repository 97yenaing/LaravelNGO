<?php

namespace App\Exports\Sti;

use App\Models\Stimale;
use App\Models\Stifemale;


use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Carbon\Carbon;
use App\Exports\Export_age;
use App\Exports\RiskbackExcel\RefillRisk;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use DateTime;

//class ReceptionExport implements FromQuery,   WithHeadings



class StiExport implements FromView, WithColumnFormatting
{

	private $users;
	private $sex;


	public function __construct($users, $sex)
	{
		$this->users = $users;
		$this->sex = $sex;
	}
	public function view(): View
	{
		switch ($this->sex) {
			case 'Male':
				$encrypted_columns = [
					'Gender',
					'last_vis_within',
					'about_clinic',
					'demo_remarks',
					'visit_type',
					'visit_time',
					'followup_visit',
					'episode',
					'Reason for Visit',
					'Main Risk',
					'Sub Risk',
					'urethral_disc',
					'urethral_disc_hl',
					'dysuria',
					'dysuria_hl',
					'genital_prut',
					'genital_prut_hl',
					'genital_pain',
					'genital_pain_hl',
					'genital_ulcer',
					'genital_ulcer_hl',
					'pain',
					'ulcer',
					'prodromal_itch',
					'vesicles',
					'recurrent',
					'last_episode',
					'suspects_herpes',
					'ing_lymph_node',
					'ing_lymph_node_hl',
					'unilateal',
					'leg_ulcer',
					'scrotal_swelling',
					'scrotal_swelling_hl',
					'td_ntd',
					'gen_wart',
					'gen_wart_hl',
					'physical_exam',
					'urinated_wit_1h',
					'discharge',
					'discharge_milk',
					'colour',
					'erythema',
					'blisters',
					'gen_ulcer',
					'esti_size',
					'sing_multi',
					'pain_full_less',
					'herpes_suspect',
					'inguinal_bubo',
					'fluctant',
					'tendr_ntender',
					'oth_leg_inf',
					'phy_genital_wart',
					'crab_lice',
					'scabies',
					'gscrotal_swelling',
					'estimated_siz',
					'unilateal_bilateral',
					'gtender_ntender',
					'erythem',
					'des_size',
					'tbl_treat_diagnosis_first_visit',
					'epi_discharge',
					'unprot_sex_new_part',
					'genital_signs',
					'pri_syphillis',
					'sec_syphillis',
					'chancroid',
					'gen_herpes',
					'gen_scabies',
					'gud_other',
					'Gonorhoea',
					'non_gono_urethritis',
					'non_gono_procti',
					'trichomonas',
					'genital_candidiosis',
					'beterial_vaginosis',
					'congenial_syphillis',
					'latent_syphillis',
					'molluscum_contag',
					'bubos',
					'othstd_genital_warts',
					'ostd_other',
					'tre_azythro',
					'tre_cefixim',
					'tre_ciprofloxacin',
					'tre_tinidazole',
					'tre_fluconazole',
					'tre_doxycycline',
					'tre_ceftriaxone',
					'tre_benz_pen',
					'no_treat',
					'al_Penicillin',
					'al_sulfa',
					'part_treat',
					'condom_giv',

				];
				$encrypted_38 = [
					'presumptive_diag',
					'tre_remarks',
					'followup',
					'clinician_name',
				];
				$export_blade = "sti_male_export";
				break;
			case 'Female':
				$encrypted_columns = [
					'Gender',
					'last_vis_within',
					'vtype',
					'about_clinic',
					'demo_remarks',
					'episode',
					'rea_for_visit',
					'Main Risk',
					'Sub Risk',
					'abn_vaginal_disc',
					'abn_vaginal_disc_long',
					'linked_menstru',
					'amount',
					'colour',
					'colour_oth',
					'abn_veginal_odour',
					'l_abn_pain',
					'l_abon_pain_hl',
					'fever',
					'rec_terminate_preg',
					'dyspareunia',
					'dysuria',
					'dysuria_hl',
					'gen_prutitus',
					'gen_prutitus_hl',
					'gen_burn_pain',
					'gen_burn_pain_hl',
					'gen_ulcer',
					'gen_ulcer_hl',
					'pain',
					'ulcer',
					'prodromal_itch',
					'vesicles',
					'recurrent',
					'recurrent_last_episode',
					'patient_suspects_herpes',
					'inguinal_ln',
					'inguinal_ln_hl',
					'unilateal_Bilateral',
					'leg_ulcer_oth_inf',
					'genital_warts',
					'genital_warts_hl',
					'phy_exam_done',
					'washed_inside',
					'vulvar_erythema',
					'vulvar_odema',
					'vaginal_discharge',
					'vag_dis_amount',
					'homogeneous',
					'homogeneous_col',
					'smell_without_KOH',
					'vaginal_wall_injury',
					'adnexal_tenderness',
					'adnexal_enlargement',
					'genital_blisters',
					'gential_ulcer',
					'gential_ulcerl',
					'gent_ulcer_sm',
					'gential_ulcer_pain',
					'susp_herpes',
					'inguinal_bubo',
					'fluctuant',
					'fluctuant_tender',
					'oth_leg_infection',
					//ok
					'genital_wart',
					'crab_lice',
					'scablices',
					'KOH_smell_test',
					'pH_vagina',
					'prev_STI',
					'patient_genital_ulcer',
					'patient_compl_low_abd',
					'new_pat_past_3mont',
					'part_compl_gential_sym',
					'sworker',
					'rg_score',
					'risk',
					//ok
					'abn_yellow_disc',
					'dysuria_risk_ass',
					'low_abd_pain',
					'pain_dur_sexual',
					'unp_sex_new_clients',
					'partner_ulcer',

					'pri_syphillis',
					'sec_syphillis',
					'chancroid',
					'gen_herpes',
					'gen_scabies',
					'gud_other',
					'other_plz_specify',
					'Gonorhoea',
					'non_gono_urethritis',
					'non_gono_cervities',
					'trichomonas',
					//ok
					'genital_candidiosis',
					'beterial_vaginosis',
					'congenial_syphillis',
					'latent_syphillis',
					'latent_syphillis_preg',
					'molluscum_contag',
					'bubos',
					'othstd_genital_warts',
					'ostd_other',
					'tre_azythro',
					'tre_cefixim',
					'tre_ciprofloxacin',
					'tre_tinidazole',
					'tre_fluconazole',
					'tre_doxycycline',
					'tre_ceftriaxone',
					'tre_benz_pen',
					'tre_Other',
					'clotrimazole_vaginal_tab',
					'no_treatment',
					'al_Penicillin',
					'al_sulfa',
					'part_treat',
					'condom_giv',
					'first_visit',
					'other_STD',

				];
				$encrypted_38 = [
					'oth_GI_sympt',
					'genital_blisters_Location',
					'des_size',
					'risk_cal_remark',
					'presumptive_diag',
					'tre_remarks',
					'followup',
					'clinician',
				];
				$export_blade = "sti_female_export";
				break;
		}
		$final_risklog = [];
		$final_log = [];
		foreach ($this->users as $user) {

			if ($user["ptconfig"] != null) {
				$user = Export_age::Export_general($user["ptconfig"], $user["Visit_date"], $user["ptconfig"]["Date of Birth"], $user);
				$carbonDate = Carbon::createFromFormat('Y-m-d', $user["Visit_date"]);
				$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
				$vdate = new DateTime($carbonDate);
				$user["Visit_date"] = Date::dateTimeToExcel($carbonDate->toDateTime());
				$user["Main Risk"] = $user["ptconfig"]["Main Risk"];
				$user["Sub Risk"] = $user["ptconfig"]["Sub Risk"];
				$user["Gender"] = $user["ptconfig"]["Gender"];
				$user["FuchiaID"] = $user["ptconfig"]["FuchiaID"];

				$forRiskCheck[1]["Pid"] = $user["ptconfig"]["Pid"];
				$forRiskCheck[1]["Risk Log"] = $user["ptconfig"]["Risk Log"];

				if (!array_key_exists($user["ptconfig"]["Pid"], $final_log) && $user["ptconfig"]["Risk Log"] != null) {
					$final_risklog = RefillRisk::FillRisk($forRiskCheck);
					$final_log[$user["ptconfig"]["Pid"]] = $final_risklog;
				} elseif ($user["ptconfig"]["Risk Log"] == null) {
					if ($user['ptconfig']["Risk Change_Date"] != null && $user['ptconfig']['Former Risk'] != null && $user['ptconfig']['Former Risk'] != "731") {
						$riskChangeDate = Carbon::createFromFormat('Y-m-d', $user['ptconfig']["Risk Change_Date"]);
						$riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
						if ($vdate < $riskChangeDate) {
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
			} else {
				$carbonDate = Carbon::createFromFormat('Y-m-d', $user["Visit_date"]);
				$carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
				$user["Visit_date"] = Date::dateTimeToExcel($carbonDate->toDateTime());
			}
			$no = 0;
			foreach ($encrypted_columns as $column) {

				$user[$column] = Crypt::decrypt_light($user[$column], "General");
				$user[$column] = Crypt::codeBook($user[$column], "encode");
			};
			foreach ($encrypted_38 as $column) {
				$user->{$column} = Crypt::decryptString($user->{$column}, "General");
			};
		}

		return view('STI.Export.' . $export_blade, [
			'users'     => $this->users,
		]);
	}
	public function columnFormats(): array
	{
		return [
			"J" => "d-m-YYYY",
		];
	}
}// class end
