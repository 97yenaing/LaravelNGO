<?php

namespace App\Imports;

use App\Models\LabGeneralTest;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_general_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table="General";
        return new LabGeneralTest([


          'clinic code'           =>$row[0],
          'CID'                   =>$row[1],
          'fuchiacode'            =>$row[2],
          'agey'                  =>$row[3],
          'agem'                  =>$row[4],
          'Gender'                =>Crypt::encrypt_light($row[5],$table),
          'Visit_date'            =>$row[6],
          'Requested Doctor old'  =>Crypt::encrypt_light($row[7],$table),
          'Requested Doctor new'  =>Crypt::encrypt_light($row[8],$table),
          'Patient_Type'          =>Crypt::encrypt_light($row[9],$table),
          'Patient Type Sub'      =>Crypt::encrypt_light($row[10],$table),
          'Dangue RDT'            =>Crypt::encrypt_light($row[11],$table),
          'NS1 Antigen'           =>Crypt::encrypt_light($row[12],$table),
          'IgG Result'            =>Crypt::encrypt_light($row[13],$table),
          'IgM Result'            =>Crypt::encrypt_light($row[14],$table),
          'Malaria RDT'           =>Crypt::encrypt_light($row[15],$table),
          'Malaria RDT Result'    =>Crypt::encrypt_light($row[16],$table),
          'Malaria_spec'          =>Crypt::encrypt_light($row[17],$table),
          'Malaria_grade'         =>Crypt::encrypt_light($row[18],$table),
          'Malaria_stage'         =>Crypt::encrypt_light($row[19],$table),
          'malaria_microscopy'    =>Crypt::encrypt_light($row[20],$table),
          'Malaria Microscopy Result'=>Crypt::encrypt_light($row[21],$table),
          'RBS test'              =>Crypt::encrypt_light($row[22],$table),
          'RBS'                   =>Crypt::encrypt_light($row[23],$table),
          'FBS test'              =>Crypt::encrypt_light($row[24],$table),
          'FBS'                   =>Crypt::encrypt_light($row[25],$table),
          'haemo_done'            =>Crypt::encrypt_light($row[26],$table),
          'haemoglobin'           =>Crypt::encrypt_light($row[27],$table),
          'hba1c'                 =>Crypt::encrypt_light($row[28],$table),
          'Lab Tech'              =>Crypt::encrypt_light($row[29],$table),
          'Issue Date'            =>$row[30],

        ]);
    }
}
