<?php

namespace App\Exports\MME_Export\Prevention;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PreventionExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
	private $prevention_records, $testName;

	public function __construct($prevention_records, $testName)
	{
		$this->prevention_records = $prevention_records;
		$this->testName = $testName;
	}

	public function collection()
	{
		return $this->prevention_records;
	}

	public function map($row): array
	{
		if ($this->testName == "LogSheet") {
			return [
				$row->getConnectionName(),
				$row['He Code'],
				$row['Clinic Code'],
				$row['Reg year'],

				$row['Pid'],
				$row['FuchiaID'],
				$row['PrEPCode'],
				$row['Name'],

				$row['Reg_Date'],

				$row['Visit_Date'],


				$row['Register Agey'],
				$row['Register Agem'],
				$row['Current Agey'],
				$row['Current Agem'],
				$row['Sex'],

				$row['Initial Risk'],
				$row['Risk changed'],
				$row['Risk changed Date'],



				$row['Main_Risk'],
				$row['Sub_Risk'],
				$row['Township'],


				$row['New_Old'],
				$row['Substantial Risk'],
				$row['Meeting Point'],
				$row['Service Provision1'],
				$row['Service Provision2'],
				$row['Service Provision3'],
				$row['HE_Section'],
				$row['Ns_distribute'],
				$row['Condom_m'],
				$row['Condom_f'],
				$row['Ns_return'],
				$row['HIV Status'],

				$row['Test_duration'],
				$row['HTS done'],
				$row['HIV_Final_result'],
				$row['date_confirm'],
				$row['Reach_whom'],

				$row['Source_doc'],
				$row['Mental_Health'],
				$row['PHQ4_Q1_Q2'],
				$row['PHQ4_Q3_Q4'],
				$row['OST_Done'],
				$row['OST_Accept'],
				$row['Decline_Reason'],
				$row['OST_Initial_Date'],
				$row['Test_Clinic'],
				$row['Test_New_Old'],
				$row['Remark'],
			];
		} else if ($this->testName == "CBS") {
			return [
				$row->getConnectionName,
				$row['He Code'],
				$row['Clinic Code'],
				$row['Reg year'],

				$row['Pid'],
				$row['FuchiaID'],
				$row['PrEPCode'],
				$row['Visit_Date'],

				$row['Register Agey'],

				$row['Current Agey'],

				$row['Sex'],
				$row['Main_Risk'],
				$row['Sub_Risk'],

				$row['New_Old'],
				$row['Meeting Point'],
				$row['Service Provision'],
				$row['Retesting'],
				$row['HIV_determine_result'],
				$row['HIV result'],
				$row['Counselling_pretest'],
				$row['Counselling_posttest'],
				$row['Refer_to'],
				$row['date_confirm'],
				$row['HIV Sero-Status'],
				$row['Remark'],
			];
		} elseif ($this->testName == "Server_Confidential") {
			return [
				$row->getConnectionName(),
				$row['He_code'],
				$row['Clinic Code'],
				$row['Reg year'],

				$row['Pid'],
				$row['FuchiaID'],
				$row['PrEPCode'],
				$row['Reg Date'],



				$row['Register Agey'],
				$row['Register Agem'],


				$row['Gender'],
				$row['Former Risk'],
				$row['Risk changed'],
				$row['Risk Change_Date'],

				$row['Main Risk'],
				$row['Sub Risk'],

			];
		}
	}
	public function headings(): array
	{
		if ($this->testName == "LogSheet") {
			return [
				'Database',
				'He Code',
				'Clinic Code',
				'Register Year',
				'Pid',
				'Fuchia ID',
				'PrEP Code',
				'Name',
				'Register Date',
				'Visit Date',
				'Register Agey',
				'Register Age month',
				'Current Age',
				'Current Age month',
				'Sex',
				'Initial Risk',
				'Risk changed',
				'Risk changed Date',
				'Main Risk(Current Risk)',
				'Sub Risk',
				'Township',
				'New_Old',
				'Substantial Risk',
				'Meeting Point',
				'Service Provision1',
				'Service Provision2',
				'Service Provision3',
				'HE_Section',
				'Ns_distribute',
				'Condom_m',
				'Condom_f',
				'Ns_return',
				'HIV Status',
				'Test_duration',
				'HTS done',
				'HIV_Final_result',
				'date_confirm',
				'Reach_whom',
				'Source_doc',
				'Mental_Health',
				'PHQ4_Q1_Q2',
				'PHQ4_Q3_Q4',
				'OST_Done',
				'OST_Accept',
				'Decline_Reason',
				'OST_Initial_Date',
				'Test_Clinic',
				'Test_New_Old',
				'Remark',
			];
		} else if ($this->testName == "CBS") {
			return [
				'Database',
				'He Code',
				'Clinic Code',
				'Register Year',
				'Pid',
				'FuchiaID',
				'PrEPCode',
				'Visit_Date',

				'Register Agey',

				'Current Agey',

				'Sex',
				'Main_Risk',
				'Sub_Risk',

				'New_Old',
				'Meeting Point',
				'Service Provision',
				'Retesting',
				'HIV_determine_result',
				'HIV Sero-Status',
				'Counselling_pretest',
				'Counselling_posttest',
				'Refer_to',
				'date_confirm',
				'HIV Sero-Status',
				'Remark',
			];
		} elseif ($this->testName == "Server_Confidential") {
			return [
				'Database',
				'He Code',
				'Clinic Code',
				'Register Year',
				'Pid',
				'Fuchia ID',
				'PrEP Code',
				'Register Date',
				'Register Agey',
				'Register Age month',
				'Sex',
				'Initial Risk',
				'Risk changed',
				'Risk changed Date',
				'Main Risk(Current Risk)',
				'Sub Risk',

			];
		}
	}
	public function chunkSize(): int
	{
		return 5000; // Process 1,000 rows at a time
	}
	public function columnFormats(): array
	{
		if ($this->testName == "LogSheet") {
			return [
				'J' => 'dd-mm-yyyy',
				'I' => 'dd-mm-yyyy',
				'K' => 'dd-mm-yyyy',
				'AK' => 'dd-mm-yyyy',
				'AT' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == "CBS") {
			return [
				'H' => 'dd-mm-yyyy',
				'W' => 'dd-mm-yyyy',
			];
		} elseif ($this->testName == "Server_Confidential") {
			return [
				'H' => 'dd-mm-yyyy',
				'N' => 'dd-mm-yyyy',
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
