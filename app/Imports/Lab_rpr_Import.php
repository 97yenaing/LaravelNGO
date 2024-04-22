<?php

namespace App\Imports;

use App\Models\Rprtest;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_rpr_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table="General";
        return new Rprtest([
          'clinic code'      =>$row[0],
          'pid'              =>$row[1],
          'visit_date'       =>$row[2],
          'fuchiacode'       =>$row[3],
          'agey'             =>$row[4],
          'agem'             =>$row[5],
          'Gender'           =>Crypt::encrypt_light($row[6],$table),
          'Type Of Patient'  =>Crypt::encrypt_light($row[7],$table),
          'Patient Type Sub' =>Crypt::encrypt_light($row[8],$table),
          'RDT(Yes/No)'      =>Crypt::encrypt_light($row[9],$table),
          'RDT Result'       =>Crypt::encrypt_light($row[10],$table),
          'Quantitative(Yes/No)'=>Crypt::encrypt_light($row[11],$table),
          'RPR Qualitative'  =>Crypt::encrypt_light($row[12],$table),
          'Titre(current)'   =>Crypt::encrypt_light($row[13],$table),
          'Titre(Last)'      =>Crypt::encrypt_light($row[14],$table),
          'TitreLastDate'    =>$row[15],
          'Req Dr'           =>Crypt::encrypt_light($row[16],$table),
          'Counsellor'       =>Crypt::encrypt_light($row[17],$table),
          'Lab Tech'         =>Crypt::encrypt_light($row[18],$table),
          'Issue Date'       =>$row[19],
        ]);
    }
}
