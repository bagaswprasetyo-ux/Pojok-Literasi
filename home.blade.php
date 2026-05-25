@extends('layouts.app_admin')

@section('content')
<div class="container-fluid px-4">

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h4 class="mt-4 mb-1 fw-bold">Dashboard Admin</h4>
    <p class="text-muted mb-4" style="font-size:13px">Selamat datang, {{ Auth::user()->name }}</p>
    <div class="row g-3 mb-4">

        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card" style="border-top: 3px solid #f8d65b">
                <div class="stat-icon" style="background:#fff8e1; color:#b8890a">
                    <i class="nav-icon fas fa-file-alt"></i>
                </div>
                <div class="stat-value">{{ $totalBuku }}</div>
                <div class="stat-label">Total Buku</div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card" style="border-top: 3px solid #3b6d11">
                <div class="stat-icon" style="background:#eaf3de; color:#3b6d11">
                    <i class="nav-icon fas fa-tasks"></i>
                </div>
                <div class="stat-value">{{ $bukuTersedia }}</div>
                <div class="stat-label">Buku Tersedia</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card" style="border-top: 3px solid #185fa5">
                <div class="stat-icon" style="background:#e6f1fb; color:#185fa5">
                    <i class="nav-icon fas fa-map-marker-alt"></i>
                </div>
                <div class="stat-value">{{ $totalLokasi }}</div>
                <div class="stat-label">Lokasi</div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card" style="border-top: 3px solid #6f42c1">
                <div class="stat-icon" style="background:#f0ebff; color:#6f42c1">
                    <i class="nav-icon fas fa-newspaper"></i>
                </div>
                <div class="stat-value">{{ $totalBerita }}</div>
                <div class="stat-label">Berita</div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card" style="border-top: 3px solid #0d6efd">
                <div class="stat-icon" style="background:#e7f0ff; color:#0d6efd">
                    <i class="nav-icon fas fa-envelope"></i>
                </div>
                <div class="stat-value">{{ $totalKontak }}</div>
                <div class="stat-label">Pesan Masuk</div>
            </div>
        </div>

    </div>

    <div class="row g-3">

        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
                    <span><i class="nav-icon fas fa-book mx-2" style="color:#b8890a"></i>Buku Terbaru</span>
                    <a href="{{ route('buku.index') }}" class="btn btn-sm"
                        style="background:#f8d65b; color:#5a4200; font-size:12px; border-radius:20px">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0" style="font-size:13px">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bukuTerbaru as $i => $buku)
                                <tr>
                                    <td class="ps-3 text-muted">{{ $i + 1 }}</td>
                                    <td>{{ $buku->judul }}</td>
                                    <td class="text-muted">{{ $buku->pengarang ?? '-' }}</td>
                                    <td>
                                        @if($buku->status == 'tersedia')
                                            <span class="badge"
                                                style="background:#eaf3de; color:#3b6d11; font-weight:500">
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="badge"
                                                style="background:#fcebeb; color:#a32d2d; font-weight:500">
                                                Dipinjam
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">Belum ada data buku</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pesan Terbaru --}}
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
                    <span><i class="nav-icon fas fa-envelope mx-2" style="color:#0d6efd"></i>Pesan Terbaru</span>
                    <a href="{{ route('opendonasi.index') }}" class="btn btn-sm"
                        style="background:#e7f0ff; color:#0d6efd; font-size:12px; border-radius:20px">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($kontakTerbaru as $pesan)
                            <li class="list-group-item px-3 py-2" style="font-size:13px">
                                <div class="fw-semibold">{{ $pesan->nama ?? $pesan->email }}</div>
                                <div class="text-muted" style="font-size:11px;
                                    display:-webkit-box; -webkit-line-clamp:2;
                                    -webkit-box-orient:vertical; overflow:hidden">
                                    {{ $pesan->pesan }}
                                </div>
                                <div class="text-muted mt-1" style="font-size:10px">
                                    {{ $pesan->created_at->diffForHumans() }}
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-3">
                                Belum ada pesan masuk
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Style --}}
<style>
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 1px 6px rgba(0,0,0,0.07);
        height: 100%;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 26px;
        font-weight: 700;
        color: #333;
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 11px;
        color: #999;
        font-weight: 500;
    }
</style>
@endsection