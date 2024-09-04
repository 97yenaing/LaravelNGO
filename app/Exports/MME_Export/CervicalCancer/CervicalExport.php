<?php

namespace App\Exports\MME_Export\CervicalCancer;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class CervicalExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
	private $cervical_records;
	public function __construct($cervical_records)
	{
		$this->cervical_records =  $cervical_records;
	}

	public function collection()
	{
		return $this->cervical_records;
	}
	public function map($row): array
	{
		return [
			$row->getConnectionName(),
			$row['Clinic_code'],
			$row['General ID'],
			$row['FuchiaID'],
			$row['Reg year'],
			$row['Register Agey'],
			$row['Register Agem'],
			$row['Current Agey'],
			$row['Current Agem'],
			$row['Visit_date'],
			$row['Hiv_Status'],
			$row['FSW'],
			$row['No_previous_preg'],
			$row['Birth_spacing_met'],
			$row['LMP'],
			$row['UCG_test_date'],
			$row['UCG_test_res'],
			$row['Discharge'],
			$row['Cervix_bleed_touch'],
			$row['Tenderness'],
			$row['Malignancy'],
			$row['Comments_spec'],

			$row['Breast_self'],
			$row['Breast_family_his'],
			$row['Breast_examination'],
			$row['Breast_abnormal_find_breast'],
			$row['Breast_remark'],


			$row['Sti_Complaint'],
			$row['Sti_examination'],
			$row['VIA_Screening_History'],
			$row['VIA_test'],
			$row['VIA_postpone_reason'],
			$row['VIA_specify_reason'],
			$row['SCJ'],
			$row['VIA_test_Result'],
			$row['refer_OG'],
			$row['Counselling_VIA_result_done'],
			$row['Eglible_thermal_ablation'],
			$row['Eglible_thermal_ablation_reason'],
			$row['Eglible_thermal_ablation_specify'],
			$row['Thermal_ablation_done'],
			$row['Thermal_No_specify'],
			$row['Thermal_other_specify'],
			$row['Thermal_ablation_result'],
			$row['Thermal_ablation_performed'],
			$row['Postpone_date'],
			$row['Date'],
			$row['Followup_date'],
			$row['Tertiary_Further_treatment'],
			$row['AE_Date'],
			$row['Complaint'],
			$row['Complaint_yes'],
			$row['Complaint_other'],
			$row['Refer_Hosp'],
			$row['AE_realated_thermal_ablation'],
			$row['Treatment'],
			$row['AE_followUp_Date'],
		];
	}
	public function headings(): array
	{
		return [
			'Database',
			'Clinic Code',
			'General ID',
			'Fuchia ID',
			'Reg Year',
			'Register Age',
			'Register Age(Month)',
			'Current Age',
			'Current Age(Month)',
			'Visit Date',
			'HIV Status',
			'FSW',
			'No. Previous Pregnancy',
			'Birth spacing_method',
			'LMP',

			'UCG_test_date',
			'UCG_test_result',
			'Discharge',
			'Cervix_bleed',
			'Tenderness',
			'Malignancy',
			'Comments',
			'Breast_self',
			'Breast_family_his',
			'Breast_examination',
			'Breast_abnormal_find_breast',
			'Breast_remark',
			'STI_complaint',
			'STI_examination',
			'VIA_screening_his',
			'VIA_test',
			'VIA_postponed_reason',
			'VIA_postponed_reason_oth',
			'SCJ',
			'VIA_test_res',
			'Referred_OG',
			'Counselling_via_res_by',
			'Eligible_thermal_ablation',
			'Eligible_thermal_ablation_rea',
			'Eligible_thermal_ablation_rea_oth',
			'Thermal_ablation_done',
			'Thermal_ablation_done_rea',
			'Thermal_ablation_done_rea_oth',
			'Thermal_ablation_res',
			'Thermal_ablation_per_by',
			'Thermal_ablation_date',
			'Date',
			'Followup Date',
			'Ref_to_tertiary_center_further_treatment',
			'AE_date',
			'Complaint',
			'Complaint_Spec',
			'Complaint_Spec_oth',
			'Ref_hosipital',
			'AE_related_thermal_ablation',
			'Treatment',
			'AE_followup_date',
		];
	}
	public function chunkSize(): int
	{
		return 5000; // Process 1,000 rows at a time
	}
	public function columnFormats(): array
	{
		return [
			'J' => 'dd-mm-yyyy',
			'O' => 'dd-mm-yyyy',
			'P' => 'dd-mm-yyyy',
			'Q' => 'dd-mm-yyyy',
			'AT' => 'dd-mm-yyyy',
			'AU' => 'dd-mm-yyyy',
			'AV' => 'dd-mm-yyyy',
			'AX' => 'dd-mm-yyyy',
			'BE' => 'dd-mm-yyyy',
		];
	}
	public function columnWidths(): array
	{
		$columns = [];
		foreach (range('A', 'Z') as $char) {
			$columns[] = $char;
		}
		foreach (range('A', 'Z') as $char1) {
			foreach (range('A', 'Z') as $char2) {
				$columns[] = $char1 . $char2;
			}
		}
		return array_fill_keys($columns, 15);
	}
}
