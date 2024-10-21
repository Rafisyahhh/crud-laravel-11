<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Karyawan::all();
        return view ('karyawan', compact('data'));
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
            'nama' => 'required|string|unique:karyawan,nama',
            'alamat' => 'required|string',
            'no_telp' => 'required|numeric|digits_between:10,12|unique:karyawan,no_telp',
        ],
        [
            'nama.required' => 'Form tidak boleh kosong',
            'nama.unique' => 'Merk mobil sudah ada',
            'alamat.required' => 'Form tidak boleh kosong',
            'no_telp.required' => 'Form tidak boleh kosong',
            'no_telp.digits_between' => 'No Telp harus 10-12 angka',
            'no_telp.unique' => 'No Telp sudah digunakan',
        ]);
        $data=Karyawan::create([
            'nama' => $request -> nama,
            'alamat' => $request -> alamat,
            'no_telp' => $request -> no_telp,
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
        $data = Karyawan::find($id);
        return view('karyawan',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|unique:karyawan,nama,'. $id . ',id',
            'alamat' => 'required|string',
            'no_telp' => 'required|numeric|digits_between:10,12|unique:karyawan,no_telp'. $id . ',id',
        ],
        [
            'nama.required' => 'Form tidak boleh kosong',
            'nama.unique' => 'Data karyawan sudah ada',
            'alamat.required' => 'Form tidak boleh kosong',
            'no_telp.required' => 'Form tidak boleh kosong',
            'no_telp.digits_between' => 'No Telp harus 10-12 angka',
            'no_telp.unique' => 'No Telp sudah digunakan',
        ]);
        $data=Karyawan::where('id',$id)->update([
            'nama' => $request -> nama,
            'alamat' => $request -> alamat,
            'no_telp' => $request -> no_telp,
        ]);
        return back()->with('success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        if ($karyawan->penyewaan()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus, data ini masih digunakan ditabel lain');
        }
        $karyawan->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }
}
