<?php

namespace App\Exports\Cervical_Cancer;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use App\Exports\Export_age;

class Cervical_Export implements FromView, WithColumnFormatting
{
    private $cervical_exData;
    

    public function __construct($cervical_exData)
    {
        $this->cervical_exData = $cervical_exData;
        
    }
    
    
    

    public function view(): View
    {  $cc_dates=[
            "Visit_date","LMP","UCG_test_date",
            "Postpone_date","Date","Followup_date",
            "AE_Date","AE_followUp_Date",
        ];
        foreach ($this->cervical_exData as $index=>$value) {
            if($value["ptconfig"]!=null){
                $this->cervical_exData[$index]=Export_age::Export_general($value["ptconfig"],$value["Visit_date"],$value["ptconfig"]["Date of Birth"],$this->cervical_exData[$index]);
            }
            foreach($cc_dates as $cc_date){
                if($this->cervical_exData[$index][$cc_date]!=null){
                    $carbonDate = Carbon::createFromFormat('Y-m-d', $this->cervical_exData[$index][$cc_date]);
                    $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
                    $this->cervical_exData[$index][$cc_date]=Date::dateTimeToExcel($carbonDate->toDateTime());
                }
            }
        }
       
        return view('Cervical_cancer.export.cervical_cancer', [
                'cervical_exdata' => $this->cervical_exData // Corrected variable reference 
            ]);
        
    }

    public function columnFormats(): array
    {
        return [
            'I' => 'dd-mm-yyyy',
            'N'=>'dd-mm-yyyy',
            'O'=>'dd-mm-yyyy',
            'AS'=>'dd-mm-yyyy',
            'AT'=>'dd-mm-yyyy',
            'AU'=>'dd-mm-yyyy',
            'AW'=>'dd-mm-yyyy',
            'BD'=>'dd-mm-yyyy',
        ];
    }
  
}