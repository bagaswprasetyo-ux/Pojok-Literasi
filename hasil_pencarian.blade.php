<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="{{ asset('kunangan') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('kunangan') }}/styles1.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="{{ asset('kunangan') }}/css/mdb.min.css" />
    <title>Hasil Pencarian — Literasi Kunangan 📖</title>

    <style>
        .search-recap {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .search-recap-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            padding: 8px 18px;
            flex: 1;
            min-width: 200px;
        }

        .search-recap-box i {
            color: #aaa;
            font-size: 14px;
        }

        .search-recap-box span {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        .search-recap-box .kw {
            color: #b8890a;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            font-size: 13px;
            background: transparent;
            cursor: pointer;
            color: #666;
            text-decoration: none;
            white-space: nowrap;
        }

        .back-btn:hover {
            background: #f5f5f5;
            color: #333;
        }

        .result-tabs {
            display: flex;
            gap: 4px;
            background: #f0f0f0;
            border-radius: 50px;
            padding: 4px;
            width: fit-content;
            margin-bottom: 1.25rem;
        }

        .result-tab-btn {
            border: none;
            background: transparent;
            padding: 8px 22px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            color: #777;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .result-tab-btn.active {
            background: #f8d65b;
            color: #5a4200;
            font-weight: 700;
        }

        .result-tab-btn .badge-count {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 1px 7px;
            font-size: 11px;
        }

        .result-tab-btn.active .badge-count {
            background: rgba(90, 66, 0, 0.15);
        }

        .result-panel {
            display: none;
        }

        .result-panel.active {
            display: block;
        }

        .result-meta {
            font-size: 13px;
            color: #888;
            margin-bottom: 1rem;
        }

        .result-meta strong {
            color: #333;
        }

        .section-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #aaa;
            margin-bottom: 0.75rem;
        }

        .lokasi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px;
            margin-bottom: 2rem;
        }

        .lokasi-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 16px;
            padding: 1.1rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: block;
        }

        .lokasi-card:hover {
            border-color: #f8d65b;
            box-shadow: 0 2px 12px rgba(248, 214, 91, 0.25);
            text-decoration: none;
        }

        .lokasi-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #fff8e1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .lokasi-icon i {
            font-size: 20px;
            color: #b8890a;
        }

        .lokasi-name {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }

        .lokasi-sub {
            font-size: 11px;
            color: #999;
        }

        .lokasi-tag {
            display: inline-block;
            margin-top: 8px;
            font-size: 10px;
            padding: 2px 10px;
            border-radius: 20px;
            background: #fff3cd;
            color: #8a6200;
        }

        /* Buku Cards */
        .buku-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 12px;
        }

        .buku-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: block;
        }

        .buku-card:hover {
            border-color: #f8d65b;
            box-shadow: 0 2px 12px rgba(248, 214, 91, 0.25);
            text-decoration: none;
        }

        .buku-cover {
            background: #f5f0e8;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .buku-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .buku-cover-placeholder {
            font-size: 36px;
            color: #c8a84b;
        }

        .buku-info {
            padding: 8px 10px 10px;
        }

        .buku-title {
            font-size: 12px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .buku-lokasi {
            font-size: 10px;
            color: #999;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .avail-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #3b6d11;
            display: inline-block;
            margin-right: 3px;
            flex-shrink: 0;
        }

        .avail-dot.dipinjam {
            background: #a32d2d;
        }

        .buku-status {
            margin-top: 5px;
            font-size: 10px;
            display: flex;
            align-items: center;
        }

        .status-tersedia {
            color: #3b6d11;
        }

        .status-dipinjam {
            color: #a32d2d;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #aaa;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 1rem;
            color: #ddd;
        }

        .empty-state p {
            font-size: 14px;
        }

        .empty-state .kw {
            color: #b8890a;
            font-weight: 600;
        }
        .inline-search-form {
            flex: 1;
            min-width: 220px;
        }

        .inline-search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .inline-search-wrapper:focus-within {
            box-shadow: 0 0 0 3px rgba(248, 214, 91, 0.35);
            border-color: #f8d65b;
        }

        .inline-search-icon {
            position: absolute;
            left: 14px;
            color: #bbb;
            font-size: 13px;
            pointer-events: none;
        }

        .inline-search-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 10px 12px 10px 38px;
            font-size: 13px;
            color: #333;
            background: transparent;
        }

        .inline-search-input::placeholder {
            color: #bbb;
        }

        .inline-search-btn {
            border: none;
            background: #f8d65b;
            color: #5a4200;
            padding: 10px 16px;
            cursor: pointer;
            font-size: 13px;
            transition: background 0.2s;
        }

        .inline-search-btn:hover {
            background: #f5c800;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-md fixed-top navbar-before-scroll shadow-0">
        <div class="container">
            <a class="navbar-brand" id="navbar-brand-text" href="{{ url('/') }}">Literasi Kunangan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa-solid fa-bars" style="color: aliceblue;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/informasi') }}">Informasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('beritapengunjung.index') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('kontakadmin.index') }}">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/bantuan') }}">Bantuan</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login &nbsp;<i class="fa-solid fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container mt-5 pt-4 pb-5">
        <div class="search-recap mt-3">
            <a href="{{ url()->previous() }}" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <div class="search-recap-box">
                <span>Hasil pencarian: <span class="kw">"{{ $keyword }}"</span></span>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 flex-wrap mb-3">
        <div class="result-tabs mb-0">
            <button class="result-tab-btn {{ $tipe == 'lokasi' ? 'active' : '' }}"
                onclick="switchResultTab('lokasi', this)">Lokasi
                <span class="badge-count">{{ $lokasi->count() }}</span>
            </button>
            <button class="result-tab-btn {{ $tipe == 'buku' ? 'active' : '' }}"
                onclick="switchResultTab('buku', this)">Buku
                <span class="badge-count">{{ $buku->count() }}</span>
            </button>
        </div>

        <form action="{{ route('hasil.pencarian') }}" method="GET" class="inline-search-form">
            <input type="hidden" name="tipe" id="inlineInputTipe"
                value="{{ $tipe }}">
            <div class="inline-search-wrapper">
                <i class="fa-solid fa-magnifying-glass inline-search-icon"></i>
                <input type="text" name="q" class="inline-search-input"
                    value="{{ $keyword }}"
                    placeholder="Cari {{ $tipe == 'buku' ? 'judul buku, pengarang' : 'lokasi pojok literasi' }}..."
                    autocomplete="off" required>
                <button type="submit" class="inline-search-btn">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </form>

    </div>

        <div id="panel-lokasi" class="result-panel {{ $tipe == 'lokasi' ? 'active' : '' }}">
            <p class="result-meta">
                Menampilkan <strong>{{ $lokasi->count() }} lokasi</strong> untuk
                "<span style="color:#b8890a">{{ $keyword }}</span>"
            </p>
            <p class="section-label">Pojok Literasi</p>

            @if($lokasi->count() > 0)
                <div class="lokasi-grid">
                    @foreach($lokasi as $item)
                        <a href="{{ route('lokasidetail.show', $item->id) }}" class="lokasi-card">
                            <div class="lokasi-icon">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </div>
                            <div class="lokasi-name">{{ $item->lokasi }}</div>
                            <div class="lokasi-sub">{{ $item->rt }}</div>
                            <span class="lokasi-tag">
                                {{ $item->buku_count ?? $item->buku->count() }} koleksi
                            </span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <p>Tidak ada lokasi yang cocok dengan <span class="kw">"{{ $keyword }}"</span></p>
                </div>
            @endif
        </div>

        <div id="panel-buku" class="result-panel {{ $tipe == 'buku' ? 'active' : '' }}">
            <p class="result-meta">
                Menampilkan <strong>{{ $buku->count() }} buku</strong> untuk
                "<span style="color:#b8890a">{{ $keyword }}</span>"
            </p>
            <p class="section-label">Koleksi Buku</p>

            @if($buku->count() > 0)
                <div class="buku-grid">
                    @foreach($buku as $item)
                        <a href="#" class="buku-card">
                            <div class="buku-cover">
                                @if($item->foto != null)
                                    <img src="{!! \Storage::url($item->foto) !!}" alt="{{ $item->judul }}">
                                @else
                                    <i class="fa-solid fa-book buku-cover-placeholder"></i>
                                @endif
                            </div>
                            <div class="buku-info">
                                <div class="buku-title">{{ $item->judul }}</div>
                                <div class="buku-lokasi">
                                    <i class="fa-solid fa-location-dot" style="font-size:9px"></i>
                                    Lokasi {{ $item->lokasi_id }}
                                </div>
                                <div class="buku-status">
                                    @if($item->status == 'tersedia')
                                        <span class="avail-dot"></span>
                                        <span class="status-tersedia">Tersedia</span>
                                    @else
                                        <span class="avail-dot dipinjam"></span>
                                        <span class="status-dipinjam">Dipinjam</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fa-solid fa-book"></i>
                    <p>Tidak ada buku yang cocok dengan <span class="kw">"{{ $keyword }}"</span></p>
                </div>
            @endif
        </div>

    </div>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="bg-dark text-white mb-0">
        <div class="container">
            <div class="row p-3">
                <div class="col-sm-8 col-xxl-9">
                    <div class="mb-3">
                        <i class="bi bi-instagram"></i>
                        <a class="m-3 text-white"
                            href="https://www.instagram.com/literasi_kunangan/">literasikunangan.id</a>
                    </div>
                    <div class="mb-3">
                        <a class="m-3 text-white">literasikunangan</a>
                    </div>
                    <div>
                        <a class="m-3 text-white">+628123456789</a>
                    </div>
                </div>
                <div class="col-sm-4 col-xxl-3 text-end mb-3">
                    Kunangan Kec. Taman Rajo Kabupaten Muaro Jambi. Jambi, Indonesia.
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            ©2023 Copyright: Pro-IDE HIMIP
        </div>
    </footer>

    <script src="{{ asset('kunangan') }}/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('kunangan') }}/js/mdb.min.js"></script>

    <script>
        const navbar = document.getElementById("main-navbar");
        const navbarBrandText = document.getElementById("navbar-brand-text");
        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 0) {
                navbar.classList.add("navbar-after-scroll");
                navbarBrandText.style.color = "#fff";
            } else {
                navbar.classList.remove("navbar-after-scroll");
                navbarBrandText.style.color = "#000";
            }
        });

        function switchResultTab(name, el) {
            document.querySelectorAll('.result-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.result-panel').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('panel-' + name).classList.add('active');

            // update tipe di form inline search
            document.getElementById('inlineInputTipe').value = name;

            // update placeholder sesuai tab aktif
            const input = document.querySelector('.inline-search-input');
            input.placeholder = name === 'buku'
                ? 'Cari judul buku, pengarang...'
                : 'Cari lokasi pojok literasi...';
        }
    </script>

    <script>
        function switchTab(el, type) {
            document.querySelectorAll('.search-tab-btn').forEach(btn => btn.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('inputTipe').value = type;
            const input = document.getElementById('searchInput');
            const hint = document.getElementById('searchHintText');
            if (type === 'lokasi') {
                input.placeholder = 'Cari lokasi pojok literasi...';
                hint.textContent = 'Temukan pojok literasi terdekat di Desa Kunangan';
            } else {
                input.placeholder = 'Cari judul buku, pengarang...';
                hint.textContent = 'Cari koleksi buku yang tersedia di seluruh pojok literasi';
            }
        }

    </script>

</body>
</html>