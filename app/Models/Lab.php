<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $connection ='mysql';
      protected $fillable = [
        'id',
        'ClinicName',
        'CID',
        'fuchiacode',
        'agey',
        'agem',
        'Gender',
        'Patient_Type',
        'Patient Type Sub',
        'Patient Type Sub1',
        'Visit_date',
        'vdate',
        'created_by',
        'updated_by',
        'bcollectdate',
        'Detmine_Result',
        'Unigold_Result',
        'STAT_PAK_Result',
        'Final_Result',
        'Req_Doctor',
        'Incon',
        'Counsellor',
        'LabTech',
        'Issue_Date',
        'Comment',
      ];
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"CID","Pid");
    }
}
