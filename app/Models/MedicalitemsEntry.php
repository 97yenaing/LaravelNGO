<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalitemsEntry extends Model
{
    use HasFactory;
    protected $fillable=[
        
        "Serial Number",
        "Medical Item Name",
        "Amount",
        "Arrival_Date",
        "Remark",
        
    ];
}
