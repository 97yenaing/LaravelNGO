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
    {{-- @dd($cal_resultes) --}}
    <form action="{{route('tb03_report_view') }}" method="get" style="padding: 0px 16% 0px ;">
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
                        <td ></td>
                        <td colspan="23"></td>
                        <td colsapn="2">Quarter</td>
                        <td colsapn="5" style="border-bottom:1px dotted #000000" ></td>

                    </tr>
                    <tr>
                        <td><b>TB Team</b></td>
                        <td id="ipt_tbTeam"></td>
                        <td colspan="23"></td>
                        <td colsapn="2">Year</td>
                        <td colsapn="5" style="border-bottom:1px dotted #000000" ></td>

                    </tr>
                    <tr>
                        <td><b>Township/District</b></td>
                        <td  style="border-bottom:1px dotted #000000;background-color:#adb5bd"></td>
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
                        <td colspan="4" style=" border:1px solid #000000"><b>>= 15</b></td>
                        

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
                <tr ><td style="color:#fff;">___</tr>
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
                            >= 6 months
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
                        <td style="border:3px solid #000000;text-align:center" colspan="8">>=5-14</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="8">>=15</td>
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
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_reg_0_4_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_reg_0_4_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_reg_5_14_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_reg_5_14_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_reg_15_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_reg_15_female"]}}</td>
                        <td colspan="8" style="border:3px solid #000000;" ></td>
                        
                    </tr>

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000"  colspan="2">Number of <u>New + Relapse</u> TB patients registered during the<br>
                         reporting period  who had an HIV test result recorded in the<br>
                          TB register 
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVT_0_4_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVT_0_4_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVT_5_14_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVT_5_14_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVT_15_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVT_15_female"]}}</td>
                        <td colspan="8" style="border:3px solid #000000;" ></td>
                        
                    </tr>
                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000"  colspan="2">Number of <u>New + Relapse</u> TB patients registered over the<br>
                         reporting period with documented HIV-positive status 
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVP_0_4_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVP_0_4_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVP_5_14_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVP_5_14_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVP_15_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVP_15_female"]}}</td>
                        <td colspan="8" style="border:3px solid #000000;" ></td>
                    </tr>

                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000"  colspan="2">Number of <u>New + Relapse</u> HIV positive TB patients,<br>
                         registered during the reporting period, starting or continuing<br>
                          CPT treatment during their TB treatment 
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVC_0_4_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVC_0_4_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVC_5_14_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVC_5_14_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVC_15_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVC_15_female"]}}</td>
                        <td colspan="8" style="border:3px solid #000000;" ></td>
                    </tr>
                    <tr style="border:3px solid #000000">
                        <td style="border:3px solid #000000"  colspan="2">Number of New + Relapse HIV positive TB patients,<br>
                         registered during the reporting period, who are started on or<br>
                          continue previously initiated ART during TB treatment  
                        </td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVA_0_4_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVA_0_4_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVA_5_14_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVA_5_14_female"]}}</td>
                        <td style="border:3px solid #000000;text-align:center"  colspan="4" >{{$cal_resultes["tb03_IPT_HIVA_15_male"]}}</td>
                        <td style="border:3px solid #000000;text-align:center" colspan="4" >{{$cal_resultes["tb03_IPT_HIVA_15_female"]}}</td>
                        <td colspan="8" style="border:3px solid #000000;" ></td>
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

        </div>
        @if ($cal_resultes["report_type"]=="Report_view")   
            <button class="btn btn-info" style="margin: 30px 43% 20px;
                font-size: 20px;">Go to TB03
            </button>
               
        @endif
    </form>
</body>
</html>