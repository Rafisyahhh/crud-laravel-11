<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewaan = Penyewaan::all();
        $data = Pengembalian::with('penyewaan')->get();
        return view('pengembalian', compact('data', 'penyewaan'));
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
                'penyewaan' => 'required|string|unique:pengembalian,id_penyewaan',
                'tgl_kembali' => 'required|date|after_or_equal:today',
                'kondisi' => 'required|string',
            ],
            [
                'penyewaan.required' => 'Form tidak boleh kosong',
                'penyewaan.unique' => 'Penyewa sudah mengembalikan mobil',
                'tgl_kembali.required' => 'Form tidak boleh kosong',
                'tgl_kembali.after_or_equal' => 'Tanggal kembali tidak boleh kurang dari hari ini',
                'kondisi.required' => 'Form tidak boleh kosongg',
            ]
        );
        $data = Pengembalian::create([
            'id_penyewaan' => $request->penyewaan,
            'tgl_kembali' => $request->tgl_kembali,
            'kondisi' => $request->kondisi,
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
                'penyewaan' => 'required|string|unique:pengembalian,id_penyewaan,'. $id . ',id',
                'tgl_kembali' => 'required|date|after_or_equal:today',
                'kondisi' => 'required|string',
            ],
            [
                'penyewaan.required' => 'Form tidak boleh kosong',
                'penyewaan.unique' => 'Pelanggan sudah mengembalikan mobil',
                'tgl_kembali.required' => 'Form tidak boleh kosong',
                'tgl_kembali.after_or_equal' => 'Tanggal kembali tidak boleh kurang dari hari ini',
                'kondisi.required' => 'Form tidak boleh kosongg',
            ]
        );
        $data = Pengembalian::where('id', $id)->update([
            'id_penyewaan' => $request->penyewaan,
            'tgl_kembali' => $request->tgl_kembali,
            'kondisi' => $request->kondisi,
        ]);
        return back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }
}
