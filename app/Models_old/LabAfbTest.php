<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabAfbTest extends Model
{
    use HasFactory;
    protected $fillable = [

      'clinic code'          ,
      'CID'                  ,
      'fuchiacode'           ,
      'agey'                 ,
      'agem'                 ,
      'Gender'               ,
      'Requested Doctor'     ,
      'visit_date'           ,
      'Patient Type'         ,
      'Patient Type Sub'     ,
      'Clinic'               ,
      'afb_pt_name'          ,
      'afb_pt_address'       ,
      'Previous_TB'          ,
      'HIV_status'           ,
      'reason_for_exam'      ,
      'afb_Pt_type'          ,
      'follow_up_mt'         ,
      'speci_type'           ,
      'oth_spe_ty'           ,
      'slide_num_1'          ,
      'slide_num_2'          ,
      'speci_receive_dt1'    ,
      'visual_app_1'         ,
      'afb_result1'          ,
      'slide1_grading1'      ,
      'speci_receive_dt2'    ,
      'visual_app_2'         ,
      'afb_result2'          ,
      'slide2_grading2'      ,
      'afb_lab_techca'       ,
      'afb_issue_date'       ,
                          ];
}
