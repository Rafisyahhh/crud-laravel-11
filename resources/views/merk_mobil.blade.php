@extends('layouts.app')
@section('judul','Merk Mobil | Rental Mobil')
@section('content')
<div class="page-heading">
    <h3>Merk Mobil</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Merk Mobil
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
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $isi)
                    <tr>
                        <td>{{$loop -> iteration}}</td>
                        <td>{{$isi -> merk_mobil}}</td>
                        <td>{{$isi -> deskripsi}}</td>
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
                <h4 class="modal-title" id="myModalLabel33">Tambah Merk Mobil</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/merkmobil/tambah" method="post">
                @csrf
                <div class="modal-body">
                    <label for="alamat">Merk Mobil: </label>
                    <div class="form-group">
                        <input id="alamat" name="merk_mobil" value="{{ old('merk_mobil') }}" type="text" placeholder="Masukkan Merk Mobil" class="form-control">
                    </div>
                    <label for="deskripsi">Deskripsi: </label>
                    <div class="form-group">
                        <input id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" type="text" placeholder="Masukkan Deskripsi" class="form-control">
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
                <h4 class="modal-title" id="myModalLabel33">Ubah Merk Mobil</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/merkmobil/ubah/{{$isi->id}}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="alamat">Jenis Mobil: </label>
                    <div class="form-group">
                        <input id="alamat" name="merk_mobil" type="text" placeholder="Masukkan Jenis Status" value="{{$isi-> merk_mobil}}" class="form-control">
                    </div>
                    <label for="deskripsi">Deskripsi: </label>
                    <div class="form-group">
                        <input id="deskripsi" name="deskripsi" type="text" placeholder="Masukkan Deskripsi" value="{{$isi-> deskripsi}}" class="form-control">
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
                window.location.href = `/merkmobil/hapus/${id}`;
            }
        })
    };
</script>
@endsection