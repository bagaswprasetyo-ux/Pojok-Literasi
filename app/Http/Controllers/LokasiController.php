<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Lokasi::latest()->paginate(10);
        $data ['models'] = $models;
        return view('lokasi_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Lokasi(),
            'method' => 'POST',
            'route' => 'lokasi.store',
            'namaTombol' => 'SIMPAN',
        ];
        return view('lokasi_form',$data);
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
            'lokasi' => 'required',
            'rt' => 'required',

        ]);
        Lokasi::create($requestData);
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
            'model'         => Lokasi::findOrFail($id),
            'method'        => 'PUT',
            'route'         => ['lokasi.update',$id],
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
            'lokasi' => 'required',
            'rt' => 'required',
        ]);
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->fill($requestData);
        $lokasi->save();
        flash('Data Berhasil Di Simpan');
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
        Lokasi::destroy($id);
        flash('data sudah dihapus');
        return back();
    }
}
