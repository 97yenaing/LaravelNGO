<?php

namespace App\Imports;

use App\Models\Viralload;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_viralLoad_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table ="General";

        return new Viralload([
          'Clinic'          =>$row[0],
          'CID'             =>$row[1],
          'fuchiacode'      =>$row[2],
          'agey'            =>$row[3],
          'agem'            =>$row[4],
          'Gender'          =>Crypt::encrypt_light($row[5],$table),
          'Main-Risk'       =>Crypt::encrypt_light($row[6],$table),
          'Sub-Risk'        =>Crypt::encrypt_light($row[7],$table),
          'Requested Dr'    =>Crypt::encrypt_light($row[8],$table),
          'ART_ini_date'    =>$row[9],
          'ART_duration'    =>$row[10],
          'Sample Ship Date'=>$row[11],
          'Sample Sent to'  =>Crypt::encrypt_light($row[12],$table),
          'Result received date' =>$row[13],
          'Viral Load Result'    =>Crypt::encrypt_light($row[14],$table),
          'Other org code'       =>Crypt::encrypt_light($row[15],$table),
          'Remark'               =>Crypt::encrypt_light($row[16],$table),

        ]);
    }
}
