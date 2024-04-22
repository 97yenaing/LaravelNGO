<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabHbcTest extends Model
{
    use HasFactory;
    protected $fillable = [
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
    'Hiv status',
    'HepB Test',
    'HepB TOT',
    'HepB Result',
    'HepC Test',
    'HepC TOT',
    'HepC Result',
    'Lab Tech',
    'Issue Date',
    'Visit ID',
  ];
}
