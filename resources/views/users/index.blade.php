@extends("layouts.global")
@section("title") U S E R  @endsection
@section("content")

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <form action="{{route('users.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text" placeholder="Filter berdasarkan user" />
                <div class="input-group-append">
                <input type="submit" value="Search" class="btn btn-dark">
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-6">
        <input {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}} value="ACTIVE" name="status" type="checkbox"
            class="form-control" id="active">
        <label for="active">Active</label>
        <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}} value="INACTIVE" name="status" type="checkbox"
            class="form-control" id="inactive">
        <label for="inactive">Unactive</label>
        <input type="submit" value="Filter" class="btn btn-primary">
    </div>    
</div>

<div class="row">
    <div class="col-md-5 text-left">
        <a href="{{route('users.create')}}" class="btn btn-info">User Baru</a>
    </div>
</div>
<br>


<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th><b>Name</b></th>
            <th><b>Username</b></th>
            <th><b>Role</b></th>
            <th><b>Outlet</b></th>
            <th><b>Alamat</b></th>
            <th><b>Email</b></th>
            <th><b>Image</b></th>
            <th><b>No Telepon</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->roles}}</td>
            <td>{{$user->outlet}}</td>
            <td>{{$user->address}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if($user->image)
                <img src="{{asset('storage/'.$user->image)}}" width="70px" />
                @else
                N/A
                @endif
            </td>
            <td>{{$user->phone}}</td>
        @endforeach
            <td>
                <a class="btn btn-primary text-white btn-sm" href="{{route('users.edit', [$user->id])}}">Ubah</a>
                <a href="{{route('users.show', [$user->id])}}" class="btn btn-success btn-sm">Detail</a>
                <form onsubmit="return confirm('Yakin akan menghapus user??')" class="d-inline"
                    action="{{route('users.destroy', [$user->id])}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        <tfoot>
            <tr>
                <td colspan=10>
                </td>
            </tr>
        </tfoot>
    </tbody>
</table>
@endsection
