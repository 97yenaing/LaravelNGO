<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coulselling extends Model
{
    use HasFactory;
    protected $fillable= [
      'Clinic code',
      'Pid',
      "FuchiaID",
      "Gender",
      "Age",
      "Counsellor",
      "Pre",
      "Post",
      "Service_Modality",
      "Mode of Entry",
      'New_Old',
      "Counselling_Date",

      "Main Risk",
      'Sub Risk',

      'HIV_Test_Date',
      'HIV_Test_Determine',
      'HIV_Test_UNI',
      'HIV_Test_STAT',
      'HIV_Final_Result',

      'Syp_Test_Date',
      'Syphillis_RDT',
      'Syphillis_RPR',
      'Syphillis_VDRL',

      'Hep_Test_Date',
      'Hepatitis_B',
      'Hepatitis_C',
    ];
}
