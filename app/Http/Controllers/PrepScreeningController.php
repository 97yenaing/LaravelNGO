<?php

namespace App\Http\Controllers;

use App\Exports\Export_age;
use App\Models\prepScreen;
use App\Models\PtConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PrepScreeningController extends Controller
{
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

            default:
                # code...
                break;
        }
    }

    public function FindConfidential($request)
    {
        $confidential = PtConfig::where('Pid', $request['Pid'])->with([
            'prepScreen',
        ])->select('Date of Birth', 'Agey', 'Agem', 'FuchiaID', 'PrEPCode', 'Region', 'Name', 'Gender', 'Main Risk', 'Sub Risk', 'Pid', 'Phone', 'Phone2')->first();

        if ($confidential) {
            $largeEncry = [
                'Phone',
                'Phone2',
                'Region',
                'Name',
            ];
            $smallEncry = [
                'Main Risk',
                'Sub Risk',
                'Gender',
            ];
            $confidential = Export_age::Export_general($confidential, $request['regDate'], $confidential['Date of Birth'], $confidential);
            foreach ($largeEncry as $large) {
                $confidential[$large] = Crypt::DecryptString($confidential[$large]);
            }
            foreach ($smallEncry as $small) {
                $confidential[$small] = Crypt::decrypt_light($confidential[$small], "General");
            }
            return response()->json($confidential);
        } else {
            return response()->json(false);
        }
    }

    public function SavePrep($request)
    {
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
            'Consider_sex' => Crypt::encrypt_light($request['considerSex'], 'General'),
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
        ]);
        $phoneSave = PtConfig::where('Pid', $request["Pid"])->update([
            'Phone' => crypt::encryptString($request['phone1']),
            'Phone2' => crypt::encryptString($request['phone2']),
        ]);
        if ($savePrep) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
