<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounsellorRecords extends Model
{
    use HasFactory;
    protected $fillable=
    [
                            "Clinic Code",
                            'Pid',
                            "FuchiaID",
                            "PrEPCode",
                            "Gender",
                            "Agey",
                            "Agem",

                            "Counselling_Date",
                            "Counsellor",
                            "Main Risk",
                            "Sub Risk",

                            "Pre",
                            "Post",
                            "HTSdone",
                            "Reason",
                            "Status",
                            "PrEP",
                            "PrEP Status",
                            "C1",
                            "C2",
                            "C3",
                            "ADH",
                            "Child under15 Adoles",
                            "Child under15 Dis",
                            "Child under15 ADH",
                            "MMT",//now OSt
                            "IPT",
                            "TB",
                            "NCD",
                            "ANC",
                            "PFA",
                            "PHQ9",
                            "Other",
                            "EAC",
                            "HMT",
                            "C P case",
                            "PMTCT",
                            'c2_done',
                            'stable',
                            'phq4',
                            'gad7',
                            'brest_cancer',
                            'hepC',
                            'art_ost',
                            'd1',
                            'd2',
                            'd3',
                            'd4',
                            'cage',
                            
                            'created_by',
      			            'updated_by',
                            'Disclosure_Define', 
                            'Case_Presention', 
                            'PHQ9_Define', 
                            'PHATB_Define',
                            'Only_IPT', 
                            'Only_TB_Define',
                            'gad7_Define',
                          ];
                          protected $connection ='mysql';
                          public function ptconfig(){
                              return $this->belongsTo(PtConfig::class,"Pid","Pid");
                          }
}