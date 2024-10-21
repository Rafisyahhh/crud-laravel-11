<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pelanggan::all();
        return view('pelanggan', compact('data'));
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
                'nama' => 'required|string|unique:pelanggan,nama',
                'alamat' => 'required|string',
                'no_telp' => 'required|numeric|digits_between:10,12|unique:pelanggan,no_telp',
                'foto' => 'required|image|mimes:jpeg,png,jpg',
            ],
            [
                'nama.required' => 'Form tidak boleh kosong',
                'nama.unique' => 'Merk mobil sudah ada',
                'alamat.required' => 'Form tidak boleh kosong',
                'no_telp.required' => 'Form tidak boleh kosong',
                'no_telp.digits_between' => 'No Telp harus 10-12 angka',
                'no_telp.unique' => 'No Telp sudah digunakan',
                'foto.required' => 'Form tidak boleh kosong',
                'foto.image' => 'File harus berupa gambar',
                'foto.mimes' => 'Format file gambar harus jpeg, png, atau jpg',
            ]
        );
        // Proses unggah foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $ekstensi = $foto->getClientOriginalExtension();
            $namaFoto = Str::random(10) . '.' . $ekstensi;
            $foto->move(public_path('image'), $namaFoto);
        } else {
            $namaFoto = null;
        }
        $data = Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'foto' => $namaFoto
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
        $data = Pelanggan::find($id);
        return view('pelanggan', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nama' => 'required|string|unique:pelanggan,nama,' . $id . ',id',
                'alamat' => 'required|string',
                'no_telp' => 'required|numeric|digits_between:10,12|unique:pelanggan,no_telp,' . $id . ',id',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg'
            ],
            [
                'nama.required' => 'Form tidak boleh kosong',
                'nama.unique' => 'Data karyawan sudah ada',
                'alamat.required' => 'Form tidak boleh kosong',
                'no_telp.required' => 'Form tidak boleh kosong',
                'no_telp.digits_between' => 'No Telp harus 10-12 angka',
                'no_telp.unique' => 'No Telp sudah digunakan',
                'foto.required' => 'Form tidak boleh kosong',
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg, png, atau jpg.',
            ]
        );
        $pelanggan = Pelanggan::findOrFail($id);
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            //hapus foto sebelumnya
            if ($pelanggan->foto !== null && file_exists(public_path('image/') . $pelanggan->foto)) {
                unlink(public_path('image/') . $pelanggan->foto);
            }
            $foto = $request->file('foto');
            $ekstensi = $foto->getClientOriginalExtension();
            $namaFoto = Str::random(10) . '.' . $ekstensi;
            $foto->move(public_path('image'), $namaFoto);
        } else {
            $namaFoto = $pelanggan->foto;
        }
        $data = Pelanggan::R([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'foto' => $namaFoto
        ]);
        return back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        if ($pelanggan->penyewaan()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus, data ini masih digunakan ditabel lain');
        }
        if ($pelanggan->foto !== null && file_exists(public_path('image/') . $pelanggan->foto)) {
            unlink(public_path('image/') . $pelanggan->foto);
        }
        $pelanggan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
