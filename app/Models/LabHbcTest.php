<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabHbcTest extends Model
{
    use HasFactory;
    protected $fillable = [
    'id',
    'clinic code',
    'CID',
    'fuchiacode',
    'agey',
    'agem',
    'Gender',
    'Visit_date',
    'vdate',
    'Req_Doctor',
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

    'created_by',
        'updated_by'
  ];
  protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"CID","Pid");
    }
}
