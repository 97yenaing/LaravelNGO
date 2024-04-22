<?php

namespace App\Imports;

use App\Models\Lab_oi;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_oi_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table="General";
        return new Lab_oi([
          'clinic code'               =>$row[0],
          'CID'                       =>$row[1],
          'fuchiacode'                =>$row[2],
          'agey'                      =>$row[3],
          'agem'                      =>$row[4],
          'Gender'                    =>Crypt::encrypt_light($row[5],$table),
          'Requested Doctor'          =>Crypt::encrypt_light($row[6],$table),
          'Requested Doctor_New'      =>Crypt::encrypt_light($row[7],$table),
          'visit_date'                =>$row[8],
          'TB_LAM_Report'             =>Crypt::encrypt_light($row[9],$table),
          'Toxo plasma'               =>Crypt::encrypt_light($row[10],$table),
          'Serum Result'              =>Crypt::encrypt_light($row[11],$table),
          'Toxo igG'                  =>Crypt::encrypt_light($row[12],$table),
          'Toxo igM'                  =>Crypt::encrypt_light($row[13],$table),
          'serum_pos'                 =>Crypt::encrypt_light($row[14],$table),
          'CSF for Cryptococcal Antigen'=>Crypt::encrypt_light($row[15],$table),
          'csf_crypto_pos'              =>Crypt::encrypt_light($row[16],$table),
          'csf_fungal'                  =>Crypt::encrypt_light($row[17],$table),
          'CSF Smear Giemsa Stain'      =>Crypt::encrypt_light($row[18],$table),
          'CSF Smear India Ink'         =>Crypt::encrypt_light($row[19],$table),
          'skin_fungal'                 =>Crypt::encrypt_light($row[20],$table),
          'Skin Smear Giemsa Stain'     =>Crypt::encrypt_light($row[21],$table),
          'lymph India Ink'             =>Crypt::encrypt_light($row[22],$table),
          'Skin Smear India Ink'        =>Crypt::encrypt_light($row[23],$table),
          'sample_type'                 =>Crypt::encrypt_light($row[24],$table),
          'lymph Giemsa Stain'          =>Crypt::encrypt_light($row[25],$table),
          'Lab Techanician'             =>Crypt::encrypt_light($row[26],$table),
          'issued'                      =>$row[27],
          
        ]);
    }
}
