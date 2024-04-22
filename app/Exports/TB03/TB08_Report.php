<?php

namespace App\Exports\TB03;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class TB08_Report implements FromView
{
    private $tb03_redataes;
    public $cal_resultes;
    // public $test_data=[];
    

    public function __construct($tb03_redataes,$cal_resultes)
    {  
        $this->tb03_redataes = $tb03_redataes;
        $this->cal_resultes=$cal_resultes;
    }
    public function calculate_report_O8(){
        $this->cal_resultes=[
            "08_b1_new_register"=>0,"08_b1_new_cured"=>0,"08_b1_new_treatComplete"=>0,"08_b1_new_fail"=>0,"08_b1_new_die"=>0,
            "08_b1_new_Lfollow"=>0,"08_b1_new_moveSecond"=>0,"08_b1_new_notEvaluted"=>0,

            "08_b1_relapse_register"=>0,"08_b1_relapse_cured"=>0,"08_b1_relapse_treatComplete"=>0,"08_b1_relapse_fail"=>0,"08_b1_relapse_die"=>0,
            "08_b1_relapse_Lfollow"=>0,"08_b1_relapse_moveSecond"=>0,"08_b1_relapse_notEvaluted"=>0,

            "08_b1_clinically_register"=>0,"08_b1_clinically_cured"=>0,"08_b1_clinically_treatComplete"=>0,"08_b1_clinically_fail"=>0,"08_b1_clinically_die"=>0,
            "08_b1_clinically_Lfollow"=>0,"08_b1_clinically_moveSecond"=>0,"08_b1_clinically_notEvaluted"=>0,

            "08_b1_retreatment_register"=>0,"08_b1_retreatment_cured"=>0,"08_b1_retreatment_treatComplete"=>0,"08_b1_retreatment_fail"=>0,"08_b1_retreatment_die"=>0,
            "08_b1_retreatment_Lfollow"=>0,"08_b1_retreatment_moveSecond"=>0,"08_b1_retreatment_notEvaluted"=>0,//B1A

            "08_b1_reg_total"=>0,"08_b1_cured_total"=>0,"08_b1_treatComplete_total"=>0,"08_b1_fail_total"=>0,"08_b1_die_total"=>0,"08_b1_Lfollow_total"=>0,
            "08_b1_movesecond_total"=>0,"08_b1_notEvaluted_total"=>0,// B1 total

            "08_b1_newHIV_register"=>0,"08_b1_newHIV_cured"=>0,"08_b1_newHIV_treatComplete"=>0,"08_b1_newHIV_fail"=>0,"08_b1_newHIV_die"=>0,
            "08_b1_newHIV_Lfollow"=>0,"08_b1_newHIV_moveSecond"=>0,"08_b1_newHIV_notEvaluted"=>0,
            
            "08_b1_relapseHIV_register"=>0,"08_b1_relapseHIV_cured"=>0,"08_b1_relapseHIV_treatComplete"=>0,"08_b1_relapseHIV_fail"=>0,"08_b1_relapseHIV_die"=>0,
            "08_b1_relapseHIV_Lfollow"=>0,"08_b1_relapseHIV_moveSecond"=>0,"08_b1_relapseHIV_notEvaluted"=>0,

            "08_b1_clinicallyHIV_register"=>0,"08_b1_clinicallyHIV_cured"=>0,"08_b1_clinicallyHIV_treatComplete"=>0,"08_b1_clinicallyHIV_fail"=>0,"08_b1_clinicallyHIV_die"=>0,
            "08_b1_clinicallyHIV_Lfollow"=>0,"08_b1_clinicallyHIV_moveSecond"=>0,"08_b1_clinicallyHIV_notEvaluted"=>0,

            "08_b1_retreatmentHIV_register"=>0,"08_b1_retreatmentHIV_cured"=>0,"08_b1_retreatmentHIV_treatComplete"=>0,"08_b1_retreatmentHIV_fail"=>0,"08_b1_retreatmentHIV_die"=>0,
            "08_b1_retreatmentHIV_Lfollow"=>0,"08_b1_retreatmentHIV_moveSecond"=>0,"08_b1_retreatmentHIV_notEvaluted"=>0,//B1C

            "08_b1_regHIV_total"=>0,"08_b1_curedHIV_total"=>0,"08_b1_treatCompleteHIV_total"=>0,"08_b1_failHIV_total"=>0,"08_b1_dieHIV_total"=>0,"08_b1_LfollowHIV_total"=>0,
            "08_b1_movesecondHIV_total"=>0,"08_b1_notEvalutedHIV_total"=>0,//B1 C total

            "08_b1_newChild_register"=>0,"08_b1_newChild_cured"=>0,"08_b1_newChild_treatComplete"=>0,"08_b1_newChild_fail"=>0,"08_b1_newChild_die"=>0,
            "08_b1_newChild_Lfollow"=>0,"08_b1_newChild_moveSecond"=>0,"08_b1_newChild_notEvaluted"=>0,

            "08_b1_relapseChild_register"=>0,"08_b1_relapseChild_cured"=>0,"08_b1_relapseChild_treatComplete"=>0,"08_b1_relapseChild_fail"=>0,"08_b1_relapseChild_die"=>0,
            "08_b1_relapseChild_Lfollow"=>0,"08_b1_relapseChild_moveSecond"=>0,"08_b1_relapseChild_notEvaluted"=>0,

            "08_b1_clinicallyChild_register"=>0,"08_b1_clinicallyChild_cured"=>0,"08_b1_clinicallyChild_treatComplete"=>0,"08_b1_clinicallyChild_fail"=>0,"08_b1_clinicallyChild_die"=>0,
            "08_b1_clinicallyChild_Lfollow"=>0,"08_b1_clinicallyChild_moveSecond"=>0,"08_b1_clinicallyChild_notEvaluted"=>0,

            "08_b1_retreatmentChild_register"=>0,"08_b1_retreatmentChild_cured"=>0,"08_b1_retreatmentChild_treatComplete"=>0,"08_b1_retreatmentChild_fail"=>0,"08_b1_retreatmentChild_die"=>0,
            "08_b1_retreatmentChild_Lfollow"=>0,"08_b1_retreatmentChild_moveSecond"=>0,"08_b1_retreatmentChild_notEvaluted"=>0,

            "08_b1_regChild_total"=>0,"08_b1_curedChild_total"=>0,"08_b1_treatCompleteChild_total"=>0,"08_b1_failChild_total"=>0,"08_b1_dieChild_total"=>0,"08_b1_LfollowChild_total"=>0,
            "08_b1_movesecondChild_total"=>0,"08_b1_notEvalutedChild_total"=>0, // Child Total

            "HIV_TB"=>0,"HIV_TB_CPT"=>0,"HIV_TB_ART"=>0,"report_type"=>"",
            
        ];
        foreach ($this->tb03_redataes as $tb03_redata) {
            if($tb03_redata["TranferIn_TB03"]!="Y"){
                if($tb03_redata["BioClinical_TB03"]=="B"){
                    if($tb03_redata["TypePatient_TB03"]=="N"){
                        
                        if($tb03_redata["HIVstatus_TB03"]=="P"){
                            
                            $this->cal_resultes["08_b1_newHIV_register"]++;

                            if($tb03_redata["TrementOut_TB03"]=="C"){
                            $this->cal_resultes["08_b1_newHIV_cured"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="T"){
                                $this->cal_resultes["08_b1_newHIV_treatComplete"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="F"){
                                $this->cal_resultes["08_b1_newHIV_fail"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="D"){
                                $this->cal_resultes["08_b1_newHIV_die"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                                $this->cal_resultes["08_b1_newHIV_Lfollow"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="N"){
                                $this->cal_resultes["08_b1_newHIV_notEvaluted"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                                $this->cal_resultes["08_b1_newHIV_moveSecond"]++;
                            }

                        }
                        if($tb03_redata["Age_TB03"]<15){
                            $this->cal_resultes["08_b1_newChild_register"]++;
                            if($tb03_redata["TrementOut_TB03"]=="C"){
                                $this->cal_resultes["08_b1_newChild_cured"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="T"){
                                $this->cal_resultes["08_b1_newChild_treatComplete"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="F"){
                                $this->cal_resultes["08_b1_newChild_fail"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="D"){
                                $this->cal_resultes["08_b1_newChild_die"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                                $this->cal_resultes["08_b1_newChild_Lfollow"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="N"){
                                $this->cal_resultes["08_b1_newChild_notEvaluted"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                                $this->cal_resultes["08_b1_newChild_moveSecond"]++;
                            }
                        }

                        $this->cal_resultes["08_b1_new_register"]++;
                        if($tb03_redata["TrementOut_TB03"]=="C"){
                            $this->cal_resultes["08_b1_new_cured"]++;
                        }
                        else if($tb03_redata["TrementOut_TB03"]=="T"){
                            $this->cal_resultes["08_b1_new_treatComplete"]++;
                        }
                        else if($tb03_redata["TrementOut_TB03"]=="F"){
                            $this->cal_resultes["08_b1_new_fail"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="D"){
                            $this->cal_resultes["08_b1_new_die"]++;
                        }
                        else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                            $this->cal_resultes["08_b1_new_Lfollow"]++;
                        }
                        else if($tb03_redata["TrementOut_TB03"]=="N"){
                            $this->cal_resultes["08_b1_new_notEvaluted"]++;
                        }
                        else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                            $this->cal_resultes["08_b1_new_moveSecond"]++;
                        }
                    }
                    else if($tb03_redata["TypePatient_TB03"]=="R"){
                        if($tb03_redata["HIVstatus_TB03"]=="P"){
                            
                            $this->cal_resultes["08_b1_relapseHIV_register"]++;

                            if($tb03_redata["TrementOut_TB03"]=="C"){
                            $this->cal_resultes["08_b1_relapseHIV_cured"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="T"){
                                $this->cal_resultes["08_b1_relapseHIV_treatComplete"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="F"){
                                $this->cal_resultes["08_b1_relapseHIV_fail"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="D"){
                                $this->cal_resultes["08_b1_relapseHIV_die"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                                $this->cal_resultes["08_b1_relapseHIV_Lfollow"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="N"){
                                $this->cal_resultes["08_b1_relapseHIV_notEvaluted"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                                $this->cal_resultes["08_b1_relapseHIV_moveSecond"]++;
                            }

                        }
                        if($tb03_redata["Age_TB03"]<15){
                            $this->cal_resultes["08_b1_relapseChild_register"]++;
                            if($tb03_redata["TrementOut_TB03"]=="C"){
                                $this->cal_resultes["08_b1_relapseChild_cured"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="T"){
                                $this->cal_resultes["08_b1_relapseChild_treatComplete"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="F"){
                                $this->cal_resultes["08_b1_relapseChild_fail"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="D"){
                                $this->cal_resultes["08_b1_relapseChild_die"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                                $this->cal_resultes["08_b1_relapseChild_Lfollow"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="N"){
                                $this->cal_resultes["08_b1_relapseChild_notEvaluted"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                                $this->cal_resultes["08_b1_relapseChild_moveSecond"]++;
                            }
                        }

                        $this->cal_resultes["08_b1_relapse_register"]++;
                        if($tb03_redata["TrementOut_TB03"]=="C"){
                            $this->cal_resultes["08_b1_relapse_cured"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="T"){
                            $this->cal_resultes["08_b1_relapse_treatComplete"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="F"){
                            $this->cal_resultes["08_b1_relapse_fail"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="D"){
                            $this->cal_resultes["08_b1_relapse_die"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                            $this->cal_resultes["08_b1_relapse_Lfollow"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="N"){
                            $this->cal_resultes["08_b1_relapse_notEvaluted"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                            $this->cal_resultes["08_b1_relapse_moveSecond"]++;
                        }
                    }  
                }
                else if($tb03_redata["BioClinical_TB03"]=="C"){
                    if($tb03_redata["TypePatient_TB03"]=="N"||$tb03_redata["TypePatient_TB03"]=="R"){

                        if($tb03_redata["HIVstatus_TB03"]=="P"){
                                
                            $this->cal_resultes["08_b1_clinicallyHIV_register"]++;

                            if($tb03_redata["TrementOut_TB03"]=="C"){
                                $this->cal_resultes["08_b1_clinicallyHIV_cured"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="T"){
                                $this->cal_resultes["08_b1_clinicallyHIV_treatComplete"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="F"){
                                $this->cal_resultes["08_b1_clinicallyHIV_fail"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="D"){
                                $this->cal_resultes["08_b1_clinicallyHIV_die"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                                $this->cal_resultes["08_b1_clinicallyHIV_Lfollow"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="N"){
                                $this->cal_resultes["08_b1_clinicallyHIV_notEvaluted"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                                $this->cal_resultes["08_b1_clinicallyHIV_moveSecond"]++;
                            }

                        }

                        if($tb03_redata["Age_TB03"]<15){
                            $this->cal_resultes["08_b1_clinicallyChild_register"]++;
                            if($tb03_redata["TrementOut_TB03"]=="C"){
                                $this->cal_resultes["08_b1_clinicallyChild_cured"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="T"){
                                $this->cal_resultes["08_b1_clinicallyChild_treatComplete"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="F"){
                                $this->cal_resultes["08_b1_clinicallyChild_fail"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="D"){
                                $this->cal_resultes["08_b1_clinicallyChild_die"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                                $this->cal_resultes["08_b1_clinicallyChild_Lfollow"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="N"){
                                $this->cal_resultes["08_b1_clinicallyChild_notEvaluted"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                                $this->cal_resultes["08_b1_clinicallyChild_moveSecond"]++;
                            }
                        }

                        $this->cal_resultes["08_b1_clinically_register"]++;
                        if($tb03_redata["TrementOut_TB03"]=="C"){
                            $this->cal_resultes["08_b1_clinically_cured"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="T"){
                            $this->cal_resultes["08_b1_clinically_treatComplete"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="F"){
                            $this->cal_resultes["08_b1_clinically_fail"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="D"){
                            $this->cal_resultes["08_b1_clinically_die"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                            $this->cal_resultes["08_b1_clinically_Lfollow"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="N"){
                            $this->cal_resultes["08_b1_clinically_notEvaluted"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                            $this->cal_resultes["08_b1_clinically_moveSecond"]++;
                        }

                    }
                }
                if($tb03_redata["TypePatient_TB03"]!="N" && $tb03_redata["TypePatient_TB03"]!="R"){
                        if($tb03_redata["HIVstatus_TB03"]=="P"){
                            $this->cal_resultes["08_b1_retreatmentHIV_register"]++;

                            if($tb03_redata["TrementOut_TB03"]=="C"){
                            $this->cal_resultes["08_b1_retreatmentHIV_cured"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="T"){
                                $this->cal_resultes["08_b1_retreatmentHIV_treatComplete"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="F"){
                                $this->cal_resultes["08_b1_retreatmentHIV_fail"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="D"){
                                $this->cal_resultes["08_b1_retreatmentHIV_die"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                                $this->cal_resultes["08_b1_retreatmentHIV_Lfollow"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="N"){
                                $this->cal_resultes["08_b1_retreatmentHIV_notEvaluted"]++;
                            }
                            else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                                $this->cal_resultes["08_b1_retreatmentHIV_moveSecond"]++;
                            }      
                        }

                        if($tb03_redata["Age_TB03"]<15){
                            $this->cal_resultes["08_b1_retreatmentChild_register"]++;
                            if($tb03_redata["TrementOut_TB03"]=="C"){
                                $this->cal_resultes["08_b1_retreatmentChild_cured"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="T"){
                                $this->cal_resultes["08_b1_retreatmentChild_treatComplete"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="F"){
                                $this->cal_resultes["08_b1_retreatmentChild_fail"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="D"){
                                $this->cal_resultes["08_b1_retreatmentChild_die"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                                $this->cal_resultes["08_b1_retreatmentChild_Lfollow"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="N"){
                                $this->cal_resultes["08_b1_retreatmentChild_notEvaluted"]++;
                            }else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                                $this->cal_resultes["08_b1_retreatmentChild_moveSecond"]++;
                            }
                        }
                        

                        $this->cal_resultes["08_b1_retreatment_register"]++;
                        if($tb03_redata["TrementOut_TB03"]=="C"){
                            $this->cal_resultes["08_b1_retreatment_cured"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="T"){
                            $this->cal_resultes["08_b1_retreatment_treatComplete"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="F"){
                            $this->cal_resultes["08_b1_retreatment_fail"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="D"){
                            $this->cal_resultes["08_b1_retreatment_die"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="LFU"){
                            $this->cal_resultes["08_b1_retreatment_Lfollow"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="N"){
                            $this->cal_resultes["08_b1_retreatment_notEvaluted"]++;
                        }else if($tb03_redata["TrementOut_TB03"]=="SLD"){
                            $this->cal_resultes["08_b1_retreatment_moveSecond"]++;
                        }
                }

                if($tb03_redata["Hivstatus_TB03"]=="P"){
                    $this->cal_resultes["HIV_TB"]++;
                    if($tb03_redata["CPT_start_TB033"]!=null){
                        $this->cal_resultes["HIV_TB_CPT"]++;
                    }
                    if($tb03_redata["ART_start_TB03"]!=null){
                        $this->cal_resultes["HIV_TB_ART"]++;
                    }
                }
            }
            


        }
        $this->cal_resultes["08_b1_reg_total"]=$this->cal_resultes["08_b1_new_register"]+$this->cal_resultes["08_b1_relapse_register"]+$this->cal_resultes["08_b1_clinically_register"]
        +$this->cal_resultes["08_b1_retreatment_register"];

        $this->cal_resultes["08_b1_cured_total"]=$this->cal_resultes["08_b1_new_cured"]+$this->cal_resultes["08_b1_relapse_cured"]+$this->cal_resultes["08_b1_clinically_cured"]
        +$this->cal_resultes["08_b1_retreatment_cured"];

        $this->cal_resultes["08_b1_treatComplete_total"]=$this->cal_resultes["08_b1_new_treatComplete"]+$this->cal_resultes["08_b1_relapse_treatComplete"]+$this->cal_resultes["08_b1_clinically_treatComplete"]
        +$this->cal_resultes["08_b1_retreatment_treatComplete"];

        
        $this->cal_resultes["08_b1_fail_total"]=$this->cal_resultes["08_b1_new_fail"]+$this->cal_resultes["08_b1_relapse_fail"]+$this->cal_resultes["08_b1_clinically_fail"]
        +$this->cal_resultes["08_b1_retreatment_fail"];

        $this->cal_resultes["08_b1_die_total"]=$this->cal_resultes["08_b1_new_die"]+$this->cal_resultes["08_b1_relapse_die"]+$this->cal_resultes["08_b1_clinically_die"]
        +$this->cal_resultes["08_b1_retreatment_die"];

        $this->cal_resultes["08_b1_Lfollow_total"]=$this->cal_resultes["08_b1_new_Lfollow"]+$this->cal_resultes["08_b1_relapse_Lfollow"]+$this->cal_resultes["08_b1_clinically_Lfollow"]
        +$this->cal_resultes["08_b1_retreatment_Lfollow"];

        $this->cal_resultes["08_b1_notEvaluted_total"]=$this->cal_resultes["08_b1_new_notEvaluted"]+$this->cal_resultes["08_b1_relapse_notEvaluted"]+$this->cal_resultes["08_b1_clinically_notEvaluted"]
        +$this->cal_resultes["08_b1_retreatment_notEvaluted"];
        
        $this->cal_resultes["08_b1_movesecond_total"]=$this->cal_resultes["08_b1_new_moveSecond"]+$this->cal_resultes["08_b1_relapse_moveSecond"]+$this->cal_resultes["08_b1_clinically_moveSecond"]
        +$this->cal_resultes["08_b1_retreatment_moveSecond"];//B1 A total

        $this->cal_resultes["08_b1_regHIV_total"]=$this->cal_resultes["08_b1_newHIV_register"]+$this->cal_resultes["08_b1_relapseHIV_register"]+$this->cal_resultes["08_b1_clinicallyHIV_register"]
        +$this->cal_resultes["08_b1_retreatmentHIV_register"];

        $this->cal_resultes["08_b1_curedHIV_total"]=$this->cal_resultes["08_b1_newHIV_cured"]+$this->cal_resultes["08_b1_relapseHIV_cured"]+$this->cal_resultes["08_b1_clinicallyHIV_cured"]
        +$this->cal_resultes["08_b1_retreatmentHIV_cured"];

        $this->cal_resultes["08_b1_treatCompleteHIV_total"]=$this->cal_resultes["08_b1_newHIV_treatComplete"]+$this->cal_resultes["08_b1_relapseHIV_treatComplete"]+$this->cal_resultes["08_b1_clinicallyHIV_treatComplete"]
        +$this->cal_resultes["08_b1_retreatmentHIV_treatComplete"];

        
        $this->cal_resultes["08_b1_failHIV_total"]=$this->cal_resultes["08_b1_newHIV_fail"]+$this->cal_resultes["08_b1_relapseHIV_fail"]+$this->cal_resultes["08_b1_clinicallyHIV_fail"]
        +$this->cal_resultes["08_b1_retreatmentHIV_fail"];

        $this->cal_resultes["08_b1_dieHIV_total"]=$this->cal_resultes["08_b1_newHIV_die"]+$this->cal_resultes["08_b1_relapseHIV_die"]+$this->cal_resultes["08_b1_clinicallyHIV_die"]
        +$this->cal_resultes["08_b1_retreatmentHIV_die"];

        $this->cal_resultes["08_b1_LfollowHIV_total"]=$this->cal_resultes["08_b1_newHIV_Lfollow"]+$this->cal_resultes["08_b1_relapseHIV_Lfollow"]+$this->cal_resultes["08_b1_clinicallyHIV_Lfollow"]
        +$this->cal_resultes["08_b1_retreatmentHIV_Lfollow"];

        $this->cal_resultes["08_b1_notEvalutedHIV_total"]=$this->cal_resultes["08_b1_newHIV_notEvaluted"]+$this->cal_resultes["08_b1_relapseHIV_notEvaluted"]+$this->cal_resultes["08_b1_clinicallyHIV_notEvaluted"]
        +$this->cal_resultes["08_b1_retreatmentHIV_notEvaluted"];
        
        $this->cal_resultes["08_b1_movesecondHIV_total"]=$this->cal_resultes["08_b1_newHIV_moveSecond"]+$this->cal_resultes["08_b1_relapseHIV_moveSecond"]+$this->cal_resultes["08_b1_clinicallyHIV_moveSecond"]
        +$this->cal_resultes["08_b1_retreatmentHIV_moveSecond"];// HIV total

        $this->cal_resultes["08_b1_regChild_total"]=$this->cal_resultes["08_b1_newChild_register"]+$this->cal_resultes["08_b1_relapseChild_register"]+$this->cal_resultes["08_b1_clinicallyChild_register"]
        +$this->cal_resultes["08_b1_retreatmentChild_register"];

        $this->cal_resultes["08_b1_curedChild_total"]=$this->cal_resultes["08_b1_newChild_cured"]+$this->cal_resultes["08_b1_relapseChild_cured"]+$this->cal_resultes["08_b1_clinicallyChild_cured"]
        +$this->cal_resultes["08_b1_retreatmentChild_cured"];

        $this->cal_resultes["08_b1_treatCompleteChild_total"]=$this->cal_resultes["08_b1_newChild_treatComplete"]+$this->cal_resultes["08_b1_relapseChild_treatComplete"]+$this->cal_resultes["08_b1_clinicallyChild_treatComplete"]
        +$this->cal_resultes["08_b1_retreatmentChild_treatComplete"];

        
        $this->cal_resultes["08_b1_failChild_total"]=$this->cal_resultes["08_b1_newChild_fail"]+$this->cal_resultes["08_b1_relapseChild_fail"]+$this->cal_resultes["08_b1_clinicallyChild_fail"]
        +$this->cal_resultes["08_b1_retreatmentChild_fail"];

        $this->cal_resultes["08_b1_dieChild_total"]=$this->cal_resultes["08_b1_newChild_die"]+$this->cal_resultes["08_b1_relapseChild_die"]+$this->cal_resultes["08_b1_clinicallyChild_die"]
        +$this->cal_resultes["08_b1_retreatmentChild_die"];

        $this->cal_resultes["08_b1_LfollowChild_total"]=$this->cal_resultes["08_b1_newChild_Lfollow"]+$this->cal_resultes["08_b1_relapseChild_Lfollow"]+$this->cal_resultes["08_b1_clinicallyChild_Lfollow"]
        +$this->cal_resultes["08_b1_retreatmentChild_Lfollow"];

        $this->cal_resultes["08_b1_notEvalutedChild_total"]=$this->cal_resultes["08_b1_newChild_notEvaluted"]+$this->cal_resultes["08_b1_relapseChild_notEvaluted"]+$this->cal_resultes["08_b1_clinicallyChild_notEvaluted"]
        +$this->cal_resultes["08_b1_retreatmentChild_notEvaluted"];
        
        $this->cal_resultes["08_b1_movesecondChild_total"]=$this->cal_resultes["08_b1_newChild_moveSecond"]+$this->cal_resultes["08_b1_relapseChild_moveSecond"]+$this->cal_resultes["08_b1_clinicallyChild_moveSecond"]
        +$this->cal_resultes["08_b1_retreatmentChild_moveSecond"];

        


       
    }
    public function view():View{
        $this->calculate_report_O8();
        return view('TB.export.tb03_report_08', [
            'cal_resultes'=>$this->cal_resultes,
             
        ]);
    }
}