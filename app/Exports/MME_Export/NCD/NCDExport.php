<?php

namespace App\Exports\MME_Export\NCD;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class NCDExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
	private $ncd_records, $testName;
	public function __construct($ncd_records, $testName)
	{
		$this->ncd_records = $ncd_records;
		$this->testName = $testName;
	}
	public function collection()
	{
		return $this->ncd_records;
	}
	public function map($row): array
	{
		if ($this->testName == "Follow_Up") {
			return [
				$row->getConnectionName(),
				$row["Clinic Code"],
				$row["Pid"],
				$row["FuchiaID"],
				$row["Visit_date"],
				$row["Reg_Date"],
				$row["visit_Age"],
				$row["Current Agey"],
				$row["Gender"],
				$row["Area_Division"],
				$row["Township"],
				$row["NCD_Diagnosis"],
				$row["Follow_Height"],
				$row["Follow_Weight"],
				$row["Follow_Bmi"],
				$row["Type_cur_visit"],
				$row["Late_visit"],
				$row["Late_duration"],
				$row["Late_follow"],
				$row["Late_fol_duration"],
				$row["Next_Appointment"],
				$row["Time"],
				$row["own_clinic_Bp"],
				$row["own_Bp_Stage"],
				$row["FBS"],
				$row["FBS_test_date"],
				$row["2HPP"],
				$row["2HPP_test_date"],
				$row["Loaction_test"],
				$row["Lab_res_Date"],
				$row["Alt"],
				$row["HBA1C"],
				$row["Uring_AC_ratio"],
				$row["Glucose_res"],
				$row["Protein_res"],
				$row["Creatinine"],
				$row["Creat_unit"],
				$row["CRCL"],
				$row["Total_cholesterol"],
				$row["Total_cho_Unit"],
				$row["CVD_Risk"],
				$row["HDL"],
				$row["HDL_unit"],
				$row["LDL"],
				$row["LDL_unit"],
				$row["Triglyceride"],
				$row["Triglyceride_unit"],
				$row["Pulse"],
				$row["Pulse_rate"],
				$row["Diabetic_foot"],
				$row["Diabetic_Neuropathy"],
				$row["Lifestyle advice"],
				$row["Medication changed"],
				$row["Patient_adhe medic"],
				$row["Drug_Supply"],
				$row["F_Amlodipine_dose"],
				$row["F_Amlodipine_Freq"],
				$row["F_Amlodipine_duration"],
				$row["F_Amlodipine_durUnit"],
				$row["F_Enalapril_dose"],
				$row["F_Enalapril_Freq"],
				$row["F_Enalapril_duration"],
				$row["F_Enalapril_durUnit"],
				$row["F_Atorvastain_dose"],
				$row["F_Atorvastain_Freq"],
				$row["F_Atorvastain_duration"],
				$row["F_Atorvastain_durUnit"],
				$row["F_Hydrochlorothiazide_dose"],
				$row["F_Hydrochlorothiazide_Freq"],
				$row["F_Hydrochlorothiazide_duration"],
				$row["F_Hydrochlorothiazide_durUnit"],
				$row["F_Aspirin_dose"],
				$row["F_Aspirin_Freq"],
				$row["F_Aspirin_duration"],
				$row["F_Aspirin_durUnit"],
				$row["F_Metformin(500)_dose"],
				$row["F_ Metformin(500)_Freq"],
				$row["F_Metformin(500)_duration"],
				$row["F_Metformin(500)_durUnit"],
				$row["F_Metformin(1000)_dose"],
				$row["F_ Metformin(1000)_Freq"],
				$row["F_Metformin(1000)_duration"],
				$row["F_Metformin(1000)_durUnit"],
				$row["F_Gliclazide(500)_dose"],
				$row["F_Gliclazide(500)_Freq"],
				$row["F_Gliclazide(500)_duraion"],
				$row["F_Gliclazide(500)_durUnit"],
				$row["F_Gliclazide(1000)_dose"],
				$row["F_ Gliclazide(1000)_Freq"],
				$row["F_Gliclazide(1000)_duration"],
				$row["F_Gliclazide(1000)_durUnit"],
				$row["Symptom hypoglycemia"],
				$row["Foth_medi"],
				$row["Foth_medi_spec"],
				$row["Out_come"],
				$row["Tout_mam_clinic"],
				$row["Tout_physician_data"],
				$row["death_date"],
				$row["Cause_of_death"],
				$row["Fup_doc_initial"],
				$row["RBS result"],
				$row["visit_type"],
			];
		} else {
			return [
				$row->getConnectionName(),
				$row["Clinic_code"],
				$row["Pid"],
				$row["FuchiaID"],
				$row["Current Agey"],
				$row["Gender"],
				$row["Reg_Date"],
				$row["Township"],
				$row["Area_Division"],
				$row["Height"],
				$row["Weight"],
				$row["Register_Bmi"],
				$row["1stBP"],
				$row["1stBP_date"],
				$row["2ndBP"],
				$row["2ndBP_date"],
				$row["3rdBP"],
				$row["3rdBP_date"],

				$row["1stHypertension"],
				$row["1st_DiagDate"],
				$row["2nd_Hypertension"],
				$row["2nd_DiagDate"],
				$row["staging_Hypertension"],
				$row["1st_RBS"],
				$row["1st_RBS_date"],
				$row["2nd_RBS"],
				$row["2nd_RBS_date"],

				$row["Clinical_Symptoms"],
				$row["Clinical_Symptoms_Describe"],
				$row["Smoking_Status"],

				$row["Amlodipine_dose"],
				$row["Amlodipine_Freq"],
				$row["Amlodipine_duration"],
				$row["Amlodipine_durUnit"],

				$row["Enalapril_dose"],
				$row["Enalapril_Freq"],
				$row["Enalapril_duration"],
				$row["Enalapril_durUnit"],

				$row["Atorvastain_dose"],
				$row["Atorvastain_Freq"],
				$row["Atorvastain_duration"],
				$row["Atorvastain_durUnit"],

				$row["Hydrochlorothiazide_dose"],
				$row["Hydrochlorothiazide_Freq"],
				$row["Hydrochlorothiazide_duration"],
				$row["Hydrochlorothiazide_durUnit"],

				$row["Aspirin_dose"],
				$row["Aspirin_Freq"],
				$row["Aspirin_duration"],
				$row["Aspirin_durUnit"],

				$row["Metformin_dose"],
				$row["Metformin_Freq"],
				$row["Metformin_duration"],
				$row["Metformin_durUnit"],

				$row["Gliclazide_dose"],
				$row["Gliclazide_Freq"],
				$row["Gliclazide_duraion"],
				$row["Gliclazide_durUnit"],


				$row["Other_NCD_medication"],
				$row["Oth_ncd_med_specify"],

				$row["cur_med1"],
				$row["cur_med1_dose"],
				$row["cur_med1_freq"],
				$row["cur_med1_duration"],
				$row["cur_med1_durUnit"],

				$row["cur_med2"],
				$row["cur_med2_dose"],
				$row["cur_med2_freq"],
				$row["cur_med2_duration"],
				$row["cur_med2_durUnit"],

				$row["cur_med3"],
				$row["cur_med3_dose"],
				$row["cur_med3_freq"],
				$row["cur_med3_duration"],
				$row["cur_med3_durUnit"],

				$row["cur_med4"],
				$row["cur_med4_dose"],
				$row["cur_med4_freq"],
				$row["cur_med4_duration"],
				$row["cur_med4_durUnit"],

				$row["cur_med5"],
				$row["cur_med5_dose"],
				$row["cur_med5_freq"],
				$row["cur_med5_duration"],
				$row["cur_med5_durUnit"],

				$row["cur_med6"],
				$row["cur_med6_dose"],
				$row["cur_med6_freq"],
				$row["cur_med6_duration"],
				$row["cur_med6_durUnit"],

				$row["Dia_foot"],
				$row["Hyperlipidemia"],
				$row["Gestational_Diabetes"],
				$row["Gestational_HT"],
				$row["Neuropathy"],
				$row["CKD"],
				$row["CVD"],
				$row["Atril_Fib"],
				$row["Change_in_Vision"],
				$row["Chronic_Lung_Disease"],
				$row["Recur_infection"],
				$row["Recur_infection_comment"],
				$row["Family_Hyper"],
				$row["Family_Diabetes"],

			];
		}
	}
	public function headings(): array
	{
		if ($this->testName == "Follow_Up") {
			return [
				"Database",
				'Clinic code',
				'General ID',
				'Fuchia ID ',
				'Visit Date',
				'Register Date',
				'NCD Register Age',
				'NCD Follow_UP Age',
				'Sex',
				'State',
				'Township',
				'NCD Diagnosis',
				'Height',
				'Weight',
				'BMI',
				'Type_current_visit',
				'Late_duration',
				'late_duration_unit',
				'Followup_required_Duration',
				'Fup_req_dur_unit',
				'Next:Follow_up_date',
				'Time',
				'BP MAM',
				'BP state',
				'FBS result',
				'FBS Date',
				'2HPP',
				'2Hpp Date',
				'Location_of_test',
				'Other Lab Result Date',
				'ALT',
				'HBA1C',
				'Urine_ACR',
				'Glucose result',
				'Protein result',
				'Creatinine',
				'Creatinine unit',
				'CRCL',
				'Total cholesterol',
				'Total cholesterol unit',
				'CVD_risk',
				'HDL',
				'HDL_unit',
				'LDL',
				'LDL unit',
				'Triglyceride',
				'Triglyceride unit',
				'Pulse',
				'Pulse rate',
				'Diabetic foot',
				'Diabetic Neuropathy',
				'Lifestyle advice',
				'Medication changed',
				'Patient Adherence to medication',
				'Drug supply',

				'Amlodipine dose',
				'Amlodipine frequency',
				'Amlodipine dose duration',
				'Amlodipine dose duration_unit',

				'Enalapril dose',
				'Enalapril frequency',
				'Enalapril duration',
				'Enalapril duration_unit',

				'Atorvastain dose',
				'Atorvastain frequency',
				'Atorvastain duration',
				'Atorvastain duration_unit',

				'Hydrochlorothiazide dose',
				'Hydrochlorothiazide frequency',
				'Hydrochlorothiazide duration',
				'Hydrochlorothiazide duration_unit',

				'Aspirin dose',
				'Aspirin frequency',
				'Aspirin duration',
				'Aspirin duration_unit',

				'Metformin(500) dose',
				'Metformin(500) frequency',
				'Metformin(500) duration',
				'Metformin(500) duration_unit',

				'Metformin(1000) dose',
				'Metformin(1000) frequency',
				'Metformin(1000) duration',
				'Metformin(1000) duration_unit',

				'Gliclazide(500) dose',
				'Gliclazide(500) frequency',
				'Gliclazide(500) duration',
				'Gliclazide(500) duration_unit',

				'Gliclazide(1000) dose',
				'Gliclazide(1000) frequency',
				'Gliclazide(1000) duration',
				'Gliclazide(1000) duration_unit',

				'Symptom hypoglycemia',
				'Followup Other Medication',
				'Other_med_spec',
				'Outcome',
				'Tout_mam_clinic',
				'Tout_physician',
				'Death Date',
				'Cause_of_death',
				'Dr Initial',
				'RBS result',
				'Visit type(old data)',
			];
		} else {
			return [
				'Database',
				'Clinic code',
				'General ID',
				'Fuchia ID',
				'NCD Register Age',
				'Sex',
				'Reg Date',
				'Township',
				'State',
				'Height',
				'Weight',
				'Reg_BMI',

				'BP(syst/dias)_1',
				'BP_readdate 1',
				'BP(syst/dias)_2',
				'BP_readdate 2',
				'BP(syst/dias)_3',
				'BP_readdate 3',

				'Hypertension',
				'Hypertension diagnosis Date',
				'Diabetes',
				'Diabetes Diagnosis Date',
				'Staging of hypertension',
				'RBS 1st',
				'RBS 1st Date',
				'RBS 2nd',
				'RBS 2nd Date',

				'Clinical symptoms',
				'Symptoms_des',
				'Smoking status',

				'Amlodipine dose',
				'Amlodipine frequency',
				'Amlodipine_duration',
				'Amlodipine_dur_unit',

				'Enalapril dose',
				'Enalapril frequency',
				'Enalapril_duration',
				'Enalapril_dur_unit',

				'Atorvastain dose',
				'Atorvastain frequency',
				'Atorvastain_duration',
				'Atorvastain_dur_unit',

				'Hydrochlorothiazide dose',
				'Hydrochlorothiazide frequency',
				'Hydrochlorothiazide_duration',
				'Hydrochlorothiazide_dur_unit',

				'Aspirin dose',
				'Aspirin frequency',
				'Aspirin_duration',
				'Aspirin_dur_unit',

				'Metformin dose',
				'Metformin frequency',
				'Metformin_duration',
				'Metformin_dur_unit',

				'Gliclazide dose',
				'Gliclazide frequency',
				'Gliclazide_duration',
				'Gliclazide_dur_unit',


				'Other NCD medication',
				'Other_NCD_medication_specify',

				'Current med1',
				'Current med1_dose',
				'Current med1_fre',
				'Current med1_duration',
				'Current med1_duration_unit',

				'Current med2',
				'Current med2_dose',
				'Current med2_fre',
				'Current med2_duration',
				'Current med2_duration_unit',

				'Current med3',
				'Current med3_dose',
				'Current med3_fre',
				'Current med3_duration',
				'Current med3_duration_unit',

				'Current med4',
				'Current med4_dose',
				'Current med4_fre',
				'Current med4_duration',
				'Current med4_duration_unit',

				'Current med5',
				'Current med5_dose',
				'Current med5_fre',
				'Current med5_duration',
				'Current med5_duration_unit',

				'Current med6',
				'Current med6_dose',
				'Current med6_fre',
				'Current med6_duration',
				'Current med6_duration_unit',

				'Diabetic foot',
				'Hyperlipidemia',
				'Gestational diabetes',
				'Gestational HT',
				'Neuropathy',
				'CKD',
				'CVD(MI/CVA/PVD)',
				'Atrial fib',
				'Changes in vision',
				'Chronic lung disease',
				'Recure infection',
				'Recurrent_infection_other',
				'Family history hypertension',
				'Family history diabetes',
			];
		}
	}
	public function chunkSize(): int
	{
		return 5000; // Process 1,000 rows at a time
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
	public function columnFormats(): array
	{
		if ($this->testName == "Follow_Up") {
			return [
				"E" => "d-m-YYYY",
				"F" => "d-m-YYYY",
				"U" => "d-m-YYYY",
				"Z" => "d-m-YYYY",
				"AB" => "d-m-YYYY",
				"AD" => "d-m-YYYY",
				"CT" => "d-m-YYYY",
			];
		} else {
			return [
				"G" => "d-m-YYYY",
				"N" => "d-m-YYYY",
				"P" => "d-m-YYYY",
				"R" => "d-m-YYYY",
				"T" => "d-m-YYYY",
				"V" => "d-m-YYYY",
				"Y" => "d-m-YYYY",
				"AA" => "d-m-YYYY",
			];
		}
	}
}
