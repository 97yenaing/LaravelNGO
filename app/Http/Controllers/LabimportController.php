<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Imports\Lab_hiv_Import;
use App\Imports\Lab_rpr_Import;
use App\Imports\Lab_sti_Import;
use App\Imports\Lab_hepc_Import;
use App\Imports\Lab_urine_Import;
use App\Imports\Lab_oi_Import;
use App\Imports\Lab_general_Import;
use App\Imports\Lab_stool_Import;
use App\Imports\Lab_afb_Import;
use App\Imports\Lab_covid_Import;

class LabimportController extends Controller
{
  public function labs_import_view()
  {
    return view('import.lab_hiv_import');
  }


  public function lab_import_data(Request $request)
  {
    Excel::import(new Lab_hiv_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_rpr_data(Request $request)
  {
    Excel::import(new Lab_rpr_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_sti_data(Request $request)
  {
    Excel::import(new Lab_sti_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_hepc_data(Request $request)
  {
    Excel::import(new Lab_hepc_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_urine_data(Request $request)
  {
    Excel::import(new Lab_urine_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_oi_data(Request $request)
  {
    Excel::import(new Lab_oi_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_general_data(Request $request)
  {
    Excel::import(new Lab_general_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_stool_data(Request $request)
  {
    Excel::import(new Lab_stool_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_afb_data(Request $request)
  {
    Excel::import(new Lab_afb_Import, $request->file('file')->store('temp'));
    return back();
  }
  public function lab_covid_data(Request $request)
  {
    Excel::import(new Lab_covid_Import, $request->file('file')->store('temp'));
    return back();
  }

}
