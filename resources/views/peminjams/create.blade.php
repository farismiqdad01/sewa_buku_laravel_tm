@extends('layout.master')

@section('content')
    <div class="container">
        <h4>Tambah Peminjam</h4>
        <form method="post" action="{{ route('peminjam.store') }}">
        @csrf
            <div class="form-goup">
                <label>Kode Peminjam</label>
                <input type="text" name="kode_peminjam" class="form-control">
            </div>
            <div class="form-goup">
                <label>Nama Peminjam
                </label>
                <input type="text" name="nama_peminjam" class="form-control">
            </div>
            <div class="form-goup">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control">
            </div>
            <div class="form-goup">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control">
            </div>
            <div class="form-goup">
                <label>Telepon</label>
                <input type="text" name="telepon" class="form-control">
            </div>
            <div class="form-group">
                <label>Jenis Peminjam</label>
                <select class="form-select" name="id_jenis_peminjam">
                    <option>Pilih Jenis Peminjam</option>
                        @foreach ($list_jenis_peminjam as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                        @endforeach
                </select>
            </div>
            <div><button type="submit">Simpan</button></div>
        </form>
    </div>
@endsection