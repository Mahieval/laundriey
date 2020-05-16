@extends("layouts.global")
@section("title") Create transaksi @endsection
@section("content")
<div class="col-md-8">

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" 
    action="{{route('transaksis.store')}}" method="POST">
        @csrf
        <input 
            type="hidden"
            value="PUT"
            name="_method"> 

        <label for="outlets">Outlets</label>
        <br>
        <select name="outlets" id="outlets" class="form-control md-8"></select>
        <br>
        <br>

        <label for="members">Member</label>
        <br>
        <select name="members" id="members" class="form-control md-8"></select>
        <br>
        <br>

        <label for="tanggal">Tanggal</label><br>
        <input class="form-control"  type="text" name="tanggal" id="tanggal" />
        <br>

        <label for="batas waktu">Batas waktu</label>
        <input class="form-control"  type="text" name="batas_waktu" id="batas_waktu" />
        <br>

        <label for="tanggal bayar">Tanggal Bayar</label><br>
            <input type="number" id="tanggal_bayar" name="tanggal_bayar" class="form-control">
        <br><br>

        <label for="diskon">diskon</label>
        <input class="form-control" type="text" name="diskon" id="diskon" />
        <br>

        <label for="pajak">pajak</label>
        <input class="form-control"  type="text" name="pajak" id="pajak" />
        <br>
    
        <label for="status">Status</label><br>
            <select name="status" id="status" class="form-control">
                <option value="">Masukkan Status</option>
                <option value="baru">baru</option>
                <option value="proses">proses</option>
                <option value="selesai">selesai</option>
                <option value="diambil">diambil</option>
            </select>
            <br>

            <label for="dibayar">Dibayar</label><br>
            <select name="dibayar" id="dibayar" class="form-control">
                <option value="">Pilih</option>
                <option value="dibayar">Dibayar</option>
                <option value="biaya_tambahan">biaya tambahan</option>
            </select>
            <br>

        <input class="btn btn-primary" type="submit" value="Update" />
    </form>
</div>
@endsection
