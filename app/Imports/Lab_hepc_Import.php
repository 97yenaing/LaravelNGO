<?php

namespace App\Imports;

use App\Models\LabHbcTest;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_hepc_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table="General";
        return new LabHbcTest([

          'clinic code'            =>$row[0],
          'CID'                    =>$row[1],
          'fuchiacode'             =>$row[2],
          'agey'                   =>$row[3],
          'agem'                   =>$row[4],
          'Gender'                 =>Crypt::encrypt_light($row[5],$table),
          'Visit_date'             =>$row[6],
          'Requested Doctor old'   =>Crypt::encrypt_light($row[7],$table),
          'Requested Doctor new'   =>Crypt::encrypt_light($row[8],$table),
          'tdate'                  =>$row[9],
          'Patient_Type'           =>Crypt::encrypt_light($row[10],$table),
          'Patient Type Sub'       =>Crypt::encrypt_light($row[11],$table),
          'Hiv status'             =>Crypt::encrypt_light($row[12],$table),
          'HepB Test'              =>Crypt::encrypt_light($row[13],$table),
          'HepB TOT'               =>Crypt::encrypt_light($row[14],$table),
          'HepB Result'            =>Crypt::encrypt_light($row[15],$table),
          'HepC Test'              =>Crypt::encrypt_light($row[16],$table),
          'HepC TOT'               =>Crypt::encrypt_light($row[17],$table),
          'HepC Result'            =>Crypt::encrypt_light($row[18],$table),
          'Lab Tech'               =>Crypt::encrypt_light($row[19],$table),
          'Issue Date'             =>$row[20],
          'Visit ID'               =>$row[21],
        ]);
    }
}
