<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeleCounselling extends Model
{
	use HasFactory;
	protected $fillable = [
		'Pid',
		'Age',
		'Enamal',
		'Gender',
		'Call_Date',
		'Counsellor',
		'Remark',
	];
}
