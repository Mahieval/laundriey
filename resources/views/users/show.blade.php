@extends('layouts.global')
@section('title') Detail user @endsection
@section('content')

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <b>Name:</b> <br />
            {{$users->name}}
            <br><br>
            <br>
            <b>Username:</b><br>
            {{$users->email}}
            <br>
            <br>
            <b>Role</b> <br>
            {{$users->roles}}
            <br><br>
            <b>Phone number</b> <br>
            {{$users->phone}}
            <br><br>
            <b>Address</b> <br>
            {{$users->address}}
            <br>
            <br>
            <b>Roles:</b> <br>
            {{$users->roles}}
            <br>
            <br>
            @if($users->avatar)
            <img src="{{asset('storage/'. $users->avatar)}}" width="128px" />
            @else
            No avatar
            @endif
            <br>
            <br>
        </div>
    </div>
</div>

@endsection
