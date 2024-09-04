<?php

namespace App\Http\Controllers;

use App\Exports\Cervical_Cancer\Cervical_Export;
use Illuminate\Http\Request;
use App\Models\Followup_general;
use App\Models\PtConfig;
use App\Models\Cervicalcancer; 
use Maatwebsite\Excel\Facades\Excel;

class CervicalcancerscrenningController extends Controller
{
    public function cc_view(){
        return view('Cervical_cancer.screnning');
    }

    public function cc_data(Request $request){
        $notice=$request["notice"];
        $cercival_general[1]="";

        if($notice=="Find the Patient"){
            $Pid=$request["Pid"];
            $Fid=$request["Fid"];
            $cercival_general[0] = PtConfig::select("Agey", "Pid", "FuchiaID","Clinic Code")
            ->where('Pid', $Pid)
            ->orwhere(function ($query) use ($Fid,$Pid) {
                if ($Fid !== null && $Fid !== "-"&& $Pid==null) {
                    $query->where('FuchiaID', $Fid);
                }
            })->first();

                $cercival_general[1] = Cervicalcancer::
                where('General ID', $Pid)
                ->orwhere(function ($query) use ($Fid,$Pid) {
                    if ($Fid !== null && $Fid !== "-"&& $Pid==null) {
                        $query->where('FuchiaID', $Fid);
                    }
                })->get();
                foreach ($cercival_general[1] as $value) {
                   $value["Agey"]=$cercival_general[0]["Agey"];
                }

            
            return response()->json([
                $cercival_general
            ]);
        }

        if($notice=="Cercival Save Record"){
            $visit_date=$request["cercival_VDate"];

            $duplicate=Cervicalcancer::where("General ID",$request["cercival_pid"])->where("Visit_date",$visit_date)->exists();
            $followhas=Followup_general::where("Pid",$request["cercival_pid"])->where("Visit Date",$visit_date)->exists();
            if($followhas){
                if(!$duplicate){
                    Cervicalcancer::create([
                        "Clinic_code"=>$request["Clinic Code"],
                        "General ID"=>$request["cercival_pid"],
                        "FuchiaID"=>$request["cercival_fid"],
                        "Agey"=>$request["cervical_age"],
                        "Hiv_Status"=>$request["crecival_hivStatus"],
                        "FSW"=>$request["crecival_FSW"],
                        "Visit_date"=>$request["cercival_VDate"],
                        "No_previous_preg"=>$request["num_prev_preg"],
                        "Birth_spacing_met"=>$request["birth_spacing_met"],
                        "LMP"=>$request["cercival_LMP"],
                        "UCG_test_date"=>$request["UCG_test_date"],
                        "UCG_test_res"=>$request["UCG_test_res"],
                        "Breast_self"=>$request["crecival_selfhave"],
                        "Breast_family_his"=>$request["crecival_familyHis_have"],
                        "Breast_examination"=>$request["crecival_breastExam"],
                        "Breast_abnormal_find_breast"=>$request["crecival_abnormal_breast"],
                        "Breast_remark"=>$request["breast_remark"],
        
                        "Discharge"=>$request["discharge"],
                        "Cervix_bleed_touch"=>$request["cervix_bleed"],
                        "Tenderness"=>$request["tenderness"],
                    
                        "Malignancy"=>$request["malignancy"],
                        "Comments_spec"=>$request["spc_comments"],
                        
        
                        "Sti_Complaint"=>$request["sti_complaint"],
                        "Sti_examination"=>$request["sti_examination"],
                        "VIA_Screening_History"=>$request["via_screening_his"],
                        "VIA_test"=>$request["via_test"],
                        "VIA_postpone_reason"=>$request["via_postponed_reason"],
                        "VIA_specify_reason"=>$request["via_postponed_reason_oth"],
                        "SCJ"=>$request["SCJ"],
                        "VIA_test_Result"=>$request["via_test_res"],
                        "refer_OG"=>$request["referred_OG"],
                        "Counselling_VIA_result_done"=>$request["counselling_via_res_by"],
                        "Eglible_thermal_ablation"=>$request["eligible_thermal_ablation"],
                        "Eglible_thermal_ablation_reason"=>$request["eligible_thermal_ablation_rea"],
                        "Eglible_thermal_ablation_specify"=>$request["eligible_thermal_ablation_rea_oth"],
                        "Thermal_ablation_done"=>$request["thermal_ablation"],
                        "Thermal_No_specify"=>$request["thermal_ablation_rea"],
                        "Thermal_other_specify"=>$request["thermal_ablation_rea_oth"],
                        "Postpone_date"=>$request["eligible_postpone_date"],
                        "Thermal_ablation_result"=>$request["thermal_ablation_res"],
                        "Thermal_ablation_performed"=>$request["thermal_ablation_per_by"],
                        "Date"=>$request["thermal_ablation_date"],
                        "Followup_date"=>$request["followup_date"],
                        "Tertiary_Further_treatment"=>$request["ref_to_tertiary_center_fut_treat"],
                        "AE(Y/N)"=>$request["ae"],
                        "AE_Date"=>$request["ae_date"],
                        "Complaint"=>$request["complaint"],
                        "Complaint_yes"=>$request["complaint_spec"],
                        "Complaint_other"=>$request["complaint_spec_oth"],
                        "Refer_Hosp"=>$request["ref_hos"],
                        "AE_realated_thermal_ablation"=>$request["ae_thermal_relAblation"],
                        "Treatment"=>$request["treatment"],
                        "AE_followUp_Date"=>$request["AE_followup_date"],
                    ]);
                    return response()->json([
                        "Successfully",$followhas
                    ]);
                }else{
                    return response()->json([
                        "Today, This patients has been collected"
                    ]);
                }
            }else{
                return response()->json([
                    "This patients don't pass reception"
                ]);
            }
            
            
        }

        if($notice=="Cercival Updated Record"){
            $updated_alert= Cervicalcancer::where("id",$request["update_Id"])->where("General ID",$request["update_GenerlID"])->update([
                        "Clinic_code"=>$request["Clinic Code"],
                        "General ID"=>$request["cercival_pid"],
                        "FuchiaID"=>$request["cercival_fid"],
                        "Agey"=>$request["cervical_age"],
                        "Hiv_Status"=>$request["crecival_hivStatus"],
                        "FSW"=>$request["crecival_FSW"],
                        "Visit_date"=>$request["cercival_VDate"],
                        "No_previous_preg"=>$request["num_prev_preg"],
                        "Birth_spacing_met"=>$request["birth_spacing_met"],
                        "LMP"=>$request["cercival_LMP"],
                        "UCG_test_date"=>$request["UCG_test_date"],
                        "UCG_test_res"=>$request["UCG_test_res"],
                        "Breast_self"=>$request["crecival_selfhave"],
                        "Breast_family_his"=>$request["crecival_familyHis_have"],
                        "Breast_examination"=>$request["crecival_breastExam"],
                        "Breast_abnormal_find_breast"=>$request["crecival_abnormal_breast"],
                        "Breast_remark"=>$request["breast_remark"],
        
                        "Discharge"=>$request["discharge"],
                        "Cervix_bleed_touch"=>$request["cervix_bleed"],
                        "Tenderness"=>$request["tenderness"],
                    
                        "Malignancy"=>$request["malignancy"],
                        "Comments_spec"=>$request["spc_comments"],
                        
        
                        "Sti_Complaint"=>$request["sti_complaint"],
                        "Sti_examination"=>$request["sti_examination"],
                        "VIA_Screening_History"=>$request["via_screening_his"],
                        "VIA_test"=>$request["via_test"],
                        "VIA_postpone_reason"=>$request["via_postponed_reason"],
                        "VIA_specify_reason"=>$request["via_postponed_reason_oth"],
                        "SCJ"=>$request["SCJ"],
                        "VIA_test_Result"=>$request["via_test_res"],
                        "refer_OG"=>$request["referred_OG"],
                        "Counselling_VIA_result_done"=>$request["counselling_via_res_by"],
                        "Eglible_thermal_ablation"=>$request["eligible_thermal_ablation"],
                        "Eglible_thermal_ablation_reason"=>$request["eligible_thermal_ablation_rea"],
                        "Eglible_thermal_ablation_specify"=>$request["eligible_thermal_ablation_rea_oth"],
                        "Thermal_ablation_done"=>$request["thermal_ablation"],
                        "Thermal_No_specify"=>$request["thermal_ablation_rea"],
                        "Thermal_other_specify"=>$request["thermal_ablation_rea_oth"],
                        "Postpone_date"=>$request["eligible_postpone_date"],
                        "Thermal_ablation_result"=>$request["thermal_ablation_res"],
                        "Thermal_ablation_performed"=>$request["thermal_ablation_per_by"],
                        "Date"=>$request["thermal_ablation_date"],
                        "Followup_date"=>$request["followup_date"],
                        "Tertiary_Further_treatment"=>$request["ref_to_tertiary_center_fut_treat"],
                        "AE(Y/N)"=>$request["ae"],
                        "AE_Date"=>$request["ae_date"],
                        "Complaint"=>$request["complaint"],
                        "Complaint_yes"=>$request["complaint_spec"],
                        "Complaint_other"=>$request["complaint_spec_oth"],
                        "Refer_Hosp"=>$request["ref_hos"],
                        "AE_realated_thermal_ablation"=>$request["ae_thermal_relAblation"],
                        "Treatment"=>$request["treatment"],
                        "AE_followUp_Date"=>$request["AE_followup_date"],
            ]);
            if($updated_alert){
                return response()->json([
                    "Successfully Updated",
                ]);
            }else{
                return response()->json([
                    "You Fail Updated contact the Admin"
                ]);
               
            }
        }
        
        if($notice=="Export_Cancer"){
            $disForm = $request->input("cc_dateFrom");
            $timestamp = strtotime($disForm);
            $disForm  = date('Y-m-d', $timestamp);

            $disTo=$request->input("cc_dateTo");
            $timestamp = strtotime($disTo);
            $disTo  = date('Y-m-d', $timestamp);
            

            $cervical_export=Cervicalcancer::whereBetween("Visit_date",[$disForm, $disTo])->with([
                'ptconfig' => function ($query) {
                    $query->select("Pid",'Date of Birth','Agey','Agem');
                }
            ])
            ->get()->makeHidden(['created_at', 'updated_at']);
           
            
           

            
            // return $cercival_export;
            return Excel::download(new Cervical_Export($cervical_export), 'Cercival Cancer Export.xlsx');
        }
       

    }
}
