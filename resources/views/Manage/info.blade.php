@extends('layouts.app')
@auth
@section('content')
<div class="container pt-3">
    <div class="card">
            <br>
      <div class="">
        <h4> Annoucements in the Clinic. </h4><br>
        <table class="table table-borderless">
        <thead>
            <tr>
                <th>Text</th>
                <th>Date</th>
                <th>Writer</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($text) && $text->count())
                @foreach($text as $key => $value)
                    <tr>
                        <td>{{ $value->Announce}}</td>
                        <td>{{ $value->created_at}}</td>
                        <td>Team Leader</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There is no data.</td>
                </tr>
            @endif
        </tbody>
      </table>
      </div>
    </div>
</div>
@endauth
@endsection
