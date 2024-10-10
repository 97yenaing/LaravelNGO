@extends('layouts.app')
  <link rel="stylesheet" href="">


@section('content')
@auth
  <div class="container">
    <form action="{{ route('lab_export') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <br>
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-8">
        <h1>Export Lab Data to MS-Excel File</h1>
      </div>
    </div><br>
      <div class="row justify-content-center">
        <div class="col-sm-2"></div>


        <div class="col-sm-2">
          <label for="validationCustom02" class="form-label">Test Name</label>
          <div>
            <select  class="form-select" name="test" required >
              <option selected disabled value="">Choose....................</option>
              <option value="hiv">HIV Test</option>
              <option value="rpr">RPR Test</option>
              <option value="sti">STI Tests</option>
              <option value="hep">Hep B/C Test</option>
              <option value="urine">Urine Test</option>
              <option value="oi">OI Test</option>
              <option value="general">General Test</option>
              <option value="stool">Stool Tests</option>
              <option value="afb">AFB Test</option>
              <option value="covid">Covid Test</option>
            </select>
          </div>
        </div>
        <div class="col-sm-2">
          <label for="validationCustom02" class="form-label">Choose Year</label>
          <div>
            <select  class="form-select" name="year" required >
              <option selected disabled value="">Choose....................</option>
              <option value="2020">2018</option>
              <option value="2020">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
            </select>
          </div>
        </div>
        <div class="col-sm-2" style="padding-top:32px;">
          <button class="btn btn-dark" >Export</button>
        </div>
      </div><br>
      <div class="row">
        <div class="col-sm-4"></div>

      <!--  <div class="col-sm-2">
          <a class="btn btn-warning" href="{{ route('reception_export') }}">Follow Up File Export</a>
        </div> -->
      </div>
      <br>
      <div class="row">
        <div id="toshowHead"></div>
        <div id="toshow"></div>
      </div>
      <br>
    </form>
  </div>
@endauth
@endsection
<script type="text/javascript">

</script>
