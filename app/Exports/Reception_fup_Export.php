<?php

namespace App\Exports;

use App\Models\Followup_general;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Reception_fup_Export implements FromQuery, WithHeadings
{
  use Exportable;
  public function headings(): array
    {
        return [
            'id',
            'Clinic Code',
            'General ID',
            'FuchiaID',
            'PrEPCode',
            'Agey',
            'Agem',
            'Gender',
            'Visit Date',
            'Date of Birth',
            'Reason for Visit',
            'Sub Reason0',
            'Sub Reason1',
            'Main Risk',
            'Sub Risk',
            'New/Old',
            'Created at',
            'Updated at',
        ];
    }
  public function __construct(int $year)
  {
      $this->year = $year;
  }
  public function query()
  {
    return Followup_general::query()->whereYear('Visit Date', $this->year);
    }
}
