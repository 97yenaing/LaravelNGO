<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabGeneralTest extends Model
{
    use HasFactory;
    protected $fillable=[
      'clinic code',
      'CID',
      'fuchiacode',
      'agey',
      'agem',
      'Gender',
      'Visit_date',
      'Requested Doctor old',
      'Requested Doctor new',
      'tdate',
      'Patient_Type',
      'Patient Type Sub',
      'Dangue RDT',
      'NS1 Antigen',
      'IgG Result',
      'IgM Result',
      'Malaria RDT',
      'Malaria RDT Result',
      'Malaria_spec',
      'Malaria_grade',
      'Malaria_stage',
      'malaria_microscopy',
      'Malaria Microscopy Result',
      'RBS test',
      'RBS',
      'FBS test',
      'FBS',
      'haemo_done',
      'haemoglobin',
      'hba1c',

      'Lab Tech',
      'Issue Date',
      'Visit ID',
    ];
}