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
            <input type="text" name="idInput" placeholder="General ID" id="searchID" class="form-control" value={{ $Pid
              }}>
            @error('idInput')
            <div class="alert alert-danger">ID ဖြည့်သွင်းပါ</div>
            @enderror
          </div>

          <div class="col-sm-2">
            <button class="btn btn-info" style="margin-top: 33px;height:50px">Search ID</button>
          </div>
          <div class="col-sm-1" style="display: none">
            <input type="text" id="notice" value="View Detail" name="notice">
          </div>
        </div>
      </div>
      @if ($allCount != null)
      <div id="all_countData">
        <table class="table" style="display:inline;margin-right:3%">
          <thead>
            <tr>
              <th>NO.</th>
              <th>Database</th>
              <th>Data</th>
            </tr>

          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Clinic Confidiential</td>
              <td>{{ $allCount['PtConfig'] }}</td>

            </tr>
            <tr>
              <td>2</td>
              <td>Server Confidiential</td>
              <td>{{ $allCount['Patients'] }}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Reception</td>
              <td>{{ $allCount['Followup_general'] }}</td>
            </tr>
            <tr>
              <td>4</td>
              <td>HIV</td>
              <td>{{ $allCount['Lab'] }}</td>
            </tr>
            <tr>
              <td>5</td>
              <td>RPR</td>
              <td>{{ $allCount['Rprtest'] }}</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Lab STI</td>
              <td>{{ $allCount['Labstitest'] }}</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Hep/bc</td>
              <td>{{ $allCount['LabHbcTest'] }}</td>
            </tr>
            <tr>
              <td>8</td>
              <td>Urine</td>
              <td>{{ $allCount['Urine'] }}</td>
            </tr>
            <tr>
              <td>9</td>
              <td>OI</td>
              <td>{{ $allCount['Lab_oi'] }}</td>
            </tr>
          </tbody>
        </table>
        <table class="table" style="display:inline;margin-right:3%">
          <thead>
            <tr>
              <th>NO.</th>
              <th>Database</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>10</td>
              <td>General</td>
              <td>{{ $allCount['LabGeneralTest'] }}</td>
            </tr>
            <tr>
              <td>11</td>
              <td>Stool</td>
              <td>{{ $allCount['LabStoolTest'] }}</td>
            </tr>
            <tr>
              <td>12</td>
              <td>AFB</td>
              <td>{{ $allCount['LabAfbTest'] }}</td>
            </tr>
            <tr>
              <td>13</td>
              <td>Covid</td>
              <td>{{ $allCount['LabCovidTest'] }}</td>
            </tr>
            <tr>
              <td>14</td>
              <td>Viral Load</td>
              <td>{{ $allCount['Viralload'] }}</td>
            </tr>
            <tr>
              <td>15</td>
              <td>Counselling Only</td>
              <td>{{ $allCount['CounsellorRecords'] }}</td>
            </tr>
            <tr>
              <td>16</td>
              <td>HTS</td>
              <td>{{ $allCount['Coulselling'] }}</td>
            </tr>
            <tr>
              <td>17</td>
              <td>STI Male</td>
              <td>{{ $allCount['Stimale'] }}</td>
            </tr>
            <tr>
              <td>18</td>
              <td>STI Female</td>
              <td>{{ $allCount['Stifemale'] }}</td>
            </tr>
          </tbody>
        </table>
        <table class="table" style="display:inline;margin-right:3%">
          <thead>
            <tr>
              <th>NO.</th>
              <th>Database</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>19</td>
              <td>Log Sheet</td>
              <td>{{ $allCount['PreventionLogsheet'] }}</td>
            </tr>
            <tr>
              <td>20</td>
              <td>CBS</td>
              <td>{{ $allCount['PreventionCBS'] }}</td>
            </tr>
            <tr>
              <td>21</td>
              <td>CMV</td>
              <td>{{ $allCount['cmv'] }}</td>
            </tr>
            <tr>
              <td>22</td>
              <td>Cervical Cancer</td>
              <td>{{ $allCount['Cervicalcancer'] }}</td>
            </tr>
            <tr>
              <td>23</td>
              <td>NCD Register</td>
              <td>{{ $allCount['ncd_pt_register'] }}</td>
            </tr>
            <tr>
              <td>24</td>
              <td>NCD Follow up</td>
              <td>{{ $allCount['ncdFollowup'] }}</td>
            </tr>
            <tr>
              <td>25</td>
              <td>TB 03</td>
              <td>{{ $allCount['tb_registerO3'] }}</td>
            </tr>
            <tr>
              <td>26</td>
              <td>Pre TB</td>
              <td>{{ $allCount['preTB'] }}</td>
            </tr>
            <tr>
              <td>27</td>
              <td>IPT</td>
              <td>{{ $allCount['Tbipt'] }}</td>
            </tr>

          </tbody>
        </table>
        <table class="table" style="display:inline;">
          <thead>
            <tr>
              <th>NO.</th>
              <th>Database</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>28</td>
              <td>Comsumption</td>
              <td>{{ $allCount['Consumption'] }}</td>
            </tr>
          </tbody>
        </table>

      </div>
      @endif

    </form>
    @if ($allCount != null)
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
        <button class="btn btn-info btn-danger" style="margin-top: 33px;height:50px" onclick="merge_delete()"
          id="mergeDelete">Delete</button>
      </div>
    </div>
    @endif


  </div>

</body>
@endauth
@endsection
<script type="text/javascript" language="javascript">
  console.log(@json($allCount));

  function merge_delete() {
    let task = event.target.textContent;
    let marge_delete;
    let warning_message;

    if (task == "Marge") {
      if ($("#marge_id").val() != "") {
        let notice = "Marging"
        warning_message="Are you sure you want to Change this "+$("#searchID").val()+" to "+$("#marge_id").val(); 
        marge_delete = {
          notice: notice,
          orgin_id: $("#searchID").val(),
          marge_id: $("#marge_id").val(),
        }
      } else {
        alert("Please fill Marge ID")
        return;
      }

    } else if (task == "Delete") {
      notice = "Delete all"
      warning_message="Are you sure you want to Delete this "+$("#searchID").val();
      marge_delete = {
        notice: notice,
        orgin_id: $("#searchID").val(),
      }

    }
    
    if (confirm(warning_message)) {
      console.log(marge_delete);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('id_search') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(marge_delete),
        success: function(response) {
          console.log(response);
          alert(response);
          location.reload();
        }
      })
    }

  }

  function choice_type() {
    let do_task = $("#about").val();
    console.log(do_task);
    if (do_task == "Delete") {
      $("#mergeDelete").text("Delete");
      $("#marge_block").hide();
      $("#marge_id").val("");
      $("#mergeDelete").addClass('btn-danger');
    } else {
      $("#mergeDelete").text("Marge");
      $("#marge_block").show();
      $("#mergeDelete").removeClass('btn-danger');
    }
  }
</script>