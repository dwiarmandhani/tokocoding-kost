<section class="h-100 w-100 bg-white" z-index="99" style="box-sizing: border-box">
<div class="container-xxl mx-auto p-0  position-relative header-2-2" style="font-family: 'Poppins', sans-serif">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href={{ route('home') }}>
        <img style="margin-right: 0.75rem;"
            src="{{ asset('fe/img/tokoCodingKost.png') }}" alt="" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-toggle="modal" data-target="#targetModal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="modal-item modal fade" id="targetModal" tabindex="-1" role="dialog"
        aria-labelledby="targetModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-white border-0">
                    <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                        <a class="modal-title" id="targetModalLabel">
                        <img style="margin-top: 0.5rem; width: 100px; height:70px"
                        src="{{ asset('fe/img/tokoCodingKost.png') }}" alt="" />
                        </a>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                        <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li> --}}
                        {{-- </ul> --}}
                        @auth
                        <!--Desktop Menu-->
                    {{-- <ul class="nav navbar-nav d-none d-lg-flex"> --}}
                        <li class="nav-item dropdown">
                        <a href="#" class="btn btn-fill text-white" id="navbar-dropdown" role="button" data-toggle="dropdown" style="margin-right: 4px;">
                            Hi, {{ Auth::user()->initials() }}
                        </a>
                        <div class="dropdown-menu">
                            @if(auth()->user()->hasRole('user'))
                            <a href="{{ route('profil-user') }}" class="dropdown-item">Profil</a>
                            <a href="{{ route('user-transaksi') }}" class="dropdown-item"><span>Pemesanan</span></a>
                                <div class="dropdown-divider"></div>
                            <a
                            href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="dropdown-item text-danger"
                            >
                            <span>Keluar</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </a>
                            @endif

                            @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin-dashboard') }}" class="dropdown-item"><span>Dashboard</span></a>
                                <div class="dropdown-divider"></div>
                                <a
                                href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="dropdown-item text-danger"
                                >
                                <span>Keluar</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            @endif
                        </div>
                        </li>
                        @endauth
                    </ul>
                        </li>
                        </ul>
                    </div>
                    @guest
                    {{-- <div class="modal-footer border-0 gap-3" style="padding: 2rem; padding-top: 0.75rem">
                            <a href="{{ route('login') }}" class="btn btn-fill text-white">Masuk</a>
                    </div> --}}
                    <div class="modal-footer border-0 gap-3" style="padding: 2rem; padding-top: 0.75rem">
                        <a href="{{ route('login') }}" class="btn btn-fill text-white">Masuk</a>
                </div>
                    @endguest
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                {{-- <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li> --}}
            </ul>
            @guest
            {{-- <div class="gap-3">
                <a href="{{ route('login') }}" class="btn btn-fill text-white">Masuk</a>
            </div> --}}
            <div class="gap-3">
                <a href="{{ route('login') }}" class="btn btn-fill text-white">Masuk</a>
            </div>
            @endguest
        </div>
        @auth
            <!--Desktop Menu-->
        <ul class="nav navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown">
            <a href="#" class="btn btn-fill text-white" id="navbar-dropdown" role="button" data-toggle="dropdown" style="margin-right: 4px;">
                Hi, {{ Auth::user()->initials() }}
            </a>
            <div class="dropdown-menu">
                @if(auth()->user()->hasRole('user'))
                <a href="{{ route('user-transaksi') }}" class="dropdown-item"><span>Pemesanan</span></a>
                <a href="{{ route('profil-user') }}" class="dropdown-item">Profil</a>
                    <div class="dropdown-divider"></div>
                <a
                href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="dropdown-item text-danger"
                >
                <span>Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </a>
                @endif

                @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin-dashboard') }}" class="dropdown-item"><span>Dashboard</span></a>
                    <div class="dropdown-divider"></div>
                    <a
                    href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item text-danger"
                    >
                    <span>Keluar</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                @endif
            </div>
            </li>
        </ul>
        @endauth
    </nav>
</div>
</section>

