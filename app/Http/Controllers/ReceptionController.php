<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\Stimale;
use App\Models\Stifemale;
use App\Models\HtyANcdFollowup;
use App\Models\Followup_general;
use App\Models\PtConfig;
// use App\Http\AllRemove\Remove;
use App\Http\Auth\LoginController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Exports\Export_age;

use App\Exports\PatientsExport;

// Exports
use App\Exports\Reception\ReceptionExport;
use Illuminate\Database\Eloquent\Builder;
use DateTime;
use Illuminate\Support\Str;
class ReceptionController extends Controller
{
    public function patients()
    {
        // $patients = Patients::latest()->paginate(50);
        // return view (
        //   'Reception.patients',['patients' => $patients
        // ]);

        $patients = Followup_general::all();
        return view("Reception.patients", ["patients" => $patients]);
    }
    public function general_patients()
    {
        $patients_gt = Patients::latest()->paginate(50);
        return view("Reception.generalPatient", ["gt_patients" => $patients_gt]);
    }

    public function Reception_View()
    {
        $current_md_has = [];
        $mam_clinicID = Auth()->user()->clinic;
        $lastPt = PtConfig::where("Mode", "=", 0)
            ->where("Clinic Code", "=", $mam_clinicID)
            ->where("Pid", "like", $mam_clinicID . "%")

            ->orderBy("Pid", "desc")
            //->orderBy('Reg Date', 'desc')
            //->get();
            //->orderBy('id', 'desc')
            ->limit(1)
            ->get();
        $current_md = Followup_general::select("Current_MD")->where("Visit Date", date("Y-m-d"))->get();
        foreach ($current_md as $key => $value) {
            if ($value["Current_MD"] != null) {
                if (array_key_exists($value["Current_MD"], $current_md_has)) {
                    $current_md_has[$value["Current_MD"]] += 1;
                } else {
                    $current_md_has[$value["Current_MD"]] = 1;
                }
            }
        }

        ksort($current_md_has); //sorting the md;
        return view("Reception.Reception", ["lastPt" => $lastPt, "current_md" => $current_md_has]);
    }
    public function add_new_follow_up($request)
    {
        $gid = $request->input("gid");
        $vDate = $request->input("vdate");
        $fuchiaID = $request->input("fuchiaID");
        $ckID = $request->input("ckID");
        $pt_ID = $request->input("Pt_ID");
        $shar = $request->input("search_par");
    }

    public function reception_data(Request $request)
    {
        $functionLoco = $request->input("functionLoco");
        $notice = $request["notice"];
        $table = "General";
        switch ($functionLoco) {
            case 1:
                return $this->search_genID_existing($request);
                break;
            case 2:
                return $this->search_fuchia_eixsting($request);
                break;
            case 3:
                return $this->add_new_pt($request);
                break;
            case 4:
                return $this->add_follow_up($request);
                break;
            case 5:
                return $this->search_to_update($request);
                break;
            case 6:
                return $this->update_new_old_pt_data($request);
                break;
            case 7:
                return $this->search_genID_existing_return($request);
                break;
            case 8:
                return $this->search_fuchia_existing_return($request);
                break;
            case 9:
                return $this->save_next_diagnosis($request);
                break;
            case 10:
                return $this->nextappointment_list_show($request);
                break;
            case 11:
                return $this->show_followup_history($request);
                break;
            case 12:
                return $this->followup_update_filler($request);
                break;
            case 13:
                return $this->to_update_followup_data($request);
                break;

            default:
                // code...
                break;
        }
        if ($notice == "Predfine General Code") {
            $predefineQty = $request["preCount"];
            $originID = $request["stillID"];
            for ($i = 1; $i <= $predefineQty; $i++) {
                $addIDcode = $originID + $i;
                PtConfig::create([
                    "Pid" => $addIDcode,
                    "Clinic Code" => $request["clinic_code"],
                    "Mode" => 0,
                    "preCode" => 1,
                ]);
                Patients::create([
                    "Pid" => $addIDcode,
                    "Clinic Code" => $request["clinic_code"],
                    "Mode" => 0,
                    "preCode" => 1,
                ]);
            }
            return response()->json([$notice]);
        } elseif ($notice == "Find Patient List") {
            $Follow_Lists = Followup_general::select("Pid", "FuchiaID", "Gender", "Main Risk", "Next Appointment Date", "Pateint_Diagnosis")
                ->whereBetween("Visit Date", [$request["rec_show_findDate"], $request["rec_show_To"]])
                ->get();
            foreach ($Follow_Lists as $key => $Follow_List) {
                $Follow_Lists[$key]["Name"] = PtConfig::select("Name")
                    ->where("Pid", $Follow_List["Pid"])
                    ->first();
                $Follow_Lists[$key]["Name"] = Crypt::decryptString($Follow_Lists[$key]["Name"]["Name"]);
                $Follow_Lists[$key]["Gender"] = Crypt::decrypt_light($Follow_List["Gender"], $table);
                $Follow_Lists[$key]["Main Risk"] = Crypt::decrypt_light($Follow_List["Main Risk"], $table);
                if ($Follow_List["Pateint_Diagnosis"] != null && $Follow_List["Pateint_Diagnosis"] != "731") {
                    $find_diagnosis = explode("/", $Follow_List["Pateint_Diagnosis"]);
                    $prep_diagnosis = explode("-", $find_diagnosis[2]);
                    $Follow_Lists[$key]["prep"] = Crypt::decrypt_light($prep_diagnosis[1], $table);
                } else {
                    $Follow_Lists[$key]["prep"] = null;
                }
                if (isset($Follow_Lists[$key]["Next Appointment Date"])) {
                    $Follow_Lists[$key]["Next Appointment Date"] = date("d-m-Y", strtotime($Follow_List["Next Appointment Date"]));
                }
            }
            return response()->json($Follow_Lists);
        } elseif ($notice == "Remove Patient Follow_up") {
            // $rowDelete=new Remove();
            $DB = $request["pointer"];
            $id = $request["id"];
            $Pid = $request["Pid"];
            $remove_about = Followup_general::where("id", $id)->where("Pid", $Pid)->delete();

            return response()->json($remove_about);
        } elseif ($notice == "find next md") {
            $next_md_has = [];
            $next_md = Followup_general::select("Follow_up_md")
                ->where("Next Appointment Date", $request["next_app_date"])
                ->get();
            foreach ($next_md as $key => $value) {
                if ($value["Follow_up_md"] != null && $value["Follow_up_md"] != "-") {
                    if (array_key_exists($value["Follow_up_md"], $next_md_has)) {
                        $next_md_has[$value["Follow_up_md"]] += 1;
                    } else {
                        $next_md_has[$value["Follow_up_md"]] = 1;
                    }
                }
            }
            ksort($next_md_has);
            return response()->json($next_md_has);
        } elseif ($notice == "Serach By name") {
            $form_date = "20" . $request["serch_year"] . "-01-01";

            $to_date = "20" . $request["serch_year"] . "-12-31";
            $pt_list = PtConfig::select("Pid", "FuchiaID", "Name", "Father", "Agey", "Reg Date")
                ->whereBetween("Reg Date", [$form_date, $to_date])
                ->get();
            if ($pt_list) {
                foreach ($pt_list as $key => $value) {
                    $pt_list[$key]["Name"] = Crypt::decryptString($value["Name"]);
                    $pt_list[$key]["Father"] = Crypt::decryptString($value["Father"]);
                    $pt_list[$key]["Reg Date"] = date("d-m-Y", strtotime($value["Reg Date"]));
                }
            }
            return response()->json([$pt_list]);
        }
    }

    public function search_genID_existing($request)
    {
        //1
        $gid = $request->input("gid");
        $Fid = $request->input("Fid");
        $ckID = $request->input("ckID");
        $patientData = PtConfig::where("Pid", "=", $gid)
            ->orwhere(function ($query) use ($Fid) {
                if ($Fid !== null && $Fid !== "-") {
                    $query->Where("FuchiaID", $Fid);
                }
            })
            ->first();
        $table = "General";
        if ($patientData) {
            $gid = $patientData["Pid"];
        }

        if ($patientData != null) {
            if ($ckID == 1) {
                //to check the patient is in general patients list
                if ($patientData["preCode"] == 1) {
                    return response()->json([$patientData["Pid"], $patientData["preCode"]]);
                } else {
                    $followupData = Followup_general::where("Pid", "=", $gid)->latest("Visit Date")->first(); // Follow up  last
                    $ptNameDecrypt = $patientData["Name"];
                    $ptNameDecrypt = Crypt::decryptString($ptNameDecrypt);

                    $ptFather = $patientData["Father"];
                    $ptFather = Crypt::decryptString($ptFather);

                    $patientData["Main Risk"] = Crypt::decrypt_light($patientData["Main Risk"], $table);
                    $patientData["Sub Risk"] = Crypt::decrypt_light($patientData["Sub Risk"], $table);

                    $dob = $patientData["Date of Birth"];
                    $dob = Crypt::decryptString($dob);

                    $region = $patientData["Region"];
                    $region = Crypt::decryptString($region);

                    $town = $patientData["Township"];
                    $town = Crypt::decryptString($town);

                    $quarter = $patientData["Quarter"];
                    $quarter = Crypt::decryptString($quarter);

                    $table = "General";
                    $gender = $patientData["Gender"];
                    $gender = Crypt::decrypt_light($gender, $table);
                    if ($followupData != null) {
                        $height = Crypt::decrypt_light($followupData["Height"], $table);
                    } else {
                        $height = "";
                    }
                    return response()->json([$patientData, $ptNameDecrypt, $ptFather, $dob, $region, $town, $quarter, $followupData, $gender, $height, $patientData["Main Risk"]]);
                    $ckID = 0;
                }
            }
        } else {
            $err = null;
            return response()->json([$err]);
            $ckID = 0;
        }
    }
    public function search_fuchia_eixsting($request)
    {
        //2
        $gid = $request->input("gid");
        $fuID = $request->input("fuID");
        $fuchiaShar = $request->input("fuchiaShar");
        if ($fuchiaShar == 1) {
            $patientData_fu = PtConfig::where("FuchiaID", $fuID)->first();
            $followupData = Followup_general::where("Pid", "=", $gid)->latest()->first(); // Follow up  last

            if ($patientData_fu != null) {
                $ptNameDecrypt = $patientData_fu["Name"];
                $ptNameDecrypt = Crypt::decryptString($ptNameDecrypt);

                $ptFather = $patientData_fu["Father"];
                $ptFather = Crypt::decryptString($ptFather);

                $dob = $patientData_fu["Date of Birth"];
                $dob = Crypt::decryptString($dob);

                $region = $patientData_fu["Region"];
                $region = Crypt::decryptString($region);

                $town = $patientData_fu["Township"];
                $town = Crypt::decryptString($town);

                $quarter = $patientData_fu["Quarter"];
                $quarter = Crypt::decryptString($quarter);

                $phone = $patientData_fu["Phone"];
                $phone = Crypt::decryptString($phone);

                return response()->json([$patientData_fu, $ptNameDecrypt, $ptFather, $dob, $region, $town, $quarter, $phone, $followupData]);
                $fuchiaShar = 0;
            } else {
                $err = null;
                return response()->json([$err]);
                $fuchiaShar = 0;
            }
        }
    }
    public function add_new_pt($request)
    {
        // 3
        $gtReg = $request->input("gtReg");
        $gid = $request->input("gid");
        if ($gtReg == 1) {
            // Register
            $lastVisitData = PtConfig::where("Pid", "=", $gid)->get();

            $ptName = $request->input("name");
            $encrypted_Name = Crypt::encryptString($ptName);

            $fatherName = $request->input("father");
            $encrypted_Father = Crypt::encryptString($fatherName);

            $dob = $request->input("dobdate");
            $dob = Crypt::encryptString($dob);

            $region = $request->input("state");
            $region = Crypt::encryptString($region);

            $town = $request->input("tt");
            $town = Crypt::encryptString($town);

            $quarter = $request->input("quarter");
            $quarter = Crypt::encryptString($quarter);

            $phone = $request->input("phone");
            $phone = Crypt::encryptString($phone);

            $phone2 = $request->input("phone2");
            $phone2 = Crypt::encryptString($phone2);

            $phone3 = $request->input("phone3");
            $phone3 = Crypt::encryptString($phone3);

            $table = "General";
            $main_risk = $request->input("main_risk");
            $main_risk = Crypt::encrypt_light($main_risk, $table);

            $sub_risk = $request->input("sub_risk");
            $sub_risk = Crypt::encrypt_light($sub_risk, $table);

            $gender = $request->input("gender");
            $gender = Crypt::encrypt_light($gender, $table);

            $main_risk = $request->input("main_risk");
            $main_risk = Crypt::encrypt_light($main_risk, $table);

            $sub_risk = $request->input("sub_risk");
            $sub_risk = Crypt::encrypt_light($sub_risk, $table);

            $dask = 731;
            //$date_0= "0000-00-00";

            $pre_reg = $request->input("pre_register");

            Patients::create([
                "Clinic Code" => $request->clinic_code,
                "Pid" => $request->gid,
                "FuchiaID" => $request->fuchiaID,
                "PrEPCode" => $request->prepCode,
                "Agey" => $request->register_age,
                "Agem" => $request->register_agem,
                "Gender" => $gender,
                "Reg Date" => $request->register_date,
                "Date Of Birth" => $dob,

                "Main Risk" => $main_risk,
                "Sub Risk" => $sub_risk,
                "Mode" => $request->mode,
                "created_by" => $request->created_by,
            ]);
            if ($pre_reg == false) {
                Followup_general::create([
                    "Clinic Code" => $request->clinic_code,
                    "Pid" => $request->gid,
                    "Agey" => $request->agey,
                    "Agem" => $request->agem,
                    "Gender" => $gender,
                    "FuchiaID" => $request->fuchiaID,
                    "PrEPCode" => $request->prepCode,
                    "Visit Date" => $request->vdate,
                    "Main Risk" => $main_risk,
                    "Sub Risk" => $sub_risk,

                    "Patient Type" => $dask,
                    "New_Old" => $dask,
                    "Fever" => $dask,
                    "Diagnosis" => $dask,
                    "Support" => $dask,
                    "Weight" => Crypt::encrypt_light($request->input("weight"), $table),
                    "Height" => Crypt::encrypt_light($request->input("height"), $table),
                    "MUAC" => Crypt::encrypt_light($request->input("muac"), $table),
                    "Patient Type_1" => $dask,
                    "New_Old_1" => $dask,
                    "Fever_1" => $dask,
                    "Diagnosis_1" => $dask,
                    "Support_1" => $dask,
                    //"Next Appointment Date" => $date_0 ,
                    "Mode" => $request->mode,
                    "Unplan" => $request->unplan,
                    "Current_MD" => $request->current_md,
                    "Online" => $request->online,
                ]);
            }

            PtConfig::create([
                "Clinic Code" => $request->clinic_code,
                "Pid" => $request->gid,
                "FuchiaID" => $request->fuchiaID,
                "PrEPCode" => $request->prepCode,
                "Name" => $encrypted_Name,
                "Father" => $encrypted_Father,
                "Agey" => $request->register_age,
                "Agem" => $request->register_agem,
                "Gender" => $gender,
                "Reg Date" => $request->register_date,
                "Date Of Birth" => $dob,
                "Region" => $region,
                "Township" => $town,
                "Quarter" => $quarter,
                "Phone" => $phone,
                "Phone2" => $phone2,
                "Phone3" => $phone3,
                "Main Risk" => $main_risk, //from counselor
                "Sub Risk" => $sub_risk, //from counselor
                "Mode" => $request->mode,
                "created_by" => $request->created_by,
            ]);
            $gtReg = 0;
            $success = [["id" => 1, "name" => "Successfully collected"]];
            return response()->json([$success, $pre_reg]);
        } //Register
    }
    public function add_follow_up($request)
    {
        //4
        $gid = $request->input("gid");
        $ptFup = $request->input("ptFollowup");
        $vDate = $request->input("vdate");
        if ($ptFup == 1) {
            // follow up register
            $unplan = $request->input("unplan"); // is unplan visit

            $follow_exist = Followup_general::where("Pid", $gid)->where("Visit Date", $vDate)->exists();
            if ($follow_exist) {
                return response()->json([
                    true, //Dupicate input
                ]);
            } else {
                $dash = 731;
                $preCode = $request["preCode"];
                $dob = $request->input("dobdate");
                $dob = Crypt::encryptString($dob);

                $table = "General";

                $gender = $request->input("gender");
                $gender = Crypt::encrypt_light($gender, $table);

                $main_risk = $request->input("main_risk");
                $main_risk = Crypt::encrypt_light($main_risk, $table);

                $sub_risk = $request->input("sub_risk");
                $sub_risk = Crypt::encrypt_light($sub_risk, $table);

                $follow_generalPoint = Followup_general::where("Pid", $gid)->first();

                if ($follow_generalPoint != null) {
                    $followupData = Followup_general::where("Pid", "=", $gid)->latest()->first(); // Follow up  last
                    $lastFollowDate = $followupData["Next Appointment Date"];
                    Followup_general::where("Pid", $gid)
                        ->where("Next Appointment Date", $vDate)
                        ->update([
                            "Unplan" => 2, //plan come
                        ]);

                    $followupData = Followup_general::where("Pid", "=", $gid)->latest()->first(); // Follow up  last
                    $lastFollowDate = $followupData["Next Appointment Date"];
                    Followup_general::where("Pid", $gid)
                        ->where("Next Appointment Date", "!=", $vDate)
                        ->where("Unplan", 0)
                        ->update([
                            "Unplan" => 1, //Uplan come
                        ]);
                }
                Followup_general::create([
                    "Clinic Code" => $request->clinic_code,
                    "Pid" => $request->gid,
                    "FuchiaID" => $request->fuchiaID,
                    "PrEPCode" => $request->prepCode,
                    "Agey" => $request->agey,
                    "Agem" => $request->agem,
                    "Gender" => $gender,
                    "Visit Date" => $request->vdate,

                    "Weight" => Crypt::encrypt_light($request->input("weight"), $table),
                    "Height" => Crypt::encrypt_light($request->input("height"), $table),
                    "MUAC" => Crypt::encrypt_light($request->input("muac"), $table),

                    "Main Risk" => $main_risk,
                    "Sub Risk" => $sub_risk,

                    "Fever" => $dash,
                    "Diagnosis" => $dash,
                    "Pateint_Diagnosis" => $dash,
                    "Remark" => $request->remark,

                    "Unplan" => $request->unplan,
                    "created_by" => $request->created_by,
                    "Current_MD" => $request->current_md,
                    "Online" => $request->online,

                    "Mode" => $request->mode,
                ]);
                PtConfig::where("Pid", $request->gid)->update([
                    "Quarter" => Crypt::encryptString($request["quarter"]),
                ]);
                $config_risk_update = PtConfig::where("Pid", $request->gid)
                    ->where(function ($query) {
                        $query->orWhere("Main Risk", "731")->orWhere("Main Risk", null);
                    })
                    ->update([
                        "Main Risk" => $main_risk,
                        "Sub Risk" => $sub_risk,
                    ]);
                if ($config_risk_update) {
                    Patients::where("Pid", $request->gid)->update([
                        "Main Risk" => $main_risk,
                        "Sub Risk" => $sub_risk,
                    ]);
                }
                if ($preCode == 1) {
                    PtConfig::where("Pid", $request->gid)
                        ->where("preCode", 1)
                        ->update([
                            "Reg Date" => $request->register_date,
                            "FuchiaID" => $request->fuchiaID,
                            "PrEPCode" => $request->prepCode,
                            "Name" => Crypt::encryptString($request->input("name")),
                            "Father" => Crypt::encryptString($request->input("father_name")),
                            "Agey" => $request->register_age,
                            "Agem" => $request->register_agem,
                            "Gender" => $gender,
                            "Date of Birth" => $dob,
                            "Region" => Crypt::encryptString($request->input("state")),
                            "Township" => Crypt::encryptString($request->input("township")),
                            "phone" => Crypt::encryptString(""),
                            "phone2" => Crypt::encryptString(""),
                            "phone3" => Crypt::encryptString(""),
                            "Quarter" => Crypt::encryptString($request["quarter"]),
                            "Main Risk" => $main_risk,
                            "Sub Risk" => $sub_risk,
                            "preCode" => 0,
                        ]);
                    Patients::where("Pid", $request->gid)
                        ->where("preCode", 1)
                        ->update([
                            "FuchiaID" => $request->fuchiaID,
                            "PrEPCode" => $request->prepCode,
                            "Agey" => $request->register_age,
                            "Agem" => $request->register_agem,
                            "Gender" => $gender,
                            "Reg Date" => $request->register_date,
                            "Date Of Birth" => $dob,
                            "Main Risk" => $main_risk,
                            "Sub Risk" => $sub_risk,
                            "preCode" => 0,
                        ]);
                }

                $success = [["id" => 1, "name" => "Successfully collected"]];
                return response()->json([$success]);
            }
        }
    }
    public function search_to_update($request)
    {
        //5
        $pt_ID = $request->input("Pt_ID");
        $shar = $request->input("search_par");
        $table = "General";
        $encrypt_light = ["Main Risk", "Sub Risk", "Gender"];
        $encrypt = ["Name", "Father", "Date of Birth", "Region", "Township", "Quarter", "Phone"];
        if ($shar == 1) {
            // finding in General patients files

            $patientData = PtConfig::where("Pid", $pt_ID)->orWhere("FuchiaID", $pt_ID)->first();
            if ($patientData != null) {
                foreach ($encrypt_light as $column) {
                    $patientData[$column] = Crypt::decrypt_light($patientData[$column], $table);
                }
                $patientData = Export_age::Export_general($patientData, date("Y-m-d"), $patientData["Date of Birth"], $patientData);
                $patientData["current_age"] = $patientData["Current Agey"];
                $patientData["current_month"] = $patientData["Current Agem"];
                foreach ($encrypt as $column) {
                    $patientData[$column] = Crypt::decryptString($patientData[$column]);
                }

                return response()->json([$patientData]);
            }
        }
    }
    public function update_new_old_pt_data($request)
    {
        // 6
        $update = $request->input("update_reg");
        $genID = $request->input("generatedID");
        $genID1 = $request->input("generatedID1");
        $genIDarray = $request->input("genID");

        if ($update == 1) {
            $ptName = $request->input("name");
            $encrypted_Name = Crypt::encryptString($ptName);

            $fatherName = $request->input("father");
            $encrypted_Father = Crypt::encryptString($fatherName);

            $dob = $request->input("dobdate");
            $dob = Crypt::encryptString($dob);

            $region = $request->input("state");
            $region = Crypt::encryptString($region);

            $town = $request->input("tt");
            $town = Crypt::encryptString($town);

            $quarter = $request->input("quarter");
            $quarter = Crypt::encryptString($quarter);

            $phone = $request->input("phone");
            $phone = Crypt::encryptString($phone);

            $phone2 = $request->input("phone2");
            $phone2 = Crypt::encryptString($phone2);

            $phone3 = $request->input("phone3");
            $phone3 = Crypt::encryptString($phone3);

            $table = "General";
            $main_risk = $request->input("main_risk");
            $main_risk = Crypt::encrypt_light($main_risk, $table);

            $sub_risk = $request->input("sub_risk");
            $sub_risk = Crypt::encrypt_light($sub_risk, $table);

            $gender = $request->input("gender");
            $gender = Crypt::encrypt_light($gender, $table);
            $original_ID = $request->input("original_ID");

            // for ($i=0; $i < count($genIDarray); $i++) {
            //   Followup_general::where('id',$genIDarray[$i])
            //   ->update([
            //     'Clinic Code'=> $request->clinic_code ,
            //     'Pid'                => $request->gid,
            //     'Gender'             => $gender,
            //     'FuchiaID'           => $request->fuchiaID,
            //     'PrEPCode'           => $request->prepCode,

            //   ]);
            // }
            Patients::where("Pid", $original_ID)->update([
                "Clinic Code" => $request->clinic_code,
                "Pid" => $request->gid,
                "Agey" => $request->agey,
                "Agem" => $request->agem,
                "Gender" => $gender,
                "FuchiaID" => $request->fuchiaID,
                "PrEPCode" => $request->prepCode,
                "Reg Date" => $request->vdate,
                "Date Of Birth" => $dob,
                "updated_by" => $request->created_by,
            ]);
            PtConfig::where("Pid", $original_ID)->update([
                "Clinic Code" => $request->clinic_code,
                "Pid" => $request->gid,
                "FuchiaID" => $request->fuchiaID,
                "PrEPCode" => $request->prepCode,
                "Name" => $encrypted_Name,
                "Father" => $encrypted_Father,
                "Agey" => $request->agey,
                "Agem" => $request->agem,
                "Gender" => $gender,
                "Reg Date" => $request->vdate,
                "Date Of Birth" => $dob,
                "Region" => $region,
                "Township" => $town,
                "updated_by" => $request->created_by,
            ]);

            $success = [["id" => 1, "name" => "Successfully collected"]];
            return response()->json([$success]);
        } // to Update Data
    }
    public function search_genID_existing_return($request)
    {
        // 7
        $gid = $request->input("gid_return");
        $fid = $request->input("fid_return");
        $ckID = $request->input("ckID_return");
        $patientData = Followup_general::on("mysql")
            ->where("followup_generals.Pid", "=", $gid)
            ->orwhere(function ($query) use ($fid) {
                if ($fid !== null && $fid !== "-") {
                    $query->where("followup_generals.FuchiaID", $fid);
                }
            })
            ->join("confid.pt_configs", "followup_generals.Pid", "=", "pt_configs.Pid")
            ->select("pt_configs.Agey", "pt_configs.Agem", "pt_configs.Date of Birth", "followup_generals.*")
            ->latest("Visit Date")
            ->first();
        if ($patientData) {
            $patientData = Export_age::Export_general($patientData, $patientData["Visit Date"], $patientData["Date of Birth"], $patientData);
        }

        return response()->json([$patientData]);
    }
    public function save_next_diagnosis($request)
    {
        //9
        $table = "General";
        $gid = $request->input("gid");
        $next = $request->input("next");
        $fDate = $request->input("fvDate");
        $referFever = Crypt::encrypt_light($request->input("refer_fever"), $table);

        $diagnosis_data = ["phacheck", "artcheck", "prepcheck", "pmtctcheck", "anccheck", "fmaplancheck", "gneralcheck", "OPD", "ncdcheck", "hivTBcheck", "fcentercheck", "labInvestcheck", "pha_new_old", "pha_cohort", "prep_new_old", "anc_new_old", "art_new_old", "art_cohort", "pmtct_new_old", "famaplan_new_old", "general_new_old", "general_diagnosis", "feedcentre_new_old", "ncd_new_old", "ncd_diagnosis", "ncd_drugSupply", "hivTB_new_old", "labInvest_new_old"];

        for ($i = 0; $i < count($diagnosis_data); $i++) {
            $diagnosis_encrypt[$diagnosis_data[$i]] = Crypt::encrypt_light($request->input($diagnosis_data[$i]), $table);
        }
        $finalString =
            $diagnosis_encrypt["phacheck"] .
            "-" .
            $diagnosis_encrypt["pha_new_old"] .
            "-" .
            $diagnosis_encrypt["pha_cohort"] .
            "/" .
            $diagnosis_encrypt["artcheck"] .
            "-" .
            $diagnosis_encrypt["art_new_old"] .
            "-" .
            $diagnosis_encrypt["art_cohort"] .
            "/" .
            $diagnosis_encrypt["prepcheck"] .
            "-" .
            $diagnosis_encrypt["prep_new_old"] .
            "/" .
            $diagnosis_encrypt["pmtctcheck"] .
            "-" .
            $diagnosis_encrypt["pmtct_new_old"] .
            "/" .
            $diagnosis_encrypt["anccheck"] .
            "-" .
            $diagnosis_encrypt["anc_new_old"] .
            "/" .
            $diagnosis_encrypt["fmaplancheck"] .
            "-" .
            $diagnosis_encrypt["famaplan_new_old"] .
            "/" .
            $diagnosis_encrypt["gneralcheck"] .
            "-" .
            $diagnosis_encrypt["general_new_old"] .
            "-" .
            $diagnosis_encrypt["general_diagnosis"] .
            "-" .
            $diagnosis_encrypt["OPD"] .
            "/" .
            $diagnosis_encrypt["ncdcheck"] .
            "-" .
            $diagnosis_encrypt["ncd_new_old"] .
            "-" .
            $diagnosis_encrypt["ncd_diagnosis"] .
            "-" .
            $diagnosis_encrypt["ncd_drugSupply"] .
            "/" .
            $diagnosis_encrypt["hivTBcheck"] .
            "-" .
            $diagnosis_encrypt["hivTB_new_old"] .
            "/" .
            $diagnosis_encrypt["fcentercheck"] .
            "-" .
            $diagnosis_encrypt["feedcentre_new_old"] .
            "/" .
            $diagnosis_encrypt["labInvestcheck"] .
            "-" .
            $diagnosis_encrypt["labInvest_new_old"] .
            "/";
        //pha/art/prep/pmtct/anc/family planing/general/ncd/hivtb/feeding center/lab_Invest//

        if ($next && $gid) {
            Followup_general::where("Pid", $gid)
                ->where("Visit Date", "=", $fDate)
                ->update([
                    "Next Appointment Date" => $request->nDate,
                    "Pateint_Diagnosis" => $finalString,
                    "Fever" => $referFever,
                    "Follow_up_md" => $request->follow_up_md,
                ]);

            $success = [["id" => 1, "name" => "Successfully collected"]];
            return response()->json([$success, $finalString]);
        }
    }
    public function nextappointment_list_show($request)
    {
        //10
        $nDate = $request->input("ndate");
        $table = "General";
        $visit_type = $request->input("visit_type");
        $print_row = [];
        $show_resultNext = [];
        $show_resultNext2 = [];
        $count = 1;
        $next_data = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan", "Pateint_Diagnosis", "Patient Type")->where("Next Appointment Date", "=", $nDate)->get();
        if ($visit_type != "All" && $visit_type != null) {
            for ($p = 0; $p < count($next_data); $p++) {
                if ($next_data[$p]["Pateint_Diagnosis"] != null) {
                    $test_name = ["PHA", "ART", "PrEP", "PMTCT", "ANC", "Family planing", "General", "NCD", "hivtb", "FC", "lab_iv_only"];
                        $diagnosi_next = explode("/", $next_data[$p]["Pateint_Diagnosis"]);
                        for ($j = 0; $j < 11; $j++) {
                            $test_diagnosisType[$next_data[$p]["Pid"] . $test_name[$j]] = explode("-", $diagnosi_next[$j]);
                            $final_testType[$test_name[$j]] = Crypt::decrypt_light($test_diagnosisType[$next_data[$p]["Pid"] . $test_name[$j]][0], $table);
                        }
                        if ($final_testType[$visit_type] !=null) {
                            $print_row[$count] = $next_data[$p]["id"];
                            $count++;
                        }
                    
                    for ($print = 1; $print <= count($print_row); $print++) {
                        $show_resultNext[$print] = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("id", "=", $print_row[$print])
                            ->get();
                    }
                } else {
                    if ($nDate && $visit_type == "PHA") {
                        $show_resultNext2 = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("Next Appointment Date", "=", $nDate)
                            ->where("Patient Type", "=", "2423133") // PHA
                            ->orderBy("created_at", "asc")
                            ->get();
                    }
                    if ($nDate && $visit_type == "ART") {
                        $show_resultNext2 = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("Next Appointment Date", "=", $nDate)
                            ->where("Patient Type", "=", "1310453") //ART

                            ->orderBy("created_at", "asc")
                            ->get();
                    }
                    if ($nDate && $visit_type == "PrEP") {
                        $show_resultNext2 = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("Next Appointment Date", "=", $nDate)
                            ->where("Patient Type", "=", "249826244") //PrEP
                            ->orderBy("created_at", "asc")
                            ->get();
                    }

                    if ($nDate && $visit_type == "FC") {
                        $show_resultNext2 = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("Next Appointment Date", "=", $nDate)
                            ->where("Patient Type", "=", "25392") //FC
                            //    ->where(function($query) use ($num1, $num2) {
                            //     $query->where('Unplan', '=', $num2)
                            //           ->orWhere('Unplan', '=',$num1);
                            // })
                            ->orderBy("created_at", "asc")
                            ->get();
                    }
                    if ($nDate && $visit_type == "General") {
                        $show_resultNext2 = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("Next Appointment Date", "=", $nDate)
                            ->where("Patient Type", "=", "223268329859977") //General
                            //    ->where(function($query) use ($num1, $num2) {
                            //     $query->where('Unplan', '=', $num2)
                            //           ->orWhere('Unplan', '=',$num1);
                            // })
                            ->orderBy("created_at", "asc")
                            ->get();
                    }
                    if ($nDate && $visit_type == "PMTCT") {
                        $show_resultNext2 = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("Next Appointment Date", "=", $nDate)
                            ->where("Patient Type", "=", "24194539455") //PMTCT
                            //    ->where(function($query) use ($num1, $num2) {
                            //     $query->where('Unplan', '=', $num2)
                            //           ->orWhere('Unplan', '=',$num1);
                            // })
                            ->orderBy("created_at", "asc")
                            ->get();
                    }
                    if ($nDate && $visit_type == "ANC") {
                        $show_resultNext2 = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("Next Appointment Date", "=", $nDate)
                            ->where("Patient Type", "=", "1337393") //ANC
                            //    ->where(function($query) use ($num1, $num2) {
                            //     $query->where('Unplan', '=', $num2)
                            //           ->orWhere('Unplan', '=',$num1);
                            // })
                            ->orderBy("created_at", "asc")
                            ->get();
                    }
                    if ($nDate && $visit_type == "lab_iv_only") {
                        $show_resultNext2 = Followup_general::select("id", "Pid", "FuchiaID", "PrEPCode", "Next Appointment Date", "Unplan")
                            ->where("Next Appointment Date", "=", $nDate)
                            ->where("Patient Type", "=", "975930618682618968974011") //<15
                            //  ->where('Unplan','=',0)
                            ->orderBy("created_at", "asc")
                            ->get();
                    }
                }
            }
        } else {
            $show_resultNext2 = $next_data;
        }

        return response()->json([$show_resultNext, $show_resultNext2, $next_data]);
    }
    public function show_followup_history($request)
    {
        //11
        $gid = $request->input("gid");
        $fUp_data = $decrypted_sex = [];
        $ck_followUpHistory = $request->input("ck_followUpHistory");
        if ($ck_followUpHistory == 1) {
            $fUp_data = Followup_general::on("mysql")->where("followup_generals.Pid", "=", $gid)->orWhere("followup_generals.FuchiaID", $gid)->join("confid.pt_configs", "followup_generals.Pid", "=", "pt_configs.Pid")->select("pt_configs.Agey", "pt_configs.Agem", "pt_configs.Date of Birth", "followup_generals.*")->get();

            if ($fUp_data) {
                $table = "General";
                foreach ($fUp_data as $key => $value) {
                    $fUp_data[$key]["Gender"] = Crypt::decrypt_light($value["Gender"], $table);
                    $value = Export_age::Export_general($value, $value["Visit Date"], $value["Date of Birth"], $value);
                    $fUp_data[$key]["Visit Date"] = date("d-m-Y", strtotime($value["Visit Date"]));
                }
            }

            return response()->json([$fUp_data, $decrypted_sex]);
        }
    }
    public function followup_update_filler($request)
    {
        //12
        $ptID = $request->input("ptID");
        $diagnosis_final = [];
        $counting = 0;

        $rowID = $request->input("rowID");
        $diagnosis_dataonly = ["phacheck", "pha_new_old", "pha_cohort", "artcheck", "art_new_old", "art_cohort", "prepcheck", "prep_new_old", "pmtctcheck", "pmtct_new_old", "anccheck", "anc_new_old", "fmaplancheck", "famaplan_new_old", "gneralcheck", "general_new_old", "general_diagnosis", "OPD", "ncdcheck", "ncd_new_old", "ncd_diagnosis", "ncd_drugSupply", "hivTBcheck", "hivTB_new_old", "fcentercheck", "feedcentre_new_old", "labInvestcheck", "labInvest_new_old"];
        $toUpdateFollowup = $request->input("toUpdateFollowup");

        if ($toUpdateFollowup == 1) {
            $followupData = Followup_general::where("Pid", "=", $ptID)
                ->where("id", "=", $rowID)
                ->with([
                    "ptconfig" => function ($query) {
                        $query->select("Pid", "Agey", "Agem", "Gender", "Quarter", "Date of Birth"); // Select the specific columns from ptconfig
                    },
                ])
                ->get(); // Follow up  last4
            $followupData[0] = Export_age::Export_general($followupData[0]["ptconfig"], $followupData[0]["Visit Date"], $followupData[0]["ptconfig"]["Date of Birth"], $followupData[0]);

            $table = "General";
            $other_decrypt["Quarter"] = Crypt::DecryptString($followupData[0]["ptconfig"]["Quarter"]);
            $other_decrypt["gender"] = Crypt::decrypt_light($followupData[0]["ptconfig"]["Gender"], $table);
            $other_decrypt["muac"] = Crypt::decrypt_light($followupData[0]["MUAC"], $table);
            $other_decrypt["height"] = Crypt::decrypt_light($followupData[0]["Height"], $table);
            $other_decrypt["weight"] = Crypt::decrypt_light($followupData[0]["Weight"], $table);
            $other_decrypt["refer_fever"] = Crypt::decrypt_light($followupData[0]["Fever"], $table);

            $diagnosis_encrypt = $followupData[0]["Pateint_Diagnosis"];
            if ($diagnosis_encrypt != "" && strlen($diagnosis_encrypt) > 3) {
                $diagnosis_cut = explode("/", $diagnosis_encrypt); // spliting array return type is array

                for ($i = 0; $i < 11; $i++) {
                    $diagnosis_name = explode("-", $diagnosis_cut[$i]);

                    for ($j = 0; $j < count($diagnosis_name); $j++) {
                        $diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($diagnosis_name[$j], $table); //decrpting all diagnosis and adding new object array
                        if ($i == 6 && count($diagnosis_name) == 3 && $j == 2) {
                            $counting += 2;
                        } else {
                            $counting++;
                        }
                    }
                }
            }
            return response()->json([$followupData, $other_decrypt, $diagnosis_final]);
        }
    }
    public function to_update_followup_data($request)
    {
        //13
        $f_up_update = $request->input("f_up_update");
        $rowNumber = $request->input("rowNumber");
        $pid = $request->input("pid");

        if ($f_up_update == 1) {
            // updating followup row with next appointment date
            $table = "General";
            $gender = $request->input("gender");
            $gender = Crypt::encrypt_light($gender, $table);
            $height = Crypt::encrypt_light($request->input("height"), $table);
            $weight = Crypt::encrypt_light($request->input("weight"), $table);
            $muac = Crypt::encrypt_light($request->input("muac"), $table);

            $referFever = Crypt::encrypt_light($request->input("refer_fever"), $table);

            $diagnosis_data = ["phacheck", "artcheck", "prepcheck", "pmtctcheck", "anccheck", "fmaplancheck", "gneralcheck", "ncdcheck", "hivTBcheck", "fcentercheck", "labInvestcheck", "pha_new_old", "pha_cohort", "prep_new_old", "anc_new_old", "art_new_old", "art_cohort", "pmtct_new_old", "famaplan_new_old", "general_new_old", "general_diagnosis", "OPD", "feedcentre_new_old", "ncd_new_old", "ncd_diagnosis", "ncd_drugSupply", "hivTB_new_old", "labInvest_new_old"];

            for ($i = 0; $i < count($diagnosis_data); $i++) {
                $diagnosis_encrypt[$diagnosis_data[$i]] = Crypt::encrypt_light($request->input($diagnosis_data[$i]), $table);
            }
            $finalString =
                $diagnosis_encrypt["phacheck"] .
                "-" .
                $diagnosis_encrypt["pha_new_old"] .
                "-" .
                $diagnosis_encrypt["pha_cohort"] .
                "/" .
                $diagnosis_encrypt["artcheck"] .
                "-" .
                $diagnosis_encrypt["art_new_old"] .
                "-" .
                $diagnosis_encrypt["art_cohort"] .
                "/" .
                $diagnosis_encrypt["prepcheck"] .
                "-" .
                $diagnosis_encrypt["prep_new_old"] .
                "/" .
                $diagnosis_encrypt["pmtctcheck"] .
                "-" .
                $diagnosis_encrypt["pmtct_new_old"] .
                "/" .
                $diagnosis_encrypt["anccheck"] .
                "-" .
                $diagnosis_encrypt["anc_new_old"] .
                "/" .
                $diagnosis_encrypt["fmaplancheck"] .
                "-" .
                $diagnosis_encrypt["famaplan_new_old"] .
                "/" .
                $diagnosis_encrypt["gneralcheck"] .
                "-" .
                $diagnosis_encrypt["general_new_old"] .
                "-" .
                $diagnosis_encrypt["general_diagnosis"] .
                "-" .
                $diagnosis_encrypt["OPD"] .
                "/" .
                $diagnosis_encrypt["ncdcheck"] .
                "-" .
                $diagnosis_encrypt["ncd_new_old"] .
                "-" .
                $diagnosis_encrypt["ncd_diagnosis"] .
                "-" .
                $diagnosis_encrypt["ncd_drugSupply"] .
                "/" .
                $diagnosis_encrypt["hivTBcheck"] .
                "-" .
                $diagnosis_encrypt["hivTB_new_old"] .
                "/" .
                $diagnosis_encrypt["fcentercheck"] .
                "-" .
                $diagnosis_encrypt["feedcentre_new_old"] .
                "/" .
                $diagnosis_encrypt["labInvestcheck"] .
                "-" .
                $diagnosis_encrypt["labInvest_new_old"] .
                "/";
            //pha/art/prep/pmtct/anc/family planing/general/ncd/hivtb/feeding center/lab_Invest//

            Followup_general::where("id", "=", $rowNumber)
                ->where("Pid", "=", $pid)
                ->update([
                    "Agey" => $request->agey,
                    "Agem" => $request->agem,
                    "Gender" => $gender,
                    "FuchiaID" => $request->fid,
                    "PrEPCode" => $request->prepCode,
                    "Visit Date" => $request->vDate,
                    "Fever" => $referFever,
                    "Height" => $height,
                    "Weight" => $weight,
                    "MUAC" => $muac,
                    "Pateint_Diagnosis" => $finalString,
                    "Next Appointment Date" => $request->nDate,
                    "Follow_up_md" => $request->follow_up_md,
                    "Remark" => $request->remark,
                    "Current_MD" => $request->current_md,
                    "Online" => $request->online,
                ]);
            $success = "It's OK";
            return response()->json([$success]);
        }
    }

    // Export Section
    public function export(Request $data)
    {
        $from = $data->input("Datefrom");
        $date_from = DateTime::createFromFormat("d-m-Y", $from);
        $from = $date_from->format("Y-m-d");

        $to = $data->input("Dateto");
        $date_to = DateTime::createFromFormat("d-m-Y", $to);
        $to = $date_to->format("Y-m-d");

        $users = Followup_general::query()
            ->select("Gender", "Main Risk", "Sub Risk", "Patient Type", "New_Old", "Fever", "Diagnosis", "Support", "Patient Type_1", "New_Old_1", "Fever_1", "Diagnosis_1", "Support_1", "MUAC")
            ->whereBetween("Visit Date", [$from, $to])
            ->get();

        $users1 = Followup_general::with([
            "ptconfig" => function ($query) {
                $query->select("Pid", "Date of Birth", "Agey", "Agem", "Gender", "Main Risk", "Sub Risk"); // Select the specific columns from ptconfig
            },
        ])
            ->whereBetween("Visit Date", [$from, $to])
            ->get();
        // dd($users1[0]);

        $users2 = Followup_general::query()
            ->select("Pateint_Diagnosis")
            ->whereBetween("Visit Date", [$from, $to])
            ->get();

        $diagnosis_dataonly = [
            "phacheck",
            "pha_new_old",
            "pha_cohort", //0
            "artcheck",
            "art_new_old",
            "art_cohort", //1
            "prepcheck",
            "prep_new_old", //2
            "pmtctcheck",
            "pmtct_new_old", //3
            "anccheck",
            "anc_new_old", //4
            "fmaplancheck",
            "famaplan_new_old", //5
            "gneralcheck",
            "general_new_old",
            "general_diagnosis",
            "OPD", //6
            "ncdcheck",
            "ncd_new_old",
            "ncd_diagnosis",
            "ncd_drugSupply", //7
            "hivTBcheck",
            "hivTB_new_old", //8
            "fcentercheck",
            "feedcentre_new_old", //9
            "labInvestcheck",
            "labInvest_new_old", //10
        ]; // 27
        $diagnosisArray = [];
        if ($users2 != "") {
            for ($a = 0; $a < count($users2); $a++) {
                $counting = 0;

                // This condition is to filter blank diagnosis
                $diaString = $users2[$a]["Pateint_Diagnosis"];

                if ($diaString != "731" && $diaString != null) {
                    $diagnosis_cut = explode("/", $users2[$a]["Pateint_Diagnosis"]); // spliting array return type is array

                    for ($i = 0; $i < 11; $i++) {
                        $diagnosis_name = explode("-", $diagnosis_cut[$i]);
                        for ($j = 0; $j < count($diagnosis_name); $j++) {
                            if (Str::contains($diagnosis_name[$j], "\\")) {
                                $diagnosis_name[$j] = trim($diagnosis_name[$j], "\\");
                            }
                            if ($diagnosis_name[$j] == "731") {
                                $diagnosis_final[$diagnosis_dataonly[$counting]] = "";
                            } else {
                                $diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($diagnosis_name[$j], "General"); //decrpting all diagnosis and adding new object array
                            }

                            if ($counting == 21) {
                                if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "hivTBcheck") {
                                    $diagnosis_final[$diagnosis_dataonly[$counting]] = "hiv(Neg)-TBcheck";
                                } elseif ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
                                    $diagnosis_final[$diagnosis_dataonly[$counting]] == "";
                                }
                            }
                            if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
                                $diagnosis_final[$diagnosis_dataonly[$counting]] = "";
                            }
                            if ($i == 6 && count($diagnosis_name) == 3 && $j == 2) {
                                $counting += 2;
                            } else {
                                $counting++;
                            }
                        }
                        $diagnosisArray[$a] = $diagnosis_final;
                    }
                } else {
                    for ($i = 0; $i < count($diagnosis_dataonly); $i++) {
                        $diagnosisArray[$a][$diagnosis_dataonly[$i]] = "";
                    }
                }
            }

            $users2 = $diagnosisArray;
        }
        $Dates_excel = ["Next Appointment Date", "Visit Date"];

        foreach ($users1 as $user1_key => $user1) {
            if ($user1["ptconfig"] != null) {
                $users1[$user1_key] = Export_age::Export_general($users1[$user1_key]["ptconfig"], $user1["Visit Date"], $user1["ptconfig"]["Date of Birth"], $user1);
                $users1[$user1_key]["Main Risk"] = Crypt::decrypt_light($users1[$user1_key]["ptconfig"]["Main Risk"], "General");
                $users1[$user1_key]["Sub Risk"] = Crypt::decrypt_light($users1[$user1_key]["ptconfig"]["Sub Risk"], "General");
                $users1[$user1_key]["Sub Risk"] = Crypt::codeBook($users1[$user1_key]["Sub Risk"], "encode");
                $users1[$user1_key]["Main Risk"] = Crypt::codeBook($users1[$user1_key]["Main Risk"], "encode");
                $users1[$user1_key]["Gender"] = Crypt::decrypt_light($users1[$user1_key]["ptconfig"]["Gender"], "General");
            }

            foreach ($Dates_excel as $Date_excel) {
                if ($user1[$Date_excel] != null) {
                    $carbonDate = Carbon::createFromFormat("Y-m-d", $user1[$Date_excel]);
                    $carbonDate = Carbon::createFromFormat("d-m-Y", $carbonDate->format("d-m-Y"));
                    $users1[$user1_key][$Date_excel] = Date::dateTimeToExcel($carbonDate->toDateTime());
                }
            }
        }
        return Excel::download(new ReceptionExport($users, $users1, $users2), "FollowUP_Export-" . date("d-m-Y") . ".xlsx");
        // return response()->json([ $diagnosis_cut]);
    }
} // class End