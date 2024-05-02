<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_log extends Model
{
   use HasFactory;
    protected $fillable = [

      "Clinic Code",
      'Pid',
      "FuchiaID",
      "PrEPCode",
      "Agey",
      "Agem",
      "Gender",
      'Reg Date',
      'Date Of Birth',
      'Region',
      'Township',
      'Quarter',
      "Main Risk",
      "Sub Risk",
      'Former Risk',
      'Risk Change_Date',
      'Risk changed',
      'Mode',
      'created_by',
      'updated_by',
      'preCode',
      'Risk Log',
      'Reason'
    ];
}