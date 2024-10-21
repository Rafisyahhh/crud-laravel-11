<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $datak = Karyawan::all();
        $karyawan = $datak->count();
        $datap = Pelanggan::all();
        $pelanggan = $datap->count();
        $datam = Mobil::all();
        $mobil = $datam->count();
        return view('home',compact('karyawan','pelanggan','mobil'));
    }
}
