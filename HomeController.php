<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Lokasi;
use App\Models\Berita;
use App\Models\Kontak;
use App\Models\Banner;
use App\Models\Donasi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalBuku    = Buku::count();
        $totalLokasi  = Lokasi::count();
        $totalBerita  = Berita::count();
        $totalKontak  = Kontak::count();
        $totalBanner  = Banner::count();

        $bukuTersedia    = Buku::where('status', 'tersedia')->count();
        $bukuDipinjam    = Buku::where('status', 'tidak tersedia')->count();

        $bukuTerbaru  = Buku::latest()->take(5)->get();
        $kontakTerbaru = Donasi::latest()->take(5)->get();

        return view('home', compact(
            'totalBuku',
            'totalLokasi',
            'totalBerita',
            'totalKontak',
            'totalBanner',
            'bukuTersedia',
            'bukuDipinjam',
            'bukuTerbaru',
            'kontakTerbaru'
        ));
    }
}
