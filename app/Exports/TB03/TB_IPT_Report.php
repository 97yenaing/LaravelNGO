<?php

namespace App\Exports\TB03;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class TB_IPT_Report implements FromView
{
    private $tb03_redataes;
    public $cal_resultes;
    // public $test_data=[];
    

    public function __construct($tb03_redataes,$cal_resultes)
    {  
        $this->tb03_redataes = $tb03_redataes;
        $this->cal_resultes=$cal_resultes;
        
    }
    
    public function calculate_report_IPT(){
        $this->cal_resultes=[
            "tb03_IPT_reg_0_4_male"=>0,"tb03_IPT_reg_0_4_female"=>0,"tb03_IPT_reg_5_14_male"=>0,"tb03_IPT_reg_5_14_female"=>0,"tb03_IPT_reg_15_male"=>0,"tb03_IPT_reg_15_female"=>0,
            "tb03_IPT_HIVT_0_4_male"=>0,"tb03_IPT_HIVT_0_4_female"=>0,"tb03_IPT_HIVT_5_14_male"=>0,"tb03_IPT_HIVT_5_14_female"=>0,"tb03_IPT_HIVT_15_male"=>0,"tb03_IPT_HIVT_15_female"=>0,
            "tb03_IPT_HIVP_0_4_male"=>0,"tb03_IPT_HIVP_0_4_female"=>0,"tb03_IPT_HIVP_5_14_male"=>0,"tb03_IPT_HIVP_5_14_female"=>0,"tb03_IPT_HIVP_15_male"=>0,"tb03_IPT_HIVP_15_female"=>0,
            "tb03_IPT_HIVC_0_4_male"=>0,"tb03_IPT_HIVC_0_4_female"=>0,"tb03_IPT_HIVC_5_14_male"=>0,"tb03_IPT_HIVC_5_14_female"=>0,"tb03_IPT_HIVC_15_male"=>0,"tb03_IPT_HIVC_15_female"=>0,
            "tb03_IPT_HIVA_0_4_male"=>0,"tb03_IPT_HIVA_0_4_female"=>0,"tb03_IPT_HIVA_5_14_male"=>0,"tb03_IPT_HIVA_5_14_female"=>0,"tb03_IPT_HIVA_15_male"=>0,"tb03_IPT_HIVA_15_female"=>0,
            "report_type"=>"",
        ];
        foreach ($this->tb03_redataes as $tb03_redata) {
            if($tb03_redata["TranferIn_TB03"]!="Y" &&($tb03_redata["TypePatient_TB03"]=="N"||$tb03_redata["TypePatient_TB03"]=="R") ){

                if($tb03_redata["Age_TB03"]>=0&&$tb03_redata["Age_TB03"]<=4){
                    if($tb03_redata["Gender"]=="Male"){
                        $this->cal_resultes["tb03_IPT_reg_0_4_male"]++;
                    }else if($tb03_redata["Gender"]=="Female"){
                        $this->cal_resultes["tb03_IPT_reg_0_4_female"]++;
                    }
                }
                else if($tb03_redata["Age_TB03"]>=5 && $tb03_redata["Age_TB03"]<=14){
                    if($tb03_redata["Gender"]=="Male"){
                        $this->cal_resultes["tb03_IPT_reg_5_14_male"]++;
                    }else if($tb03_redata["Gender"]=="Female"){
                        $this->cal_resultes["tb03_IPT_reg_5_14_female"]++;
                    }
                }
                else{
                    if($tb03_redata["Gender"]=="Male"){
                        $this->cal_resultes["tb03_IPT_reg_15_male"]++;
                    }else if($tb03_redata["Gender"]=="Female"){
                        $this->cal_resultes["tb03_IPT_reg_15_female"]++;
                    }
                }
                
                if(isset($tb03_redata["Hivstatus_TB03"])){
                    if($tb03_redata["Age_TB03"]>=0&&$tb03_redata["Age_TB03"]<=4){
                        if($tb03_redata["Gender"]=="Male"){
                            $this->cal_resultes["tb03_IPT_HIVT_0_4_male"]++;
                        }else if($tb03_redata["Gender"]=="Female"){
                            $this->cal_resultes["tb03_IPT_HIVT_0_4_female"]++;
                        }
                    }
                    else if($tb03_redata["Age_TB03"]>=5 && $tb03_redata["Age_TB03"]<=14){
                        if($tb03_redata["Gender"]=="Male"){
                            $this->cal_resultes["tb03_IPT_HIVT_5_14_male"]++;
                        }else if($tb03_redata["Gender"]=="Female"){
                            $this->cal_resultes["tb03_IPT_HIVT_5_14_female"]++;
                        }
                    }
                    else{
                        if($tb03_redata["Gender"]=="Male"){
                            $this->cal_resultes["tb03_IPT_HIVT_15_male"]++;
                        }else if($tb03_redata["Gender"]=="Female"){
                            $this->cal_resultes["tb03_IPT_HIVT_15_female"]++;
                        }
                    }

                    if($tb03_redata["Hivstatus_TB03"]=="P"){
                        if($tb03_redata["Age_TB03"]>=0&&$tb03_redata["Age_TB03"]<=4){
                            if($tb03_redata["Gender"]=="Male"){
                                $this->cal_resultes["tb03_IPT_HIVP_0_4_male"]++;
                            }else if($tb03_redata["Gender"]=="Female"){
                                $this->cal_resultes["tb03_IPT_HIVP_0_4_female"]++;
                            }
                        }
                        else if($tb03_redata["Age_TB03"]>=5 && $tb03_redata["Age_TB03"]<=14){
                            if($tb03_redata["Gender"]=="Male"){
                                $this->cal_resultes["tb03_IPT_HIVP_5_14_male"]++;
                            }else if($tb03_redata["Gender"]=="Female"){
                                $this->cal_resultes["tb03_IPT_HIVP_5_14_female"]++;
                            }
                        }
                        else{
                            if($tb03_redata["Gender"]=="Male"){
                                $this->cal_resultes["tb03_IPT_HIVP_15_male"]++;
                            }else if($tb03_redata["Gender"]=="Female"){
                                $this->cal_resultes["tb03_IPT_HIVP_15_female"]++;
                            }
                        }

                        if(isset($tb03_redata["CPT_start_TB03"])){
                            if($tb03_redata["Age_TB03"]>=0&&$tb03_redata["Age_TB03"]<=4){
                                if($tb03_redata["Gender"]=="Male"){
                                    $this->cal_resultes["tb03_IPT_HIVC_0_4_male"]++;
                                }else if($tb03_redata["Gender"]=="Female"){
                                    $this->cal_resultes["tb03_IPT_HIVC_0_4_female"]++;
                                }
                            }
                            else if($tb03_redata["Age_TB03"]>=5 && $tb03_redata["Age_TB03"]<=14){
                                if($tb03_redata["Gender"]=="Male"){
                                    $this->cal_resultes["tb03_IPT_HIVC_5_14_male"]++;
                                }else if($tb03_redata["Gender"]=="Female"){
                                    $this->cal_resultes["tb03_IPT_HIVC_5_14_female"]++;
                                }
                            }
                            else{
                                if($tb03_redata["Gender"]=="Male"){
                                    $this->cal_resultes["tb03_IPT_HIVC_15_male"]++;
                                }else if($tb03_redata["Gender"]=="Female"){
                                    $this->cal_resultes["tb03_IPT_HIVC_15_female"]++;
                                }
                            }
                        }
                        if(isset($tb03_redata["ART_start_TB03"])){
                            if($tb03_redata["Age_TB03"]>=0&&$tb03_redata["Age_TB03"]<=4){
                                if($tb03_redata["Gender"]=="Male"){
                                    $this->cal_resultes["tb03_IPT_HIVA_0_4_male"]++;
                                }else if($tb03_redata["Gender"]=="Female"){
                                    $this->cal_resultes["tb03_IPT_HIVA_0_4_female"]++;
                                }
                            }
                            else if($tb03_redata["Age_TB03"]>=5 && $tb03_redata["Age_TB03"]<=14){
                                if($tb03_redata["Gender"]=="Male"){
                                    $this->cal_resultes["tb03_IPT_HIVA_5_14_male"]++;
                                }else if($tb03_redata["Gender"]=="Female"){
                                    $this->cal_resultes["tb03_IPT_HIVA_5_14_female"]++;
                                }
                            }
                            else{
                                if($tb03_redata["Gender"]=="Male"){
                                    $this->cal_resultes["tb03_IPT_HIVA_15_male"]++;
                                }else if($tb03_redata["Gender"]=="Female"){
                                    $this->cal_resultes["tb03_IPT_HIVA_15_female"]++;
                                }
                            }
                        }
                    }
                }
                
            }
           
        }
    }

    public function view():View{
        $this->calculate_report_IPT();
        // dd($this->cal_resultes);
        return view('TB.export.tb03_report_IPT', [
            'cal_resultes'=>$this->cal_resultes,
        ]);
    }
}