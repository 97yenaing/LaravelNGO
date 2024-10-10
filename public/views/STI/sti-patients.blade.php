@extends('layouts.app')
  <link rel="stylesheet" href="">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@section('content')
@auth
<body>
  <div class="container">
        <h4>Lab HIV Test Results </h4>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patient's ID</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Latent Syphillis</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($sti_patients) && $sti_patients->count())
                @foreach($sti_patients as $key => $value)
                    <tr>
                        <td>{{ $value->CID}}</td>
                        <td>{{ $value->age }}</td>
                        <td>{{ $value->gender }}</td>
                        <td>{{ $value->latent_syphillis}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There is no data.</td>
                </tr>
            @endif
        </tbody>
      </table>

      {!! $sti_patients->links() !!}
    </div>
  </body>
@endauth
@endsection
