<?php

namespace App\Http\Controllers;

use App\Models\Merkmobil;
use Illuminate\Http\Request;

class MerkmobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Merkmobil::all();
        return view ('merk_mobil', compact('data'));
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
        $request->validate([
            'merk_mobil' => 'required|string|unique:merk_mobil,merk_mobil',
            'deskripsi' => 'required|string',
        ],
        [
            'merk_mobil.required' => 'Form tidak boleh kosong',
            'merk_mobil.unique' => 'Merk mobil sudah ada',
            'deskripsi.required' => 'Form tidak boleh kosong'
        ]);
        $data=Merkmobil::create([
            'merk_mobil' => $request -> merk_mobil,
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
        $data = Merkmobil::find($id);
        return view('merk_mobil',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'merk_mobil' => 'required|string|unique:merk_mobil,merk_mobil,'. $id . ',id',
            'deskripsi' => 'required|string',
        ],
        [
            'merk_mobil.required' => 'Form tidak boleh kosong',
            'merk_mobil.unique' => 'Merk mobil sudah ada',
            'deskripsi.required' => 'Form tidak boleh kosong'
        ]);
        $data=Merkmobil::where('id',$id)->update([
            'merk_mobil' => $request -> merk_mobil,
            'deskripsi' => $request -> deskripsi,
        ]);
        return back()->with('success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merkmobil = Merkmobil::findOrFail($id);
        if ($merkmobil->mobil()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus, data ini masih digunakan ditabel lain');
        }
        $merkmobil->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
