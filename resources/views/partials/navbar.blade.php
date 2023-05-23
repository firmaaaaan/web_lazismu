<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar navbar-light">
        <div class="container-xl">
            <ul class="navbar-nav">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" >
                    <a class="nav-link" href="{{ route('dashboard') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                        </span>
                        <span class="nav-link-title">
                        Home
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('#navbar-layout') ? 'active' : '' }} dropdown {{ request()->routeIs('dropdown.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" /></svg>
                        </span>
                        <span class="nav-link-title">
                        Master Data
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <a class="dropdown-item" href="{{ route('akun.index') }}">
                                Data Akun
                            </a>
                            <a class="dropdown-item" href="{{ route('dropdown.program.donasi.index') }}">
                                Data Program
                            </a>
                            <a class="dropdown-item" href="{{ route('dropdown.index') }}">
                                Data Mustahik
                            </a>
                            <a class="dropdown-item" href="{{ route('dropdown.pegawai.index') }}">
                                Data Karyawan
                            </a>
                            <a class="dropdown-item" href="{{ route('dropdown.rumahsakit.index') }}">
                                Data Rumah Sakit
                            </a>
                            <a class="dropdown-item" href="{{ route('permintaan.ambulan.index') }}">
                                Data Permintan Ambulan
                            </a>
                            <a class="dropdown-item" href="{{ route('dokumentasi.index') }}">
                                Data Postingan
                            </a>
                            {{-- <a class="dropdown-item" href="./logs.html">
                                Penggajian
                                <span class="badge badge-sm bg-red-lt text-uppercase ms-auto">On Going</span>
                            </a> --}}
                        </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('#navbar-base') ? 'active' : '' }} dropdown {{ request()->routeIs('drop.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('drop.donasi.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                        </span>
                        <span class="nav-link-title">
                        ZIS
                        </span>
                    </a>
                    {{-- <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <a class="dropdown-item" href="{{ route('drop.donasi.index') }}">
                                Infaq/Shodaqoh
                            </a>
                            <a class="dropdown-item" href="{{ route('drop.zakat.index') }}">
                                Zakat
                            </a>
                        </div>
                        </div>
                    </div> --}}
                </li>
                @role('administrator')
                <li class="nav-item {{ request()->routeIs('#navbar-extra') ? 'active' : '' }} dropdown {{ request()->routeIs('dropd.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </span>
                        <span class="nav-link-title">
                        Report
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <a class="dropdown-item" href="{{ route('dropd.exportDonasi') }}">
                            Report Data Donasi
                            </a>
                            {{-- <a class="dropdown-item" href="{{ route('exportZakat') }}">
                            Report Data Zakat
                            </a> --}}
                            <a class="dropdown-item" href="{{ route('exportPermintaanAmbulan') }}">
                            Report Data Permintaan Ambulan
                            </a>
                        </div>
                        </div>
                    </div>
                </li>
                @endrole
                                <li class="nav-item {{ request()->routeIs('index.transaction') ? 'active' : '' }} dropdown {{ request()->routeIs('d.*') ? 'active' : '' }}" >
                    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shredder" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 10m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z"></path>
                            <path d="M17 10v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4m5 5v5m4 -5v2m-8 -2v3"></path>
                        </svg>
                        </span>
                        <span class="nav-link-title">
                        Log Transaksi
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <a class="dropdown-item" href="{{ route('d.index.transaction') }}">
                            Perpindahan Saldo
                            </a>
                            <a class="dropdown-item" href="{{ route('index.penyaluran') }}">
                            Penyaluran
                            </a>
                        </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('#navbar-extra') ? 'active' : '' }} dropdown {{ request()->routeIs('dropdo.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                        </svg>
                        </span>
                        <span class="nav-link-title">
                        Pengguna
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <a class="dropdown-item" href="{{ route('dropdo.user.index') }}">
                            Users
                            </a>
                            <a class="dropdown-item" href="{{ route('driver.index') }}">
                            Driver
                            </a>
                            <a class="dropdown-item" href="{{ route('donatur.index') }}">
                            Donatur
                            </a>
                        </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    </div>
</div>
