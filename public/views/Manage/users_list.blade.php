@extends('layouts.app')
  <link rel="stylesheet" href="">

@section('content')
@auth
<body>
  <div class="container containers admin-section">
        <h2 class="header-text" >Application Users</h2>
        <table class="table table-bordered admin-userList">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($user) && $user->count())
                @foreach($user as $key => $value)



                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name}}</td>
                        <td>{{ $value->email}}</td>
                        <td>
                            {{$post=$value->type}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
        </tbody>
      </table>
      

      {!! $user->links() !!}
    </div>
  </body>
@endauth
@endsection
