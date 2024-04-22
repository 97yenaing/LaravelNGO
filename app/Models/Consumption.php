<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;
    protected $fillable=[
        "Clinic Code",
        "Pid",
        "FuchiaID",
        "PrEPCode",
        "Sex",
        "Agey",
        "Agem",
        "Main Risk",
        "Nurse",
        "Medical_Data",
        "Given_Date",
    ];
}
