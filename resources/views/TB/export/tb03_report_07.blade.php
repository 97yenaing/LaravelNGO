
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" media="screen" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    {{-- @dd($cal_resultes); --}}
   
    <form action="{{ route('tb03_report_view') }}" method="get" style="padding: 0px 16% 0px ;">
        @csrf
            <table>
                <tbody>
                    <tr>
                        <td style="color:#000000" colspan="3">Select State/Region Name:</td>
                        <td colspan="4" style="color:#000000" id="tb_headerRegion"></td>
                    </tr>
                </tbody>
            </table>
        
            
            
            <table style="
                        color: #000000;
                        border-color: #000000;">
                <thead>
                    <tr >
                        <td style="text-align:center" colspan="26"><h4>National Tuberculosis Programme
                        <br>Quarterly Report on TB Case Registration (TB - 07)</h4></td>

                    </tr>
                </thead>
                
                <tbody style="border:1px solid #000000" >
                    <tr style="border:1px solid #000000">
                        <td style="border:1px solid #000000" colspan="4">Name of townships/code no</td>
                        <td style="border:1px solid #000000" colspan="4" id="tb-rpTown"></td>
                        <td style="border:1px solid #000000" rowspan="2" colspan="9">Patients registered during</td>
                        <td style="border:1px solid #000000" rowspan="2" colspan="9">Date of Completion of this form:</td>
                    </tr>
                    <tr style="border:1px solid #000000">
                        <td colspan="4" >Region/State:</td>
                        <td style="border:1px solid #000000;" colspan="4" id="tb_region"></td>
                        
                    </tr>
                    
                
                    <tr style="border:1px solid #000000">
                        <td style="border-bottom:1px solid #000000;" colspan="4">Name of Township TB coordinator </td>
                        <td style="border:1px solid #000000;" colspan="4" id="tb_rpcoordi"></td>
                        <td style="border:1px solid #000000;"colspan="9" id="tb_patientDuring"></td>
                        <td style="border:1px solid #000000;"colspan="9" id="rp_complDate"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border-bottom:1px solid; height:30px"  > Area population</td>
                            <td>_________________________</td>
                    </tr>
                    <tr >
                        <td style="border-bottom:1px solid; height:50px" colspan="4" >CNR (Bacteriologically confirmed)=<br> 
                                        (Per 100000 pop.)                                          
                        </td>
                        <td style="border-bottom:1px solid; height:50px"colspan="4" ><u>Block (1), Row (1) x 100,000</u><br>
                                    Population
                        </td>
                                
                    </tr>
                    <tr >
                        <td style="border-bottom:1px solid; height:50px" colspan="4" >CNR (All TB cases) =<br> 
                            (Per 100,000 pop.)                                          
                        </td>
                        <td style="border-bottom:1px solid; height:50px" colspan="4"><u> Block (1), Row (1+2+3) x 100,000</u><br>
                                    Population
                        </td>
                                
                    </tr>
                </tbody>
            </table>

            <table style="color:#000000">
                <thead><tr><td>Block 1: All TB cases registered during the quarter except Transfer in patients</td></tr></thead>
            </table><!-- Block 1 table heading -->
            <table>
                <thead></thead>
                <tbody style="border:1px solid #000000; color:#000000">
                    <tr style="border:1px solid #000000">
                        <td style="border:1px solid #000000"rowspan="3" colspan="3"> Type of patient<br>/Type of Disease</td>
                        <td style="border:1px solid #000000"rowspan="2" colspan="2">New</td>
                        <td style="border:1px solid #000000"colspan="6">Re-treatment Cases (choose one)</td>
                        <td style="border:1px solid #000000"rowspan="2"colspan="2">Total</td>
                        <td style="border:1px solid #000000" rowspan="3" colspan="2">Grand Total</td>
                    </tr>
                    <tr style="border:1px solid #000000">
                        
                        <td style="border:1px solid #000000" colspan="2">Relapse</td>
                        <td style="border:1px solid #000000" colspan="2">Previously treated  (excluding relapse)</td>
                        <td style="border:1px solid #000000" colspan="2">Unknown previous treatment history</td>
                        
                    </tr>
                    <tr>
                        
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000000" colspan="3">Pulmonary, bacteriologically confirmed</td>
                        <td style="border:1px solid #000000" id="1new_m">{{$cal_resultes["b1_pbc_new_male"]}}</td>
                        <td style="border:1px solid #000000" id="1new_f">{{$cal_resultes["b1_pbc_new_female"]}}</td>
                        <td style="border:1px solid #000000" id="1relp_m">{{$cal_resultes["b1_pbc_relapse_male"]}}</td>
                        <td style="border:1px solid #000000" id="1relp_f">{{$cal_resultes["b1_pbc_relapse_female"]}}</td>
                        <td style="border:1px solid #000000" id="1prevTreat_m">{{$cal_resultes["b1_pbc_Ptreat_male"]}}</td>
                        <td style="border:1px solid #000000" id="1prevTreat_f">{{$cal_resultes["b1_pbc_Ptreat_female"]}}</td>
                        <td style="border:1px solid #000000" id="1unprevTreat_m">{{$cal_resultes["b1_pbc_UPtreat_male"]}}</td>
                        <td style="border:1px solid #000000" id="1unprevTreat_f">{{$cal_resultes["b1_pbc_UPtreat_female"]}}</td>
                        <td style="border:1px solid #000000" id="1relpaseCasetotal_m">{{$cal_resultes["b1_pbc_total_male"]}}</td>
                        <td style="border:1px solid #000000" id="1relpaseCasetotal_f">{{$cal_resultes["b1_pbc_total_female"]}}</td>
                        <td style="border:1px solid #000000" id="1relpaseCase_Grandtotal_f" colspan="2">{{$cal_resultes["b1_pbc_Gtotal"]}}</td>

                        
                    </tr>
                    <tr>
                        <td style="border:1px solid #000000" colspan="3">Pulmonary, clinically diagnosed</td>
                        <td style="border:1px solid #000000" id="2new_m">{{$cal_resultes["b1_pcd_new_male"]}}</td>
                        <td style="border:1px solid #000000" id="2new_f">{{$cal_resultes["b1_pcd_new_female"]}}</td>
                        <td style="border:1px solid #000000" id="2relp_m">{{$cal_resultes["b1_pcd_relapse_male"]}}</td>
                        <td style="border:1px solid #000000" id="2relp_f">{{$cal_resultes["b1_pcd_relapse_female"]}}</td>
                        <td style="border:1px solid #000000" id="2prevTreat_m">{{$cal_resultes["b1_pcd_Ptreat_male"]}}</td>
                        <td style="border:1px solid #000000" id="2prevTreat_f">{{$cal_resultes["b1_pcd_Ptreat_female"]}}</td>
                        <td style="border:1px solid #000000" id="2unprevTreat_m">{{$cal_resultes["b1_pcd_UPtreat_male"]}}</td>
                        <td style="border:1px solid #000000" id="2unprevTreat_f">{{$cal_resultes["b1_pcd_UPtreat_female"]}}</td>
                        <td style="border:1px solid #000000" id="2relpaseCasetotal_m">{{$cal_resultes["b1_pcd_total_male"]}}</td>
                        <td style="border:1px solid #000000" id="2relpaseCasetotal_f">{{$cal_resultes["b1_pcd_total_female"]}}</td>
                        <td style="border:1px solid #000000" colspan="2" >{{$cal_resultes["b1_pcd_Gtotal"]}}</td>                           
                    </tr>
                    <tr>
                        <td style="border:1px solid #000000" colspan="3">Extra pulmonary, bacteriologically confirmed </td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_new_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_new_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_relapse_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_relapse_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_Ptreat_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_Ptreat_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_UPtreat_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_UPtreat_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_total_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epbc_total_female"]}}</td>
                        <td style="border:1px solid #000000" colspan="2" >{{$cal_resultes["b1_epbc_Gtotal"]}}</td>           
                    </tr>
                    <tr>
                        <td style="border:1px solid #000000" colspan="3">Extra pulmonary, clinically diagnosed  </td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_new_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_new_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_relapse_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_relapse_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_Ptreat_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_Ptreat_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_UPtreat_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_UPtreat_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_total_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_epcd_total_female"]}}</td>
                        <td style="border:1px solid #000000" colspan="2" >{{$cal_resultes["b1_epcd_Gtotal"]}}</td>                              
                    </tr>
                    <tr>
                        <td style="border:1px solid #000000" colspan="3">Total TB Case </td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_new_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_new_female" ]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_relapse_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_relapse_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_Ptreat_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_Ptreat_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_UPtreat_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_UPtreat_female"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_total_male"]}}</td>
                        <td style="border:1px solid #000000" >{{$cal_resultes["b1_total_tb_total_female"]}}</td>
                        <td style="border:1px solid #000000" colspan="2" >{{$cal_resultes[ "b1_total_tb_Gtotal"]}}</td>              
                    </tr>
                    

                </tbody>

            </table> <!-- Block 1 table -->

            <table style="color:#000000;">
                <thead><tr><td>Block 2: All new and relapse cases (bacteriologically confirmed or clinically diagnosed)
                     registered during the quarter by age group and<br> sex</td></tr></thead>
            </table><!-- Block 2 table heading -->

            <table style="color:#000000;border:1px solid #000000">
                <thead></thead>
                <tbody >
                <tr style="border:1px solid #000000">
                    <td style="border:1px solid #000000" rowspan="2">Age/<br>Type of Patients</td>
                    <td style="border:1px solid #000000" colspan="2">0-4</td>
                    <td style="border:1px solid #000000" colspan="2">5-9</td>
                    <td style="border:1px solid #000000" colspan="2">10-14</td>
                    <td style="border:1px solid #000000" colspan="2">15-24</td>
                    <td style="border:1px solid #000000" colspan="2">25-34</td>
                    <td style="border:1px solid #000000" colspan="2">35-44</td>
                    <td style="border:1px solid #000000" colspan="2">45-54</td>
                    <td style="border:1px solid #000000" colspan="2">55-64</td>
                    <td style="border:1px solid #000000" colspan="2">&gt;= 65</td>
                    <td style="border:1px solid #000000" colspan="2">Total</td>
                    <td style="border:1px solid #000000" rowspan="2">Grand Total</td>
                </tr>
                <tr>  
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                </tr>
                <tr>
                    <td style="color:#000000;border:1px solid #000000">New</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_0_4"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_0_4"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_5_9"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_5_9"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_10_14"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_10_14"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_15_24"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_15_24"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_25_34"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_25_34"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_35_44"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_35_44"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_45_54"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_45_54"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_55_64"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_55_64"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_male_65"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_new_female_65"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_age_new_total_male"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_age_new_total_female"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_age_new_total_Gtotal"]}}</td>

                </tr>
                <tr>
                    <td style="color:#000000;border:1px solid #000000">Relapse</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_0_4"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_0_4"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_5_9"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_5_9"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_10_14"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_10_14"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_15_24"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_15_24"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_25_34"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_25_34"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_35_44"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_35_44"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_45_54"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_45_54"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_55_64"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_55_64"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_male_65"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_relapse_female_65"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_age_relapse_total_male"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_age_relapse_total_female"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" >{{$cal_resultes["b2_age_relapse_total_Gtotal"]}}</td>

                </tr>
                <tr>
                    <td style="color:#000000;border:1px solid #000000">Total</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt0_4_m">{{$cal_resultes["b2_new_male_0_4"]+$cal_resultes["b2_relapse_male_0_4"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt0_4_f">{{$cal_resultes["b2_new_female_0_4"]+$cal_resultes["b2_relapse_female_0_4"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt5_9_m">{{$cal_resultes["b2_new_male_5_9"]+$cal_resultes["b2_relapse_male_5_9"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt5_9_f">{{$cal_resultes["b2_new_female_5_9"]+$cal_resultes["b2_relapse_female_5_9"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt10_14_m">{{$cal_resultes["b2_new_male_10_14"]+$cal_resultes["b2_relapse_male_10_14"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt10_14_f">{{$cal_resultes["b2_new_female_10_14"]+$cal_resultes["b2_relapse_female_10_14"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt15_24_m">{{$cal_resultes["b2_new_male_15_24"]+$cal_resultes["b2_relapse_male_15_24"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt15_24_f">{{$cal_resultes["b2_new_female_15_24"]+$cal_resultes["b2_relapse_female_15_24"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt25_34_m">{{$cal_resultes["b2_new_male_25_34"]+$cal_resultes["b2_relapse_male_25_34"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt25_34_f">{{$cal_resultes["b2_new_female_25_34"]+$cal_resultes["b2_relapse_female_25_34"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt35_44_m">{{$cal_resultes["b2_new_male_35_44"]+$cal_resultes["b2_relapse_male_35_44"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt35_44_f">{{$cal_resultes["b2_new_female_35_44"]+$cal_resultes["b2_relapse_female_35_44"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt45_54_m">{{$cal_resultes["b2_new_male_45_54"]+$cal_resultes["b2_relapse_male_45_54"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt45_54_f">{{$cal_resultes["b2_new_female_45_54"]+$cal_resultes["b2_relapse_female_45_54"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt55_64_m">{{$cal_resultes["b2_new_male_55_64"]+$cal_resultes["b2_relapse_male_55_64"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt55_64_f">{{$cal_resultes["b2_new_female_55_64"]+$cal_resultes["b2_relapse_female_55_64"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt65_m">{{$cal_resultes["b2_new_male_65"]+$cal_resultes["b2_relapse_male_65"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tt65_f">{{$cal_resultes["b2_new_female_65"]+$cal_resultes["b2_relapse_female_65"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tttotal_m">{{$cal_resultes["b2_age_new_total_male"]+$cal_resultes["b2_age_relapse_total_male"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_tttotal_f">{{$cal_resultes["b2_age_new_total_female"]+$cal_resultes["b2_age_relapse_total_female"]}}</td>
                    <td style="color:#000000;border:1px solid #000000" id="b2_ttGran_total">{{$cal_resultes["b2_age_new_total_Gtotal"]+$cal_resultes["b2_age_relapse_total_Gtotal"]}}</td>

                </tr>


                </tbody>
            </table><!-- Block 2 table -->

            <table style="color:#000000;">
                <thead><tr><td>Childhood TB Meningitis by Age group and Sex</td></tr></thead>
            </table><!--ChildHood Heading-->


            <table style="color:#000000;border:1px solid #000000">
                <thead></thead>
                <tbody>
                    <tr style="border:1px solid #000000">
                        <td style="border:1px solid #000000" colspan="2">0 – 4</td>
                        <td style="border:1px solid #000000" colspan="2">5 – 9</td>
                        <td style="border:1px solid #000000" colspan="2">10 – 14</td>
                        <td style="border:1px solid #000000" colspan="2">Total</td>
                        <td style="border:1px solid #000000" rolspan="2">Grand Total</td>
                    </tr>
                    <tr style="border:1px solid #000000">
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                        <td style="border:1px solid #000000">M</td>
                        <td style="border:1px solid #000000">F</td>
                    </tr>
                    <tr style="border:1px solid #000000">
                        
                        <td style="color:#000000;border:1px solid #000000" id="child0_4_m">{{$cal_resultes["child_0_4_male"]}}</td>
                        <td style="color:#000000;border:1px solid #000000" id="child0_4_f">{{$cal_resultes["child_0_4_female"]}}</td>
                        <td style="color:#000000;border:1px solid #000000" id="child5_9_m">{{$cal_resultes["child_5_9_male"]}}</td>
                        <td style="color:#000000;border:1px solid #000000" id="child5_9_f">{{$cal_resultes["child_5_9_female"]}}</td>
                        <td style="color:#000000;border:1px solid #000000" id="child10_14_m">{{$cal_resultes["child_10_14_male"]}}</td>
                        <td style="color:#000000;border:1px solid #000000" id="child10_14_f">{{$cal_resultes["child_10_14_female"]}}</td>
                        <td style="color:#000000;border:1px solid #000000" id="childtotal_m">{{$cal_resultes["child_total_male"]}}</td>
                        <td style="color:#000000;border:1px solid #000000" id="childtotal_f">{{$cal_resultes["child_total_female"]}}</td>
                        <td style="color:#000000;border:1px solid #000000" id="childGran_total">{{$cal_resultes["child_total_male"]+$cal_resultes["child_total_female"]}}</td>
                    </tr>

                </tbody>
            </table><!--ChildHood table-->

            <table style="color:#000000;">
                <thead><tr><td>Block 3: Laboratory diagnostic and follow-up activity</td></tr></thead>
            </table><!--B3 heading-->

            <table style="color:#000000;border:1px solid #000000">
                <thead></thead>
                    <tbody>
                        <tr style="border:1px solid #000000">
                            <td style="border:1px solid #000000"></td>
                            <td style="border:1px solid #000000">Smear</td>
                            <td style="border:1px solid #000000">Xpert Test</td>
                        </tr>
                        <tr style="border:1px solid #000000">
                            <td style="border:1px solid #000000"> (a) Patients with presumptive TB for Diagnosis (Dx)</td>
                            <td style="border:1px solid #000000"id="b3a_smear"></td>
                            <td style="border:1px solid #000000"id="b3a_xpert"></td>
                        </tr>
                        <tr style="border:1px solid #000000">
                            <td style="border:1px solid #000000"> (b) Number of Patients with positive bacteriological results out of Diagnosis (Dx)</td>
                            <td style="border:1px solid #000000"id="b3b_smear"></td>
                            <td style="border:1px solid #000000"id="b3b_xpert"></td>
                        </tr>
                        <tr style="border:1px solid #000000">
                            <td style="border:1px solid #000000"> (c) Number of patients examined for follow-up</td>
                            <td style="border:1px solid #000000"id="b3c_smear"></td>
                            <td style="border:1px solid #000000"id="b3c_xpert"></td>
                        </tr>
                        <tr style="border:1px solid #000000">
                            <td style="border:1px solid #000000"> (d) Number of positive patients out of follow-up</td>
                            <td style="border:1px solid #000000"id="b3d_smear"></td>
                            <td style="border:1px solid #000000"id="b3d_xpert"></td>
                        </tr>
                    </tbody>
               
            </table><!--B3 table-->
           
            <table style="color:#000000;">
                <thead><tr><td>Block 4: TB/HIV activities (all TB cases registered during the quarter)</td></tr></thead>
            </table><!--B3 heading-->

            <table style="color:#000000;">
                <thead></thead>
                <tbody style="border:1px solid #000000">
                    <tr>
                        <td style="border:1px solid #000000; height:100px" colspan="6">
                            Number of patients tested for HIV or/and known HIV status<br>
                            (Pos / Neg) at the time of Diagnosis registered in the Township
                            <br>TB register
                        </td>
                        <td style="border:1px solid #000000"colspan="7">
                            No. of HIV-positive      TB<br> patients
                        </td>
                        <td style="border:1px solid #000000"colspan="7">
                            HIV-positive TB patients<br>  Start CPT and ongoing CPT
                        </td>
                        <td style="border:1px solid #000000"colspan="6">
                        No. of HIV + TB patients Start ART<br> and ongoing ART
                        </td>
                    </tr>
                    <tr>
                        <td id="tb_registerPosNeg" style="border:1px solid #000000" colspan="6">
                            {{$cal_resultes["b4_HIV_know"]}}
                        </td>
                        <td id="tb_hiv_pos" style="border:1px solid #000000"colspan="7">
                            {{$cal_resultes["b4_HIV_Positvie"]}}
                        </td>
                        <td id="tb_hivPos_cptON"style="border:1px solid #000000"colspan="7">
                            {{$cal_resultes["b4_HIV_Positvie_S_CPT"]}}
                        </td>
                        <td id="tb_artStart" style="border:1px solid #000000"colspan="6">
                            {{$cal_resultes["b4_HIV_Positvie_S_ART"]}}
                        </td>
                    </tr>
                    <tr style="border-top:1px solid #000000">
                        <td >a</td>
                        <td  colspan="5">No. of treated TB Patients with DM</td>
                        <td  colspan="2"></td>
                        <td id="tb_noWdm" style="border-bottom:1px solid #000000"colspan="2">{{$cal_resultes["TB_DM"]}}</td>
                        <td colspan="16">(Base on the DM Status of TB07 column "N")</td>
                    </tr>
                    <tr>
                        <td>b</td>
                        <td  colspan="5">Total smokers</td>
                        <td  colspan="2">Current</td>
                        <td id="tb_smCurrent" style="border-bottom:1px solid #000000"colspan="2">{{$cal_resultes["smoke_current"]}}</td>
                        <td  colspan="3">Past</td>
                        <td id="tb_smPast" style="border-bottom:1px solid #000000"colspan="3">{{$cal_resultes["smoke_past"]}}</td>
                        <td  colspan="2">Never</td>
                        <td id="tb_smNever" style="border-bottom:1px solid #000000"colspan="2">{{$cal_resultes["smoke_never"]}}</td>
                        <td  colspan="3">Unknown</td>
                        <td id="tb_smUnkow" style="border-bottom:1px solid #000000"colspan="3">{{$cal_resultes["smoke_unkown"]}}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #000000">
                        <td>c</td>
                        <td  colspan="5">Nationality - </td>
                        <td  colspan="2">National</td>
                        <td id="tb_National" style="border-bottom:1px solid #000000"colspan="2">{{$cal_resultes["national"]}}</td>
                        <td  colspan="8">Non-national</td>
                        
                        <td id="tb_nonNational" style="border-bottom:1px solid #000000"colspan="2">{{$cal_resultes["nannational"]}}</td>
                        <td  colspan="6"></td>
                    </tr >
                    <tr>
                        <td><b>IR</b></td>
                        <td style="border-bottom:1px solid #000000;font-weight:900" id="tb_ir">{{$cal_resultes["IR"]}}</td>
                        <td>Case</td>
                        <td><b>RR</b></td>
                        <td style="border-bottom:1px solid #000000;font-weight:900" id="tb_pr">{{$cal_resultes["RR"]}}</td>
                        <td colspan="2">Case</td>
                        <td></td>
                        <td><b>CR</b></td>
                        <td></td>
                        <td style="border-bottom:1px solid #000000;font-weight:900" id="tb_cr" colspan="2">{{$cal_resultes["CR"]}}</td>
                        <td colspan="2">Case</td>
                        <td><b>MR</b></td>
                        <td></td>
                        <td style="border-bottom:1px solid #000000;font-weight:900" id="tb_mr" colspan="2">{{$cal_resultes["MR"]}}</td>
                        <td></td>
                        <td><b>Total</b></td>
                        <td style="border-bottom:1px solid #000000;font-weight:900" id="tb_case_total" colspan="2">{{$cal_resultes["IR"]+$cal_resultes["RR"]+$cal_resultes["CR"]+$cal_resultes["MR"]}}</td>
                        <td></td>
                        <td colspan="2">Case</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Transfer In:</td>
                        <td colspan="2" style="text-align:right">Male</td>
                        <td colspan="2" style="border-bottom:1px solid #000000" id="tb_b4Male">{{$cal_resultes["transfer_male"]}}</td>
                        <td colspan="2"></td>
                        <td colspan="2" style="text-align:right">Female</td>
                        <td colspan="2" style="border-bottom:1px solid #000000" id="tb_b4female">{{$cal_resultes["transfer_female"]}}</td>
                        <td >;</td>
                        <td colspan="2" style="text-align:right">Total</td>
                        <td ></td>
                        <td colspan="2" style="border-bottom:1px solid #000000" id="tb_b4total">{{$cal_resultes["transfer_male"]+$cal_resultes["transfer_female"]}}</td>
                    </tr>

                </tbody>
            </table>

            <table>
                <thead></thead>
                <tbody style="color:#000000">
                    <tr>
                        <td>d</td>
                        <td colspan="7">Total No. of relapse patients who were tested Gene Xpert </td>
                        <td colspan="4"></td>
                        <td colspan="2"style="border-bottom:1px solid #000000" id="tb_b4d">{{$cal_resultes["relapse_Gen_xpert"]}}</td>

                    </tr>
                    <tr>
                        <td>e</td>
                        <td colspan="7">Total No. of relapse patients who were diagnosis RR+ </td>
                        <td colspan="4"></td>
                        <td colspan="2"style="border-bottom:1px solid #000000" id="tb_b4e">{{$cal_resultes["relapse_Gen_xpert_RR"]}}</td>
                        
                    </tr>
                    <tr>
                        <td>f</td>
                        <td colspan="7">DST Coverage among register TB Cases </td>
                        <td colspan="4"></td>
                        <td colspan="2" style="border-bottom:1px solid #000000" id="tb_b4f">{{$cal_resultes["DSTD_case"]}}</td>
                        <td></td>
                        <td><i>100%</i></td>
                        
                    </tr>
                    <tr>
                        <td colspan="2"><b>Remark-</b></td>
                        <td colspan="24" style="border-bottom:1px dotted #000000"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Countersigned by</td>
                    </tr>
                    <tr>
                    
                        <td colspan="2" style="border-bottom">Signature:</td>
                        <td colspan="4" style="border-bottom:1px solid #000000" id="sign1"></td>
                        <td colspan="8"></td>
                        <td colspan="2"style="text-align:right">Signature:</td>
                        <td colspan="4" style="border-bottom:1px solid #000000" id="sign2"></td>
                    </tr>
                    <tr>
                    
                        <td colspan="2" style="border-bottom">Name:</td>
                        <td colspan="4" style="border-bottom:1px solid #000000" id="name1"></td>
                        <td colspan="8"></td>
                        <td colspan="2"style="text-align:right">Name:</td>
                        <td colspan="4" style="border-bottom:1px solid #000000" id="name2"></td>
                    </tr>
                    <tr>
                    
                        <td colspan="2" style="border-bottom">Designation:</td>
                        <td colspan="4" style="border-bottom:1px solid #000000" id="desig1"></td>
                        <td colspan="8"></td>
                        <td colspan="2"style="text-align:right">Designation:</td>
                        <td colspan="4" style="border-bottom:1px solid #000000" id="designa2"></td>
                    </tr>
                </tbody>
            </table>
            @if ($cal_resultes["report_type"]=="Report_view")
                {{-- <div class="row" style="justify-content:center">
                    <div class="col-sm-2">
                        <button class="btn btn-info">Go to TB03</button>
                    </div>
                </div> --}}
                <button class="btn btn-info" style="margin: 30px 43% 20px;
                font-size: 20px;">Go to TB03</button>
               
            @endif
       
        <!-- Generate Qtr Report_TB 07 Ok above Table --> 


        {{-- <div>
            <table>
                <tbody>
                    <tr>
                        <td style="color:#000000" colspan="3">Select State/Region Name:</td>
                        <td colspan="4" style="color:#000000" id="tb_headerRegion_08"></td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <td  colspan="46" style="text-align:center;color:#000000">Quarterly report on the ouotcome 
                        of TB patient registered 12-15 months earlier (TB - 08)</td>
                    </tr></thead>
                <tbody style="color:#000000 ;border:1px solid #000000" >
                    <tr>
                        <td colspan="6">Name of township</td>
                        <td></td>
                        <td colspan="7" style="background-color:#adb5bd; border-bottom:1px solid #000000" id="t8_township"></td>
                        <td style="border-right:1px solid #000000;" colspan="2"></td>
                        <td colspan="7">Patient registered during </td>
                        <td></td>
                        <td colspan="4" style="background-color:#adb5bd; border-bottom:1px solid #000000" id="t8_registerDuring"></td>
                        <td style="border-right:1px solid #000000;"></td>

                    </tr>
                    <tr>
                        <td colspan="6">Township code no.</td>
                        <td></td>
                        <td colspan="7" style="border-bottom:1px solid #000000" id="t8_Tcode"></td>
                        <td style="border-right:1px solid #000000;" colspan="2"></td>
                        <td>of</td>
                        <td colspan="3" style="background-color:#adb5bd;border-bottom:1px solid #000000" id="t8_of"></td>
                        <td style="border-right:1px solid #000000;"colspan="9"></td>
                        <td colspan="9">Date of completion of this form:</td>
                        <td colspan="8" style="border-bottom:1px solid #000000" id="t8_dateCompl"></td>
                        

                    </tr>
                    <tr>
                        <td colspan="7">Name of Township TB coordinator</td>
                        <td colspan="1"></td>
                        <td colspan="7" style="border-bottom:1px solid #000000" id="t8_Tbtown_code"></td>
                        <td style="border-right:1px solid #000000;"></td>
                        <td style="border-right:1px solid #000000;"  colspan="13"></td> 
                        <td colspan="3">Signature</td>
                        <td colspan="4" style="border-bottom:1px solid #000000" id="t8_head_sign"></td>
                        <td colspan="8"></td>

                    </tr> 
                </tbody>
            </table>

            <table>
                <thead></thead>
                <tbody style="color:#000000 ;border:1px solid #000000"  >
                    <tr>
                        <td colspan="16" rowspan="2">TB patient type</td>
                        <td coslpan="4" rowspan="2" style="border:1px solid #000000">No. of cases registered</td>
                        <td colspan="26" style="border:1px solid #000000">Treatment outcomes</td>
                    </tr>
                    <tr>
                        
                        <td style="border:1px solid #000000" colspan="3">Cured</td>
                        <td style="border:1px solid #000000" colspan="4">Treatment completed</td>
                        <td style="border:1px solid #000000" colspan="3">Failed</td>
                        <td style="border:1px solid #000000" colspan="3">Died</td>
                        <td style="border:1px solid #000000" colspan="3">Lost to follow-up</td>
                        <td style="border:1px solid #000000" colspan="4">Not evaluated</td>
                        <td style="border:1px solid #000000" colspan="6">Moved to second-line drug</td>
                    </tr>
                
                    <tr style="border:1px solid #000000;background-color:#adb5bd; text-align:left">
                        <td colspan="42">Block 1(A). All TB cases registered during the quarter of the previous year</td>
                    </tr>
                    
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">1. Bacteriologically confirmed new case</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1_regNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_curNew"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1_trecompleNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_failNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_dieNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_lostFollNew"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1_notevaNew"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1_mtsDrugNew"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">2. Bacteriologically confirmed relapse cases</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1_regRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_curRelapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1_trecompleRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_failRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_dieRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_lostFollRelapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1_notevaRelapse"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1_mtsDrugRelapse"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">3. Clinically diagnosed, new and relapse</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1_regNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_curNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1_trecompleNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_failNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_dieNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_lostFollNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1_notevaNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1_mtsDrugNew_Relapse"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">4. Retreatment (excluding relapse)</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1_regRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_curRetre"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1_trecompleRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_failRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_dieRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1_lostFollRetre"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1_notevaRetre"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1_mtsDrugRetre"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">All TB Cases</td>
                        <td coslpan="4"style="border:1px solid #000000" id="allTB_qtb1_reg"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allTB_qtb1_cur"></td>
                        <td style="border:1px solid #000000" colspan="4" id="allTB_qtb1_trecomple"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allTB_qtb1_fail"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allTB_qtb1_die"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allTB_qtb1_lostFoll"></td>
                        <td style="border:1px solid #000000" colspan="4" id="allTB_qtb1_noteva"></td>
                        <td style="border:1px solid #000000" colspan="6" id="allTB_qtb1_mtsDrug"></td>
                    </tr>
                    <tr style="border:1px solid #000000;background-color:#adb5bd; text-align:left">
                        <td colspan="42">Block 1(B). All HIV positive TB cases registered during the quarter of the previous year</td>
                    </tr>
                    
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">1. Bacteriologically confirmed new case</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1B_regNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_curNew"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1B_trecompleNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_failNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_dieNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_lostFollNew"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1B_notevaNew"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1B_mtsDrugNew"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">2. Bacteriologically confirmed relapse cases</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1B_regRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_curRelapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1B_trecompleRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_failRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_dieRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_lostFollRelapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1B_notevaRelapse"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1B_mtsDrugRelapse"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">3. Clinically diagnosed, new and relapse</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1B_regNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_curNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1B_trecompleNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_failNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_dieNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_lostFollNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1B_notevaNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1B_mtsDrugNew_Relapse"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">4. Retreatment (excluding relapse)</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1B_regRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_curRetre"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1B_trecompleRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_failRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_dieRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1B_lostFollRetre"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1B_notevaRetre"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1B_mtsDrugRetre"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">All HIV Positive TB Cases</td>
                        <td coslpan="4"style="border:1px solid #000000" id="allHIVTB_qtb1_reg"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allHIVTB_qtb1_cur"></td>
                        <td style="border:1px solid #000000" colspan="4" id="allHIVTB_qtb1_trecomple"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allHIVTB_qtb1_fail"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allHIVTB_qtb1_die"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allHIVTB_qtb1_lostFoll"></td>
                        <td style="border:1px solid #000000" colspan="4" id="allHIVTB_qtb1_noteva"></td>
                        <td style="border:1px solid #000000" colspan="6" id="allHIVTB_qtb1_mtsDrug"></td>
                    </tr>
                    <tr style="border:1px solid #000000;background-color:#adb5bd; text-align:left">
                        <td colspan="42">Block 1(C). All childhood cases registered during the quarter of the previous year</td>
                    </tr> 
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">1. Bacteriologically confirmed new case</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1Child_regNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_curNew"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1Child_trecompleNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_failNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_dieNew"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_lostFollNew"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1Child_notevaNew"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1Child_mtsDrugNew"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">2. Bacteriologically confirmed relapse cases</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1Child_regRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_curRelapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1Child_trecompleRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_failRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_dieRelapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_lostFollRelapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1Child_notevaRelapse"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1Child_mtsDrugRelapse"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">3. Clinically diagnosed, new and relapse</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1Child_regNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_curNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1Child_trecompleNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_failNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_dieNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_lostFollNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1Child_notevaNew_Relapse"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1Child_mtsDrugNew_Relapse"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">4. Retreatment (excluding relapse)</td>
                        <td coslpan="4"style="border:1px solid #000000" id="qtb1Child_regRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_curRetre"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1Child_trecompleRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_failRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_dieRetre"></td>
                        <td style="border:1px solid #000000" colspan="3" id="qtb1Child_lostFollRetre"></td>
                        <td style="border:1px solid #000000" colspan="4" id="qtb1Child_notevaRetre"></td>
                        <td style="border:1px solid #000000" colspan="6" id="qtb1Child_mtsDrugRetre"></td>
                    </tr>
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">All TB Cases</td>
                        <td coslpan="4"style="border:1px solid #000000" id="allChild_qtb1_reg"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allChild_qtb1_cur"></td>
                        <td style="border:1px solid #000000" colspan="4" id="allChild_qtb1_trecomple"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allChild_qtb1_fail"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allChild_qtb1_die"></td>
                        <td style="border:1px solid #000000" colspan="3" id="allChild_qtb1_lostFoll"></td>
                        <td style="border:1px solid #000000" colspan="4" id="allChild_qtb1_noteva"></td>
                        <td style="border:1px solid #000000" colspan="6" id="allChild_qtb1_mtsDrug"></td>
                    </tr>


                    
                </tbody>
            </table>

            <table>
                <thead></thead>
                <tbody style="color:#000000">
                    <tr>
                        <td colspan="32" style="background-color:#adb5bd;">Block 2: TB/HIV activities 
                        (all TB cases registered during the quarter of the previous year)</td>
                    </tr>
                    <tr>
                        <td style="color:#000000;border:1px solid#000000"colspan="6">HIV-positive<br>TB patients</td>
                        <td style="color:#000000;border:1px solid#000000"colspan="8">HIV-positive<br>TB patients on CPT</td>
                        <td style="color:#000000;border:1px solid#000000"colspan="9">HIV-positive<br>TB patients on ART</td>
                    </tr>
                    <tr>
                        <td style="color:#000000;border:1px solid#000000"colspan="6"id="qt_hivTB"></td>
                        <td style="color:#000000;border:1px solid#000000"colspan="8"id="cPT_qt_hivTB"></td>
                        <td style="color:#000000;border:1px solid#000000"colspan="9"id="aRT_qt_hivTB"></td>
                    </tr>
                    <tr>
                       <td> Countersigned by:</td>
                    </tr>
                    <tr>
                        <td>Signature:</td>
                        <td style="color:#000000;border-bottom:1px solid#000000"id="qt1_sign"></td>
                        
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td style="color:#000000;border-bottom:1px solid#000000"id="qt1_name"></td>
                        
                    </tr>
                    <tr>
                        <td>Designation:</td>
                        <td style="color:#000000;border-bottom:1px solid#000000"id="qt1_design"></td>
                        
                    </tr>
                    
                </tbody>
                    

            </table>


        </div><!-- Generate Qtr Report_TB 08 Ok tabel above Ttable -->

        <div>
            <table>
                <tbody>
                    <tr>
                        <td style="color:#000000" colspan="3">Select State/Region Name:</td>
                        <td colspan="4" style="color:#000000" id="tb_headerRegion_IPT"></td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody style="color:#000000">
                    <tr>
                        <td  colspan="32" style="text-align:center"><b>Quarterly Report for TB/HIV collaborative activity</b></td>
                        
                    </tr>

                    <tr>
                        <td><b>AIDS/STD team / HIV Clinic</b></td>
                        <td id="ipt_ashClinic"></td>
                        <td colspan="23"></td>
                        <td colsapn="2">Quarter</td>
                        <td colsapn="5" style="border-bottom:1px dotted #000000" id="ipt_ashQua"></td>

                    </tr>

                    <tr>
                        <td><b>TB Team</b></td>
                        <td id="ipt_tbTeam"></td>
                        <td colspan="23"></td>
                        <td colsapn="2">Year</td>
                        <td colsapn="5" style="border-bottom:1px dotted #000000" id="ipt_tbyear"></td>

                    </tr>

                    <tr>
                        <td><b>Township/District</b></td>
                        <td id="ipt_town"style="border-bottom:1px dotted #000000;background-color:#adb5bd"></td>
                    </tr>

                </tbody>
            </table>
           

            <table >
                <thead></thead>
                <tbody style="color:#000000;border:3px solid #000000" >
                    <tr>
                        <td style="border: 1px solid #000000" colspan="2" rowspan="3"><b>Block A: Reporting for AIDS/STD team / HIV Clinic</b></td>
                        <td style="border:1px solid #000000" colspan="8" ><b>Newly enrolled</b></td>
                        <td style="border:1px solid #000000" colspan="8" ><b>1st visit for calender year</b></td>
                        <td style="border: 1px solid #000000" colspan="8" ></td>
                        <td style="border:1px solid #000000" colspan="8" ><b>Head count in current quarter</b></td>
                    </tr>
                    <tr>
                        <td colspan="4" style=" border:1px solid #000000"><b>0 - 14</b></td>
                        <td colspan="4" style=" border:1px solid #000000"><b>>= 15</b></td>
                        <td colspan="4" style=" border:1px solid #000000"><b>0 - 14</b></td>
                        <td colspan="4" style=" border:1px solid #000000"><b>>= 15</b></td>
                        <td colspan="4" style=" border:1px solid #000000"></td>
                        <td colspan="4" style=" border:1px solid #000000"></td>
                        <td colspan="4" style=" border:1px solid #000000"><b>0 - 14</b></td>
                        <td colspan="4" style=" border:1px solid #000000"><b>&gt;= 15</b></td>
                        

                    </tr>
                    <tr>
                        <td colspan="2" style=" border:1px solid #000000"><b>Male</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Female</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Male</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Female</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Male</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Female</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Male</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Female</b></td>
                        <td colspan="2" style=" border:1px solid #000000"></td>
                        <td colspan="2" style=" border:1px solid #000000"></td>
                        <td colspan="2" style=" border:1px solid #000000"></td>
                        <td colspan="2" style=" border:1px solid #000000"></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Male</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Female</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Male</b></td>
                        <td colspan="2" style=" border:1px solid #000000"><b>Female</b></td>
                        

                    </tr>
                    <tr style=" border:1px solid #000000">
                        <td style="border: 1px solid #000000" colspan="2"><b>Number of PLHIV attended HIV 
                            care during the reporting period</b></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_attended_HIVmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_attended_HIVfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_attended_HIVmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_attended_HIVfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_attended_HIVmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_attended_HIVfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_attended_HIVmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_attended_HIVfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="blankPLHIV_attended_HIVmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blankPLHIV_attended_HIVfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blankPLHIV_attended_HIVmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blankPLHIV_attended_HIVfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_attended_HIVmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_attended_HIVfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_attended_HIVmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_attended_HIVfemale15"></td>

                    </tr>
                    <tr style=" border:1px solid #000000">
                        <td style="border: 1px solid #000000" colspan="2"><b>Number of PLHIV screened for 
                            TB during reporting period</b></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="newlyPLHIV_screened_TBmale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="newlyPLHIV_screened_TBfemale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="newlyPLHIV_screened_TBmale15"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="newlyPLHIV_screened_TBfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_screened_TBmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_screened_TBfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_screened_TBmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_screened_TBfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="blankPLHIV_screened_TBmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blankPLHIV_screened_TBfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blankPLHIV_screened_TBmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blankPLHIV_screened_TBfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_screened_TBmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_screened_TBfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_screened_TBmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_screened_TBfemale15"></td>

                    </tr>
                    <tr style=" border:1px solid #000000">
                        <td style="border: 1px solid #000000" colspan="2"><b>Number of PLHIV referred for 
                            TB diagnostic evaluation</b></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_referredmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_referredfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_referredmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_referredfemale15"></td>

                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_referredmale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_referredfemale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_referredmale15"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_referredfemale15"></td>

                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blankPLHIV_referredmale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blankPLHIV_referredfemale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blankPLHIV_referredmale15"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blankPLHIV_referredfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_referredmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_referredfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_referredmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_referredfemale15"></td>

                    </tr>
                    <tr style=" border:1px solid #000000">
                        <td style="border: 1px solid #000000" colspan="2"><b>Number of PLHIV diagnosed with active 
                            TB diasease and registered for TB treatment</b></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_diagnosed_activTBmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_diagnosed_activTBfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_diagnosed_activTBmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newlyPLHIV_diagnosed_activTBfemale15"></td>

                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_diagnosed_activTBmale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_diagnosed_activTBfemale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_diagnosed_activTBmale15"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisitPLHIV_diagnosed_activTBfemale15"></td>

                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blankPLHIV_diagnosed_activTBmale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blankPLHIV_diagnosed_activTBfemale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blankPLHIV_diagnosed_activTBmale15"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blankPLHIV_diagnosed_activTBfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_diagnosed_activTBmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_diagnosed_activTBfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_diagnosed_activTBmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="headPLHIV_diagnosed_activTBfemale15"></td>

                    </tr>
                    <tr style=" border:1px solid #000000">
                        <td style="border: 1px solid #000000" colspan="2"><b>Number of PLHIV received IPT evaluation</b></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_received_IPTmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_received_IPTfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_received_IPTmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_received_IPTfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_received_IPTmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_received_IPTfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_received_IPTmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_received_IPTfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="blank PLHIV_received_IPTmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blank PLHIV_received_IPTfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blank PLHIV_received_IPTmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blank PLHIV_received_IPTfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_received_IPTmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_received_IPTfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_received_IPTmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_received_IPTfemale15"></td>

                    </tr>
                    <tr style=" border:1px solid #000000">
                        <td style="border: 1px solid #000000" colspan="2"><b>Number of PLHIV who were eligible for IPT</b></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_eligible_IPTmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_eligible_IPTfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_eligible_IPTmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_eligible_IPTfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_eligible_IPTmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_eligible_IPTfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_eligible_IPTmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_eligible_IPTfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="blank PLHIV_eligible_IPTmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blank PLHIV_eligible_IPTfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blank PLHIV_eligible_IPTmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="blank PLHIV_eligible_IPTfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_eligible_IPTmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_eligible_IPTfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_eligible_IPTmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_eligible_IPTfemale15"></td>

                    </tr>
                    <tr style=" border:1px solid #000000">
                        <td style="border: 1px solid #000000" colspan="2"><b>Number of PLHIV who were 
                            givening IP in reporting period</b></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_giving_IPmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_giving_IPfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_giving_IPmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="newly PLHIV_giving_IPfemale15"></td>

                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_giving_IPmale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_giving_IPfemale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_giving_IPmale15"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="1stvisit PLHIV_giving_IPfemale15"></td>

                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blank PLHIV_giving_IPmale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blank PLHIV_giving_IPfemale14"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blank PLHIV_giving_IPmale15"></td>
                        <td style="background-color:#000000;border: 1px solid #000000" colspan="2" id="blank PLHIV_giving_IPfemale15"></td>

                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_giving_IPmale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_giving_IPfemale14"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_giving_IPmale15"></td>
                        <td style="border: 1px solid #000000" colspan="2" id="head PLHIV_giving_IPfemale15"></td>

                    </tr>
                </tbody>

            </table>
             

            <table>
                <tr ><td style="color:#fff;">___</td></tr>
            </table>

            
            
            <table>
                <thead></thead>
                <tbody style="color:#000000;border:3px solid #000000">
                    <tr style="border:1px solid #000000">
                        <td style="border:1px solid #000000" colspan="3">IPT outcome reporting for patient<br>
                         registered in IPT during the same<br>
                          quarter, one year earlier
                        </td>
                        <td style="border:1px solid #000000" colspan="3">Total number registered during<br>
                            same quarter, one year earlier
                        </td>
                        <td style="border:1px solid #000000" colspan="6">Completed <br>
                            &gt;= 6 months
                        </td>
                        <td style="border:1px solid #000000" colspan="6">Incomplete (Discontinue due <br>
                            to side effects, lost to follow up)
                        </td>
                        <td style="border:1px solid #000000" colspan="14">TB disease while on IPT</td>
                        
                        
                    </tr>
                    <tr>
                        <td colspan="3">Patients registered during:</td>
                        <td rowspan="3"style="border:1px solid #000000" colspan="3" id="reg_sameQuarter" ></td>
                        <td rowspan="3"style="border:1px solid #000000" colspan="6" id="completed_IPT" ></td>
                        <td rowspan="3"style="border:1px solid #000000" colspan="6" id="incompleted_IPT" ></td>
                        <td rowspan="3"style="border:1px solid #000000" colspan="6" id="tbDisease_IPT" ></td>
                    </tr>
                    <tr>
                        <td>Quarter</td>
                        <td style="border-bottom:1px solid #000000" id="pt_quaterIPT"></td>
                        <td>of</td> 
                    </tr>
                    <tr style="border-bottom:3px solid #000000">
                     <td>Year</td>
                     <td colspan="2"style="border-bottom:1px solid #000000" id="pt_yearIPT"></td>

                    </tr>
                    
                </tbody>
            </table>
           

            <table>
                <thead>
                    <tr>
                        <td style="color:#fff;">
                            _____

                         </td>
                    </tr>
                </thead>
                <tbody style="color:#000000;">
                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000" rowspan="3" colspan="2">Block B: Reporting for TB Team</td>
                        <td colspan="24" style="border:3px solid #000000;text-align:center">Number</td>
                        <td colspan="8" rowspan="3"style="border:3px solid #000000;">Data Source</td>

                    </tr>

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000;text-align:center" colspan="8">0-4</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="8">&gt;=5-14</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="8">&gt;=15</td>
                    </tr>

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000;text-align:center" colspan="4">Male</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4">Female</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4">Male</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4">Female</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4">Male</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4">Female</td>
                        
                    </tr>

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000" colspan="2">Number of <u>New + 
                            Relaplse</u> TB patients registered during<br>the reporting period
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_duringReport_04"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_duringReport_04"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_duringReport_14"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_duringReport_14"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_duringReport_15"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_duringReport_15"></td>
                        <td colspan="8" style="border:3px solid #000000;" id="tb_duringReport_dataSource"></td>
                        
                    </tr>

                    

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000"  colspan="2">Number of <u>New + Relapse</u> TB patients registered during the<br>
                         reporting period  who had an HIV test result recorded in the<br>
                          TB register 
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_inHIV_duringRp_04"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_inHIV_duringRp_04"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_inHIV_duringRp_14"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_inHIV_duringRp_14"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_inHIV_duringRp_15"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_inHIV_duringRp_15"></td>
                        <td colspan="8" style="border:3px solid #000000;" id="tb_duringReport"></td>
                    </tr>

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000"  colspan="2">Number of <u>New + Relapse</u> TB patients registered over the<br>
                         reporting period with documented HIV-positive status 
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_overReport_04"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_overReport_04"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_overReport_14"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_overReport_14"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_overReport_15"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_overReport_15"></td>
                        <td colspan="8" style="border:3px solid #000000;" id="tb_overReport_dataSource"></td>  
                    </tr>
                    

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000"  colspan="2">Number of <u>New + Relapse</u> HIV positive TB patients,<br>
                         registered during the reporting period, starting or continuing<br>
                          CPT treatment during their TB treatment 
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_cptTreatment_04"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_cptTreatment_04"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_cptTreatment_14"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_cptTreatment_14"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_cptTreatment_15"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_cptTreatment_15"></td>
                        <td colspan="8" style="border:3px solid #000000;" id="tb_cptTreatment_dataSource"></td>  
                    </tr>

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000"  colspan="2">Number of New + Relapse HIV positive TB patients,<br>
                         registered during the reporting period, who are started on or<br>
                          continue previously initiated ART during TB treatment  
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_artTreatment_04"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_artTreatment_04"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_artTreatment_14"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_artTreatment_14"></td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" id="maleReport_tb_artTreatment_15"></td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" id="femaleReport_tb_artTreatment_15"></td>
                        <td colspan="8" style="border:3px solid #000000;" id="tb_artTreatment_dataSource"></td>  
                    </tr>

                    <tr><td>____</td><tr>

                    <tr>
                        <td><b>Signature</b></td>
                        <td style="border-bottom:3px dotted #000000" id="ipt_signature_1"></td>
                        <td colspan="17"></td>
                        <td colspan="4"><b>Signature</b></td>
                        <td style="border-bottom:3px dotted #000000"colspan="5" id="ipt_signature_2"></td>
                    </tr>

                    <tr>
                        <td><b>Name</b></td>
                        <td style="border-bottom:3px dotted #000000" id="ipt_name_1"></td>
                        <td colspan="17"></td>
                        <td colspan="4"><b>Name</b></td>
                        <td style="border-bottom:3px dotted #000000"colspan="5" id="ipt_name_2"></td>
                    </tr>

                    <tr>
                        <td><b>Disignation</b></td>
                        <td style="border-bottom:3px dotted #000000" id="ipt_disignation_1"></td>
                        <td colspan="17"></td>
                        <td colspan="4"><b>Disignation</b></td>
                        <td style="border-bottom:3px dotted #000000"colspan="5" id="ipt_disignation_2"></td>
                    </tr>

                    <tr>
                        <td><b>Programme</b></td>
                        <td style="border-bottom:3px dotted #000000" id="ipt_programme_1"></td>
                        <td colspan="17"></td>
                        <td colspan="4"><b>Programme</b></td>
                        <td style="border-bottom:3px dotted #000000" colspan="5" id="ipt_programme_2"></td>
                    </tr>

                    
                </tbody>



            </table>
            

        </div> --}}
    </form>
    
</body>
</html>