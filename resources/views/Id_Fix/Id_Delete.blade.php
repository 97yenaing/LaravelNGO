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
            <input type="text" name="idInput" placeholder="General ID or Fuchia ID" class="form-control">
          </div>
          <div class="col-sm-2">
            <button class="btn btn-info" style="margin-top: 33px;height:50px">Search ID</button>
          </div>
          <div class="col-sm-1" style="display: none">
            <input type="text" id="notice" value="Delete all" name="notice">
          </div>
        </div>
      </div>
    </form>

  </div>

</body>
@endauth
@endsection