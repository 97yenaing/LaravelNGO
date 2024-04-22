<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NcdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\ncdRegisterPtController;

use App\Http\Controllers\HtyALabClinicController;
use App\Http\Controllers\LabmenuController;
use App\Http\Controllers\UrineController;
use App\Http\Controllers\LabsController;
use App\Http\Controllers\StiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StimaleexportController;
use App\Http\Controllers\Reception_exportsController;
use App\Http\Controllers\ReceptimportController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\LabimportController;
use App\Http\Controllers\LabreportController;
use App\Http\Controllers\LabexportController;
use App\Http\Controllers\DispensingController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\AnnounceController;
use App\Http\Controllers\CounsellingController;


use App\Providers\AppServiceProvider;
use App\Exports\StimaleExport;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LabExport;

use App\Exports\PatientsExport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


//Route::get('/forms/ncd',[NcdController::class, 'allpatients'])->name('register');
Route::get('import/NcdRegImport', [UserController::class, 'fileImportExport']);
Route::post('import/NcdRegImport', [UserController::class, 'fileImport'])->name('ncdimport');

Route::get('import/NcdArImport', [UserController::class, 'ncdArview']);
Route::post('import/NcdArImport', [UserController::class, 'ncd_ArImport'])->name('ncdarview');

Route::get('import/NcdFollowup', [UserController::class, 'ncdfollowupView']);
Route::post('import/NcdFollowup', [UserController::class, 'ncdfollowupImport'])->name('ncdfollowup');

Route::get('Reception/Reception', [ReceptionController::class, 'Reception_View']);
Route::post('Reception/Reception', [ReceptionController::class, 'reception_data'])->name('reception_road');


//Route::get('Reception/patients', [ReceptionController::class, 'patients']);
//Route::post('Reception/generalPatient', [ReceptionController::class, 'general_patients'])->name('gt-patients');
//Route::post('Reception/patients', [ReceptionController::class, 'export'])->name('patient_export');
Route::get('Reception/patients', [ReceptionController::class, 'export'])->name('patient_export');




Route::get('Reception/exports',[Reception_exportsController::class,'export_view']);
Route::post('Reception/exports',[Reception_exportsController::class,'export'])->name('reception_export');

Route::get('Reception/export_followup',[Reception_exportsController::class,'export_fup_view']);
Route::post('Reception/export_followup',[Reception_exportsController::class,'export_fup'])->name('reception_fup_export');


Route::get('Reception/report',[ConsultationController::class,'report_view']);
Route::post('Reception/report',[ConsultationController::class,'report_cal'])->name('consultation_report_cal');


Route::get('import/GeneralPatientImport', [ReceptimportController::class,'generalImportView']);
//Route::post('import/GeneralPatientImport', [ReceptimportController::class,'generalPatient'])->name('general_import');// This is for patients
//Route::post('import/GeneralPatientImport', [ReceptimportController::class,'generalPatient1'])->name('general_import');// This is for confid
Route::post('import/GeneralPatientImport', [ReceptimportController::class,'followup_rows'])->name('general_import');// This is for follow up



Route::get('Counsellor/counselling',[CounsellingController::class,'room_view']);
Route::post('Counsellor/counselling',[CounsellingController::class,'save_data'])->name('counsellor_room');

//Route::get('NCD/ncdRegisterForm', [ncdRegisterPtController::class, 'ncdRegister_View'])->name('ncdreg');
//Route::post('NCD/ncdRegisterForm', [ncdRegisterPtController::class, 'ncdRegister_data'])->name('ncdregistration');
//Route::post('NCD/ncdRegisterForm', [ncdRegisterPtController::class, 'ncdFollowup_data'])->name('ncdregistration');

//Route::get('Labs/HtyALabClinic', [HtyALabClinicController::class, 'Hty_A_Lab_View'])->name('labA');
//Route::post('Labs/HtyALabClinic', [HtyALabClinicController::class, 'Hty_A_Lab_data'])->name('lab');
Route::get('Labs/HivLabRecord',[HtyALabClinicController::class, 'lab_records'])->name('labRecords');


//Route::get('import/passport', [ReceptimportController::class,'passport_view'])->name('general_import');



//Route::get('Labs/LabMenu',[LabmenuController::class,'labmenu'])->name('labmenu');
//Route::get('Labs/Urine',[UrineController::class,'Urine_view'])->name('urine');
//Route::post('Labs/Urine',[UrineController::class,'Urine'])->name('ckID');

Route::get('Labs/labs',[LabsController::class,'labs_view']);
Route::post('Labs/labs',[LabsController::class,'labResponse'])->name('tests');

Route::get('import/lab_hiv_import',[LabimportController::class,'labs_import_view']);

Route::post('import/lab_hiv_import',[LabimportController::class,'lab_import_data'])->name('lab_hiv_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_rpr_data'])->name('lab_rpr_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_sti_data'])->name('lab_sti_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_hepc_data'])->name('lab_hepc_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_urine_data'])->name('lab_urine_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_oi_data'])->name('lab_oi_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_general_data'])->name('lab_general_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_stool_data'])->name('lab_stool_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_afb_data'])->name('lab_afb_import');
//Route::post('import/lab_hiv_import',[LabimportController::class,'lab_covid_data'])->name('lab_covid_import');

// Lab Reports Routes
Route::get('Labs/results', [LabreportController::class, 'results']);
Route::post('Labs/results', [LabreportController::class, 'reports'])->name('lab-results');

Route::get('Labs/UrineRecords',[LabsController::class,'lab_urine_records'])->name('urineRecords');
// Lab Exports Routes
Route::get('Labs/exports',[LabexportController::class,'export_view']);
Route::post('Labs/exports',[LabexportController::class,'exports_files'])->name('labExports');
//exports
Route::get('Labs/export',[LabexportController::class,'hiv_export_file_view']);
Route::post('Labs/export',[LabexportController::class,'lab_exporter'])->name('lab_export');

Route::get('NCD/Ncd', [ncdRegisterPtController::class, 'ncd_View']);
Route::post('NCD/Ncd', [ncdRegisterPtController::class, 'ncdRegister_data'])->name('ncd');

/* Sti Section */

Route::get('STI/stiform',[StiController::class,'stiform_View']);
Route::post('STI/stiform',[StiController::class,'stidata'])->name('stiData');


Route::get('STI/sti-patients',[StiController::class,'sti_patients'])->name('sti-patients');

Route::get('Reports/STI_Report',[StiController::class,'stiReport_View']);
Route::post('Reports/STI_Report',[StiController::class,'stiReport_Calculator'])->name('sticalculate');

Route::get('import/StiFemale_Import', [StiController::class,'stifemaleImport_View']);
Route::post('import/StiFemale_Import', [StiController::class,'StiFemaleInput'])->name('sti_female');

Route::get('import/Stimale_Import', [StiController::class, 'StimaleView']);
Route::post('import/Stimale_Import', [StiController::class, 'StimaleInput'])->name('sti_male');

//Route::get('import/lab_sti_Import', [StiController::class, 'Lab_Sti_View'])->name('labSti');
//Route::post('import/lab_sti_Import', [StiController::class, 'Lab_Sti_input'])->name('labSti');

Route::get('import/RprlabresultsImport', [StiController::class, 'Lab_Rpr_View']);
Route::post('import/RprlabresultsImport', [StiController::class, 'Lab_Rpr_input'])->name('labRpr');



//Route::get('Reception/HTY_A_Recession', [SampleController::class,'detectFaces']);

//Route::get('users/export/', [UsersController::class, 'export']);
 //Route::get('import/Stimale_Import/',[StiController::class,'export'])->name('sti-male-export');
//Route::get('aaaaa',[StiController::class, 'fileExport_female'])->name('sti-female-export');
//Route::get('users/export/', [UsersController::class, 'export']);

// Management
Route::get('Manage/users',[ManageController::class,'user']);
Route::post('Manage/user',[ManageController::class,'add_user'])->name('add_user');
Route::get('Manage/users_list',[ManageController::class,'user_list']);

Route::get('Manage/announcement',[AnnounceController::class,'announcement']);
Route::post('Manage/announcement',[AnnounceController::class,'announcement_add'])->name('ann_add');

Route::get('Manage/key',[AnnounceController::class,'key_view']);
Route::post('Manage/key',[AnnounceController::class,'key'])->name('key');

Route::get('Manage/info',[AnnounceController::class,'info']);
// Dispensing
Route::get('Dispensing/dispensing', [DispensingController::class, 'dispense_view']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
