<style>
    .user {
    margin-top: 12.5px;
    padding-left: 25px;
    padding-right: 25px;
    padding-bottom: 12.5px;
    border-bottom: 1px solid #eee;
    display: block;
}
.user .photo {
    width: 40px;
    height: 40px;
    overflow: hidden;
    float: left;
    margin-right: 11px;
    z-index: 5;
    border-radius: 50%;
}

.user .photo img {
    width: 100%;
    height: 100%;
}

.user .info a {
    white-space: nowrap;
    display: block;
    position: relative;
}
.sidebar .user .info a:hover,
.sidebar .user .info a:focus {
    text-decoration: none;
}
.user .info a>span .user-level {
    color: #555;
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 0.05em;
    margin-top: 5px;
}
.user .info a .link-collapse {
    padding: 7px 0;
}
.ui-helper-clearfix:after,
.ui-helper-clearfix:before {
    content: "";
    display: table;
    border-collapse: collapse;
}

.ui-helper-clearfix:after {
    clear: both;
}
body.sidebar-mini .main-sidebar .user {
    padding-left:15px ;
    font-size: 0;
    height: 2px;
    border-bottom:none;
    margin-bottom:40px;
}
body.sidebar-mini .main-sidebar .user.info a>span .user-level {
    display: none; }

</style>

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        @if(auth()->user()->hasRole('admin'))
        <div class="sidebar-brand">
            <a href="#">Admin Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">AD</a>
        </div>
        @endif

        @if(auth()->user()->hasRole('user'))
        <div class="sidebar-brand">
            {{-- <a href="#">Dashboard Pengguna</a> --}}
            <a href="">
            <img src="{{ asset('fe/img/GriyoKenyo.png') }}" class="img-sidebar" style="margin-right: 90px" alt="">
        </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">{{ Auth::user()->usernamee() }}</a>
        </div>
        <div class="user">
            <div class="photo">
                @if(Auth::user()->avatar)
                    <img alt="image" src="{{ asset('storage/'.auth()->user()->avatar) }}" class="rounded-circle mr-1">
                @else
                    <img alt="image" src="{{asset('/assets/img/avatar/avatar-4.png')}}" class="rounded-circle mr-1">
                @endif
            </div>
            <div class="profile-widget-item">
                <a href="{{ route('profil-user') }}" style="color:black">
                    <div class="profile-widget-item-label">{{ Auth::user()->name }}</div>
                </a>
                    <div class="profile-widget-item-value"><strong>Pengguna</strong></div>
            </div>
        </div>
        @endif

        <ul class="sidebar-menu">
            @if(auth()->user()->hasRole('admin'))
            <li class="menu-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{ route('admin-dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
                </li>
            <li class="menu-header">Kamar</li>
                <li class="{{ (request()->is('admin/fasilitas*')) ? 'active' : '' }} ">
                    <a href="{{ route('fasilitas.index') }}" class="nav-link">
                    <i class="fas fa-columns"></i> <span>Fasilitas</span></a>
                </li>
                <li class="{{ (request()->is('admin/tipe*')) ? 'active' : '' }}">
                    <a href="{{ route('tipe.index') }}" class="nav-link">
                    <i class="fas fa-bed"></i> <span>Tipe Kamar</span></a>
                </li>
            <li class="menu-header">Pemesanan
                <li class="{{ (request()->is('admin/booking')) ? 'active' : '' }}">
                    <a href="{{ route('transaksi') }}" class="nav-link">
                    <i class="fas fa-calendar-check"></i><span>Data Pemesanan</span></a>
                </li>
            </li>
            <li class="menu-header">Keuangan
                <li class="{{ (request()->is('admin/pemasukan*')) ? 'active' : '' }}">
                    <a href="{{ route('pemasukan') }}"><i class="fas fa-credit-card"></i><span>Laporan Pemasukan</span></a>
                </li>
                <li class="{{ (request()->is('admin/pengeluaran*')) ? 'active' : '' }}">
                    <a href="{{ route('pengeluaran.index') }}"><i class="fas fa-receipt"></i><span>Laporan Pengeluaran</span></a>
                </li>
            </li>
            <li class="menu-header">User
                <li class="{{ (request()->is('admin/user')) ? 'active' : '' }}">
                    <a href="{{ route('user') }}" class="nav-link"><i class="fas fa-user"></i><span>User</span></a>
                </li>
                <li class="{{ (request()->is('admin/reviews*')) ? 'active' : '' }}">
                    <a href="{{ route('reviews.index') }}" class="nav-link"><i class="fas fa-book"></i><span>Review</span></a>
                </li>
            </li>
            @endif

            @if(auth()->user()->hasRole('user'))
                <li class="{{ (request()->is('user/user-transaksi*')) ? 'active' : '' }}">
                    <a href="{{ route('user-transaksi') }}" class="nav-link"><i class="fas fa-calendar-check"></i> <span>Pemesanan</span></a>
                </li>
                <li class="{{ (request()->is('user/review*')) ? 'active' : '' }}">
                    <a href="{{ route('review-user') }}" class="nav-link"><i class="fas fa-comments"></i> <span>Review</span></a>
                </li>
                <li class="{{ (request()->is('user/profil-user*')) ? 'active' : '' }}">
                    <a href="{{ route('profil-user') }}" class="nav-link"><i class="fas fa-user"></i> <span>Profil</span></a>
                </li>
            @endif
    </aside>
</div>
