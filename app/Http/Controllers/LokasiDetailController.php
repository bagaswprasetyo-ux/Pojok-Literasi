<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $lokasi = Buku::with('lokasi')->findOrFail($id);
        // $buku = Buku::where('lokasi_id',$id)->where('lokasi_id',$id)->get();
        // return view('lokasi_detail', compact('buku','lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $lokasi = Buku::with('lokasi')->findOrFail($id);
        $buku = Buku::where('lokasi_id',$id)->where('lokasi_id',$id)->get();
        return view('lokasi_detail', compact('buku','lokasi'));
        // $buku = Buku::findOrFail($id);
        // // return view('buku_detail', compact('buku'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
