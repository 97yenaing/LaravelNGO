<?php

namespace App\Exports\Lab;

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
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Export_age;
//class ReceptionExport implements FromQuery,   WithHeadings



class LabExport implements FromView , WithColumnFormatting
{

  private $users;private $users1; private $testName;private $users2;

   public function __construct($users,$testName)
   {
        $this->users = $users;
        $this -> testName = $testName;
   }
   public function view(): View 
   {    $export_final=$this->users;
        $testName=$this->testName;

       
     

        $export_final = $this->users->map(function ($user) {
            if($user["ptconfig"]!=null){
                $user["Patient_Type"]=$user["ptconfig"]["Main Risk"];
                $user["Patient Type Sub"]=$user["ptconfig"]["Sub Risk"];
                $user["Gender"]=$user["ptconfig"]["Gender"];
                $user=Export_age::Export_general($user["ptconfig"],$user["vdate"],$user["ptconfig"]["Date of Birth"],$user); 
            }
            return $user;
        });
        switch ($this-> testName) {
            
            case 'hiv':
                $encrypted_columns = [
                    'Gender',
                    'Patient_Type',
                    'Patient Type Sub',
                    'Detmine_Result',
                    'Unigold_Result',
                    'STAT_PAK_Result',
                    'Final_Result',
                    'Req_Doctor',
                    'Counsellor',
                    'LabTech',
                ];
        
                $date_type = [
                    'vdate',
                    'bcollectdate',
                ];
            break;
            case 'rpr':
                $encrypted_columns = [
                    'Gender',
                    'RDT(Yes/No)',
                    'RDT Result',
                    'Quantitative(Yes/No)',
                    'RPR Qualitative',
                    'Patient_Type',
                    'Patient Type Sub',
        
                    'Titre(current)',
                    'Titre(Last)',
                    
                    'Req_Doctor',
                    'Counsellor',
                    'Lab Tech',
                ];
                $date_type=[
                    'vdate',
                    'TitreLastDate',
                    'Issue Date',
                ];
            break;
            case 'sti':
                $encrypted_columns = [
                    'Gender',
                    'Req_Doctor',
                    'Requested Doctor New',
                    
                    'Patient_Type',
                    'Patient Type Sub',
                    'Wet Mount clue cell',
                    'Wet Mount Trichomonas',
                    'Wet Mount candida',
                    'wetoth',
                    'urethra WBC',
                    'Urethra diplococci intra-cell',
                    'Urethra diplococci extra-cell',
                    'Urethra Candida',
                    'uoth',
                    'Fornix Clue Cells',
                    'Fornix WBC',
                    'Fornix diplococci intra-cell',
                    'Fornix diplococci extra-cell',
                    'Fornix Candida',
                    'pfother',
                    'Endo cervix WBC',
                    'Endo cervix diplococci intra-cell',
                    'Endo cervix diplococci extra-cell',
                    'Endo cervix Candida',
                    'eother',
                    'Rectum WBC',
                    'Rectum diplococci intra-cell',
                    'Rectum diplococci extra-cell',
                    'rother',
                    'First Per Urine',
                    'Epithelial cells',
                    'PMNL cells',
            
                    'First Per Urine Diplococci Intra-Cell',
                    'First Per Urine Diplococci Extra-Cell',
                    'fpu_oth',
                    'Lab Techanician',
                    
                    'Other Bacteria',
                ];
                $date_type=[
                    'vdate',
                    'idate',
                ];
            break;
            case 'hep_bc':
                $encrypted_columns = [
                    'Gender',
                    'Requested Doctor old',
                    'Req_Doctor',
                    
                    'Patient_Type',
                    'Patient Type Sub',
                    'Hiv status',
                    'HepB Test',
                    'HepB TOT',
                    'HepB Result',
                    'HepC Test',
                    'HepC TOT',
                    'HepC Result',
                    'Lab Tech',
                ];
                $date_type=[
                    'vdate',
                    'Issue Date',
                ];
                $this-> testName="hep";
            
            break;
            case 'urine':
                $encrypted_columns = [
                    'Gender',
                    'Req_Doctor',
                    'Patient_Type',
                    'Patient Type Sub',
                    'Utest_done',
                    'Utot',
                    'Ucolor',
                    // 'Uapp',
                    'Uturbitity',
                    'Upus',
                    'ph',
                    'Uprotein',
                    'Uglucose',
                    'Urbc',
                    'Uleu',
                    'Unitrite',
                    'Uketone',
                    'Uepithelial',
                    'Urobili',
                    'Ubillru',
                    'Uery',
                    'Ucrystal',
                    'Uhae',
                    'Uother',
                    'Ucast',
                    'comment',
                    'lab_tech',
                    
                    'Cretinine',
                    'Albumin',
                    'A:C_ratio',
                ];
                $date_type=[
                    'vdate',
                    'issue_date',
                ];
            break;
            case 'oi':
                $encrypted_columns = [
                    'Gender',
                    'Req_Doctor',
                    'Patient_Type',
                    'Patient Type Sub',
                    
                    'TB_LAM_Report',
                    'Serum Result',
                    'serum_pos',
                    'CSF for Cryptococcal Antigen',
                    'csf_crypto_pos',
                    'csf_fungal',
                    'CSF Smear Giemsa Stain',
                    'CSF Smear India Ink',
                    'skin_fungal',
                    'Skin Smear Giemsa Stain',
                    'Skin Smear India Ink',
                    'lymph_test',
                    'Lymph Giemsa Stain',
                    'Lymph India Ink',
                    'Lab Techanician',
                    'Toxo plasma',
                    'Toxo igG',
                    'Toxo igM',
                ];
                $date_type=[
                    
                    'vdate',
                    'issued',
                ];
            break;
            case 'general':
                $encrypted_columns = [
                    'Gender',
                    'Requested Doctor old',
                    'Req_Doctor',
                    'Patient_Type',
                    'Patient Type Sub',
                    'Dangue RDT',
                    'NS1 Antigen',
                    'IgG Result',
                    'IgM Result',
                    'Malaria RDT',
                    'Malaria RDT Result',
                    'Malaria_spec',
                    'Malaria_grade',
                    'Malaria_stage',
                    'malaria_microscopy',
                    'Malaria Microscopy Result',
                    'RBS test',
                    'RBS',
                    'FBS test',
                    'FBS',
                    'haemo_done',
                    'haemoglobin',
                    'hba1c',
                    'Lab Tech',
                ];
                $date_type=[
                  'vdate',
                  'Issue Date',
                ];
            break;
            case 'stool':
                $encrypted_columns = [
                    'Gender',
                    'Req_Doctor',
                    'Patient_Type',
                    'Patient Type Sub',
                    'Clinic',
                    'st_stool' ,
                    'st_colour',
                    'wbc_pus_cell',
                    'st_consistency',
                    'st_rbcs',
                    'st_other',
                    'st_comment',
                    'st_lab_tech',
                ];
            
                $date_type=[
                    'vdate',
                    'st_issue_date',
                ];
            break;
            case 'afb':
                $encrypted_columns = [
                
                    'Gender'               ,
                    'Req_Doctor'     ,
                
                    'Patient_Type'         ,
                    'Patient Type Sub'     ,
                    'afb_pt_name'          ,
                    'afb_pt_address'       ,
                    'Previous_TB'          ,
                    'HIV_status'           ,
                    'reason_for_exam'      ,
                    'afb_Pt_type'          ,
                    'follow_up_mt'         ,
                    'speci_type'           ,
                    'oth_spe_ty'           ,
                    'slide_num_1'          ,
                    'slide_num_2'          ,
                    
                    'visual_app_1'         ,
                    'afb_result1'          ,
                    'slide1_grading1'      ,
                    
                    'visual_app_2'         ,
                    'afb_result2'          ,
                    'slide2_grading2'      ,
                    'afb_lab_techca'       ,
                    'Township','Region','Quarter','Name'//confidential must be last
                ];
                $date_type=[
                    'vdate',
                    'speci_receive_dt1'    ,
                    'speci_receive_dt2'    ,
                    'afb_issue_date'       ,
                ];
            break;
            case 'covid19':
                $encrypted_columns = [
                    'Gender'               ,
                    'Req_Doctor'     ,
                    
                    'Patient_Type'         ,
                    'Patient Type Sub'     ,
                    'co_Age'              ,
                    'type_of_patient_covid',
                    'specimen_type'        ,
                    'co_test_type'         ,
                    'covid_result'         ,
                    'covid_lab_tech'       ,
                ];
                $date_type=[
                    'vdate',
                    'covid_issue_date'     ,
                ];
                $this-> testName="covid";
            break;
            case 'viral':
            $encrypted_columns = [
                'Gender',
                'Patient_Type',
                'Patient Type Sub',
                'Req_Doctor',
                'Sample Sent to',
                'Viral Load Result',
                'Other org code',
                'Detect',
            ];
        
            $date_type=[
              
                'Sample_Ship_Date',
                'vdate',
                'Result received date',
                'ART_ini_date',
                'ART_duration',
                
            ];
          break;
        };
        $users1_treat =$export_final->map(function ($user) use($encrypted_columns,$date_type){
        //$user["Patient Type"]=$user["ptconfig"]["Main Risk"];
        foreach ($date_type as $column) {
            $dateString = $user->{$column};
            if (!empty($dateString)) {
                $carbonDate = Carbon::createFromFormat('Y-m-d', $dateString);
                $ddString= $carbonDate->format('d-m-Y');

                $carbonDate = Carbon::createFromFormat('d-m-Y', $ddString); // Assuming you have a Carbon instance
                $user->{$column} = Date::dateTimeToExcel($carbonDate->toDateTime()); // Convert to Excel-compatible date

            }
        }
        foreach ($encrypted_columns as $column) {
            $user[$column]=Crypt::decrypt_light($user[$column],"General");
            $user[$column]=Crypt::codeBook($user[$column],"encode");
            if($this-> testName=="hep"){
                if($column=="Hiv status"){
                    if($user[$column]!=24 && $user[$column]!=25){
                        $user[$column]="unknown";
                    }
                }
               
            }
            
        }
        if($this-> testName=="afb"){
            for ($i=(count($encrypted_columns)-4); $i < count($encrypted_columns) ; $i++) { 
                if($user['ptconfig']!=null){
                    $user[$encrypted_columns[$i]]=Crypt::DecryptString($user['ptconfig'][$encrypted_columns[$i]]);
                }
                 
            }
        }
        return $user;
        });
        return view('Labs.Export.'.$this-> testName, [
            'users' => $users1_treat,
        ]);
   }
   public function columnFormats(): array
    {
      
        if($this-> testName == "hiv"){
            return [
                'L' => 'dd-mm-yy',
                'M' => 'dd-mm-yy',
                // 'S' => 'dd-mm-yy',
                // 'T' => 'dd-mm-yy',
            ];
        }
        if($this-> testName == "rpr"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'L' => 'dd-mm-yyyy',
                'S' => 'dd-mm-yyyy',
                'W' => 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "sti"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'K' => 'dd-mm-yyyy',
                'BA'=> 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "hep"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'V' => 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "urine"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'AM'=> 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "oi"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'M' => 'dd-mm-yyyy',
                'AF'=> 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "general"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'AG'=> 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "stool"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'U' => 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "afb"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'K' => 'dd-mm-yyyy',
                'X'=> 'dd-mm-yyyy',
                'AC'=> 'dd-mm-yyyy',
                'AH'=> 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "covid"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'K' => 'dd-mm-yyyy',
                'S' => 'dd-mm-yyyy',
            ];
        }
        if($this-> testName == "viral"){
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'L' => 'dd-mm-yyyy',
                'M' => 'dd-mm-yyyy',
                'N' => 'dd-mm-yyyy',
                'O' => 'dd-mm-yyyy',
            ];
        }

    }
}// class end
