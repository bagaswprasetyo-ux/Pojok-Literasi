<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Kontak::latest()->paginate(10);
        $data ['models'] = $models;
        return view('kontak_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Kontak(),
            'method' => 'POST',
            'route' => 'kontak.store',
            'namaTombol' => 'SIMPAN',
        ];
        return view('kontak_form',$data);
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
            'nama' => 'required',
            'lokasi' => 'required',
            'email' => 'required',

        ]);
        $requestData['foto'] = $request->file('foto')->store('public');
        Kontak::create($requestData);
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
        $data = [
            'model'         => Kontak::findOrFail($id),
            'method'        => 'PUT',
            'route'         => ['kontak.update',$id],
            'namaTombol'    => 'UPDATE'
        ];
        return view('lokasi_form',$data);
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
            'foto' => 'required|mimes:png,jpg,jpeg|max:5000',
            'nama' => 'required',
            'lokasi' => 'required',
            'email' => 'required',
        ]);

        $kontak = Kontak::findOrFail($id);
        if ($request->hasFile('foto')) { #kalau ada foto maka
            \Storage::delete($kontak->foto); #foto yang lama di hapus
            $requestData['foto'] = $request->file('foto')->store('public'); #foto baru di simpan ke db
        }

        $kontak->fill($requestData);
        $kontak->save();
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
        Kontak::destroy($id);
        flash('data sudah dihapus');
        return back();
    }
}
