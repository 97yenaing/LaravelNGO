@extends('layouts.app')

@section('content')
<div class="container containers">
    <div class="row justify-content-center admin-section">
        <div class="col-md-8 card ">
            <div>
                <div class="card-header header-text admin-register ">Add/Delete User</div>
                <!-- {{ __('Register') }} -->
                <div class="card-body" id="register-id">
                    <form method="POST" action="{{ route('add_user') }}">
                        @csrf
                        <div class="row mb-3">

                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 admin-section">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="username@C2" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-form-label text-md-end">Clinic's Name</label>
                            <div class="col-md-6">
                                <select  class="form-select" id="" name="clinic">
                                  <option value=""></option>
                                  <option value="1">MAM Office</option>
                                  <option value="71">HTY-A</option>
                                  <option value="72">HTY-B</option>
                                  <option value="73">SPT</option>
                                  <option value="75">Winka</option>
                                  <option value="76">TBZY</option>
                                  <option value="77">PTO-DT</option>
                                  <option value="78">PTO-MCB</option>
                                  <option value="80">Hpakant</option>
                                  <option value="81">HTY-C2</option>
                                  <option value="82">Taze</option>
                                  <option value="83">HTY-C1</option>
                                </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="" class="col-md-4 col-form-label text-md-end">Access Level</label>
                            <div class="col-md-6">
                                <select  id=""class="form-select" name="type">
                                  <option value=""></option>
                                  <option value="1">Receptionists/HE/Peer</option>
                                  <option value="2">Data Assistant</option>
                                  <option value="3">Lab Technician</option>
                                  <option value="4">Councellor</option>
                                  <option value="5">Clinic Doctor</option>
                                  <option value="6">Team Leader</option>
                                </select>
                            </div>
                          </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary save-batton">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                 <div class="row">
                    <div id="showUser">
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-md-6 search-row">
                        <input id="id" type="number" class="form-control"  placeholder="ID" required  autofocus>
                    </div>
                    <div class="col-md-3 ">
                        <button onclick="searchID()" class="btn btn-primary update-batton"  >Search User ID</button>
                    </div>
                    <div class="col-md-6 ">
                        <input id="D_id" type="number" class="form-control"  placeholder="ID" required  autofocus>
                    </div>
                    <div class="col-md-3">
                      <button onclick="deleteID()" class="btn btn-warning delete-batton"  >Delete User</button>
                    </div>
                    <div class="col-md-3">
                      <button onclick="register_form()" id="register_form" class="btn btn-warning announce-batton " disabled="true">Register Form</button>
                    </div>
                  </div>
                 

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="text/javascript">
  function searchID(){
    var user_id = document.getElementById('id').value;
    

    let data ={
      user_id:user_id,

    };
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
        $.ajax({
             type:'POST',
             url:"{{route('add_user')}}",
             dataType:'json',
           //  processData:false,
             contentType:'application/json',
             data: JSON.stringify(data),
             success:function(response){
               console.log(response);
               
               if(response[0]==11){
                 alert("We didn't find the ID you given.");
                 location.reload(true);
               }else{

               for (var i = 0; i < response.length; i++) {
                 if(response[0]['type']==1){
                   position = "Resceptionist/Peer";
                 }
                 if(response[0]['type']==2){
                   position = "Data Assistant";
                 }
                 if(response[0]['type']==3){
                   position = "MD";
                 }
                 if(response[0]['type']==4){
                   position = "Councellor";
                 }
                 if(response[0]['type']==5){
                   position = "Team Leader";
                 }
                 if(response[0]['type']==6){
                   position = "Manage";
                 }
                 $("#register-id").hide(1500);
               $("#register_form").prop('disabled', false);
               $("#showUser").show(1500);
               $('#showUser').empty();

                   var result_body = "<br>"+"<table class='table table-bordered'>"+
                       "<thead>"+
                           "<tr>" +"<td>"+"ID"+"</td>"+"<td>"+"User Name"+"</td>"+"<td>"+"Email"+"</td>"+"<td>"+"Position"+"<td>"+"</tr>"+
                       "</thead>"+
                       "<tbody>"+
                           "<tr>"+"<td>"+response[0]['id']+"</td>"+"<td>"+response[0]['name']+"</td>"+"<td>"+response[0]['email']+"</td>"+"<td>"+position+"</td>"+"</tr>"+
                     "</tbody>"+
                   "</table>" ;
                   $("#showUser").append(result_body);

               }
             }
             }

          });
  }
  function register_form(){
    $("#register-id").show(1500);
    $("#showUser").hide(1500);
    $("#register_form").prop('disabled', true);

    

  }
  function deleteID(){
    var user_id = document.getElementById('D_id').value;
    if(!user_id){
      alert("please fill user id")
    }else{
      if (confirm("Do you want to delete  the user account?") == true) {
    
    let delete_id = 867;
    let data ={
      user_id:user_id,
      delete_id:delete_id,
    };
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
        $.ajax({
             type:'POST',
             url:"{{route('add_user')}}",
             dataType:'json',
           //  processData:false,
             contentType:'application/json',
             data: JSON.stringify(data),
             success:function(response){
              console.log(response);
              if(response[0]==11){
                alert("We didn't find the ID you given.");
              }else{
                alert("We deleted the user.");
              }
             }

          });
        } 

      }
   
  }
</script>
