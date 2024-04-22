<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\PtConfig;
use App\Models\Followup_general;
use App\Models\Lab;
use App\Models\LabHbcTest;
use App\Models\Urine;
use App\Models\NcdAnual;
use App\Models\Rprtest;
use App\Models\Labstitest;
use App\Models\Lab_oi;
use App\Models\LabGeneralTest;
use App\Models\LabStoolTest;
use App\Models\LabAfbTest;
use App\Models\LabCovidTest;
use App\Models\Applog;

use Illuminate\Support\Facades\Crypt;

// For exports
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Lab\Lab_hiv_Export;
use App\Exports\Lab\Lab_rpr_Export;
use App\Exports\Lab\Lab_sti_Export;
use App\Exports\Lab\Lab_hep_Export;
use App\Exports\Lab\Lab_urine_Export;
use App\Exports\Lab\Lab_oi_Export;
use App\Exports\Lab\Lab_general_Export;
use App\Exports\Lab\Lab_stool_Export;
use App\Exports\Lab\Lab_afb_Export;
use App\Exports\Lab\Lab_covid_Export;

use Exportable;
/**
   * Store a new user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

class LabexportController extends Controller
{
  public function hiv_export_file_view(){ return view ('Labs.export');}
  

  public function lab_exporter(Request $data){
    $year = $data -> input('year');
    $test = $data -> input('test');
    if($test=='hiv'){
      return(new Lab_hiv_Export($year))->download('HTY_C2_Lab_HIV_Tests.xlsx');
    }
    if($test=='rpr'){
      return(new Lab_rpr_Export($year))->download('HTY_C2_Lab_RPR_Tests.xlsx');
    }
    if($test=='sti'){
      return(new Lab_sti_Export($year))->download('HTY_C2_Lab_STI_Tests.xlsx');
    }
    if($test=='hep'){
      return(new Lab_hep_Export($year))->download('HTY_C2_Lab_HepB_C_Tests.xlsx');
    }
    if($test=='urine'){
      return(new Lab_urine_Export($year))->download('HTY_C2_Lab_Urine_Tests.xlsx');
    }
    if($test=='oi'){
      return(new Lab_oi_Export($year))->download('HTY_C2_Lab_OI_Tests.xlsx');
    }
    if($test=='general'){
      return(new Lab_general_Export($year))->download('HTY_C2_Lab_HIV_Tests.xlsx');
    }
    if($test=='stool'){
      return(new Lab_stool_Export($year))->download('HTY_C2_stool_HIV_Tests.xlsx');
    }
    if($test=='afb'){
      return(new Lab_afb_Export($year))->download('HTY_C2_Lab_afb_Tests.xlsx');
    }
    if($test=='covid'){
      return(new Lab_covid_Export($year))->download('HTY_C2_Lab_covid_Tests.xlsx');
    }
  }

  public function hiv_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_hiv_Export($year))->download('HTY_C2_Lab_HIV_Tests.xlsx');}

  public function rpr_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_rpr_Export($year))->download('HTY_C2_Lab_RPR_Tests.xlsx');}

  public function sti_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_sti_Export($year))->download('HTY_C2_Lab_STI_Tests.xlsx');}

  public function hep_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_hep_Export($year))->download('HTY_C2_Lab_HepB_C_Tests.xlsx');}

  public function urine_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_urine_Export($year))->download('HTY_C2_Lab_Urine_Tests.xlsx');}

  public function oi_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_oi_Export($year))->download('HTY_C2_Lab_OI_Tests.xlsx');}

  public function general_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_general_Export($year))->download('HTY_C2_Lab_HIV_Tests.xlsx');}

  public function stool_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_stool_Export($year))->download('HTY_C2_stool_HIV_Tests.xlsx');}

  public function afb_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_afb_Export($year))->download('HTY_C2_Lab_afb_Tests.xlsx');}

  public function covid_export_file(Request $data){
    $year = $data -> input('year');
    return(new Lab_covid_Export($year))->download('HTY_C2_Lab_covid_Tests.xlsx');}




}
