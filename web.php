<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BeritaPengunjungController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuDetailController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\KontakAdminController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\LokasiDetailController;
use App\Http\Controllers\PencarianController;
use App\Models\Banner;
use App\Models\Buku;
use App\Models\Donasi;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    $lokasi = Lokasi::all();
    $lokasiId = Lokasi::pluck('id');
    $banner = Banner::latest()->first();
    $secondBanner = Banner::latest()->skip(1)->first();
    $thirdBanner = Banner::latest()->skip(2)->first();
    $buku = Buku::with('lokasi')->latest()->take(5)->get();
    return view('welcome', compact('lokasi','lokasiId','banner','buku','secondBanner','thirdBanner'));
});

Route::get('/hasil-pencarian', [PencarianController::class, 'index'])->name('hasil.pencarian');

Route::post('/donasi', function (Illuminate\Http\Request $request) {
    $donasi = new Donasi();
    $donasi->email = $request->input('email');
    $donasi->pesan = $request->input('pesan');
    // Jika Anda memiliki atribut lain, tambahkan di sini

    $donasi->save();

    return redirect('/donasiberhasil')->with('success', 'Donasi berhasil disimpan!');
})->name('donasi.store');

Route::get('/beranda', function () {
    $banner = Banner::all();
    return view('beranda', compact('banner'));
});

Route::get('/donasiberhasil', function () {
    return  view('donasiberhasil');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});
Route::get('/informasi', function () {
    return view('informasi');
});
Route::resource('lokasi', LokasiController::class);
Route::resource('buku', BukuController::class);
Route::resource('banner', BannerController::class);
Route::resource('kontak', KontakController::class);
Route::resource('berita', BeritaController::class);
Route::resource('lokasidetail', LokasiDetailController::class);
Route::get('/lokasidetail/{id}', 'LokasiDetailController@index')->name('lokasidetail.index');
Route::resource('bukudetail', BukuDetailController::class);
Route::resource('beritapengunjung', BeritaPengunjungController::class);
Route::resource('kontakadmin', KontakAdminController::class);
Route::resource('opendonasi', DonasiController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});
