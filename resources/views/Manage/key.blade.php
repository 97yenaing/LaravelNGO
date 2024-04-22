@extends('layouts.app')

@section('content')
<div class="container containers">
    <div class="row justify-content-center admin-section">
        <div class="col-md-8 card ">
            <div>
                <div class="card-header header-text admin-register ">Key Generator and Translator</div>
            </div>
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                 <div class="row">
                    <div id="showUser">
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-md-6">
                      <label for=""> (-  /  ,  :  "  '  @  !  $  #  %  (  )  >  < ) These characters can be used.</label>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-md-6 search-row">
                        <input id="id" type="text" class="form-control"     autofocus>
                    </div>
                    <div class="col-md-3 ">
                        <button onclick="generate()" class="btn btn-primary update-batton"  >text</button>
                    </div>
                    <div class="col-md-6 ">
                        <input id="D_id" type="text" class="form-control" >
                    </div>
                    <div class="col-md-3">
                      <button onclick="translate_key()" class="btn btn-warning delete-batton"  >key</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="text/javascript">
  function generate(){
    var text = document.getElementById('id').value;
    var generate = 1;
    let data ={
      text:text,
      generate:generate,
    };
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
        $.ajax({
             type:'POST',
             url:"{{route('key')}}",
             dataType:'json',
           //  processData:false,
             contentType:'application/json',
             data: JSON.stringify(data),
             success:function(response){
               console.log(response);
               document.getElementById('D_id').value= response[0];
             }
          });
  }
  function translate_key(){

    var text = document.getElementById('D_id').value;
    var translate = 1;
    let data ={
      text:text,
      translate:translate,
    };

    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
        $.ajax({
             type:'POST',
             url:"{{route('key')}}",
             dataType:'json',
           //  processData:false,
             contentType:'application/json',
             data: JSON.stringify(data),
             success:function(response){
               console.log(response);
               document.getElementById('id').value= response[0];
             }
          });


  }
</script>
