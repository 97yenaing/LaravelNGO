<?php

namespace App\Exports\Reception;

use App\Models\Patients;
use App\Models\Followup_general;
use App\Models\PtConfig;

//use Maatwebsite\Excel\Concerns\FromQuery;

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
//class ReceptionExport implements FromQuery,   WithHeadings



class ReceptionExport implements FromView, WithColumnFormatting
{

	private $users;
	private $users1;
	private $users2;

	public function __construct($users, $users1, $users2)
	{
		$this->users = $users;
		$this->users1 = $users1;
		$this->users2 = $users2;
	}
	public function view(): View
	{
		$users1 = $this->users1;
		$users2 = $this->users2;
		return view('Reception.export_followup_tb', [
			'users' => $this->users,
			'users1' => $users1,
			'users2' => $users2,
		]);
	}

	public function columnFormats(): array
	{
		return [
			"L" => "d-m-yyyy",
			"AR" => "d-m-yyyy",
		];
	}
}// class end