@extends('layouts.global')
@section('title') Edit User @endsection
@section('content')
<div class="col-md-8">

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.update', [$user->id])}}"
        method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Name</label>
        <input value="{{$user->name}}" class="form-control" placeholder="Full Name" type="text" name="name" id="name" />
        <br>

        <label for="username">Username</label>
        <input value="{{$user->username}}" disabled class="form-control" placeholder="username" type="text"
            name="username" id="username" />
        <br>
        <label for="">Roles</label>
        <br>
        <input type="checkbox" {{$user->roles == 'admin' ? 'checked' : ''}} class="{{$errors->first('roles') ? "is-invalid" : "" }}" name="roles[]"id="admin value="admin">
        <label for="admin">admin</label>
 
        <input type="checkbox" {{$user->roles == 'owner' ? 'checked' : ''}} class="{{$errors->first('roles') ? "is-invalid" : "" }}" name="roles[]"id="owner" value="owner">
        <label for="owner">Owner</label>
 
        <input type="checkbox" {{$user->roles == 'kasir' ? 'checked' : ''}} class="{{$errors->first('roles') ? "is-invalid" : "" }}" name="roles[]"id="kasir" value="kasir">
        <label for="kasir">kasir</label>
 
        <div class="invalid-feedback">
            {{$errors->first('roles')}}
        </div>
        <br>
        <br>
        <label for="phone">Phone number</label>
        <br>
        <input type="text" name="phone" class="form-control" value="{{$user->phone}}">
        <br>
        <label for="outlet">Outlet</label>
        <input value="{{$user->outlets}}" disabled class="form-control" placeholder="outlets" name="outlets" id="outlets" />
        <br>
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control">{{$user->address}}</textarea>
        <br>
        <label for="avatar">Avatar image</label>
        <br> 
        <br>
        @if($user->avatar)
        <img src="{{asset('storage/'.$user->avatar)}}" width="120px" />
        <br>
        @else
        No avatar
        @endif
        <br>
        <input id="avatar" name="avatar" type="file" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

        <hr class="my-3">

        <label for="email">Email</label>
        <input value="{{$user->email}}" disabled class="form-control" placeholder="user@mail.com" type="text"
            name="email" id="email" />
        <br>

        <input class="btn btn-primary" type="submit" value="Save" />
    </form>
</div>
@endsection
