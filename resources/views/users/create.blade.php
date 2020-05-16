@extends("layouts.global")

@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection

@section("title") Create User @endsection
@section("content")
<div class="col-md-8">
    
@if(session('status'))
 <div class="alert alert-success">
 {{session('status')}}
 </div>
@endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.store')}}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input class="form-control" placeholder="Full Name" type="text" name="name" id="name" />
        <br>
        <label for="username">Username</label>
        <input class="form-control" placeholder="username" type="text" name="username" id="username" />
        <br>

        <label for="">Roles</label>
        <br>
        <input class="form-control {{$errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="roles[]" id="admin" value="admin">
        <label for="admin">Admin</label>
        <input class="form-control {{$errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="roles[]" id="owner" value="owner">
        <label for="owner">owner</label>
        <input class="form-control {{$errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="roles[]" id="kasir" value="kasir">
        <label for="kasir">kasir</label>
        <br>
        <br>
        
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control"></textarea>
        <br>
        <label for="image">Gambar</label>
        <br>
        <input id="image" name="avatar" type='file' class="form-control">
        <br>
        <label for="outlets">Outlets</label><br>
        <select name="outlets[]" multiple id="outlets" class="form-control"></select>
        <br><br/>
        <label for="email">Email</label>
        <input class="form-control" placeholder="user@mail.com" type="text" name="email" id="email" />
        <br>
        <label for="phone">No Telepon</label>
        <input class="form-control" placeholder="Masukkan Nomor" type="text" name="phone" id="phone" />
        <br>
        <label for="password">Password</label>
        <input class="form-control" placeholder="password" type="password" name="password" id="password" />
        <br>
        <label for="password_confirmation">Password Confirmation</label>
        <input class="form-control" placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation" />
        <br>
        <input class="btn btn-primary" type="submit" value="Save" />
    </form>
</div>
@endsection
