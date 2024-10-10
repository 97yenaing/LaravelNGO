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
        <h2 class="mb-4">
           NCD follow up Import and Export CSV & Excel to Database
        </h2>

        <form action="{{ route('ncdfollowup') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import data</button>
            <a class="btn btn-success" href="{{ route('file-export') }}">Export data</a>
        </form>

    <h3>All Follow up Counts = {!! $patientcount !!}</h3>
        <div class="card-body" >

          <table class="table table-hover" >
            <thead>
                    <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>March</th>
                      <th>April</th>
                      <th>May</th>
                      <th>Jun</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sept</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                      <th>Total</th>
                    </tr>
              </thead>
                  @foreach($visitdates as $visitdate)
                  <tbody>
                    <tr>
                      <td>{{$visitdate}}</td>
                    </tr>
                  </tbody>
                  @endforeach
      </table>
      </div>
    </div>

</body>

</html>
