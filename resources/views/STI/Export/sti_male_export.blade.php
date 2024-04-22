<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export to Excel </title>
    <style>
    table {
      border-collapse: collapse;
      font-size: 12px;
    }

    th, td {
      border: 2px solid black;
      height:50px;
    }
  </style>
</head>

<body>
    <div class="container mt-5 text-center">
        <!-- <form action="{{ route('sti_export') }}" method="POST" > -->
          <form   method="POST" >
            @csrf
           
            <table>
              <thead>
                <tr>  
                 
                  <th style="background-color:#a6a6a6;">Clinic Code</th>
                  <th style="background-color:#a6a6a6;">General ID</th>
                  <th style="background-color:#a6a6a6;">Fuchia ID</th>
                  <th style="background-color:#a6a6a6;">Sex</th>
                  <th style="background-color:#a6a6a6;">Reg Year</th>
                  <th style="background-color:#a6a6a6;">Register Age</th>
                  <th style="background-color:#a6a6a6;">Register Age(Month)</th>
                  <th style="background-color:#a6a6a6;">Current Age</th>
                  <th style="background-color:#a6a6a6;">Current Age(Month)</th>
                  
                  <th style="background-color:#a6a6a6;">Visit date</th>

                  <th style="background-color:#a6a6a6;">last_vis_within</th>
                  <th style="background-color:#a6a6a6;">about_clinic</th>
                  <th style="background-color:#a6a6a6;">demo_remarks</th>
                  <th style="background-color:#a6a6a6;">visit_type</th>
                  <th style="background-color:#a6a6a6;">visit_time</th>
                  <th style="background-color:#a6a6a6;">followup_visit</th>
                  <th style="background-color:#a6a6a6;">episode</th>
                  <th style="background-color:#a6a6a6;">Reason for Visit</th>
                  <th style="background-color:#a6a6a6;">risk_factor</th>
                  <th style="background-color:#a6a6a6;">urethral_disc</th>
                  <th style="background-color:#a6a6a6;">urethral_disc_hl</th>
                  <th style="background-color:#a6a6a6;">dysuria</th>
                  <th style="background-color:#a6a6a6;">dysuria_hl</th>
                  <th style="background-color:#a6a6a6;">genital_prut</th>
                  <th style="background-color:#a6a6a6;">genital_prut_hl</th>
                  <th style="background-color:#a6a6a6;">genital_pain</th>
                  <th style="background-color:#a6a6a6;">genital_pain_hl</th>
                  <th style="background-color:#a6a6a6;">genital_ulcer</th>
                  <th style="background-color:#a6a6a6;">genital_ulcer_hl</th>
                  <th style="background-color:#a6a6a6;">pain</th>
                  <th style="background-color:#a6a6a6;">ulcer</th>
                  <th style="background-color:#a6a6a6;">prodromal_itch</th>
                  <th style="background-color:#a6a6a6;">vesicles</th>
                  <th style="background-color:#a6a6a6;">recurrent</th>
                  <th style="background-color:#a6a6a6;">last_episode</th>
                  <th style="background-color:#a6a6a6;">suspects_herpes</th>
                  <th style="background-color:#a6a6a6;">ing_lymph_node</th>
                  <th style="background-color:#a6a6a6;">ing_lymph_node_hl</th>
                  <th style="background-color:#a6a6a6;">unilateal</th>
                  <th style="background-color:#a6a6a6;">leg_ulcer</th>
                  <th style="background-color:#a6a6a6;">scrotal_swelling</th>
                  <th style="background-color:#a6a6a6;">scrotal_swelling_hl</th>
                  <th style="background-color:#a6a6a6;">td_ntd</th>
                  <th style="background-color:#a6a6a6;">gen_wart</th>
                  <th style="background-color:#a6a6a6;">gen_wart_hl</th>
                  <th style="background-color:#a6a6a6;">physical_exam</th>
                  <th style="background-color:#a6a6a6;">urinated_wit_1h</th>
                  <th style="background-color:#a6a6a6;">discharge</th>
                  <th style="background-color:#a6a6a6;">discharge_milk</th>
                  <th style="background-color:#a6a6a6;">colour</th>
                  <th style="background-color:#a6a6a6;">erythema</th>
                  <th style="background-color:#a6a6a6;">blisters</th>
                  <th style="background-color:#a6a6a6;">gen_ulcer</th>
                  <th style="background-color:#a6a6a6;">esti_size</th>
                  <th style="background-color:#a6a6a6;">sing_multi</th>
                  <th style="background-color:#a6a6a6;">pain_full_less</th>
                  <th style="background-color:#a6a6a6;">herpes_suspect</th>
                  <th style="background-color:#a6a6a6;">inguinal_bubo</th>
                  <th style="background-color:#a6a6a6;">fluctant</th>
                  <th style="background-color:#a6a6a6;">tendr_ntender</th>
                  <th style="background-color:#a6a6a6;">oth_leg_inf</th>
                  <th style="background-color:#a6a6a6;">phy_genital_wart</th>
                  <th style="background-color:#a6a6a6;">crab_lice</th>
                  <th style="background-color:#a6a6a6;">scabies</th>
                  <th style="background-color:#a6a6a6;">gscrotal_swelling</th>
                  <th style="background-color:#a6a6a6;">estimated_siz</th>
                  <th style="background-color:#a6a6a6;">unilateal_bilateral</th>
                  <th style="background-color:#a6a6a6;">gtender_ntender</th>
                  <th style="background-color:#a6a6a6;">erythem</th>
                  <th style="background-color:#a6a6a6;">des_size</th>
                  <th style="background-color:#a6a6a6;">tbl_treat_diagnosis_first_visit</th>
                  <th style="background-color:#a6a6a6;">epi_discharge</th>
                  <th style="background-color:#a6a6a6;">unprot_sex_new_part</th>
                  <th style="background-color:#a6a6a6;">genital_signs</th>
                  <th style="background-color:#a6a6a6;">presumptive_diag</th>
                  <th style="background-color:#a6a6a6;">pri_syphillis</th>
                  <th style="background-color:#a6a6a6;">sec_syphillis</th>
                  <th style="background-color:#a6a6a6;">chancroid</th>
                  <th style="background-color:#a6a6a6;">gen_herpes</th>
                  <th style="background-color:#a6a6a6;">gen_scabies</th>
                  <th style="background-color:#a6a6a6;">gud_other</th>
                  <th style="background-color:#a6a6a6;">other(please specify)</th>
                  <th style="background-color:#a6a6a6;">Gonorhoea</th>
                  <th style="background-color:#a6a6a6;">non_gono_urethritis</th>
                  <th style="background-color:#a6a6a6;">non_gono_procti</th>
                  <th style="background-color:#a6a6a6;">trichomonas</th>
                  <th style="background-color:#a6a6a6;">genital_candidiosis</th>
                  <th style="background-color:#a6a6a6;">beterial_vaginosis</th>
                  <th style="background-color:#a6a6a6;">congenial_syphillis</th>
                  <th style="background-color:#a6a6a6;">latent_syphillis</th>
                  <th style="background-color:#a6a6a6;">molluscum_contag</th>
                  <th style="background-color:#a6a6a6;">bubos</th>
                  <th style="background-color:#a6a6a6;">othstd_genital_warts</th>
                  <th style="background-color:#a6a6a6;">ostd_other</th>
                  <th style="background-color:#a6a6a6;">tre_azythro</th>
                  <th style="background-color:#a6a6a6;">tre_cefixim</th>
                  <th style="background-color:#a6a6a6;">tre_ciprofloxacin</th>
                  <th style="background-color:#a6a6a6;">tre_tinidazole</th>
                  <th style="background-color:#a6a6a6;">tre_fluconazole</th>
                  <th style="background-color:#a6a6a6;">tre_doxycycline</th>
                  <th style="background-color:#a6a6a6;">tre_ceftriaxone</th>
                  <th style="background-color:#a6a6a6;">tre_benz_pen</th>
                  <th style="background-color:#a6a6a6;">no_treat</th>
                  <th style="background-color:#a6a6a6;">al_Penicillin</th>
                  <th style="background-color:#a6a6a6;">al_sulfa</th>
                  <th style="background-color:#a6a6a6;">part_treat</th>
                  <th style="background-color:#a6a6a6;">condom_giv</th>
                  <th style="background-color:#a6a6a6;">tre_remarks</th>
                  <th style="background-color:#a6a6a6;">followup</th>
                  <th style="background-color:#a6a6a6;">clinician_name</th>
                          
                </tr>
              </thead>

              <tbody>
                @foreach($users as $index => $value)
                <tr>
                
                    
                    
                    <td style="width:100px;">{{ $value["Clinic Code"] }}</td>
                    <td style="width:100px;">{{ $value["CID"] }}</td>
                    <td style="width:100px;">{{ $value["FuchiaID"] }}</td>
                    <td style="width:100px;">{{ $value["Gender"] }}</td>
                    <td style="width:80px;">{{ $value['Reg year'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                    <td style="width:100px;">{{ $value["Visit_date"] }}</td>

                    <td style="width:100px;">{{ $value["last_vis_within"] }}</td>
                    <td style="width:100px;">{{ $value["about_clinic"] }}</td>
                    <td style="width:100px;">{{ $value["demo_remarks"] }}</td>
                    <td style="width:100px;">{{ $value["visit_type"] }}</td>
                    <td style="width:100px;">{{ $value["visit_time"] }}</td>
                    <td style="width:100px;">{{ $value["followup_visit"] }}</td>
                    <td style="width:100px;">{{ $value["episode"] }}</td>
                    <td style="width:100px;">{{ $value["Reason for Visit"] }}</td>
                    <td style="width:100px;">{{ $value["Main Risk"] }}</td>
                    <td style="width:100px;">{{ $value["urethral_disc"] }}</td>
                    <td style="width:100px;">{{ $value["urethral_disc_hl"] }}</td>
                    <td style="width:100px;">{{ $value["dysuria"] }}</td>
                    <td style="width:100px;">{{ $value["dysuria_hl"] }}</td>
                    <td style="width:100px;">{{ $value["genital_prut"] }}</td>
                    <td style="width:100px;">{{ $value["genital_prut_hl"] }}</td>
                    <td style="width:100px;">{{ $value["genital_pain"] }}</td>
                    <td style="width:100px;">{{ $value["genital_pain_hl"] }}</td>
                    <td style="width:100px;">{{ $value["genital_ulcer"] }}</td>
                    <td style="width:100px;">{{ $value["genital_ulcer_hl"] }}</td>
                    <td style="width:100px;">{{ $value["pain"] }}</td>
                    <td style="width:100px;">{{ $value["ulcer"] }}</td>
                    <td style="width:100px;">{{ $value["prodromal_itch"] }}</td>
                    <td style="width:100px;">{{ $value["vesicles"] }}</td>
                    <td style="width:100px;">{{ $value["recurrent"] }}</td>
                    <td style="width:100px;">{{ $value["last_episode"] }}</td>
                    <td style="width:100px;">{{ $value["suspects_herpes"] }}</td>
                    <td style="width:100px;">{{ $value["ing_lymph_node"] }}</td>
                    <td style="width:100px;">{{ $value["ing_lymph_node_hl"] }}</td>
                    <td style="width:100px;">{{ $value["unilateal"] }}</td>
                    <td style="width:100px;">{{ $value["leg_ulcer"] }}</td>
                    <td style="width:100px;">{{ $value["scrotal_swelling"] }}</td>
                    <td style="width:100px;">{{ $value["scrotal_swelling_hl"] }}</td>
                    <td style="width:100px;">{{ $value["td_ntd"] }}</td>
                    <td style="width:100px;">{{ $value["gen_wart"] }}</td>
                    <td style="width:100px;">{{ $value["gen_wart_hl"] }}</td>
                    <td style="width:100px;">{{ $value["physical_exam"] }}</td>
                    <td style="width:100px;">{{ $value["urinated_wit_1h"] }}</td>
                    <td style="width:100px;">{{ $value["discharge"] }}</td>
                    <td style="width:100px;">{{ $value["discharge_milk"] }}</td>
                    <td style="width:100px;">{{ $value["colour"] }}</td>
                    <td style="width:100px;">{{ $value["erythema"] }}</td>
                    <td style="width:100px;">{{ $value["blisters"] }}</td>
                    <td style="width:100px;">{{ $value["gen_ulcer"] }}</td>
                    <td style="width:100px;">{{ $value["esti_size"] }}</td>
                    <td style="width:100px;">{{ $value["sing_multi"] }}</td>
                    <td style="width:100px;">{{ $value["pain_full_less"] }}</td>
                    <td style="width:100px;">{{ $value["herpes_suspect"] }}</td>
                    <td style="width:100px;">{{ $value["inguinal_bubo"] }}</td>
                    <td style="width:100px;">{{ $value["fluctant"] }}</td>
                    <td style="width:100px;">{{ $value["tendr_ntender"] }}</td>
                    <td style="width:100px;">{{ $value["oth_leg_inf"] }}</td>
                    <td style="width:100px;">{{ $value["phy_genital_wart"] }}</td>
                    <td style="width:100px;">{{ $value["crab_lice"] }}</td>
                    <td style="width:100px;">{{ $value["scabies"] }}</td>
                    <td style="width:100px;">{{ $value["gscrotal_swelling"] }}</td>
                    <td style="width:100px;">{{ $value["estimated_siz"] }}</td>
                    <td style="width:100px;">{{ $value["unilateal_bilateral"] }}</td>
                    <td style="width:100px;">{{ $value["gtender_ntender"] }}</td>
                    <td style="width:100px;">{{ $value["erythem"] }}</td>
                    <td style="width:100px;">{{ $value["des_size"] }}</td>
                    <td style="width:100px;">{{ $value["tbl_treat_diagnosis_first_visit"] }}</td>
                    <td style="width:100px;">{{ $value["epi_discharge"] }}</td>
                    <td style="width:100px;">{{ $value["unprot_sex_new_part"] }}</td>
                    <td style="width:100px;">{{ $value["genital_signs"] }}</td>
                    <td style="width:100px;">{{ $value["presumptive_diag"] }}</td>
                    <td style="width:100px;">{{ $value["pri_syphillis"] }}</td>
                    <td style="width:100px;">{{ $value["sec_syphillis"] }}</td>
                    <td style="width:100px;">{{ $value["chancroid"] }}</td>
                    <td style="width:100px;">{{ $value["gen_herpes"] }}</td>
                    <td style="width:100px;">{{ $value["gen_scabies"] }}</td>
                    <td style="width:100px;">{{ $value["gud_other"] }}</td>
                    <td style="width:100px;">{{ $value["other(please specify)"] }}</td>
                    <td style="width:100px;">{{ $value["Gonorhoea"] }}</td>
                    <td style="width:100px;">{{ $value["non_gono_urethritis"] }}</td>
                    <td style="width:100px;">{{ $value["non_gono_procti"] }}</td>
                    <td style="width:100px;">{{ $value["trichomonas"] }}</td>
                    <td style="width:100px;">{{ $value["genital_candidiosis"] }}</td>
                    <td style="width:100px;">{{ $value["beterial_vaginosis"] }}</td>
                    <td style="width:100px;">{{ $value["congenial_syphillis"] }}</td>
                    <td style="width:100px;">{{ $value["latent_syphillis"] }}</td>
                    <td style="width:100px;">{{ $value["molluscum_contag"] }}</td>
                    <td style="width:100px;">{{ $value["bubos"] }}</td>
                    <td style="width:100px;">{{ $value["othstd_genital_warts"] }}</td>
                    <td style="width:100px;">{{ $value["ostd_other"] }}</td>
                    <td style="width:100px;">{{ $value["tre_azythro"] }}</td>
                    <td style="width:100px;">{{ $value["tre_cefixim"] }}</td>
                    <td style="width:100px;">{{ $value["tre_ciprofloxacin"] }}</td>
                    <td style="width:100px;">{{ $value["tre_tinidazole"] }}</td>
                    <td style="width:100px;">{{ $value["tre_fluconazole"] }}</td>
                    <td style="width:100px;">{{ $value["tre_doxycycline"] }}</td>
                    <td style="width:100px;">{{ $value["tre_ceftriaxone"] }}</td>
                    <td style="width:100px;">{{ $value["tre_benz_pen"] }}</td>
                    <td style="width:100px;">{{ $value["no_treat"] }}</td>
                    <td style="width:100px;">{{ $value["al_Penicillin"] }}</td>
                    <td style="width:100px;">{{ $value["al_sulfa"] }}</td>
                    <td style="width:100px;">{{ $value["part_treat"] }}</td>
                    <td style="width:100px;">{{ $value["condom_giv"] }}</td>
                    <td style="width:100px;">{{ $value["tre_remarks"] }}</td>
                    <td style="width:100px;">{{ $value["followup"] }}</td>
                    <td style="width:100px;">{{ $value["clinician_name"] }}</td>
                          


                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>
