<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Imports\GeneralptImport;


class ReceptimportController extends Controller
{
  public function generalImportView(){
        return view('import.GeneralPatientImport');
      }
      public function passport_view(){
            return view('import.passport');
          }
      // This is for Import Section
  public function generalPatient(Request $request)
        {

          Excel::import(new GeneralptImport, $request->file('file')->store('temp'));
          return back();

        }
  public function generalPatient1(Request $request)
              {

                Excel::import(new GeneralptImport, $request->file('file')->store('temp'));
                return back();

              }
public function followup_rows(Request $request)
      {

        Excel::import(new GeneralptImport, $request->file('file')->store('temp'));
        return back();

      }
}
