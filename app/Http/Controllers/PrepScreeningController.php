<?php

namespace App\Http\Controllers;

use App\Exports\Export_age;
use App\Exports\PrepScreen\PrepScreenExport;
use App\Exports\RiskbackExcel\RefillRisk;
use App\Models\Patients;
use App\Models\prepScreen;
use App\Models\ptconfig;
use Carbon\Carbon;
use DateTime;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;

class PrepScreeningController extends Controller
{
    protected $largeEncry = [
        'Phone',
        'Phone2',
        'Region',
        'Name',
    ];
    protected $smallEncry = [
        'Main Risk',
        'Sub Risk',
        'Gender',
    ];
    protected $prepOnlyEncry = [
        'Birth_state',
        'Birth_township',
        'Test_result',
    ];

    public function PrepView()
    {
        return view("Prep.prepScreening");
    }

    public function PrepControl(Request $request)
    {

        switch ($request["notice"]) {
            case 'Search register':
                return $this->FindConfidential($request);
                break;
            case 'Save prep':
                return $this->SavePrep($request);
                break;
            case 'Search Update':
                return $this->SearchUpdate($request);
            case 'Update prep':
                return $this->UpdatePrep($request);
            case 'Export prep screen':
                $validator = Validator::make($request->all(), [
                    'FromDate' => 'required|date',
                    'ToDate' => 'required|date',
                ]); // Ensure it's an array with at least one item
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                return $this->ExportPrepScreen($request);
                break;


            default:
                abort(401);
                break;
        }
    }

    public function FindConfidential($request)
    {
        $confidential = ptconfig::where('Pid', $request['Pid'])->select('Date of Birth', 'Agey', 'Agem', 'FuchiaID', 'PrEPCode', 'Region', 'Name', 'Gender', 'Main Risk', 'Sub Risk', 'Pid', 'Phone', 'Phone2')->first();

        if ($confidential) {

            $confidential = Export_age::Export_general($confidential, $request['regDate'], $confidential['Date of Birth'], $confidential);
            foreach ($this->largeEncry as $large) {
                $confidential[$large] = Crypt::DecryptString($confidential[$large]);
            }
            foreach ($this->smallEncry as $small) {
                $confidential[$small] = Crypt::decrypt_light($confidential[$small], "General");
            }
            return response()->json($confidential);
        } else {
            return response()->json(false);
        }
    }

    public function SavePrep($request)
    {
        $confidential = ptconfig::where('Pid', $request['Pid'])->exists();
        if ($confidential) {
            $savePrep = prepScreen::create([
                'Pid' => $request['Pid'],
                'Inital_date' => $request['intialDate'],
                'DHIS2_id' => $request['dhis2'],
                'Sex_other' => $request['sexOther'],
                'Birth_state' => Crypt::encrypt_light($request['stateBirth'], 'General'),
                'Birth_township' => Crypt::encrypt_light($request['prepTown'], 'General'),
                'Facility_name' => $request['clinic'],
                'Virtual_KPSC' => $request['virtualKPSC'],
                'Nav_code' => $request['peerCode'],
                'Consider_sex' => $request['considerSex'],
                'Consider_other_sex' => $request['otherSexSpeci'],
                'Sex_with' => $request['sexWith'],
                'Sex_orgam_6month' => $request['exchangeSex'],
                'Drug_use_6month' => $request['drugUse'],
                'Sex_one_noCon' => $request['vAnalNoCon'],
                'Sex_oneMore_HIV' => $request['sexHIV'],
                'Sex_STI_transmit' => $request['sexSTI'],
                'PEP_expose' => $request['postPEP'],
                'Inject_equi_share' => $request['shareEquip'],
                'Sex_HIV_noTre' => $request['sexHIVNoTre'],
                'Prep_req' => $request['reqPrep'],
                'Risk_case_72H' => $request['riskPast72H'],
                'Symptoms_28D' => $request['coldFlu28D'],
                'Reason' => $request['expoHIVReason'],
                'HIV_neg' => $request['hivNeg'],
                'Test_date' => $request['testDate'],
                'Result_date' => $request['receiveDate'],
                'Test_result' => Crypt::encrypt_light($request['testResult'], 'General'),
                'Reative_date' => $request['reativeDate'],
                'Confirm_result' => $request['conResult'],
                'HIV_sub_risk' => $request['hivSubRisk'],
                'HIV_sup_infection' => $request['acuteHiv'],
                'Prep_eligible' => $request['prepEli'],
                'NO_necesary' => $request["dontNecessary"],
                'No_reason' => $request["noNecessaryReason"],
            ]);
            $phoneSave = ptconfig::where('Pid', $request["Pid"])->update([
                'Phone' => crypt::encryptString($request['phone1']),
                'Phone2' => crypt::encryptString($request['phone2']),
            ]);
            if ($savePrep) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }
    public function SearchUpdate(Request $request)
    {
        $generalId = $request->input('GeneralID');

        $searchResult = prepScreen::where('Pid', $generalId)->with('ptconfig')
            ->paginate(10);
        foreach ($searchResult as $key => $data) {

            foreach ($this->largeEncry as $large) {
                $data[$large] = Crypt::DecryptString($data['ptconfig'][$large]);
            }
            foreach ($this->smallEncry as $small) {
                $data[$small] = Crypt::decrypt_light($data['ptconfig'][$small], "General");
            }
            foreach ($this->prepOnlyEncry as $small) {
                $data[$small] = Crypt::decrypt_light($data[$small], "General");
            }

            $data = Export_age::Export_general($data['ptconfig'], $data['Inital_date'], $data['ptconfig']['Date of Birth'], $data);
            $data['Inital_date'] = Carbon::createFromFormat("Y-m-d", $data['Inital_date']);
            $data['Inital_date'] = $data['Inital_date']->format('d-m-Y');
        }



        return response()->json($searchResult); // Ensures JSON response
    }

    public function UpdatePrep($request)
    {
        $confidential = ptconfig::where('Pid', $request['Pid'])->exists();
        if ($confidential) {
            $prepUpdate = prepScreen::where('id', $request['updateID'])->where('Pid', $request['Pid'])->update([
                'Inital_date' => $request['intialDate'],
                'DHIS2_id' => $request['dhis2'],
                'Sex_other' => $request['sexOther'],
                'Birth_state' => Crypt::encrypt_light($request['stateBirth'], 'General'),
                'Birth_township' => Crypt::encrypt_light($request['prepTown'], 'General'),
                'Facility_name' => $request['clinic'],
                'Virtual_KPSC' => $request['virtualKPSC'],
                'Nav_code' => $request['peerCode'],
                'Consider_sex' => $request['considerSex'],
                'Consider_other_sex' => $request['otherSexSpeci'],
                'Sex_with' => $request['sexWith'],
                'Sex_orgam_6month' => $request['exchangeSex'],
                'Drug_use_6month' => $request['drugUse'],
                'Sex_one_noCon' => $request['vAnalNoCon'],
                'Sex_oneMore_HIV' => $request['sexHIV'],
                'Sex_STI_transmit' => $request['sexSTI'],
                'PEP_expose' => $request['postPEP'],
                'Inject_equi_share' => $request['shareEquip'],
                'Sex_HIV_noTre' => $request['sexHIVNoTre'],
                'Prep_req' => $request['reqPrep'],
                'Risk_case_72H' => $request['riskPast72H'],
                'Symptoms_28D' => $request['coldFlu28D'],
                'Reason' => $request['expoHIVReason'],
                'HIV_neg' => $request['hivNeg'],
                'Test_date' => $request['testDate'],
                'Result_date' => $request['receiveDate'],
                'Test_result' => Crypt::encrypt_light($request['testResult'], 'General'),
                'Reative_date' => $request['reativeDate'],
                'Confirm_result' => $request['conResult'],
                'HIV_sub_risk' => $request['hivSubRisk'],
                'HIV_sup_infection' => $request['acuteHiv'],
                'Prep_eligible' => $request['prepEli'],
                'NO_necesary' => $request["dontNecessary"],
                'No_reason' => $request["noNecessaryReason"],
            ]);
            if ($prepUpdate) {
                $phoneSave = ptconfig::where('Pid', $request["Pid"])->update([
                    'Phone' => crypt::encryptString($request['phone1']),
                    'Phone2' => crypt::encryptString($request['phone2']),
                ]);
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }

    public function DeleteScreen(Request $request)
    {
        $deleteScreen = prepScreen::where('id', $request['id'])->where('Pid', $request['GeneralID'])->delete();
        if ($deleteScreen) {
            DB::statement('SET @id := 0');
            DB::statement('UPDATE prep_screens SET id = @id := @id + 1');
            DB::statement('ALTER TABLE prep_screens AUTO_INCREMENT = 1');
            return response(true);
        }
    }

    public function ExportPrepScreen($request)
    {
        $request["FromDate"] = date("Y-m-d", strtotime($request["FromDate"]));
        $request["ToDate"] = date("Y-m-d", strtotime($request["ToDate"]));
        $final_log = []; //for RiskLog
        $final_risklog = []; //for RiskLog
        $prepExport = prepScreen::whereBetween('Inital_date', [$request["FromDate"], $request["ToDate"]])
            ->with([
                'ptconfig' => function ($query) {
                    $query->select("Pid", 'Date of Birth', 'Region', 'Name', 'Agey', 'Agem', "Main Risk", "Sub Risk", "Gender", "FuchiaID", "Risk Log", "Risk Change_Date", "Former Risk", "PrEPCode", "Phone", "Phone2");
                }
            ])->get();
        if ($prepExport) {
            $date_type = [
                'Inital_date',
                'Reative_date',
                'Test_date',
                'Result_date'
            ];
            foreach ($prepExport as $prepValue) {
                if ($prepValue['ptconfig']) {
                    $prepValue['Main Risk'] = $prepValue['ptconfig']["Main Risk"];
                    $prepValue['Sub Risk'] = $prepValue['ptconfig']["Sub Risk"];
                    $prepValue['FuchiaID'] = $prepValue['ptconfig']["FuchiaID"];
                    $prepValue['PrePCode'] = $prepValue['ptconfig']["PrEPCode"];
                    $prepValue['Gender'] = $prepValue['ptconfig']["Gender"];

                    $prepValue = Export_age::Export_general($prepValue['ptconfig'], $prepValue['Inital_date'], $prepValue['ptconfig']["Date of Birth"], $prepValue);
                    //Calculate Age

                    $carbonDate = Carbon::createFromFormat('Y-m-d', $prepValue['Inital_date']);
                    $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
                    $recordVdate = new DateTime($carbonDate); // change visit date to chenk with riskhistory

                    if ($prepValue["ptconfig"]["Risk Log"] != null) {
                        $forRiskCheck[1]['Pid'] = $prepValue['Pid'];
                        $forRiskCheck[1]['Risk Log'] = $prepValue["ptconfig"]['Risk Log'];
                        if (!array_key_exists($prepValue['Pid'], $final_log) && $prepValue["ptconfig"]['Risk Log'] != null) {
                            $final_risklog = RefillRisk::FillRisk($forRiskCheck);
                            $final_log[$prepValue['Pid']] = $final_risklog;
                        }
                        if (array_key_exists($prepValue['Pid'], $final_log)) {
                            foreach (array_reverse($final_log[$prepValue['Pid']][$prepValue['Pid']]) as $date => $data) {
                                if (strlen($date) == 10) {
                                    $riskChangeDate = new DateTime($date);
                                    if ($recordVdate < $riskChangeDate) {
                                        $prepValue['Main Risk'] = Crypt::encrypt_light($data['Old Risk'], 'General');
                                        $prepValue['Sub Risk'] = Crypt::encrypt_light($data['Old Sub Risk'], 'General');
                                    }
                                }
                            }
                        }
                    } elseif ($prepValue["ptconfig"]['Risk Change_Date'] != null && $prepValue["ptconfig"]['Former Risk'] != null && $prepValue["ptconfig"]['Former Risk'] != "731") {
                        $riskChangeDate = Carbon::createFromFormat('Y-m-d', $prepValue["ptconfig"]['Risk Change_Date']);
                        $riskChangeDate = new DateTime(Carbon::createFromFormat('d-m-Y', $riskChangeDate->format('d-m-Y')));
                        if ($recordVdate < $riskChangeDate) {
                            $prepValue['Main Risk'] = $prepValue["ptconfig"]['Former Risk'];
                            $prepValue['Sub Risk'] = '';
                        }
                    }

                    foreach ($this->largeEncry as $large) {
                        $prepValue[$large] = Crypt::DecryptString($prepValue['ptconfig'][$large]);
                    }
                    foreach ($this->smallEncry as $small) {
                        $prepValue[$small] = Crypt::decrypt_light($prepValue['ptconfig'][$small], "General");
                        if ($prepValue[$small] == "-") {
                            $prepValue[$small] = null;
                        }
                        $prepValue[$small] = Crypt::codeBook($prepValue[$small], "encode");
                    }
                }

                foreach ($this->prepOnlyEncry as $small) {
                    $prepValue[$small] = Crypt::decrypt_light($prepValue[$small], "General");
                    if ($prepValue[$small] == "-") {
                        $prepValue[$small] = null;
                    }
                    $prepValue[$small] = Crypt::codeBook($prepValue[$small], "encode");
                }

                foreach ($date_type as $column) {
                    $dateString = $prepValue[$column];
                    if (!empty($dateString)) {
                        $carbonDate = Carbon::createFromFormat("Y-m-d", $dateString);
                        $ddString = $carbonDate->format("d-m-Y");

                        $carbonDate = Carbon::createFromFormat("d-m-Y", $ddString); // Assuming you have a Carbon instance
                        $prepValue[$column] = SharedDate::dateTimeToExcel($carbonDate->startOfDay()); // Convert to Excel-compatible date
                    }
                }

                //Check the RiskHistory
            }
        }
        return Excel::download(new PrepScreenExport($prepExport), "Prep Screen Export-" . date("d-m-Y") . ".xlsx");
    }
}
