<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urine extends Model
{
    use HasFactory;
    protected $fillable = [
      'visitDate',
      'ClinicName',
      'CID',
      'fuchiacode',
      'agey',
      'agem',
      'Gender',
      'Requested Dr',
      'Main Risk',
      'Sub Risk',
      'Utest_done',
      'Utot',
      'Ucolor',
      'Uapp',
      'tubitity',
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

    ];
  

}
