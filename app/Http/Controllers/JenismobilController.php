<?php

namespace App\Http\Controllers;

use App\Models\Jenismobil;
use Illuminate\Http\Request;

class JenismobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jenismobil::all();
        return view ('jenis_mobil', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_mobil' => 'required|string|unique:jenis_mobil,nama_jenis_mobil',
            'deskripsi' => 'required|string',
        ],
        [
            'nama_jenis_mobil.required' => 'Form tidak boleh kosong',
            'nama_jenis_mobil.unique' => 'Nama jenis mobil sudah ada',
            'deskripsi.required' => 'Form tidak boleh kosong'
        ]);
        $data=Jenismobil::create([
            'nama_jenis_mobil' => $request -> nama_jenis_mobil,
            'deskripsi' => $request -> deskripsi,
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
        $data = Jenismobil::find($id);
        return view('jenismobil',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jenis_mobil' => 'required|string|unique:jenis_mobil,nama_jenis_mobil,'. $id . ',id',
            'deskripsi' => 'required|string',
        ],
        [
            'nama_jenis_mobil.required' => 'Form tidak boleh kosong',
            'nama_jenis_mobil.unique' => 'Nama jenis mobil sudah ada',
            'deskripsi.required' => 'Form tidak boleh kosong'
        ]);
        $data=Jenismobil::where('id',$id)->update([
            'nama_jenis_mobil' => $request -> nama_jenis_mobil,
            'deskripsi' => $request -> deskripsi,
        ]);
        return back()->with('success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenismobil = Jenismobil::findOrFail($id);
        if ($jenismobil->mobil()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus, data ini masih digunakan ditabel lain');
        }
        $jenismobil->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }
}
