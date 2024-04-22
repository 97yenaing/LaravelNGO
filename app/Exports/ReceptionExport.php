<?php

namespace App\Exports;

use App\Models\Patients;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\FromCollection;

// use Maatwebsite\Excel\Concerns\FromQuery;
// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\WithHeadings;

//class ReceptionExport implements FromQuery,   WithHeadings
class ReceptionExport implements FromCollection
{
  // use Exportable;
  // public function headings(): array
  //   {
  //       return [
  //           'id',
  //           'Clinic Code',
  //           'General ID',
  //           'FuchiaID',
  //           'PrEPCode',
  //           'Agey',
  //           'Agem',
  //           'Gender',
  //           'Reg Date',
  //           'Date of Birth',
  //           'Region',
  //           'Township',
  //           'Quarter',
  //           'Reason for Visit',
  //           'Sub Reason0',
  //           'Sub Reason1',
  //           'Main Risk',
  //           'Sub Risk',
  //           'Created at',
  //           'Updated at',
  //       ];
  //   }
  //
  // public function __construct(int $year)
  // {
  //     $this->year = $year;
  // }
  // public function query()
  // {
  //   return Patients::query()->whereYear('Reg Date', $this->year);
  //   }




  private $patients;

    public function __construct($patients)
    {
        $this->patients = $patients;
    }

    public function collection()
    {
        return $this->patients->map(function($patient) {
            $patient->name = Crypt::decryptString($patient->name);
            $patient->email = Crypt::decryptString($patient->email);

            $patient->Gender = Crypt::decrypt_light($patient->Gender);
            // $patient->Main Risk = Crypt::decrypt_light($patient->Main Risk);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);
            // $patient-> = Crypt::decrypt_light($patient->);

            // "Gender",
            // "Main Risk",
            // "Sub Risk",
            // "Patient Type",
            // "New_Old",
            // "Fever",
            // "Diagnosis",
            // "Support",
            // "Patient Type_1",
            // "New_Old_1",
            // "Fever_1",
            // "Diagnosis_1",
            // "Support_1",
            return $patient;
        });
    }
}
