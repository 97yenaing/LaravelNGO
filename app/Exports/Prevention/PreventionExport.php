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
//class ReceptionExport implements FromQuery,   WithHeadings

use Carbon\Carbon;

class PreventionExport implements FromView,WithColumnFormatting
{

  private $data; private $tableName;

   public function __construct($data,$tableName)
   {
        $this->data= $data;
       
        $this->tableName= $tableName;
       
   }
   public function view(): View
   {
    $tb =$this->tableName;
    if($tb == "log_sheet"){
        $encrypted_columns=[
            "Main_Risk",
            "Sub_Risk",
            "HIV Status",
            "Initial Risk",
            "Changed_Risk",
            "HIV_Final_result",//decrypt section
            "Sex",
            "date_confirm",
            "Reg_Date",
            "Visit_Date",
            "Risk changed Date",
            "OST_Initial_Date",
        ];
        $data = $this->data->map(function ($user) use ($encrypted_columns) {
            $user["Name"]= Crypt::DecryptString($user["ptconfig"]["Name"]);
            $user["Township"]= Crypt::DecryptString($user["ptconfig"]["Township"]);
            if($user["ptconfig"]!=null){
                $user=Export_age::Export_general($user["ptconfig"],$user["Visit_Date"],$user["ptconfig"]["Date of Birth"],$user);
            }
            foreach ($encrypted_columns as $index=> $column) {
                if($index>=0 && $index<7){
                    $value_decrypted = Crypt::decrypt_light($user->{$column},"General");
                    if($value_decrypted == "Invalid value"){
                        $value_decrypted = "";
                    }
                    $user->{$column}= Crypt::codeBook($value_decrypted,"encode"); 

                }
                if($index>=7 && $index<count($encrypted_columns)){
                        $dateString = $user->{$column};
                        // Check if $dateString is not empty
                        if (!empty($dateString)) {
                            // Parse the date from 'YYYY-mm-dd' to Carbon date object
                            $carbonDate = Carbon::createFromFormat('Y-m-d', $dateString);
                            // Format it as 'dd-mm-yyyy' and update the user object
                            $ddString= $carbonDate->format('d-m-Y');
        
                            $carbonDate = Carbon::createFromFormat('d-m-Y', $ddString); // Assuming you have a Carbon instance
                            $user->{$column} = Date::dateTimeToExcel($carbonDate->toDateTime()); // Convert to Excel-compatible date
        
                        }
                }
                
            }
            return $user;
        });
        
        return view('Prevention.export_LogSheet', [
                'users' => $data,
                //'users2'=> $users2,
        ]);

            
    }
    
    if($tb == "cbs"){
        $encrypted_columns= [
            "Main_Risk",
            "Sub_Risk",
            "HIV_determine_result",
            "HIV result",
            "HIV Sero-Status",
            "Sex", // decrypt

           
            "Visit_Date",
            "date_confirm",//     Date of arrival at confirmation Facility (DD/MM/YY)
           
           
        ];
        $decrypted_data = $this->data->map(function($user) use ($encrypted_columns) {
            if($user["ptconfig"]!=null){
                $user=Export_age::Export_general($user["ptconfig"],$user["Visit_Date"],$user["ptconfig"]["Date of Birth"],$user);
            }
            foreach($encrypted_columns as $index=> $column) {
                
                if ($column == "Visit_Date"||$column == "date_confirm") {
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
                }else{
                    $user->{$column} = Crypt::decrypt_light($user->{$column},"General");
                    if( $user->{$column} == "Invalid value"){
                        $user->{$column} = "";
                    }
                }
            }
            
                return $user;
            });
            return view('Prevention.export_cbs', [
                'users' => $decrypted_data,
            ]);

    }
   
   }

   public function columnFormats(): array
   {
    $tb = $this->tableName;
    if($tb =="log_sheet"){
        return [
            'Q' => 'dd-mm-yyyy',
            'H' => 'dd-mm-yyyy',
            'I' => 'dd-mm-yyyy',
            'AJ' => 'dd-mm-yyyy',
            'AS' => 'dd-mm-yyyy',

        ];
    }
    else if($tb =="cbs"){
        return [
            //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
            'G' => 'dd-mm-yyyy',
            'V' => 'dd-mm-yyyy',
        ];
    }
        
       
   }

}// class end
