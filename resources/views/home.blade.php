@extends('layouts.app')
@section('judul','Dashboard | Rental Mobil')
@section('content')
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <h2 class="text-center fw-bold mb-3">Selamat Datang di Website Rental Mobil</h2>
                <img src="{{ asset('image/carrr.jpg') }}" alt="" width="800px" class="rounded mx-auto d-block">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                            <i class="bi bi-person-fill d-flex justify-content-center mb-2"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-bold fs-5">Jumlah Mobil</h6>
                        <h6 class="font-extrabold mb-0 fs-4">
                            {{ $mobil }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-start ">
                        <div class="stats-icon green mb-2">
                            <i class="bi bi-people-fill d-flex justify-content-center mb-2"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-bold fs-5">Jumlah Karyawan</h6>
                        <h6 class="font-extrabold mb-0 fs-4 ">
                            {{ $karyawan }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-start ">
                        <div class="stats-icon green mb-2">
                            <i class="bi bi-people-fill d-flex justify-content-center mb-2"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-bold fs-5">Jumlah Pelanggan</h6>
                        <h6 class="font-extrabold mb-0 fs-4 ">
                            {{ $pelanggan }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection