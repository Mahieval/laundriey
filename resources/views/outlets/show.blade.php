@extends('layouts.global')
@section('title') Detail outlet @endsection
@section('content')

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <b>Nama</b> <br/>
            {{$outlets->nama}}
            <br><br>
            <br>
            <b>Alamat</b><br>
            {{$outlets->alamat}}
            <br><br>
            <br>
            <b>No telepon</b> <br>
            {{$outlets->tlp}}
            <br><br>
            <br>
            <br>
        </div>
    </div>
</div>

@endsection
