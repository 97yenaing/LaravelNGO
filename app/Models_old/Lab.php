<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
      protected $fillable = [
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
        'bcollectdate',
        'Detmine_Result',
        'Unigold_Result',
        'STAT_PAK_Result',
        'Final_Result',
        'Req_Doct_old',
        'Req_Doct',
        'Incon',
        'Counsellor',
        'LabTech'
      ];
}
