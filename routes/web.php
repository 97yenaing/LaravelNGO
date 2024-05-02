<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NcdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\ncdRegisterPtController;

use App\Http\Controllers\CervicalcancerscrenningController;
use App\Http\Controllers\CmvController;

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
use App\Http\Controllers\Logsheet_cbsController;
use App\Http\Controllers\TbController;

use App\Http\Controllers\Tb03Controller;
use App\Http\Controllers\PreTBController;
use App\Http\Controllers\TBIPTController;
use App\Http\Controllers\RiskLogController;
use App\Http\Controllers\AllExportController;
use App\Http\Controllers\MME_ExportController;
use App\Http\Controllers\HtsReportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\IdFixController;

use App\Providers\AppServiceProvider;
//use App\Exports\StimaleExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
// use Validator;
//use App\Exports\LabExport;

use App\Exports\PatientsExport;
use App\Exports\Counselling\CounsellingExport;
use App\Exports\Reception\ReceptionExport;
use App\Exports\Lab\LabExport;
use App\Exports\Sti\StiExport;
use App\Exports\dispensing\dispensingExport;


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

Route::get("/", function () {
    return view("welcome");
});

Route::get("Reception/Reception", [ReceptionController::class, "Reception_View"]);
Route::post("Reception/Reception", [ReceptionController::class, "reception_data"])->name("reception_road");

Route::post("Reception/export_followup_tb", [ReceptionController::class, "export"])->name("reception_export");
Route::post("Reception/exportReport", [ConsultationController::class, "report"])->name("reception_report_export");

//
Route::get("Reception/report", [ConsultationController::class, "report_view"])->name("consultation_report_view");
Route::post("Reception/report", [ConsultationController::class, "report_cal"])->name("consultation_report_cal");

Route::get("import/GeneralPatientImport", [ReceptimportController::class, "generalImportView"]);
//Route::post('import/GeneralPatientImport', [ReceptimportController::class,'generalPatient'])->name('general_import');// This is for patients
//Route::post('import/GeneralPatientImport', [ReceptimportController::class,'generalPatient1'])->name('general_import');// This is for confid
Route::post("import/GeneralPatientImport", [ReceptimportController::class, "followup_rows"])->name("general_import"); // This is for follow up

Route::get("Counsellor/counselling", [CounsellingController::class, "room_view"]);
Route::post("Counsellor/counselling", [CounsellingController::class, "save_data"])->name("counsellor_room");

Route::get("Counsellor/hts_report", [HtsReportController::class, "hts_reportView"]);
Route::post("Counsellor/hts_report", [HtsReportController::class, "calculated_report"])->name("hts_calreport");

Route::post("Counsellor/export", [CounsellingController::class, "export_starter"])->name("counsellor_export");

//Route::get('Labs/HtyALabClinic', [HtyALabClinicController::class, 'Hty_A_Lab_View'])->name('labA');
//Route::post('Labs/HtyALabClinic', [HtyALabClinicController::class, 'Hty_A_Lab_data'])->name('lab');
Route::get("Labs/HivLabRecord", [HtyALabClinicController::class, "lab_records"])->name("labRecords");

//Route::get('import/passport', [ReceptimportController::class,'passport_view'])->name('general_import');

//Route::get('Labs/LabMenu',[LabmenuController::class,'labmenu'])->name('labmenu');
//Route::get('Labs/Urine',[UrineController::class,'Urine_view'])->name('urine');
//Route::post('Labs/Urine',[UrineController::class,'Urine'])->name('ckID');

Route::get("Labs/labs", [LabsController::class, "labs_view"])->name("labs_show");
Route::post("Labs/labs", [LabsController::class, "labResponse"])->name("tests");

Route::post("Labs/hiv", [LabsController::class, "export"])->name("lab_export_link");

Route::get("import/lab_hiv_import", [LabimportController::class, "labs_import_view"]);

Route::post("import/lab_hiv_import", [LabimportController::class, "lab_hts_data"])->name("lab_hiv_import");

// Lab Reports Routes
Route::get("Labs/results", [LabreportController::class, "results"]);
Route::post("Labs/results", [LabreportController::class, "reports"])->name("lab-results");

Route::get("Labs/UrineRecords", [LabsController::class, "lab_urine_records"])->name("urineRecords");

Route::get("NCD/Ncd", [ncdRegisterPtController::class, "ncd_View"]);
Route::post("NCD/Ncd", [ncdRegisterPtController::class, "ncdRegister_data"])->name("ncd");

/* Sti Section */

Route::get("STI/stiform", [StiController::class, "stiform_View"]);
Route::post("STI/stiform", [StiController::class, "stidata"])->name("stiData");

Route::post("STI/Export/sti_export", [StiController::class, "export"])->name("sti_export");

Route::get("STI/sti-patients", [StiController::class, "sti_patients"])->name("sti-patients");

Route::get("Reports/STI_Report", [StiController::class, "stiReport_View"])->name("stiReport");
Route::post("Reports/STI_Report", [StiController::class, "stiReport_Calculator"])->name("sticalculate");

Route::get("import/StiFemale_Import", [StiController::class, "stifemaleImport_View"])->name("sti_female_import");
Route::post("import/StiFemale_Import", [StiController::class, "StiFemaleInput"])->name("sti_female");

Route::get("import/Stimale_Import", [StiController::class, "StimaleView"])->name("sti-male-import");
Route::post("import/Stimale_Import", [StiController::class, "StimaleInput"])->name("sti_male");

//Route::get('import/lab_sti_Import', [StiController::class, 'Lab_Sti_View'])->name('labSti');
//Route::post('import/lab_sti_Import', [StiController::class, 'Lab_Sti_input'])->name('labSti');

Route::get("import/RprlabresultsImport", [StiController::class, "Lab_Rpr_View"]);
Route::post("import/RprlabresultsImport", [StiController::class, "Lab_Rpr_input"])->name("labRpr");

// Management
Route::get("Manage/users", [ManageController::class, "user"]);
Route::post("Manage/user", [ManageController::class, "add_user"])->name("add_user");
Route::get("Manage/users_list", [ManageController::class, "user_list"]);

Route::get("Manage/announcement", [AnnounceController::class, "announcement"]);
Route::post("Manage/announcement", [AnnounceController::class, "announcement_add"])->name("ann_add");

Route::get("Manage/key", [AnnounceController::class, "key_view"]);
Route::post("Manage/key", [AnnounceController::class, "key"])->name("key");

Route::get("Manage/info", [AnnounceController::class, "info"]);
// Dispensing
Route::get("Dispensing/dispensing", [DispensingController::class, "dispense_view"]);
Route::post("Dispensing/dispensing", [DispensingController::class, "dispensing_Control"])->name("dispencing_data");

Route::get("Dispensing/dispensingReport", [DispensingController::class, "dispense_viewReport"]);
Route::post("Dispensing/dispensingReport", [DispensingController::class, "dispensing_Control"])->name("dispencing_report");

Route::get("Dispensing/dispensingExport", [DispensingController::class, "dispense_viewexport"]);
Route::post("Dispensing/dispensingExport", [DispensingController::class, "dispensing_Export"])->name("dispencing_export");

Route::post("Dispensing/export/dispensingexportData", [DispensingController::class, "dispensing_Export"])->name("dis_export_link");

//Prevention
Route::get("Prevention/log_sheet", [Logsheet_cbsController::class, "Prevention_View"]);
Route::post("Prevention/log_sheet", [Logsheet_cbsController::class, "Prevention_data"])->name("prevention_data");

Route::get("STI/tb", [TbController::class, "tb_View"]);
Route::post("STI/tb", [TbController::class, "tb_data"])->name("tb_data");

///RiskLog
Route::get("RiskHistory/risk_history", [RiskLogController::class, "risk_log_View"])->name("risk_log_view");
Route::post("RiskHistory/risk_history", [RiskLogController::class, "risk_log"])->name("risk_log_data");

//All Export
Route::get("All_Export/export_all", [AllExportController::class, "all_export_View"])->name("all_exportview");
Route::post("All_Export/export_all", function (Request $request) {
    // Retrieve controller name and method name from the request
    $validator = Validator::make($request->all(), [
        "road" => "required",
    ]);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $control = ["ReceptionController", "LabsController", "CounsellingController", "StiController", "Logsheet_cbsController", "CervicalcancerscrenningController", "CmvController", "ncdRegisterPtController", "Tb03Controller", "PreTBController", "TBIPTController"];
    $controllerName = $control[$request->input("road")];
    $methodName = $request->input("Target");
    $fullControllerName = "App\Http\Controllers\\$controllerName";
    if (class_exists($fullControllerName) && method_exists($fullControllerName, $methodName)) {
        return app()->call("$fullControllerName@$methodName");
    } else {
        return response()->json(["error" => "Controller or method not found"], 404);
    }
})->name("all_export");

//MME Export
Route::get("MME/mme_export", [MME_ExportController::class, "mme_export_View"])->name("mme_exportview");
Route::post("MME/mme_export", [MME_ExportController::class, "mme_export"])->name("mme_export");

//NCD
Route::get("NCD/Ncd", [ncdRegisterPtController::class, "ncd_View"]);
Route::post("NCD/Ncd", [ncdRegisterPtController::class, "ncdRegister_data"])->name("ncd");
// Cervical Cancer
Route::get("Cervical_cancer/screnning", [CervicalcancerscrenningController::class, "cc_view"]);
Route::post("Cervical_cancer/screnning", [CervicalcancerscrenningController::class, "cc_data"])->name("cc_data");
//CMV
Route::get("CMV/cmv_treatment", [CmvController::class, "CMV_View"]);
Route::post("CMV/cmv_treatment", [CmvController::class, "CMV"])->name("cmv_data");
//TB
Route::get("TB/tb03", [Tb03Controller::class, "tb03_View"]);
Route::post("TB/tb03", [Tb03Controller::class, "Tb03"])->name("tb03_data");

Route::get("TB/export/tb03_report_07", [Tb03Controller::class, "tb03_goback"])->name("tb03_report_view");
Route::get("TB/export/tb03_report_08", [Tb03Controller::class, "tb03_goback"]);
Route::get("TB/export/tb03_report_IPT", [Tb03Controller::class, "tb03_goback"]);

Route::get("TB/preTB_Assement", [PreTBController::class, "preTB_Assement_View"]);
Route::post("TB/preTB_Assement", [PreTBController::class, "preTB_Assement"])->name("preTB_Assement_data");

Route::get("TB/TB_IPT", [TBIPTController::class, "TBIPT_View"]);
Route::post("TB/TB_IPT", [TBIPTController::class, "TBIPT"])->name("tb_IPT_data");

// Imports
Route::get("import/GeneralPatientImport", [ImportController::class, "generalImportView"]);
//Route::post('import/GeneralPatientImport', [ReceptimportController::class,'generalPatient'])->name('general_import');// This is for patients
//Route::post('import/GeneralPatientImport', [ReceptimportController::class,'generalPatient1'])->name('general_import');// This is for confid
Route::post("import/GeneralPatientImport", [ImportController::class, "importer_select"])->name("general_import"); // This is for follow up

Route::get('Id_Fix/Id_Delete',[IdFixController::class,'idFix_view']);

Route::post('Id_Fix/Id_Delete',[IdFixController::class,'idFix_control'])->name("id_search");


Route::get("/home", [App\Http\Controllers\HomeController::class, "index"])->name("home");

Auth::routes();