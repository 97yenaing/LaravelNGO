@extends('layouts.app')

@section('content')
@auth
<div id="Dispencing_export" class="tab-pane container containers page-color clearfix">
    <div class="header-text consum-header">
        <h2>Dispensing Export Section</h2>
    </div>
    <form action="{{ route('dis_export_link') }}" method="POST">
    @csrf
        <div class="row">
            <div class="col-sm-3">
              <label for="validationCustom01" class="form-label">From</label>
              <div class="date-holder">
                   <input type="text" id="Dis_fromDate" name="dateFrom" class="form-control Gdate" placeholder="dd-mm-yyyy">
                   <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01" class="form-label">To</label>
              <div class="date-holder">
                   <input type="text" id="Dis_ToDate" name="dateTo" class="form-control Gdate" placeholder="dd-mm-yyyy">
                   <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
                <label for="validationCustom01" class="form-label">Choice type</label>
                <select name="dis_exp_type" class="form-select">
                    <option value="consumption">Consumption</option>
                    <option value="balance">Balance</option>
                </select>
                
              </div>
            <div class="col-sm-2">
                <button class="btn btn-primary dis-exBtn">Export</button>
            </div>
        </div>
    </form>
    

</div>
<script type="text/javascript">
</script>
@endauth
@endsection
