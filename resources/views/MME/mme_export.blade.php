<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@extends('layouts.app')

@section('content')
@auth

<body>
    <form action={{ route('mme_export') }} method="post">
        @csrf
        <div class="page-color containers container">
            <h1 class="header-text">M&E All Data Export</h1>
            <div class="row">
                <div class="col-sm-2">
                    <label for="" class="form-lable">Clinic</label>
                    <select name="clinic_road" id="" class="form-select">
                        <option value="0">HTY-A</option>
                        <option value="1">HTY-C1</option>
                        <option value="2">HTY-C2</option>
                        <option value="2">HTY-B</option>
                        <option value="3">SPT</option>
                        <option value="4">SDG</option>
                        <option value="5">TL</option>
                    </select>
                    @error('clinic_road')
                    <div class="alert alert-danger">Chosse Correct Clinic</div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">Export Type</label>
                    <select name="road" id="type_choice" class="form-select" onchange="complete_fun()">
                        <option value=""></option>
                        <option value="0">Reception</option>
                        <option value="1">Lab</option>
                        <option value="2">Counselling</option>
                        <option value="3">STI</option>
                        <option value="4">Prevention</option>
                        <option value="5">Cervical Cancer</option>
                        <option value="6">CMV</option>
                        <option value="7">NCD</option>
                        <option value="8">TB-03</option>
                        <option value="9">Pre TB</option>
                        <option value="10">IPT</option>
                    </select>
                    @error('road')
                    <div class="alert alert-danger">Please select export type</div>
                    @enderror
                </div>
                <div class="col-sm-2" id="other_block" style="display: none">
                    <label for="" class="form-label" id="other"></label>
                    <select name="other" id="other_type" class="form-select">
                    </select>

                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">From Date</label>
                    <div class="date-holder">
                        <input type="text" id="ddFrom" class="form-control Gdate" name="From_date"
                            placeholder="dd-mm-yyyy">
                        <img src="../img/calendar3.svg" class="dateimg" alt="date">
                    </div>
                    @error('From_date')
                    <div class="alert alert-danger">Please input date</div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">To Date</label>
                    <div class="date-holder">
                        <input type="text" id="ddTo" class="form-control Gdate" name="To_date" placeholder="dd-mm-yyyy">
                        <img src="../img/calendar3.svg" class="dateimg" alt="date">
                    </div>
                    @error('To_date')
                    <div class="alert alert-danger">Please input date</div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-info" style="margin-top: 35px">Export</button>
                </div>
            </div>
        </div>
    </form>

</body>
@endauth
@endsection

</html>
<script type="text/javascript">
    function complete_fun() {
        let type = $("#type_choice").val();
        let test, test_name;
        switch (type) {
            case "0": //Reception
            case "3": //Sti
                $("#other_block").hide();
                $("#other_type").empty();


                if (type == "3") {
                    $("#other_block").show();
                    $("#other").text("Gender");
                    test = ['Male', 'Female']
                    $("#other_type").empty();
                    test.forEach(function(value, index) {
                        var option = $("<option value='" + value + "'>" + value + "</option>");
                        $("#other_type").append(option);
                    });
                }
                break;
            case "1": //Lab
                $("#other_block").show();
                $("#other").text("Test Type");
                test = ['hiv', 'rpr', 'sti', 'hep_bc', 'urine', 'oi', 'general', 'stool', 'afb', 'covid19', 'viral'];
                test_name = ['HIV Test', 'RPR Test', 'STI Test', 'Hep B/C Test', 'Urine Test', 'OI Test',
                    'General Test', 'Stool Test', 'AFB Test', 'Covid Test', 'Viral Load Test'
                ]
                $("#other_type").empty();
                test.forEach(function(value, index) {
                    var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
                    $("#other_type").append(option);
                });
                break;
            case "2": //Counsellor
                $("#other_block").show();
                $("#other").text("Counselling Type");
                test = ["counsel_data", "hts_data"]
                test_name = ['Counselling', 'HTS']
                $("#other_type").empty();
                test.forEach(function(value, index) {
                    var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
                    $("#other_type").append(option);
                });
                break;
            case "4": //Prevention
                $("#other_block").show();
                $("#other").text("Export Type");
                test = ["log_sheet", "cbs",]
                test_name = ['Log Sheet', 'CBS',]
                $("#other_type").empty();
                test.forEach(function(value, index) {
                    var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
                    $("#other_type").append(option);
                });
                break;
            case "5": //Cervical Cancer

                $("#other_block").hide();
                $("#other_type").empty();

                break;
            case "6": //CMV

                $("#other_block").hide();
                $("#other_type").empty();

                break;
            case "7": //NCD
                $("#other_block").show();

                $("#other").text("NCD Export Type");
                test = ["Register", "Follow_Up"]
                test_name = ['NCD Register', 'NCD Follow up']
                $("#other_type").empty();
                test.forEach(function(value, index) {
                    var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
                    $("#other_type").append(option);
                });
                break;
            case "8": //TB03

                $("#other_block").hide();
                $("#other_type").empty();

                break;
            case "9": //Pre TB

                $("#other_block").hide();
                $("#other_type").empty();

                break;
            case "10": //TB IPT

                $("#other_block").hide();
                $("#other_type").empty();

                break;

            default:

                $("#other_block").hide();
                $("#other_type").empty();
                break;
        }
    }
</script>