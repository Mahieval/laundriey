@extends('layouts.global')

@section('title') M E M B E R @endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <form action="{{route('members.index')}}">

            <div class="input-group">
                <input type="text" class="form-control" value="{{Request::get('filterKeyword')}}"
                    placeholder="Filter member name" name="filterKeyword" />

                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-dark" />
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
    <div class="col-md-10 text-left">
        <a href="{{route('members.create')}}" class="btn btn-info">Member Baru</a>
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
                    <th>Jenis Kelamin</th>
                    <th>No. Telpon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr>
                    <td>{{$member->nama}}</td>
                    <td>{{$member->alamat}}</td>
                    <td>
                        @if($member->jenis_kelamin == "P")
                        <p value="{{$member->jenis_kelamin}}">Wanita</p>

                        @else($member->jenis_kelamin == "L")
                        <p value="{{$member->jenis_kelamin}}">Pria</p>
                        @endif
                    </td>
                    <td>{{$member->no_telp}}</td>
                    <td>
                        <a href="{{route('members.edit', [$member->id])}}" class="btn btn-info btn-sm">Edit</a>
                        <form class="d-inline" action="{{route('members.destroy', [$member->id])}}" method="POST"
                            onsubmit="return confirm('Ingin menghapus Member?')">
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
                <td colspan=10>
                </td>
            </tr>
        </tfoot>
        </table>
    </div>
</div>
@endsection
