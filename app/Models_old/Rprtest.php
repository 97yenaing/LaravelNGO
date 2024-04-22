<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rprtest extends Model
{
    use HasFactory;
      protected $fillable = [
        'clinic code',
        'pid',
        'visit_date',
        'fuchiacode',
        'agey',
        'agem',
        'Gender',
        'Type Of Patient',
        'Patient Type Sub',

        'RDT(Yes/No)',
        'RDT Result',
        'Quantitative(Yes/No)',
        'RPR Qualitative',

        'Titre(current)',
        'Titre(Last)',
        'TitreLastDate',
        'Req Dr',
        'Counsellor',
        'Lab Tech',
        'Issue Date',
      ];
}
