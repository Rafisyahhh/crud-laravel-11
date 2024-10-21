<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Penyewaan;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merk = Mobil::all();
        $karyawan = Karyawan::all();
        $pelanggan = Pelanggan::all();
        $data = Penyewaan::with('mobil', 'karyawan', 'pelanggan')->get();
        return view('penyewaan', compact('data', 'merk', 'karyawan', 'pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'mobil' => 'required|string|unique:penyewaan,id_mobil',
                'karyawan' => 'required|string',
                'pelanggan' => 'required|string|unique:penyewaan,id_pelanggan',
                'tgl_sewa' => 'required|date|after_or_equal:today',
                'durasi_sewa' => 'required|numeric|min:0',
            ],
            [
                'mobil.required' => 'Form tidak boleh kosong',
                'mobil.unique' => 'Merk mobil sudah ada',
                'karyawan.required' => 'Form tidak boleh kosong',
                'pelanggan.required' => 'Form tidak boleh kosong',
                'pelanggan.unique' => 'Pelanggan tidak bisa menyewa 2 mobil sekaligus',
                'tgl_sewa.required' => 'Form tidak boleh kosong',
                'tgl_sewa.after_or_equal' => 'Tanggal sewa tidak boleh kurang dari hari ini',
                'durasi_sewa.required' => 'Form tidak boleh kosongg',
                'durasi_sewa.min' => 'Durasi sewa tidak boleh kurang dari 0',
            ]
        );
        $mobil = Mobil::find($request->mobil);
        $total_harga = $mobil ? $request->durasi_sewa * $mobil->harga_sewa : 0;
        $data = Penyewaan::create([
            'id_mobil' => $request->mobil,
            'id_pelanggan' => $request->pelanggan,
            'id_karyawan' => $request->karyawan,
            'tgl_sewa' => $request->tgl_sewa,
            'durasi_sewa' => $request->durasi_sewa,
            'total_harga' => $total_harga,
        ]);
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'mobil' => 'required|string|unique:penyewaan,id_mobil,'. $id . ',id',
                'karyawan' => 'required|string',
                'pelanggan' => 'required|string|unique:penyewaan,id_pelanggan,'. $id . ',id',
                'tgl_sewa' => 'required|date|after_or_equal:today',
                'durasi_sewa' => 'required|numeric|min:0',
            ],
            [
                'mobil.required' => 'Form tidak boleh kosong',
                'mobil.unique' => 'Merk mobil sudah ada',
                'karyawan.required' => 'Form tidak boleh kosong',
                'pelanggan.required' => 'Form tidak boleh kosong',
                'pelanggan.unique' => 'Pelanggan tidak bisa menyewa 2 mobil sekaligus',
                'tgl_sewa.required' => 'Form tidak boleh kosong',
                'tgl_sewa.after_or_equal' => 'Tanggal sewa tidak boleh kurang dari hari ini',
                'durasi_sewa.required' => 'Form tidak boleh kosong',
                'durasi_sewa.min' => 'Durasi sewa tidak boleh kurang dari 0',
            ]
        );
        $mobil = Mobil::find($request->mobil);
        $total_harga = $mobil ? $request->durasi_sewa * $mobil->harga_sewa : 0;
        $data = Penyewaan::where('id', $id)->update([
            'id_mobil' => $request->mobil,
            'id_pelanggan' => $request->pelanggan,
            'id_karyawan' => $request->karyawan,
            'tgl_sewa' => $request->tgl_sewa,
            'durasi_sewa' => $request->durasi_sewa,
            'total_harga' => $total_harga,
        ]);
        return back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        if ($penyewaan->pengembalian()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus, data ini masih digunakan ditabel lain');
        }
        $penyewaan->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }
}
