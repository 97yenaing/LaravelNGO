<?php

namespace App\Exports;

use App\Models\Stimale;
use Maatwebsite\Excel\Concerns\FromCollection;


use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

 class StimaleExport implements FromCollection,WithColumnFormatting,WithHeadings
{

  /**
  * @return \Illuminate\Support\Collection
  */

    public function collection()
    {
      //$from =date('2021-06-01'); $to=date('2021-6-30');
        //return Stimale::whereBetween('Visit date', [$from, $to])->get();
        return Stimale::all();
    }
    public function columnFormats(): array
    {
        return [

            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,

        ];
    }
      public function headings(): array
    {
        return [
          'gender',
          'clinic',
          'CID',
          'tbl_demog_first_visit',
          'Expr1',
          'last_vis_within',
          'age',
          'about_clinic',
          'demo_remarks',
          'Visit date',
          'visit_type',
          'visit_time',
          'followup_visit',
          'episode',
          'Reason for Visit',
          'risk_factor',
          'urethral_disc',
          'urethral_disc_hl',
          'dysuria',
          'dysuria_hl',
          'genital_prut',
          'genital_prut_hl',
          'genital_pain',
          'genital_pain_hl',
          'genital_ulcer',
          'genital_ulcer_hl',
          'pain',
          'ulcer',
          'prodromal_itch',
          'vesicles',
          'recurrent',
          'last_episode',
          'suspects_herpes',
          'ing_lymph_node',
          'ing_lymph_node_hl',
          'unilateal',
          'leg_ulcer',
          'scrotal_swelling',
          'scrotal_swelling_hl',
          'td_ntd',
          'gen_wart',
          'gen_wart_hl',
          'physical_exam',
          'urinated_wit_1h',
          'discharge',
          'discharge_milk',
          'colour',
          'erythema',
          'blisters',
          'gen_ulcer',
          'esti_size',
          'sing_multi',
          'pain_full_less',
          'herpes_suspect',
          'inguinal_bubo',
          'fluctant',
          'tendr_ntender',
          'oth_leg_inf',
          'phy_genital_wart',
          'crab_lice',
          'scabies',
          'gscrotal_swelling',
          'estimated_siz',
          'unilateal_bilateral',
          'gtender_ntender',
          'erythem',
          'des_size',
          'tbl_treat_diagnosis_first_visit',
          'epi_discharge',
          'unprot_sex_new_part',
          'genital_signs',
          'presumptive_diag',
          'pri_syphillis',
          'sec_syphillis',
          'chancroid',
          'gen_herpes',
          'gen_scabies',
          'gud_other',
          'other(please specify)',
          'Gonorhoea',
          'non_gono_urethritis',
          'non_gono_cervities',
          'trichomonas',
          'genital_candidiosis',
          'beterial_vaginosis',
          'congenial_syphillis',
          'latent_syphillis',
          'molluscum_contag',
          'bubos',
          'othstd_genital_warts',
          'ostd_other',
          'tre_azythro',
          'tre_cefixim',
          'tre_ciprofloxacin',
          'tre_tinidazole',
          'tre_fluconazole',
          'tre_doxycycline',
          'tre_ceftriaxone',
          'tre_benz_pen',
          'no_treat',
          'al_Penicillin',
          'al_sulfa',
          'part_treat',
          'condom_giv',
          'tre_remarks',
          'followup',
          'clinician_name',
        ];
    }

}
