<?php
namespace App\Http\Controllers;
//namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;


class DispensingController extends Controller
{
  public function dispense_view(){
    return view (
      'Dispensing.dispensing'
    );
  }
}
