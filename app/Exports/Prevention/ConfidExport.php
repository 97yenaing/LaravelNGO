<?php

namespace App\Exports\Prevention;



//use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Export_age;
use Illuminate\Support\Arr;
//class ReceptionExport implements FromQuery,   WithHeadings

use Carbon\Carbon;

class ConfidExport implements FromView,WithColumnFormatting
{

  private $data0;private $tableName;

   public function __construct($data0,$visit_date,$tableName)
   {
        $this->data0 = $data0;
        $this->tableName= $tableName;
        $this->visit_date=$visit_date;
       
   }
   public function view(): View
   {
    $tb =$this->tableName;
    if($tb == "confid"){
        $encrypted_columns = [
            'Clinic Code',
            'Pid',
            'FuchiaID',
            'PrEPCode',
            'Name',
            'Father',
            'Agey',
            'Agem',
            'Gender',
            'Reg Date',
            'Date Of Birth',
            'Region',
            'Township',
            'Quarter',
            
            'Main Risk',
            'Sub Risk',
            'Former Risk',
            'Risk Change_Date',
            'Phone',
            'Phone2',
            'Phone3',
            'Mode',
            'created_by',
            'updated_by',
            
        ];

        $decrypted_data = $this->data0->map(function($user) use ($encrypted_columns) {
            $general="General";
            $user=Export_age::Export_general($user,$this->visit_date,$user->{"Date of Birth"},$user);
           
            foreach($encrypted_columns as $column) {
                if ($column === 'Name') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Father') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Region') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Township') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Quarter') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Phone') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Phone2') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Phone3') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Date of Birth') {
                    // Decrypt the "Name" column from the related model
                    if (!empty($user->{$column})) {
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decryptString($user->{$column});
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Gender') {
                    
                    // Decrypt the "Name" column from the related model
                    if ($user->{$column} !== null) {
                        
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::decrypt_light($user->{$column},$general);
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        
                        $user->{$column} ="";
                    }
                }
                if ($column === 'Main Risk') {
                    // Decrypt the "Name" column from the related model
                    if ($user->{$column} !== null) {
                        // Decrypt the "Name" column from the related model
                        $temp_data = Crypt::decrypt_light($user->{$column},$general);

                        $user->{$column} = Crypt::codeBook($temp_data,"encode");
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        
                        $user->{$column} = "";
                    }
                }
                if ($column === 'Sub Risk') {
                    // Decrypt the "Name" column from the related model
                    if ($user->{$column}!==null) {
                        $temp_data = Crypt::decrypt_light($user->{$column},$general);
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::codeBook($temp_data,"encode");
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";

                    }
                }
                if ($column === 'Former Risk') {
                    // Decrypt the "Name" column from the related model
                    if ($user->{$column}!==null) {
                        $temp_data = Crypt::decrypt_light($user->{$column},$general);
                        // Decrypt the "Name" column from the related model
                        $user->{$column} = Crypt::codeBook($temp_data,"encode");
                    } else {
                        // Set a default value when the "Name" column is null or empty
                        $user->{$column} = "";

                    }
                }
                if ($column == "Reg Date") {
                    $dateString = $user->{$column};
                    // Check if $dateString is not empty
                    if (!empty($dateString)) {
                        // Parse the date from 'YYYY-mm-dd' to Carbon date object
                        $carbonDate = Carbon::createFromFormat('Y-m-d', $dateString);
                        // Format it as 'dd-mm-yyyy' and update the user1 object
                        $ddString= $carbonDate->format('d-m-Y');
    
                        $carbonDate = Carbon::createFromFormat('d-m-Y', $ddString); // Assuming you have a Carbon instance
                        $user->{$column} = Date::dateTimeToExcel($carbonDate->toDateTime()); // Convert to Excel-compatible date
    
                    }
                }
                if ($column == "Risk Change_Date") {
                                $dateString = $user->{$column};
                                // Check if $dateString is not empty
                                if (!empty($dateString)) {
                                    // Parse the date from 'YYYY-mm-dd' to Carbon date object
                                    $carbonDate = Carbon::createFromFormat('Y-m-d', $dateString);
                                    // Format it as 'dd-mm-yyyy' and update the user1 object
                                    $ddString= $carbonDate->format('d-m-Y');
                
                                    $carbonDate = Carbon::createFromFormat('d-m-Y', $ddString); // Assuming you have a Carbon instance
                                    $user->{$column} = Date::dateTimeToExcel($carbonDate->toDateTime()); // Convert to Excel-compatible date
                
                                }
                }
               
            }
            return $user;
        });
       
        
       
        return view('Prevention.export_confid', [
                'users' => $decrypted_data,
                //'users1'=> $data1,
                //'users2'=> $users2,
        ]);

            
    }
    
   }



   public function columnFormats(): array
   {
    $tb = $this->tableName;
    if($tb =="log_sheet"){
        return [
            //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
            'K' => 'dd-mm-yyyy',
            'L' => 'dd-mm-yyyy',
        ];
    }
    else if($tb =="cbs"){
        return [
            //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
            'E' => 'dd-mm-yyyy',
            'S' => 'dd-mm-yyyy',
        ];
    }
    else if($tb =="confid"){
        return [
            'G' => 'dd-mm-yyyy',
            'O' => 'dd-mm-yyyy',
        ];
    }
        
        
       
   }

}// class end
