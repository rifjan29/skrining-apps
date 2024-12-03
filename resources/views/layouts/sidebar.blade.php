<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="index.html" class="brand-wrap d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/logo.png') }}" class="logo" alt="Nest Dashboard" />
            <p class="fw-bold">SKRINNING PASIEN</p>
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('dashboard') }}">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            @role('Admin')
            <li class="menu-item {{ Request::segment(2) == 'user' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('user.index') }}">
                    <i class="icon material-icons md-account_circle"></i>
                    <span class="text">User</span>
                </a>
            </li>
            @endrole

            <li class="menu-item {{ Request::segment(2) == 'skrining-pasien' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('skrining-pasien.index') }}">
                    <i class="icon material-icons md-comment"></i>
                    <span class="text">Skrining Pasien</span>
                </a>
            </li>
            <li class="menu-item {{ Request::segment(2) == 'skrining-pasien-covid' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('skrining-covid.index') }}"> <i class="icon material-icons md-stars"></i> <span class="text">Skrining Pasien Covid</span> </a>
            </li>
        </ul>
        <hr />
        <ul class="menu-aside">
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-pie_chart"></i>
                    <span class="text">Laporan</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('laporan.skrining-pasien') }}">Laporan Skrining Pasien</a>
                    <a href="{{ route('laporan.skrining-covid') }}">Laporan Skrining Pasien Covid</a>
                </div>
            </li>
        </ul>
        <br />
        <br />
    </nav>
</aside>
