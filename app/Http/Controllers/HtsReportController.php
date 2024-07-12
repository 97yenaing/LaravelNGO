<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;



class HtsReportController extends Controller
{
  //new Ncd view
  public function hts_reportView(){
    return view ('Counsellor.hts_report',['hts_result'=>null]);
  }
}