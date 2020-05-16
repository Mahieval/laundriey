@extends('layouts.global')

@section('title')Edit Outlet @endsection

@section('content')

<div class="col-md-8">
    <form 
        action="{{route('outlets.update', [$outlets->id])}}"
        enctyoe="multipart/form-data"
        method="POST"
        class="bg-white shadow-sm p-3">

        @csrf
        <input 
            type="hidden"
            value="PUT"
            name="_method">  

        <label for="nama">Nama</label>
        <input 
            class="form-control"  
            type="text" 
            name="nama"
            value="{{$outlets->nama}}" />
        <br>

        <label for="alamat">Alamat</label>
        <input
            class="form-control" 
            type="text" 
            name="alamat" 
            value="{{$outlets->alamat}}">
        </input>
        <br>

        <label for="tlp">Nomor Telpon</label>
        <input 
            class="form-control"  
            type="text" 
            name="tlp"
            value="{{$outlets->tlp}}" />
        <br>

        <input class="btn btn-info" type="submit" value="Update" /> 
    </form>
</div>
@endsection