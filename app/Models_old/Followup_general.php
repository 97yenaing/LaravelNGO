<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup_general extends Model
{
    use HasFactory;
      protected $fillable =[
        "Clinic Code",
        "Pid",
        "Agey",
        "Agem",
        "Gender",
        "FuchiaID",
        "PrEPCode",
        'Visit Date',

        "Main Risk",
        "Sub Risk",

        "Patient Type",
        "New_Old",
        "Fever",
        "Diagnosis",
        "Support",

        "Patient Type_1",
        "New_Old_1",
        "Fever_1",
        "Diagnosis_1",
        "Support_1",

        // "Patient Type_2",
        // "New_Old_2",
        // "Fever_2",
        // "Diagnosis_2",
        // "Support_2",

        "Next Appointment Date",
        'Mode',
        'Unplan',
      ];
}
