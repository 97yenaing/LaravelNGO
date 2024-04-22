<?php

namespace App\Imports;

use App\Models\LabCovidTest;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_covid_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    
        return new LabCovidTest([
          'CID'                           =>$row[0],
          'fuchiacode'                    =>$row[1],
          'agey'                          =>$row[2],
          'agem'                          =>$row[3],
          'Gender'                        =>Crypt::encrypt_light($row[4],$table),
          'Requested Doctor'              =>Crypt::encrypt_light($row[5],$table),
          'visit_date'                    =>$row[6],
          'Patient Type'                  =>Crypt::encrypt_light($row[7],$table),
          'Patient Type Sub'              =>Crypt::encrypt_light($row[8],$table),
          'Clinic'                        =>Crypt::encrypt_light($row[9],$table),
          'co_Age'                        =>Crypt::encrypt_light($row[10],$table),
          'type_of_patient_covid'         =>Crypt::encrypt_light($row[11],$table),
          'specimen_type'                 =>Crypt::encrypt_light($row[12],$table),
          'co_test_type'                  =>Crypt::encrypt_light($row[13],$table),
          'covid_result'                  =>Crypt::encrypt_light($row[14],$table),
          'covid_lab_tech'                =>Crypt::encrypt_light($row[15],$table),
          'covid_issue_date'              =>$row[16],
        ]);
    }
}
