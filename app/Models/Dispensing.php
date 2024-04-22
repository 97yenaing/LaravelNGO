<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispensing extends Model
{
    
    use HasFactory;
    protected $fillable= [
        "Sr_Num",
        "Medic_item",
        "Stock",
        
    ];
}
