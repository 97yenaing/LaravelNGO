<?php

namespace App\Imports;

use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;

class General_confid_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table="General";
        return new PtConfig([
        //return new Patients([
       // return new Followup_general([
          //This block is for confid

         'Clinic Code'       =>$row[0],
          'Reg Date'          =>$row[1],
          'Pid'               =>$row[2],
          'FuchiaID'          =>$row[3],
          'PrEPCode'          =>$row[4],
          'Name'              =>Crypt::encryptString($row[5]),//Encrypt
          'Father'            =>Crypt::encryptString($row[6]),//Encrypt
          'Agey'              =>$row[7],
          'Agem'              =>$row[8],
          'Gender'            =>Crypt::encrypt_light($row[9],$table),
         
          'Date Of Birth'     =>Crypt::encryptString($row[10]),//Encrypt
          'Region'            =>Crypt::encryptString($row[11]),//Encrypt
          'Township'          =>Crypt::encryptString($row[12]),//Encrypt
          'Quarter'           =>Crypt::encryptString($row[13]),//Encrypt
         
          'Main Risk'         =>Crypt::encrypt_light($row[14],$table),
          'Sub Risk'          =>Crypt::encrypt_light($row[15],$table),
          // 'Main Risk'         =>Crypt::decryptString($row[14]),
          // 'Sub Risk'          =>Crypt::decryptString($row[15]),
          'Phone'             =>Crypt::encryptString($row[16]),//Encrypt
          'Phone2'            =>Crypt::encryptString($row[17]),//Encrypt
          'Phone3'            =>Crypt::encryptString($row[18]),//Encrypt
          'Mode'              =>$row[19],

          "Former Risk"       =>Crypt::encryptString($row[20]),

          "Risk Change_Date"  =>$row[21],

          //
          // 'Clinic Code'       =>$row[0],
          // 'Reg Date'          =>$row[1],
          // 'Pid'               =>$row[2],
          // 'FuchiaID'          =>$row[3],
          // 'PrEPCode'          =>$row[4],
          // 'Agey'              =>$row[5],
          // 'Agem'              =>$row[6],
          // 'Gender'            =>$row[7],
          // 'Date Of Birth'     =>$row[8],
          // 'Main Risk'         =>Crypt::encrypt_light($row[9],$table),
          // 'Sub Risk'          =>Crypt::encrypt_light($row[10],$table),
          // 'Mode'              =>$row[11],


          // "Clinic Code"            =>$row[0],
          // 'Visit Date'             =>$row[1],
          // "Pid"                    =>$row[2],
          // "FuchiaID"               =>$row[3],
          // "PrEPCode"               =>$row[4],
          // "Agey"                   =>$row[5],
          // "Agem"                   =>$row[6],
          // "Gender"                 =>$row[7],

          // "Main Risk"              =>$row[8],
          // "Sub Risk"               =>$row[9],

          // "Patient Type"           =>$row[10],
          // "New_Old"                =>$row[11],
          // "Fever"                  =>$row[12],
          // "Diagnosis"              =>$row[13],
          // "Support"                =>$row[14],

          // "Patient Type_1"         =>$row[15],
          // "New_Old_1"              =>$row[16],
          // "Fever_1"                =>$row[17],
          // "Diagnosis_1"            =>$row[18],
          // "Support_1"              =>$row[19],

          // 'Mode'                  =>$row[20],
          // "Next Appointment Date" =>$row[21],
          // 'Unplan'                =>$row[22],

        ]);
    }
}
