<?php

namespace App\Exports\Counselling;

use Maatwebsite\Excel\Concerns\FromCollection;

class MentalExport implements FromCollection
{
  public function collection()
  {
    return collect([]);
  }
}
