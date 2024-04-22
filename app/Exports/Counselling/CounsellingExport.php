<?php

namespace App\Exports\Counselling;

use App\Models\Patients;
use App\Models\Followup_general;
use App\Models\PtConfig;

//use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
//class ReceptionExport implements FromQuery,   WithHeadings



class CounsellingExport implements FromView, WithColumnFormatting
{

  private $users;private $users1; private $hts_coul;

   public function __construct($users1,$hts_coul)
   {
        $this->users1 = $users1;
        $this -> hts_coul = $hts_coul;
   }
   public function view(): View
   {
     if($this-> hts_coul == "counsel_data"){
      
       return view('Counsellor.export', [
          'users1'=> $this->users1,
       ]);
     }

     else if($this-> hts_coul == "hts_data"){
      return view('Counsellor.export1', [
          'users1'=>$this->users1,
      ]);
    }
   }
   public function columnFormats(): array
   {  if($this-> hts_coul == "counsel_data"){
       return [
           "M"=>"d-m-yyyy",
       ];
      }else{
        return [
          "J"=>"d-m-yyyy",
          "T"=>"d-m-yyyy",
          "Y"=>"d-m-yyyy",
          "AC"=>"d-m-yyyy",
          
      ];
      }
   }



}// class end
