<?php

namespace App\Exports\TB03;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class TB03_Report implements FromView
{
    private $tb03_redataes;
    public $cal_resultes;
    // public $test_data=[];
    

    public function __construct($tb03_redataes,$cal_resultes)
    {  
        $this->tb03_redataes = $tb03_redataes;
        $this->cal_resultes=$cal_resultes;
        
    }

    public function calculating_report(){
         $b1_pbc_new_male=0;
         $b1_pbc_new_female=0;

         $b1_pbc_relapse_male=$b1_pbc_relapse_female=0;

         $b1_pbc_Ptreat_male=$b1_pbc_Ptreat_female=0;

         $b1_pbc_UPtreat_male=$b1_pbc_UPtreat_female=0;

         $b1_pbc_total_male=$b1_pbc_total_female=0;
         //Pulmonary, bacteriologically confirmed

         $b1_pcd_new_male=$b1_pcd_new_female=0;

         $b1_pcd_relapse_male=$b1_pcd_relapse_female=0;

         $b1_pcd_Ptreat_male=$b1_pcd_Ptreat_female=0;

         $b1_pcd_UPtreat_male=$b1_pcd_UPtreat_female=0;

         $b1_pcd_total_male=$b1_pcd_total_female=$b1_pcd_Gtotal=0;
         //Pulmonary, clinically diagnosed

         $b1_epbc_new_male=$b1_epbc_new_female=0;

         $b1_epbc_relapse_male=$b1_epbc_relapse_female=0;

         $b1_epbc_Ptreat_male=$b1_epbc_Ptreat_female=0;

         $b1_epbc_UPtreat_male=$b1_epbc_UPtreat_female=0;

         $b1_epbc_Gtotal=$b1_epbc_total_male=$b1_epbc_total_female=0;
         //Extra pulmonary, bacteriologically confirmed 

         $b1_epcd_new_male=$b1_epcd_new_female=0;

         $b1_epcd_relapse_male=$b1_epcd_relapse_female=0;

         $b1_epcd_Ptreat_male=$b1_epcd_Ptreat_female=0;

         $b1_epcd_UPtreat_male=$b1_epcd_UPtreat_female=0;

         $b1_epcd_total_male=$b1_epcd_total_female=$b1_epcd_Gtotal=0;


         $b2_new_male_0_4=$b2_new_male_5_9=$b2_new_male_10_14=$b2_new_male_15_24=0;
         $b2_new_male_25_34=$b2_new_male_35_44=$b2_new_male_45_54= $b2_new_male_55_64=$b2_new_male_65=0; //B2 New Male

         $b2_new_female_0_4=$b2_new_female_5_9=$b2_new_female_10_14=$b2_new_female_15_24=0;
         $b2_new_female_25_34=$b2_new_female_35_44=$b2_new_female_45_54= $b2_new_female_55_64=$b2_new_female_65=0;//B2 New Female

         $b2_relapse_male_0_4=$b2_relapse_male_5_9=$b2_relapse_male_10_14=$b2_relapse_male_15_24=0;
         $b2_relapse_male_25_34=$b2_relapse_male_35_44=$b2_relapse_male_45_54= $b2_relapse_male_55_64=$b2_relapse_male_65=0;//B2 Relapse Male

         $b2_relapse_female_0_4=$b2_relapse_female_5_9=$b2_relapse_female_10_14=$b2_relapse_female_15_24=0;
         $b2_relapse_female_25_34=$b2_relapse_female_35_44=$b2_relapse_female_45_54= $b2_relapse_female_55_64=$b2_relapse_female_65=0;//B2 Relapse Female

         $child_0_4_male=$child_5_9_male=$child_10_14_male=0;//Childhood male
         $child_0_4_female=$child_5_9_female=$child_10_14_female=0;//Childhood female

         $b4_HIV_know=$b4_HIV_Positvie=$b4_HIV_Positvie_S_CPT=$b4_HIV_Positvie_S_ART=$smoke_current=$smoke_past=$smoke_never=$smoke_unkown=0;
         $national=$nannational=$TB_DM=$IR=$RR=$CR=$MR=$transfer_male= $transfer_female= $relapse_Gen_xpert=$relapse_Gen_xpert_RR=$DSTD_case=0;//Block 4: TB/HIV activities (all TB cases registered during the quarter)




        foreach ($this->tb03_redataes as $tb03_redatae) {
            

            if($tb03_redatae["TranferIn_TB03"]!="Y"){
                if($tb03_redatae["BioClinical_TB03"]=="B"){
                    if($tb03_redatae["TBsite_TB03"]=="P"){
                        if($tb03_redatae["TypePatient_TB03"]=="N"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_pbc_new_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_pbc_new_female++;
                            }
                            
                        }
                        else if($tb03_redatae["TypePatient_TB03"]=="R"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_pbc_relapse_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_pbc_relapse_female++;
                            }
                        }//Block 1 Pulmonary, bacteriologically confirmed New and Relapse;
                        else if($tb03_redatae["TypePatient_TB03"]=="F" ||$tb03_redatae["TypePatient_TB03"]=="L"||$tb03_redatae["TypePatient_TB03"]=="O"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_pbc_Ptreat_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_pbc_Ptreat_female++;
                                }
                        }else if($tb03_redatae["TypePatient_TB03"]=="U"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_pbc_UPtreat_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_pbc_UPtreat_female++;
                            }
                        }
                        //Block 1 Pulmonary, bacteriologically confirmed  Previously treated  (excluding relapse) and Unknown previous treatment history;
                        
                    } //Pulmonary, bacteriologically confirmed
        
                    else if($tb03_redatae["TBsite_TB03"]=="EP"){
                        if($tb03_redatae["TypePatient_TB03"]=="N"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_epbc_new_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_epbc_new_female++;
                            }
                        }else if($tb03_redatae["TypePatient_TB03"]=="P"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_epbc_relapse_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_epbc_relapse_female++;
                            }
                        }//Extra pulmonary, bacteriologically confirmed New nad relapse
        
                        else if($tb03_redatae["TypePatient_TB03"]=="F" ||$tb03_redatae["TypePatient_TB03"]=="L"||$tb03_redatae["TypePatient_TB03"]=="O"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_epbc_Ptreat_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_epbc_Ptreat_female++;
                                }
                        }else if($tb03_redatae["TypePatient_TB03"]=="U"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_epbc_UPtreat_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_epbc_UPtreat_female++;
                            }
                        }
        
        
                    }//Extra pulmonary, bacteriologically confirmed 
                }
                else if($tb03_redatae["BioClinical_TB03"]=="C"){
                    if($tb03_redatae["TBsite_TB03"]=="P"){
                        if($tb03_redatae["TypePatient_TB03"]=="N"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_pcd_new_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_pcd_new_female++;
                            }
                        }else if($tb03_redatae["TypePatient_TB03"]=="R"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_pcd_relapse_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_pcd_relapse_female++;
                            }
                        }
                        else if($tb03_redatae["TypePatient_TB03"]=="F" ||$tb03_redatae["TypePatient_TB03"]=="L"||$tb03_redatae["TypePatient_TB03"]=="O"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_pcd_Ptreat_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_pcd_Ptreat_female++;
                            }
                        }else if($tb03_redatae["TypePatient_TB03"]=="U"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_pcd_UPtreat_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_pcd_UPtreat_female++;
                            }
                        }//Block 1 Pulmonary, bacteriologically confirmed  Previously treated  (excluding relapse) and Unknown previous treatment history;
                        
                    } //Block 1 Pulmonary, bacteriologically confirmed New and Relapse;
        
                    else if($tb03_redatae["TBsite_TB03"]=="EP"){
                        if($tb03_redatae["TypePatient_TB03"]=="N"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_epcd_new_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_epcd_new_female++;
                            }
                        }else if($tb03_redatae["TypePatient_TB03"]=="P"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_epcd_relapse_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_epcd_relapse_female++;
                            }
                        }//Extra pulmonary, bacteriologically confirmed New nad relapse
        
                        else if($tb03_redatae["TypePatient_TB03"]=="F" ||$tb03_redatae["TypePatient_TB03"]=="L"||$tb03_redatae["TypePatient_TB03"]=="O"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_epcd_Ptreat_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_epcd_Ptreat_female++;
                            }
                        }else if($tb03_redatae["TypePatient_TB03"]=="U"){
                            if($tb03_redatae["Gender"]=="Female"){
                                $b1_epcd_UPtreat_male++;
                            }else if($tb03_redatae["Gender"]=="F"){
                                $b1_epcd_UPtreat_female++;
                            }
                        }
        
        
                    }//Extra pulmonary, clinically diagnosed 
        
                
                }//Pulmonary, clinically diagnosed
                
        
                if($tb03_redatae["TypePatient_TB03"]=="N"){
                    if($tb03_redatae["Current Agey"]>=0 && $tb03_redatae["Current Agey"]<=4){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_0_4++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_0_4++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=5 && $tb03_redatae["Current Agey"]<=9){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_5_9++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_5_9++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=10 && $tb03_redatae["Current Agey"]<=14){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_10_14++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_10_14++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=15 && $tb03_redatae["Current Agey"]<=24){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_15_24++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_15_24++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=25 && $tb03_redatae["Current Agey"]<=34){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_25_34++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_25_34++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=35 && $tb03_redatae["Current Agey"]<=44){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_35_44++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_35_44++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=45 && $tb03_redatae["Current Agey"]<=54){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_45_54++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_45_54++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=55 && $tb03_redatae["Current Agey"]<=64){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_55_64++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_55_64++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=65){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_new_male_65++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_new_female_65++;
                        }
                    
                    }
        
                }//B2 New
        
                if($tb03_redatae["TypePatient_TB03"]=="R"){
                    if($tb03_redatae["Current Agey"]>=0 && $tb03_redatae["Current Agey"]<=4){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_0_4++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_0_4++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=5 && $tb03_redatae["Current Agey"]<=9){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_5_9++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_5_9++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=10 && $tb03_redatae["Current Agey"]<=14){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_10_14++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_10_14++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=15 && $tb03_redatae["Current Agey"]<=24){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_15_24++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_15_24++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=25 && $tb03_redatae["Current Agey"]<=34){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_25_34++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_25_34++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=35 && $tb03_redatae["Current Agey"]<=44){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_35_44++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_35_44++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=45 && $tb03_redatae["Current Agey"]<=54){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_45_54++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_45_54++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=55 && $tb03_redatae["Current Agey"]<=64){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_55_64++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_55_64++;
                        }
                    
                    }
                    else if($tb03_redatae["Current Agey"]>=65){
                        if($tb03_redatae["Gender"]=="Female"){
                            $b2_relapse_male_65++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $b2_relapse_female_65++;
                        }
                    
                    }
        
                }//B2 Relapse
        
                if($tb03_redatae["TBsite_TB03"]=="P" && $tb03_redatae["Current Agey"]<=14){
                    if($tb03_redatae["Current Agey"]<=4 && $tb03_redatae["Current Agey"]>=0){
                        if($tb03_redatae["Gender"]=="Female"){
                            $child_0_4_male++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $child_0_4_female++;
                        }
                        
                    }
                    else if($tb03_redatae["Current Agey"]<=9 && $tb03_redatae["Current Agey"]>=5){
                        if($tb03_redatae["Gender"]=="Female"){
                            $child_5_9_male++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $child_5_9_female++;
                        }
                        
                    }
                    else if($tb03_redatae["Current Agey"]<=14 && $tb03_redatae["Current Agey"]>=10){
                        if($tb03_redatae["Gender"]=="Female"){
                            $child_10_14_male++;
                        }else if($tb03_redatae["Gender"]=="F"){
                            $child_10_14_female++;
                        }
                        
                    }
                }//Childhood TB Meningitis by Age group and Sex
        
                if(isset($tb03_redatae["Hivstatus_TB03"])) {
                    $b4_HIV_know++;
                }//1
                if($tb03_redatae["Hivstatus_TB03"]=="P"){
        
                    $b4_HIV_Positvie++;//2
        
                    if(isset($tb03_redatae["CPT_start_TB03"])){
                        $b4_HIV_Positvie_S_CPT++;
                    }//3
                    if(isset($tb03_redatae["ART_start_TB03"])){
                        $b4_HIV_Positvie_S_ART++;
                    }//4
                }// 2,3,4
                //Block 4: TB/HIV activities (all TB cases registered during the quarter)
        
                if($tb03_redatae["DMstatue_TB03"]=="Y"){
                    $TB_DM++;
                }//b4 a. DM
        
                if($tb03_redatae["Smoke_status_TB03"]=="C"){
                    $smoke_current++;
                }else if($tb03_redatae["Smoke_status_TB03"]=="P"){
                    $smoke_past++;
                }
                else if($tb03_redatae["Smoke_status_TB03"]=="N"){
                    $smoke_never++;
                }else {
                    $smoke_unkown++;
                }// Smoking Status
                if($tb03_redatae["TreRegimens_TB03"]=="I"||$tb03_redatae["TreRegimens_TB03"]=="R"||$tb03_redatae["TreRegimens_TB03"]=="C"||$tb03_redatae["TreRegimens_TB03"]=="M"){
                    $IR++;
                }//IR
        
                if(($tb03_redatae["TypePatient_TB03"]=="R"||$tb03_redatae["TypePatient_TB03"]=="L"||$tb03_redatae["TypePatient_TB03"]=="F"||$tb03_redatae["TypePatient_TB03"]=="U")&&$tb03_redatae["TreRegimens_TB03"]=="R"){
                    $RR++;
                }//RR
        
                if($tb03_redatae["TreRegimens_TB03"]=="C"){
                        $CR++;
                }//CR
        
                if($tb03_redatae["TreRegimens_TB03"]=="M"){
                        $MR++;
                }//MR
                if($tb03_redatae["TypePatient_TB03"]=="R" && isset($tb03_redatae["Xpert_Res_TB03"])){
                    $relapse_Gen_xpert++;
                }//Total No. of relapse patients who were tested Gene Xpert 
        
                if($tb03_redatae["Xpert_Res_TB03"]=="RR"){
                    $relapse_Gen_xpert_RR++;
                }//Total No. of relapse patients who were diagnosis RR+
                
                else if($tb03_redatae["Xpert_Res_TB03"]!="RR"){
                    $DSTD_case++;
                }//DST Coverage among register TB Cases
        
                
            }

            if($tb03_redatae["Nationality_TB03"]=="N"){
                $national++;
            }else{
                $nannational++;
            }

            if($tb03_redatae["TranferIn_TB03"]=="Y"){
                if($tb03_redatae["Gender"]=="Female"){
                        $transfer_male++;
                }else if($tb03_redatae["Gender"]=="F"){
                    $transfer_female++;
                }
            }// Transfer male Female;
            
        }


           $b1_pbc_total_male=$b1_pbc_new_male+$b1_pbc_relapse_male+$b1_pbc_Ptreat_male+$b1_pbc_UPtreat_male;//B1 Pulmonary, bacteriologically confirmed total Male
           $b1_pbc_total_female=$b1_pbc_new_female+$b1_pbc_relapse_female+$b1_pbc_Ptreat_female+$b1_pbc_UPtreat_female;//B1 Pulmonary, bacteriologically confirmed total Female
           $b1_pbc_Gtotal=$b1_pbc_total_male+ $b1_pbc_total_female;// PBC Grand Total

           $b1_pcd_total_male=$b1_pcd_new_male+$b1_pcd_relapse_male+$b1_pcd_Ptreat_male+$b1_pcd_UPtreat_male;//Pulmonary, clinically diagnosed Male
           $b1_pcd_total_female=$b1_pcd_new_female+$b1_pcd_relapse_female+$b1_pcd_Ptreat_female+$b1_pcd_UPtreat_female;//Pulmonary, clinically diagnosed Female
           $b1_pcd_Gtotal=$b1_pcd_total_male+$b1_pcd_total_female;// PCD Grand Total

           $b1_epbc_total_male=$b1_epbc_new_male+$b1_epbc_relapse_male+$b1_epbc_Ptreat_male+$b1_epbc_UPtreat_male; // EPBC male total
           $b1_epbc_total_female= $b1_epbc_new_female+$b1_epbc_relapse_female+$b1_epbc_Ptreat_female+$b1_epbc_UPtreat_female; // EPBC female total
           $b1_epbc_Gtotal= $b1_epbc_total_male+$b1_epbc_total_female; // EPBC Grand Total;

           $b1_epcd_total_male=$b1_epcd_new_male+$b1_epcd_relapse_male+$b1_epcd_Ptreat_male+$b1_epcd_UPtreat_male;//EPulmonary, clinically diagnosed Male
           $b1_epcd_total_female=$b1_epcd_new_female+$b1_epcd_relapse_female+$b1_epcd_Ptreat_female+$b1_epcd_UPtreat_female;//EPulmonary, clinically diagnosed Female
           $b1_epcd_Gtotal=$b1_epcd_total_male+$b1_epcd_total_female;// EPCD Grand Total

           $b1_total_tb_new_male=$b1_pbc_new_male+$b1_pcd_new_male+$b1_epbc_new_male+$b1_epcd_new_male;//total tb case new male
           $b1_total_tb_new_female=$b1_pbc_new_female+$b1_pcd_new_female+$b1_epbc_new_female+$b1_epcd_new_female;//total tb case new female

           $b1_total_tb_relapse_male=$b1_pbc_relapse_male+$b1_pcd_relapse_male+$b1_epbc_relapse_male+$b1_epcd_relapse_male; //total tb case relapse male
           $b1_total_tb_relapse_female=$b1_pbc_relapse_female+$b1_pcd_relapse_female+$b1_epbc_relapse_female+$b1_epcd_relapse_female;//total tb case relapse female

           $b1_total_tb_Ptreat_male=$b1_pbc_Ptreat_male+$b1_pcd_Ptreat_male+$b1_epbc_Ptreat_male+$b1_epcd_Ptreat_male;//total tb case Ptraeat male
           $b1_total_tb_Ptreat_female=$b1_pbc_Ptreat_female+$b1_pcd_Ptreat_female+$b1_epbc_Ptreat_female+$b1_epcd_Ptreat_female;//total tb Ptreat new female

           $b1_total_tb_UPtreat_male=$b1_pbc_UPtreat_male+$b1_pcd_UPtreat_male+$b1_epbc_UPtreat_male+$b1_epcd_UPtreat_male;//total tb case Ptraeat male
           $b1_total_tb_UPtreat_female=$b1_pbc_UPtreat_female+$b1_pcd_UPtreat_female+$b1_epbc_UPtreat_female+$b1_epcd_UPtreat_female;//total tb UPtreat new female

           $b1_total_tb_total_male= $b1_total_tb_new_male+$b1_total_tb_relapse_male+$b1_total_tb_Ptreat_male+$b1_total_tb_UPtreat_male;
           $b1_total_tb_total_female= $b1_total_tb_new_female+$b1_total_tb_relapse_female+$b1_total_tb_Ptreat_female+$b1_total_tb_UPtreat_female;
           
           $b1_total_tb_Gtotal=$b1_total_tb_total_male+$b1_total_tb_total_female;

           $b2_age_new_total_male= $b2_new_male_0_4+ $b2_new_male_5_9+$b2_new_male_10_14+$b2_new_male_15_24+$b2_new_male_25_34+$b2_new_male_35_44+$b2_new_male_45_54+ $b2_new_male_55_64+$b2_new_male_65;
           $b2_age_new_total_female= $b2_new_female_0_4+ $b2_new_female_5_9+$b2_new_female_10_14+$b2_new_female_15_24+$b2_new_female_25_34+$b2_new_female_35_44+$b2_new_female_45_54+ $b2_new_female_55_64+$b2_new_female_65;
           $b2_age_new_total_Gtotal= $b2_age_new_total_male+$b2_age_new_total_female;

           $b2_age_relapse_total_male= $b2_relapse_male_0_4+ $b2_relapse_male_5_9+$b2_relapse_male_10_14+$b2_relapse_male_15_24+$b2_relapse_male_25_34+$b2_relapse_male_35_44+$b2_relapse_male_45_54+ $b2_relapse_male_55_64+$b2_relapse_male_65;
           $b2_age_relapse_total_female= $b2_relapse_female_0_4+ $b2_relapse_female_5_9+$b2_relapse_female_10_14+$b2_relapse_female_15_24+$b2_relapse_female_25_34+$b2_relapse_female_35_44+$b2_relapse_female_45_54+ $b2_relapse_female_55_64+$b2_relapse_female_65;
           $b2_age_relapse_total_Gtotal=$b2_age_relapse_total_male+$b2_age_relapse_total_female;

           $child_total_female=$child_10_14_female+$child_5_9_female+$child_0_4_female;
           $child_total_male=$child_10_14_male+$child_5_9_male+$child_0_4_male;
            
          
           
           
           
           
           
          




        $resultes=[
            'b1_pbc_new_male',
            'b1_pbc_new_female',

            'b1_pbc_relapse_male','b1_pbc_relapse_female',

            'b1_pbc_Ptreat_male','b1_pbc_Ptreat_female',

            'b1_pbc_UPtreat_male','b1_pbc_UPtreat_female',

            'b1_pbc_total_male','b1_pbc_total_female','b1_pbc_Gtotal',
            //Pulmonary, bacteriologically confirmed

            'b1_pcd_new_male','b1_pcd_new_female',

            'b1_pcd_relapse_male','b1_pcd_relapse_female',

            'b1_pcd_Ptreat_male','b1_pcd_Ptreat_female',

            'b1_pcd_UPtreat_male','b1_pcd_UPtreat_female',

            'b1_pcd_total_male','b1_pcd_total_female','b1_pcd_Gtotal',
            //Pulmonary, clinically diagnosed
            

            'b1_epbc_new_male','b1_epbc_new_female',

            'b1_epbc_relapse_male','b1_epbc_relapse_female',

            'b1_epbc_Ptreat_male','b1_epbc_Ptreat_female',

            'b1_epbc_UPtreat_male','b1_epbc_UPtreat_female',

            'b1_epbc_total_male','b1_epbc_total_female','b1_epbc_Gtotal',
            //Extra pulmonary, bacteriologically confirmed 

            'b1_epcd_new_male','b1_epcd_new_female',

            'b1_epcd_relapse_male','b1_epcd_relapse_female',

            'b1_epcd_Ptreat_male','b1_epcd_Ptreat_female',

            'b1_epcd_UPtreat_male','b1_epcd_UPtreat_female',

            'b1_epcd_total_male','b1_epcd_total_female','b1_epcd_Gtotal',
             //EPCD

            'b1_total_tb_new_male','b1_total_tb_new_female','b1_total_tb_relapse_male','b1_total_tb_relapse_female','b1_total_tb_Ptreat_male',
            'b1_total_tb_Ptreat_female','b1_total_tb_UPtreat_male','b1_total_tb_UPtreat_female',

            'b1_total_tb_total_male','b1_total_tb_total_female','b1_total_tb_Gtotal',//total TB case


            'b2_new_male_0_4','b2_new_male_5_9','b2_new_male_10_14','b2_new_male_15_24',
            'b2_new_male_25_34','b2_new_male_35_44','b2_new_male_45_54', 'b2_new_male_55_64','b2_new_male_65','b2_age_new_total_male', //B2 New Male

            'b2_new_female_0_4','b2_new_female_5_9','b2_new_female_10_14','b2_new_female_15_24',
            'b2_new_female_25_34','b2_new_female_35_44','b2_new_female_45_54', 'b2_new_female_55_64','b2_new_female_65','b2_age_new_total_female', 'b2_age_new_total_Gtotal',//B2 New Female

            'b2_relapse_male_0_4','b2_relapse_male_5_9','b2_relapse_male_10_14','b2_relapse_male_15_24',
            'b2_relapse_male_25_34','b2_relapse_male_35_44','b2_relapse_male_45_54', 'b2_relapse_male_55_64','b2_relapse_male_65','b2_age_relapse_total_male',//B2 Relapse Male

            'b2_relapse_female_0_4','b2_relapse_female_5_9','b2_relapse_female_10_14','b2_relapse_female_15_24',
            'b2_relapse_female_25_34','b2_relapse_female_35_44','b2_relapse_female_45_54', 'b2_relapse_female_55_64','b2_relapse_female_65','b2_age_relapse_total_female','b2_age_relapse_total_Gtotal',
           //B2 Relapse Female

            'child_0_4_male','child_5_9_male','child_10_14_male','child_total_male',//Childhood male
            'child_0_4_female','child_5_9_female','child_10_14_female','child_total_female',//Childhood female

            'b4_HIV_know','b4_HIV_Positvie','b4_HIV_Positvie_S_CPT','b4_HIV_Positvie_S_ART','smoke_current','smoke_past','smoke_never','smoke_unkown',
            'national','nannational','TB_DM','IR','RR','CR','MR','transfer_male', 'transfer_female', 'relapse_Gen_xpert','relapse_Gen_xpert_RR','DSTD_case',//Block 4: TB/HIV activities (all TB cases registered during the quarter)

        ];
        foreach ($resultes as $result) {
            $this->cal_resultes[$result]=$$result;
        }
        $this->cal_resultes["report_type"]="Just Report";
    }

    public function view():View{
        $this->calculating_report();
        return view('TB.export.tb03_report_07', [
            'tb03_redataes' =>  $this->tb03_redataes,
            'cal_resultes'=>$this->cal_resultes,
             
        ]);
    }

}