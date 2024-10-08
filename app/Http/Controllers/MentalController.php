<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentalController extends Controller
{
	public function mental_view()
	{
		return view('MentalHealth.mentalHealth');
	}
}
