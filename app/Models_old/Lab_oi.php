<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab_oi extends Model
{
    use HasFactory;
     protected $fillable= [
       'clinic code',
       'CID',
       'fuchiacode',
       'agey',
       'agem',
       'Gender',
       'Requested Doctor',
        'Requested Doctor_New',
       'visit_date',
       'TB_LAM_Report',
       'Serum Result',
       'serum_pos',
       'CSF for Cryptococcal Antigen',
       'csf_crypto_pos',
       'csf_fungal',
       'CSF Smear Giemsa Stain',
       'CSF Smear India Ink',
       'skin_fungal',
       'Skin Smear Giemsa Stain',
       'Skin Smear India Ink',
       'lymph_test',
       'lymph Giemsa Stain',
       'lymph India Ink',
       'Lab Techanician',
       'issued',
       'visitID',
       'Toxo plasma',
       'Toxo igG',
       'Toxo igM',
     ];
}
