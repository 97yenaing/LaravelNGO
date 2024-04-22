<?php

namespace App\Imports;

use App\Models\LabStoolTest;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_stool_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      Crypt::encrypt_light($row[5],$table),
        return new LabStoolTest([
          'CID'               =>$row[0],
          'fuchiacode'        =>$row[1],
          'agey'              =>$row[2],
          'agem'              =>$row[3],
          'Gender'            =>Crypt::encrypt_light($row[4],$table),
          'Clinic'            =>$row[5],
          'Requested Doctor'  =>Crypt::encrypt_light($row[6],$table),
          'visit_date'        =>$row[7],
          'Patient Type'      =>Crypt::encrypt_light($row[8],$table),
          'Patient Type Sub'  =>Crypt::encrypt_light($row[9],$table),
          'st_stool'          =>Crypt::encrypt_light($row[10],$table),
          'st_colour'         =>Crypt::encrypt_light($row[11],$table),
          'wbc_pus_cell'      =>Crypt::encrypt_light($row[12],$table),
          'st_consistency'    =>Crypt::encrypt_light($row[13],$table),
          'st_rbcs'           =>Crypt::encrypt_light($row[14],$table),
          'st_other'          =>Crypt::encrypt_light($row[15],$table),
          'st_comment'        =>Crypt::encrypt_light($row[16],$table),
          'st_lab_tech'       =>Crypt::encrypt_light($row[17],$table),
          'st_issue_date'     =>$row[18],
        ]);
    }
}
