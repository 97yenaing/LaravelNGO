@extends('layouts.app')

@section('content')
<div class="container containers admin-section">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <h2 class="header-text"> Announcements in the Clinic</h2>
            <table class="table table-bordered admin-userList">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Text</th>
                    <th>Date</th>
                    <th>Writer</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($text) && $text->count())
                    @foreach($text as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->Announce}}</td>
                            <td>{{ $value->created_at}}</td>
                            <td>{{$value->Writer}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There is no data.</td>
                    </tr>
                @endif
            </tbody>
          </table>
            {!! $text->links() !!}
          </div>
        </div>
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                  <div class="row annoounce-row">
                    <div class="col-md-6">
                        <textarea id="ann_text"  class="form-control admin-announce"  placeholder="Type Here" required  autofocus> </textarea>
                    </div>
                    <div class="col-md-3">
                        <button onclick="announce()" class="btn btn-primary announce-batton admin-annouceBatton ">Annoucements in Clinic</button>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6 ">
                        <input id="D_announceId" type="number" class="form-control"  placeholder="ID" required  autofocus>
                    </div>
                  <div class="col-md-3">
                      <button onclick="deleteAnnounce()" class="btn btn-warning delete-batton"  >Delete Announce</button>
                    </div>
                  </div>
                  <div class="row">
                    <div id="showUser">
                    </div>
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="text/javascript">
  function announce(){
    var ann_text = document.getElementById('ann_text').value;

    let data ={
      ann_text:ann_text,

    };
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
        $.ajax({
             type:'POST',
             url:"{{route('ann_add')}}",
             dataType:'json',
           //  processData:false,
             contentType:'application/json',
             data: JSON.stringify(data),
             success:function(response){
               console.log(response);
               alert("Text added to database.")
               location.reload(true);
             }
          });
  }
  function deleteAnnounce(){
    if (confirm("Do you want to delete  the text you have announced.?") == true) {
    var ann_text = document.getElementById('D_announceId').value;
    let delete_id = 999;
    let data ={
      ann_text:ann_text,
      delete_id:delete_id,
    };
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
        $.ajax({
             type:'POST',
             url:"{{route('ann_add')}}",
             dataType:'json',
           //  processData:false,
             contentType:'application/json',
             data: JSON.stringify(data),
             success:function(response){
              console.log(response);
              if(response[0]==11){
                alert("We didn't find the ID you given.");
              }else{
                alert("We deleted the text.");
              }
              location.reload(true);
             }

          });
        } else {

        }
  }
</script>
