@extends('layouts.app')
@section('content')
    @auth

        <body>
            <div class="container containers ">
                <form action={{ route('id_search') }} method="post" class=" container containers page-color">
                    @csrf
                    <h1 class="header-text">General ID FIX & Delete</h1>
                    <div class="" style="margin-bottom: 30px">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group mb4 idfix">
                                    <label for="serachID" class="form-label input-group-append"
                                        style="margin-top: 10px; font-size:18px; font-weight:700; margin-right:2%">Target
                                        ID</label>
                                    <input type="text" name="idInput" placeholder="General ID" id="searchID"
                                        class="form-control input-group-append" value="{{ $Pid ?? '' }}">


                                    <button class="btn btn-info input-group-append">Search ID</button>
                                </div>
                                @error('idInput')
                                    <div class="alert alert-danger">ID ဖြည့်သွင်းပါ</div>
                                @enderror
                            </div>


                            <div class="col-sm-2 radio-check">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="radioDelete"
                                            value="Delete" onclick="choice_type()">
                                        <label class="form-check-label idfixradio" for="radioDelete">
                                            Delete
                                        </label>
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="radioMarge"
                                            value="marge" onclick="choice_type()">
                                        <label class="form-check-label" for="radioMarge">
                                            Merge
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group mb3">
                                    <label for="serachID" class="form-label input-group-append"
                                        style="margin-top: 10px; font-size:18px; font-weight:700; margin-right:2%">FIX
                                        ID</label>
                                    <input type="text" placeholder="General ID" class="form-control" id="marge_id" disabled>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <li class="btn btn-info btn-danger" style="margin-top: 10px;" onclick="merge_delete()"
                                    id="mergeDelete">Delete</li>
                            </div>
                            <div class="col-sm-1" style="display: none">
                                <input type="text" id="notice" value="View Detail" name="notice">
                            </div>
                        </div>
                        <div class="row">
                            <h2 class="header-text">Database Select</h2>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="confidential">
                                    <label class="form-check-label" for="">
                                        pt_Confidential
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="2">
                                    <label class="form-check-label">
                                        Reception
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="3">
                                    <label class="form-check-label" for="">
                                        HIV Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="4">
                                    <label class="form-check-label" for="">
                                        Hep/BC Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="5">
                                    <label class="form-check-label" for="">
                                        Urine Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="6">
                                    <label class="form-check-label">
                                        Lab STI Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="7">
                                    <label class="form-check-label" for="">
                                        OI Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="8">
                                    <label class="form-check-label" for="">
                                        General Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="9">
                                    <label class="form-check-label" for="">
                                        Stool Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="10">
                                    <label class="form-check-label">
                                        AFB Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="11">
                                    <label class="form-check-label" for="">
                                        Covid Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="12">
                                    <label class="form-check-label" for="">
                                        Viral Load
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="13">
                                    <label class="form-check-label" for="">
                                        RPR Test
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="14">
                                    <label class="form-check-label">
                                        Counselling_Only
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="15">
                                    <label class="form-check-label" for="">
                                        HTS Register
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="16">
                                    <label class="form-check-label" for="">
                                        STI Female
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="17">
                                    <label class="form-check-label">
                                        STI Male
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="18">
                                    <label class="form-check-label" for="">
                                        Log Sheet
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="19">
                                    <label class="form-check-label" for="">
                                        CBS
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="20">
                                    <label class="form-check-label" for="">
                                        Cervicalcancer
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="21">
                                    <label class="form-check-label">
                                        CMV
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="22">
                                    <label class="form-check-label" for="">
                                        NCD Register
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="23">
                                    <label class="form-check-label" for="">
                                        NCD Follow UP
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="24">
                                    <label class="form-check-label" for="">
                                        TB O3
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="25">
                                    <label class="form-check-label">
                                        IPT
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="26">
                                    <label class="form-check-label" for="">
                                        Pre TB
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check idfix-check">
                                    <input class="form-check-input" type="checkbox" value="27">
                                    <label class="form-check-label" for="">
                                        Comsumption
                                    </label>
                                </div>
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

            </div>

        </body>
    @endauth
@endsection
<script type="text/javascript" language="javascript">
    console.log(@json($allCount));

    function merge_delete() {
        let task = event.target.textContent;
        let marge_delete = {};
        let warning_message;
        marge_delete["choice"] = [];
        console.log(task + "tasking");

        $(".idfix-check input[type='checkbox']").each(function(index) {
            if ($(this).is(":checked")) {
              if($(this).val()=="confidential"){
                marge_delete["choice"]=[0,1];
              }else{
                marge_delete["choice"].push($(this).val())
              }
                
            }
        })

        if (task == "Merge") {
            if ($("#marge_id").val() != "") {
                let notice = "Marging";
                warning_message = "Are you sure you want to Change this " + $("#searchID").val() + " to " + $(
                    "#marge_id").val();
                marge_delete["notice"] = notice
                marge_delete["orgin_id"] = $("#searchID").val();
                marge_delete["marge_id"] = $("#marge_id").val();
            } else {
                alert("Please fill Merge ID")
                return;
            }

        } else if (task == "Delete") {
            notice = "Delete all"
            warning_message = "Are you sure you want to Delete this " + $("#searchID").val();
            if (marge_delete["choice"].length != 0) {
                notice = "Choice Delete"
            }
            marge_delete["notice"] = notice
            marge_delete["orgin_id"] = $("#searchID").val();

        }
        console.log(marge_delete);
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
                    window.history.back();
                }
            })
        } else {
            window.history.back();
        }

    }

    function choice_type() {
        let do_task = $(event.target).val();
        console.log(do_task);
        if (do_task == "Delete") {
            $("#mergeDelete").text("Delete");
            $("#marge_id").val("").prop("disabled", true);
            $("#mergeDelete").addClass('btn-danger');
        } else {
            $("#mergeDelete").text("Merge");
            $("#marge_id").prop("disabled", false);
            $("#mergeDelete").removeClass('btn-danger');
        }
    }
</script>
