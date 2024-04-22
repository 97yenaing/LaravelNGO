<?php
namespace App\Http\Controllers;
//namespace App\Exports;
use Illuminate\Http\Request;
//Exports
use App\Exports\ReceptionExport;
use App\Exports\Reception_fup_Export;

class Reception_exportsController extends Controller
{
  public function export_view(){
      return view('Reception.exports');
  }
  public function export_fup_view(){
      return view('Reception.export_followup');
  }
  public function export(Request $data){
    $year = $data->input('year');
    return (new ReceptionExport($year))->download('HTY_C2_Reception_Register_data.xlsx');
  }
  public function export_fup(Request $data){
    $year = $data->input('year');
    return (new Reception_fup_Export($year))->download('HTY_C2_Reception_FollowUp_data.xlsx');
  }
}
