<?php
namespace App\Imports;
use App\Models\Rprtest;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;


class RprlabresultsImport implements ToModel
{
    
    public function model(array $row)
    {
        return new Rprtest([
          'pid'                           =>$row[0],
          'visit_date'                    =>$row[1],
          'fuchiacode'                    =>$row[2],
          'agey'                          =>$row[3],
          'agem'                          =>$row[4],
          'Gender'                        =>$row[5],
          'RPR Qualitative'               =>$row[6],
          'Type Of Patient'               =>$row[7],
          'Patient Type Sub'              =>$row[8],
          'Pregnant Mother Sub'           =>$row[9],
          'Spouse of Pregnant Mother Sub' =>$row[10],
          'Exposed children sub'          =>$row[11],
          'Partner of KP sub'             =>$row[12],
          'FSW Sub'                       =>$row[13],
          'MSM Sub'                       =>$row[14],
          'TG Sub'                        =>$row[15],
          'IDU Sub'                       =>$row[16],
          'Low Risk Sub'                  =>$row[17],
          'Special Group Sub'             =>$row[18],
          'RDT(Yes/No)'                   =>$row[19],
          'RDT Result'                    =>$row[20],
          'Quantitative(Yes/No)'          =>$row[21],
          'Qualitative(Yes/No)'           =>$row[22],
          'Titre(current)'                =>$row[23],
          'Titre(Last)'                   =>$row[24],
        ]);
    }
}
