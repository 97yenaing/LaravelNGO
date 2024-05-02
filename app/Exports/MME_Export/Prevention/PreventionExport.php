<?php

namespace App\Exports\MME_Export\Prevention;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;

class PreventionExport implements FromView, WithColumnFormatting
{
	private $prevention_records, $testName;
	public function __construct($prevention_records, $testName)
	{
		$this->prevention_records = $prevention_records;
		$this->testName = $testName;
	}

	public function view(): View
	{
		return view("MME.Export.Prevention." . $this->testName, [
			"prevention_records" => $this->prevention_records,
		]);
	}
	public function columnFormats(): array
	{
		if ($this->testName == "LogSheet") {
			return [
				'Q' => 'dd-mm-yyyy',
				'H' => 'dd-mm-yyyy',
				'I' => 'dd-mm-yyyy',
				'AJ' => 'dd-mm-yyyy',
				'AS' => 'dd-mm-yyyy',
			];
		} else if ($this->testName == "CBS") {
			return [
				'G' => 'dd-mm-yyyy',
				'V' => 'dd-mm-yyyy',
			];
		} elseif ($this->testName == "Server_Confidential") {
			return [
				'G' => 'dd-mm-yyyy',
				'M' => 'dd-mm-yyyy',
			];
		}
	}
}
