<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;



class AllExportController extends Controller
{
  //new Ncd view
  public function all_export_View(){
    return view ('All_Export.export_all');
  }
}
