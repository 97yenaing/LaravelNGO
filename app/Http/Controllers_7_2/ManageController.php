<?php
namespace App\Http\Controllers;
//namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageController extends Controller
{
  public function user(){
    return view ('Manage.users');
  }
  public function user_list(){
    $user = User::latest()->paginate(30);
    return view (
      'Manage.users_list',['user' => $user
    ]);

    return view ('Manage.users_list');
  }
  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(Request $data)
  {
      return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */
  public function add_user(Request $data){

    $user_id = $data ->input('user_id');
    $delete_signal = $data ->input('delete_id');
    $notFound= 11;

    if($user_id){
      if($delete_signal<1){
        $id_user = User::where('id',$user_id)->first();
        if($id_user){
          return response()->json([
            $id_user
          ]);
        }else{
          return response()->json([
            $notFound
          ]);

        }

      }

      if($user_id && $delete_signal==867){
        $ckDel = User::where('id','=',$user_id)->delete();
        if($ckDel){
          $deleteMessage = "deleted the user";
          return response()->json([
            $user_id,$deleteMessage
          ]);
        }

      }


    }else{
      User::create([
         'name' => $data['name'],
         'email' => $data['email'],
         'password' => Hash::make($data['password']),
         'clinic' => $data['clinic'],
         'type' => $data['type']
     ]);
     return view ('Manage.users');
    }



  }

}
