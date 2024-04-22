<?php

namespace App\Exports;

use App\Models\LabAfbTest;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Lab_afb_Export implements FromQuery,   WithHeadings
{
  use Exportable;
  public function headings(): array
    {
        return [
          'id',
          'Clinic Code'          ,
          'General ID'                  ,
          'Fuchia ID'           ,
          'Age(Y)'                 ,
          'Age(M)'                 ,
          'Gender'               ,
          'Requested Doctor'     ,
          'Visit Date'           ,
          'Main Risk'         ,
          'Sub Risk'     ,
          'Patient Name'          ,
          'Address'       ,
          'Previous TB'          ,
          'HIV Status'           ,
          'Reason for Exam'      ,
          'AFB Pt Type'          ,
          'Follow Up Month'         ,
          'Speci Type'           ,
          'Other Speci Type'           ,
          'slide_num_1'          ,
          'speci_receive_dt1'    ,
          'Visual app 1'         ,
          'AFB Result 1'          ,
          'Slide 1 Grading'      ,
          'Speci received date'    ,
          'Visual app 2'         ,
          'AFB result 2'          ,
          'Slide 2 Grading'      ,
          'Lab Techanician'       ,
          'Issue Date'       ,
        ];
    }

  public function __construct(int $year)
  {
      $this->year = $year;
  }
  public function query()
  {
    return LabAfbTest::query()->whereYear('visit_date', $this->year);
    }
}
