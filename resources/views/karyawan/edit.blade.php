@extends('layout.template')
<!-- START FORM -->
@section('konten')

<form action='{{url('karyawan/'.$data->nik)}}' method='post'>
    @csrf 
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{url('karyawan')}}' class="btn btn-secondary"><< kembali</a>
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
                {{$data->nik}}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{$data->nama}}" id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="posisi" class="col-sm-2 col-form-label">Posisi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='posisi' value="{{$data->posisi}}" id="posisi">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
    <!-- AKHIR FORM -->
    @endsection