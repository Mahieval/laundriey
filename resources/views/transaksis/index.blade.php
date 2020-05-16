@extends("layouts.global")
@section("title") T R A N S A K S I @endsection
@section("content")

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <form action="{{route('transaksis.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text" placeholder="Filter berdasarkan Transaksi" />
                <div class="input-group-append">
                <input type="submit" value="Search" class="btn btn-dark">
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-6">
        <input {{Request::get('status') == 'baru' ? 'checked' : ''}} value="baru" name="status" type="radio"
            class="form-control" id="baru">
        <label for="active">Baru</label>
        <input {{Request::get('status') == 'proses' ? 'checked' : ''}} value="proses" name="status" type="radio"
            class="form-control" id="proses">
        <label for="inactive">Proses</label>
        <input {{Request::get('status') == 'selesai' ? 'checked' : ''}} value="selesai" name="status" type="radio"
            class="form-control" id="selesai">
        <label for="inactive">Selesai</label>
        <input {{Request::get('status') == 'diambil' ? 'checked' : ''}} value="diambil" name="status" type="radio"
            class="form-control" id="diambil">
        <label for="inactive">Diambil</label>
        <input type="submit" value="Filter" class="btn btn-primary">
    </div>  
</div>

<div class="row">
    <div class="col-md-10 text-left">
        <a href="{{route('transaksis.create')}}" class="btn btn-info">Transaksi baru</a>
    </div>
</div>
<br>


<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th><b>Outlet</b></th>
            <th><b>Member</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Batas waktu</b></th>
            <th><b>Tanggal Bayar</b></th>
            <th><b>Diskon</b></th>
            <th><b>Pajak</b></th>
            <th><b>Status</b></th>
            <th><b>Dibayar</b></th>

        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $transaksis)
        <tr>
            <td>{{$user->outlet}}</td>
            <td>{{$user->member}}</td>
            <td>{{$user->tanggal}}</td>
            <td>{{$user->batas_waktu}}</td>
            <td>{{$user->tanggal_bayar}}</td>
            <td>{{$user->diskon}}</td>
            <td>{{$user->pajak}}</td>
            <td>
            @if($user->status == "baru")
            <span class="badge badge-success">
            {{$user->status}}
            </span>
            
            ($user->status == "proses")
            <span class="badge badge-danger">
            {{$user->status}}
            </span>
            
            ($user->status == "selesai")
            <span class="badge badge-success">
            {{$user->status}}
            </span>

            ($user->status == "diambil")
            <span class="badge badge-success">
            {{$user->status}}
            </span>
            @endif
            </td>
            <td>{{$user->dibayar}}</td>

            <td>
                <a class="btn btn-primary text-white btn-sm" href="{{route('transaksi.edit', [$transaksis->id])}}">Ubah</a>
                <a href="{{route('transaksi.show', [$transaksis->id])}}" class="btn btn-primary btn-sm">Detail</a>
                <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                    action="{{route('transaksi.destroy', [$transaksis->id])}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @endforeach
        <tfoot>
            <tr>
                <td colspan=10>
                    {{$transaksis->links()}}
                </td>
            </tr>
        </tfoot>
    </tbody>
</table>
@endsection
