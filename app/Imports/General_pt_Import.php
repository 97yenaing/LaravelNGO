<?php

namespace App\Imports;

use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;

class General_pt_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table="General";

        return new Patients([
       
          'Clinic Code'       =>$row[0],
          'Reg Date'          =>$row[1],
          'Pid'               =>$row[2],
          'FuchiaID'          =>$row[3],
          'PrEPCode'          =>$row[4],
          'Agey'              =>$row[5],
          'Agem'              =>$row[6],
          'Gender'            =>Crypt::encrypt_light($row[7],$table),
          'Date Of Birth'     =>Crypt::encryptString($row[8]),//Encrypt
          'Main Risk'         =>Crypt::encrypt_light($row[9],$table),
          'Sub Risk'          =>Crypt::encrypt_light($row[10],$table),
          'Mode'              =>$row[11],
          "Former Risk"       =>Crypt::encryptString($row[12]),
          "Risk Change_Date"  =>$row[13],


         
        ]);
    }
}
