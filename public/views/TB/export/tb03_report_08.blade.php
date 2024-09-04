<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" media="screen" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    {{-- @dd($cal_resultes) --}}
    <form action="{{route('tb03_report_view') }}" method="get" style="padding: 0px 16% 0px ;">
        <div>
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
                        <td colspan="3">Date of completion of this form:</td>
                        <td colspan="5" style="border-bottom:1px solid #000000" id="t8_dateCompl"></td>
                        

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
                        <td coslpan="4"style="border:1px solid #000000">{{$cal_resultes["08_b1_new_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_new_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_new_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_new_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_new_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_new_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_new_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_new_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">2. Bacteriologically confirmed relapse cases</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_relapse_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapse_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_relapse_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapse_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapse_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapse_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_relapse_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_relapse_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">3. Clinically diagnosed, new and relapse</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_clinically_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinically_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_clinically_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinically_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinically_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinically_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_clinically_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_clinically_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">4. Retreatment (excluding relapse)</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_retreatment_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatment_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_retreatment_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatment_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatment_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatment_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_retreatment_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_retreatment_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">All TB Cases</td>
                        <td coslpan="4"style="border:1px solid #000000">{{$cal_resultes["08_b1_reg_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3">{{$cal_resultes["08_b1_cured_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="4">{{$cal_resultes["08_b1_treatComplete_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3">{{$cal_resultes["08_b1_fail_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3">{{$cal_resultes["08_b1_die_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3">{{$cal_resultes["08_b1_Lfollow_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="4">{{$cal_resultes["08_b1_notEvaluted_total" ]}}</td>
                        <td style="border:1px solid #000000" colspan="6">{{$cal_resultes["08_b1_movesecond_total"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;background-color:#adb5bd; text-align:left">
                        <td colspan="42">Block 1(B). All HIV positive TB cases registered during the quarter of the previous year</td>
                    </tr>
                    
                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">1. Bacteriologically confirmed new case</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_newHIV_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_newHIV_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_newHIV_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_newHIV_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_newHIV_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_newHIV_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_newHIV_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_newHIV_moveSecond"]}}</td>
                    </tr>
                    

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">2. Bacteriologically confirmed relapse cases</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_relapseHIV_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapseHIV_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_relapseHIV_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapseHIV_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapseHIV_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapseHIV_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_relapseHIV_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_relapseHIV_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">3. Clinically diagnosed, new and relapse</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_clinicallyHIV_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinicallyHIV_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_clinicallyHIV_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinicallyHIV_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinicallyHIV_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinicallyHIV_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_clinicallyHIV_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_clinicallyHIV_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">4. Retreatment (excluding relapse)</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_retreatmentHIV_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatmentHIV_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_retreatmentHIV_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatmentHIV_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatmentHIV_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatmentHIV_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_retreatmentHIV_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_retreatmentHIV_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">All HIV Positive TB Cases</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_regHIV_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_curedHIV_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_treatCompleteHIV_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_failHIV_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_dieHIV_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_LfollowHIV_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_notEvalutedHIV_total" ]}}</td>
                        <td style="border:1px solid #000000" colspan="6">{{$cal_resultes["08_b1_movesecondHIV_total"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;background-color:#adb5bd; text-align:left">
                        <td colspan="42">Block 1(C). All childhood cases registered during the quarter of the previous year</td>
                    </tr>
                     

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">1. Bacteriologically confirmed new case</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_newChild_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_newChild_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_newChild_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_newChild_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_newChild_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_newChild_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_newChild_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_newChild_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">2. Bacteriologically confirmed relapse cases</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_relapseChild_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapseChild_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_relapseChild_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapseChild_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapseChild_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_relapseChild_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_relapseChild_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_relapseChild_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">3. Clinically diagnosed, new and relapse</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_clinicallyChild_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinicallyChild_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_clinicallyChild_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinicallyChild_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinicallyChild_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_clinicallyChild_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_clinicallyChild_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_clinicallyChild_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">4. Retreatment (excluding relapse)</td>
                        <td coslpan="4"style="border:1px solid #000000" >{{$cal_resultes["08_b1_retreatmentChild_register"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatmentChild_cured"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_retreatmentChild_treatComplete"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatmentChild_fail"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatmentChild_die"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" >{{$cal_resultes["08_b1_retreatmentChild_Lfollow"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" >{{$cal_resultes["08_b1_retreatmentChild_notEvaluted"]}}</td>
                        <td style="border:1px solid #000000" colspan="6" >{{$cal_resultes["08_b1_retreatmentChild_moveSecond"]}}</td>
                    </tr>

                    <tr style="border:1px solid #000000;">
                        <td colspan="16" style="border:1px solid #000000">All childhood TB cases (15 Yrs)</td>
                        <td coslpan="4"style="border:1px solid #000000" id="allTB_qtb1_reg">{{$cal_resultes["08_b1_regChild_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" id="allTB_qtb1_cur">{{$cal_resultes["08_b1_curedChild_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" id="allTB_qtb1_trecomple">{{$cal_resultes["08_b1_treatCompleteChild_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" id="allTB_qtb1_fail">{{$cal_resultes["08_b1_failChild_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" id="allTB_qtb1_die">{{$cal_resultes["08_b1_dieChild_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="3" id="allTB_qtb1_lostFoll">{{$cal_resultes["08_b1_LfollowChild_total"]}}</td>
                        <td style="border:1px solid #000000" colspan="4" id="allTB_qtb1_noteva">{{$cal_resultes["08_b1_notEvalutedChild_total" ]}}</td>
                        <td style="border:1px solid #000000" colspan="6" id="allTB_qtb1_mtsDrug">{{$cal_resultes["08_b1_movesecondChild_total"]}}</td>
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
                        <td style="color:#000000;border:1px solid#000000"colspan="6"id="qt_hivTB">{{$cal_resultes["HIV_TB"]}}</td>
                        <td style="color:#000000;border:1px solid#000000"colspan="8"id="cPT_qt_hivTB">{{$cal_resultes["HIV_TB_CPT"]}}</td>
                        <td style="color:#000000;border:1px solid#000000"colspan="9"id="aRT_qt_hivTB">{{$cal_resultes["HIV_TB_ART"]}}</td>
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


        </div>
        @if ($cal_resultes["report_type"]=="Report_view")   
            <button class="btn btn-info" style="margin: 30px 43% 20px;
                font-size: 20px;">Go to TB03
            </button>
               
        @endif
        
    </form>
</body>
</html>