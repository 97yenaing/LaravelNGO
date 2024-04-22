<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announce;

class AnnounceController extends Controller
{
  public function announcement(){
    $text = Announce::latest()->paginate(5);
    return view (
      'Manage.announcement',['text' => $text
    ]);

    return view ('Manage.announcement');
  }
  public function info(){
    $text = Announce::latest()->paginate(5);
    return view (
      'Manage.info',['text' => $text
    ]);

    return view ('Manage.announcement');
  }
  public function announcement_add(Request $data){
    $annText = $data -> input('ann_text');
    $delete_id = $data -> input('delete_id');
    if($delete_id){
        $deleteText = Announce::where('id','=',$annText)->delete();
        if($deleteText){
          $deleteMessage = "We deleted the text.";
          return response()->json([
            $annText,$deleteMessage
          ]);
        }else{
          $err=11;
          return response()->json([
            $err
          ]);
        }

    }else{
      Announce::create([
        'Announce' => $data -> ann_text ,
        //'Writer'   => $request -> fuchiaID  ,
        //'Date'     => $request -> cid ,
        //'Log'      => $request -> fuchiaID  ,
      ]);

      $success=[["id"=> 1,
      "name" => "Your data has been successfully collected."
      ]];
      return response()->json([$success]);
    }
    Announce::create([
      'Announce' => $data -> ann_text ,
      //'Writer'   => $request -> fuchiaID  ,
      //'Date'     => $request -> cid ,
      //'Log'      => $request -> fuchiaID  ,
    ]);

    $success=[["id"=> 1,
    "name" => "Your data has been successfully collected."
    ]];
    return response()->json([$success]);
  }



}
