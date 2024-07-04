<?php
namespace App\Http\Controllers;
use App\Exports\dispensing\dispensingExport;
use App\Exports\dispensing\dispensing_Balance_Export;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Dispensing;
use App\Models\Followup_general;
use App\Models\Consumption;
use App\Models\MedicalitemsEntry;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DispensingController extends Controller
{
  public function dispense_view(){
    
    $items = Dispensing::all();
    $currentDate = Carbon::now()->format('Y-m-d');
    
    
    $todayConsumption = Consumption::where('Given_Date', $currentDate)->get();
    $origin_count = 0;

    foreach ($todayConsumption as &$consumption) { // Use reference (&) to modify the original array

        $origin_data = explode("-", $consumption["Medical_Data"]);
        $medicalDataString = [];

        for ($i = 0; $i < count($origin_data); $i++) {

            if ($i % 2 != 0) {
                $origin_list[$origin_count] = $origin_data[$i];
                $origin_count++;
                $origin_stock = Dispensing::select('Stock', 'Medic_item')->where('Sr_Num', '=', ($origin_data[$i]))->first();
                $medicalDataString[] = $origin_stock["Medic_item"] . ' (Qty) = ';
                $origin_count++;
            }
            if ($i % 2 == 0) {
                $medicalDataString[] = $origin_data[$i] . ' ; ';
            }
        }
        //$consumption["Medical_Data"] = $medicalDataString;
        $consumption["Medical_Data"] = implode('', $medicalDataString); // Convert the array to a string
    }
    return view (
      'Dispensing.dispensing',['items' => $items, 'todayConsumption'=> $todayConsumption
    ]);

  }
  

  public function dispense_viewReport(){
    $items = Dispensing::all();
    return view (
      'Dispensing.dispensingReport',['items' => $items
    ]);
  }
  public function dispensing_Control(Request $request){
    $table="General";
    $request_data=$request->all();
    $notice=$request->input('notice');
    if($notice==null){
      $notice=$request_data["generalInfo"]["notice"];
    }

    if($notice=="ptData"){
      $mid=$request->input('mid');
      $vdate=$request->input('vdate');
      
      $patientCofig=PtConfig::select('Name','Father','Pid','FuchiaID','Main Risk','PrEPCode','Clinic Code',"Gender")->where('Pid','=',$mid)
      ->orwhere(function ($query) use ($mid) {
           $query->Where('FuchiaID',$mid);
     })->first();

     if($patientCofig){
      $follow = Followup_general::select("Agey", "Agem","Visit Date")
                ->where('Pid', '=', $mid)->where("Visit Date",$vdate)
                ->orwhere(function ($query) use ($mid,$vdate) {
                  $query->Where('FuchiaID',$mid)->where("Visit Date",$vdate);
                })
                ->first();
    
      if($follow){
        $patientCofig["Gender"]=Crypt::decrypt_light($patientCofig["Gender"],$table);
        $patientCofig["Main Risk"]=Crypt::decrypt_light($patientCofig["Main Risk"],$table);
        $patientCofig["Name"]=Crypt::decryptString($patientCofig["Name"]);
        $patientCofig["Father"]=Crypt::decryptString($patientCofig["Father"]);
        $patientCofig["Agey"]=$follow["Agey"];
        $patientCofig["Agem"]=$follow["Agem"];
        $patientCofig["Visit Date"]=$follow["Visit Date"];

        
        return response()->json([
          $patientCofig
        ]);

      }else{
        return response()->json(
          "This Client don't pass reception"
          );
       }
     }else{
      return response()->json(
        "This Client don't register in clinic"
        );
     }

    }
    
    else if($notice=="comsumption_save"){
     $alredy_Give= Consumption::where('Pid','=',$request_data["generalInfo"]["Pid"])
                  ->where("Given_Date","=",$request_data["generalInfo"]["Given_Date"])->exists();
     $saveType=$request_data["generalInfo"]["saveType"];

      if(!$alredy_Give||$saveType!="Patient"){
        $medic_store='';$net_store=[];
        for ($i=1; $i <=count($request_data["save_medicdata"]) ; $i++) { 
         $medic_store=$medic_store.'-'.$request_data["save_medicdata"][$i];
         if($i%2==0){
          $consum_stock=(int)($request_data["save_medicdata"][$i]);
          $use_stock=$medic_stock-$consum_stock;
          if($use_stock >= 0){
            $net_store[$i-1]=$request_data["save_medicdata"][$i-1];
            $net_store[$i]=$use_stock;
          }else{
            return response()->json("Your Transation is wrong");
          }
         }else{
          $medic_stock_data = Dispensing::select('Stock')->where('Sr_Num','=',($request_data["save_medicdata"][$i]))->first();
          $medic_stock =(int)$medic_stock_data['Stock'];
         }
        }
        $sex=$request_data["generalInfo"]["Sex"];
        $risk=$request_data["generalInfo"]["Main_Risk"];
        if($medic_store!=null&&$medic_store!=''&& count($net_store)==count($request_data["save_medicdata"])){
          
          foreach ($net_store as $key => $value) {
            if($key%2==0){
              Dispensing::where('Sr_Num','=',$net_store[($key-1)])
              ->update([
                'Stock'=>$value,
              ]);
            }
          }
          Consumption::create([
            "Clinic Code"=>$request_data["generalInfo"]["Clinic_Code"],
            "Pid"=>$request_data["generalInfo"]["Pid"],
            "FuchiaID"=>$request_data["generalInfo"]["FuchiaID"],
            "PrEPCode"=>$request_data["generalInfo"]["PrEPCode"],
            "Sex"=>Crypt::encrypt_light($sex,$table),
            "Main Risk"=>Crypt::encrypt_light($risk,$table),
            "Agey"=>$request_data["generalInfo"]["Agey"],
            "Agem"=>$request_data["generalInfo"]["Agem"],
    
            "Nurse"=>$request_data["generalInfo"]["Nurse"],
            "Medical_Data"=>$medic_store,
            "Given_Date"=>$request_data["generalInfo"]["Given_Date"],
          ]);
        return response()->json([
          $medic_store,$medic_stock
        ]);
        }else{
        $block_user="Medicine is empty";
        return response()->json([
          $block_user,
        ]);
      }

      }else{
        $block_user="already_Given";
        return response()->json([
          $block_user,
        ]);
      }
     
    }
    else if($notice=="Stock_remaining"){
      $remain_Stock=Dispensing::select("Stock")->where('Sr_Num','=',($request_data["id"]))->first();
      return response()->json([
        $remain_Stock,
      ]);
    }
    else if($notice=="Stock_Add"){
      $instock=Dispensing::where('Sr_Num','=',$request_data["id"])->select("Stock")->first();
      if($instock["Stock"]!=null||$instock["Stock"]==0){
        $stock_update=Dispensing::where('Sr_Num','=',$request_data["id"])
        ->update([
        'Stock'=>$request_data["stockQty"]+(int)$instock["Stock"],
        ]);
        if ($stock_update) {
          $sir_num=$request_data["id"][0];
          MedicalitemsEntry::create([
          "Serial Number"=>$sir_num,
          "Exp_date"=>$request_data["exp_date"],
          "Amount"=>$request_data["stockQty"],
          "Arrival_Date"=>$request_data["arival_date"],
          ]);
          return response()->json([
          $stock_update
          ]);

        }

      };
      return response()->json([
        $instock
      ]);

    }
    else if($notice=="New Medic Add"){
      
      Dispensing::
      create([
        'Sr_Num'=>$request_data["idnumber"],
        'Stock'=>0,
        'Medic_item'=>$request_data["new_midic"],
        
      ]);
      $last_srNum = Dispensing::orderByDesc('Sr_Num')->pluck("Sr_Num")->first();
      $new_srNum = $last_srNum + 1;
      return response()->json([
       $new_srNum,
      ]);
    }
    else if($notice=="Update_FindConsumption"){
      $origin_list=[];
      $use_consum=Consumption::where("Pid","=",$request_data["upId"])->where("Given_Date","=",$request_data["upDate"])
      ->orWhere(function ($query) use ($request_data) {
          $query->where("FuchiaID", $request_data["upId"])
                 ->where("Given_Date", "=", $request_data["upDate"]);
      })->get();

      
        foreach ($use_consum as $key => $use_one_consum) {
          $origin_count=0;// for origin data
          $origin_data=explode("-",$use_one_consum["Medical_Data"]);
          for($i=1;$i<count($origin_data);$i++){
            if($i%2!=0){
              $origin_list[$key][$origin_count]=$origin_data[$i];
              $origin_count++;
              $origin_stock=Dispensing::select('Stock')->where('Sr_Num','=',($origin_data[$i]))->first();
              $origin_list[$key][$origin_count]=$origin_stock["Stock"];
              $origin_count++;
            }
          }
          $use_consum[$key]["createdAT"]=Carbon::parse($use_one_consum["created_at"])->format('H:i:s');;
        }
       
       
        return response()->json([
          $use_consum, $origin_list
        ]);
      
      
    }//Find the Existing Data to Update

    else if($notice=="comsumption_update"){
      $medic_store='';$j=0;$use_stock=[];$to_match=[];
      if(count($request_data["save_medicdata"])>1){
        $old_Stock=explode("-",$request_data["updated_originData"]);
        for ($i=1; $i <count($old_Stock) ; $i++) { 
          if($i%2==0){
            $medic_Oldstock_data = Dispensing::select('Stock')->where('Sr_Num','=',($old_Stock[$i-1]))->first();
            $medic_oldStock =$medic_Oldstock_data["Stock"];
            $oldStock_update=$medic_oldStock+(int)($old_Stock[$i]);
            $recent_stock[$i-1]=$old_Stock[$i-1];
            $update_medic_name[$i-1]=$old_Stock[$i-1];
            $recent_stock[$i]=$oldStock_update;
          }
        }
  
        for ($i=1; $i <=count($request_data["save_medicdata"]) ; $i++) {
          $medic_store=$medic_store.'-'.$request_data["save_medicdata"][$i];
          if($i%2==0){
            $key = array_search($request_data["save_medicdata"][$i-1],$update_medic_name);
            
            if($key!=false){
              $consum_stock=(int)($request_data["save_medicdata"][$i]);
             
              $use_stock[$i-1]=$old_Stock[$key];
              $to_match[$key]=$old_Stock[$key];
              $use_stock[$i]=(int)$recent_stock[$key+1]-$consum_stock;
            }else{
              $new_add=Dispensing::select('Stock')->where('Sr_Num','=',($request_data["save_medicdata"][$i-1]))->first();
              $use_stock[$i-1]=$request_data["save_medicdata"][$i-1];
              $use_stock[$i]=(int)$new_add["Stock"]-(int)$request_data["save_medicdata"][$i];
            }
  
          }
        }
        foreach ($update_medic_name as $key => $value) {
          $key_up = array_search($value,$to_match);
          if($key_up==false){
            array_push($use_stock,$value,$recent_stock[$key+1]);
          }
        }
        foreach ($use_stock as $key => $value) {
          if($key%2==0){
            Dispensing::where('Sr_Num','=',$use_stock[($key-1)])
            ->update([
              'Stock'=>$value,
            ]);
          }
        }
        
        $updateOK=Consumption::where('Pid','=',$request_data["generalInfo"]["Pid"])->where("Given_Date","=",$request_data["generalInfo"]["Given_Date"])
                ->where("id",$request_data["generalInfo"]["id"])
                ->update([
                  "Clinic Code"=>$request_data["generalInfo"]["Clinic_Code"],
                  "Nurse"=>$request_data["generalInfo"]["Nurse"],
                  "Medical_Data"=>$medic_store,
                ]);
        return response()->json([
          $updateOK
         ]);
      }else{
        return response()->json([
          "Medicine is empty"
        ]);
      }
      
    }

    else if($notice=="Report_data"){
      $dis_from=$request_data["dis_from"];
      $dis_to=$request_data["dis_to"];
      $rp_type=$request_data["rp_type"];
      $usemediOne=[];
      $recordmedic=[];
      if($rp_type=="All"){
        $consumption_amount = Consumption::select("Medical_Data", "Pid", "FuchiaID", "Given_Date", "Main Risk")
        ->whereBetween('Given_Date', [$dis_from, $dis_to])->get();
        
      }else if($rp_type=="only-patient"){
        $consumption_amount = Consumption::select("Medical_Data", "Pid", "FuchiaID", "Given_Date", "Main Risk")
        ->whereBetween('Given_Date', [$dis_from, $dis_to])
        ->where(function ($query) {
            $query->where('Pid', '>', 0); // Ensures Pid is a positive number
        })
        ->get();
      }else{
        $consumption_amount = Consumption::select("Medical_Data", "Pid", "FuchiaID", "Given_Date", "Main Risk")
        ->whereBetween('Given_Date', [$dis_from, $dis_to])->where("Pid",$rp_type)->get();
      }
      

      
      for($i=0;$i<count($consumption_amount);$i++){
        $cutmedi=explode("-",$consumption_amount[$i]["Medical_Data"]);
        if($i == 0){
          for($j=1;$j<count($cutmedi);$j++){

            if($j%2==0){
              $usemediOne[$cutmedi[$j-1]]=$cutmedi[$j];
              $recordmedic[$cutmedi[$j-1]][$i]["Pid"]=$consumption_amount[$i]["Pid"];
              $recordmedic[$cutmedi[$j-1]][$i]["FuchiaID"]=$consumption_amount[$i]["FuchiaID"];
              $recordmedic[$cutmedi[$j-1]][$i]["GivenDate"]=$consumption_amount[$i]["Given_Date"];
              $recordmedic[$cutmedi[$j-1]][$i]["Use"]=$cutmedi[$j];
              $recordmedic[$cutmedi[$j-1]][$i]["Main Risk"]=Crypt::decrypt_light($consumption_amount[$i]["Main Risk"],$table);
            }
          }
        }else {
          for($j=1;$j<count($cutmedi);$j++){
            if($j%2!=0){
              $recordmedic[$cutmedi[$j]][$i]["Pid"]=$consumption_amount[$i]["Pid"];
              $recordmedic[$cutmedi[$j]][$i]["FuchiaID"]=$consumption_amount[$i]["FuchiaID"];
              $recordmedic[$cutmedi[$j]][$i]["GivenDate"]=$consumption_amount[$i]["Given_Date"];
              $recordmedic[$cutmedi[$j]][$i]["Main Risk"]=Crypt::decrypt_light($consumption_amount[$i]["Main Risk"],$table);
              $recordmedic[$cutmedi[$j]][$i]["Use"]=$cutmedi[$j+1];
              if(array_key_exists($cutmedi[$j],$usemediOne)){
                $usemediOne[$cutmedi[$j]]+=(int)$cutmedi[$j+1];
              }else{
                $usemediOne[$cutmedi[$j]]=(int)$cutmedi[$j+1];
              }
            }
          }
        }
      }

      return response()->json([
        $usemediOne,$recordmedic
       ]);
    }

    else if($notice=="Medic AddEdit"){
      $idnumber=Dispensing::orderByDesc('Sr_Num')->pluck("Sr_Num")->first();
      $idnumber+=1;
      return response()->json([
        $idnumber,
       ]);

    }

    else if($notice=="consumption_data_view"){
      $givenDate_toshow=$request->input('givenDate');

   
      $todayConsumption = Consumption::where('Given_Date', $givenDate_toshow)->get();
      $origin_count = 0;

      foreach ($todayConsumption as &$consumption) { // Use reference (&) to modify the original array
          $origin_data = explode("-", $consumption["Medical_Data"]);
          $medicalDataString = [];
          for ($i = 0; $i < count($origin_data); $i++) {
              if ($i % 2 != 0) {
                  $origin_list[$origin_count] = $origin_data[$i];
                  $origin_count++;
                  $origin_stock = Dispensing::select('Stock', 'Medic_item')->where('Sr_Num', '=', ($origin_data[$i]))->first();
                  $medicalDataString[] = $origin_stock["Medic_item"] . ' (Qty) = ';
                  $origin_count++;
              }
              if ($i % 2 == 0) {
                  $medicalDataString[] = $origin_data[$i] . ';';
              }
          }
          //$consumption["Medical_Data"] = $medicalDataString;
          $consumption["Medical_Data"] = implode('', $medicalDataString); // Convert the array to a string
      }
      foreach ($todayConsumption as $key => $value) {
        $todayConsumption[$key]["Sex"]=Crypt::decrypt_light($value["Sex"],"General");
      }
      return response()->json([
        $todayConsumption
       ]);
    }

    else if($notice=="Find Entry medical item"){
      $entryDate_from=$request["entryDate_from"];
      $entryDate_to=$request["entryDate_to"];
      $entry_dataes=MedicalitemsEntry::whereBetween('Arrival_Date', [$entryDate_from, $entryDate_to])->get();
      foreach ($entry_dataes as $key => $entry_data) {
        $entry_dataes[$key]["Arrival_Date"]=date("d-m-Y",strtotime($entry_data["Arrival_Date"]));
      }


      return response()->json([
        $entry_dataes
      ]);
    }
    else if($notice=="Remove Row"){
      $oringinal_medicines=Consumption::select("Medical_Data")->where('id',$request["row_id"])->where("Given_Date",$request["give_date"])->first();
      $oringinal_medicines=explode("-",$oringinal_medicines["Medical_Data"]);
      for ($i=1; $i <count($oringinal_medicines) ; $i++) {
        if($i%2==0){
          $current_balance=Dispensing::select("Stock")->where("Sr_Num",$oringinal_medicines[$i-1])->first();
          $orgin_balance[$i-1]=$oringinal_medicines[$i-1];
          $orgin_balance[$i]=$current_balance["Stock"]+(int)$oringinal_medicines[$i];
        }
      } 
      if(count($orgin_balance)==(count($oringinal_medicines)-1)){
        foreach ($orgin_balance as $key => $value) {
          if($key%2==0){
            Dispensing::where('Sr_Num','=',$orgin_balance[($key-1)])
            ->update([
              'Stock'=>$value,
            ]);
            
          }
        }
        $fine_delete=Consumption::where('id',$request["row_id"])->where("Given_Date",$request["give_date"])->delete();
        return response()->json(
          $fine_delete
        ); 
      }else{
        return response()->json(
          "Wrong Credential"
        ); 
      }
     
    }
  }

  public function dispense_viewexport(){
    return view( 'Dispensing.dispensingExport');
  }

  public function dispensing_Export(Request $request)
  {   $table="General";
    $disForm = $request->input("dateFrom");
    $timestamp = strtotime($disForm);
    $disForm  = date('Y-m-d', $timestamp);

    $disTo=$request->input("dateTo");
    $timestamp = strtotime($disTo);
    $disTo  = date('Y-m-d', $timestamp);

    $choice_type=$request->input("dis_exp_type");

    $Dispensing = Dispensing::all();
    if($choice_type=="balance"){
      return Excel::download(new dispensing_Balance_Export($Dispensing), 'Balance_Export-'.date("d-m-Y").'-.xlsx');
    }else{
      $oringindata =Consumption::whereBetween('Given_Date', [$disForm, $disTo])->get();
      $oringindata = $oringindata->makeHidden(['created_at', 'updated_at']);
      
        foreach ($oringindata as $medicKey=>$item) {
          $medistring="";
          $oringindata[$medicKey]["Main Risk"] = Crypt::decrypt_light($item["Main Risk"], $table);
          $oringindata[$medicKey]["Sex"] = Crypt::decrypt_light($item["Sex"], $table);
          $medicalDetail=explode("-",$item["Medical_Data"]);
          for ($i = 1; $i < count($medicalDetail); $i++) {
            $medistring .= $Dispensing[$medicalDetail[$i]]["Medic_item"] . ";" . $medicalDetail[$i + 1] . ";";
            $i++;
          }
          $oringindata[$medicKey]["Medical_Data"]=$medistring; 
        }
      
  
        return Excel::download(new dispensingExport($oringindata), 'dispensingExport-'.date("d-m-Y").'-.xlsx');
    }
    
     //return response()->json([$oringindata,$medicalDetail]);
  }
}
