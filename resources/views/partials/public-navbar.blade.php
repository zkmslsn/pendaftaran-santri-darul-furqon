<nav class="navbar main-navbar">
    <div class="brand">
        <img
            src="{{ asset('assets/img/logo-pondok.jpeg') }}"
            alt="Logo Pondok"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

        <div class="brand-logo" style="display:none;">DF</div>

        <span>Pondok Pesantren Tahfidzul Quran Darul Furqon</span>
    </div>

    <div class="nav-links">
        <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('informasi') }}" class="{{ request()->routeIs('informasi') ? 'active' : '' }}">Informasi</a>
        <a href="{{ route('syarat') }}" class="{{ request()->routeIs('syarat') ? 'active' : '' }}">Syarat</a>
        <a href="{{ route('daftar.create') }}" class="{{ request()->routeIs('daftar.*') ? 'active' : '' }}">Daftar</a>
        <a href="{{ route('login') }}" class="nav-login {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
    </div>
</nav>
