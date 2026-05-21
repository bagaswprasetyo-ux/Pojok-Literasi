<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::with('lokasi')->get();
        return view('buku_index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lokasi = Lokasi::all();
        $data = [
            'model' => new Buku(),
            'method' => 'POST',
            'route' => 'buku.store',
            'namaTombol' => 'SIMPAN',
            'lokasi' => $lokasi,
        ];
        return view('buku_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'lokasi_id' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg|max:5000',

        ]);
        $buku = Lokasi::find($request->input('lokasi_id'));
        $buku->save();

        $requestData['foto'] = $request->file('foto')->store('public');
        Buku::create($requestData);
        flash('Data Berhasil Di Simpan');
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        // Mendapatkan semua lokasi
        $lokasi = Lokasi::all();

        // Mengembalikan view edit dengan data buku dan lokasi
        $data = [
            'model' => $buku,
            'method' => 'PUT',
            'route' => ['buku.update', $buku->id],
            'namaTombol' => 'UPDATE',
            'lokasi' => $lokasi,
        ];

        return view('buku_form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'lokasi_id' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:5000',
        ]);

        $buku = Buku::findOrFail($id);

        // Jika ada file foto yang diupload, hapus foto lama dan simpan yang baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($buku->foto != null) {
                \Storage::delete($buku->foto);
            }

            // Simpan foto baru
            $requestData['foto'] = $request->file('foto')->store('public');
        }

        $buku->update($requestData);

        flash('DATA SUDAH DIUBAH');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::destroy($id);
        flash('data sudah dihapus');
        return back();
    }
}
