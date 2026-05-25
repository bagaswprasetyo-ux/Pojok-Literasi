<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->q;
        $tipe    = $request->tipe;

        if (!in_array($tipe, ['lokasi', 'buku'])) {
            $tipe = 'lokasi';
        }

        $lokasi = Lokasi::where('lokasi', 'LIKE', "%{$keyword}%")
            ->orWhere('rt', 'LIKE', "%{$keyword}%")
            ->withCount('buku')
            ->get();

        $buku = Buku::where('judul', 'LIKE', "%{$keyword}%")
            ->orWhere('pengarang', 'LIKE', "%{$keyword}%")
            ->get();

        return view('hasil_pencarian', compact('keyword', 'tipe', 'lokasi', 'buku'));
    }
}
