<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Imports\General_confid_Import;
use App\Imports\General_pt_Import;
use App\Imports\Lab_afb_Import;
use App\Imports\Lab_covid_Import;
use App\Imports\Lab_general_Import;
use App\Imports\Lab_hepc_Import;
use App\Imports\Lab_hiv_Import;
use App\Imports\Lab_hts_Import;
use App\Imports\Lab_oi_Import;
use App\Imports\Lab_rpr_Import;
use App\Imports\Lab_sti_Import;
use App\Imports\Lab_stool_Import;
use App\Imports\Lab_urine_Import;
use App\Imports\Lab_viralLoad_Import;
use App\Imports\StiFemaleImport;
use App\Imports\StiMaleImport;




class ImportController extends Controller
{
  public function generalImportView(){
        return view('import.GeneralPatientImport');
  }

  public function passport_view(){
            return view('import.passport');
  }

  
 
 public function importer_select(Request $request){
    $table_name       = $request  ->input('table_name');

    switch ($table_name) {
       
            case 'confid':
                return $this->generalPatient_confid($request);
                break;
            case 'patient':
                return $this->generalPatient($request);
                break;
            case 'lab_hiv':
                return $this->lab_hiv($request);
                break;
            case 'lab_rpr':
                return $this->lab_rpr($request);
                break;
            case 'lab_sti':
                return $this->lab_sti($request);
                break;
            case 'lab_hepBC':
                return $this->lab_hepBC($request);
                break;
            case 'lab_urine':
                return $this->lab_urine($request);
                break;
            case 'lab_oi':
                return $this->lab_oi($request);
                break;
            case 'lab_general':
                return $this->lab_general($request);
                break;
            case 'lab_stool':
                return $this->lab_stool($request);
                break;
            case 'lab_afb':
                return $this->lab_afb($request);
                break;
            case 'lab_covid':
                return $this->lab_covid($request);
                break;
            case 'lab_viral_load':
                return $this->lab_viral_load($request);
                break;
            case 'hts_service':
                return $this->hts_service($request);
                break;
            case 'sti_male':
                return $this->sti_male($request);
                break;
            case 'sti_female':
                return $this->sti_female($request);
                break;
            
        
        default:
            # code...
            break;
    }
 }
 public function generalPatient_confid($request)
 {

   Excel::import(new General_confid_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function generalPatient($request)
 {

   Excel::import(new General_pt_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_hiv($request)
 {

   Excel::import(new Lab_hiv_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_rpr($request)
 {

   Excel::import(new Lab_rpr_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_sti($request)
 {

   Excel::import(new Lab_sti_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_hepBC($request)
 {

   Excel::import(new Lab_hepc_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_urine($request)
 {

   Excel::import(new Lab_urine_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_oi($request)
 {

   Excel::import(new Lab_oi_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_general($request)
 {

   Excel::import(new Lab_general_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_stool($request)
 {

   Excel::import(new Lab_stool_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_afb($request)
 {

   Excel::import(new Lab_afb_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_covid($request)
 {

   Excel::import(new Lab_covid_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function lab_viral_load($request)
 {

   Excel::import(new Lab_viralLoad_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function hts_service($request)
 {

   Excel::import(new Lab_hts_Import, $request->file('file')->store('temp'));
   return back();

 }
 public function sti_male($request)
 {

   Excel::import(new StiMaleImport, $request->file('file')->store('temp'));
   return back();

 }
 public function sti_female($request)
 {

   Excel::import(new StiFemaleImport, $request->file('file')->store('temp'));
   return back();

 }
 



}
