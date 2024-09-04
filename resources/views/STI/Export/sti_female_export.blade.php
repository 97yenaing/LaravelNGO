<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Export to Excel </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    table {
      border-collapse: collapse;
      font-size: 12px;
    }

    th,
    td {
      border: 2px solid black;
      height: 50px;
    }
  </style>
</head>

<body>
  <div class="container mt-5 text-center">
    <form>
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
            <th style="background-color:#a6a6a6;">first visit</th>

            <th style="background-color:#a6a6a6;">last_vis_within</th>
            <th style="background-color:#a6a6a6;">visit_type</th>
            <th style="background-color:#a6a6a6;">about_clinic</th>
            <th style="background-color:#a6a6a6;">demo_remarks</th>


            <th style="background-color:#a6a6a6;">episode</th>
            <th style="background-color:#a6a6a6;">Reason for Visit</th>
            <th style="background-color:#a6a6a6;">Main Risk</th>
            <th style="background-color:#a6a6a6;">Sub Risk</th>

            <th style="background-color:#a6a6a6;">abn_vaginal_disc</th>
            <th style="background-color:#a6a6a6;">abn_vaginal_disc_long</th>
            <th style="background-color:#a6a6a6;">linked_menstru</th>
            <th style="background-color:#a6a6a6;">amount</th>
            <th style="background-color:#a6a6a6;">colour</th>
            <th style="background-color:#a6a6a6;">colour_oth</th>
            <th style="background-color:#a6a6a6;">abn_veginal_odour</th>
            <th style="background-color:#a6a6a6;">l_abn_pain</th>
            <th style="background-color:#a6a6a6;">l_abon_pain_hl</th>
            <th style="background-color:#a6a6a6;">fever</th>
            <th style="background-color:#a6a6a6;">rec_terminate_preg</th>
            <th style="background-color:#a6a6a6;">dyspareunia</th>
            <th style="background-color:#a6a6a6;">oth_GI_sympt</th>
            <th style="background-color:#a6a6a6;">dysuria</th>
            <th style="background-color:#a6a6a6;">dysuria_hl</th>
            <th style="background-color:#a6a6a6;">gen_prutitus</th>
            <th style="background-color:#a6a6a6;">gen_prutitus_hl</th>
            <th style="background-color:#a6a6a6;">gen_burn_pain</th>
            <th style="background-color:#a6a6a6;">gen_burn_pain_hl</th>
            <th style="background-color:#a6a6a6;">gen_ulcer</th>
            <th style="background-color:#a6a6a6;">gen_ulcer_hl</th>
            <th style="background-color:#a6a6a6;">pain</th>
            <th style="background-color:#a6a6a6;">ulcer</th>
            <th style="background-color:#a6a6a6;">prodromal_itch</th>
            <th style="background-color:#a6a6a6;">vesicles</th>
            <th style="background-color:#a6a6a6;">recurrent</th>
            <th style="background-color:#a6a6a6;">recurrent_last_episode</th>
            <th style="background-color:#a6a6a6;">patient_suspects_herpes</th>
            <th style="background-color:#a6a6a6;">inguinal_ln</th>
            <th style="background-color:#a6a6a6;">inguinal_ln_hl</th>
            <th style="background-color:#a6a6a6;">unilateal_Bilateral</th>
            <th style="background-color:#a6a6a6;">leg_ulcer_oth_inf</th>
            <th style="background-color:#a6a6a6;">genital_warts</th>
            <th style="background-color:#a6a6a6;">genital_warts_hl</th>
            <th style="background-color:#a6a6a6;">phy_exam_done</th>
            <th style="background-color:#a6a6a6;">washed_inside</th>
            <th style="background-color:#a6a6a6;">vulvar_erythema</th>
            <th style="background-color:#a6a6a6;">vulvar_odema</th>
            <th style="background-color:#a6a6a6;">vaginal_discharge</th>
            <th style="background-color:#a6a6a6;">vag_dis_amount</th>
            <th style="background-color:#a6a6a6;">homogeneous</th>
            <th style="background-color:#a6a6a6;">homogeneous_col</th>
            <th style="background-color:#a6a6a6;">smell_without_KOH</th>
            <th style="background-color:#a6a6a6;">vaginal_wall_injury</th>
            <th style="background-color:#a6a6a6;">adnexal_tenderness</th>
            <th style="background-color:#a6a6a6;">adnexal_enlargement</th>
            <th style="background-color:#a6a6a6;">genital_blisters</th>
            <th style="background-color:#a6a6a6;">genital_blisters_Location</th>
            <th style="background-color:#a6a6a6;">gential_ulcer</th>
            <th style="background-color:#a6a6a6;">gential_ulcerl</th>
            <th style="background-color:#a6a6a6;">gent_ulcer_sm</th>
            <th style="background-color:#a6a6a6;">gential_ulcer_pain</th>
            <th style="background-color:#a6a6a6;">susp_herpes</th>
            <th style="background-color:#a6a6a6;">inguinal_bubo</th>
            <th style="background-color:#a6a6a6;">fluctuant</th>
            <th style="background-color:#a6a6a6;">fluctuant_tender</th>
            <th style="background-color:#a6a6a6;">oth_leg_infection</th>
            <th style="background-color:#a6a6a6;">genital_wart</th>
            <th style="background-color:#a6a6a6;">crab_lice</th>
            <th style="background-color:#a6a6a6;">scablices</th>
            <th style="background-color:#a6a6a6;">KOH_smell_test</th>
            <th style="background-color:#a6a6a6;">pH_vagina</th>
            <th style="background-color:#a6a6a6;">des_size</th>
            <th style="background-color:#a6a6a6;">prev_STI</th>
            <th style="background-color:#a6a6a6;">patient_genital_ulcer</th>
            <th style="background-color:#a6a6a6;">patient_compl_low_abd</th>
            <th style="background-color:#a6a6a6;">new_pat_past_3mont</th>
            <th style="background-color:#a6a6a6;">part_compl_gential_sym</th>
            <th style="background-color:#a6a6a6;">sworker</th>
            <th style="background-color:#a6a6a6;">rg_score</th>
            <th style="background-color:#a6a6a6;">risk</th>
            <th style="background-color:#a6a6a6;">risk_cal_remark</th>
            <th style="background-color:#a6a6a6;">abn_yellow_disc</th>
            <th style="background-color:#a6a6a6;">dysuria_risk_ass</th>
            <th style="background-color:#a6a6a6;">low_abd_pain</th>
            <th style="background-color:#a6a6a6;">pain_dur_sexual</th>
            <th style="background-color:#a6a6a6;">unp_sex_new_clients</th>
            <th style="background-color:#a6a6a6;">partner_ulcer</th>
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
            <th style="background-color:#a6a6a6;">non_gono_cervities</th>
            <th style="background-color:#a6a6a6;">trichomonas</th>
            <th style="background-color:#a6a6a6;">genital_candidiosis</th>
            <th style="background-color:#a6a6a6;">beterial_vaginosis</th>
            <th style="background-color:#a6a6a6;">congenial_syphillis</th>
            <th style="background-color:#a6a6a6;">latent_syphillis</th>
            <th style="background-color:#a6a6a6;">latent_syphillis_preg</th>
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
            <th style="background-color:#a6a6a6;">tre_Other</th>
            <th style="background-color:#a6a6a6;">clotrimazole_vaginal_tab</th>
            <th style="background-color:#a6a6a6;">no_treatment</th>
            <th style="background-color:#a6a6a6;">al_Penicillin</th>
            <th style="background-color:#a6a6a6;">al_sulfa</th>
            <th style="background-color:#a6a6a6;">part_treat</th>
            <th style="background-color:#a6a6a6;">condom_giv</th>
            <th style="background-color:#a6a6a6;">tre_remarks</th>
            <th style="background-color:#a6a6a6;">followup</th>
            <th style="background-color:#a6a6a6;">clinician</th>
          </tr>
        </thead>

        <tbody>
          @foreach($users as $index => $value)
          <tr>

            <td style="width:100px;">{{ $value["Clinic Code"] }}</td>
            <td style="width:100px;">{{ $value["CID"] }}</td>
            <td style="width:100px;">{{ $value["FuchiaID"] }}</td>
            <td style="width:100px;">{{ $value["Gender"] }}</td>
            <td style="width:80px;">{{ $value["Reg year"]}}</td>
            <td style="width:80px;">{{ $value["Register Agey"] }}</td>
            <td style="width:80px;">{{ $value["Register Agem"] }}</td>
            <td style="width:80px;">{{ $value["Current Agey"] }}</td>
            <td style="width:80px;">{{ $value["Current Agem"] }}</td>
            <td style="width:100px;">{{ $value["Visit_date"] }}</td>
            <td style="width:100px;">{{$value["first_visit"]}}</td>



            <td style="width:100px;">{{ $value["last_vis_within"] }}</td>
            <td style="width:100px;">{{ $value["vtype"] }}</td>
            <td style="width:100px;">{{ $value["about_clinic"] }}</td>
            <td style="width:100px;">{{ $value["demo_remarks"] }}</td>

            <!-- <td style="width:100px;">{{ $value["visit_type"] }}</td>
            <td style="width:100px;">{{ $value["visit_time"] }}</td>
            <td style="width:100px;">{{ $value["followup_visit"] }}</td> -->
            <td style="width:100px;">{{ $value["episode"] }}</td>
            <td style="width:100px;">{{ $value["rea_for_visit"] }}</td>
            <td style="width:100px;">{{ $value["Main Risk"] }}</td>
            <td style="width:100px;">{{ $value["Sub Risk"] }}</td>
            <td style="width:100px;">{{ $value["abn_vaginal_disc"]}}</td>
            <td style="width:100px;">{{ $value["abn_vaginal_disc_long"]}}</td>
            <td style="width:100px;">{{ $value["linked_menstru"]}}</td>
            <td style="width:100px;">{{ $value["amount"]}}</td>
            <td style="width:100px;">{{ $value["colour"]}}</td>
            <td style="width:100px;">{{ $value["colour_oth"]}}</td>
            <td style="width:100px;">{{ $value["abn_veginal_odour"]}}</td>
            <td style="width:100px;">{{ $value["l_abn_pain"]}}</td>
            <td style="width:100px;">{{ $value["l_abon_pain_hl"]}}</td>
            <td style="width:100px;">{{ $value["fever"]}}</td>
            <td style="width:100px;">{{ $value["rec_terminate_preg"]}}</td>
            <td style="width:100px;">{{ $value["dyspareunia"]}}</td>
            <td style="width:100px;">{{ $value["oth_GI_sympt"]}}</td>
            <td style="width:100px;">{{ $value["dysuria"]}}</td>
            <td style="width:100px;">{{ $value["dysuria_hl"]}}</td>
            <td style="width:100px;">{{ $value["gen_prutitus"]}}</td>
            <td style="width:100px;">{{ $value["gen_prutitus_hl"]}}</td>
            <td style="width:100px;">{{ $value["gen_burn_pain"]}}</td>
            <td style="width:100px;">{{ $value["gen_burn_pain_hl"]}}</td>
            <td style="width:100px;">{{ $value["gen_ulcer"]}}</td>
            <td style="width:100px;">{{ $value["gen_ulcer_hl"]}}</td>
            <td style="width:100px;">{{ $value["pain"]}}</td>
            <td style="width:100px;">{{ $value["ulcer"]}}</td>
            <td style="width:100px;">{{ $value["prodromal_itch"]}}</td>
            <td style="width:100px;">{{ $value["vesicles"]}}</td>
            <td style="width:100px;">{{ $value["recurrent"]}}</td>
            <td style="width:100px;">{{ $value["recurrent_last_episode"]}}</td>
            <td style="width:100px;">{{ $value["patient_suspects_herpes"]}}</td>
            <td style="width:100px;">{{ $value["inguinal_ln"]}}</td>
            <td style="width:100px;">{{ $value["inguinal_ln_hl"]}}</td>
            <td style="width:100px;">{{ $value["unilateal_Bilateral"]}}</td>
            <td style="width:100px;">{{ $value["leg_ulcer_oth_inf"]}}</td>
            <td style="width:100px;">{{ $value["genital_warts"]}}</td>
            <td style="width:100px;">{{ $value["genital_warts_hl"]}}</td>
            <td style="width:100px;">{{ $value["phy_exam_done"]}}</td>
            <td style="width:100px;">{{ $value["washed_inside"]}}</td>
            <td style="width:100px;">{{ $value["vulvar_erythema"]}}</td>
            <td style="width:100px;">{{ $value["vulvar_odema"]}}</td>
            <td style="width:100px;">{{ $value["vaginal_discharge"]}}</td>
            <td style="width:100px;">{{ $value["vag_dis_amount"]}}</td>
            <td style="width:100px;">{{ $value["homogeneous"]}}</td>
            <td style="width:100px;">{{ $value["homogeneous_col"]}}</td>
            <td style="width:100px;">{{ $value["smell_without_KOH"]}}</td>
            <td style="width:100px;">{{ $value["vaginal_wall_injury"]}}</td>
            <td style="width:100px;">{{ $value["adnexal_tenderness"]}}</td>
            <td style="width:100px;">{{ $value["adnexal_enlargement"]}}</td>
            <td style="width:100px;">{{ $value["genital_blisters"]}}</td>
            <td style="width:100px;">{{ $value["genital_blisters_Location"]}}</td>
            <td style="width:100px;">{{ $value["gential_ulcer"]}}</td>
            <td style="width:100px;">{{ $value["gential_ulcerl"]}}</td>
            <td style="width:100px;">{{ $value["gent_ulcer_sm"]}}</td>
            <td style="width:100px;">{{ $value["gential_ulcer_pain"]}}</td>
            <td style="width:100px;">{{ $value["susp_herpes"]}}</td>
            <td style="width:100px;">{{ $value["inguinal_bubo"]}}</td>
            <td style="width:100px;">{{ $value["fluctuant"]}}</td>
            <td style="width:100px;">{{ $value["fluctuant_tender"]}}</td>
            <td style="width:100px;">{{ $value["oth_leg_infection"]}}</td>
            <td style="width:100px;">{{ $value["genital_wart"]}}</td>
            <td style="width:100px;">{{ $value["crab_lice"]}}</td>
            <td style="width:100px;">{{ $value["scablices"]}}</td>
            <td style="width:100px;">{{ $value["KOH_smell_test"]}}</td>
            <td style="width:100px;">{{ $value["pH_vagina"]}}</td>
            <td style="width:100px;">{{ $value["des_size"]}}</td>
            <td style="width:100px;">{{ $value["prev_STI"]}}</td>
            <td style="width:100px;">{{ $value["patient_genital_ulcer"]}}</td>
            <td style="width:100px;">{{ $value["patient_compl_low_abd"]}}</td>
            <td style="width:100px;">{{ $value["new_pat_past_3mont"]}}</td>
            <td style="width:100px;">{{ $value["part_compl_gential_sym"]}}</td>
            <td style="width:100px;">{{ $value["sworker"]}}</td>
            <td style="width:100px;">{{ $value["rg_score"]}}</td>
            <td style="width:100px;">{{ $value["risk"]}}</td>
            <td style="width:100px;">{{ $value["risk_cal_remark"]}}</td>
            <td style="width:100px;">{{ $value["abn_yellow_disc"]}}</td>
            <td style="width:100px;">{{ $value["dysuria_risk_ass"]}}</td>
            <td style="width:100px;">{{ $value["low_abd_pain"]}}</td>
            <td style="width:100px;">{{ $value["pain_dur_sexual"]}}</td>
            <td style="width:100px;">{{ $value["unp_sex_new_clients"]}}</td>
            <td style="width:100px;">{{ $value["partner_ulcer"]}}</td>
            <td style="width:100px;">{{ $value["presumptive_diag"]}}</td>
            <td style="width:100px;">{{ $value["pri_syphillis"]}}</td>
            <td style="width:100px;">{{ $value["sec_syphillis"]}}</td>
            <td style="width:100px;">{{ $value["chancroid"]}}</td>
            <td style="width:100px;">{{ $value["gen_herpes"]}}</td>
            <td style="width:100px;">{{ $value["gen_scabies"]}}</td>
            <td style="width:100px;">{{ $value["gud_other"]}}</td>
            <td style="width:100px;">{{ $value["other(please specify)"]}}</td>
            <td style="width:100px;">{{ $value["Gonorhoea"]}}</td>
            <td style="width:100px;">{{ $value["non_gono_urethritis"]}}</td>
            <td style="width:100px;">{{ $value["non_gono_cervities"]}}</td>
            <td style="width:100px;">{{ $value["trichomonas"]}}</td>
            <td style="width:100px;">{{ $value["genital_candidiosis"]}}</td>
            <td style="width:100px;">{{ $value["beterial_vaginosis"]}}</td>
            <td style="width:100px;">{{ $value["congenial_syphillis"]}}</td>
            <td style="width:100px;">{{ $value["latent_syphillis"]}}</td>
            <td style="width:100px;">{{ $value["latent_syphillis_preg"]}}</td>
            <td style="width:100px;">{{ $value["molluscum_contag"]}}</td>
            <td style="width:100px;">{{ $value["bubos"]}}</td>
            <td style="width:100px;">{{ $value["othstd_genital_warts"]}}</td>
            <td style="width:100px;">{{ $value["ostd_other"]}}</td>
            <td style="width:100px;">{{ $value["tre_azythro"]}}</td>
            <td style="width:100px;">{{ $value["tre_cefixim"]}}</td>
            <td style="width:100px;">{{ $value["tre_ciprofloxacin"]}}</td>
            <td style="width:100px;">{{ $value["tre_tinidazole"]}}</td>
            <td style="width:100px;">{{ $value["tre_fluconazole"]}}</td>
            <td style="width:100px;">{{ $value["tre_doxycycline"]}}</td>
            <td style="width:100px;">{{ $value["tre_ceftriaxone"]}}</td>
            <td style="width:100px;">{{ $value["tre_benz_pen"]}}</td>
            <td style="width:100px;">{{ $value[""]}}</td> <!--insert tre_other to no_treatment -->
            <td style="width:100px;">{{ $value["clotrimazole_vaginal_tab"]}}</td>
            <td style="width:100px;">{{ $value["tre_Other"]}}</td><!-- no_treatment -->
            <td style="width:100px;">{{ $value["al_Penicillin"]}}</td>
            <td style="width:100px;">{{ $value["al_sulfa"]}}</td>
            <td style="width:100px;">{{ $value["part_treat"]}}</td>
            <td style="width:100px;">{{ $value["condom_giv"]}}</td>
            <td style="width:100px;">{{ $value["tre_remarks"]}}</td>
            <td style="width:100px;">{{ $value["followup"]}}</td>
            <td style="width:100px;">{{ $value["clinician"]}}</td>>





          </tr>
          @endforeach
        </tbody>
      </table>





    </form>
  </div>
</body>

</html>