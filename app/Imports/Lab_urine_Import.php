<?php

namespace App\Imports;

use App\Models\Urine;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_urine_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table ="General";

        

        return new Urine([
          'visitDate'         =>$row[0],
          'ClinicName'        =>$row[1],
          'CID'               =>$row[2],
          'fuchiacode'        =>$row[3],
          'agey'              =>$row[4],
          'agem'              =>$row[5],
          'Gender'            =>Crypt::encrypt_light($row[6],$table),
          'Requested Dr'      =>Crypt::encrypt_light($row[7],$table),
          'Main Risk'         =>Crypt::encrypt_light($row[8],$table),
          'Sub Risk'          =>Crypt::encrypt_light($row[9],$table),
          'Utest_done'        =>Crypt::encrypt_light($row[10],$table),
          'Utot'              =>Crypt::encrypt_light($row[11],$table),
          'Ucolor'            =>Crypt::encrypt_light($row[12],$table),
          'Uapp'              =>Crypt::encrypt_light($row[13],$table),
          'tubitity'          =>Crypt::encrypt_light($row[14],$table),
          'Upus'              =>Crypt::encrypt_light($row[15],$table),
          'ph'                =>Crypt::encrypt_light($row[16],$table),
          'Uprotein'          =>Crypt::encrypt_light($row[17],$table),
          'Uglucose'          =>Crypt::encrypt_light($row[18],$table),
          'Urbc'              =>Crypt::encrypt_light($row[19],$table),
          'Uleu'              =>Crypt::encrypt_light($row[20],$table),
          'Unitrite'          =>Crypt::encrypt_light($row[21],$table),
          'Uketone'           =>Crypt::encrypt_light($row[22],$table),
          'Uepithelial'       =>Crypt::encrypt_light($row[23],$table),
          'Urobili'           =>Crypt::encrypt_light($row[24],$table),
          'Ubillru'           =>Crypt::encrypt_light($row[25],$table),
          'Uery'              =>Crypt::encrypt_light($row[26],$table),
          'Ucrystal'          =>Crypt::encrypt_light($row[27],$table),
          'Uhae'              =>Crypt::encrypt_light($row[28],$table),
          'Uother'            =>Crypt::encrypt_light($row[29],$table),
          'Ucast'             =>Crypt::encrypt_light($row[30],$table),
          'comment'           =>Crypt::encrypt_light($row[31],$table),
          'lab_tech'          =>Crypt::encrypt_light($row[32],$table),
          'issue_date'        =>$row[33],
          'Cretinine'         =>Crypt::encrypt_light($row[34],$table),
          'Albumin'           =>Crypt::encrypt_light($row[35],$table),
          'A:C_ratio'         =>Crypt::encrypt_light($row[36],$table),

        ]);
    }
}
