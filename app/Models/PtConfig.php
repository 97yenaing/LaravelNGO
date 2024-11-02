<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtConfig extends Model
{
  use HasFactory;
  protected $connection = 'mysql2';
  protected $fillable = [
    'Clinic Code',
    'Pid',
    'FuchiaID',
    'PrEPCode',
    'Name',
    'Father',
    'Agey',
    'Agem',
    'Gender',
    'Reg Date',
    'Date Of Birth',
    'Region',
    'Township',
    'Quarter',
    "Patient Type",
    "Patient Type Sub",
    'Main Risk',
    'Sub Risk',
    'Former Risk',
    'Risk Change_Date',
    'Phone',
    'Phone2',
    'Phone3',
    'Mode',
    'created_by',
    'updated_by',
    'preCode',
    'Risk Changed',
    'Risk Log',
  ];

  public function lab_hiv()
  {
    return $this->hasMany(Lab::class, 'CID', 'Pid');
  }
  public function mentalRegister()
  {
    return $this->hasOne(mentalRegister::class, 'Pid', 'Pid');
  }
  public function mentalFollow()
  {
    return $this->hasMany(mentalFollow::class, 'Pid', 'Pid');
  }
}
