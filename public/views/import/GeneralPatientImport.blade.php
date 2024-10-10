@extends('layouts.app')
@section('content')
@auth
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Export Excel & CSV to Database in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        

        <form action="{{ route('general_import') }}" method="POST" enctype="multipart/form-data">
            @csrf
           
           
            <div class="row ">
					<div class="col-md-2">
                        <label for=""> Select </label>
                    </div>
					<div class="col-md-3 export-counHts">
						<select class="form-select"  name="table_name"required>
							<option selected  value="-" ></option>
							<option value="confid">Reception_confid</option>
							<option value="patient">Reception_patient</option>
                            
                            <option value="lab_hiv">Lab_hiv</option>
                            <option value="lab_rpr">Lab_rpr</option>
                            <option value="lab_sti">Lab_sti</option>
                            <option value="lab_hepBC">Lab_hepBC</option>
                            <option value="lab_urine">Lab_urine</option>
                            <option value="lab_oi">Lab_oi</option>
                            <option value="lab_genearal">Lab_general</option>
                            <option value="lab_stool">Lab_stool</option>
                            <option value="lab_afb">Lab_afb</option>
                            <option value="lab_covid">Lab_covid</option>
                            <option value="lab_viral_load">Lab_viral_load</option>

                            <option value="hts_service">hts_service</option>

                            <option value="sti_male">sti_male</option>
                            <option value="sti_female">sti_female</option>
                            
						</select>
					</div>
                    <div class="form-group mb-3" style="max-width: 500px; margin: 0 auto;">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose CSV file</label>
                        </div>
                    </div>
					<div class="col-md-1">
						<button   class="btn btn-primary ">Import</button>
					</div>
			</div>
        </form>

 </div>

</body>
</html>
@endauth
@endsection
