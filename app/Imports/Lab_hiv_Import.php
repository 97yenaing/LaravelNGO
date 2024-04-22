<?php

namespace App\Imports;

use App\Models\Lab;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_hiv_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table ="General";
        return new Lab([
          'ClinicName'                    =>$row[0],
          'CID'                           =>$row[1],
          'fuchiacode'                    =>$row[2],
          'agey'                          =>$row[3],
          'agem'                          =>$row[4],
          'Gender'                        =>Crypt::encrypt_light($row[5],$table),
          'Patient_Type'                  =>Crypt::encrypt_light($row[6],$table),
          'Patient Type Sub'              =>Crypt::encrypt_light($row[7],$table),
          'Visit_date'                    =>$row[8],
          'vdate'                         =>$row[8],
          'bcollectdate'                  =>$row[9],
          'Detmine_Result'                =>Crypt::encrypt_light($row[10],$table),
          'Unigold_Result'                =>Crypt::encrypt_light($row[11],$table),
          'STAT_PAK_Result'               =>Crypt::encrypt_light($row[12],$table),
          'Final_Result'                  =>Crypt::encrypt_light($row[13],$table),
          'Req_Doct'                      =>Crypt::encrypt_light($row[14],$table),
          'Counsellor'                    =>Crypt::encrypt_light($row[15],$table),
          //'LabTech'                       =>Crypt::encrypt_light($row[17],$table),
          //'Incon'                         =>$row[18],
        ]);
    }
}
