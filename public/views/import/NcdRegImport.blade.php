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
            NCD Register OLD Data To Import
        </h2>

        <form action="{{ route('ncdimport') }}" method="POST" enctype="multipart/form-data">
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


    <h4 id='title'>NCD Patients List</h4>
        <div class="card-body" >

          <table class="table table-hover" >
            <thead>
                    <tr>
                      <th>Patient's ID</th>
                      <th>Age_ Visit</th>
                      <th>Township</th>
                    </tr>
              </thead>
              @foreach($users as $user)
                  <tbody>
                    <tr>
                      <td>  {{$user->pid}}  </td>
                      <td>	{{$user->Age}} </td>
                      <td>	{{$user->Township}}  </td>
                    </tr>
                  </tbody>
              @endforeach

      </table>
      </div>
    </div>

</body>

</html>
