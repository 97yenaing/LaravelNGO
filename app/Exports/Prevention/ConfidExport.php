<?php

namespace App\Exports\Prevention;



//use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Export_age;
//class ReceptionExport implements FromQuery,   WithHeadings

use Carbon\Carbon;

class ConfidExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{

  private $data0;
  private $tableName;
  private $visit_date;

  public function __construct($data0, $visit_date, $tableName)
  {
    $this->data0 = $data0;
    $this->tableName = $tableName;
    $this->visit_date = $visit_date;
  }
  public function collection()
  {
    $tb = $this->tableName;
    if ($tb == "confid") {
      $encrypted_columns = [
        'Name',
        'Father',
        'Region',
        'Township',
        'Quarter',
        'Phone',
        'Phone2',
        'Phone3',
        'Date Of Birth',
      ];
      $small_encrypt = [
        'Gender',
        'Main Risk',
        'Sub Risk',
        'Former Risk',
      ];
      $confid_date = [
        'Reg Date',
        'Risk Change_Date',

      ];

      $decrypted_data = $this->data0->map(function ($user) use ($encrypted_columns, $small_encrypt, $confid_date) {
        $general = "General";
        $user = Export_age::Export_general($user, $this->visit_date, $user->{"Date of Birth"}, $user);

        foreach ($encrypted_columns as $column) {
          // Decrypt the "Name" column from the related model
          if (!empty($user->{$column})) {
            // Decrypt the "Name" column from the related model
            $user->{$column} = Crypt::decryptString($user->{$column});
          } else {
            // Set a default value when the "Name" column is null or empty
            $user->{$column} = "";
          }
        }
        foreach ($small_encrypt as $s_column) {
          // Decrypt the "Name" column from the related model
          if ($user->{$s_column} !== null) {
            // Decrypt the "Name" column from the related model
            $user->{$s_column} = Crypt::decrypt_light($user->{$s_column}, $general);
            $user->{$s_column} = Crypt::codeBook($user->{$s_column}, 'encode');
          } else {
            // Set a default value when the "Name" column is null or empty

            $user->{$s_column} = "";
          }
        }

        foreach ($confid_date as $date) {
          $dateString = $user->{$date};
          // Check if $dateString is not empty
          if (!empty($dateString)) {
            // Parse the date from 'YYYY-mm-dd' to Carbon date object
            $carbonDate = Carbon::createFromFormat('Y-m-d', $dateString);
            // Format it as 'dd-mm-yyyy' and update the user1 object
            $ddString = $carbonDate->format('d-m-Y');

            $carbonDate = Carbon::createFromFormat('d-m-Y', $ddString); // Assuming you have a Carbon instance
            $user->{$date} = Date::dateTimeToExcel($carbonDate->startOfDay()); // Convert to Excel-compatible date

          }
        }
        return $user;
      });
      return $decrypted_data;
    }
  }
  public function map($row): array
  {
    return [
      $row['He_code'],
      $row['Clinic Code'],
      $row['Reg year'],
      $row['Pid'],
      $row['FuchiaID'],
      $row['PrEPCode'],
      $row['Reg Date'],
      $row['Register Agey'],
      $row['Register Agem'],
      $row['Current Agey'],
      $row['Current Agem'],
      $row['Gender'],
      $row['Former Risk'],
      $row['Risk changed'],
      $row['Risk Change_Date'],
      $row['Name'],
      $row['Father'],
      $row['Main Risk'],
      $row['Sub Risk'],
      $row['Region'],
      $row['Township'],
      $row['Quarter'],
      $row['Phone'],
      $row['Phone2'],
      $row['Phone3'],
    ];
  }
  public function headings(): array
  {
    return [
      'He Code',
      'Clinic Code',
      'Register Year',
      'Pid',
      'Fuchia ID',
      'PrEP Code',
      'Register Date',
      'Register Agey',
      'Register Age month',
      'Current Age',
      'Current Age month',
      'Sex',
      'Initial Risk',
      'Risk changed',
      'Risk changed Date',
      'Name',
      'Father',
      'Main Risk(Current Risk)',
      'Sub Risk',
      'Region',
      'Township',
      'Quarter',
      'Phone',
      'Phone2',
      'Phone3',
    ];
  }

  public function chunkSize(): int
  {
    return 5000; // Process 1,000 rows at a time
  }
  public function columnFormats(): array
  {
    return [
      'O' => 'dd-mm-yyyy',
      'G' => 'dd-mm-yyyy',
    ];
  }

  public function columnWidths(): array
  {
    $columns = [];
    foreach (range('A', 'Z') as $char) {
      $columns[] = $char;
    }
    return array_fill_keys($columns, 15);
  }
}// class end
