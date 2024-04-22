<?php

namespace App\Imports;
//use App\Models\User;
use App\Models\Stimale;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StiMaleImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    //  $convertedDate=date("Y-m-d",$row[9]);
     //$convertedDate = strtotime($row[8]);
    //$convertedDate= PHPExcel_Shared_Date::ExcelToPHP($row[8]);
  //  $date =  $row[8];
  //  $d2 = \Carbon\Carbon::createFromFormat('dd.m.y', $date);
  //  $convertedDate =dd($d2);
        return new Stimale([
          'gender'                =>$row[0],
          'clinic'                =>$row[1],
          'CID'                   =>intval($row[2]),
          'tbl_demog_first_visit' => $row[3],
          'Expr1'                 => $row[4],
          'last_vis_within'       => $row[5],
          'age'                   => intval($row[6]),
          'about_clinic'          => $row[7],
          'demo_remarks'          => intval($row[8]),
          'Visit date'            => $row[9],
          'visit_type'            => $row[10],
          'visit_time'            => $row[11],
          'followup_visit'        => $row[12],
          'episode'               => $row[13],
          'Reason for Visit'      => $row[14],
          'risk_factor'           => $row[15],
          'urethral_disc'         => intval($row[16]),
          'urethral_disc_hl'      => intval($row[17]),
          'dysuria'               => intval($row[18]),
          'dysuria_hl'            => intval($row[19]),
          'genital_prut'          => intval($row[20]),
          'genital_prut_hl'       => intval($row[21]),
          'genital_pain'          => intval($row[22]),
          'genital_pain_hl'       => intval($row[23]),
          'genital_ulcer'         => intval($row[24]),
          'genital_ulcer_hl'      => intval($row[25]),
          'pain'                  => intval($row[26]),
          'ulcer'                 => intval($row[27]),
          'prodromal_itch'        => intval($row[28]),
          'vesicles'              => intval($row[29]),
          'recurrent'             => intval($row[30]),
          'last_episode'          => intval($row[31]),
          'suspects_herpes'       => intval($row[32]),
          'ing_lymph_node'        => intval($row[33]),
          'ing_lymph_node_hl'     => intval($row[34]),
          'unilateal'             => intval($row[35]),
          'leg_ulcer'             => intval($row[36]),
          'scrotal_swelling'      => intval($row[37]),
          'scrotal_swelling_hl'   => intval($row[38]),
          'td_ntd'                => intval($row[39]),
          'gen_wart'              => intval($row[40]),
          'gen_wart_hl'           => intval($row[41]),
          'physical_exam'         => intval($row[42]),
          'urinated_wit_1h'       => intval($row[43]),
          'discharge'             => intval($row[44]),
          'discharge_milk'        => intval($row[45]),
          'colour'                => intval($row[46]),
          'erythema'              => intval($row[47]),
          'blisters'              => intval($row[48]),
          'gen_ulcer'             => intval($row[49]),
          'esti_size'             => intval($row[50]),
          'sing_multi'            => intval($row[51]),
          'pain_full_less'        => intval($row[52]),
          'herpes_suspect'        => intval($row[53]),
          'inguinal_bubo'         => intval($row[54]),
          'fluctant'              => intval($row[55]),
          'tendr_ntender'         => intval($row[56]),
          'oth_leg_inf'           => intval($row[57]),
          'phy_genital_wart'      => intval($row[58]),
          'crab_lice'             => intval($row[59]),
          'scabies'               => intval($row[60]),
          'gscrotal_swelling'     => intval($row[61]),
          'estimated_siz'         => intval($row[62]),
          'unilateal_bilateral'   => intval($row[63]),
          'gtender_ntender'       => intval($row[64]),
          'erythem'               => intval($row[65]),
          'des_size'              => intval($row[66]),
          'tbl_treat_diagnosis_first_visit'=> intval($row[67]),
          'epi_discharge'         => intval($row[68]),
          'unprot_sex_new_part'   => intval($row[69]),
          'genital_signs'         => intval($row[70]),
          'presumptive_diag'      => intval($row[71]),
          'pri_syphillis'         => intval($row[72]),
          'sec_syphillis'         => intval($row[73]),
          'chancroid'             => intval($row[74]),
          'gen_herpes'            => intval($row[75]),
          'gen_scabies'           => intval($row[76]),
          'gud_other'             => intval($row[77]),
          'other(please specify)' => intval($row[78]),
          'Gonorhoea'             => intval($row[79]),
          'non_gono_urethritis'   => intval($row[80]),
          'non_gono_cervities'    => intval($row[81]),
          'trichomonas'           => intval($row[82]),
          'genital_candidiosis'   => intval($row[83]),
          'beterial_vaginosis'    => intval($row[84]),
          'congenial_syphillis'   => intval($row[85]),
          'latent_syphillis'      => intval($row[86]),
          'molluscum_contag'      => intval($row[87]),
          'bubos'                 => intval($row[88]),
          'othstd_genital_warts'=> intval($row[89]),
          'ostd_other'            => intval($row[90]),
          'tre_azythro'           => intval($row[91]),
          'tre_cefixim'           => intval($row[92]),
          'tre_ciprofloxacin'     => intval($row[93]),
          'tre_tinidazole'        => intval($row[94]),
          'tre_fluconazole'       => intval($row[95]),
          'tre_doxycycline'       => intval($row[96]),
          'tre_ceftriaxone'       => intval($row[97]),
          'tre_benz_pen'          => intval($row[98]),
          'no_treat'              => intval($row[99]),
          'al_Penicillin'         => intval($row[100]),
          'al_sulfa'              => intval($row[101]),
          'part_treat'            => intval($row[102]),
          'condom_giv'            => intval($row[103]),
          'tre_remarks'           => $row[104],
          'followup'              => $row[105],
          'clinician_name'        => $row[106],

        ]);
    }
}
