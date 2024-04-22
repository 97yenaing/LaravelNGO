<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

//Imports
use App\Imports\UsersImport;
use App\Imports\NcdArImport;
use App\Imports\NcdFollowupImport;
use App\Imports\StiFemaleImport;
use App\Imports\StiMaleImport;

//Exports
use App\Exports\UsersExport;

//Models
use App\Models\Ncd_Patient_Register;
use App\Models\Ncd_AR;
use App\Models\HtyANcdFollowup;
use App\Models\Stifemale;
use App\Models\Stimale;



class UserController extends Controller
{
  /**
  * @return \Illuminate\Support\Collection
  */
// Ncd Register View
  public function fileImportExport()
      {
        $data= Ncd_Patient_Register::latest()->paginate(1);

        return view ('import.NcdRegImport',[
                'users' => $data
                ]);
         //return view('file-import');
      }
// for NCd AR blade view
    public function ncdArview()
        {
              $data= Ncd_AR::latest()->paginate(1);

              return view ('import.NcdArImport',[
                      'users' => $data
                      ]);
               //return view('file-import');
        }
//Ncd follow up View
    public function ncdfollowupView()
        {
                  $data= HtyANcdFollowup::latest()->paginate(1);
                  $pt = HtyANcdFollowup::get()
                        ->count();
                  $month = '1';
                  $vdate = HtyANcdFollowup::select('Visit_date')
                          ->get();



                  return view ('import.NcdFollowup',[
                          'users'         => $data,
                          'patientcount'  => $pt,
                          'visitdates'     => $vdate
                          ]);
                   //return view('file-import');
        }

// for STI Female blade view
    public function StiFemaleView()
                {
                      $data= Stifemale::latest()->paginate(1);

                      return view ('import.StiFemale_Import',[
                             'users' => $data
                              ]);
                       //return view('file-import');
                      // return view('import.StiFemale_Import');
                }
// for STI Female blade view
  public function StimaleView()
      {
          $data= Stimale::latest()->paginate(1);

              return view ('import.Stimale_Import',[
                  'users' => $data
                              ]);
                                       //return view('file-import');
                                      // return view('import.StiFemale_Import');
              }

//Ncd Register Import
    public function fileImport(Request $request)
        {
            Excel::import(new UsersImport, $request->file('file')->store('temp'));
            return back();
        }

//for NCd Annual review file Import
    public function ncd_ArImport(Request $request)
        {
            Excel::import(new NcdArImport, $request->file('file')->store('temp'));
            return back();
        }

//for NCd Follow up file Import
    public function ncdfollowupImport(Request $request)
        {
            Excel::import(new NcdFollowupImport, $request->file('file')->store('temp'));
            return back();
        }



    /**
    * @return \Illuminate\Support\Collection
    */

// This is for exports
    public function fileExport()
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }



}

//dh_nb475d
//iad1-shared-d12-02.dreamhost.com
