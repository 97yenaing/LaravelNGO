<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mental_Health extends Model
{
	use HasFactory;
	protected $fillable = [
		'Pid',
		'Counselling_Date',
		'Q1_Q2',
		'Q3_Q4',
		'gad7_amount',
		'PHQ9_amount',
		'Drug3M',
		'SexDrug',
		'ChemSex',
		'A',
		'B',
		'C',
		'D',
		'Remark',

	];
}
