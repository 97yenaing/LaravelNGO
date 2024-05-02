@extends('layouts.app')
@section('content')
@auth

<body>
  <div class="container containers page-color">
    <form action={{ route('id_search') }} method="post">
      @csrf
      <div class="">
        <div class="row" style="justify-content: center">
          <div class="col-sm-2">
            <label for="serachID" class="form-label">Search ID</label>
            <input type="text" name="idInput" placeholder="General ID" id="searchID" class="form-control"
              value={{$Pid}}>
          </div>
          <div class="col-sm-2">
            <button class="btn btn-info" style="margin-top: 33px;height:50px">Search ID</button>
          </div>
          <div class="col-sm-1" style="display: none">
            <input type="text" id="notice" value="View Detail" name="notice">
          </div>
        </div>
      </div>
      @if($allCount!=null)
      <div id="all_countData">
        <table class="table">
          <thead>
            <tr>
              <th>Clinic Confidiential</th>
              <th>Server Confidiential</th>
              <th>Reception</th>
              <th>HIV</th>
              <th>RPR</th>
              <th>Lab STI</th>
              <th>Hep/bc</th>
              <th>Urine</th>
              <th>OI</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$allCount['PtConfig']}}</td>
              <td>{{$allCount['Patients']}}</td>
              <td>{{$allCount['Followup_general']}}</td>
              <td>{{$allCount['Lab']}}</td>
              <td>{{$allCount['Rprtest']}}</td>
              <td>{{$allCount['Labstitest']}}</td>
              <td>{{$allCount['LabHbcTest']}}</td>
              <td>{{$allCount['Urine']}}</td>
              <td>{{$allCount['Lab_oi']}}</td>
            </tr>
            <tr>

              <th>General</th>
              <th>Stool</th>
              <th>AFB</th>
              <th>Covid</th>
              <th>Viral Load</th>
              <th>Counselling Only</th>
              <th>HTS</th>
              <th>STI Male</th>
              <th>STI Female</th>
            </tr>
            <tr>
              <td>{{$allCount['LabGeneralTest']}}</td>
              <td>{{$allCount['LabStoolTest']}}</td>
              <td>{{$allCount['LabAfbTest']}}</td>
              <td>{{$allCount['LabCovidTest']}}</td>
              <td>{{$allCount['Viralload']}}</td>
              <td>{{$allCount['CounsellorRecords']}}</td>
              <td>{{$allCount['Coulselling']}}</td>
              <td>{{$allCount['Stimale']}}</td>
              <td>{{$allCount['Stifemale']}}</td>
            </tr>
            <tr>
              <td>Log Sheet</td>
              <td>CBS</td>
              <td>CMV</td>
              <td>Cervical Cancer</td>
              <td>NCD Register</td>
              <td>NCD Follow up</td>
              <td>TB 03</td>
              <td>Pre TB</td>
              <td>IPT</td>
            </tr>
            <tr>
              <td>{{$allCount['PreventionLogsheet']}}</td>
              <td>{{$allCount['PreventionCBS']}}</td>
              <td>{{$allCount['cmv']}}</td>
              <td>{{$allCount['Cervicalcancer']}}</td>
              <td>{{$allCount['ncd_pt_register']}}</td>
              <td>{{$allCount['ncdFollowup']}}</td>
              <td>{{$allCount['tb_registerO3']}}</td>
              <td>{{$allCount['preTB']}}</td>
              <td>{{$allCount['Tbipt']}}</td>
            </tr>
            <tr>
              <th>Comsumption</th>
            </tr>
            <tr>
              <td>{{$allCount['Consumption']}}</td>
            </tr>
          </tbody>

        </table>
      </div>

      @endif

    </form>
    @if($allCount!=null)
    <div class="row" style="justify-content: center">
      <div class="col-sm-2">
        <label for="" class="form-label">Delete or Marge</label>
        <select class="form-select" name="about" id="about" onchange="choice_type()">
          <option value="Delete">Delete</option>
          <option value="Marge">Marge</option>
        </select>
      </div>
      <div class="col-sm-2" style="display: none" id="marge_block">
        <label for="">Marge ID</label>
        <input type="text" placeholder="General ID" class="form-control" id="marge_id">
      </div>
      <div class="col-sm-2">
        <button class="btn btn-info" style="margin-top: 33px;height:50px" onclick="merge_delete()"
          id="mergeDelete">Delete</button>
      </div>
    </div>
    @endif


  </div>

</body>
@endauth
@endsection
<script type="text/javascript" language="javascript">
  function merge_delete(){
    let task=event.target.textContent;
    let marge_delete;
    if (confirm("Are you sure "+task+" this ID")) {
      if(task=="Marge"){
        if($("#marge_id").val()!=""){
          let notice="Marging"
          marge_delete={
            notice:notice,
            orgin_id:$("#searchID").val(),
            marge_id:$("#marge_id").val(),
          }
        }else{
          alert("Please fill Marge ID")
          return;
        }
        alert("Hello");
      }else if(task=="Delete"){
        notice="Delete all"
        marge_delete={
          notice:notice,
          orgin_id:$("#searchID").val(),
        }

      }
      console.log(marge_delete);
      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
      });
      $.ajax({
      type:'POST',
      url:"{{route('id_search')}}",
      dataType:'json',
      contentType: 'application/json',
      data: JSON.stringify(marge_delete),
      success:function(response){
        console.log(response);
      }
      })
    }
    
  }
  function choice_type(){
    let do_task=$("#about").val();
    console.log(do_task);
    if (do_task=="Delete") {
      $("#mergeDelete").text("Delete");
      $("#marge_block").hide();
      $("#marge_id").val("");
    } else {
      $("#mergeDelete").text("Marge");
      $("#marge_block").show();
    }
  }

</script>