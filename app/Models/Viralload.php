<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viralload extends Model
{
  use HasFactory;
  protected $fillable = [
    'id',
    'Clinic',
    'CID',
    'fuchiacode',
    'agey',
    'agem',
    'Gender',
    'Main-Risk',
    'Sub-Risk',
    'Req_Doctor',
    'ART_ini_date',
    'ART_duration',

    'Sample_Ship_Date',
    'vdate',
    'Sample Sent to',
    'Result received date',
    'Viral Load Result',
    'Other org code',
    'Remark',
    'Detect',

    'created_by',
        'updated_by',
  ];
  protected $connection ='mysql';
  public function ptconfig(){
    return $this->belongsTo(PtConfig::class,"CID","Pid");
  }
}
