@extends("layouts.global")
@section("title") Create Paket @endsection
@section("content")
<div class="col-md-8">
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('pakets.store')}}" method="POST">
        @csrf
        <label for="nama">Nama</label>
        <input class="form-control" placeholder="Nama Paket" type="text" name="nama_paket" id="nama_paket" />
        <br>

        <label for="outlets">Outlet</label>
        <input type="outlets"  id="outlets" name="outlets" class="form-control"></select>
        <br>

        <label for="jenis">Jenis Paket</label><br>
            <select name="jenis" id="jenis" class="form-control">
                <option value="">pilih...</option>
                <option value="selimut">Selimut</option>
                <option value="bed_cover">Bed Cover</option>
                <option value="kaos">Kaos</option>
                <option value="lain-lain">lain lain</option>
            </select>
            <br>
            <label for="harga">Harga</label><br>
                <input type="number" id="harga" name="harga" class="form-control">
            <br><br>
        <input class="btn btn-primary" type="submit" value="Save" />
    </form>
</div>
@endsection
@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#outlets').select2({
        ajax: {
            url: '/ajax/outlets/search',
            processResults: function (data) {
                return{
                    results: data.map(function (item) {
                        return{
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            }
        }
    });
</script>
@endsection