<?php

namespace App\Imports;

use App\Models\Coulselling;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_hts_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table="General";
        return new Coulselling([

          'Clinic code'           =>$row[0],
          'Pid'                   =>$row[1],
          "FuchiaID"              =>$row[2],
          "Gender"                =>Crypt::encrypt_light($row[3],$table),
          "Age"                   =>$row[4],
          "Counsellor"            =>Crypt::encrypt_light($row[5],$table),
          "Pre"                   =>Crypt::encrypt_light($row[6],$table),
          "Post"                  =>Crypt::encrypt_light($row[7],$table),
          "Service_Modality"      =>Crypt::encrypt_light($row[8],$table),
          "Mode of Entry"         =>Crypt::encrypt_light($row[9],$table),
          'New_Old'               =>Crypt::encrypt_light($row[10],$table),
          "Counselling_Date"      =>$row[11],
          "Main Risk"             =>Crypt::encrypt_light($row[12],$table),
          'Sub Risk'              =>Crypt::encrypt_light($row[13],$table),
          'HIV_Test_Date'         =>$row[14],
          'HIV_Test_Determine'    =>Crypt::encrypt_light($row[15],$table),
          'HIV_Test_UNI'          =>Crypt::encrypt_light($row[16],$table),
          'HIV_Test_STAT'         =>Crypt::encrypt_light($row[17],$table),
          'HIV_Final_Result'      =>Crypt::encrypt_light($row[18],$table),
          'Syp_Test_Date'         =>$row[19],
          'Syphillis_RDT'         =>Crypt::encrypt_light($row[20],$table),
          'Syphillis_RPR'         =>Crypt::encrypt_light($row[21],$table),
          'Syphillis_VDRL'        =>Crypt::encrypt_light($row[22],$table),
          'Hep_Test_Date'         =>$row[23],
          'Hepatitis_B'           =>Crypt::encrypt_light($row[24],$table),
          'Hepatitis_C'           =>Crypt::encrypt_light($row[25],$table),
//26
        ]);
    }
}
