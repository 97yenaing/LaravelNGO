<?php

namespace App\Imports;

//use App\Models\User;
use DateTime;
use App\Models\Ncd_Patient_Register;
use App\Models\ncd_pt_register;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

    //  date('Y-m-d',strtotime($checkDate))
  /*  $r4=DateTime::createFromFormat("Y-m-d", $row[4]);
    $r12=DateTime::createFromFormat("Y-m-d", $row[12]);
    $r15=DateTime::createFromFormat("Y-m-d", $row[15]);
    $r18=DateTime::createFromFormat("Y-m-d", $row[18]);
    $r20=DateTime::createFromFormat("Y-m-d", $row[20]);
    $r22=DateTime::createFromFormat("Y-m-d", $row[22]);
    $r25=DateTime::createFromFormat("Y-m-d", $row[25]);
    $r27=DateTime::createFromFormat("Y-m-d", $row[27]);*/

  //  $myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
//$newDateString = $myDateTime->format('d-m-Y');
//$old_date_format = "20/03/1999";
//$new_data_format = date("Y-m-d H:i:s", strtotime($old_date_format));



    /*  $r4 = date("Y-m-d",strtotime($row[4]));
      $r12 = date("Y-m-d",strtotime($row[12]));
      $r15 = date("Y-m-d",strtotime($row[15]));
      $r18 = date("Y-m-d",strtotime($row[18]));
      $r20 = date("Y-m-d",strtotime($row[20]));
      $r22 = date("Y-m-d",strtotime($row[22]));
      $r25 = date("Y-m-d",strtotime($row[25]));
      $r27 = date("Y-m-d",strtotime($row[27])); */


        return new ncd_pt_register([
            //'name'     => $row[0],
          //  'email'    => $row[1],
          //  'password' => Hash::make($row[2])

            'pid'             => $row[0],
            'Fuchsia_ID'      => $row[1],
            'Age'             => $row[2],
            'Agey'            => $row[3],
            'Reg_Date'        => $row[4],
            'Area_Division'   => $row[5],
            'Township'        => $row[6],
            'Height'          => $row[7],
            'Weight'          => $row[8],
            'Gender'          => $row[9],

            '1stBP_Up'        => $row[10],
            '1stBP_Low'       => $row[11],
            '1stBP_date'      => $row[12],

            '2ndBP_Up'        => $row[13],
            '2ndBP_Low'       => $row[14],
            '2ndBP_date'      => $row[15],

            '3rdBP_Up'        => $row[16],
            '3rdBP_Low'       => $row[17],
            '3rdBP_date'      => $row[18],

            'Hypertension'    => $row[19],
            'Hyper_Di_date'   => $row[20],

            'Diabetes'        => $row[21],
            'Dia_Dig_date'    => $row[22],

            'Stage_of_Hyper'  => $row[23],
            '1st_RBS'         => $row[24],
            '1st_RBS_date'    => $row[25],

            '2nd_RBS'         => $row[26],
            '2nd_RBS_date'    => $row[27],

            'Clinical_Symptoms'       => $row[28],
            'Clinical_Symptoms_Text'  => $row[29],

            'Smoking_Status'          => $row[30],

            'Amlodipine_dose'         => $row[31],
            'Amlodipine_Freq'         => $row[32],
            'Amlodipine_due'          => $row[33],

            'Enalapril_dose'          => $row[34],
            'Enalapril_Freq'          => $row[35],
            'Enalapril_due'           => $row[36],

            'Atorvastain_dose'        => $row[37],
            'Atorvastain_Freq'        => $row[38],
            'Atorvastain_due'         => $row[39],

            'Hydrochlorothiazide_dose'     => $row[40],
            'Hydrochlorothiazide_Freq'     => $row[41],
            'Hydrochlorothiazide_due'      => $row[42],

            'Aspirin_dose'            => $row[43],
            'Aspirin_Freq'            => $row[44],
            'Aspirin_due'             => $row[45],

            'Metformin_dose'          => $row[46],
            'Metformin_Freq'          => $row[47],
            'Metformin_due'           => $row[48],

            'Gliclazide_dose'         => $row[49],
            'Gliclazide_Freq'         => $row[50],
            'Gliclazide_due'          => $row[51],

            'Other_NCD_medication'    => $row[52],
            'oth_ncd_med_spec'        => $row[53],

            'cur_med1'                => $row[54],
            'cur_med1_dose'          => $row[55],
            'cur_med1_freq'           => $row[56],
            'cur_med1_due'            => $row[57],

            'cur_med2'                => $row[58],
            'cur_med2_dose'           => $row[59],
            'cur_med2_freq'           => $row[60],
            'cur_med2_due'            => $row[61],

            'cur_med3'                => $row[62],
            'cur_med3_dose'           => $row[63],
            'cur_med3_freq'           => $row[64],
            'cur_med3_due'            => $row[65],

            'cur_med4'                => $row[66],
            'cur_med4_dose'           => $row[67],
            'cur_med4_freq'           => $row[68],
            'cur_med4_due'            => $row[69],

            'cur_med5'                => $row[70],
            'cur_med5_dose'           => $row[71],
            'cur_med5_freq'           => $row[72],
            'cur_med5_due'            => $row[73],

            'cur_med6'                => $row[74],
            'cur_med6_dose'           => $row[75],
            'cur_med6_freq'           => $row[76],
            'cur_med6_due'            => $row[77],

            'Dia_foot'                => $row[78],
            'Neuropathy'              => $row[79],
            'Atril_Fib'               => $row[80],
            'Hyperlipidemia'          => $row[81],
            'CKD'                     => $row[82],
            'Change_in_Vision'        => $row[83],
            'Gestational_Diabetes'    => $row[84],
            'CVD'                     => $row[85],
            'Chronic_Lung_Disease'    => $row[86],
            'Recur_infection'         => $row[87],
            'Recur_infection_text'    => $row[88],
            'Family_Hyper'            => $row[89],

            'Family_Diabetes'         => $row[90],
            //'pid'     => $row[91],
            //'pid'     => $row[92],
            //'pid'     => $row[93],
            //'pid'     => $row[94],
        ]);
    }
}
