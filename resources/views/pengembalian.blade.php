@extends('layouts.app')
@section('judul','Pengembalian | Rental Mobil')
@section('content')
<div class="page-heading">
    <h3>Pengembalian</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Pengembalian
                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
            </h4>
        </div>
        <!-- table head dark -->
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Merk Mobil</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $isi)
                    <tr>
                        <td>{{$loop -> iteration}}</td>
                        <td>{{$isi -> penyewaan->pelanggan->nama}}</td>
                        <td>{{$isi -> penyewaan->mobil->merk_mobil->merk_mobil}}</td>
                        <td>{{$isi -> penyewaan->karyawan->nama}}</td>
                        <td>{{date('d M Y', strtotime($isi->penyewaan->tgl_sewa))}}</td>
                        <td>{{date('d M Y', strtotime($isi->tgl_kembali))}}</td> 
                        <td>{{$isi -> kondisi}}</td>
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
                <h4 class="modal-title" id="myModalLabel33">Tambah Data Pengembalian</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/pengembalian/tambah" method="post">
                @csrf
                <div class="modal-body">
                    <label for="alamat">Nama Pelanggan: </label>
                    <select name="penyewaan" class="form-select" id="basicSelect">
                        <option>Nama Pelanggan</option>
                        @foreach ($penyewaan as $p)
                        <option value="{{ $p->id }}" {{ old('penyewaan') == $p->id ? 'selected' : '' }}>
                            {{ $p->pelanggan->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Tanggal Kembali: </label>
                    <div class="form-group">
                        <input id="alamat" name="tgl_kembali" value="{{ old('tgl_kembali') }}" type="date" placeholder="Masukkan Tanggal Kembali" class="form-control">
                    </div>
                    <label for="deskripsi">Kondisi: </label>
                    <div class="form-group">
                        <input id="deskripsi" name="kondisi" value="{{ old('kondisi') }}" type="text" placeholder="Masukkan Kondisi" class="form-control">
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
                <h4 class="modal-title" id="myModalLabel33">Ubah Data Pengembalian</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/pengembalian/ubah/{{$isi->id}}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="alamat">Nama Pelanggan: </label>
                    <select name="penyewaan" class="form-select" id="basicSelect">
                        <option>Nama Pelanggan</option>
                        @foreach ($penyewaan as $p)
                        <option value="{{ $p->id }}" {{ $p->id == $isi->id_penyewaan ? 'selected' : '' }}>
                            {{ $p->pelanggan->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label for="alamat">Tanggal Kembali: </label>
                    <div class="form-group">
                        <input id="alamat" name="tgl_kembali" value="{{ $isi->tgl_kembali }}" type="date" placeholder="Masukkan Tanggal Kembali" class="form-control">
                    </div>
                    <label for="deskripsi">Kondisi: </label>
                    <div class="form-group">
                        <input id="deskripsi" name="kondisi" value="{{ $isi->kondisi }}" type="text" placeholder="Masukkan Kondisi" class="form-control">
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
                window.location.href = `/pengembalian/hapus/${id}`;
            }
        })
    };
</script>
@endsection