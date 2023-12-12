@section('sidebar')
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }} ">
        <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-house-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub {{ request()->is('master*') ? 'active' : '' }}">
        <a href="#" class="sidebar-link">
            <i class="bi bi-collection-fill"></i>
            <span>Master Data</span>
        </a>
        <ul class="submenu {{ request()->is('master*') ? 'active' : '' }}">
            @if (Auth::user()->role == 'admin')
                <li class="submenu-item {{ request()->is('master/administrator') ? 'active' : '' }}">
                    <a href="{{ route('admin.administrator') }}">Data Pustakawan</a>
                </li>
            @endif
            <li class="submenu-item {{ request()->is('master/anggota') ? 'active' : '' }}">
                <a href="{{ route('admin.anggota') }}">Data Anggota</a>
            </li>

            <li class="submenu-item {{ request()->is('master/buku') ? 'active' : '' }}">
                <a href="{{ route('admin.buku') }}">Data Buku</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub {{ request()->is('transaksi*') ? 'active' : '' }}">
        <a href="#" class="sidebar-link">
            <i class="bi bi-arrow-left-right"></i>
            <span>Transaksi</span>
        </a>
        <ul class="submenu {{ request()->is('transaksi*') ? 'active' : '' }}">
            <li class="submenu-item {{ request()->is('transaksi/peminjaman') ? 'active' : '' }}">
                <a href="{{ route('admin.peminjaman') }}">Peminjaman</a>
            </li>
            <li class="submenu-item {{ request()->is('transaksi/pengembalian') ? 'active' : '' }}">
                <a href="{{ route('admin.pengembalian') }}">Pengembalian</a>
            </li>
        </ul>
    </li>

    @if (Auth::user()->role == 'admin')
        <li class="sidebar-item {{ request()->is('identitas*') ? 'active' : '' }}">
            <a href="{{ route('admin.identitas') }}" class='sidebar-link'>
                <i class="bi bi-gear-fill"></i>
                <span>Setting</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->is('import*') ? 'active' : '' }}">
            <a href="{{ route('admin.import') }}" class='sidebar-link'>
                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                <span>Import</span>
            </a>
        </li>
    @endif

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
