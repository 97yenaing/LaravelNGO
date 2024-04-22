<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Followup_general;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Lab;
use App\Models\LabHbcTest;
use App\Models\Urine;
use App\Models\Rprtest;
use App\Models\Labstitest;
use App\Models\Lab_oi;
use App\Models\LabGeneralTest;
use App\Models\LabStoolTest;
use App\Models\LabAfbTest;
use App\Models\LabCovidTest;
use App\Models\Viralload;
use App\Models\Coulselling;
use App\Models\CounsellorRecords;
use App\Models\Stifemale;
use App\Models\Stimale;
use App\Models\PreventionLogsheet;
use App\Models\PreventionCBS;
use App\Models\Cervicalcancer;
use App\Models\cmv;
use App\Models\ncd_pt_register;
use App\Models\ncdFollowup;
use App\Models\tb_registerO3;
use App\Models\Tbipt;
use App\Models\preTB;
use App\Models\Consumption;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
// Exports
use App\Exports\Counselling\CounsellingExport;
use Illuminate\Database\Eloquent\Builder;
use DateTime;
use App\Exports\Export_age;
class CounsellingController extends Controller
{
    public function patients()
    {
        $patients = Patients::latest()->paginate(50);
        return view('Reception.patients', ['patients' => $patients]);
    }
    public function general_patients()
    {
        $patients_gt = Patients::latest()->paginate(50);
        return view('Reception.generalPatient', ['gt_patients' => $patients_gt]);
    }
    public function room_view()
    {
        return view('Counsellor.counselling');
    }
    public function save_data(Request $request)
    {
        $gid = $request->input('gid');
        $ckID = $request->input('ckID');
        $update = $request->input('update');
        $cdate = $request->input('cdate');
        $notice = $request['notice'];
        $table = 'General';

        $hiv_test_date = $request->input('hiv_test_date');
        $htsEntry = $request->input('hts_entry');

        $hiv_test = $request->input('hiv_test');
        $rpr_test = $request->input('rpr_test');
        $hepB_test = $request->input('hepB_test');
        $hiv_test_date = $request->input('hiv_test_date');
        $rpr_test_date = $request->input('rpr_test_date');
        $hepB_test_date = $request->input('hepB_test_date');

        $counsellingOnly = $request->input('counsellingOnly');
        // $both_hts_coun = $request -> input('both_hts_coun');
        $listShow = $request->input('listShow');
        $decryptFetch = $request->input('decryptFetch');

        $htsUpdate = $request->input('htsUpdate');
        $address = $request->input('address');
        $pt_data_update = $request->input('pt_data_update');

        $hts_counselling = $request->input('hts_counselling');
        $calDob = Crypt::encryptString($request->input('calDob'));

        if ($notice == 'HTS Remaining') {
            $datefrom = $request['datefrom'];
            $dateto = $request['dateto'];
            $hts_final_reaming = [];

            $hiv_count = Lab::select('CID', 'vdate', 'Patient_Type', 'Gender', 'agey')
                ->whereBetween('vdate', [$datefrom, $dateto])
                ->get();
            $hts_counting = Coulselling::select('Pid')
                ->whereBetween('Counselling_Date', [$datefrom, $dateto])
                ->get();
            $cidArray = $hiv_count->pluck('CID')->all();
            $pidArray = $hts_counting->pluck('Pid')->all();

            $differences = collect(
                array_udiff($cidArray, $pidArray, function ($a, $b) {
                    return $a <=> $b;
                }),
            );
            $seraial_room = 0;
            $hts_remaining_dataes = $hiv_count->whereIn('CID', $differences->all());
            foreach ($hts_remaining_dataes as $key => $hts_remaining) {
                $hts_remaining_dataes[$key]['vdate'] = date('d-m-Y', strtotime($hts_remaining['vdate']));
                $hts_remaining_dataes[$key]['Patient_Type'] = Crypt::decrypt_light($hts_remaining['Patient_Type'], $table);
                $hts_remaining_dataes[$key]['Gender'] = Crypt::decrypt_light($hts_remaining['Gender'], $table);
                $hts_final_reaming[$seraial_room] = $hts_remaining_dataes[$key];
                $seraial_room++;
            }

            return response()->json([$hts_final_reaming]);
        }

        if ($update == 1) {
            // to save data in two table (config and counselling table)
            $region = $request->input('state');
            $region = Crypt::encryptString($region);

            $township = $request->input('township');
            $township = Crypt::encryptString($township);

            $quarter = $request->input('quarter');
            $quarter = Crypt::encryptString($quarter);

            $phone = $request->input('phone');
            $phone = Crypt::encryptString($phone);

            $phone2 = $request->input('phone2');
            $phone2 = Crypt::encryptString($phone2);

            $phone3 = $request->input('phone3');
            $phone3 = Crypt::encryptString($phone3);

            $Date_of_Birth = $request->input('Date_of_Birth');
            $Date_of_Birth = Crypt::encryptString($Date_of_Birth);

            $fatherName = $request->input('father');
            $encrypted_Father = Crypt::encryptString($fatherName);
            Patients::where('Pid', $gid)->update([
                'Main Risk' => $request->Main_risk,
                'Sub Risk' => $request->Sub_risk,
                'Agey' => $request->Agey,
                'Date of Birth' => $request->$Date_of_Birth,
                'updated_by' => $request->updated_by,
            ]);
            PtConfig::where('Pid', $gid)->update([
                'Region' => $region,
                'Township' => $township,
                'Quarter' => $quarter,
                'Phone' => $phone,
                'Phone2' => $phone2,
                'Phone3' => $phone3,
                'Main Risk' => $request->Main_risk,
                'Sub Risk' => $request->Sub_risk,
                'Agey' => $request->Agey,
                'Date of Birth' => $request->$Date_of_Birth,

                'updated_by' => $request->updated_by,
            ]);
            Followup_general::where('Pid', '=', $gid)
                ->where('Visit Date', '=', $cdate)
                ->update([
                    'Main Risk' => $request->Main_risk,
                    'Sub Risk' => $request->Sub_risk,
                    'Agey' => $request->Agey,

                    'updated_by' => $request->updated_by,
                ]);

            $save = 0;
            $lastVisitData = Coulselling::where('Pid', '=', $gid)->get();
            if (count($lastVisitData) > 0) {
                for ($i = 0; $i < count($lastVisitData); $i++) {
                    $lastVisitID = $lastVisitData[$i]['Pid'];
                    $lastVisitDate = $lastVisitData[$i]['Counselling_Date'];

                    if ($lastVisitID == $gid && $lastVisitDate == $cdate) {
                        $gtReg = 0;
                        $DuplicateInput = true;
                        return response()->json([$DuplicateInput]);
                    } else {
                        $save = 1;
                    }
                }
            } else {
                $save = 1;
            }

            if ($save == 1) {
                Coulselling::create([
                    'Clinic code' => $request->clinic_code,
                    'Pid' => $request->gid,
                    'FuchiaID' => $request->fuchiaID,
                    'Gender' => $request->gender,
                    'Age' => $request->agey,

                    'Counsellor' => $request->counsellor,
                    'Counselling_Date' => $request->cdate,
                    'Pre' => $request->pre,
                    'Post' => $request->post,

                    'Main Risk' => $request->Main_risk,
                    'Sub Risk' => $request->Sub_risk,
                    'Service_Modality' => $request->service,
                    'Mode of Entry' => $request->mode_of_entry,
                    'New_Old' => $request->new_old,
                    'HIV_Test_Date' => $request->hiv_test_date,
                    'HIV_Test_Determine' => $request->hiv_determine,
                    'HIV_Test_UNI' => $request->hiv_unigold,
                    'HIV_Test_STAT' => $request->hiv_stat,
                    'HIV_Final_Result' => $request->hiv_final,

                    'Syp_Test_Date' => $request->syp_date,
                    'Syphillis_RDT' => $request->syp_rdt,
                    'Syphillis_RPR' => $request->syp_rpr,
                    'Syphillis_VDRL' => $request->syp_vdrl,

                    'Hep_Test_Date' => $request->hep_date,
                    'Hepatitis_B' => $request->hep_b,
                    'Hepatitis_C' => $request->hep_c,
                    'CBS_HTS' => 2,
                    'Test_Location' => $request->test_locate,

                    'created_by' => $request->updated_by,
                ]);
            }
            $success = [['id' => 1, 'name' => 'Successfully collected']];
            return response()->json([$success]);
        }
        if ($hts_counselling == 1 || $counsellingOnly == 1 || $pt_data_update == 'Only Patient Info_Update' || $pt_data_update == 'Update') {
            // to save data in  table (config and counselling table and HTS)
            $region = $request->input('state');
            $region = Crypt::encryptString($region);

            $township = $request->input('township');
            $township = Crypt::encryptString($township);

            $quarter = $request->input('quarter');
            $quarter = Crypt::encryptString($quarter);

            $phone = $request->input('phone');
            $phone = Crypt::encryptString($phone);

            $phone2 = $request->input('phone2');
            $phone2 = Crypt::encryptString($phone2);

            $phone3 = $request->input('phone3');
            $phone3 = Crypt::encryptString($phone3);

            $fatherName = $request->input('father');
            $encrypted_Father = Crypt::encryptString($fatherName);

            $table = 'General';
            $main_risk = $request->input('Main_Risk');
            $main_risk = Crypt::encrypt_light($main_risk, $table);

            $sub_risk = $request->input('Sub_Risk');
            $sub_risk = Crypt::encrypt_light($sub_risk, $table);

            $gender = $request->input('Gender');
            $gender = Crypt::encrypt_light($gender, $table);

            $counsellor = $request->input('Counsellor');
            $counsellor = Crypt::encrypt_light($counsellor, $table);

            $service = $request->input('service');
            $service = Crypt::encrypt_light($service, $table);

            $mode_of_entry = $request->input('mode_of_entry');
            $mode_of_entry = Crypt::encrypt_light($mode_of_entry, $table);

            $new_old = $request->input('new_old');
            $new_old = Crypt::encrypt_light($new_old, $table);

            $hiv_determine = $request->input('hiv_determine');
            $hiv_determine = Crypt::encrypt_light($hiv_determine, $table);

            $hiv_unigold = $request->input('hiv_unigold');
            $hiv_unigold = Crypt::encrypt_light($hiv_unigold, $table);

            $hiv_stat = $request->input('hiv_stat');
            $hiv_stat = Crypt::encrypt_light($hiv_stat, $table);

            $hiv_final = $request->input('hiv_final');
            $hiv_final = Crypt::encrypt_light($hiv_final, $table);

            $syp_rdt = $request->input('syp_rdt');
            $syp_rdt = Crypt::encrypt_light($syp_rdt, $table);

            $syp_rpr = $request->input('syp_rpr');
            $syp_rpr = Crypt::encrypt_light($syp_rpr, $table);

            $syp_vdrl = $request->input('syp_vdrl');
            $syp_vdrl = Crypt::encrypt_light($syp_vdrl, $table);

            $PrEP_Status = $request->input('PrEP_Status');
            $PrEP_Status = Crypt::encrypt_light($PrEP_Status, $table);

            $hep_b = $request->input('hep_b');
            $hep_b = Crypt::encrypt_light($hep_b, $table);

            $hep_c = $request->input('hep_c');
            $hep_c = Crypt::encrypt_light($hep_c, $table);

            $HTSdone = $request->input('HTSdone');
            $HTSdone = Crypt::encrypt_light($HTSdone, $table);

            $Reason = $request->input('Reason');
            $Reason = Crypt::encrypt_light($Reason, $table);

            $Status = $request->input('Status');
            $Status = Crypt::encrypt_light($Status, $table);

            $old_risk = Crypt::encrypt_light($request['old_risk'], $table);
            $change_risk_rason = $request['change_risk_rason'];
            $labTestDate = $request->input('labTestDate');

            $risk_change_date = $request->input('risk_change_date');

            $cdate = $request->input('Counselling_Date');

            $test_locate = $request->input('test_locate');

            $gid = $request->input('Pid');

            $edit = $request->input('edit');

            $follow_lastDate = Followup_general::where('Pid', $gid)->where('Visit Date', $cdate)->exists();

            if ($follow_lastDate) {
                $test_locate = Crypt::encrypt_light($test_locate, $table);

                $urine_res = Urine::where('CID', '=', $gid)
                    ->where('vdate', $cdate)
                    ->update([
                        'Main Risk' => $main_risk,
                        'Sub Risk' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);

                $sti_lab_res = Labstitest::where('CID', '=', $gid)
                    ->where('vdate', $cdate)
                    ->update([
                        'Type Of Patient' => $main_risk,
                        'Patient Type Sub' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);

                $oi_res = Lab_oi::where('CID', '=', $gid)
                    ->where('vdate', $cdate)
                    ->update([
                        'Main Risk' => $main_risk,
                        'Sub Risk' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);

                $general_res = LabGeneralTest::where('CID', '=', $gid)
                    ->where('vdate', $cdate)
                    ->update([
                        'Patient_Type' => $main_risk,
                        'Patient Type Sub' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);

                //ok

                $afb_res = LabAfbTest::where('CID', '=', $gid)
                    ->where('vdate', $cdate)
                    ->update([
                        'Patient Type' => $main_risk,
                        'Patient Type Sub' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);

                $stool_res = LabStoolTest::where('CID', '=', $gid)
                    ->where('vdate', $cdate)
                    ->update([
                        'Patient Type' => $main_risk,
                        'Patient Type Sub' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);

                $covid_res = LabCovidTest::where('CID', '=', $gid)
                    ->where('vdate', $cdate)
                    ->update([
                        'Patient Type' => $main_risk,
                        'Patient Type Sub' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);
                //ok

                $Vir_res = Viralload::where('CID', '=', $gid)
                    ->where('vdate', $cdate)
                    ->update([
                        'Main-Risk' => $main_risk,
                        'Sub-Risk' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);
                $hiv_res = Lab::where('CID', '=', $gid)
                    ->where('vdate', '=', $cdate)
                    ->update([
                        'Patient_Type' => $main_risk,
                        'Patient Type Sub' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);
                $rpr_value = Rprtest::where('pid', '=', $gid)
                    ->where('vdate', '=', $cdate)
                    ->update([
                        'Type Of Patient' => $main_risk,
                        'Patient Type Sub' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);

                $hbc_res = LabHbcTest::where('CID', '=', $gid)
                    ->where('vdate', '=', $cdate)
                    ->update([
                        'Patient_Type' => $main_risk,
                        'Patient Type Sub' => $sub_risk,
                        'updated_by' => $request->created_by,
                        'agey' => $request->Agey,
                    ]);

                $sti_female = Stifemale::where('CID', '=', $gid)
                    ->where('Visit_date', $cdate)
                    ->update([
                        'risk_factor' => $main_risk,
                        'updated_by' => $request->created_by,
                        'age' => $request->Agey,
                    ]);

                $sti_female = Stimale::where('CID', '=', $gid)
                    ->where('Visit_date', $cdate)
                    ->update([
                        'risk_factor' => $main_risk,
                        'updated_by' => $request->created_by,
                        'age' => $request->Agey,
                    ]);

                $prevention = PreventionLogsheet::where('Pid', '=', $gid)
                    ->where('Visit_date', $cdate)
                    ->update([
                        'Main_Risk' => $main_risk,
                        'Sub_Risk' => $sub_risk,
                        'Risk changed Date' => $risk_change_date,
                        'Initial Risk' => $old_risk,
                        'Risk Changed' => $change_risk_rason,
                        'Agey' => $request->Agey,
                    ]);

                $cbs_prevention = PreventionCBS::where('Pid', '=', $gid)
                    ->where('Visit_Date', $cdate)
                    ->update([
                        'Main_Risk' => $main_risk,
                        'Sub_Risk' => $sub_risk,
                        'Agey' => $request->Agey,
                    ]);

                $cmv = cmv::where('Pid_cmv', '=', $gid)
                    ->where('Visit_date', $cdate)
                    ->update([
                        'Patient_Type' => $main_risk,
                        'Agey' => $request->Agey,
                    ]);

                $Consumption = Consumption::where('Pid', '=', strval($gid))
                    ->where('Given_Date', $cdate)
                    ->update([
                        'Main Risk' => $main_risk,
                        'Agey' => $request->Agey,
                        'Agem' => $request->Agem,
                    ]);

                if ($edit == 1) {
                    Patients::where('Pid', $gid)->update([
                        'Agey' => $request->register_age,
                        'Agem' => $request->Agem,
                        'Date of Birth' => $calDob,
                        'updated_by' => $request->created_by,
                    ]);
                    PtConfig::where('Pid', $gid)->update([
                        'Agey' => $request->register_age,
                        'Agem' => $request->Agem,
                        'Date of Birth' => $calDob,
                        'updated_by' => $request->created_by,
                    ]);

                    Followup_general::where('Pid', $gid)
                        ->where('Visit Date', $cdate)
                        ->update([
                            'Agey' => $request->Agey,
                            'Agem' => $request->Agem,
                            'updated_by' => $request->created_by,
                        ]);

                    $cervicalcancer = Cervicalcancer::where('General ID', '=', $gid)
                        ->where('Visit_date', $cdate)
                        ->update([
                            'Agey' => $request->Agey,
                        ]);

                    $ncd_pt_register = ncd_pt_register::where('Pid', '=', $gid)
                        ->where('Reg_Date', $cdate)
                        ->update([
                            'visit_Age' => $request->register_age,
                            'Current_Age' => $request->Agey,
                        ]);
                    $ncdFollowup = ncdFollowup::where('Pid', '=', $gid)
                        ->where('Visit_date', $cdate)
                        ->update([
                            'Agey' => $request->Agey,
                        ]);

                    $tb_registerO3 = tb_registerO3::where('Pid_TB03', '=', $gid)
                        ->where('TreDate_TB03', $cdate)
                        ->update([
                            'Age_TB03' => $request->Agey,
                        ]);

                    $preTB = preTB::where('Pid_preTB', '=', $gid)
                        ->where('VisitDate_preTB', $cdate)
                        ->update([
                            'Agey_preTB' => $request->Agey,
                            'Agem_preTB' => $request->Agem,
                        ]);

                    $Tbipt = Tbipt::where('Pid_iptTB', '=', $gid)
                        ->where('IPT_regDate', $cdate)
                        ->update([
                            'Agey' => $request->Agey,
                            'Agem' => $request->Agem,
                        ]);
                }
                if ($risk_change_date == null) {
                    $risk_change_date = Carbon::now()->format('Y-m-d');
                }
                $old_risk_log = PtConfig::where('Pid', $gid)->select('Risk Log')->first();

                $risk_history = $old_risk_log['Risk Log'] . $risk_change_date . ':' . $old_risk . ':' . $main_risk . ':' . $change_risk_rason . ':' . $request->created_by . '/';
                PtConfig::where('Pid', $gid)
                    ->where('Main Risk', '!=', $main_risk)
                    ->where('Main Risk', '!=', null)
                    ->where('Main Risk', '!=', '731')
                    ->update([
                        'Risk Log' => $risk_history,
                    ]);
                Patients::where('Pid', $gid)
                    ->where('Main Risk', '!=', $main_risk)
                    ->where('Main Risk', '!=', null)
                    ->where('Main Risk', '!=', '731')
                    ->update([
                        'Risk Log' => $risk_history,
                    ]);

                $patient = Patients::where('Pid', $gid)->update([
                    'Main Risk' => $main_risk,
                    'Sub Risk' => $sub_risk,
                    'updated_by' => $request->created_by,
                ]);

                $ptconfig = PtConfig::where('Pid', $gid)->update([
                    'Region' => $region,
                    'Township' => $township,
                    'Quarter' => $quarter,
                    'Phone' => $phone,
                    'Phone2' => $phone2,
                    'Phone3' => $phone3,
                    'Main Risk' => $main_risk,
                    'Sub Risk' => $sub_risk,

                    'updated_by' => $request->created_by,
                ]);
                if ($ptconfig && $change_risk_rason == 'Yes') {
                    $ptconfig = PtConfig::where('Pid', $gid)->update([
                        'Risk Change_Date' => $risk_change_date,
                        'Former Risk' => $old_risk,
                        'Risk Changed' => $change_risk_rason,
                    ]);
                }
                if ($patient && $change_risk_rason == 'Yes') {
                    $ptconfig = Patients::where('Pid', $gid)->update([
                        'Risk Change_Date' => $risk_change_date,
                        'Former Risk' => $old_risk,
                        'Risk Changed' => $change_risk_rason,
                    ]);
                }

                $follow_general = Followup_general::where('Pid', $gid)
                    ->where('Visit Date', $cdate)
                    ->update([
                        'Main Risk' => $main_risk,
                        'Sub Risk' => $sub_risk,
                        'updated_by' => $request->created_by,
                    ]);

                // return response()->json([
                //   "ok pr update"
                // ]);

                if ($hts_counselling == 1 || $counsellingOnly == 1) {
                    $labs_updatedHTs = [$hiv_res, $rpr_value, $hbc_res, $urine_res, $oi_res, $sti_lab_res, $afb_res, $general_res, $stool_res, $covid_res, $Vir_res];
                    $counselling_exists = CounsellorRecords::where('Pid', '=', $gid)->where('Counselling_Date', $cdate)->exists();
                    if ($counsellingOnly == 1) {
                        if ($counselling_exists) {
                            CounsellorRecords::where('Pid', '=', $gid)
                                ->where('Counselling_Date', '=', $cdate)
                                ->update([
                                    'Clinic Code' => $request->clinic_code,
                                    'Pid' => $request->Pid,
                                    'FuchiaID' => $request->FuchiaID,
                                    'PrEPCode' => $request->PrEPCode,
                                    'Gender' => $request->Gender,
                                    'Agey' => $request->Agey,
                                    'Agem' => $request->Agem,

                                    'Counselling_Date' => $request->Counselling_Date,
                                    'Counsellor' => $counsellor,
                                    'Main Risk' => $main_risk,
                                    'Sub Risk' => $sub_risk,

                                    'Pre' => $request->Pre,
                                    'Post' => $request->Post,
                                    'HTSdone' => $HTSdone,
                                    'Reason' => $Reason,
                                    'Status' => $Status,
                                    'PrEP' => $request->PrEP,
                                    'PrEP Status' => $PrEP_Status,
                                    'C1' => $request->c1,
                                    'C2' => $request->c2,
                                    'C3' => $request->c3,
                                    'ADH' => $request->adh,
                                    'Child under15 Adoles' => $request->Child_under15_Adoles,
                                    'Child under15 Dis' => $request->Child_under15_Dis,
                                    'Child under15 ADH' => $request->Child_under15_ADH,
                                    'MMT' => $request->mmt,
                                    'IPT' => $request->ipt,
                                    'TB' => $request->tb,
                                    'NCD' => $request->ncd,
                                    'ANC' => $request->anc,
                                    'PFA' => $request->pfa,
                                    'PHQ9' => $request->phq9,
                                    'Other' => $request->Other,
                                    'EAC' => $request->eac,
                                    'HMT' => $request->hmt,
                                    'C P case' => $request->c_p_case,
                                    'PMTCT' => $request->pmtct,
                                    'c2_done' => $request->c2_done,
                                    'stable' => $request->stable,
                                    'phq4' => $request->phq4,
                                    'gad7' => $request->gad7,
                                    'brest_cancer' => $request->brest_cancer,
                                    'hepC' => $request->hepC,
                                    'art_ost' => $request->art_ost,
                                    'd1' => $request->d1,
                                    'd2' => $request->d2,
                                    'd3' => $request->d3,
                                    'd4' => $request->d4,
                                    'cage' => $request->cage,

                                    'updated_by' => $request->created_by,
                                ]);
                            $success = 1;
                        } else {
                            CounsellorRecords::create([ //where('Pid','=',$gid)->where('Counselling_Date','=',$hiv_test_date)
                                'Clinic Code' => $request->clinic_code,
                                'Pid' => $request->Pid,
                                'FuchiaID' => $request->FuchiaID,
                                'PrEPCode' => $request->PrEPCode,
                                'Gender' => $request->Gender,
                                'Agey' => $request->Agey,
                                'Agem' => $request->Agem,

                                'Counselling_Date' => $request->Counselling_Date,
                                'Counsellor' => $counsellor,
                                'Main Risk' => $main_risk,
                                'Sub Risk' => $sub_risk,

                                'Pre' => $request->Pre,
                                'Post' => $request->Post,
                                'HTSdone' => $HTSdone,
                                'Reason' => $Reason,
                                'Status' => $Status,
                                'PrEP' => $request->PrEP,
                                'PrEP Status' => $PrEP_Status,
                                'C1' => $request->c1,
                                'C2' => $request->c2,
                                'C3' => $request->c3,
                                'ADH' => $request->adh,
                                'Child under15 Adoles' => $request->Child_under15_Adoles,
                                'Child under15 Dis' => $request->Child_under15_Dis,
                                'Child under15 ADH' => $request->Child_under15_ADH,
                                'MMT' => $request->mmt,
                                'IPT' => $request->ipt,
                                'TB' => $request->tb,
                                'NCD' => $request->ncd,
                                'ANC' => $request->anc,
                                'PFA' => $request->pfa,
                                'PHQ9' => $request->phq9,
                                'Other' => $request->Other,
                                'EAC' => $request->eac,
                                'HMT' => $request->hmt,
                                'C P case' => $request->c_p_case,
                                'PMTCT' => $request->pmtct,
                                'c2_done' => $request->c2_done,
                                'stable' => $request->stable,
                                'phq4' => $request->phq4,
                                'gad7' => $request->gad7,
                                'brest_cancer' => $request->brest_cancer,
                                'hepC' => $request->hepC,
                                'art_ost' => $request->art_ost,
                                'd1' => $request->d1,
                                'd2' => $request->d2,
                                'd3' => $request->d3,
                                'd4' => $request->d4,
                                'cage' => $request->cage,
                                'created_by' => $request->created_by,
                            ]);
                            $success = 1;
                        }
                    }
                    // this is counselling only close
                    elseif ($hts_counselling == 1) {
                        $hts_exists = Coulselling::where('Pid', '=', $gid)->where('Counselling_Date', $cdate)->exists();
                        $cbs_hts_exist = Coulselling::where('Pid', '=', $gid)->where('Counselling_Date', $cdate)->where('CBS_HTS', 1)->exists();
                        $counsellor_hts_exist = Coulselling::where('Pid', '=', $gid)->where('Counselling_Date', $cdate)->where('CBS_HTS', 2)->exists();
                        if (!$hts_exists || ($hts_exists && $cbs_hts_exist && !$counsellor_hts_exist)) {
                            if (!$counselling_exists) {
                                if ($hiv_res || $test_locate == 'private') {
                                    Coulselling::create([ // HTS Create row input
                                        'Clinic code' => $request->clinic_code,
                                        'Pid' => $request->Pid,
                                        'FuchiaID' => $request->FuchiaID,
                                        'Gender' => $gender,
                                        'Age' => $request->Agey,

                                        'Counsellor' => $counsellor,
                                        'Counselling_Date' => $request->Counselling_Date,
                                        'Pre' => $request->Pre,
                                        'Post' => $request->Post,

                                        'Main Risk' => $main_risk,
                                        'Sub Risk' => $sub_risk,
                                        'Service_Modality' => $service,
                                        'Mode of Entry' => $mode_of_entry,
                                        'New_Old' => $new_old,

                                        'HIV_Test_Date' => $request->hiv_test_date,
                                        'HIV_Test_Determine' => $hiv_determine,
                                        'HIV_Test_UNI' => $hiv_unigold,
                                        'HIV_Test_STAT' => $hiv_stat,
                                        'HIV_Final_Result' => $hiv_final,

                                        'Syp_Test_Date' => $request->syp_date,
                                        'Syphillis_RDT' => $syp_rdt,
                                        'Syphillis_RPR' => $syp_rpr,
                                        'Syphillis_VDRL' => $syp_vdrl,

                                        'Hep_Test_Date' => $request->hep_date,
                                        'Hepatitis_B' => $hep_b,
                                        'Hepatitis_C' => $hep_c,
                                        'CBS_HTS' => 2,
                                        'Test_Location' => $request->test_locate,
                                        'created_by' => $request->created_by,
                                    ]);

                                    CounsellorRecords::create([ //where('Pid','=',$gid)->where('Counselling_Date','=',$hiv_test_date)
                                        'Clinic Code' => $request->clinic_code,
                                        'Pid' => $request->Pid,
                                        'FuchiaID' => $request->FuchiaID,
                                        'PrEPCode' => $request->PrEPCode,
                                        'Gender' => $request->Gender,
                                        'Agey' => $request->Agey,
                                        'Agem' => $request->Agem,

                                        'Counselling_Date' => $request->Counselling_Date,
                                        'Counsellor' => $counsellor,
                                        'Main Risk' => $main_risk,
                                        'Sub Risk' => $sub_risk,

                                        'Pre' => $request->Pre,
                                        'Post' => $request->Post,
                                        'HTSdone' => $HTSdone,
                                        'Reason' => $Reason,
                                        'Status' => $Status,
                                        'PrEP' => $request->PrEP,
                                        'PrEP Status' => $PrEP_Status,
                                        'C1' => $request->c1,
                                        'C2' => $request->c2,
                                        'C3' => $request->c3,
                                        'ADH' => $request->adh,
                                        'Child under15 Adoles' => $request->Child_under15_Adoles,
                                        'Child under15 Dis' => $request->Child_under15_Dis,
                                        'Child under15 ADH' => $request->Child_under15_ADH,
                                        'MMT' => $request->mmt,
                                        'IPT' => $request->ipt,
                                        'TB' => $request->tb,
                                        'NCD' => $request->ncd,
                                        'ANC' => $request->anc,
                                        'PFA' => $request->pfa,
                                        'PHQ9' => $request->phq9,
                                        'Other' => $request->Other,
                                        'EAC' => $request->eac,
                                        'HMT' => $request->hmt,
                                        'C P case' => $request->c_p_case,
                                        'PMTCT' => $request->pmtct,
                                        'c2_done' => $request->c2_done,
                                        'stable' => $request->stable,
                                        'phq4' => $request->phq4,
                                        'gad7' => $request->gad7,
                                        'brest_cancer' => $request->brest_cancer,
                                        'hepC' => $request->hepC,
                                        'art_ost' => $request->art_ost,
                                        'd1' => $request->d1,
                                        'd2' => $request->d2,
                                        'd3' => $request->d3,
                                        'd4' => $request->d4,
                                        'cage' => $request->cage,

                                        'created_by' => $request->created_by,
                                    ]);

                                    $success = $labs_updatedHTs; // Custom alert box SuccessFully
                                } else {
                                    $success = 2.1; //This Patient do not test Any HTS Test on
                                }
                            } else {
                                if ($hiv_res || $test_locate == 'private') {
                                    Coulselling::create([ // HTS Create row input
                                        'Clinic code' => $request->clinic_code,
                                        'Pid' => $request->Pid,
                                        'FuchiaID' => $request->FuchiaID,
                                        'Gender' => $gender,
                                        'Age' => $request->Agey,
                                        'Test_Location' => $test_locate,

                                        'Counsellor' => $counsellor,
                                        'Counselling_Date' => $request->Counselling_Date,
                                        'Pre' => $request->Pre,
                                        'Post' => $request->Post,

                                        'Main Risk' => $main_risk,
                                        'Sub Risk' => $sub_risk,
                                        'Service_Modality' => $service,
                                        'Mode of Entry' => $mode_of_entry,
                                        'New_Old' => $new_old,

                                        'HIV_Test_Date' => $request->hiv_test_date,
                                        'HIV_Test_Determine' => $hiv_determine,
                                        'HIV_Test_UNI' => $hiv_unigold,
                                        'HIV_Test_STAT' => $hiv_stat,
                                        'HIV_Final_Result' => $hiv_final,

                                        'Syp_Test_Date' => $request->syp_date,
                                        'Syphillis_RDT' => $syp_rdt,
                                        'Syphillis_RPR' => $syp_rpr,
                                        'Syphillis_VDRL' => $syp_vdrl,

                                        'Hep_Test_Date' => $request->hep_date,
                                        'Hepatitis_B' => $hep_b,
                                        'Hepatitis_C' => $hep_c,

                                        'created_by' => $request->created_by,
                                    ]);
                                    CounsellorRecords::where('Pid', '=', $gid)
                                        ->where('Counselling_Date', '=', $cdate)
                                        ->update([
                                            'Clinic Code' => $request->clinic_code,
                                            'Pid' => $request->Pid,
                                            'FuchiaID' => $request->FuchiaID,
                                            'PrEPCode' => $request->PrEPCode,
                                            'Gender' => $request->Gender,
                                            'Agey' => $request->Agey,
                                            'Agem' => $request->Agem,

                                            'Counselling_Date' => $request->Counselling_Date,
                                            'Counsellor' => $counsellor,
                                            'Main Risk' => $main_risk,
                                            'Sub Risk' => $sub_risk,

                                            'Pre' => $request->Pre,
                                            'Post' => $request->Post,
                                            'HTSdone' => $HTSdone,
                                            'Reason' => $Reason,
                                            'Status' => $Status,
                                            'PrEP' => $request->PrEP,
                                            'PrEP Status' => $PrEP_Status,
                                            'C1' => $request->c1,
                                            'C2' => $request->c2,
                                            'C3' => $request->c3,
                                            'ADH' => $request->adh,
                                            'Child under15 Adoles' => $request->Child_under15_Adoles,
                                            'Child under15 Dis' => $request->Child_under15_Dis,
                                            'Child under15 ADH' => $request->Child_under15_ADH,
                                            'MMT' => $request->mmt,
                                            'IPT' => $request->ipt,
                                            'TB' => $request->tb,
                                            'NCD' => $request->ncd,
                                            'ANC' => $request->anc,
                                            'PFA' => $request->pfa,
                                            'PHQ9' => $request->phq9,
                                            'Other' => $request->Other,
                                            'EAC' => $request->eac,
                                            'HMT' => $request->hmt,
                                            'C P case' => $request->c_p_case,
                                            'PMTCT' => $request->pmtct,
                                            'c2_done' => $request->c2_done,
                                            'stable' => $request->stable,
                                            'phq4' => $request->phq4,
                                            'gad7' => $request->gad7,
                                            'brest_cancer' => $request->brest_cancer,
                                            'hepC' => $request->hepC,
                                            'art_ost' => $request->art_ost,
                                            'd1' => $request->d1,
                                            'd2' => $request->d2,
                                            'd3' => $request->d3,
                                            'd4' => $request->d4,
                                            'cage' => $request->cage,

                                            'updated_by' => $request->created_by,
                                        ]);

                                    $success = $labs_updatedHTs; // Custom alert box SuccessFully
                                } else {
                                    $success = 2.1; //This Patient do not test Any HTS Test on
                                }
                            }
                        } else {
                            $success = 2.2; // This Patient has been Collected in thsi day
                        }
                    }
                } elseif ($pt_data_update == 'Only Patient Info_Update') {
                    $success = 3;
                    $pt_info_update = [$patient, $ptconfig, $follow_general];
                    foreach ($pt_info_update as $pt_value) {
                        if ($pt_value == 1) {
                            $success = 1;
                            break;
                        }
                    }
                } elseif ($pt_data_update == 'Update') {
                    $updatedType = $request->input('updatedType');

                    if ($updatedType == 1) {
                        $counselling_update = CounsellorRecords::where('id', $address)
                            ->where('Pid', '=', $gid)
                            ->where('Counselling_Date', '=', $cdate)
                            ->update([
                                'Clinic Code' => $request->clinic_code,
                                'Pid' => $request->Pid,
                                'FuchiaID' => $request->FuchiaID,
                                'PrEPCode' => $request->PrEPCode,
                                'Gender' => $request->Gender,
                                'Agey' => $request->Agey,
                                'Agem' => $request->Agem,

                                'Counselling_Date' => $request->Counselling_Date,
                                'Counsellor' => $counsellor,
                                'Main Risk' => $main_risk,
                                'Sub Risk' => $sub_risk,

                                'Pre' => $request->Pre,
                                'Post' => $request->Post,
                                'HTSdone' => $HTSdone,
                                'Reason' => $Reason,
                                'Status' => $Status,
                                'PrEP' => $request->PrEP,
                                'PrEP Status' => $PrEP_Status,
                                'C1' => $request->c1,
                                'C2' => $request->c2,
                                'C3' => $request->c3,
                                'ADH' => $request->adh,
                                'Child under15 Adoles' => $request->Child_under15_Adoles,
                                'Child under15 Dis' => $request->Child_under15_Dis,
                                'Child under15 ADH' => $request->Child_under15_ADH,
                                'MMT' => $request->mmt,
                                'IPT' => $request->ipt,
                                'TB' => $request->tb,
                                'NCD' => $request->ncd,
                                'ANC' => $request->anc,
                                'PFA' => $request->pfa,
                                'PHQ9' => $request->phq9,
                                'Other' => $request->Other,
                                'EAC' => $request->eac,
                                'HMT' => $request->hmt,
                                'C P case' => $request->c_p_case,
                                'PMTCT' => $request->pmtct,
                                'c2_done' => $request->c2_done,
                                'stable' => $request->stable,
                                'phq4' => $request->phq4,
                                'gad7' => $request->gad7,
                                'brest_cancer' => $request->brest_cancer,
                                'hepC' => $request->hepC,
                                'art_ost' => $request->art_ost,
                                'd1' => $request->d1,
                                'd2' => $request->d2,
                                'd3' => $request->d3,
                                'd4' => $request->d4,
                                'cage' => $request->cage,
                                'updated_by' => $request->created_by,
                            ]);

                        Coulselling::where('Pid', '=', $gid)
                            ->where('Counselling_Date', '=', $cdate) // HTS Create row input
                            ->update([
                                'Pid' => $request->Pid,
                                'FuchiaID' => $request->FuchiaID,
                                'Age' => $request->Agey,
                                'Test_Location' => $test_locate,

                                'Counsellor' => $counsellor,
                                'Counselling_Date' => $request->Counselling_Date,
                                'Pre' => $request->Pre,
                                'Post' => $request->Post,
                                'Main Risk' => $main_risk,
                                'Sub Risk' => $sub_risk,
                            ]);
                    }
                    // conselling only
                    elseif ($updatedType == 0) {
                        $counselling_update = Coulselling::where('id', $address)
                            ->where('Pid', '=', $gid)
                            ->where('Counselling_Date', '=', $cdate) // HTS Create row input
                            ->update([
                                'Clinic code' => $request->clinic_code,
                                'Pid' => $request->Pid,
                                'FuchiaID' => $request->FuchiaID,
                                'Gender' => $gender,
                                'Age' => $request->Agey,
                                'Test_Location' => $test_locate,

                                'Counsellor' => $counsellor,
                                'Counselling_Date' => $request->Counselling_Date,
                                'Pre' => $request->Pre,
                                'Post' => $request->Post,

                                'Main Risk' => $main_risk,
                                'Sub Risk' => $sub_risk,
                                'Service_Modality' => $service,
                                'Mode of Entry' => $mode_of_entry,
                                'New_Old' => $new_old,

                                'HIV_Test_Date' => $request->hiv_test_date,
                                'HIV_Test_Determine' => $hiv_determine,
                                'HIV_Test_UNI' => $hiv_unigold,
                                'HIV_Test_STAT' => $hiv_stat,
                                'HIV_Final_Result' => $hiv_final,

                                'Syp_Test_Date' => $request->syp_date,
                                'Syphillis_RDT' => $syp_rdt,
                                'Syphillis_RPR' => $syp_rpr,
                                'Syphillis_VDRL' => $syp_vdrl,

                                'Hep_Test_Date' => $request->hep_date,
                                'Hepatitis_B' => $hep_b,
                                'Hepatitis_C' => $hep_c,

                                'updated_by' => $request->created_by,
                            ]);
                        $counselling_update = CounsellorRecords::where('Pid', '=', $gid)
                            ->where('Counselling_Date', '=', $cdate)
                            ->update([
                                'Clinic Code' => $request->clinic_code,
                                'Pid' => $request->Pid,
                                'FuchiaID' => $request->FuchiaID,
                                'PrEPCode' => $request->PrEPCode,
                                'Gender' => $request->Gender,
                                'Agey' => $request->Agey,
                                'Agem' => $request->Agem,

                                'Counselling_Date' => $request->Counselling_Date,
                                'Counsellor' => $counsellor,
                                'Main Risk' => $main_risk,
                                'Sub Risk' => $sub_risk,

                                'Pre' => $request->Pre,
                                'Post' => $request->Post,
                                'HTSdone' => $HTSdone,
                                'Reason' => $Reason,
                                'Status' => $Status,
                                'PrEP' => $request->PrEP,
                                'PrEP Status' => $PrEP_Status,
                                'C1' => $request->c1,
                                'C2' => $request->c2,
                                'C3' => $request->c3,
                                'ADH' => $request->adh,
                                'Child under15 Adoles' => $request->Child_under15_Adoles,
                                'Child under15 Dis' => $request->Child_under15_Dis,
                                'Child under15 ADH' => $request->Child_under15_ADH,
                                'MMT' => $request->mmt,
                                'IPT' => $request->ipt,
                                'TB' => $request->tb,
                                'NCD' => $request->ncd,
                                'ANC' => $request->anc,
                                'PFA' => $request->pfa,
                                'PHQ9' => $request->phq9,
                                'Other' => $request->Other,
                                'EAC' => $request->eac,
                                'HMT' => $request->hmt,
                                'C P case' => $request->c_p_case,
                                'PMTCT' => $request->pmtct,
                                'c2_done' => $request->c2_done,
                                'stable' => $request->stable,
                                'phq4' => $request->phq4,
                                'gad7' => $request->gad7,
                                'brest_cancer' => $request->brest_cancer,
                                'hepC' => $request->hepC,
                                'art_ost' => $request->art_ost,
                                'd1' => $request->d1,
                                'd2' => $request->d2,
                                'd3' => $request->d3,
                                'd4' => $request->d4,
                                'cage' => $request->cage,
                                'updated_by' => $request->created_by,
                            ]);
                    }
                    if ($counselling_update) {
                        $success = 1;
                    } else {
                        $success = 3.2; //do not find HTS or Counseling;
                    }
                }
            } else {
                $success = 2; //This Patient do not Pass Reception Center
            } // HTS and counselling close
            return response()->json([$success]);
        }

        if ($ckID == 1) {
            //to check the patient is in general patients list
            $coun_history = [];
            $year = $request->input('year');
            $vdate = $request->input('vdate');

            $data_in_a_year = Coulselling::whereYear('Counselling_Date', $year)->get();

            $id_in_a_year = []; // collecting id in a year
            for ($i = 0; $i < count($data_in_a_year); $i++) {
                $id_in_a_year[] = $data_in_a_year[$i]['Pid'];
            }
            $new_old = in_array($gid, $id_in_a_year);

            $patientData = PtConfig::where('Pid', '=', $gid)->first();
            $follow = Followup_general::where('Pid', '=', $gid)->where('Visit Date', $vdate)->exists();
            if ($patientData && $follow) {
                $last_rpr_row = Rprtest::where('Pid', '=', $gid)->latest()->limit(1)->get();

                if (count($last_rpr_row) > 1) {
                    $last_rpr = Crypt::decrypt_light($last_rpr_row[0]['Titre(current)'], 'General');
                    $last_rpr_date = $last_rpr_row[0]['visit_date'];
                } else {
                    $last_rpr = 'No dilution';
                    $last_rpr_date = '';
                }
                $ptNameDecrypt = $patientData['Name'];
                $ptNameDecrypt = Crypt::decryptString($ptNameDecrypt);

                $ptRegion = $patientData['Region'];
                $ptRegion = Crypt::decryptString($ptRegion);

                $ptTownship = $patientData['Township'];
                $ptTownship = Crypt::decryptString($ptTownship);

                $ptQuarter = $patientData['Quarter'];
                $ptQuarter = Crypt::decryptString($ptQuarter);

                $phone = $patientData['Phone'];
                $phone = Crypt::decryptString($phone);

                $phone2 = $patientData['Phone2'];
                $phone2 = Crypt::decryptString($phone2);

                $phone3 = $patientData['Phone3'];
                $phone3 = Crypt::decryptString($phone3);

                $dob = $patientData['Date of Birth'];
                $dob = Crypt::decryptString($dob);

                $table = 'General';
                $gender = $patientData['Gender'];
                $gender = Crypt::decrypt_light($gender, $table);

                $main_risk = $patientData['Main Risk'];
                $main_risk = Crypt::decrypt_light($main_risk, $table);

                $sub_risk = $patientData['Sub Risk'];
                $sub_risk = Crypt::decrypt_light($sub_risk, $table);

                // $hts_exist=Coulselling::where('Pid',$gid)
                // ->exists();

                $coun_record_exist = CounsellorRecords::where('Pid', $gid)->exists();
                $coun_alredy_exist = CounsellorRecords::where('Pid', $gid)->where('Counselling_Date', $vdate)->exists();
                if (!$coun_record_exist) {
                    $patient = 'new';
                } else {
                    $patient = 'old';
                }

                if ($coun_alredy_exist) {
                    $adh = $anc = $c1 = $c2 = $c3 = $cp_case = $ch_under15_adh = $ch_under15_adole = $ch_under15_dis = $eac = $fht = $ipt = $mmt = $ncd = $other = $pfa = $phq9 = $pmtct = $prep = $tb = $pre = $post = $c2_done = $stable = $phq4 = $gad7 = $brest_cancer = $hepC = $art_ost = $d1 = $d2 = $d3 = $d4 = $cage = 0;
                    $type_counselling = CounsellorRecords::select('HTSdone', 'Reason', 'Status', 'PrEP', 'PrEP Status', 'C1', 'C2', 'C3', 'ADH', 'Child under15 Adoles', 'Child under15 Dis', 'Child under15 ADH', 'MMT', 'IPT', 'TB', 'NCD', 'ANC', 'PFA', 'PHQ9', 'Other', 'EAC', 'HMT', 'C P case', 'PMTCT', 'Pre', 'Post', 'c2_done', 'stable', 'phq4', 'gad7', 'brest_cancer', 'hepC', 'art_ost', 'd1', 'd2', 'd3', 'd4', 'cage')->where('Pid', '=', $gid)->where('Counselling_Date', $vdate)->get();
                    $table = 'General';
                    for ($coun_res_row = 0; $coun_res_row < count($type_counselling); $coun_res_row++) {
                        $hTSdone = Crypt::decrypt_light($type_counselling[$coun_res_row]['HTSdone'], $table);
                        $prep_status = Crypt::decrypt_light($type_counselling[$coun_res_row]['PrEP Status'], $table);
                        $reason = Crypt::decrypt_light($type_counselling[$coun_res_row]['Reason'], $table);
                        $status = Crypt::decrypt_light($type_counselling[$coun_res_row]['Status'], $table);
                        switch (0) {
                            case $adh:
                                $adh = $type_counselling[$coun_res_row]['ADH']; //1
                            case $anc:
                                $anc = $type_counselling[$coun_res_row]['ANC']; //2
                            case $c1:
                                $c1 = $type_counselling[$coun_res_row]['C1']; //3
                            case $c2:
                                $c2 = $type_counselling[$coun_res_row]['C2']; //4
                            case $c3:
                                $c3 = $type_counselling[$coun_res_row]['C3']; //5
                            case $cp_case:
                                $cp_case = $type_counselling[$coun_res_row]['C P case']; //6
                            case $ch_under15_adh:
                                $ch_under15_adh = $type_counselling[$coun_res_row]['Child under15 ADH'];
                            case $ch_under15_adole:
                                $ch_under15_adole = $type_counselling[$coun_res_row]['Child under15 Adoles'];
                            case $ch_under15_dis:
                                $ch_under15_dis = $type_counselling[$coun_res_row]['Child under15 Dis'];
                            case $eac:
                                $eac = $type_counselling[$coun_res_row]['EAC'];
                            case $fht:
                                $fht = $type_counselling[$coun_res_row]['HMT'];
                            case $ipt:
                                $ipt = $type_counselling[$coun_res_row]['IPT'];
                            case $mmt:
                                $mmt = $type_counselling[$coun_res_row]['MMT'];
                            case $ncd:
                                $ncd = $type_counselling[$coun_res_row]['NCD'];
                            case $other:
                                $other = $type_counselling[$coun_res_row]['Other'];
                            case $pfa:
                                $pfa = $type_counselling[$coun_res_row]['PFA'];
                            case $phq9:
                                $phq9 = $type_counselling[$coun_res_row]['PHQ9'];
                            case $pmtct:
                                $pmtct = $type_counselling[$coun_res_row]['PMTCT'];
                            case $prep:
                                $prep = $type_counselling[$coun_res_row]['PrEP'];
                            case $tb:
                                $tb = $type_counselling[$coun_res_row]['TB'];
                            case $pre:
                                $pre = $type_counselling[$coun_res_row]['Pre'];
                            case $post:
                                $post = $type_counselling[$coun_res_row]['Post'];
                            case $c2_done:
                                $c2_done = $type_counselling[$coun_res_row]['c2_done'];
                            case $stable:
                                $stable = $type_counselling[$coun_res_row]['stable'];
                            case $phq4:
                                $phq4 = $type_counselling[$coun_res_row]['phq4'];
                            case $gad7:
                                $gad7 = $type_counselling[$coun_res_row]['gad7'];
                            case $brest_cancer:
                                $brest_cancer = $type_counselling[$coun_res_row]['brest_cancer'];
                            case $hepC:
                                $hepC = $type_counselling[$coun_res_row]['hepC'];
                            case $art_ost:
                                $art_ost = $type_counselling[$coun_res_row]['art_ost'];
                            case $d1:
                                $d1 = $type_counselling[$coun_res_row]['d1'];
                            case $d2:
                                $d2 = $type_counselling[$coun_res_row]['d2'];
                            case $d3:
                                $d3 = $type_counselling[$coun_res_row]['d3'];
                            case $d4:
                                $d4 = $type_counselling[$coun_res_row]['d4'];
                            case $cage:
                                $cage = $type_counselling[$coun_res_row]['cage'];
                        }
                    }
                    $coun_history = [
                        $pre,
                        $post,
                        $hTSdone,
                        $reason,
                        $status,
                        $prep,
                        $prep_status,
                        $c1,
                        $c2,
                        $c2_done,
                        $c3,
                        $adh,
                        $stable,
                        $ch_under15_adole,
                        $ch_under15_dis,
                        $ch_under15_adh,
                        $mmt, //ost
                        $ipt, //ART+TB/TPT

                        $tb, //only TB
                        $ncd,
                        $anc,
                        $pfa,
                        $phq9,
                        $other,

                        $eac,
                        $fht,
                        $cp_case,
                        $pmtct,
                        $phq4,
                        $gad7,
                        $brest_cancer,
                        $hepC,
                        $art_ost,
                        $d1,
                        $d2,
                        $d3,
                        $d4,
                        $cage,
                    ];
                }
                return response()->json([
                    $patientData,
                    $ptNameDecrypt,
                    $ptRegion,
                    $ptTownship,
                    $ptQuarter,
                    $phone,
                    $phone2,
                    $phone3,
                    $new_old,
                    $dob,
                    $gender,
                    $main_risk,
                    $sub_risk,
                    $patient,
                    // $coun_history,
                    // $coun_alredy_exist,
                    $coun_history,
                    $coun_alredy_exist,
                    $last_rpr,
                    $last_rpr_date,
                    //$service,
                    //$moe,
                ]);
                $ckID = 0;
            } else {
                $err = null;
                return response()->json([$err]);
                $ckID = 0;
            }
        }
        if ($hiv_test == 1) {
            $table = 'General';
            $hiv_test_data = Lab::select('Detmine_Result', 'Unigold_Result', 'STAT_PAK_Result', 'Final_Result')->where('CID', '=', $gid)->where('Visit_date', '=', $hiv_test_date)->first();

            $determine_result = Crypt::decrypt_light($hiv_test_data['Detmine_Result'], $table);

            $unigold_Result = Crypt::decrypt_light($hiv_test_data['Unigold_Result'], $table);
            $stat_PAK_Result = Crypt::decrypt_light($hiv_test_data['STAT_PAK_Result'], $table);
            $final_Result = Crypt::decrypt_light($hiv_test_data['Final_Result'], $table);

            return response()->json([$hiv_test_data, $determine_result, $unigold_Result, $stat_PAK_Result, $final_Result]);
        }
        if ($rpr_test == 1) {
            $table = 'General';
            $rpr_test_data = Rprtest::select('RDT Result', 'RPR Qualitative')->where('pid', '=', $gid)->where('visit_date', '=', $rpr_test_date)->latest('created_at')->first();

            $rdt = Crypt::decrypt_light($rpr_test_data['RDT Result'], $table);
            $rpr = Crypt::decrypt_light($rpr_test_data['RPR Qualitative'], $table);
            //  $vdrl=Crypt::decrypt_light($rpr_test_data["Final_Result"],$table);
            return response()->json([
                $rpr_test_data,
                $rdt,
                $rpr,
                // $vdrl,
            ]);
        }
        if ($hepB_test == 1) {
            $table = 'General';
            $hepB_test_data = LabHbcTest::select('HepB Result', 'HepC Result')->where('CID', '=', $gid)->where('Visit_date', '=', $hepB_test_date)->latest('created_at')->first();

            $hbsag = Crypt::decrypt_light($hepB_test_data['HepB Result'], $table);
            $hcv_ab = Crypt::decrypt_light($hepB_test_data['HepC Result'], $table);
            return response()->json([$hepB_test_data, $hbsag, $hcv_ab]);
        }

        // HTS Section
        if ($listShow == 1) {
            $date_from = $request->input('dateFrom');
            $search_ID = $request->input('search_ID');
            $date_to = $request->input('dateTo');
            $updatedType = $request->input('updatedType');
            $date_from = date($date_from);
            $date_to = date($date_to);

            if ($updatedType == 1) {
                //Counselling only
                $counselling_data = CounsellorRecords::select('id', 'Pid', 'FuchiaID', 'Counselling_Date')
                    ->whereBetween('Counselling_Date', [$date_from, $date_to])
                    ->orwhere('Pid', $search_ID)
                    ->get();
                foreach ($counselling_data as $key => $value) {
                    $pt_age_risk = PtConfig::select('Main Risk', 'Agey', 'Agem')
                        ->where('Pid', $value['Pid'])
                        ->first();
                    $counselling_data[$key]['Main Risk'] = Crypt::decrypt_light($pt_age_risk['Main Risk'], $table);
                    $counselling_data[$key]['Register Age'] = $pt_age_risk['Agey'];
                    $counselling_data[$key]['Register Agem'] = $pt_age_risk['Agem'];
                }
                $updated_data = $counselling_data;
            } elseif ($updatedType == 0) {
                //HTS
                $hts_data = Coulselling::select('id', 'Pid', 'FuchiaID', 'Counselling_Date', 'HIV_Final_Result', 'New_Old')
                    ->whereBetween('Counselling_Date', [$date_from, $date_to])
                    ->orwhere('Pid', $search_ID)
                    ->get();
                foreach ($hts_data as $key => $value) {
                    $pt_age_risk = PtConfig::select('Main Risk', 'Agey', 'Agem')
                        ->where('Pid', $value['Pid'])
                        ->first();
                    $hts_data[$key]['Main Risk'] = Crypt::decrypt_light($pt_age_risk['Main Risk'], $table);
                    $hts_data[$key]['Register Age'] = $pt_age_risk['Agey'];
                    $hts_data[$key]['Register Agem'] = $pt_age_risk['Agem'];
                    $hts_data[$key]['HIV_Final_Result'] = Crypt::decrypt_light($hts_data[$key]['HIV_Final_Result'], $table);
                    $hts_data[$key]['New_Old'] = Crypt::decrypt_light($hts_data[$key]['New_Old'], $table);
                    if ($hts_data[$key]['New_Old'] == null) {
                        $hts_data[$key]['New_Old'] = '';
                    }
                }
                $updated_data = $hts_data;
            }
            if (count($updated_data) > 0) {
                foreach ($updated_data as $key => $up_data) {
                    if (!empty($up_data)) {
                        $updated_data[$key]['Counselling_Date'] = date('d-m-Y', strtotime($up_data['Counselling_Date']));
                        if ($updated_data[$key]['Counselling_Date'] == '01-01-1970') {
                            $updated_data[$key]['Counselling_Date'] = '';
                        }
                    } else {
                        $updated_data[$key]['Counselling_Date'] = '';
                    }
                    if ($up_data['FuchiaID'] == null) {
                        $updated_data[$key]['FuchiaID'] = '-';
                    }
                }
                return response()->json([$updated_data, $updatedType]);
            } else {
                return response()->json(['no data']);
            }
        } // HTS data show
        if ($decryptFetch == 1) {
            // return data from view to encrypt the row
            $address = $request->input('address');
            $res_date = $request->input('res_date');
            $id = $request->input('id');
            $search_ID = $request->input('search_ID');
            $updatedType = $request->input('updatedType');
            $Age = '';
            // $hts_data_next = Coulselling::whereBetween('Counselling_Date', [$date_from, $date_to])->orwhere('Pid',$search_ID)->get();

            $patientData = PtConfig::select('Region', 'Township', 'Quarter', 'Phone', 'Phone2', 'Phone3', 'Reg Date', 'Agey', 'PrEPCode', 'Clinic Code', 'Main Risk', 'Sub Risk', 'Agem', 'Date of Birth')->where('Pid', '=', $id)->first();

            $table = 'General';
            $hTSdone = $prep_status = $reason = $status = $New_Old = '';
            $HIV_Test_Date = $Syp_Test_Date = $Hep_Test_Date = $Service_Modality = $Mode_of_Entry = $HIV_Test_Determine = $HIV_Test_UNI = '';
            $HIV_Test_STAT = $Syphillis_RDT = $HIV_Final_Result = $Syphillis_RPR = $Syphillis_VDRL = $Hepatitis_B = $Hepatitis_C = $test_locate = '';
            $adh = $anc = $c1 = $c2 = $c3 = $cp_case = $ch_under15_adh = $ch_under15_adole = $ch_under15_dis = $eac = $fht = $ipt = $mmt = $ncd = $other = $pfa = $phq9 = $pmtct = $prep = $tb = $pre = $post = $c2_done = $stable = $phq4 = $gad7 = $brest_cancer = $hepC = $art_ost = $d1 = $d2 = $d3 = $d4 = $cage = 0;
            if ($updatedType == 0) {
                //Updated data filler for Hts and counselling

                $hts_data_next = Coulselling::where('id', $address)->where('Pid', $id)->where('Counselling_Date', $res_date)->get();
                $type_counselling = CounsellorRecords::select('HTSdone', 'Reason', 'Status', 'PrEP', 'PrEP Status', 'C1', 'C2', 'C3', 'ADH', 'Child under15 Adoles', 'Child under15 Dis', 'Child under15 ADH', 'MMT', 'IPT', 'TB', 'NCD', 'ANC', 'PFA', 'PHQ9', 'Other', 'EAC', 'HMT', 'C P case', 'PMTCT', 'Pre', 'Post', 'c2_done', 'stable', 'phq4', 'gad7', 'brest_cancer', 'hepC', 'art_ost', 'd1', 'd2', 'd3', 'd4', 'cage')->where('Pid', '=', $id)->where('Counselling_Date', $res_date)->get();
                for ($i = 0; $i < count($hts_data_next); $i++) {
                    if ($address == $hts_data_next[$i]['id']) {
                        $Pid = $hts_data_next[$i]['Pid'];
                        $FuchiaID = $hts_data_next[$i]['FuchiaID'];
                        $Age = $hts_data_next[$i]['Age'];
                        $Pre = $hts_data_next[$i]['Pre'];
                        $Post = $hts_data_next[$i]['Post'];

                        $Counselling_Date = $hts_data_next[$i]['Counselling_Date'];
                        $HIV_Test_Date = $hts_data_next[$i]['HIV_Test_Date'];
                        $Syp_Test_Date = $hts_data_next[$i]['Syp_Test_Date'];
                        $Hep_Test_Date = $hts_data_next[$i]['Hep_Test_Date'];

                        // decrypted section
                        $New_Old = Crypt::decrypt_light($hts_data_next[$i]['New_Old'], $table);
                        $sex = Crypt::decrypt_light($hts_data_next[$i]['Gender'], $table);
                        $Counsellor = Crypt::decrypt_light($hts_data_next[$i]['Counsellor'], $table);
                        $Service_Modality = Crypt::decrypt_light($hts_data_next[$i]['Service_Modality'], $table);
                        $Mode_of_Entry = Crypt::decrypt_light($hts_data_next[$i]['Mode of Entry'], $table);
                        $Main_Risk = Crypt::decrypt_light($patientData['Main Risk'], $table);
                        $Sub_Risk = Crypt::decrypt_light($patientData['Sub Risk'], $table);
                        $HIV_Test_Determine = Crypt::decrypt_light($hts_data_next[$i]['HIV_Test_Determine'], $table);
                        $HIV_Test_UNI = Crypt::decrypt_light($hts_data_next[$i]['HIV_Test_UNI'], $table);
                        $HIV_Test_STAT = Crypt::decrypt_light($hts_data_next[$i]['HIV_Test_STAT'], $table);
                        $HIV_Final_Result = Crypt::decrypt_light($hts_data_next[$i]['HIV_Final_Result'], $table);
                        $Syphillis_RDT = Crypt::decrypt_light($hts_data_next[$i]['Syphillis_RDT'], $table);
                        $Syphillis_RPR = Crypt::decrypt_light($hts_data_next[$i]['Syphillis_RPR'], $table);
                        $Syphillis_VDRL = Crypt::decrypt_light($hts_data_next[$i]['Syphillis_VDRL'], $table);
                        $Hepatitis_B = Crypt::decrypt_light($hts_data_next[$i]['Hepatitis_B'], $table);
                        $Hepatitis_C = Crypt::decrypt_light($hts_data_next[$i]['Hepatitis_C'], $table);
                        $test_locate = Crypt::decrypt_light($hts_data_next[$i]['Test_Location'], $table);
                    }
                }

                for ($coun_res_row = 0; $coun_res_row < count($type_counselling); $coun_res_row++) {
                    $hTSdone = Crypt::decrypt_light($type_counselling[$coun_res_row]['HTSdone'], $table);
                    $prep_status = Crypt::decrypt_light($type_counselling[$coun_res_row]['PrEP Status'], $table);
                    $reason = Crypt::decrypt_light($type_counselling[$coun_res_row]['Reason'], $table);
                    $status = Crypt::decrypt_light($type_counselling[$coun_res_row]['Status'], $table);
                    switch (0) {
                        case $adh:
                            $adh = $type_counselling[$coun_res_row]['ADH']; //1
                        case $anc:
                            $anc = $type_counselling[$coun_res_row]['ANC']; //2
                        case $c1:
                            $c1 = $type_counselling[$coun_res_row]['C1']; //3
                        case $c2:
                            $c2 = $type_counselling[$coun_res_row]['C2']; //4
                        case $c3:
                            $c3 = $type_counselling[$coun_res_row]['C3']; //5
                        case $cp_case:
                            $cp_case = $type_counselling[$coun_res_row]['C P case']; //6
                        case $ch_under15_adh:
                            $ch_under15_adh = $type_counselling[$coun_res_row]['Child under15 ADH'];
                        case $ch_under15_adole:
                            $ch_under15_adole = $type_counselling[$coun_res_row]['Child under15 Adoles'];
                        case $ch_under15_dis:
                            $ch_under15_dis = $type_counselling[$coun_res_row]['Child under15 Dis'];
                        case $eac:
                            $eac = $type_counselling[$coun_res_row]['EAC'];
                        case $fht:
                            $fht = $type_counselling[$coun_res_row]['HMT'];
                        case $ipt:
                            $ipt = $type_counselling[$coun_res_row]['IPT'];
                        case $mmt:
                            $mmt = $type_counselling[$coun_res_row]['MMT'];
                        case $ncd:
                            $ncd = $type_counselling[$coun_res_row]['NCD'];
                        case $other:
                            $other = $type_counselling[$coun_res_row]['Other'];
                        case $pfa:
                            $pfa = $type_counselling[$coun_res_row]['PFA'];
                        case $phq9:
                            $phq9 = $type_counselling[$coun_res_row]['PHQ9'];
                        case $pmtct:
                            $pmtct = $type_counselling[$coun_res_row]['PMTCT'];
                        case $prep:
                            $prep = $type_counselling[$coun_res_row]['PrEP'];
                        case $tb:
                            $tb = $type_counselling[$coun_res_row]['TB'];
                        case $pre:
                            $pre = $type_counselling[$coun_res_row]['Pre'];
                        case $post:
                            $post = $type_counselling[$coun_res_row]['Post'];
                        case $c2_done:
                            $c2_done = $type_counselling[$coun_res_row]['c2_done'];
                        case $stable:
                            $stable = $type_counselling[$coun_res_row]['stable'];
                        case $phq4:
                            $phq4 = $type_counselling[$coun_res_row]['phq4'];
                        case $gad7:
                            $gad7 = $type_counselling[$coun_res_row]['gad7'];
                        case $brest_cancer:
                            $brest_cancer = $type_counselling[$coun_res_row]['brest_cancer'];
                        case $hepC:
                            $hepC = $type_counselling[$coun_res_row]['hepC'];
                        case $art_ost:
                            $art_ost = $type_counselling[$coun_res_row]['art_ost'];
                        case $d1:
                            $d1 = $type_counselling[$coun_res_row]['d1'];
                        case $d2:
                            $d2 = $type_counselling[$coun_res_row]['d2'];
                        case $d3:
                            $d3 = $type_counselling[$coun_res_row]['d3'];
                        case $d4:
                            $d4 = $type_counselling[$coun_res_row]['d4'];
                        case $cage:
                            $cage = $type_counselling[$coun_res_row]['cage'];
                    }
                }
            } elseif ($updatedType == 1) {
                // counselling only
                $coun_row_data = CounsellorRecords::where('id', $address)->where('Pid', '=', $id)->where('Counselling_Date', $res_date)->get();
                for ($i = 0; $i < count($coun_row_data); $i++) {
                    $Pid = $coun_row_data[$i]['Pid'];
                    $FuchiaID = $coun_row_data[$i]['FuchiaID'];
                    $Age = $coun_row_data[$i]['Agey'];
                    $Pre = $coun_row_data[$i]['Pre'];
                    $Post = $coun_row_data[$i]['Post'];
                    $Counselling_Date = $coun_row_data[$i]['Counselling_Date'];
                    $sex = Crypt::decrypt_light($coun_row_data[$i]['Gender'], $table);
                    $Counsellor = Crypt::decrypt_light($coun_row_data[$i]['Counsellor'], $table);
                    $Main_Risk = Crypt::decrypt_light($patientData['Main Risk'], $table, $table);
                    $Sub_Risk = Crypt::decrypt_light($patientData['Main Risk'], $table, $table);

                    $hTSdone = Crypt::decrypt_light($coun_row_data[$i]['HTSdone'], $table);
                    $prep_status = Crypt::decrypt_light($coun_row_data[$i]['PrEP Status'], $table);
                    $reason = Crypt::decrypt_light($coun_row_data[$i]['Reason'], $table);
                    $status = Crypt::decrypt_light($coun_row_data[$i]['Status'], $table);
                    switch (0) {
                        case $adh:
                            $adh = $coun_row_data[$i]['ADH']; //1
                        case $anc:
                            $anc = $coun_row_data[$i]['ANC']; //2
                        case $c1:
                            $c1 = $coun_row_data[$i]['C1']; //3
                        case $c2:
                            $c2 = $coun_row_data[$i]['C2']; //4
                        case $c3:
                            $c3 = $coun_row_data[$i]['C3']; //5
                        case $cp_case:
                            $cp_case = $coun_row_data[$i]['C P case']; //6
                        case $ch_under15_adh:
                            $ch_under15_adh = $coun_row_data[$i]['Child under15 ADH'];
                        case $ch_under15_adole:
                            $ch_under15_adole = $coun_row_data[$i]['Child under15 Adoles'];
                        case $ch_under15_dis:
                            $ch_under15_dis = $coun_row_data[$i]['Child under15 Dis'];
                        case $eac:
                            $eac = $coun_row_data[$i]['EAC'];
                        case $fht:
                            $fht = $coun_row_data[$i]['HMT'];
                        case $ipt:
                            $ipt = $coun_row_data[$i]['IPT'];
                        case $mmt:
                            $mmt = $coun_row_data[$i]['MMT'];
                        case $ncd:
                            $ncd = $coun_row_data[$i]['NCD'];
                        case $other:
                            $other = $coun_row_data[$i]['Other'];
                        case $pfa:
                            $pfa = $coun_row_data[$i]['PFA'];
                        case $phq9:
                            $phq9 = $coun_row_data[$i]['PHQ9'];
                        case $pmtct:
                            $pmtct = $coun_row_data[$i]['PMTCT'];
                        case $prep:
                            $prep = $coun_row_data[$i]['PrEP'];
                        case $tb:
                            $tb = $coun_row_data[$i]['TB'];
                        case $pre:
                            $pre = $coun_row_data[$i]['Pre'];
                        case $post:
                            $post = $coun_row_data[$i]['Post'];
                        case $c2_done:
                            $c2_done = $coun_row_data[$i]['c2_done'];
                        case $stable:
                            $stable = $coun_row_data[$i]['stable'];
                        case $phq4:
                            $phq4 = $coun_row_data[$i]['phq4'];
                        case $gad7:
                            $gad7 = $coun_row_data[$i]['gad7'];
                        case $brest_cancer:
                            $brest_cancer = $coun_row_data[$i]['brest_cancer'];
                        case $hepC:
                            $hepC = $coun_row_data[$i]['hepC'];
                        case $art_ost:
                            $art_ost = $coun_row_data[$i]['art_ost'];
                        case $d1:
                            $d1 = $coun_row_data[$i]['d1'];
                        case $d2:
                            $d2 = $coun_row_data[$i]['d2'];
                        case $d3:
                            $d3 = $coun_row_data[$i]['d3'];
                        case $d4:
                            $d4 = $coun_row_data[$i]['d4'];
                        case $cage:
                            $cage = $coun_row_data[$i]['cage'];
                    }
                }
            }

            $ptRegion = $patientData['Region'];
            $ptRegion = Crypt::decryptString($ptRegion);
            $patientData['Date of Birth'] = Crypt::decryptString($patientData['Date of Birth']);

            $ptTownship = $patientData['Township'];
            $ptTownship = Crypt::decryptString($ptTownship);

            $ptQuarter = $patientData['Quarter'];
            $ptQuarter = Crypt::decryptString($ptQuarter);

            $phone = $patientData['Phone'];
            $phone = Crypt::decryptString($phone);

            $phone2 = $patientData['Phone2'];
            $phone2 = Crypt::decryptString($phone2);

            $phone3 = $patientData['Phone3'];
            $phone3 = Crypt::decryptString($phone3);

            return response()->json([
                $Pid,
                $FuchiaID,
                $Age,
                $Pre,
                $Post,
                $New_Old,
                $Counselling_Date,
                $HIV_Test_Date,
                $Syp_Test_Date,
                $Hep_Test_Date,

                $sex, //10
                $Counsellor,
                $Service_Modality,
                $Mode_of_Entry,
                $Main_Risk,
                $Sub_Risk,
                $HIV_Test_Determine,
                $HIV_Test_UNI,
                $HIV_Test_STAT,
                $HIV_Final_Result,
                $Syphillis_RDT,
                $Syphillis_RPR,
                $Syphillis_VDRL,
                $Hepatitis_B,
                $Hepatitis_C,
                $phone,
                $phone2,
                $phone3,
                $ptQuarter,
                $ptRegion,
                $ptTownship,
                $patientData,
                $hTSdone,
                $prep_status,
                $reason,
                $status,
                $prep,
                $c1,
                $c2,
                $c2_done,
                $c3,
                $adh,
                $stable,
                $ch_under15_adole,
                $ch_under15_dis,
                $ch_under15_adh,
                $mmt, //ost
                $ipt, //ART+TB/TPT

                $tb, //only TB
                $ncd,
                $anc,
                $pfa,
                $phq9,
                $other,

                $eac,
                $fht,
                $cp_case,
                $pmtct,
                $phq4,
                $gad7,
                $brest_cancer,
                $hepC,
                $art_ost,
                $d1,
                $d2,
                $d3,
                $d4,
                $cage,
                //$coun_row_data,
                // $hts_data_next,
                $address,
            ]);
        }
        if ($htsUpdate == 'remove_row') {
            $id = $request['id'];
            $Pid = $request['Pid'];
            $counselling_date = $request['counselling_date'];
            $updated_type = $request['update_type'];
            if ($updated_type == 0) {
                $hts_exist = Coulselling::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->exists();
                if ($hts_exist) {
                    Coulselling::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->delete();
                    $remove_mesg = 'Delete HTS Data';
                } else {
                    $remove_mesg = 'Your Wrong Credential contant to Admin';
                }
            }
            //HTS
            elseif ($updated_type == 1) {
                $counselling_exist = CounsellorRecords::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->exists();
                if ($counselling_exist) {
                    CounsellorRecords::where('id', $id)->where('Pid', $Pid)->where('Counselling_Date', $counselling_date)->delete();
                    $remove_mesg = 'Delete Counselling  Data';
                } else {
                    $remove_mesg = 'Your Wrong Credential contant to Admin';
                }
            }
            //Counselling Only
            else {
                $remove_mesg = "You don't have permission to delete this record";
            }

            return response()->json($remove_mesg);
        } // Remvoe Date HTS or Counselling only

        // Risk_Age_ update
    }
    public function export_starter(Request $data)
    {
        $from = $data->input('dateFrom');
        $to = $data->input('dateTo');
        $table = 'General';

        $hts_coul = $data->input('hts_coul');
        if ($from != null && $from != '' && $to != null && $to != '') {
            $date_from = DateTime::createFromFormat('d-m-Y', $from);
            $from = $date_from->format('Y-m-d');
            $date_to = DateTime::createFromFormat('d-m-Y', $to);
            $to = $date_to->format('Y-m-d');
            if ($hts_coul == 'counsel_data') {
                $users1 = CounsellorRecords::whereBetween('Counselling_Date', [$from, $to])
                    ->with([
                        'ptconfig' => function ($query) {
                            $query->select('Pid', 'Name', 'Township', 'Date of Birth', 'Agey', 'Agem', 'Main Risk', 'Sub Risk'); // Select the specific columns from ptconfig
                        },
                    ])
                    ->get();

                $encrypted_columns = ['Counsellor', 'Main Risk', 'Sub Risk', 'HTSdone', 'Reason', 'Status', 'PrEP Status'];
                $counselling_dates = ['Counselling_Date', 'Reg Date'];
                foreach ($users1 as $key => $user1) {
                    if ($user1['ptconfig'] != null) {
                        $users1[$key] = Export_age::Export_general($user1['ptconfig'], $user1['Counselling_Date'], $user1['ptconfig']['Date of Birth'], $users1[$key]);
                    }

                    $users1[$key]['Main Risk'] = $user1['ptconfig']['Main Risk'];
                    $users1[$key]['Sub Risk'] = $user1['ptconfig']['Sub Risk'];

                    $carbonDate = Carbon::createFromFormat('Y-m-d', $user1['Counselling_Date']);
                    $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));

                    $users1[$key]['Counselling_Date'] = Date::dateTimeToExcel($carbonDate->toDateTime());

                    foreach ($encrypted_columns as $encrypted_column) {
                        $users1[$key][$encrypted_column] = Crypt::decrypt_light($users1[$key][$encrypted_column], $table);
                        $users1[$key][$encrypted_column] = Crypt::codeBook($users1[$key][$encrypted_column], 'encode');
                    }
                }
                return Excel::download(new CounsellingExport($users1, $hts_coul), 'Counselling Export-' . date('d-m-Y') . '.xlsx');
            } elseif ($hts_coul == 'hts_data') {
                $users1 = Coulselling::whereBetween('Counselling_Date', [$from, $to])
                    ->join('labs', 'coulsellings.Pid', '=', 'labs.CID')
                    ->whereColumn('labs.vdate', '=', 'coulsellings.Counselling_Date')
                    ->select('coulsellings.*', 'labs.Req_Doctor')
                    ->with([
                        'ptconfig' => function ($query) {
                            $query->select('Pid', 'Name', 'Township', 'Date of Birth', 'Agey', 'Agem', 'Main Risk', 'Sub Risk');
                        },
                    ])
                    ->get();

                $encrypted_columns = ['Gender', 'Counsellor', 'Service_Modality', 'Mode of Entry', 'New_Old', 'Test_Location', 'Main Risk', 'Sub Risk', 'HIV_Test_Determine', 'HIV_Test_UNI', 'HIV_Test_STAT', 'HIV_Final_Result', 'Syphillis_RDT', 'Syphillis_RPR', 'Syphillis_VDRL', 'Hepatitis_B', 'Hepatitis_C', 'Req_Doctor'];
                $dates_hts = ['Counselling_Date', 'HIV_Test_Date', 'Syp_Test_Date', 'Hep_Test_Date'];

                foreach ($users1 as $key => $user1) {
                    if ($user1['ptconfig'] != null) {
                        $users1[$key] = Export_age::Export_general($user1['ptconfig'], $user1['Counselling_Date'], $user1['ptconfig']['Date of Birth'], $users1[$key]);
                        $users1[$key]['Main Risk'] = $user1['ptconfig']['Main Risk'];
                        $users1[$key]['Sub Risk'] = $user1['ptconfig']['Sub Risk'];
                    }

                    foreach ($dates_hts as $date) {
                        if ($user1[$date] != null && $user1[$date] != '') {
                            $carbonDate = Carbon::createFromFormat('Y-m-d', $user1[$date]);
                            $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
                            $users1[$key][$date] = Date::dateTimeToExcel($carbonDate->toDateTime());
                        }
                    }
                    foreach ($encrypted_columns as $encrypted) {
                        $users1[$key][$encrypted] = Crypt::decrypt_light($users1[$key][$encrypted], $table);
                        $users1[$key][$encrypted] = Crypt::codeBook($users1[$key][$encrypted], 'encode');
                    }
                }

                return Excel::download(new CounsellingExport($users1, $hts_coul), 'HTS Export-' . date('d-m-Y') . '.xlsx');
            }
        } else {
            return view('Counsellor.counselling');
        }
    }
}
