<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab_oi extends Model
{
    use HasFactory;
     protected $fillable= [
       'id',
       'clinic code',
       'CID',
       'fuchiacode',
       'agey',
       'agem',
       'Gender',
       'Req_Doctor',
       'visit_date',
       'vdate',
       'Main Risk',
       'Sub Risk',
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

       'created_by',
        'updated_by'
     ];
     protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"CID","Pid");
    }

}
