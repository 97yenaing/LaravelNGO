<?php

namespace App\Imports;

use App\Models\PtConfig;
use App\Models\Patients;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class GeneralImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return PtConfig|null
     */
    public function model(array $row)
    {
        return new PtConfig([
          
           //'name'     => $row[0],
           //'email'    => $row[1],
           //'password' => Hash::make($row[2]),
           'Clinic Code'       =>$row[0],
           'Pid'               =>$row[1],
           'FuchiaID'          =>$row[2],
           'Name'              =>Crypt::encryptString($row[3]),
           'Father'            =>Crypt::encryptString($row[4]),
           'Agey'              =>$row[5],
           'Agem'              =>$row[6],
           'Gender'            =>$row[7],
           'Reg Date'          =>$row[8],
           'Date Of Birth'     =>$row[9],
           'Region'            =>$row[10],
           'Township'          =>$row[11],
           'Quarter'           =>$row[12],
           "Patient Type"      =>$row[13],
           "Patient Type Sub"  =>$row[14],
           "Patient Type Sub1" =>$row[15],
           'Main Risk'         =>$row[16],
           'Sub Risk'          =>$row[17]
        ]);
    }
}
