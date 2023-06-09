<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="/" class="nav-link {{ $active === 'Dashboard' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>

        </li>
        {{-- @if (auth()->user()->role === 'admin') --}}
        <li class="nav-header">MASTER DATA</li>
        <li class="nav-item">
            <a href="{{ route('kategori.index') }}" class="nav-link {{ $active === 'kategori' ? 'active' : '' }}">
                <i class="nav-icon fas fa-bookmark"></i>
                <p>
                    Kategori
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/buku" class="nav-link {{ $active === 'buku' ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Buku
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/member" class="nav-link {{ $active === 'member' ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                    Member
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin" class="nav-link {{ $active === 'admin' ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Admin
                </p>
            </a>
        </li>
        <li class="nav-header">TRANSAKSI</li>

        <li class="nav-item">
            <a href="{{ route('transaksi') }}" class="nav-link {{ $active === 'transaksi' ? 'active' : '' }}">
                <i class="nav-icon fas fa-handshake"></i>
                <p>
                    Transaksi
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/peminjaman/pending" class="nav-link {{ $active === 'pending' ? 'active' : '' }}">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Pending
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('peminjaman.ongoing') }}" class="nav-link {{ $active === 'ongoing' ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    On Going
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('peminjaman.gettolak') }}" class="nav-link {{ $active === 'tolak' ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-minus"></i>
                <p>
                    Di Tolak
                </p>
            </a>
        </li>
        <li class="nav-header">Identitas & Laporan</li>
        <li class="nav-item">
            <a href="{{ route('identitas.index') }}" class="nav-link {{ $active === 'identitas' ? 'active' : '' }}">
                <i class="nav-icon fas fa-italic"></i>
                <p>
                    Identitas Aplikasi
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan.index') }}" class="nav-link {{ $active === 'laporan' ? 'active' : '' }}">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                    Laporan
                </p>
            </a>
        </li>
    </ul>
</nav>
