@section('sidebar')
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ request()->is('admin/dashboard*') ? 'active' : '' }} ">
        <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-house-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub {{ request()->is('admin/master*') ? 'active' : '' }}">
        <a href="#" class="sidebar-link">
            <i class="bi bi-collection-fill"></i>
            <span>Master Data</span>
        </a>
        <ul class="submenu {{ request()->is('admin/master*') ? 'active' : '' }}">
            <li class="submenu-item {{ request()->is('admin/master/anggota') ? 'active' : '' }}">
                <a href="{{ route('admin.anggota') }}">Data Anggota</a>
            </li>
            <li class="submenu-item {{ request()->is('admin/master/penerbit') ? 'active' : '' }}">
                <a href="{{ route('admin.penerbit') }}">Data Penerbit</a>
            </li>
            <li class="submenu-item {{ request()->is('admin/master/administrator') ? 'active' : '' }}">
                <a href="{{ route('admin.administrator') }}">Data Administrator</a>
            </li>
            <li class="submenu-item {{ request()->is('admin/master/peminjaman') ? 'active' : '' }}">
                <a href="{{ route('admin.peminjaman') }}">Data Peminjaman</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub {{ request()->is('admin/katalog*') ? 'active' : '' }}">
        <a href="#" class="sidebar-link">
            <i class="bi bi-book-fill"></i>
            <span>Katalog Buku</span>
        </a>
        <ul class="submenu {{ request()->is('admin/katalog*') ? 'active' : '' }}">
            <li class="submenu-item {{ request()->is('admin/katalog/buku') ? 'active' : '' }}">
                <a href="{{ route('admin.buku') }}">Data Buku</a>
            </li>
            <li class="submenu-item {{ request()->is('admin/katalog/kategori') ? 'active' : '' }}">
                <a href="{{ route('admin.kategori') }}">Data Kategori</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item {{ request()->is('admin/laporan*') ? 'active' : '' }}">
        <a href="{{ route('admin.laporan') }}" class='sidebar-link'>
            <i class="bi bi-file-earmark-pdf-fill"></i>
            <span>Laporan Perpustakaan</span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->is('admin/identitas*') ? 'active' : '' }}">
        <a href="{{ route('admin.identitas') }}" class='sidebar-link'>
            <i class="bi bi-info-lg"></i>
            <span>Identitas Aplikasi</span>
        </a>
    </li>

    <li class="sidebar-item has-sub {{ request()->is('admin/pesan*') ? 'active' : '' }}">
        <a href="#" class="sidebar-link">
            <i class="bi bi-envelope-fill"></i>
            <span>Pesan</span>
        </a>
        <ul class="submenu {{ request()->is('admin/pesan*') ? 'active' : '' }}">
            <li class="submenu-item {{ request()->is('admin/pesan/terkirim') ? 'active' : '' }}">
                <a href="{{ route('admin.pesan_terkirim') }}">Pesan Terkirim</a>
            </li>
            <li class="submenu-item {{ request()->is('admin/pesan/masuk') ? 'active' : '' }}">
                <a href="{{ route('admin.pesan_masuk') }}">Pesan Masuk</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item {{ request()->is('admin/pemberitahuan*') ? 'active' : '' }}">
        <a href="{{ route('admin.pemberitahuan') }}" class='sidebar-link'>
            <i class="bi bi-megaphone-fill"></i> <span>Pemberitahuan</span>
        </a>
    </li>

    <li class="sidebar-item" style="margin-bottom:5rem;">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
document.getElementById('logout-form').submit();"
            class='sidebar-link'>
            <i class="bi bi-box-arrow-in-left"></i>
            <span>Logout</span>
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endsection

@section('navbar')
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @php
                $pesans = \App\Models\Pesan::where('penerima_id', Auth::user()->id)
                    ->where('status', 'terkirim')
                    ->get();
            @endphp

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link active dropdown-toggle text-gray-600 iconClass" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-envelope bi-sub fs-4"></i>
                            @if (count($pesans) > 0)
                                <span class="badge bg-danger" style="padding: 3px;position: absolute;right: 20px;">
                                    {{ count($pesans) }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" id="message">
                            <li>
                                @if (count($pesans) == 0)
                                    <p class="dropdown-header font-bold">Tidak Ada Pesan</p>
                                @else
                                    <p class="dropdown-header font-bold">Pesan</p>
                                @endif
                            </li>

                            @foreach ($pesans->slice(0, 4) as $pesan)
                                <li>
                                    <form action="{{ route('admin.baca_pesan', ['pesan_id' => $pesan->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <div class="row	align-items-center">
                                                <div class="avatar avatar-md col-2 ">
                                                    <img src="{{ $pesan->pengirim->foto }}">
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0 font-bold">{{ $pesan->pengirim->username }}</p>
                                                    <p class="mb-0">{{ $pesan->judul }}</p>
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                            @if (count($pesans) > 4)
                                <li>
                                    <p class="text-center py-2 mb-0">
                                        <a href="{{ route('admin.pesan_masuk') }}">Lihat Semua Pesan</a>
                                    </p>
                                </li>
                            @endif

                        </ul>
                    </li>
                </ul>
                <div class="user-menu d-flex">
                    <div class="user-name text-end me-3">
                        <h6 class="mb-0 text-gray-600">{{ Auth::user()->fullname }}</h6>
                        <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->username }}</p>
                    </div>
                    <div class="user-img d-flex align-items-center">
                        <div class="avatar avatar-md">
                            <img src="{{ Auth::user()->foto }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection
