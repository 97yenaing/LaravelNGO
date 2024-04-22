<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbipt extends Model
{
    use HasFactory;
    protected $fillable = [
        "Clinic_code",
        'Pid_iptTB',
        'FuchiaID_iptTB', 
        'Sex', 
        "Agey",
        "Agem",
        'Counsellor', 
        'IPT_regDate', 
        'IPT_startDate', 
        'IPT_disconDate', 
        'Outcome', 
        'Remark', 
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid_iptTB","Pid");
    }
}
