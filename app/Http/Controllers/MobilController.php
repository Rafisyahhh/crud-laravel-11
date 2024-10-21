<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Merkmobil;
use App\Models\Jenismobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merk = Merkmobil::all();
        $jenis = Jenismobil::all();
        $data = Mobil::with('jenis_mobil','merk_mobil')->get();
        return view ('mobil', compact('data','merk','jenis'));
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
        // dd($request->all());
        $request->validate([
            'merk_mobil' => 'required|string|unique:mobil,id_merk',
            'jenis_mobil' => 'required|string',
            'tahun' => 'required|numeric|min:0|max:2024',
            'no_plat' => 'required|string|unique:mobil,no_plat',
            'harga_sewa' => 'required|numeric|min:0',
        ],
        [
            'merk_mobil.required' => 'Form tidak boleh kosong',
            'merk_mobil.unique' => 'Merk mobil sudah ada',
            'jenis_mobil.required' => 'Form tidak boleh kosong',
            'tahun.required' => 'Form tidak boleh kosong',
            'tahun.min' => 'Tahun tidak boleh kurang dari 0',
            'tahun.max' => 'Tahun tidak boleh lebih dari 2024',
            'no_plat.required' => 'Form tidak boleh kosong',
            'no_plat.unique' => 'No plat sudah ada',
            'harga_sewa.required' => 'Form tidak boleh kosongg',
            'harga_sewa.min' => 'Harga sewa tidak boleh kurang dari 0',
        ]);
        $data=Mobil::create([
            'id_merk' => $request -> merk_mobil,
            'id_jenis' => $request -> jenis_mobil,
            'tahun' => $request -> tahun,
            'no_plat' => $request -> no_plat,
            'harga_sewa' => $request -> harga_sewa,
        ]);
        return back()->with('success','Data berhasil ditambahkan');
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
        $data = Mobil::find($id);
        return view('mobil',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'merk_mobil' => 'required|string|unique:mobil,id_merk,'. $id . ',id',
            'jenis_mobil' => 'required|string',
            'tahun' => 'required|numeric|min:0|max:2024',
            'no_plat' => 'required|string|unique:mobil,no_plat,'. $id . ',id',
            'harga_sewa' => 'required|numeric|min:0',
        ],
        [
            'merk_mobil.required' => 'Form tidak boleh kosong',
            'merk_mobil.unique' => 'Merk mobil sudah ada',
            'jenis_mobil.required' => 'Form tidak boleh kosong',
            'tahun.required' => 'Form tidak boleh kosong',
            'tahun.min' => 'Tahun tidak boleh kurang dari 0',
            'tahun.max' => 'Tahun tidak boleh lebih dari 2024',
            'no_plat.required' => 'Form tidak boleh kosong',
            'harga_sewa.required' => 'Form tidak boleh kosong',
            'harga_sewa.min' => 'Harga sewa tidak boleh kurang dari 0',
        ]);
        $data=Mobil::where('id',$id)->update([
            'id_merk' => $request -> merk_mobil,
            'id_jenis' => $request -> jenis_mobil,
            'tahun' => $request -> tahun,
            'no_plat' => $request -> no_plat,
            'harga_sewa' => $request -> harga_sewa,
        ]);
        return back()->with('success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mobil = Mobil::findOrFail($id);
        if ($mobil->penyewaan()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus, data ini masih digunakan ditabel lain');
        }
        $mobil->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }
}
