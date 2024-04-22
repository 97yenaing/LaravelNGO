<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCovidTest extends Model
{
    use HasFactory;
    protected $fillable = [
            'id',
            'CID'                 ,
            'fuchiacode'           ,
            'agey'                ,
            'agem'                ,
            'Gender'               ,
            'Req_Doctor',
            'visit_date'           ,
            'vdate',
            'Patient Type'         ,
            'Patient Type Sub'     ,
            'Clinic'              ,
            'co_Age'              ,
            'type_of_patient_covid',
            'specimen_type'        ,
            'co_test_type'         ,
            'covid_result'         ,
            'covid_lab_tech'       ,
            'covid_issue_date',
            'Comment'     ,

            'created_by',
            'updated_by'
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"CID","Pid");
    }

}
