@extends('layouts.app')
@section('judul','Mobil | Rental Mobil')
@section('content')
<div class="page-heading">
    <h3>Mobil</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Mobil
                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
            </h4>
        </div>
        <!-- table head dark -->
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Merk Mobil</th>
                        <th>Jenis Mobil</th>
                        <th>Tahun</th>
                        <th>No Plat</th>
                        <th>Harga Sewa Per-Hari</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $isi)
                    <tr>
                        <td>{{$loop -> iteration}}</td>
                        <td>{{$isi -> merk_mobil->merk_mobil}}</td>
                        <td>{{$isi -> jenis_mobil->nama_jenis_mobil}}</td>
                        <td>{{$isi -> tahun}}</td>
                        <td>{{$isi -> no_plat}}</td>
                        <td>{{'Rp ' . number_format($isi->harga_sewa,2,',','.')}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{$isi->id}}"><i class="bi bi-pencil-fill"></i></button>
                            <button onclick="hapus('{{$isi->id}}')" class="btn btn-sm btn-danger fw-bold"><i class="bi bi-trash3"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end -->
<!-- Modal Tambah -->
<div class="modal fade text-left" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data Mobil</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/mobil/tambah" method="post">
                @csrf
                <div class="modal-body">
                    <label for="alamat">Merk Mobil: </label>
                    <select name="merk_mobil" class="form-select" id="basicSelect">
                        <option>Merk Mobil</option>
                        @foreach ($merk as $m)
                        <option value="{{ $m->id }}" {{ old('merk_mobil') == $m->id ? 'selected' : '' }}>
                            {{ $m->merk_mobil }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Jenis Mobil: </label>
                    <select name="jenis_mobil" class="form-select" id="basicSelect">
                        <option>Jenis Mobil</option>
                        @foreach ($jenis as $j) 
                        <option value="{{ $j->id }}" {{ old('jenis_mobil') == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jenis_mobil }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Tahun: </label>
                    <div class="form-group">
                        <input id="alamat" name="tahun" value="{{ old('tahun') }}" type="number" placeholder="Masukkan Tahun Mobil" class="form-control">
                    </div>
                    <label for="deskripsi">No Plat: </label>
                    <div class="form-group">
                        <input id="deskripsi" name="no_plat" value="{{ old('no_plat') }}" type="text" placeholder="Masukkan No Plat" class="form-control">
                    </div>
                    <label for="deskripsi">Harga Sewa: </label>
                    <div class="form-group">
                        <input id="deskripsi" name="harga_sewa" value="{{ old('harga_sewa') }}" type="number" placeholder="Masukkan Harga Sewa" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tambah</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal ubah -->
@foreach($data as $isi)
<div class="modal fade text-left" id="modalEdit{{$isi->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Ubah Data Mobil</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/mobil/ubah/{{$isi->id}}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="alamat">Merk Mobil: </label>
                    <select name="merk_mobil" class="form-select" id="basicSelect">
                        <option>Merk Mobil</option>
                        @foreach ($merk as $m)
                        <option value="{{ $m->id }}" {{ $m->id == $isi->id_merk ? 'selected' : '' }}>
                            {{ $m->merk_mobil }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Jenis Mobil: </label>
                    <select name="jenis_mobil" class="form-select" id="basicSelect">
                        <option>Jenis Mobil</option>
                        @foreach ($jenis as $j)
                        <option value="{{ $j->id }}" {{ $j->id == $isi->id_jenis ? 'selected' : '' }}>
                            {{ $j->nama_jenis_mobil }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Tahun: </label>
                    <div class="form-group">
                        <input id="alamat" name="tahun" value="{{$isi-> tahun}}" type="number" placeholder="Masukkan Tahun Mobil" class="form-control">
                    </div>
                    <label for="deskripsi">No Plat: </label>
                    <div class="form-group">
                        <input id="deskripsi" name="no_plat" value="{{$isi-> no_plat}}" type="text" placeholder="Masukkan No Plat" class="form-control">
                    </div>
                    <label for="deskripsi">Harga Sewa: </label>
                    <div class="form-group">
                        <input id="deskripsi" name="harga_sewa" value="{{$isi-> harga_sewa}}" type="number" placeholder="Masukkan Harga Sewa" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Ubah</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<script type="text/javascript">
    function hapus(id) {
        Swal.fire({
            title: "Apakah kamu yakin ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya aku yakin!"
        }).then((i) => {
            if (i.isConfirmed) {
                window.location.href = `/mobil/hapus/${id}`;
            }
        })
    };
</script>
@endsection