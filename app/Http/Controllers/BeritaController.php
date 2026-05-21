<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Berita::latest()->paginate(10);
        $data ['models'] = $models;
        return view('berita_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Berita(),
            'method' => 'POST',
            'route' => 'berita.store',
            'namaTombol' => 'SIMPAN',
        ];
        return view('berita_form',$data);
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
            'foto' => 'required|mimes:png,jpg,jpeg|max:5000',
            'judul' => 'required',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'tanggal' => 'required',

        ]);
        $requestData['foto'] = $request->file('foto')->store('public');
        Berita::create($requestData);
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
        $berita = Berita::findOrFail($id);

        $data = [
            'model' => $berita,
            'method' => 'PUT',
            'route' => ['berita.update', $berita->id],
            'namaTombol' => 'UPDATE',
        ];

        return view('berita_form', $data);
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
        $berita = Berita::findOrFail($id);

        $requestData = $request->validate([
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:5000',
            'judul' => 'required',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'tanggal' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            \Storage::delete($berita->foto);
            $requestData['foto'] = $request->file('foto')->store('public');
        }

        $berita->update($requestData);

        flash('Data Berhasil Diupdate');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Berita::destroy($id);
        flash('data sudah dihapus');
        return back();
    }
}
