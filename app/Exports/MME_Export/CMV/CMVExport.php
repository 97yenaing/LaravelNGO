<?php

namespace App\Exports\MME_Export\CMV;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class CMVExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
	private $cmv_records;
	public function __construct($cmv_records)
	{
		$this->cmv_records =  $cmv_records;
	}

	public function collection()
	{
		return $this->cmv_records;
	}
	public function map($row): array
	{
		return [
			$row->getConnectionName(),
			$row['Clinic Code'],
			$row['Pid_cmv'],
			$row['FuchiaID'],
			$row['Gender'],
			$row['Reg year'],
			$row['Register Agey'],
			$row['Register Agem'],
			$row['Current Agey'],
			$row['Current Agem'],

			$row['Visit_date'],
			$row['Patient_Type'],
			$row['Art_Status'],
			$row['Symptom'],

			$row['Currnt_Art_Regime'],
			$row['Art_StartDate'],
			$row['Most_CD4'],
			$row['Recent_CD4Date'],
			$row['Symptom'],
			$row['Vision_Right'],
			$row['Vision_Left'],
			$row['Finding_Right'],
			$row['Finding_Rdx'],
			$row['Finding_Left'],
			$row['Finding_Ldx'],
			$row['Treatment_Right'],
			$row['Treatment_Left'],
			$row['Doctor_name'],
			$row['Org'],
			$row['Remark'],
		];
	}
	public function headings(): array
	{
		return [
			'Database',
			'Clinic Code',
			'General ID',
			'Fuchia ID',
			'Sex',
			'Reg Year',
			'Register Age',
			'Register Age(Month)',
			'Current Age',
			'Current Age(Month)',
			'Visit_date',
			'Types of patients',
			'ART status(Yes/No)',
			'Symptom',
			'Current ART Regime',
			'Current ART started date',
			'Most recent CD4',
			'Most recent CD4 date',
			'Right Eye',
			'Left Eye',
			'Right eye Diagnosis',
			'Type of Dx (Right)',
			'Left eye Diagnosis',
			'Type of Dx (Left)',
			'Right eye',
			'Left eye',
			'Eye Doctor',
			'Organization',
			'Remark',

		];
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
		return array_fill_keys($columns, 15);
	}
	public function columnFormats(): array
	{
		return [
			"K" => "d-m-yyyy",
			"P" => "d-m-yyyy",
			"R" => "d-m-yyyy"
		];
	}
}
