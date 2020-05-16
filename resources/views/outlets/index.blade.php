@extends('layouts.global')

@section('title') O U T L E T @endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <form action="{{route('outlets.index')}}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Filter outlet"
                    value="{{Request::get('nama')}}" name="nama">

                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-dark">
                </div>
            </div>
        </form>
    </div>
</div>

<hr class="my-3">

@if(session('status'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-succsess">
            {{session('status')}}
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-12 text-left">
        <a href="{{route('outlets.create')}}" class="btn btn-info">Outlet Baru</a>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered table-stripped">
            <thead>
                <tr class="text-center">
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No.telpon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($outlets as $outlet)
                <tr>
                    <td>{{$outlet->nama}}</td>
                    <td>{{$outlet->alamat}}</td>
                    <td>{{$outlet->tlp}}</td>
                    <td>
                        <a href="{{route('outlets.edit', [$outlet->id])}}" class="btn btn-info btn-sm"> Edit </a>
                        <a href="{{route('outlets.show', [$outlet->id])}}" class="btn btn-success btn-sm">Detail</a>
                        <form class="d-inline" action="{{route('outlets.destroy', [$outlet->id])}}" method="POST"
                            onsubmit="return confirm('Anda yakin akan menghapusnya?')">

                            @csrf
                            <input type="hidden" value="DELETE" name="_method">
                            <input type="submit" class="btn btn-danger btn-sm" value="Hapus">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        {{$outlets->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
