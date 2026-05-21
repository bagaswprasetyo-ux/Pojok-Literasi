<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Banner::latest()->paginate(10);
        $data ['models'] = $models;
        return view('banner_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Banner(),
            'method' => 'POST',
            'route' => 'banner.store',
            'namaTombol' => 'SIMPAN',
        ];
        return view('banner_form',$data);
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
            'gambar' => 'required|mimes:png,jpg,jpeg|max:5000',

        ]);
        $requestData['gambar'] = $request->file('gambar')->store('public');
        Banner::create($requestData);
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
        $banner = Banner::findOrFail($id);

        $data = [
            'model' => $banner,
            'method' => 'PUT',
            'route' => ['banner.update', $id],
            'namaTombol' => 'UPDATE',
        ];

        return view('banner_form', $data);
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
            'gambar' => 'nullable|mimes:png,jpg,jpeg|max:5000',
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Jika ada file gambar yang diunggah, proses gambar baru
            \Storage::delete($banner->gambar); // Hapus gambar lama
            $requestData['gambar'] = $request->file('gambar')->store('public'); // Simpan gambar baru
        }

        $banner->update($requestData);

        flash('Data Berhasil Diupdate');
        return back(); // Sesuaikan dengan rute yang sesuai
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::destroy($id);
        flash('data sudah dihapus');
        return back();
    }
}
