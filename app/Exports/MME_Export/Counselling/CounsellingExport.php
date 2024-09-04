<?php

namespace App\Exports\MME_Export\Counselling;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class CounsellingExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
	private $counselling_records, $testName;
	public function __construct($counselling_records, $testName)
	{
		$this->counselling_records = $counselling_records;
		$this->testName = $testName;
	}
	public function collection()
	{
		return $this->counselling_records;
	}
	public function map($row): array
	{
		if ($this->testName == "Counselling_Export") {
			return [
				$row->getConnectionName(),
				$row["Clinic Code"],
				$row["Pid"],
				$row["FuchiaID"],
				$row["PrEPCode"],

				$row["Gender"],
				$row["Reg year"],
				$row["Register Agey"],

				$row["Register Agem"],

				$row["Current Agey"],

				$row["Current Agem"],

				$row["Main Risk"],
				$row["Sub Risk"],
				$row["Counselling_Date"],


				$row["Counsellor"],
				$row["HTSdone"],
				$row["Reason"],
				$row["Status"],

				$row["PrEP"],

				$row["PrEP Status"],

				$row["Pre"],
				$row["Post"],
				$row["C1"],
				$row["C2"],
				$row["c2_done"],
				$row["C3"],
				$row["ADH"],
				$row["stable"],

				$row["Child under15 Dis"],
				$row["Child under15 ADH"],
				$row["MMT"],
				$row["IPT"],
				$row["TB"],
				$row["NCD"],
				$row["ANC"],
				$row["PFA"],
				$row["PHQ9"],
				$row["Other"],
				$row["EAC"],
				$row["HMT"],
				$row["C P case"],
				$row["PMTCT"],
				$row["phq4"],
				$row["gad7"],
				$row["brest_cancer"],
				$row["hepC"],
				$row["art_ost"],
				$row["d1"],
				$row["d2"],
				$row["d3"],
				$row["d4"],
				$row["cage"],
			];
		} else {
			return [
				$row->getConnectionName(),
				$row['Clinic Code'],
				$row["Pid"],
				$row["FuchiaID"],
				$row["Gender"],
				$row["Reg year"],
				$row["Register Agey"],
				$row["Register Agem"],
				$row["Current Agey"],
				$row["Current Agem"],
				$row["Counselling_Date"],
				$row["Counsellor"],
				$row["Pre"],
				$row["Post"],
				$row["Service_Modality"],
				$row["Mode of Entry"],
				$row["New_Old"],
				$row["Test_Location"],
				$row["Main Risk"],
				$row["Sub Risk"],
				$row["HIV_Test_Date"],
				$row["HIV_Test_Determine"],
				$row["HIV_Test_UNI"],
				$row["HIV_Test_STAT"],
				$row["HIV_Final_Result"],
				$row["Syp_Test_Date"],
				$row["Syphillis_RDT"],
				$row["Syphillis_RPR"],
				$row["Syphillis_VDRL"],
				$row["Hep_Test_Date"],
				$row["Hepatitis_B"],
				$row["Hepatitis_C"],
				$row["Req_Doctor"],
			];
		}
	}
	public function headings(): array
	{
		if ($this->testName == "Counselling_Export") {
			return [
				'Database',
				'Clinic Code',
				'Pid',
				'FuchiaID',
				'PrEP_ID',
				'Gender',
				'Reg Year',
				'Register Age',
				'Register Age(Month)',
				'Current Age',
				'Current Age(Month)',
				'Main Risk',
				'Sub Risk',
				'Counselling Date',
				'Counselor',
				'HTS done',
				'Reason',
				'Status',
				'PrEP',
				'PrEP Status',
				'Pre',
				'Post',
				'C1',
				'C2',
				'C2_Done',

				'C3',
				'ADH',
				'Stable',
				'< 15 Disclosure',
				'< 5 ADH',
				'OST',
				'ART+TB/TPT',
				'Only TB',
				'NCD',
				'ANC',
				'PFA',
				'PHQ9',
				'Other',
				'EAC',
				'FHT',
				'C P case',
				'PMTCT',
				'PHQ4',
				'GAD7',
				'Brest Cancer',
				'Hep C',
				'ART+OST',
				'D1',
				'D2',
				'D3',
				'D4',
				'CAGE',
			];
		} else {
			return [
				'Database',
				'Clinic Code',
				'Pid',
				'FuchiaID',
				'Gender',
				'Register Year',
				'Register Age',
				'Register Age(Month)',
				'Current Age',
				'Current Age(Month)',
				'Counselling Date',
				'Counselor',
				'Pre',
				'Post',
				'Service Modality',
				'Mode of Entry',
				'New_Old',
				'Test Location',
				'Main Risk',
				'Sub Risk',
				'HIV Test Date',
				'HIV Test Determine',
				'HIV Test UNI',
				'HIV Test STAT',
				'HIV Final Result',
				'Syphillis Test Date',
				'Syphillis RDT',
				'Syphillis RPR',
				'Syphillis VDRL',
				'HepB/C Test Date',
				'Hepatitis B',
				'Hepatitis C',
				'Request MD',
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
		if ($this->testName == "Counselling_Export") {
			return [
				"N" => "d-m-yyyy",
			];
		} else {
			return [
				"K" => "d-m-yyyy",
				"U" => "d-m-yyyy",
				"Z" => "d-m-yyyy",
				"AD" => "d-m-yyyy",
			];
		}
	}
}
