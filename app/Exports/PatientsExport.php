<?php

namespace App\Exports;

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
//class ReceptionExport implements FromQuery,   WithHeadings



class PatientsExport implements FromView
{

  private $users;private $users1;

   public function __construct($users,$users1)
   {
        $this->users = $users;
        $this->users1 = $users1;
       //$this->users2 = $users2;

   }

   public function view(): View
   {
       $encrypted_columns = [
         "Gender",
         "Main Risk",
         "Sub Risk",
         "Patient Type",
          "New_Old",
          "Diagnosis",
          "Fever",
          "Support",
          "Patient Type_1",
          "New_Old_1",
          "Diagnosis_1",
          "Fever_1",
          "Support_1",
     ];
    //  $encrypted_columns1 = [
    //
    //    //"Diagnosis_1",
    // ];

       $users_treated = $this->users->map(function($user) use ($encrypted_columns) {
           foreach($encrypted_columns as $column) {
               $user->{$column} = Crypt::decrypt_light($user->{$column},"General");
           }
           return $user;
       });

       $users1 = $this->users1;

       // $users2 = $this->users2->map(function($user2) use ($encrypted_columns1) {
       //     foreach($encrypted_columns1 as $column2) {
       //         $user2->{$column2} = Crypt::decrypt_light($user2->{$column2},"General");
       //     }
       //     return $user2;
       // });
       return view('Reception.patients', [
           'users' => $users_treated,
           'users1'=> $users1,
           //'users2'=> $users2,
       ]);
   }

// public function view(): View
//    {
//
//        return view('Reception.patients');
//    }

}// class end
