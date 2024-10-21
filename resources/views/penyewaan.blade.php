@extends('layouts.app')
@section('judul','Penyewaan | Rental Mobil')
@section('content')
<div class="page-heading">
    <h3>Penyewaan</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Penyewaan
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
                        <th>Nama Karyawan</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Sewa</th>
                        <th>Durasi Sewa</th>
                        <th>Total Harga Sewa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $isi)
                    <tr>
                        <td>{{$loop -> iteration}}</td>
                        <td>{{$isi -> mobil->merk_mobil->merk_mobil}}</td>
                        <td>{{$isi -> mobil->jenis_mobil->nama_jenis_mobil}}</td>
                        <td>{{$isi -> karyawan->nama}}</td>
                        <td>{{$isi -> pelanggan->nama}}</td>
                        <td>{{date('d M Y', strtotime($isi->tgl_sewa))}}</td>
                        <td>{{$isi -> durasi_sewa}} Hari</td>
                        <td>{{'Rp ' . number_format($isi->total_harga,2,',','.')}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{$isi->id}}"><i class="bi bi-pencil-fill"></i></button>
                            <button onclick="hapus('{{$isi-> id}}')" class="btn btn-sm btn-danger fw-bold"><i class="bi bi-trash3"></i></button>
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
                <h4 class="modal-title" id="myModalLabel33">Tambah Data Penyewaan</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/penyewaan/tambah" method="post">
                @csrf
                <div class="modal-body">
                    <label for="alamat">Mobil: </label>
                    <select name="mobil" class="form-select" id="basicSelect">
                        <option>Merk Mobil</option>
                        @foreach ($merk as $m)
                        <option value="{{ $m->id }}" {{ old('mobil') == $m->id ? 'selected' : '' }}>
                            {{ $m->merk_mobil->merk_mobil }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Nama Karyawan: </label>
                    <select name="karyawan" class="form-select" id="basicSelect">
                        <option>Nama Karyawan</option>
                        @foreach ($karyawan as $k)
                        <option value="{{ $k->id }}" {{ old('karyawan') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Nama Pelanggan: </label>
                    <select name="pelanggan" class="form-select" id="basicSelect">
                        <option>Nama Pelanggan</option>
                        @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ old('pelanggan') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Tanggal Sewa: </label>
                    <div class="form-group">
                        <input id="alamat" name="tgl_sewa" value="{{ old('tgl_sewa') }}" type="date" placeholder="Masukkan Tanggal Sewa" class="form-control">
                    </div>
                    <label for="deskripsi">Durasi Sewa (Hari): </label>
                    <div class="form-group">
                        <input id="deskripsi" name="durasi_sewa" value="{{ old('durasi_sewa') }}" type="number" placeholder="Masukkan Durasi Sewa" class="form-control">
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
                <h4 class="modal-title" id="myModalLabel33">Ubah Data Penyewaan</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/penyewaan/ubah/{{$isi->id}}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="alamat">Mobil: </label>
                    <select name="mobil" class="form-select" id="basicSelect">
                        <option>Merk Mobil</option>
                        @foreach ($merk as $m)
                        <option value="{{ $m->id }}" {{ $m->id == $isi->id_mobil ? 'selected' : '' }}>
                            {{ $m->merk_mobil->merk_mobil }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Nama Karyawan: </label>
                    <select name="karyawan" class="form-select" id="basicSelect">
                        <option>Nama Karyawan</option>
                        @foreach ($karyawan as $k)
                        <option value="{{ $k->id }}" {{ $k->id == $isi->id_karyawan ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Nama Pelanggan: </label>
                    <select name="pelanggan" class="form-select" id="basicSelect">
                        <option>Nama Pelanggan</option>
                        @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ $p->id == $isi->id_pelanggan ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Tanggal Sewa: </label>
                    <div class="form-group">
                        <input id="alamat" name="tgl_sewa" value="{{ $isi->tgl_sewa }}" type="date" placeholder="Masukkan Tanggal Sewa" class="form-control">
                    </div>
                    <label for="deskripsi">Durasi Sewa (Hari): </label>
                    <div class="form-group">
                        <input id="deskripsi" name="durasi_sewa" value="{{ $isi->durasi_sewa }}" type="number" placeholder="Masukkan Durasi Sewa" class="form-control">
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
                window.location.href = `/penyewaan/hapus/${id}`;
            }
        })
    };
</script>
@endsection