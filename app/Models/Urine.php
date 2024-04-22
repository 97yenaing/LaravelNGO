<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urine extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'visitDate',
      'vdate',
      'ClinicName',
      'CID',
      'fuchiacode',
      'agey',
      'agem',
      'Gender',
      'Req_Doctor',
      'Main Risk',
      'Sub Risk',
      'Utest_done',
      'Utot',
      'Ucolor',
      'Uapp',
      'Uturbitity',
      'Upus',
      'ph',
      'Uprotein',
      'Uglucose',
      'Urbc',
      'Uleu',
      'Unitrite',
      'Uketone',
      'Uepithelial',
      'Urobili',
      'Ubillru',
      'Uery',
      'Ucrystal',
      'Uhae',
      'Uother',
      'Ucast',
      'comment',
      'lab_tech',
      'issue_date',
      'Cretinine',
      'Albumin',
      'A:C_ratio',

      'created_by',
      'updated_by'
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"CID","Pid");
    }


}
