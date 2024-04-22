<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viralload extends Model
{
  use HasFactory;
  protected $fillable = [
    'Clinic',
    'CID',
    'fuchiacode',
    'agey',
    'agem',
    'Gender',
    'Main-Risk',
    'Sub-Risk',
    'Requested Dr',
    'ART_ini_date',
    'ART_duration',

    'Sample Ship Date',
    'Sample Sent to',
    'Result received date',
    'Viral Load Result',
    'Other org code',
    'Remark',
  ];
}
