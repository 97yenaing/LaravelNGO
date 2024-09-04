<?php

namespace App\Exports\MME_Export\Lab;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class LabExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
	private $lab_records, $testName;
	public function __construct($lab_records, $testName)
	{
		$this->lab_records = $lab_records;
		$this->testName = $testName;
	}

	public function collection()
	{
		return $this->lab_records;
	}
	public function map($row): array
	{
		if ($this->testName == 'hiv') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row['vdate'],
				$row['bcollectdate'],
				$row['Detmine_Result'],
				$row['Unigold_Result'],
				$row['STAT_PAK_Result'],
				$row['Final_Result'],
				$row['Req_Doctor'],
				$row['Incon'],
				$row['Counsellor'],
				$row['LabTech'],
				$row['created_at'],
				$row['updated_at'],
			];
		} else if ($this->testName == 'rpr') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['pid'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row['vdate'],
				$row['RDT(Yes/No)'],
				$row['RDT Result'],
				$row['Quantitative(Yes/No)'],
				$row['RPR Qualitative'],

				$row['Titre(current)'],
				$row['Titre(Last)'],
				$row['TitreLastDate'],
				$row['Req_Doctor'],
				$row['Counsellor'],
				$row['Lab Tech'],
				$row['Issue Date'],

				$row['created_at'],
				$row['updated_at'],
			];
		} else if ($this->testName == 'sti') {
			return [
				$row->getConnectionName(),

				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['Req_Doctor'],
				$row['vdate'],
				$row['Main Risk'],
				$row['Sub Risk'],

				$row['Wet Mount clue cell'],
				$row['Wet Mount Trichomonas'],
				$row['Wet Mount candida'],
				$row['wetoth'],
				$row['urethra WBC'],
				$row['Urethra diplococci intra-cell'],
				$row['Urethra diplococci extra-cell'],
				$row['Urethra Candida'],
				$row['uoth'],
				$row['Fornix Clue Cells'],
				$row['Fornix WBC'],
				$row['Fornix diplococci intra-cell'],
				$row['Fornix diplococci extra-cell'],
				$row['Fornix Candida'],
				$row['pfother'],
				$row['Endo cervix WBC'],
				$row['Endo cervix diplococci intra-cell'],
				$row['Endo cervix diplococci extra-cell'],
				$row['Endo cervix Candida'],
				$row['eother'],
				$row['Rectum WBC'],
				$row['Rectum diplococci intra-cell'],
				$row['Rectum diplococci extra-cell'],
				$row['rother'],
				$row['First Per Urine'],
				$row['Epithelial cells'],
				$row['PMNL cells'],
				$row['First Per Urine Diplococci Intra-Cell'],
				$row['First Per Urine Diplococci Extra-Cell'],
				$row['fpu_oth'],
				$row['Other Bacteria'],
				$row['Clue cells result'],
				$row['PMNL result'],
				$row['trichomonas result'],
				$row['diplococci intra cell result'],
				$row['diplococci extra cell result'],
				$row['spermatozoites result'],
				$row['candida result'],

				$row['Lab Techanician'],
				$row['idate'],
				$row['created_at'],
				$row['updated_at'],
			];
		} else if ($this->testName == 'hep_bc') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['vdate'],
				$row['Req_Doctor'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row['Final_Result'],
				$row['HepB Test'],
				$row['HepB TOT'],
				$row['HepB Result'],
				$row['HepC Test'],
				$row['HepC TOT'],
				$row['HepC Result'],
				$row['Lab Tech'],
				$row['Issue Date'],
			];
		} else if ($this->testName == 'urine') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['vdate'],
				$row['Req_Doctor'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row['Utest_done'],
				$row['Utot'],
				$row['Ucolor'],
				$row['tubitity'],
				$row['Upus'],
				$row['ph'],
				$row['Uprotein'],
				$row['Uglucose'],
				$row['Urbc'],
				$row['Uleu'],
				$row['Unitrite'],
				$row['Uketone'],
				$row['Uepithelial'],
				$row['Urobili'],
				$row['Ubillru'],
				$row['Uery'],
				$row['Ucrystal'],
				$row['Uhae'],
				$row['Ucast'],
				$row['Uother'],
				$row['Cretinine'],
				$row['Albumin'],
				$row['A:C_ratio'],
				$row['comment'],
				$row['lab_tech'],
				$row['issue_date'],
			];
		} else if ($this->testName == 'oi') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Gender'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row['Req_Doctor'],
				$row['vdate'],
				$row['TB_LAM_Report'],
				$row['Toxo plasma'],
				$row['Toxo igG'],
				$row['Toxo igM'],
				$row['Serum Result'],
				$row['serum_pos'],
				$row['CSF for Cryptococcal Antigen'],
				$row['csf_crypto_pos'],
				$row['csf_fungal'],
				$row['CSF Smear Giemsa Stain'],
				$row['CSF Smear India Ink'],
				$row['skin_fungal'],
				$row['Skin Smear Giemsa Stain'],
				$row['Skin Smear India Ink'],
				$row['lymph_test'],
				$row['Lymph Giemsa Stain'],
				$row['Lymph India Ink'],
				$row['Lab Techanician'],
				$row['issued'],

			];
		} else if ($this->testName == 'general') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['vdate'],
				$row['Req_Doctor'],

				$row['Main Risk'],
				$row['Sub Risk'],
				$row['Dangue RDT'],
				$row['NS1 Antigen'],
				$row['IgG Result'],
				$row['IgM Result'],
				$row['Malaria RDT'],
				$row['Malaria RDT Result'],

				$row['Malaria_spec'],
				$row['Malaria_grade'],
				$row['Malaria_stage'],
				$row['malaria_microscopy'],
				$row['Malaria Microscopy Result'],
				$row['RBS test'],
				$row['RBS'],
				$row['FBS test'],
				$row['FBS'],
				$row['haemo_done'],
				$row['haemoglobin'],
				$row['hba1c'],
				$row['Lab Tech'],
				$row['Issue Date'],
			];
		} else if ($this->testName == 'Stool') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['vdate'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row['st_stool'],
				$row['st_colour'],
				$row['wbc_pus_cell'],
				$row['st_consistency'],
				$row['st_rbcs'],
				$row['st_other'],
				$row['st_comment'],
				$row['st_lab_tech'],
				$row['st_issue_date'],
			];
		} else if ($this->testName == 'afb') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['Req_Doctor'],
				$row['vdate'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row[''],
				$row[''],
				$row['Previous_TB'],
				$row['Final_Result'],
				$row['reason_for_exam'],
				$row['afb_Pt_type'],
				$row['follow_up_mt'],
				$row['speci_type'],
				$row['oth_spe_ty'],

				$row['slide_num_1'],
				$row['speci_receive_dt1'],
				$row['visual_app_1'],
				$row['afb_result1'],
				$row['slide1_grading1'],


				$row['slide_num_2'],
				$row['speci_receive_dt2'],
				$row['visual_app_2'],
				$row['afb_result2'],
				$row['slide2_grading2'],

				$row['afb_lab_techca'],
				$row['afb_issue_date'],

			];
		} else if ($this->testName == 'covid19') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['Req_Doctor'],
				$row['vdate'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row['type_of_patient_covid'],
				$row['specimen_type'],
				$row['co_test_type'],
				$row['covid_result'],
				$row['covid_lab_tech'],
				$row['covid_issue_date'],
			];
		} else if ($this->testName == 'viral') {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row['CID'],
				$row['FuchiaID'],
				$row['Reg year'],
				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Gender'],
				$row['Main Risk'],
				$row['Sub Risk'],
				$row['Req_Doctor'],
				$row['ART_ini_date'],
				$row['ART_duration'],

				$row['Sample_Ship_Date'],
				$row['vdate'],
				$row['Sample Sent to'],
				$row['Result received date'],
				$row['Detect'],
				$row['Viral Load Result'],
				$row['Other org code'],
				$row['Remark'],
			];
		}
	}
	public function headings(): array
	{
		if ($this->testName == 'hiv') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',
				'Reg Year',
				'Register Age',
				'Register Age(Month)',
				'Current Age',
				'Current Agem(Month)',
				'Gender',
				'Main Risk',
				'Sub Risk',
				'Visit Date',
				'Blood Collection Date',
				'Determine Result',
				'Unigold Result',
				'STAT PAK Result',
				'Final Result',
				'Requested Dr',
				'Inconclusive',
				'Counsellor',
				'Lab Technician',
				'Created Date_Time',
				'Updated Date_ime',

			];
		} else if ($this->testName == 'rpr') {
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
				'Gender',
				'Main Risk',
				'Sub Risk',
				'Visit Date',
				'RDT (Yes/No)',
				'RDT Result',
				'RPR (Yes/No)',
				'RPR Result',
				'Titre Current',
				'Titre Last',
				'Titre Last Date',
				'Requested Dr',
				'Counsellor',
				'Lab Techanician',
				'Issue Date',
				'Created Date_Time',
				'Updated Date_Time',
			];
		} else if ($this->testName == 'sti') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',

				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Gender',
				'Requested Doctor',
				'Visit Date',
				'Main Risk',
				'Sub Risk',

				'Wet Mount clue cell',
				'Wet Mount Trichomonas',
				'Wet Mount candida',
				'wetoth',
				'urethra WBC',
				'Urethra diplococci intra-cell',
				'Urethra diplococci extra-cell',
				'Urethra Candida',
				'uoth',
				'Fornix Clue Cells',
				'Fornix WBC',
				'Fornix diplococci intra-cell',
				'Fornix diplococci extra-cell',
				'Fornix Candida',
				'pfother',
				'Endo cervix WBC',
				'Endo cervix diplococci intra-cell',
				'Endo cervix diplococci extra-cell',
				'Endo cervix Candida',
				'eother',
				'Rectum WBC',
				'Rectum diplococci intra-cell',
				'Rectum diplococci extra-cell',
				'rother',
				'First Per Urine',
				'Epithelial cells',
				'PMNL cells',
				'First Per Urine Diplococci Intra-Cell',
				'First Per Urine Diplococci Extra-Cell',
				'fpu_oth',
				'Other Bacteria',
				'Clue cells result',
				'PMNL result',
				'trichomonas result',
				'diplococci intra cell result',
				'diplococci extra cell result',
				'spermatozoites result',
				'candida result',

				'Lab Techanician',
				'idate',
				'Created Date_ Time',
				'Updated Date_ Time',

			];
		} else if ($this->testName == 'hep_bc') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',
				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Gender',
				'Visit Date',
				'Requested Dr',
				'Main Risk',
				'Sub Risk',
				'HIV Status',
				'Hep B Test',
				'Hep B Type of Test',
				'Hep B Result',
				'Hep C Test',
				'Hep C Type of Test',
				'Hep C Result',
				'Lab Technician',
				'Issue Date',
			];
		} else if ($this->testName == 'urine') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',
				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Gender',
				'Visit Date',

				'Requested Dr',
				'Main Risk',
				'Sub Risk',
				'Test_done',
				'Type of Test',
				'Apperance',
				'Tubitity',
				' PUS/WBC ',
				'PH',
				'Protein',
				'Glucose',
				'RBC',
				'Leukocyte',
				'Nitrite',
				'Ketone',
				'Epithelial',
				'Urobilinogen',
				'Bilirubin',
				'Erythrocyte',
				'Crystal',
				'Haemoglobin',
				'Cast',
				'Other',
				'Cretinine',
				'Albumin',
				'A:C_ratio',
				'Comment',
				'Lab Technician',
				'Issue Date',
			];
		} else if ($this->testName == 'oi') {
			return [
				'Database',
				'Clinic Code',
				'CID',
				'FuchiaID',
				'Sex',
				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Main Risk',
				'Sub Risk',
				'Req_Doctor',
				'Visit Date',

				'TB_LAM_Report',
				'Toxoplasma Antibody',
				'Toxo igG',
				'Toxo igM',
				'Serum Cryptococcal Antigen',
				'Dilution ',
				'CSF for Cryptococcal Antigen',
				'Dilution',
				'CSF Smear ',
				'CSF Gram stain Result ',
				'CSF India Ink Result ',
				'Skin Smear',
				'Skin Smear Giemsa Stain',
				'Skin Smear India Ink',
				'Other Smear',
				'Other Giemsa Stain',
				'Other India Ink',
				'Lab Techanician',
				'Issued Date',
			];
		} else if ($this->testName == 'general') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',
				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Gender',
				'Visit Date',
				'Requested Doctor',

				'Main Risk',
				'Sub Risk',
				'Dangue RDT',
				'NS1 Antigen',
				'IgG Result',
				'IgM Result',
				'Malaria RDT',
				'Malaria RDT Result',
				'Malaria Spec',
				'Malaria Grade',
				'Malaria Stage',
				'Malaria Microscopy',
				'Malaria Microscopy Result',
				'RBS test',
				'RBS',
				'FBS test',
				'FBS',
				'Haemo Done',
				'Haemoglobin',
				'Hba1c',
				'Lab Technician',
				'Issue Date',
			];
		} else if ($this->testName == 'stool') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',
				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Gender',
				'Visit Date',
				'Main Risk',
				'Sub Risk',
				'Stool',
				'Colour',
				'WBC-PUS',
				'Consistency',
				'RBCS',
				'Other',
				'Comment',
				'Lab Technician',
				'Issue Date',
			];
		} else if ($this->testName == 'afb') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',
				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Gender',
				'Requested Doctor',
				'Visit Date',
				'Main Risk',
				'Sub Risk',
				"Patient's Name",
				'Patient Address',
				'Previous TB',
				'HIV Status',
				'Reason_for_exam',
				'Patient Type',
				'Follow Up Month',
				'Specimen type',
				'oth_spe_ty',

				'Slide Number 1',
				'Specimen receive date 1',
				'Visual Appearance 1',
				'Result 1',
				'Slide Grading, 1',

				'Slide Number 2',
				'Specimen receive date 2',
				'Visual Apperance 2',
				'Result 2',
				'Slide grading 2',

				'Lab technician',
				'Issue date',

			];
		} else if ($this->testName == 'covid19') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',
				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Gender',
				'Requested Doctor',

				'Visit Date',
				'Main Risk',
				'Sub Risk',
				'Type of Patient',
				'Specimen Type',
				'Test Type',
				'Result',
				'Lab Technician',
				'Issue Date',
			];
		} else if ($this->testName == 'viral') {
			return [
				'Database',
				'Clinic Code',
				'General ID',
				'Fuchia ID',
				'Register Year',
				'Register Agey',
				'Register Agem(Month)',
				'Current Agey',
				'Current Agem(Month)',
				'Gender',
				'Main Risk',
				'Sub Risk',
				'Requested Dr',
				'ART initial date',
				'ART duration',

				'Sample Ship Date',
				'Visit Date',
				'Sample Sent to',
				'Result received date',
				'Detectable',
				'Viral Load Result',
				'Other organization code',
				'Remark',
			];
		}
	}

	public function chunkSize(): int
	{
		return 5000; // Process 1,000 rows at a time
	}
	public function columnFormats(): array
	{
		if ($this->testName == 'hiv') {
			return [
				'M' => 'dd-mm-yy',
				'N' => 'dd-mm-yy',
				// 'S' => 'dd-mm-yy',
				// 'T' => 'dd-mm-yy',
			];
		} else if ($this->testName == 'rpr') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'M' => 'dd-mm-yyyy',
				'T' => 'dd-mm-yyyy',
				'X' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'sti') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'L' => 'dd-mm-yyyy',
				'BB' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'hep_bc') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'K' => 'dd-mm-yyyy',
				'W' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'urine') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'K' => 'dd-mm-yyyy',
				'AN' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'oi') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'N' => 'dd-mm-yyyy',
				'AG' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'general') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'K' => 'dd-mm-yyyy',
				'AH' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'stool') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'K' => 'dd-mm-yyyy',
				'V' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'afb') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'L' => 'dd-mm-yyyy',
				'Y' => 'dd-mm-yyyy',
				'AD' => 'dd-mm-yyyy',
				'AI' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'covid19') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'L' => 'dd-mm-yyyy',
				'T' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == 'viral') {
			return [
				//'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
				'J' => 'dd-mm-yyyy',
				'L' => 'dd-mm-yyyy',
				'M' => 'dd-mm-yyyy',
				'N' => 'dd-mm-yyyy',
				'O' => 'dd-mm-yyyy',
			];
		}
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
