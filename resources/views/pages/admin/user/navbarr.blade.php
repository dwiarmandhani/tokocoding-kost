<style type=text/css>

    .nav-tabs .nav-item .nav-link {
        color: #F6DB80; }
        .nav-tabs .nav-item .nav-link.active {
        color: #000; }
        .nav-tabs .nav-item .nav-link {
            color: #000;
        }
        .nav-tabs .nav-item.active .nav-link{
            color: black;
            background-color: rgb(207, 207, 207);
        }
        ul.nav-tabs li.active .a.nav-link {
            color: #green;
        }

    </style>
    <ul class="nav nav-tabs">
        <li class="nav-item {{ (request()->is('admin/user')) ? 'active' : '' }}"  style="width: 330px;">
            <a class="nav-link" href="{{ route('user') }}" style="text-align:center;">Semua User</a>
        </li>
        <li class="nav-item {{ (request()->is('admin/user/aktif')) ? 'active' : '' }}"  style="width: 329px;">
            <a class="nav-link" href="{{ route('user-aktif') }}" style="text-align:center;">Akif</a>
        </li>
        <li class="nav-item {{ (request()->is('admin/user/nonAktif')) ? 'active' : '' }}"  style="width: 330px;">
            <a class="nav-link" href="{{ route('user-non-aktif') }}" style="text-align:center;">Tidak Aktif</a>
        </li>
    </ul>
